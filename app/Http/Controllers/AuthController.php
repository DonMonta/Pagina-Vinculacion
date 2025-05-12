<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'password'=> 'required|string',
            'email' => 'required|email',
        
        ],[
            
            'email.required'=>'El campo email es requerido',
            'email.email'=>'El campo email debe ser un email valido',
        ]);
        if($validator->fails()){
            return response()->json([
                'error'=>$validator->errors()],Response::HTTP_BAD_REQUEST);
        }
        $credentials = request(['email','password']);
        if(!$token = auth()->attempt($credentials)){
            return response()->json(['error'=>'Credenciales incorrectas'],Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }
    public function unauthorized(){
        return redirect(route('login'));
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required|string',
            'email'=> 'required|email',
            'password'=> 'required|string|min:6',
            
        ],[
            'name.required'=>'El campo name es requerido',
            'email.required'=>'El campo email es requerido',
            'email.email'=>'El campo email debe ser un email valido',
            'password.required'=>'El campo password es requerido',
            'password.min'=>'La contraseña debe tener al menos 6 caracteres',
           
        ]);
        if($validator->fails()){
            return response()->json([
                'error'=>$validator->errors()],Response::HTTP_BAD_REQUEST);
        }
        $exists = User::where('email',htmlspecialchars($request->input('email')))->first();
        if(!$exists){
            $new = User::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
                'role'=>$request->input('role'),
                'estado'=>$request->input('estado'),
            ]);
            if(!$new){
                return response()->json(['error'=>'Error al crear usuario'],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json($new,Response::HTTP_CREATED);
        }else{
            return response()->json(['error'=>'El usuario ya existe'],Response::HTTP_BAD_REQUEST);
        }
    }
    public function me(){
        return response()->json(auth()->user());
    }
    public function logout(){
        auth()->logout();
        try{
            $token = JWTAuth::getToken();
            if(!$token){
                return response()->json(['error'=>'No hay token'],Response::HTTP_BAD_REQUEST);
            }
            JWTAuth::invalidate($token);
            return response()->json(['message'=>'Has cerrado sesion'],Response::HTTP_OK);
        }catch(TokenInvalidException $e){
            return response()->json(['error'=>'Token inválido'],Response::HTTP_UNAUTHORIZED);
        }catch(\Exception $e){
            return response()->json(['error'=>'No se pudo cerrar sesion'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function refresh(){
        try{
            $token = JWTAuth::getToken();
            if(!$token){
                return response()->json(['error'=>'No hay token'],Response::HTTP_BAD_REQUEST);
            }
            $nuevo_token = auth()->refresh();
            JWTAuth::invalidate($token);
            return $this->respondWithToken($nuevo_token);
        }catch(TokenInvalidException $e){
            return response()->json(['error'=>'Token inválido'],Response::HTTP_UNAUTHORIZED);
        }catch(\Exception $e){
            return response()->json(['error'=>'No se pudo refrescar sesion'],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    protected function respondWithToken($token){
        return response()->json([
            'token'=>$token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ],Response::HTTP_OK);
    }
}
