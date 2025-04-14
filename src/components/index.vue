<template>
  <!-- Carousel Start -->
  <div class="container-fluid carousel-header px-0">
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
  <!-- Services Start -->
  <div class="container-fluid services py-5">
      <div class="container py-5">
          <div class="mx-auto text-center mb-5" style="max-width: 800px;">
              <p class="fs-4 text-uppercase text-center text-primary">Conoce</p>
              <h1 class="display-3">Últimas Novedades y Noticias</h1>
          </div>
          <div class="row g-4">
              <div class="col-lg-6">
                  <div class="services-item bg-light border-4 border-end border-primary rounded p-4">
                      <div class="row align-items-center">
                          <div class="col-8">
                              <div class="services-content text-end">
                                  <h3>Noticia 1</h3>
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                  <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver Más</a>
                              </div>
                          </div>
                          <div class="col-4">
                              <div class="services-img d-flex align-items-center justify-content-center rounded">
                                  <img src="@/assets/img/img/logovincu.jpeg" class="img-fluid rounded" alt="">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="services-item bg-light border-4 border-start border-primary rounded p-4">
                      <div class="row align-items-center">
                          <div class="col-4">
                              <div class="services-img d-flex align-items-center justify-content-center rounded">
                                  <img src="@/assets/img/img/logovincu.jpeg" class="img-fluid rounded" alt="">
                              </div>
                          </div>
                          <div class="col-8">
                              <div class="services-content text-start">
                                  <h3>Noticia 2</h3>
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                  <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver Más</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="services-item bg-light border-4 border-end border-primary rounded p-4">
                      <div class="row align-items-center">
                          <div class="col-8">
                              <div class="services-content text-end">
                                  <h3>Noticia 3</h3>
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                  <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver Más</a>
                              </div>
                          </div>
                          <div class="col-4">
                              <div class="services-img d-flex align-items-center justify-content-center rounded">
                                  <img src="@/assets/img/img/logovincu.jpeg" class="img-fluid rounded" alt="">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="services-item bg-light border-4 border-start border-primary rounded p-4">
                      <div class="row align-items-center">
                          <div class="col-4">
                              <div class="services-img d-flex align-items-center justify-content-center rounded">
                                  <img src="@/assets/img/img/logovincu.jpeg" class="img-fluid rounded" alt="">
                              </div>
                          </div>
                          <div class="col-8">
                              <div class="services-content text-start">
                                  <h3>Noticia 4</h3>
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                  <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver Más</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="services-item bg-light border-4 border-end border-primary rounded p-4">
                      <div class="row align-items-center">
                          <div class="col-8">
                              <div class="services-content text-end">
                                  <h3>Noticia 5</h3>
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                  <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver Más</a>
                              </div>
                          </div>
                          <div class="col-4">
                              <div class="services-img d-flex align-items-center justify-content-center rounded">
                                  <img src="@/assets/img/img/logovincu.jpeg" class="img-fluid rounded" alt="">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="services-item bg-light border-4 border-start border-primary rounded p-4">
                      <div class="row align-items-center">
                          <div class="col-4">
                              <div class="services-img d-flex align-items-center justify-content-center rounded">
                                  <img src="@/assets/img/img/logovincu.jpeg" class="img-fluid rounded" alt="">
                              </div>
                          </div>
                          <div class="col-8">
                              <div class="services-content text-start">
                                  <h3>Noticia 6</h3>
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                  <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver Más</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="services-item bg-light border-4 border-end border-primary rounded p-4">
                      <div class="row align-items-center">
                          <div class="col-8">
                              <div class="services-content text-end">
                                  <h3>Noticia 7</h3>
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                  <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver Más</a>
                              </div>
                          </div>
                          <div class="col-4">
                              <div class="services-img d-flex align-items-center justify-content-center rounded">
                                  <img src="@/assets/img/img/logovincu.jpeg" class="img-fluid rounded" alt="">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="services-item bg-light border-4 border-start border-primary rounded p-4">
                      <div class="row align-items-center">
                          <div class="col-4">
                              <div class="services-img d-flex align-items-center justify-content-center rounded">
                                  <img src="@/assets/img/img/logovincu.jpeg" class="img-fluid rounded" alt="">
                              </div>
                          </div>
                          <div class="col-8">
                              <div class="services-content text-start">
                                  <h3>Noticia 8</h3>
                                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                                  <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver Más</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12">
                  <div class="services-btn text-center">
                      <a href="noticias.html" class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5">Ver Todas las Noticias</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
