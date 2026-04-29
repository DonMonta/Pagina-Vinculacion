import { mostraralertas } from "@/assets/js/function/funciones";
import { enviarsolilogin } from "@/assets/js/function/login_function";
import store from "@/store";
import { getMe } from '@/store/auth';
export default {
  data() {
    return {
      email: "",
      password: "",
      url2: `${__API_VINCULACION__}/vin/login`,
    };
  },
  methods: {
    async login() {
      try {
        var parametros = {
          LoginUsu: this.email.trim(),
          ClaveUsu: this.password.trim(),
        };

        const response = await enviarsolilogin('POST', parametros, this.url2, 'Logueado');
        console.log(response);
        if (response.error) {
          mostraralertas(response.mensaje, 'warning');
        } else if (response) {
          //  getMe() justo después de guardar el token
          //const usuario = await getMe(); // Esto obtiene los datos del usuario autenticado desde /auth/me
          //console.log("Usuario autenticado:", usuario);

          // Redirección según el rol
          const role = response.Rol;
          const tok = response.token;
          //console.log(response.id);
          //console.log(response);
          if (role === 'sotics' || role === 'atics' || role === 'sa' || role === 'vinc' || role === 'avinc') {
            mostraralertas('LE DAMOS LA BIENVENIDA ADMIN ' + (response.name || ''), 'success');
            this.$router.push('/site-admin');
          } 
        }
      } catch (error) {
        console.error("Error en login:", error);
        if (error.response?.data?.mensaje) {
          mostraralertas(error.response.data.mensaje, 'warning');
        } else {
          mostraralertas('No se pudo conectar con el servidor o error inesperado.', 'error');
        }
      }
    },
  },
};
