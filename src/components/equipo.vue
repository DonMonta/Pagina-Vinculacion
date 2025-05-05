<template>
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <div class="container-fluid services py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 800px;">
                <h1 class="display-3">Nuestro Equipo de Trabajo</h1>
            </div>

        </div>
    </div>
    <!-- About Start -->
    <div class="container-fluid about  py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-5">
                    <div class="h-100">
                        <img src="@/assets/img/img/avatar/belen.png" class="img-fluid w-100 h-100" alt="Image">
                    </div>
                </div>
                <div class="col-xl-7">
                    <h5 class="text-uppercase text-primary">Conoce a</h5>
                    <h1 class="mb-4">Dra. Belén Amador Rodríguez, PhD</h1>
                    <p class="fs-5 mb-4">Ella es la Directora de la Dirección de Vinculación con la Sociedad Actualmente
                    </p>
                    <div class="tab-class p-4">
                        <ul class="nav d-flex mb-2">
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 text-center bg-white active" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark" style="width: 150px;">Funciones</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="text-start my-auto">
                                                <h5 class="text-uppercase mb-3">Funciones Que Realiza</h5>
                                                <p class="mb-4">Proponer las políticas, planes y programas actualizados
                                                    sobre la vinculación con la sociedad al Vicerrectorado de
                                                    lnvestigación, innovación y posgrado para análisis y estudio en
                                                    Consejo Superior Universitario;
                                                </p>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#funcionesModal1">Ver Todas las Funciones</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Equipo Start -->
    <div class="container-fluid packages py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Nuestro</h5>
                <h1 class="mb-0">Equipo de Trabajo y Estructura Orgánica y Funcional</h1>
            </div>
            <div class="packages-carousel owl-carousel">
                <div class="packages-item">
                    <div class="packages-img">
                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100 rounded-top"
                            alt="Image">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-map-marker-alt me-2"></i>Esmeraldas - Ecuador</small>
                        </div>
                        <div class="packages-price py-2 px-4 text-center"><i class="fa fa-user me-2"></i></div>
                    </div>
                    <div class="packages-content ">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">Nombre: </h5>
                            <small class="text-uppercase">Cargo: Analista de proyectos de vinculación</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p class="mb-4">Es el o la profesional responsable del
                                monitoreo y evaluación de los proyectos de vinculación de la UTLVTE</p>
                        </div>
                        <div class="row rounded-bottom mx-0 boton">
                            <div class="col-6 text-start px-0">
                                <a class="btn-hover btn text-white py-2 px-4" href="#" data-bs-toggle="modal"
                                    data-bs-target="#funcionesModal2">Ver funciones</a>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="packages-item">
                    <div class="packages-img">
                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100 rounded-top"
                            alt="Image">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-map-marker-alt me-2"></i>Esmeraldas - Ecuador</small>
                        </div>
                        <div class="packages-price py-2 px-4 text-center"><i class="fa fa-user me-2"></i></div>
                    </div>
                    <div class="packages-content bg-light">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">Nombre: </h5>
                            <small class="text-uppercase">Cargo: Analista de prácticas preprofesionales</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p class="mb-4">Es el (la) profesional encargado (a) de
                                coordinar acciones para el cumplimiento de las prácticas pre profesionales</p>
                        </div>
                        <div class="row rounded-bottom mx-0 boton">
                            <div class="col-6 text-start px-0">
                                <a class="btn-hover btn text-white py-2 px-4" href="#" data-bs-toggle="modal"
                                    data-bs-target="#funcionesModal3">Ver funciones</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="packages-item">
                    <div class="packages-img">
                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100 rounded-top"
                            alt="Image">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-map-marker-alt me-2"></i>Esmeraldas - Ecuador</small>
                        </div>
                        <div class="packages-price py-2 px-4 text-center"><i class="fa fa-user me-2"></i></div>
                    </div>
                    <div class="packages-content bg-light">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">Nombre: </h5>
                            <small class="text-uppercase">Cargo: Analista de servicio a la sociedad</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p class="mb-4">Es el o la profesional responsable de la
                                ejecución de las actividades de servicio a la sociedad</p>
                        </div>
                        <div class="row rounded-bottom mx-0 boton">
                            <div class="col-6 text-start px-0">
                                <a class="btn-hover btn text-white py-2 px-4" href="#" data-bs-toggle="modal"
                                    data-bs-target="#funcionesModal4">Ver funciones</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="packages-item">
                    <div class="packages-img">
                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100 rounded-top"
                            alt="Image">
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2"><i
                                    class="fa fa-map-marker-alt me-2"></i>Esmeraldas - Ecuador</small>
                        </div>
                        <div class="packages-price py-2 px-4 text-center"><i class="fa fa-user me-2"></i></div>
                    </div>
                    <div class="packages-content bg-light">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">Nombre: </h5>
                            <small class="text-uppercase">Cargo: Secretaría de Vinculación</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                        </div>
                        <div class="row rounded-bottom mx-0 boton">
                            <div class="col-6 text-start px-0">
                                <a class="btn-hover btn text-white py-2 px-4" href="#" data-bs-toggle="modal"
                                    data-bs-target="#funcionesModal5">Ver funciones</a>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Equipo Start -->
    <!-- About End -->
    <!-- Responsables Start -->
    <div class="container-fluid event py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Responsables de­­­­ Vinculación de las Facultades</h5>
                <p class="mb-4">Es el o la Profesora Titular que
                    será designado(a) por el Vicerrector(a) de Investigación, Vinculación y Posgrado de una
                    terna enviada por la o el Decano(a) de la Facultad respectiva; tendrá como responsabilidad
                    la planificación, ejecución, seguimiento y control de las actividades de Vinculación con la
                    Sociedad que..... <a class="text-secondary" @click="openPdfModal(20)">Leer Más</a>
                </p>
                <h1 class="mb-0">Conoce a los Responsables de­­­­ Vinculación de las Facultades de la UTLVTE</h1>
            </div>
            <div class="event-carousel owl-carousel">
                <div class="event-item">
                    <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100" alt="Image">
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Esmeraldas-Ecuador</span>
                            <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                        </div>
                        <h4 class="mb-4">Ing. Gladys Macas Giler, Magister</h4>
                        <p class="mb-4">FACULTAD DE CIENCIAS AGROPECUARIAS - FACAP</p>
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal"
                            data-bs-target="#funcionesModal6">Ver Más Información </a>
                    </div>
                </div>
                <div class="event-item">
                    <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100" alt="Image">
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Esmeraldas-Ecuador</span>
                            <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                        </div>
                        <h4 class="mb-4">Dra. Luz Marina Cifuentes Quiñónez, Magister</h4>
                        <p class="mb-4"> FACULTAD DE CIENCIAS ADMINISTRATIVAS Y ECONÓMICAS - FACAE</p>
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal"
                            data-bs-target="#funcionesModal7">Ver Más Información</a>
                    </div>
                </div>
                <div class="event-item">
                    <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100" alt="Image">
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Esmeraldas-Ecuador</span>
                            <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                        </div>
                        <h4 class="mb-4">Lcda. Ana Bedoya Gutiérrez, Magister</h4>
                        <p class="mb-4">FACULTAD DE LA PEDAGOGÍA - FACPED</p>
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal"
                            data-bs-target="#funcionesModal8">Ver Más Información</a>
                    </div>
                </div>
                <div class="event-item">
                    <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100" alt="Image">
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Esmeraldas-Ecuador</span>
                            <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                        </div>
                        <h4 class="mb-4">Lcda. Mariuxi de los Angeles Rodríguez Enriquez, Magister</h4>
                        <p class="mb-4">FACULTAD DE CIENCIAS SOCIALES Y DE SERVICIOS - FACSOS</p>
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal"
                            data-bs-target="#funcionesModal9">Ver Más Información</a>
                    </div>
                </div>
                <div class="event-item">
                    <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100" alt="Image">
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Esmeraldas-Ecuador</span>
                            <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                        </div>
                        <h4 class="mb-4">Ing. Marco Vinicio Navarrete Villavicencio, Magister</h4>
                        <p class="mb-4">FACULTAD DE INGENIERÍAS - FACI</p>
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal"
                            data-bs-target="#funcionesModal10">Ver Más Información</a>
                    </div>
                </div>
                <div class="event-item">
                    <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100" alt="Image">
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Esmeraldas-Ecuador</span>
                            <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>10 Feb, 2023</span>
                        </div>
                        <h4 class="mb-4">Ing. Félix Lenin Preciado, Magister</h4>
                        <p class="mb-4">SEDE LA CONCORDIA</p>
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal"
                            data-bs-target="#funcionesModal11">Ver Más Información</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Responsables End -->


    <!-- Directores Section -->
    <section id="doctors" class="doctors section container-fluid event py-5 wow fadeInUp" data-wow-delay="0.1s">

        <!-- Section Title -->
        <div class="container section-title text-center" data-aos="fade-up">
            <h5 class="text-uppercase text-primary">Directores de Carreras</h5>
            <p class="mb-4">Tendrá como compromiso el seguimiento a las
                actividades de Vinculación con la Sociedad que se realicen desde la Carrera que dirige. El o
                la directora(a) de Carrera elaborará un informe semestral de las actividades de Vinculación
                con la Sociedad que se desarrollen en la carrera..... <a class="text-secondary"
                    @click="openPdfModal(20)">Leer Más</a>
            </p>
            <h1 class="mb-0">Conoce a los Directores de Carreras de la UTLVTE</h1>
        </div><!-- End Section Title -->

        <div class="container-fluid event py-5  ">

            <div class="row gy-4">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Walter White</h4>
                            <span>Chief Medical Officer</span>
                            <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>

                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Sarah Jhonson</h4>
                            <span>Anesthesiologist</span>
                            <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>

                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>William Anderson</h4>
                            <span>Cardiology</span>
                            <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>

                        </div>
                    </div>
                </div><!-- End Team Member -->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic"><img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>Amanda Jepson</h4>
                            <span>Neurosurgeon</span>
                            <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>

                        </div>
                    </div>
                </div><!-- End Team Member -->

            </div>

        </div>

    </section><!-- /Directores Section -->


    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true"
        ref="pdfModal">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Reglamento de Vinculación con la Sociedad Reformado</h5>
                    <button type="button" class="btn-close" @click="closePdfModal()"></button>
                </div>
                <div class="modal-body p-0">
                    <!-- Iframe con el PDF -->
                    <object :data="`${pdfUrl}#page=${pdfPage}`" type="application/pdf" width="100%" height="600">
                        <p>
                            Tu navegador no soporta PDFs embebidos.
                            <a :href="`${pdfUrl}#page=${pdfPage}`" target="_blank" rel="noopener">
                                Ábrelo aquí
                            </a>.
                        </p>
                    </object>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="funcionesModal1" tabindex="-1" aria-labelledby="funcionesModal1Label"
        aria-hidden="true">
        <div class="modal-dialog custom-modal modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal1Label">
                        Director(a) de Vinculación con la Sociedad
                    </h5>

                </div>
                <div class="modal-body">
                    <div class="col-12 col-lg-12">
                        <div class="header-img d-flex h-100 pt-6 ps-6 pb-6">
                            <div class="row g-5">
                                <div class="col-xl-6">
                                    <div class="bg-light p-4 position-relative h-100"
                                        style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;">
                                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100"
                                            style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;" alt="Image">

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="display-6 mb-4">Dra. Belén Amador Rodríguez, PhD</h1>
                                    <p class="mb-4">Directora de Vinculación con la Sociedad desde octubre de 2023.
                                        Durante la gestión actual ha implementado nuevas actividades alineadas con
                                        los
                                        estándares del nuevo modelo de evaluación de universidades.

                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">Nuevos Horizontes, Esmeraldas Ecuador</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <p class="text-dark mb-0">luz.cifuentes@utelvt.edu.ec</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">189(06) - 2991770 </p>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="fab fa-firefox-browser text-primary me-3"></i>
                                        <p class="text-dark mb-0">utelvt.edu.ec</p>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="container section-title py-5">
                        <h2>Actividades realizadas durante el periodo de trabajo</h2>
                        <p>Estas son las Actividades realizadas durante el periodo de trabajo de la Dra. Belén Amador
                            Rodríguez, PhD </p>
                    </div>
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Reforma al Reglamento Interno de Vinculación con la Sociedad.
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Ejecución presupuestaria Proyectos de Vinculación con la Sociedad 2021-2024
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Cierre de Proyectos de Vinculación con la Sociedad 2021-2024
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Evento de cierre de Proyectos de Vinculación con la Sociedad 2021-2024.
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Convocatoria de Proyectos de Vinculación con la Sociedad 2024-2029.
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Aprobación de Proyectos de Vinculación con la Sociedad 2024- 2029
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Evento de graduados y graduadas de la UTLVTE.
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Creación de la Bolsa de Empleo
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Concurso de ponencias de Vinculación con la Sociedad destinado a estudiantes
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Doce estudiantes, ganadores y ganadoras del concurso de ponencias de vinculación
                                    con la sociedad, han participado como ponentes en Congresos Internacionales. Su
                                    participación ha sido financiada al 100% por esta Dirección
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Dos estudiantes, ganadores del concurso de ponencias de vinculación con la
                                    sociedad, han asistido en modalidad virtual a un Congreso Internacional. Su
                                    participación ha sido financiada al 100% por esta Dirección.
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Concurso de movilidad internacional estudiantil.
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Cuatro estudiantes han realizado una estancia académica internacional. Su
                                    participación ha sido financiada al 100% por esta Dirección.
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Financiación de proyectos de vinculación con la sociedad 2024-2029
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Compromiso con Grupos Históricamente Excluidos (GHE)
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Gestión para la constitución de la Mesa de Cambio Climático en Esmeraldas
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Difusión de resultados de vinculación con la sociedad de la UTLVTE a nivel
                                    científico desde la Dirección de Vinculación con la Sociedad mediante la
                                    participación como ponente de la directora en la Semana de la Vinculación con la
                                    Sociedad organizada por la Universidad Internacional del Ecuador (UIDE).
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Formación en oratoria y expresión en público a las mujeres policías de Esmeraldas
                                    impartida por la Dirección de Vinculación con la Sociedad.
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Elaboración, en coordinación con el Vicerrectorado Académico, del Reglamento de
                                    Educación Continua.
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Participación en el evento Educación para la Paz. Se gestionó el aval con el
                                    Vicerrectorado Académico, la participación de la UTLVTE como sede y la
                                    participación del estudiantado de FACPED, como asistente y como organizador, ya
                                    que un centenar de estudiantes hicieron sus prácticas de servicio comunitario a
                                    través de esta actividad
                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Apoyo a la Feria de Emprendimiento impulsada por el Ministerio de Producción.
                                    Se participó en la organización de esta actividad, la cual se desarrolló en el Salón
                                    Azul, y contó entre sus participantes con emprendedores y emprendedoras de la
                                    UTLVTE.

                                </p>
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fas fa-splotch fa-2x text-primary"></i>
                                </div>
                                <p><i class="fa fa-check text-primary me-3"></i>
                                    Participación en el Día Internacional de las Personas con Discapacidad. Un evento
                                    en el que se participó junto a Bienestar Universitario para dar a conocer los
                                    resultados del trabajo de la UTLVTE en atención a las personas con diversidad
                                    funcional y cómo los proyectos de vinculación con la sociedad ayudan a mejorar las
                                    condiciones de vida de estas personas.

                                </p>
                            </div>


                        </div>

                    </div>
                    <div class="container section-title py-5">
                        <h2>Funciones del Director(a) de Vinculación con la Sociedad</h2>
                        <p>Las funciones del Director(a) de Vinculación con la Sociedad son las siguientes:</p>
                    </div>
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Proponer las políticas, planes y programas actualizados sobre la
                                Vinculación con la
                                Sociedad al Vicerrectorado de Investigación, Vinculación y Posgrado
                                para análisis y
                                estudio en Consejo Superior Universitario.
                            </div>
                            <img class="rounded-circle novige mb-3" height="200" width="230"
                                src="@/assets/img/img/icno/politica.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Fortalecer los canales de comunicación con la sociedad para
                                apoyar y afianzar las
                                relaciones de servicio y vinculación con sus sectores.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/fortalecer.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Ejecutar el Plan Institucional de Vinculación con la Sociedad
                                debidamente articulado
                                con la formación e investigación.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/ejecutar.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Coordinar la vinculación específica con la sociedad con
                                Vicerrectorado de
                                Investigación, Vinculación y Posgrados, Vicerrectorado Académico,
                                Decanatos,
                                Direcciones de Carrera y Responsables de Vinculación de Facultades.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/coordinar.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Realizar programas y cursos de Vinculación con la Sociedad
                                guiados por el personal
                                académico de la institución.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/cursos.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Proponer estrategias para medir el impacto positivo de la vida
                                académica de la
                                Universidad Técnica "Luis Vargas Torres" de Esmeraldas en la
                                sociedad.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/estrategias.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Proponer políticas para fortalecer y diversificar la vinculación
                                con los y las diferentes
                                agentes de la producción, con organismos no gubernamentales y con
                                prestigiosas
                                Universidades o Escuelas Politécnicas nacionales o internacionales.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/g.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Coordinar con Vicerrectorado Académico el diseño y ejecución de
                                los diferentes
                                programas de prácticas y pasantías pre profesionales y de servicio a
                                la comunidad
                                en los ámbitos urbano y rural, según las propias características de
                                las carreras y las
                                necesidades de la sociedad
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/h.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Velar por la adecuada difusión de las actividades de vinculación,
                                conjuntamente con
                                el Vicerrector de Investigación, Vinculación y Posgrados.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/i.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Participar con voz y voto en las sesiones de la Comisión de
                                Vinculación con la Sociedad.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/j.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                k. Elaborar el informe anual de actividades y ponerlo a
                                consideración del Vicerrectorado
                                de Investigación, Vinculación y Posgrados

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/k.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                l. Realizar reuniones mensuales con los responsables de Vinculación
                                de Facultades e
                                integrantes de la Dirección de Vinculación con la Sociedad.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/l.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                m. Realizar seguimiento a las actividades que ejecutan todos y todas
                                las integrantes
                                internas y externas de la Dirección de Vinculación con la Sociedad.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/m.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                n. Informar al Vicerrectorado de Investigación, Vinculación y
                                Posgrado las actividades,
                                resultados y logros derivados de los procesos de Vinculación con la
                                Sociedad para el
                                posterior análisis y aprobación del Consejo Superior Universitario.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/n.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                o. Las demás actividades que le asigne el Rector o Rectora,
                                Vicerrectorado de
                                Investigación, Vinculación y Posgrado, Consejo Superior
                                Universitario, de
                                conformidad al estatuto de la UTLVTE.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/o.png" alt="">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 2 -->
    <div class="modal fade" id="funcionesModal2" tabindex="-1" aria-labelledby="funcionesModal2Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal2Label">
                        Funciones del Analista de proyectos de vinculación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Apoyar logísticamente en las actividades programadas por la Comisión de
                                Vinculación de la Sociedad y Dirección de Vinculación con la Sociedad de la UTLVTE.
                            </div>
                            <img class="rounded-circle novige mb-3" height="200" width="230"
                                src="@/assets/img/img/icno/FA_a.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Coordinar acciones con los responsables de vinculación en las unidades académicas
                                y la sociedad: en lo referente a proyectos de vinculación.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_b.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Gestionar la oportuna entrega de recursos a los directores y directoras de Proyectos
                                desde la Coordinación de Gestión, Dirección Administrativa y de Talento Humano y
                                Dirección Financiera.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_c.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Hacer seguimiento y evaluación a los proyectos, eventos y actividades planificadas
                                en la Comisión de Vinculación de la Sociedad y Dirección de Vinculación con la
                                Sociedad.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_d.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Supervisar la aplicación de los formatos institucionales en los procesos de
                                formulación, seguimiento y evaluación de proyectos.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_e.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Revisar periódicamente la pertinencia de los formatos utilizados y proponer a la
                                Comisión de Vinculación con la Sociedad por intermedio de la Dirección de
                                Vinculación con la Sociedad, los cambios y mejoras pertinentes.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_f.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Revisar el cumplimiento de los convenios y cartas de compromiso en lo referente a
                                proyectos de vinculación.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_g.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Coordinar eventos de difusión de los proyectos de vinculación.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_h.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Informar mensual y semestralmente a la Dirección de Vinculación sobre las
                                actividades realizadas.
                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_i.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Participar con voz y voto en las sesiones de la Comisión de
                                Vinculación con la Sociedad.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_j.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                k. Velar por el mantenimiento del buen estado de las instalaciones, equipos y demás
                                enseres de la oficina.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_k.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                l. Cumplir la normativa establecida en el Reglamento de Vinculación.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_l.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                m. Reportar incumplimientos detectados en el desarrollo de los procesos a su cargo.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_m.png" alt="">

                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                n. Las demás que le asigne el director de Vinculación con la Sociedad, de conformidad
                                con el Estatuto de la UTLVTE.

                            </div>
                            <img class="rounded-circle novige mb-3" src="@/assets/img/img/icno/FA_n.png" alt="">

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 3 -->
    <div class="modal fade" id="funcionesModal3" tabindex="-1" aria-labelledby="funcionesModal3Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal3Label">
                        Funciones del Analista de prácticas preprofesionales
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Apoyar logísticamente en las actividades programadas por la Comisión de
                                Vinculación de la Sociedad y Dirección de Vinculación con la Sociedad de la UTLVTE.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Coordinar acciones con los responsables de vinculación en las unidades académicas
                                y la sociedad; en lo referente a prácticas preprofesionales.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Gestionar con la Unidad de Tecnologías de la Información y Comunicación, el
                                correcto funcionamiento de la Plataforma Informática de las Prácticas
                                Preprofesionales.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Coordinar junto a los y las responsables de Vinculación de Facultades, acciones
                                inherentes para la firma de convenios o cartas de compromiso con instituciones
                                públicas o privadas para la realización de prácticas preprofesionales del
                                estudiantado.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Revisar los informes de prácticas preprofesionales del estudiantado para la firma del
                                director(a) de Vinculación con la Sociedad de la UTLVTE.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Mantener actualizada la base de datos de los estudiantes que presentan los informes
                                de prácticas preprofesionales de la UTLVTE
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Informar mensual y semestralmente a la Dirección de Vinculación sobre las
                                actividades realizadas.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Velar por el mantenimiento del buen estado de las instalaciones, equipos y demás
                                enseres de la oficina.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Cumplir la normativa establecida en el Reglamento de Vinculación.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Reportar incumplimientos detectados en el desarrollo de los procesos a su cargo.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                k. Las demás que le asigne el director de Vinculación con la Sociedad, de conformidad
                                con el estatuto de la UTLVTE.
                            </div>


                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 4 -->
    <div class="modal fade" id="funcionesModal4" tabindex="-1" aria-labelledby="funcionesModal4Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal4Label">
                        Funciones del Analista de servicio a la sociedad
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Apoyar logísticamente en las actividades programadas por la Comisión de
                                Vinculación de la Sociedad y Dirección de Vinculación con la Sociedad de la UTLVTE.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Coordinar acciones con los y las responsables de vinculación en las unidades
                                académicas y la sociedad: en lo referente a servicio a la sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Gestionar la oportuna entrega de recursos para la ejecución de los eventos de
                                capacitación, como servicio a la sociedad
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Gestionar con la Unidad de Tecnologías de la Información y Comunicación, el
                                correcto funcionamiento de la Plataforma Informática de Inserción Laboral.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Coordinar junto a los y las responsables de Vinculación de Facultades, acciones
                                inherentes para la firma de convenios o cartas de compromiso con instituciones
                                públicas o privadas para generar articuladamente servicio a la sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Planificar y ejecutar junto a los y las responsables de Vinculación de Facultades.
                                eventos de capacitación dirigido mejorar las capacidades de personas de los sectores
                                vulnerabilizados de la sociedad
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Difundir oportunidades laborales y de capacitación a integrantes internos y externos
                                de la comunidad universitaria, a través de la plataforma informática de inserción
                                laboral, bolsa de empleo y redes sociales oficiales de la UTLVTE.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Mantener actualizada la base de datos de los y las graduadas de la UTLVTE
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Informar mensual y semestralmente a la Dirección de Vinculación sobre las
                                actividades realizadas
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Velar por el mantenimiento del buen estado de las instalaciones, equipos y demás
                                enseres de la oficina.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                k. Cumplir la normativa establecida en el Reglamento de Vinculación.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                l. Reportar incumplimientos detectados en el desarrollo de los procesos a su cargo.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                m. Las demás que le asigne el director de Vinculación con la Sociedad, de conformidad
                                con el estatuto de la UTLVTE.
                            </div>


                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 5 -->
    <div class="modal fade" id="funcionesModal5" tabindex="-1" aria-labelledby="funcionesModal5Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal5Label">
                        Funciones de la Secretaría de Vinculación.
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Manejar y organizar el archivo, receptar y entregar documentos, así como revisar y
                                contestar el correo electrónico de la oficina: vinculación @utelvt.edu.ec
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Elaborar, remitir, recibir y archivar las comunicaciones que genere la Dirección de
                                Vinculación con la Sociedad, dispuestas por el director de Vinculación con la
                                Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Informar a estudiantado y personal docente en relación a la función sustantiva
                                Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Colaborar en todas las actividades organizadas por la Dirección de Vinculación
                                (foros, visitas, exposiciones, eventos, ferias, etc.), que se planifiquen desde la
                                Dirección de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Actualizar con carácter permanente la base de datos de Convenios y Cartas de
                                Compromiso para las actividades de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Elaborar actas de las reuniones que se realice desde la Comisión de Vinculación con
                                la Sociedad y Dirección de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Garantizar la idoneidad de los procedimientos administrativos y documentos que se
                                generan en la Dirección de Vinculación con la Sociedad.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Mantener una base de datos de proyectos de vinculación, en la que conste
                                formulación, ejecución, seguimiento y evaluación de los mismos y la participación
                                de docentes y estudiantado participante en las diferentes áreas de trabajo de
                                vinculación.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Informar a la Dirección de Vinculación sobre las actividades realizadas.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Velar por el mantenimiento del buen estado de las instalaciones, equipos y demás
                                enseres de la oficina.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                k. Cumplir la normativa establecida en el Reglamento de Vinculación.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                l. Reportar incumplimientos detectados en el desarrollo de los procesos a su cargo.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                m. Las demás que le asigne el director de Vinculación con la Sociedad, de conformidad
                                con el estatuto de la UTLVTE.
                            </div>


                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 6 -->
    <div class="modal fade" id="funcionesModal6" tabindex="-1" aria-labelledby="funcionesModal6Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal6Label">
                        Responsable de Vinculación de FACAP.
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-lg-12">
                        <div class="header-img d-flex h-100 pt-6 ps-6 pb-6">
                            <div class="row g-5">
                                <div class="col-xl-6">
                                    <div class="bg-light p-4" style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;">
                                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100"
                                            style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;" alt="Image">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="display-6 mb-4">Ing. Gladys Macas Giler, Magister</h1>
                                    <p class="mb-4">Responsable de Vinculación actualmente de la Facultad de Ciencias
                                        Agropecuarias, UTLVTE. Docente titular de la UTLVTE, con
                                        experiencia en el área de vinculación y docencia universitaria.
                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">Mútile Esmeraldas Ecuador</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <p class="text-dark mb-0">gladys.macas@utelvt.edu.ec</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">189(06) - 2991770 </p>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="fab fa-firefox-browser text-primary me-3"></i>
                                        <p class="text-dark mb-0">utelvt.edu.ec</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container section-title py-5">
                        <h2>Funciones</h2>
                        <p>Estas son las funciones que realiza como responsable de vinculación de la Facultad</p>
                    </div>
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Proponer las políticas, planes y programas actualizados sobre la Vinculación con la
                                Sociedad a la Dirección de Vinculación con la Sociedad de la UTLVTE.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Coordinar, junto al Decano (a) y directores (as) de Carrera los proyectos de
                                vinculación de su unidad académica, para la revisión y aprobación por parte de la
                                Comisión de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Coordinar la vinculación específica con la sociedad con los Decanatos y Direcciones
                                de Carrera
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Presentar y ejecutar proyectos de cursos de capacitación guiados por el personal
                                académico de la institución, dirigido a los sectores más vulnerabilizados de la
                                sociedad
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Proponer a la Dirección de Vinculación con la Sociedad, políticas para fortalecer y
                                diversificar la vinculación con los y las diferentes agentes de la producción, con
                                Organismos No Gubernamentales y con prestigiosas Universidades o Escuelas
                                Politécnicas Nacionales o Internacionales.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Coordinar con la Dirección de Vinculación con la Sociedad, el diseño y ejecución de
                                los diferentes programas de prácticas y pasantías en los ámbitos urbano y rural,
                                según las propias características de las carreras y las necesidades de la sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Velar por la adecuada difusión de las actividades de vinculación, conjuntamente con
                                la Dirección de Vinculación con la Sociedad.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Elaborar el informe anual de actividades y ponerlo a consideración de la Dirección
                                de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Realizar reuniones mensuales con los y las responsables de los proyectos de
                                Vinculación con la Sociedad de su facultad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Las demás actividades que les sean asignadas.

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 7 -->
    <div class="modal fade" id="funcionesModal7" tabindex="-1" aria-labelledby="funcionesModal7Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal7Label">
                        Responsable de Vinculación de FACAE.
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-lg-12">
                        <div class="header-img d-flex h-100 pt-6 ps-6 pb-6">
                            <div class="row g-5">
                                <div class="col-xl-6">
                                    <div class="bg-light p-4" style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;">
                                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100"
                                            style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;" alt="Image">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="display-6 mb-4">Dra. Luz Marina Cifuentes Quiñónez, Magister</h1>
                                    <p class="mb-4">Responsable de Vinculación actualmente de la Facultad de Ciencias
                                        Administrativas y Económicas, UTLVTE. Docente titular de la UTLVTE, con
                                        experiencia en el área de vinculación y docencia universitaria.
                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">Nuevos Horizontes, Esmeraldas Ecuador</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <p class="text-dark mb-0">luz.cifuentes@utelvt.edu.ec</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">189(06) - 2991770 </p>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="fab fa-firefox-browser text-primary me-3"></i>
                                        <p class="text-dark mb-0">utelvt.edu.ec</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container section-title py-5">
                        <h2>Funciones</h2>
                        <p>Estas son las funciones que realiza como responsable de vinculación de la Facultad</p>
                    </div>
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Proponer las políticas, planes y programas actualizados sobre la Vinculación con la
                                Sociedad a la Dirección de Vinculación con la Sociedad de la UTLVTE.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Coordinar, junto al Decano (a) y directores (as) de Carrera los proyectos de
                                vinculación de su unidad académica, para la revisión y aprobación por parte de la
                                Comisión de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Coordinar la vinculación específica con la sociedad con los Decanatos y Direcciones
                                de Carrera
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Presentar y ejecutar proyectos de cursos de capacitación guiados por el personal
                                académico de la institución, dirigido a los sectores más vulnerabilizados de la
                                sociedad
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Proponer a la Dirección de Vinculación con la Sociedad, políticas para fortalecer y
                                diversificar la vinculación con los y las diferentes agentes de la producción, con
                                Organismos No Gubernamentales y con prestigiosas Universidades o Escuelas
                                Politécnicas Nacionales o Internacionales.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Coordinar con la Dirección de Vinculación con la Sociedad, el diseño y ejecución de
                                los diferentes programas de prácticas y pasantías en los ámbitos urbano y rural,
                                según las propias características de las carreras y las necesidades de la sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Velar por la adecuada difusión de las actividades de vinculación, conjuntamente con
                                la Dirección de Vinculación con la Sociedad.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Elaborar el informe anual de actividades y ponerlo a consideración de la Dirección
                                de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Realizar reuniones mensuales con los y las responsables de los proyectos de
                                Vinculación con la Sociedad de su facultad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Las demás actividades que les sean asignadas.

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 8 -->
    <div class="modal fade" id="funcionesModal8" tabindex="-1" aria-labelledby="funcionesModal8Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal8Label">
                        Responsable de Vinculación de FACPED.
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-lg-12">
                        <div class="header-img d-flex h-100 pt-6 ps-6 pb-6">
                            <div class="row g-5">
                                <div class="col-xl-6">
                                    <div class="bg-light p-4" style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;">
                                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100"
                                            style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;" alt="Image">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="display-6 mb-4">Lcda. Ana Bedoya Gutiérrez, Magister</h1>
                                    <p class="mb-4">Responsable de Vinculación actualmente de la Facultad de la
                                        Pedagogía, UTLVTE. Docente titular de la UTLVTE, con
                                        experiencia en el área de vinculación y docencia universitaria.
                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">Nuevos Horizontes, Esmeraldas Ecuador</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <p class="text-dark mb-0">ana.bedoya@utelvt.edu.ec</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">189(06) - 2991770 </p>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="fab fa-firefox-browser text-primary me-3"></i>
                                        <p class="text-dark mb-0">utelvt.edu.ec</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container section-title py-5">
                        <h2>Funciones</h2>
                        <p>Estas son las funciones que realiza como responsable de vinculación de la Facultad</p>
                    </div>
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Proponer las políticas, planes y programas actualizados sobre la Vinculación con la
                                Sociedad a la Dirección de Vinculación con la Sociedad de la UTLVTE.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Coordinar, junto al Decano (a) y directores (as) de Carrera los proyectos de
                                vinculación de su unidad académica, para la revisión y aprobación por parte de la
                                Comisión de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Coordinar la vinculación específica con la sociedad con los Decanatos y Direcciones
                                de Carrera
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Presentar y ejecutar proyectos de cursos de capacitación guiados por el personal
                                académico de la institución, dirigido a los sectores más vulnerabilizados de la
                                sociedad
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Proponer a la Dirección de Vinculación con la Sociedad, políticas para fortalecer y
                                diversificar la vinculación con los y las diferentes agentes de la producción, con
                                Organismos No Gubernamentales y con prestigiosas Universidades o Escuelas
                                Politécnicas Nacionales o Internacionales.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Coordinar con la Dirección de Vinculación con la Sociedad, el diseño y ejecución de
                                los diferentes programas de prácticas y pasantías en los ámbitos urbano y rural,
                                según las propias características de las carreras y las necesidades de la sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Velar por la adecuada difusión de las actividades de vinculación, conjuntamente con
                                la Dirección de Vinculación con la Sociedad.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Elaborar el informe anual de actividades y ponerlo a consideración de la Dirección
                                de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Realizar reuniones mensuales con los y las responsables de los proyectos de
                                Vinculación con la Sociedad de su facultad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Las demás actividades que les sean asignadas.

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 9 -->
    <div class="modal fade" id="funcionesModal9" tabindex="-1" aria-labelledby="funcionesModal9Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal9Label">
                        Responsable de Vinculación de FACSOS.
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-lg-12">
                        <div class="header-img d-flex h-100 pt-6 ps-6 pb-6">
                            <div class="row g-5">
                                <div class="col-xl-6">
                                    <div class="bg-light p-4" style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;">
                                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100"
                                            style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;" alt="Image">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="display-6 mb-4">Lcda. Mariuxi de los Angeles Rodríguez Enriquez, Magister
                                    </h1>
                                    <p class="mb-4">Responsable de Vinculación actualmente de la Facultad de
                                        Ciencias Sociales y de Servicios, UTLVTE. Docente titular de la UTLVTE, con
                                        experiencia en el área de vinculación y docencia universitaria.
                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">Nuevos Horizontes, Esmeraldas Ecuador</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <p class="text-dark mb-0">mariuxi.rodriguez.enriquez@utelvt.edu.ec</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">189(06) - 2991770 </p>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="fab fa-firefox-browser text-primary me-3"></i>
                                        <p class="text-dark mb-0">utelvt.edu.ec</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container section-title py-5">
                        <h2>Funciones</h2>
                        <p>Estas son las funciones que realiza como responsable de vinculación de la Facultad</p>
                    </div>
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Proponer las políticas, planes y programas actualizados sobre la Vinculación con la
                                Sociedad a la Dirección de Vinculación con la Sociedad de la UTLVTE.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Coordinar, junto al Decano (a) y directores (as) de Carrera los proyectos de
                                vinculación de su unidad académica, para la revisión y aprobación por parte de la
                                Comisión de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Coordinar la vinculación específica con la sociedad con los Decanatos y Direcciones
                                de Carrera
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Presentar y ejecutar proyectos de cursos de capacitación guiados por el personal
                                académico de la institución, dirigido a los sectores más vulnerabilizados de la
                                sociedad
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Proponer a la Dirección de Vinculación con la Sociedad, políticas para fortalecer y
                                diversificar la vinculación con los y las diferentes agentes de la producción, con
                                Organismos No Gubernamentales y con prestigiosas Universidades o Escuelas
                                Politécnicas Nacionales o Internacionales.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Coordinar con la Dirección de Vinculación con la Sociedad, el diseño y ejecución de
                                los diferentes programas de prácticas y pasantías en los ámbitos urbano y rural,
                                según las propias características de las carreras y las necesidades de la sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Velar por la adecuada difusión de las actividades de vinculación, conjuntamente con
                                la Dirección de Vinculación con la Sociedad.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Elaborar el informe anual de actividades y ponerlo a consideración de la Dirección
                                de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Realizar reuniones mensuales con los y las responsables de los proyectos de
                                Vinculación con la Sociedad de su facultad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Las demás actividades que les sean asignadas.

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 10 -->
    <div class="modal fade" id="funcionesModal10" tabindex="-1" aria-labelledby="funcionesModal10Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal10Label">
                        Responsable de Vinculación de FACI.
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-lg-12">
                        <div class="header-img d-flex h-100 pt-6 ps-6 pb-6">
                            <div class="row g-5">
                                <div class="col-xl-6">
                                    <div class="bg-light p-4" style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;">
                                        <img src="@/assets/img/img/logovincusinfondo.png" class="img-fluid w-100"
                                            style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;" alt="Image">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="display-6 mb-4">Ing. Marco Vinicio Navarrete Villavicencio, Magister</h1>
                                    <p class="mb-4">Responsable de Vinculación actualmente de la Facultad de
                                        Ingenierías, UTLVTE. Docente titular de la UTLVTE, con
                                        experiencia en el área de vinculación y docencia universitaria.
                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">Nuevos Horizontes, Esmeraldas Ecuador</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <p class="text-dark mb-0">marco.navarrete@utelvt.edu.ec</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">189(06) - 2991770 </p>
                                    </div>
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="fab fa-firefox-browser text-primary me-3"></i>
                                        <p class="text-dark mb-0">utelvt.edu.ec</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container section-title py-5">
                        <h2>Funciones</h2>
                        <p>Estas son las funciones que realiza como responsable de vinculación de la Facultad</p>
                    </div>
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                a. Proponer las políticas, planes y programas actualizados sobre la Vinculación con la
                                Sociedad a la Dirección de Vinculación con la Sociedad de la UTLVTE.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                b. Coordinar, junto al Decano (a) y directores (as) de Carrera los proyectos de
                                vinculación de su unidad académica, para la revisión y aprobación por parte de la
                                Comisión de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                c. Coordinar la vinculación específica con la sociedad con los Decanatos y Direcciones
                                de Carrera
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                d. Presentar y ejecutar proyectos de cursos de capacitación guiados por el personal
                                académico de la institución, dirigido a los sectores más vulnerabilizados de la
                                sociedad
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                e. Proponer a la Dirección de Vinculación con la Sociedad, políticas para fortalecer y
                                diversificar la vinculación con los y las diferentes agentes de la producción, con
                                Organismos No Gubernamentales y con prestigiosas Universidades o Escuelas
                                Politécnicas Nacionales o Internacionales.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                f. Coordinar con la Dirección de Vinculación con la Sociedad, el diseño y ejecución de
                                los diferentes programas de prácticas y pasantías en los ámbitos urbano y rural,
                                según las propias características de las carreras y las necesidades de la sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                g. Velar por la adecuada difusión de las actividades de vinculación, conjuntamente con
                                la Dirección de Vinculación con la Sociedad.

                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                h. Elaborar el informe anual de actividades y ponerlo a consideración de la Dirección
                                de Vinculación con la Sociedad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                i. Realizar reuniones mensuales con los y las responsables de los proyectos de
                                Vinculación con la Sociedad de su facultad.
                            </div>


                        </div>
                        <div class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                j. Las demás actividades que les sean asignadas.

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'owl.carousel';
import script2 from '@/assets/scripts/js/main.js'
export default {
    mixins: [script2],
    name: 'equipo',
    data() {
        return {
            // ruta base de tu PDF
            pdfUrl: '/Docs/reglamernto_vincul_reformado.pdf',
            // página inicial (se reemplaza al llamar al modal)
            pdfPage: 1
        }
    },
    computed: {
        pdfSrc() {
            return `${this.pdfUrl}#page=${this.pdfPage}`;
        }
    },
    methods: {
        openPdfModal(page) {
            this.pdfPage = page;
            const modalEl = this.$refs.pdfModal;
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        },
        closePdfModal() {
            const modalEl = this.$refs.pdfModal;
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
        }
    },

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.custom-modal {
    max-width: 1200px;
    /* o el valor que prefieras */
    width: 100%;
}
</style>
