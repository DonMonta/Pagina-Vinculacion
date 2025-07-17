<template>
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Services Start -->
    <div class="container-fluid services py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 800px;">
                <p class="fs-4 text-uppercase text-center text-primary">Conoce</p>
                <h1 class="display-3">Últimas Novedades y Noticias</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6" v-if="publicacionPrincipal">
                    <div class="services-item bg-light border-4 border-end border-primary rounded p-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="services-content text-end">
                                    <h3>Publicado {{ formatearFechaInteligente(publicacionPrincipal.created_time) }}</h3>
                                    <p>{{ estadisticas?.titulo || truncateText(publicacionPrincipal.message, 280) }}</p>
                                    <a :href="publicacionPrincipal.permalink_url" target="_blank" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver
                                        Más</a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="services-img d-flex align-items-center justify-content-center rounded">
                                    <img :src="publicacionPrincipal.full_picture" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" v-if="publicacionsecundaria">
                    <div class="services-item bg-light border-4 border-start border-primary rounded p-4">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="services-img d-flex align-items-center justify-content-center rounded">
                                    <img :src="publicacionsecundaria.full_picture" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="services-content text-start">
                                    <h3>Publicado {{ formatearFechaInteligente(publicacionsecundaria.created_time) }}</h3>
                                    <p>{{ estadisticas?.titulo || truncateText(publicacionsecundaria.message, 250) }}</p>
                                    <a :href="publicacionsecundaria.permalink_url" target="_blank" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver
                                        Más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" v-if="publicaciontercera">
                    <div class="services-item bg-light border-4 border-end border-primary rounded p-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="services-content text-end">
                                    <h3>Publicado {{ formatearFechaInteligente(publicaciontercera.created_time) }}</h3>
                                    <p>{{ estadisticas?.titulo || truncateText(publicaciontercera.message, 250) }}</p>
                                    <a :href="publicaciontercera.permalink_url" target="_blank" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver
                                        Más</a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="services-img d-flex align-items-center justify-content-center rounded">
                                    <img :src="publicaciontercera.full_picture" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" v-if="publiacioncuarta">
                    <div class="services-item bg-light border-4 border-start border-primary rounded p-4">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="services-img d-flex align-items-center justify-content-center rounded">
                                    <img :src="publiacioncuarta.full_picture" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="services-content text-start">
                                    <h3>Publicado {{ formatearFechaInteligente(publiacioncuarta.created_time) }}</h3>
                                    <p>{{ estadisticas?.titulo || truncateText(publiacioncuarta.message, 250) }}</p>
                                    <a :href="publiacioncuarta.permalink_url" target="_blank" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver
                                        Más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" v-if="publiacionquinta">
                    <div class="services-item bg-light border-4 border-end border-primary rounded p-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="services-content text-end">
                                    <h3>Publicado {{ formatearFechaInteligente(publiacionquinta.created_time) }}</h3>
                                    <p>{{ estadisticas?.titulo || truncateText(publiacionquinta.message, 250) }}</p>
                                    <a :href="publiacioncuarta.permalink_url" target="_blank"  class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver
                                        Más</a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="services-img d-flex align-items-center justify-content-center rounded">
                                    <img :src="publiacionquinta.full_picture" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" v-if="publiacionsexta">
                    <div class="services-item bg-light border-4 border-start border-primary rounded p-4">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="services-img d-flex align-items-center justify-content-center rounded">
                                    <img :src="publiacionsexta.full_picture" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="services-content text-start">
                                     <h3>Publicado {{ formatearFechaInteligente(publiacionsexta.created_time) }}</h3>
                                    <p>{{ estadisticas?.titulo || truncateText(publiacionsexta.message, 250) }}</p>
                                    <a :href="publiacioncuarta.permalink_url" target="_blank" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver
                                        Más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" v-if="publiacionseptima">
                    <div class="services-item bg-light border-4 border-end border-primary rounded p-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <div class="services-content text-end">
                                    <h3>Publicado {{ formatearFechaInteligente(publiacionseptima.created_time) }}</h3>
                                    <p>{{ estadisticas?.titulo || truncateText(publiacionseptima.message, 250) }}</p>
                                    <a :href="publiacionseptima.permalink_url" target="_blank" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver
                                        Más</a>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="services-img d-flex align-items-center justify-content-center rounded">
                                    <img :src="publiacionseptima.full_picture"  class="img-fluid rounded" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" v-if="publiacionoctava">
                    <div class="services-item bg-light border-4 border-start border-primary rounded p-4">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <div class="services-img d-flex align-items-center justify-content-center rounded">
                                    <img :src="publiacionoctava.full_picture" class="img-fluid rounded" alt="">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="services-content text-start">
                                    <h3>Publicado {{ formatearFechaInteligente(publiacionoctava.created_time) }}</h3>
                                    <p>{{ estadisticas?.titulo || truncateText(publiacionoctava.message, 250) }}</p>
                                    <a :href="publiacionoctava.permalink_url" target="_blank" class="btn btn-primary btn-primary-outline-0 rounded-pill py-2 px-4">Ver
                                        Más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="services-btn text-center">
                        <router-link :to="{ path: '/noticias'}" class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5 noticias">Ver
                            Todas las Noticias</router-link>
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
                            <img src="@/assets/img/img/avatar/belen.png" class="img-fluid w-100 rounded-top bg-light"
                                alt="">
                        </div>
                        <div class="team-text rounded-bottom text-center p-4">
                            <h3 class="text-white">Dra. Belén Amador Rodríguez, PhD</h3>
                            <p class="mb-0 text-white">Director de Vinculación con la Sociedad</p>
                        </div>
                        <div class="team-social">
                            <a class="btn btn-light btn-light-outline-0 rounded-circle mb-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-light btn-light-outline-0 rounded-circle mb-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-light btn-light-outline-0 rounded-circle mb-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-light btn-light-outline-0 rounded-circle" href="#"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="team-item">
                        <div class="team-img rounded-top">
                            <img src="@/assets/img/img/logovincusinfondo.png"
                                class="img-fluid w-95 align-items-center rounded-top bg-light" alt="" width="230px">
                        </div>
                        <div class="team-text rounded-bottom text-center p-4">
                            <h3 class="text-white">Name</h3>
                            <p class="mb-0 text-white">------------</p>
                        </div>
                        <div class="team-social">
                            <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-light btn-light-outline-0  rounded-circle" href="#"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="team-item">
                        <div class="team-img rounded-top">
                            <img src="@/assets/img/img/logovincusinfondo.png"
                                class="img-fluid w-96 rounded-top bg-light" alt="" width="250px">
                        </div>
                        <div class="team-text rounded-bottom text-center p-4">
                            <h3 class="text-white">Name </h3>
                            <p class="mb-0 text-white">----------</p>
                        </div>
                        <div class="team-social">
                            <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-light btn-light-outline-0  rounded-circle" href="#"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="team-item">
                        <div class="team-img rounded-top">
                            <img src="@/assets/img/img/logovincusinfondo.png"
                                class="img-fluid w-96 rounded-top bg-light" alt="" width="242px">
                        </div>
                        <div class="team-text rounded-bottom text-center p-4">
                            <h3 class="text-white">Name</h3>
                            <p class="mb-0 text-white"> ----------------</p>
                        </div>
                        <div class="team-social">
                            <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-light btn-light-outline-0  rounded-circle mb-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-light btn-light-outline-0  rounded-circle" href="#"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <a class="btn btn-light btn-light-outline-0 rounded-pill py-3 px-5 me-4 leer" href="#">Ver más
                        Información sobre nuestro Equipo</a>
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
                        <iframe class="rounded-top w-100" style="height: 450px; margin-bottom: -6px;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.467687507572!2d-79.6711511987359!3d0.9739060997482285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fd4bc1a30135aa3%3A0xe28151571fb3e66d!2sTechnical%20University%20Luis%20Vargas%20Torres%20Esmeraldas!5e0!3m2!1sen!2sbd!4v1694261157793!5m2!1sen!2sbd"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class=" text-center p-4 rounded-bottom bg-white">
                        <h4 class="text-black fw-bold ">Síguenos</h4>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="#" class="btn btn-light btn-light-outline-0  rounded-circle me-3"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn btn-light btn-light-outline-0  rounded-circle me-3"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-light btn-light-outline-0  rounded-circle me-3"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-light btn-light-outline-0  rounded-circle"><i
                                    class="fab fa-linkedin-in"></i></a>
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
import script3 from '@/assets/scripts/js/noticias.js'
export default {
    mixins: [script2, script3],
    name: 'index',

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
