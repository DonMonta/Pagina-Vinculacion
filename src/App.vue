<template>
  <ThemeProvider>
    <SidebarProvider>
      <RouterView />
    </SidebarProvider>
  </ThemeProvider>
  <!-- Footer Start 
  <footer v-if="this.$route.name === 'home'">
    
    <div class="container-fluid footer border-1 py-5">
      <div class="container py-5">
        <div class="row g-5">
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item">
              <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid" height="350px" width="350px" alt="UTELVT" />
              <div class="position-relative mx-auto rounded-pill">
                <input class="form-control rounded-pill border-1 w-100 py-3 ps-4 pe-5" type="text"
                  placeholder="-">
                <router-link :to="{path:'/login'}" type="button"
                  class="btn btn-primary btn-primary-outline-0 rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">Inicia Sesión</router-link>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item d-flex flex-column">

              <router-link :to="{ path: '/'}" class="inicio" :class="{ active: activeNav === 'inicio' }"
              @click.native="setActive('inicio')"><i class="fas fa-angle-right me-2"></i> Inicio</router-link >
              <router-link :to="{ path: '/noticias'}" class="noticias" :class="{ active: activeNav === 'noticias' }"
              @click.native="setActive('noticias')"><i class="fas fa-angle-right me-2"></i> Noticias</router-link>
              <router-link :to="{ path: '/equipo'}" class="equipo" :class="{ active: activeNav === 'equipo' }"
              @click.native="setActive('equipo')"><i class="fas fa-angle-right me-2"></i> Conoce Nuestro Equipo</router-link>
              <router-link :to="{ path: '/normativas'}" class="normativas" :class="{ active: activeNav === 'normativas' }"
              @click.native="setActive('normativas')"><i class="fas fa-angle-right me-2"></i> Normativas</router-link>
              <a href="2020-2025.html"><i class="fas fa-angle-right me-2"></i> Proyectos de Vinculacion</a>
              <a href="contacto.html"><i class="fas fa-angle-right me-2"></i> Contacto</a>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item d-flex flex-column">
              <h4 class="mb-4 text-black">Horarios de Atención</h4>
              <p class="text-muted mb-0">Lunes: <span class="text-black"> 08:00 am – 05:00 pm</span></p>
              <p class="text-muted mb-0">Martes: <span class="text-black"> 08:00 am – 05:00 pm</span></p>
              <p class="text-muted mb-0">Miércoles: <span class="text-black"> 08:00 am – 05:00 pm</span></p>
              <p class="text-muted mb-0">Jueves: <span class="text-black"> 08:00 am – 05:00 pm</span></p>
              <p class="text-muted mb-0">Viernes: <span class="text-black"> 08:00 am – 05:00 pm</span></p>
              <h4 class="my-4 text-black">Dirección</h4>
              <p class="mb-0"><i class="fas fa-map-marker-alt text-secondary me-2"></i>Vicerrectorado Investigación,
                Vinculación y Posgrado, Nuevos
                Horizontes, Esmeraldas, Ecuador</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item d-flex flex-column">
              <h4 class="mb-4 text-black">Siguenos</h4>
              <a href=""><i class="fas fa-angle-right me-2"></i> Faceboock</a>
              <a href=""><i class="fas fa-angle-right me-2"></i> Instagram</a>
              <a href=""><i class="fas fa-angle-right me-2"></i> Twitter</a>
              <h4 class="my-4 text-black">Contacto </h4>
              <p class="mb-0"><i class="fas fa-envelope text-secondary me-2"></i> info@example.com</p>
              <p class="mb-0"><i class="fas fa-phone text-secondary me-2"></i> (+012) 3456 7890 123</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer End -->



    <!-- Copyright Start 
    <div class="container-fluid copyright py-4">
      <div class="container">
        <div class="row g-4 align-items-center">
          <div class="col-md-4 text-center text-md-start mb-md-0">
            <span class="text-white"><a class="text-white" href="#"><i
                  class="fas fa-copyright text-white me-2"></i>Dirección de Vinculacion con la Sociedad</a>, All right
              reserved.</span>
          </div>
          <div class="col-md-4">
            <div class="d-flex justify-content-center">
              <a href="" class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-2"><i
                  class="fab fa-facebook-f"></i></a>
              <a href="" class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-2"><i
                  class="fab fa-twitter"></i></a>
              <a href="" class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-2"><i
                  class="fab fa-instagram"></i></a>
              <a href="" class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-0"><i
                  class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
          <div class="col-md-4 text-center text-md-end text-white">

          </div>
        </div>
      </div>
    </div>
    <!-- Copyright End 



    <!-- Back to Top 
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square rounded-circle back-to-top"><i
        class="fa fa-arrow-up"></i></a>

  </footer>-->
</template>

<script setup>
import ThemeProvider from '@/components/layout/ThemeProvider.vue'
import SidebarProvider from '@/components/layout/SidebarProvider.vue'
</script>