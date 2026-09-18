//Funcion para el login del usuario
import axios from "axios";
import store from "@/store";
export async function enviarsolilogin(method, parametros, url, mensaje) {
  try {
    const response = await axios({
      method: method,
      url: url,
      data: parametros,
    });
    console.log(response);

    if (response.data && response.data.token) {
      if (response.data.error) {
        return {
          error: response.data.error,
          clave: response.data.clave,
          mensaje: response.data.mensaje,
        };
      }
      else if(response.data.Role === "sotics" || response.data.Role === "atics" || response.data.Role === "sa" || response.data.Role === "vinc" || response.data.Role === "avinc" ) {
        store.commit("setRol_vinc", response.data.Role);
        store.commit("setemail_vinc", response.data.email);
        store.commit("setid_vinc", response.data.cedula);

        store.commit("setname_vinc", response.data.name);
        store.commit("setToken_vinc", response.data.token);
        store.commit("setTokenType_vinc", response.data.token_type || "Bearer");
        return {
          token: response.data.token,
          Rol: response.data.Role,
          id: response.data.cedula,
          name: response.data.name,
          email: response.data.email,
        };
      }else if(response.data.Role === "D" || response.data.Role === "A" || response.data.Role === "TDO" || response.data.Role === "T"){
        store.commit("setRol_vinc", response.data.Role);
        store.commit("setemail_vinc", response.data.email);
        store.commit("setid_vinc", response.data.cedula);
        store.commit("setname_vinc", response.data.name);
        store.commit("setToken_vinc", response.data.token);
        store.commit("setTokenType_vinc", response.data.token_type || "Bearer");
        if(response.data.proyectos_ids){
          store.commit("setProyectosIds_vinc", response.data.proyectos_ids || []);
          store.commit("setProyectosDetalles_vinc", response.data.proyectos_detalles || []);
          return {
            token: response.data.token,
            Rol: response.data.Role,
            id: response.data.cedula,
            name: response.data.name,
            email: response.data.email,
            proyectos_ids: response.data.proyectos_ids,
            proyectos_detalles: response.data.proyectos_detalles,
          };
        }
        return {
          token: response.data.token,
          Rol: response.data.Role,
          id: response.data.cedula,
          name: response.data.name,
          email: response.data.email,
        };
      }
      else if(response.data.Role === "est") {
        store.commit("setRol_vinc", response.data.Role);
        store.commit("setemail_vinc", response.data.email);
        store.commit("setCarrera_vinc", response.data.carrera);
        store.commit("setNivel_vinc", response.data.nivel);
        store.commit("setid_vinc", response.data.cedula);

        store.commit("setname_vinc", response.data.name);
        store.commit("setToken_vinc", response.data.token);
        store.commit("setTokenType_vinc", response.data.token_type || "Bearer");
        store.commit("setIdcarrera_vinc", response.data.IDCarrera);
        store.commit("setFacultad_vinc", response.data.facultad);
        return {
          token: response.data.token,
          Rol: response.data.Role,
          id: response.data.cedula,
          name: response.data.name,
          email: response.data.email,
          carrera: response.data.carrera,
          nivel: response.data.nivel,
          idcarrera: response.data.IDCarrera,
          facultad: response.data.facultad,
        };
      }  
    } else {
      console.error("Respuesta inesperada:", response);
      return null;
    }
  } catch (error) {
    console.error("Error:", error.response.data);
    throw error;
  }
}
