<template>
  <!-- Spinner Start -->
  
    <!-- Spinner End -->
  <div class="container-fluid sticky-top px-0" v-if="showNavbar2">
    <div class="container-fluid topbar d-none d-lg-block">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-lg-10">
            <div class="d-flex flex-wrap">
              <a href="#" class="me-4 text-light"><i class="fas fa-map-marker-alt text-white me-2"></i>Vicerrectorado
                Investigación, Vinculación y Posgrado, Nuevos
                Horizontes, Esmeraldas, Ecuador</a>
              <a href="#" class="me-4 text-light"><i class="fas fa-phone-alt text-white me-1"></i>+01234567890</a>
              <a href="#" class="text-light"><i class="fas fa-envelope text-white me-2"></i>Example@gmail.com</a>
            </div>
          </div>
          <div class="col-lg-2">
            <div class="d-flex align-items-center justify-content-end">
              <a href="#" class="btn btn-light border rounded-circle nav-fill me-3"><i
                  class="fab fa-facebook-f"></i></a>
              <a href="#" class="btn btn-light border rounded-circle nav-fill me-3"><i
                  class="fab fa-twitter"></i></a>
              <a href="#" class="btn btn-light border rounded-circle nav-fill me-3"><i
                  class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid" v-if="showNavbar">
      <nav class="navbar navbar-light navbar-expand-xl">
        <a href="index.html" class="navbar-brand">
          <img src="@/assets/img/img/log2.gif" class="img-fluid" height="350px" width="350px" alt="UTELVT" />
        </a>
        <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse">
          <span class="fa fa-bars text-primary"></span>
        </button>
        <div class="collapse navbar-collapse py-3" id="navbarCollapse">
          <div class="navbar-nav mx-auto border-top">
            <router-link :to="{ path: '/'}" class="nav-item nav-link inicio" :class="{ active: activeNav === 'inicio' }"
            @click.native="setActive('inicio')">Inicio</router-link>
            <router-link :to="{ path: '/noticias'}" class="nav-item nav-link noticias" :class="{ active: activeNav === 'noticias' }"
            @click.native="setActive('noticias')">Noticias</router-link>
            <router-link :to="{ path: '/equipo'}" class="nav-item nav-link equipo" :class="{ active: activeNav === 'equipo' }"
            @click.native="setActive('equipo')">Conoce Nuestro Equipo</router-link>
            <router-link :to="{ path: '/normativas'}" class="nav-item nav-link normativas" :class="{ active: activeNav === 'normativas' }"
            @click.native="setActive('normativas')">Normativas</router-link>
            <div class="nav-item dropdown">
              <router-link :to="{ path: '/proyectosnuevos'}" class="nav-link dropdown-toggle proyectos" :class="{ active: activeNav === '2025' }"
              @click.native="setActive('proyectos')" data-bs-toggle="dropdown">Proyectos de
                Vinculacion</router-link>
              <div class="dropdown-menu m-0 rounded-0">
                <router-link :to="{ path: '/proyectosnuevos'}" class="dropdown-item 2025" :class="{ active: activeNav === '2025' }"
                @click.native="setActive('2025')">2025-2029</router-link>
                <router-link :to="{ path: '/'}" class="dropdown-item antiguos">Antiguos</router-link>
              </div>
            </div>
            <a href="contacto.html" class="nav-item nav-link contacto">Contacto</a>
          </div>
          <div class="d-flex align-items-center flex-nowrap pt-xl-0">
            <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
              <span class="sr-only">Switch theme</span>
              <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
              <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
            </button>
            <div class="lang-switcher-wrapper nav-item dropdown lenguaje">
              <div class="nav-link dropdown-toggle lenguaje-selected" data-bs-toggle="dropdown">ES</div>
              <ul class="dropdown-menu m-0 rounded-0">

                <li><a href="##" class="dropdown-item es">Español</a></li>
                <li><a href="##" class="dropdown-item en">English</a></li>
                <li><a href="##" class="dropdown-item fr">Francés</a></li>


              </ul>

            </div>
            <div class="nav-user-wrapper">
              <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                <span class="sr-only">My profile</span>
                <span class="nav-user-img">
                  <picture>
                    <source srcset="@/assets/img/img/avatar/avatar-illustrated-02.webp" type="image/webp" />
                    <img src="@/assets/img/img/avatar/avatar-illustrated-02.png" class="img-fluid" alt="User name" />
                  </picture>
                </span>
              </button>

            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
   <!-- Carousel Start -->
   <div class="container-fluid carousel-header px-0" v-if="showNavbar">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    
                  <img src="@/assets/img/img/fondo3.jpg" width="300" height="200" class="img-fluid">
                  
                    <div class="carousel-caption ">
                        <div class="p-2" style="max-width: 900px;">
                            <h4 class="text-primary text-uppercase mb-3 titulo">Dirección de Vinculación con la Sociedad</h4>
                            <h1 class="display-1 text-capitalize text-dark mb-1 sub1">Sobre Nosotros</h1>
                            <p class="mx-md-1 fs-4 px-1 mb-1 texto text-dark cont1">La Dirección de Vinculación con la Sociedad planifica y coordina las acciones de Vinculación de la Universidad 
                              con los sectores productivos y sociales en los campos de investigación...</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4 leer" href="#">Leer Más</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                  <img src="@/assets/img/img/fondo3.jpg" width="300" height="200" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-primary text-uppercase mb-3 titulo">Dirección de Vinculación con la Sociedad</h4>
                            <h1 class="display-1 text-capitalize text-dark mb-1 sub2">Visión</h1>
                            <p class="mx-md-1 fs-4 px-1 mb-5 text-dark cont2">Propender a un desarrollo sostenible de la sociedad mediante programas de servicio a la colectividad; articulando a la docencia...</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4 leer" href="#">Leer Más</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="@/assets/img/img/fondo3.jpg" width="300" height="200" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-primary text-uppercase mb-3 titulo">Dirección de Vinculación con la Sociedad</h4>
                            <h1 class="display-1 text-capitalize text-dark sub3">Misión</h1>
                            <p class="mx-md-1 fs-4 px-1 mb-1 text-dark cont3">Ser un referente a nivel nacional e internacional, por una efectiva vinculación con la sociedad, contribuyendo a la construcción...</p>
                            <div class="d-flex align-items-center justify-content-center">
                              <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4 leer" href="#">Leer Más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
  <!-- Carousel End -->
  <div>
    <router-view />
  </div>
  
  
</template>

<style scoped>
@import url('@/assets/styles/css/style.css');
.nav-link.active {
  font-weight: bold;
  color: #FC1700;            /* Color activo */
  border-bottom: 2px solid #FC1700; /* Opcional: línea inferior en el mismo color */
}
</style>
<script>
import 'owl.carousel';
import script2 from '@/assets/scripts/js/main.js'
import feather from 'feather-icons';
export default {
  data() {
    return {
      activeNav: "" // Almacena el enlace actualmente activo
    };
  },
  methods: {
    setActive(item) {
      // Si se hace clic en el mismo activo, se desactiva
      if (this.activeNav === item) {
        this.activeNav = "";
      } else {
        this.activeNav = item;
      }
    }
  },
  mixins: [script2],
  mounted() {
    feather.replace();
  }
}
</script>
