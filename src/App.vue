<template>
  <div class="container-fluid sticky-top px-0">
      <div class="container-fluid topbar d-none d-lg-block">
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col-lg-10">
              <div class="d-flex flex-wrap">
                <a href="#" class="me-4 text-light"
                  ><i class="fas fa-map-marker-alt text-white me-2"></i
                  >Vicerrectorado Investigación, Vinculación y Posgrado, Nuevos
                  Horizontes, Esmeraldas, Ecuador</a
                >
                <a href="#" class="me-4 text-light"
                  ><i class="fas fa-phone-alt text-white me-1"></i
                  >+01234567890</a
                >
                <a href="#" class="text-light"
                  ><i class="fas fa-envelope text-white me-2"></i
                  >Example@gmail.com</a
                >
              </div>
            </div>
            <div class="col-lg-2">
              <div class="d-flex align-items-center justify-content-end">
                <a
                  href="#"
                  class="btn btn-light btn-square border rounded-circle nav-fill me-3"
                  ><i class="fab fa-facebook-f"></i
                ></a>
                <a
                  href="#"
                  class="btn btn-light btn-square border rounded-circle nav-fill me-3"
                  ><i class="fab fa-twitter"></i
                ></a>
                <a
                  href="#"
                  class="btn btn-light btn-square border rounded-circle nav-fill me-3"
                  ><i class="fab fa-instagram"></i
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-xl">
          <a href="index.html" class="navbar-brand">
            <img src="@/assets/img/img/log2.gif" class="img-fluid" height="350px" width="350px" alt="UTELVT"/>
          </a>
          <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars text-primary"></span>
          </button>
          <div class="collapse navbar-collapse py-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto border-top">
              <a href="index.html" class="nav-item nav-link active inicio">Inicio</a>
              <a href="noticias.html" class="nav-item nav-link noticias">Noticias</a>
              <a href="equipo.html" class="nav-item nav-link equipo">Conoce Nuestro Equipo</a>
              <a href="#" class="nav-item nav-link normativas">Normativas</a>
              <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle proyectos" data-bs-toggle="dropdown">Proyectos de Vinculacion</a>
                <div class="dropdown-menu m-0 rounded-0">
                  <a href="2020-2025.html" class="dropdown-item 2020">2020-2025</a>
                  <a href="antiguos.html" class="dropdown-item antiguos">Antiguos</a>
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
                <button
                  href="##"
                  class="nav-user-btn dropdown-btn"
                  title="My profile"
                  type="button"
                >
                  <span class="sr-only">My profile</span>
                  <span class="nav-user-img">
                    <picture
                      ><source
                        srcset="@/assets/img/img/avatar/avatar-illustrated-02.webp"
                        type="image/webp" />
                      <img
                        src="@/assets/img/img/avatar/avatar-illustrated-02.png" class="img-fluid"
                        alt="User name"
                    /></picture>
                  </span>
                </button>
               
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <div>
      <router-view/>
    </div>
</template>

<style>
@import url('@/assets/styles/css/style.css');
</style>
