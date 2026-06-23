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
    <!-- Directora Start -->
    <div class="container-fluid about  py-5">
        <div class="container py-5">
            <div class="row g-5" v-if="director">
                <div class="col-xl-5">
                    <div class="h-100">
                        <img :src="getPhotoUrl(director?.ci) || require('@/assets/img/img/logovincusinfondo.png')"
                            class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Director Image">
                    </div>
                </div>
                <div class="col-xl-7">
                    <h5 class="text-uppercase text-primary">Conoce a</h5>
                    <h1 class="mb-4">{{ director?.nombre_completo }}</h1>
                    <p class="fs-5 mb-4">{{ director?.genero_labels?.texto_bienvenida }}</p>
                    <div class="tab-class p-4">
                        <ul class="nav d-flex mb-2">
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 text-center bg-white active" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark" style="width: 150px;">Descripción</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="text-start my-auto">
                                                <p class="mb-4" style="white-space: pre-line; text-align: justify;">
                                                    {{ director?.detalle_rol }}
                                                </p>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                                        href="#" data-bs-toggle="modal"
                                                        data-bs-target="#funcionesModal1">Ver más detalle</a>
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
                <div class="packages-item" v-for="(miembro, index) in equipo" :key="index">
                    <div class="packages-img">
                        <div class="position-relative overflow-hidden w-100"
                            style="aspect-ratio: 1 / 1; background-color: #f4f6f9;">
                            <img :src="getPhotoUrl2(miembro.ci) || require('@/assets/img/img/logovincusinfondo.png')"
                                class="w-100 h-100" style="object-fit: cover; object-position: center;"
                                alt="Foto miembro">
                        </div>
                        <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                            style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2">
                                <i class="fa fa-map-marker-alt me-2"></i>Esmeraldas - Ecuador
                            </small>
                        </div>
                        <div class="packages-price py-2 px-4 text-center"><i class="fa fa-user me-2"></i></div>
                    </div>

                    <div class="packages-content">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0">{{ miembro.nombre_completo }}</h5>
                            <small class="text-uppercase">Cargo: {{ miembro.genero_labels.titulo_rol }}</small>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p class="mb-4">{{ miembro.detalle_rol }}</p>
                        </div>
                        <div class="row rounded-bottom mx-0 boton">
                            <div class="col-6 text-start px-0">
                                <a class="btn-hover btn text-white py-2 px-4" href="#" data-bs-toggle="modal"
                                    data-bs-target="#funcionesModal2" @click="verFunciones(miembro)">
                                    Ver funciones
                                </a>
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
                <div class="event-item" v-for="(respons, index) in responsables" :key="index">
                    <div class="position-relative overflow-hidden w-100"
                        style="aspect-ratio: 1 / 1; background-color: #f4f6f9;">
                        <img :src="getPhotoUrl2(respons.ci) || require('@/assets/img/img/logovincusinfondo.png')"
                            class="w-100 h-100" style="object-fit: cover; object-position: center;" alt="Foto miembro">
                    </div>
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Esmeraldas-Ecuador</span>
                        </div>
                        <h4 class="mb-4">{{ respons.nombre_completo }}</h4>
                        <p class="mb-4" v-if="respons.facultad.siglas === 'SC'">SEDE LA CONCORDIA</p>
                        <p class="mb-4" v-else>FACULTAD DE {{ respons.facultad.nombre }} - {{ respons.facultad.siglas }}
                        </p>
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal"
                            data-bs-target="#funcionesModal6" @click="verRespFunciones(respons)">Ver Más Información
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Responsables End -->


    <!-- Directores Section -->
    <section id="doctors" class="doctors section container-fluid event py-5 wow fadeInUp" data-wow-delay="0.1s">


        <div class="container section-title text-center" data-aos="fade-up">
            <h5 class="text-uppercase text-primary">Directores de Carreras</h5>
            <p class="mb-4">Tendrá como compromiso el seguimiento a las
                actividades de Vinculación con la Sociedad que se realicen desde la Carrera que dirige. El o
                la directora(a) de Carrera elaborará un informe semestral de las actividades de Vinculación
                con la Sociedad que se desarrollen en la carrera..... <a class="text-secondary"
                    @click="openPdfModal(21)">Leer Más</a>
            </p>
            <h1 class="mb-0">Conoce a los Directores de Carreras de la UTLVTE</h1>
        </div>

        <div class="container-fluid event py-5 ">

            <div class="row gy-4">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100"
                    v-for="(direc, index) in directoresCarrera.slice(0, 4)" :key="index">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic">
                            <img :src="getPhotoUrl3(direc.cedula_director) || require('@/assets/img/img/logovincusinfondo.png')"
                                @error="onImageError" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>{{ direc.director_procesado }}</h4>
                            <span v-if="direc.facultad.siglas === 'SC'">SEDE LA CONCORDIA</span>
                            <span v-else>{{ direc.facultad.siglas }}</span>
                            <p v-if="direc.facultad.siglas === 'SC'">{{ direc.nombre_carrera }}</p>
                            <p v-else>Director(a) de la Carrera de {{ direc.nombre_carrera }}</p>
                        </div>
                    </div>
                </div><!-- End Team Member -->

            </div>
            <div class="col-12 py-5">
                <div class="services-btn text-center">
                    <a href="#" class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-5"
                        data-bs-toggle="modal" data-bs-target="#funcionesModal12">Ver
                        Todos los Directores</a>
                </div>
            </div>

        </div>

    </section>


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
    <!-- Modal Director-->
    <div class="modal fade" id="funcionesModal1" tabindex="-1" aria-labelledby="funcionesModal1Label"
        aria-hidden="true">
        <div class="modal-dialog custom-modal modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal1Label">
                        {{ director?.genero_labels?.titulo_rol }}
                    </h5>

                </div>
                <div class="modal-body">
                    <div class="col-12 col-lg-12">
                        <div class="header-img d-flex h-100 pt-6 ps-6 pb-6">
                            <div class="row g-5">
                                <div class="col-xl-6">
                                    <div class="bg-light p-4 position-relative h-100"
                                        style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;">
                                        <img :src="getPhotoUrl(director?.ci) || require('@/assets/img/img/logovincusinfondo.png')"
                                            class="img-fluid w-100"
                                            style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%; object-fit: cover; height: 250px;"
                                            alt="Image">

                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="display-6 mb-4">{{ director?.nombre_completo }}</h1>
                                    <p class="mb-4">{{ director?.genero_labels?.titulo_rol }} de Vinculación con la
                                        Sociedad.
                                        Posee el título de {{ director?.titulo_posgrado || director?.titulo_grado ||
                                            'Profesional' }}.

                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">Nuevos Horizontes, Esmeraldas Ecuador</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <p class="text-dark mb-0">{{ director?.email }}</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">{{ director?.telefono }}</p>
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
                        <h2>Funciones del {{ director?.genero_labels?.titulo_rol }} de Vinculación con la Sociedad</h2>
                        <p>Las funciones asignadas al cargo actual son:</p>
                    </div>
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div v-for="(funcion, i) in director?.funciones" :key="i" class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                {{ funcion }}
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
    <!-- Modal 2 Equipo-->
    <div class="modal fade" id="funcionesModal2" tabindex="-1" aria-labelledby="funcionesModal2Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal2Label">
                        {{ miembroSeleccionado.genero_labels.titulo_rol }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-lg-12">
                        <div class="header-img d-flex h-100 pt-6 ps-6 pb-6">
                            <div class="row g-5">
                                <div class="col-xl-6">
                                    <div class="bg-light p-4" style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;">
                                        <img :src="getPhotoUrl2(miembroSeleccionado.ci) || require('@/assets/img/img/logovincusinfondo.png')"
                                            class="img-fluid w-100"
                                            style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;" alt="Image">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="display-6 mb-4">{{ miembroSeleccionado.nombre_completo }}</h1>
                                    <p class="mb-4">{{ miembroSeleccionado.detalle_rol }}
                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">Nuevos Horizontes, Esmeraldas Ecuador</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <p class="text-dark mb-0">{{ miembroSeleccionado.email }}</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">{{ miembroSeleccionado.telefono }}</p>
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
                    </div>
                    <div class="event-carousel owl-carousel" data-wow-delay="0.3s">
                        <div v-for="(funcion, i) in miembroSeleccionado.funciones" :key="i" class="testimonial-item1">
                            <div class="testimonial-text border rounded p-4 pt-5 mb-5">
                                <div class="btn-square bg-white border rounded-circle">
                                    <i class="fa fa-quote-right fa-2x text-primary"></i>
                                </div>
                                {{ funcion }}
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
    <!-- Modal 3 REsponsable -->
    <div class="modal fade" id="funcionesModal6" tabindex="-1" aria-labelledby="funcionesModal6Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal6Label">
                        {{ responsableSeleccionado?.genero_labels.titulo_rol }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 col-lg-12">
                        <div class="header-img d-flex h-100 pt-6 ps-6 pb-6">
                            <div class="row g-5">
                                <div class="col-xl-6">
                                    <div class="bg-light p-4" style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;">
                                        <img :src="getPhotoUrl2(responsableSeleccionado?.ci) || require('@/assets/img/img/logovincusinfondo.png')"
                                            class="img-fluid w-100"
                                            style="border-radius: 68% 32% 100% 0% / 0% 75% 25% 100%;" alt="Image">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <h1 class="display-6 mb-4">{{ responsableSeleccionado?.nombre_completo }}</h1>
                                    <p class="mb-4" v-if="responsableSeleccionado?.facultad.siglas === 'SC'">{{
                                        responsableSeleccionado?.genero_labels?.pronombre }} es {{
                                            responsableSeleccionado?.genero_labels?.titulo_rol }} actualmente de la SEDE {{
                                            responsableSeleccionado?.facultad.nombre }}, UTLVTE. Docente titular de la
                                        UTLVTE, con
                                        experiencia en el área de vinculación y docencia universitaria.
                                    </p>
                                    <p class="mb-4" v-else>{{ responsableSeleccionado?.genero_labels?.pronombre }} es {{
                                        responsableSeleccionado?.genero_labels?.titulo_rol }} actualmente de la Facultad
                                        de {{ responsableSeleccionado?.facultad.nombre }}, UTLVTE. Docente titular de la
                                        UTLVTE, con
                                        experiencia en el área de vinculación y docencia universitaria.
                                    </p>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">Nuevos Horizontes, Esmeraldas Ecuador</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <p class="text-dark mb-0">{{ responsableSeleccionado.email }}</p>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary me-3"></i>
                                        <p class="text-dark mb-0">{{ responsableSeleccionado.telefono }}</p>
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

    <!-- Modal 12 -->
    <div class="modal fade" id="funcionesModal12" tabindex="-1" aria-labelledby="funcionesModal12Label"
        aria-hidden="true">
        <div class="modal-dialog custom-modal modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal12Label">
                        Directores de Carreras de la UTLVTE
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <section id="doctors" class="doctors section container-fluid event py-5">
                        <div class="container section-title text-center" data-aos="fade-up">
                            <h5 class="text-uppercase text-primary">Directores de Carreras</h5>
                            <p class="mb-4">Tendrá como compromiso el seguimiento a las
                                actividades de Vinculación con la Sociedad que se realicen desde la Carrera que dirige.
                                El o
                                la directora(a) de Carrera elaborará un informe semestral de las actividades de
                                Vinculación
                                con la Sociedad que se desarrollen en la carrera, el cual lo entregará al responsable de
                                Vinculación de la Facultad, con copia al director(a) de Vinculación con la Sociedad de
                                la
                                UTLVTE.
                            </p>
                            <h1 class="mb-0">Estos son todos los Directores de las {{ directoresCarrera.length }}
                                Carreras de la UTLVTE</h1>
                        </div>
                        <div class="container-fluid event py-5 ">

                            <div class="row gy-4">

                                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100"
                                    v-for="(direc, index) in directoresCarrera" :key="index">
                                    <div class="team-member d-flex align-items-start">
                                        <div class="pic"><img
                                                :src="getPhotoUrl3(direc.cedula_director) || require('@/assets/img/img/logovincusinfondo.png')"
                                                @error="onImageError" class="img-fluid" alt="">
                                        </div>
                                        <div class="member-info">
                                            <h4>{{ direc.director_procesado }}</h4>
                                            <span v-if="direc.facultad.siglas === 'SC'">SEDE LA CONCORDIA</span>
                                            <span v-else>{{ direc.facultad.siglas }}</span>
                                            <p v-if="direc.facultad.siglas === 'SC'">{{ direc.nombre_carrera }}</p>
                                            <p v-else>Director(a) de la Carrera de {{ direc.nombre_carrera }}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </section>
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
import API from "@/assets/js/services/axios";
export default {
    mixins: [script2],
    name: 'equipo',
    data() {
        return {
            baseUrl: "/vin",
            // ruta base de tu PDF
            pdfUrl: '/Docs/reglamernto_vincul_reformado.pdf',
            // página inicial (se reemplaza al llamar al modal)
            pdfPage: 1,
            director: null,
            equipo: [], // Aquí guardarás lo que responde el método getTeamInfo()
            miembroSeleccionado: {
                ci: '',
                nombre_completo: '',
                genero_labels: { titulo_rol: '' },
                detalle_rol: '',
                email: '',
                telefono: '',
                funciones: []
            },
            responsables: [],
            responsableSeleccionado: {
                ci: '',
                nombre_completo: '',
                genero_labels: { titulo_rol: '' },
                email: '',
                telefono: '',
                facultad: [],
            },
            directoresCarrera: [],
        }
    },
    computed: {
        pdfSrc() {
            return `${this.pdfUrl}#page=${this.pdfPage}`;
        }
    },
    async mounted() {
        await this.getDirector();
        await this.getTeamInfo();
        await this.getResponsablesInfo();
        await this.getDirectoresCarrera();
    },
    methods: {
        getPhotoUrl(ci) {
            // Si no hay CI, retornamos una imagen vacía o un placeholder
            if (!ci) return '';

            const baseURL2 = API.defaults.baseURL;
            // Usamos el timestamp para evitar problemas de caché al cambiar de integrante
            return `${baseURL2}/vin/getFotoSinfondo/${ci}?t=${new Date().getTime()}`;
        },
        getPhotoUrl2(ci) {
            // Si no hay CI, retornamos una imagen vacía o un placeholder
            if (!ci) return '';

            const baseURL2 = API.defaults.baseURL;
            // Usamos el timestamp para evitar problemas de caché al cambiar de integrante
            return `${baseURL2}/vin/getFotoDocente/${ci}?t=${new Date().getTime()}`;
        },
        getPhotoUrl3(ci) {
            // Si no hay CI, retornamos una imagen vacía o un placeholder
            if (!ci || ci === 'NO ENCONTRADO') return '';

            const baseURL2 = API.defaults.baseURL;
            return `${baseURL2}/vin/getFotoDocente3/${ci}?t=${new Date().getTime()}`;
        },
        onImageError(event) {
            // Reemplazamos la imagen rota por tu logo por defecto dinámicamente
            event.target.src = require('@/assets/img/img/logovincusinfondo.png');
        },
        inicializarcarrousel() {
            this.$nextTick(() => {
                const $carousel = $(".event-carousel");

                // Destruimos la instancia previa por si el mixin la inicializó vacía
                if ($carousel.hasClass('owl-loaded')) {
                    $carousel.trigger('destroy.owl.carousel');
                    $carousel.removeClass('owl-hidden');
                    $carousel.find('.owl-stage-outer').children().unwrap();
                }

                // Inicializamos el carrusel con los datos reales
                $carousel.owlCarousel({
                    autoplay: true,
                    smartSpeed: 1000,
                    center: false,
                    dots: false,
                    loop: true,
                    margin: 25,
                    nav: true,
                    navText: [
                        '<i class="fas fa-angle-double-left"></i>',
                        '<i class="fas fa-angle-double-right"></i>',
                    ],
                    responsiveClass: true,
                    responsive: {
                        0: { items: 1 },
                        768: { items: 1 },
                        992: { items: 2 },
                        1200: { items: 3 },
                    },
                });
            });
        },
        async getDirector() {
            try {
                const response = await API.get(`${this.baseUrl}/getDirectorInfo`);
                this.director = response.data;

                // Esperamos a que Vue dibuje el v-for en el DOM
                this.$nextTick(() => {
                    const $carousel = $(".event-carousel");

                    // Destruimos la instancia previa por si el mixin la inicializó vacía
                    if ($carousel.hasClass('owl-loaded')) {
                        $carousel.trigger('destroy.owl.carousel');
                        $carousel.removeClass('owl-hidden');
                        $carousel.find('.owl-stage-outer').children().unwrap();
                    }

                    // Inicializamos el carrusel con los datos reales
                    $carousel.owlCarousel({
                        autoplay: true,
                        smartSpeed: 1000,
                        center: false,
                        dots: false,
                        loop: true,
                        margin: 25,
                        nav: true,
                        navText: [
                            '<i class="fas fa-angle-double-left"></i>',
                            '<i class="fas fa-angle-double-right"></i>',
                        ],
                        responsiveClass: true,
                        responsive: {
                            0: { items: 1 },
                            768: { items: 1 },
                            992: { items: 2 },
                            1200: { items: 3 },
                        },
                    });
                });

            } catch (error) {
                console.error("Error cargando al director:", error);
            }
        },
        async getTeamInfo() {
            try {
                const response = await API.get(`${this.baseUrl}/getTeamInfo`);
                this.equipo = response.data;
                this.$nextTick(() => {
                    const $carousel = $(".packages-carousel");

                    // Destruimos la instancia previa por si el mixin la inicializó vacía
                    if ($carousel.hasClass('owl-loaded')) {
                        $carousel.trigger('destroy.owl.carousel');
                        $carousel.removeClass('owl-hidden');
                        $carousel.find('.owl-stage-outer').children().unwrap();
                    }
                    const totalMiembros = this.equipo.length;
                    const activarEfectos = totalMiembros > 5;

                    // Inicializamos el carrusel con los datos reales
                    $carousel.owlCarousel({
                        autoplay: activarEfectos,
                        smartSpeed: 1000,
                        center: false,
                        dots: false,
                        loop: activarEfectos,
                        margin: 25,
                        nav: activarEfectos,
                        navText: [
                            '<i class="fas fa-arrow-left"></i>',
                            '<i class="fas fa-arrow-right"></i>',
                        ],
                        responsiveClass: true,
                        responsive: {
                            0: { items: 1 },
                            768: { items: 2 },
                            992: { items: 2 },
                            1200: { items: 3 },
                        },
                    });
                });

            } catch (error) {
                console.error("Error cargando el equipo:", error);
            }
        },
        async getResponsablesInfo() {
            try {
                const response = await API.get(`${this.baseUrl}/getResponsablesInfo`);
                this.responsables = response.data;
                this.$nextTick(() => {
                    const $carousel = $(".event-carousel");

                    // Destruimos la instancia previa por si el mixin la inicializó vacía
                    if ($carousel.hasClass('owl-loaded')) {
                        $carousel.trigger('destroy.owl.carousel');
                        $carousel.removeClass('owl-hidden');
                        $carousel.find('.owl-stage-outer').children().unwrap();
                    }
                    const totalMiembros = this.responsables.length;
                    const activarEfectos = totalMiembros > 5;

                    // Inicializamos el carrusel con los datos reales
                    $carousel.owlCarousel({
                        autoplay: activarEfectos,
                        smartSpeed: 1000,
                        center: false,
                        dots: false,
                        loop: activarEfectos,
                        margin: 25,
                        nav: activarEfectos,
                        navText: [
                            '<i class="fas fa-angle-double-left"></i>',
                            '<i class="fas fa-angle-double-right"></i>',
                        ],
                        responsiveClass: true,
                        responsive: {
                            0: { items: 1 },
                            768: { items: 1 },
                            992: { items: 2 },
                            1200: { items: 3 },
                        },
                    });
                });

            } catch (error) {
                console.error("Error cargando el equipo:", error);
            }
        },
        async getDirectoresCarrera() {
            try {
                const response = await API.get(`${this.baseUrl}/getDirectoresCarreras`);
                this.directoresCarrera = response.data.data;

            } catch (error) {
                console.error("Error cargando el equipo:", error);
            }
        },
        verFunciones(miembro) {
            this.miembroSeleccionado = miembro;
            this.inicializarcarrousel();
        },
        verRespFunciones(responsable) {
            this.responsableSeleccionado = responsable;
            this.inicializarcarrousel();
        },
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
