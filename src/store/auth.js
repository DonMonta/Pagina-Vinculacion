// Código para la autenticación del usuario
import { ref } from 'vue';
import axios from 'axios'; 
import store from "@/store";
import Swal from 'sweetalert2';

const logged = ref(false); 
const user = ref('');
const baseURL = `${__API_VINCULACION__}/vin`; // Extraemos la base para usarla en me y refresh

// Variables de control para evitar múltiples modales al mismo tiempo
let isRefreshing = false;
let refreshSubscribers = [];

function subscribeTokenRefresh(cb) {
  refreshSubscribers.push(cb);
}

function onRefreshed(token) {
  refreshSubscribers.map((cb) => cb(token));
  refreshSubscribers = [];
}
// Creación de un cliente de axios
const apiClient = axios.create({
  baseURL: baseURL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// 1. Interceptor de PETICIÓN (Request) - Ya lo tenías
apiClient.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token_vinc');
    const tokenType = localStorage.getItem('token_type_vinc') || 'Bearer';
    if (token) {
      config.headers.Authorization = `${tokenType} ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

apiClient.interceptors.response.use(
  (response) => {
    // Si la respuesta es exitosa, la dejamos pasar
    return response;
  },
  async (error) => {
    const originalRequest = error.config;

    // Verificamos si el error es 401 y si NO hemos reintentado ya esta petición
    if (error.response && error.response.status === 401 && !originalRequest._retry) {
      
      // Si ya hay un modal de renovación en pantalla, ponemos esta petición en "pausa"
      if (isRefreshing) {
        return new Promise((resolve) => {
          subscribeTokenRefresh((token) => {
            originalRequest.headers.Authorization = `Bearer ${token}`;
            resolve(apiClient(originalRequest));
          });
        });
      }

      originalRequest._retry = true; // Marcamos para evitar un bucle infinito
      isRefreshing = true; // Bloqueamos para que no salgan más modales

      try {
        // Pausamos la ejecución y preguntamos al usuario
        const result = await Swal.fire({
          title: 'Sesión Expirada',
          text: 'Tu sesión ha caducado por inactividad. ¿Deseas extender tu sesión?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, extender sesión',
          cancelButtonText: 'No, salir',
          allowOutsideClick: false // Obligamos a elegir una opción
        });

        // Si el usuario acepta extender la sesión
        if (result.isConfirmed) {
          // Solicitamos un nuevo token usando la ruta de refresh
          const refreshResponse = await axios.post(`${baseURL}/refresh`, {}, {
            headers: {
              'Authorization': `Bearer ${localStorage.getItem('token_vinc')}`
            }
          });

          const newToken = refreshResponse.data.token;

          if (newToken) {
            // Actualizamos el Vuex y LocalStorage usando tu mutación existente
            store.commit('setToken_vinc', newToken);
            store.commit('setTokenType_vinc', refreshResponse.data.token_type || 'Bearer');

            // Liberamos la cola de peticiones que estaban esperando
            isRefreshing = false;
            onRefreshed(newToken);

            // Actualizamos el header de la petición original que falló
            originalRequest.headers.Authorization = `Bearer ${newToken}`;

            // Volvemos a ejecutar la petición original con el nuevo token
            return apiClient(originalRequest);
          }
        } else {
          // Si el usuario da clic en "No, salir"
          throw new Error("El usuario decidió no extender la sesión");
        }
      } catch (refreshError) {
        // Si el usuario cancela, o si falla la ruta /refresh (token inválido definitivo)
        console.warn('Cerrando sesión:', refreshError.message || refreshError);
        
        isRefreshing = false;
        refreshSubscribers = []; // Vaciamos la cola
        
        store.commit('logout_vinc'); // Limpiamos todo el estado de Vuex y Storage
        window.location.href = '/site/site-login'; // Redirigimos al login
        return Promise.reject(refreshError);
      }
    }

    return Promise.reject(error);
  }
);

// Función para obtener el usuario logueado
export const getMe = async () => {
  try {
    // Usamos '/me' ya que baseURL ahora llega hasta '/vin'
    const response = await apiClient.get('/me'); 
    localStorage.setItem('user_vinc', JSON.stringify(response.data));
    logged.value = true;
    user.value = response.data;
    return response.data;
  } catch (error) {
    // Ya no hacemos localStorage.clear() aquí directamente, 
    // el interceptor de arriba se encarga de manejar el logout si el refresh falla.
    console.error('Error al obtener perfil data:', error);
    throw error;
  }
};