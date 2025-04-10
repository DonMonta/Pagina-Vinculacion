<template>
  <div class="container-fluid sticky-top px-0">
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
              <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i
                  class="fab fa-facebook-f"></i></a>
              <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i
                  class="fab fa-twitter"></i></a>
              <a href="#" class="btn btn-light btn-square border rounded-circle nav-fill me-3"><i
                  class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
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
            <a href="index.html" class="nav-item nav-link active inicio">Inicio</a>
            <a href="noticias.html" class="nav-item nav-link noticias">Noticias</a>
            <a href="equipo.html" class="nav-item nav-link equipo">Conoce Nuestro Equipo</a>
            <a href="#" class="nav-item nav-link normativas">Normativas</a>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle proyectos" data-bs-toggle="dropdown">Proyectos de
                Vinculacion</a>
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
  <div>
    <router-view />
  </div>
  <footer>
    <!-- Footer Start -->
    <div class="container-fluid footer border-1 py-5">
      <div class="container py-5">
        <div class="row g-5">
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item">
              <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid" height="350px" width="350px" alt="UTELVT" />
              <div class="position-relative mx-auto rounded-pill">
                <input class="form-control rounded-pill border-1 w-100 py-3 ps-4 pe-5" type="text"
                  placeholder="Enter your email">
                <button type="button"
                  class="btn btn-primary btn-primary-outline-0 rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="footer-item d-flex flex-column">

              <a href="index.html"><i class="fas fa-angle-right me-2"></i> Inicio</a>
              <a href="noticias.html"><i class="fas fa-angle-right me-2"></i> Noticias</a>
              <a href="equipo.html"><i class="fas fa-angle-right me-2"></i> Conoce Nuestro Equipo</a>
              <a href=""><i class="fas fa-angle-right me-2"></i> Normativas</a>
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



    <!-- Copyright Start -->
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
            <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
            <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
            <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->

          </div>
        </div>
      </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square rounded-circle back-to-top"><i
        class="fa fa-arrow-up"></i></a>

  </footer>
</template>

<style>
@import url('@/assets/styles/css/style.css');
</style>