<!-- Services End -->
<!-- Team Start -->
  <div class="container-fluid team py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5" style="max-width: 800px;">
            <p class="fs-4 text-uppercase text-primary">Te Presentamos a</p>
            <h1 class="display-4 mb-4">Nuestro Equipo de Trabajo</h1>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="team-item">
                    <div class="team-img rounded-top">
                        <img src="@/assets/img/img/avatar/belen.png" class="img-fluid w-100 rounded-top bg-light" alt="">
                    </div>
                    <div class="team-text rounded-bottom text-center p-4">
                        <h3 class="text-white">Dra. Belén Amador Rodríguez, PhD</h3>
                        <p class="mb-0 text-white">Director de Vinculación con la Sociedad</p>
                    </div>
                    <div class="team-social">
                        <a class="btn btn-light btn-light-outline-0 rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-light btn-light-outline-0 rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-light btn-light-outline-0 rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-light btn-light-outline-0 rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="team-item">
                    <div class="team-img rounded-top">
                        <img src="@/assets/img/img/avatar/miriam.png" class="img-fluid w-95 align-items-center rounded-top bg-light" alt="" width="230px">
                    </div>
                    <div class="team-text rounded-bottom text-center p-4">
                        <h3 class="text-white">Ing. Miriam Ivonne Solarte Sevillano</h3>
                        <p class="mb-0 text-white">Secretaria Técnica de Vinculación con la Sociedad</p>
                    </div>
                    <div class="team-social">
                        <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-light btn-light-outline-0  rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="team-item">
                    <div class="team-img rounded-top">
                        <img src="@/assets/img/img/avatar/benjamin.jpg" class="img-fluid w-96 rounded-top bg-light" alt="" width="250px">
                    </div>
                    <div class="team-text rounded-bottom text-center p-4">
                        <h3 class="text-white">Lcdo. Benjamín Abata </h3>
                        <p class="mb-0 text-white">Analista de Proyectos de Vinculación</p>
                    </div>
                    <div class="team-social">
                        <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-light btn-light-outline-0  rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="team-item">
                    <div class="team-img rounded-top">
                        <img src="@/assets/img/img/avatar/lucia.jpg" class="img-fluid w-96 rounded-top bg-light" alt="" width="242px">
                    </div>
                    <div class="team-text rounded-bottom text-center p-4">
                        <h3 class="text-white">Psi. Lucia Vernaza</h3>
                        <p class="mb-0 text-white"> Analista de Servicio a la Sociedad</p>
                    </div>
                    <div class="team-social">
                        <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-light btn-light-outline-0  rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4 leer" href="#">Ver más Información sobre nuestro Equipo</a>
              </div>
        </div>
    </div>
  </div>
  <!-- Team End -->
   <!-- Contact Start -->
   <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-12">
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <div class="d-inline-flex bg-light w-100 border border-primary p-4 rounded">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Dirección</h4>
                                    <p class="mb-0">Vicerrectorado Investigación, Vinculación y Posgrado, Nuevos
                                        Horizontes, Esmeraldas, Ecuador</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-inline-flex bg-light w-100 border border-primary p-4 rounded">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>E-mail</h4>
                                    <p class="mb-0">info@example.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="d-inline-flex bg-light w-100 border border-primary p-4 rounded">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Telephone</h4>
                                    <p class="mb-0">(+012) 3456 7890 123</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="rounded">
                        <iframe class="rounded-top w-100" 
                        style="height: 450px; margin-bottom: -6px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.467687507572!2d-79.6711511987359!3d0.9739060997482285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fd4bc1a30135aa3%3A0xe28151571fb3e66d!2sTechnical%20University%20Luis%20Vargas%20Torres%20Esmeraldas!5e0!3m2!1sen!2sbd!4v1694261157793!5m2!1sen!2sbd" 
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class=" text-center p-4 rounded-bottom bg-white">
                        <h4 class="text-black fw-bold ">Síguenos</h4>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="#" class="btn btn-light btn-light-outline-0  rounded-circle me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-light btn-light-outline-0  rounded-circle me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-light btn-light-outline-0  rounded-circle me-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-light btn-light-outline-0  rounded-circle"><i class="fab fa-linkedin-in"></i></a>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
</template>

<script>
import 'owl.carousel';
import script2 from '@/assets/scripts/js/main.js'
export default {
    mixins: [script2],
  name: 'index',
  
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
