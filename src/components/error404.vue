<script setup>
import { ref, computed } from 'vue'
import axios from 'axios';

const logged = ref(false);
const user = ref("");
const meURL = "http://vinculacion.test/api/vin/auth/me";

const apiClient = axios.create({
  baseURL: "http://vinculacion.test/api/vin/auth/me",
  headers: {
    'Content-Type': 'application/json',
  },
});

apiClient.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token');
    const tokenType = localStorage.getItem('token_type');
    if (token && tokenType) {
      config.headers.Authorization = `${tokenType} ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);
const getMe = async () => {
  try {
    const response = await apiClient.get(meURL);
    localStorage.setItem('user',JSON.stringify(response.data));
    
    logged.value = true;
    user.value = response.data;
    return response.data;
  } catch (error) {
    localStorage.clear();
    /*window.location.href = '/login';*/

    console.error('Error al obtener perfil data:', error);
    throw error;
  }
};

getMe();

</script>
<template>
  <section class="page_404 d-flex align-items-center justify-content-center">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 ">
          <div class="col-sm-12 col-sm-offset-1  text-center">
            <div class="four_zero_four_bg">
              <h1 class="text-center ">404</h1>


            </div>

            <div class="contant_box_404">
              <h3 class="h2" v-if="logged">
                Usurio: {{user.name}}
                Rol: {{user.role}}
              </h3>
             

              <p>La página que estás buscando no està disponible!</p>

              <router-link :to="{ path: '/' }" type="button"
                class="btn-hover-bg btn btn-primary text-white py-2 px-4 my-auto">
                Ir a la página principal
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

