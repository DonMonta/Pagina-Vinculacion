<template>
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <div class="container-fluid services py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 800px;">
                <h1 class="display-3">Proyectos Nuevos de Vinculación con la Sociedad</h1>
            </div>

        </div>
    </div>
    <div class="container-fluid about  py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-5">
                    <div class="h-100">
                        <img src="@/assets/img/img/Lol.gif" alt="Image">
                    </div>
                </div>
                <div class="col-xl-7">

                    <h1 class="mb-4">Proyectos de Vinculación Con la Sociedad año 2025-2029</h1>
                    <p class="fs-5 mb-4 text-justify">La Dirección de Vinculación con la Sociedad en junio de 2024 lanzó
                        la convocatoria para la presentación de proyectos de vinculación con la sociedad, en el marco
                        del Plan de Vinculación 2025-2029,
                        que busca fortalecer la vinculación de la Universidad Técnica Luis Vargas Torres de Esmeraldas
                        con la comunidad, a través de proyectos que respondan a las necesidades y demandas sociales,
                        culturales y económicas de la provincia de Esmeraldas.
                    </p>
                    <div class="tab-class p-4">
                        <ul class="nav d-flex mb-2">
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 text-center bg-white active" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark" style="width: 150px;">Cantidad</span>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 mx-3 text-center bg-white" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 150px;">Requisitos</span>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="text-start my-auto">
                                                <p class="mb-4">La Dirección de Vinculación con la Sociedad presentó un
                                                    informe con 31 proyectos de cada una de las carreras, los cuales
                                                    fueron aprobados por el Consejo Superior Universitario, y que se
                                                    encuentran en ejecución actualmente. Estos proyectos están
                                                    fueron presentados por docentes de las diferentes carreras de la
                                                    UTLVTE.
                                                </p>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4"
                                                        href='/Docs/16_Agosto_Convocatoria_Proyectos_Vinculación_2024-signed.pdf'
                                                        download>Descargar la Convocatoria</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane fade show p-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex gallery-img">
                                            <div class="text-start gallery-overlay">
                                                <p class="mb-4">
                                                    Los proyectos de vinculación con la sociedad deben cumplir con los
                                                    siguientes requisitos:
                                                </p>
                                                <p><i class="fa fa-check text-primary me-3"></i>
                                                    Se presentará un ejemplar en soporte físico y otro en soporte
                                                    digital (USB) de todo el Proyecto...
                                                </p>
                                                <p><i class="fa fa-check text-primary me-3"></i>
                                                    Las propuestas de proyectos de vinculación deben desarrollarse
                                                    conforme al formato definido...
                                                </p>
                                                <div
                                                    class="d-flex align-items-center justify-content-start search-icon">
                                                    <!-- Botón que abre el modal -->
                                                    <button
                                                        class="btn-hover-bg btn btn-primary text-white py-2 px-4 my-auto"
                                                        @click="openPdfModal(6)">
                                                        Leer más
                                                    </button>
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
    <!-- Features Start -->
    <div class="container-xxl feature py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Equipo de los proyectos
                        de Vinculación</p>
                    <h1 class="display-5 mb-4">Conformación de los proyectos de Vinculacioón con la Sociedad</h1>
                    <p class="mb-4">Los proyectos de vinculación con la sociedad estarán conformados por un
                        equipo de trabajo integrado por docentes, estudiantes y personal administrativo. Con los roles
                        de:
                    </p>

                </div>
                <div class="col-lg-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <div class="row g-4">
                                <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="feature-box border rounded p-4">
                                        <i class="fa fa-check fa-3x text-primary mb-3"></i>
                                        <h4 class="mb-3">Director (a) y/o Subdirector(a)</h4>
                                        <p class="mb-3">Son los
                                            profesores(as) Titulares u Ocasionales que lideran la formulación, ejecución
                                            y evaluación......</p>
                                        <a class="fw-semi-bold" href="" data-bs-toggle="modal"
                                            data-bs-target="#funcionesModal2">Leer Más <i
                                                class="fa fa-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                                <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="feature-box border rounded p-4">
                                        <i class="fa fa-check fa-3x text-primary mb-3"></i>
                                        <h4 class="mb-3">Profesores(as) participantes</h4>
                                        <p class="mb-3">Son los y las
                                            profesores(as) Titulares u Ocasionales que participan activamente en la
                                            formulación...</p>
                                        <a class="fw-semi-bold" href="" data-bs-toggle="modal"
                                            data-bs-target="#funcionesModal3">Leer Más <i
                                                class="fa fa-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                            <div class="feature-box border rounded p-4">
                                <i class="fa fa-check fa-3x text-primary mb-3"></i>
                                <h4 class="mb-3">Estudiantado participante</h4>
                                <p class="mb-3">Son los y las
                                    estudiantes que participan activamente en la formulación...</p>
                                <a class="fw-semi-bold" href="" data-bs-toggle="modal"
                                    data-bs-target="#funcionesModal4">Leer Más <i
                                        class="fa fa-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->
    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Proyectos de</h5>
                <h1 class="mb-0">Vinculación 2025-2029</h1>
            </div>
            <div class="testimonial-carousel owl-carousel">
                <div class="testimonial-item text-center rounded pb-4" v-for="(proy, index) in proyectos" :key="index">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">NOMBRE DEL PROYECTO: {{ proy.nombre_proyecto }}
                        </p>
                        <p class="text-center mb-5">
                            LÍNEA DE INVESTIGACIÓN:
                            {{ proy.lineas_investigacion && proy.lineas_investigacion.length > 0
                                ? proy.lineas_investigacion[0].nombre_linea
                            : 'No definida' }}
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="@/assets/img/img/logovincu.jpeg" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">FACULTAD PROPONENTE: {{ proy.facultad_principal }}</h5>
                        <p class="mb-0">Codigo Proyecto: {{ proy.codigo_proyecto }}</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true"
        ref="pdfModal">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Convocatoria de Proyectos</h5>
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

    <div class="modal fade" id="funcionesModal2" tabindex="-1" aria-labelledby="funcionesModal2Label"
        aria-hidden="true">
        <div class="modal-dialog custom-modal modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title text-primary fw-bold" id="funcionesModal12Label">
                        <i class="fas fa-users-cog me-2"></i> Directores y/o Subdirectores de Proyectos de Vinculación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4 bg-light packages">
                    <div class="text-center mb-5">
                        <h5 class="text-uppercase text-primary">Directores de Proyectos de Vinculación</h5>
                        <p class="text-muted mx-auto" style="max-width: 900px;">
                            Son los
                            profesores(as) Titulares u Ocasionales que lideran la formulación, ejecución y evaluación
                            del proyecto de vinculación presentado y aprobados por el Consejo Superior Universitario.
                            Son sus funciones las siguientes:
                        </p>
                        <h3 class="mb-0 text-dark">
                            Estos son los Directores de los <span class="text-primary">{{ directproyectos.length
                            }}</span> proyectos de vinculación con la sociedad aprobados
                        </h3>
                    </div>
                    <div class="packages-carousel owl-carousel">
                        <div class="packages-item" v-for="(directpro, index) in directproyectos" :key="index">
                            <div class="packages-img">
                                <div class="position-relative overflow-hidden w-100"
                                    style="aspect-ratio: 1 / 1; background-color: #f4f6f9;">
                                    <img :src="getPhotoUrl2(directpro.cedula) || require('@/assets/img/img/logovincusinfondo.png')"
                                        @error="onImageError" class="w-100 h-100"
                                        style="object-fit: cover; object-position: center;" alt="Foto miembro">
                                </div>
                                <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                                    style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-map-marker-alt me-2"></i>Esmeraldas - Ecuador
                                    </small>
                                </div>
                            </div>

                            <div class="packages-content">
                                <div class="p-4 pb-0">
                                    <h5 class="mb-0">{{ directpro.nombre_con_titulo }}</h5>
                                    <div class="mb-3">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                    <p class="mb-4">Proyecto: {{ directpro.proyecto_nombre }}</p>
                                </div>
                                <div class="row rounded-bottom mx-0 boton">
                                    <div class="col-12 text-center px-0">

                                        <a class="btn-hover btn text-white py-2 px-4 w-100 text-wrap d-flex align-items-center justify-content-center"
                                            style="min-height: 60px;" href="#" v-if="directpro.siglas === 'SC'">
                                            {{ directpro.carrera }} - SEDE LA CONCORDIA
                                        </a>

                                        <a class="btn-hover btn text-white py-2 px-4 w-100 text-wrap d-flex align-items-center justify-content-center"
                                            style="min-height: 60px;" href="#" v-else>
                                            {{ directpro.carrera }} - {{ directpro.siglas }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-5">
                        <h5 class="text-uppercase text-primary">Sudirectores de Proyectos de Vinculación</h5>
                        <p class="text-muted mx-auto" style="max-width: 900px;">
                            Son los
                            profesores(as) Titulares u Ocasionales que lideran la formulación, ejecución y evaluación
                            del proyecto de vinculación presentado y aprobados por el Consejo Superior Universitario.
                            Son sus funciones las siguientes:
                        </p>
                        <h3 class="mb-0 text-dark">
                            Estos son los Subdirectores de los <span class="text-primary">{{ subdirectores.length
                            }}</span> proyectos de vinculación con la sociedad aprobados
                        </h3>
                    </div>
                    <div class="packages-carousel owl-carousel">
                        <div class="packages-item" v-for="(subdirec, index) in subdirectores" :key="index">
                            <div class="packages-img">
                                <div class="position-relative overflow-hidden w-100"
                                    style="aspect-ratio: 1 / 1; background-color: #f4f6f9;">
                                    <img :src="getPhotoUrl2(subdirec.cedula) || require('@/assets/img/img/logovincusinfondo.png')"
                                        @error="onImageError" class="w-100 h-100"
                                        style="object-fit: cover; object-position: center;" alt="Foto miembro">
                                </div>
                                <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                                    style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-map-marker-alt me-2"></i>Esmeraldas - Ecuador
                                    </small>
                                </div>
                            </div>

                            <div class="packages-content">
                                <div class="p-4 pb-0">
                                    <h5 class="mb-0">{{ subdirec.nombre_con_titulo }}</h5>
                                    <div class="mb-3">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                    <p class="mb-4">Proyecto: {{ subdirec.proyecto_nombre }}</p>
                                </div>
                                <div class="row rounded-bottom mx-0 boton">
                                    <div class="col-12 text-center px-0">

                                        <a class="btn-hover btn text-white py-2 px-4 w-100 text-wrap d-flex align-items-center justify-content-center"
                                            style="min-height: 60px;" href="#" v-if="subdirec.siglas === 'SC'">
                                            {{ subdirec.carrera }} - SEDE LA CONCORDIA
                                        </a>

                                        <a class="btn-hover btn text-white py-2 px-4 w-100 text-wrap d-flex align-items-center justify-content-center"
                                            style="min-height: 60px;" href="#" v-else>
                                            {{ subdirec.carrera }} - {{ subdirec.siglas }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-5" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cerrar Ventana
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="funcionesModal3" tabindex="-1" aria-labelledby="funcionesModal3Label"
        aria-hidden="true">
        <div class="modal-dialog custom-modal modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title text-primary fw-bold" id="funcionesModal3Label">
                        <i class="fas fa-users-cog me-2"></i> Profesores(as) participantes en los Proyectos de
                        Vinculación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4 bg-light packages">
                    <div class="text-center mb-5">
                        <h5 class="text-uppercase text-primary">Profesores(as) de Proyectos de Vinculación</h5>
                        <p class="text-muted mx-auto" style="max-width: 900px;">
                            Son los y las
                            profesores(as) Titulares u Ocasionales que participan activamente en la formulación,
                            ejecución y evaluación del proyecto de vinculación al cual pertenecen
                        </p>
                        <h3 class="mb-0 text-dark">
                            Estos son los Profesores(as) de los <span class="text-primary">{{ directproyectos.length
                            }}</span> proyectos de vinculación con la sociedad aprobados
                        </h3>
                    </div>
                    <div class="packages-carousel owl-carousel">
                        <div class="packages-item" v-for="(profe, index) in profesores" :key="index">
                            <div class="packages-img">
                                <div class="position-relative overflow-hidden w-100"
                                    style="aspect-ratio: 1 / 1; background-color: #f4f6f9;">
                                    <img :src="getPhotoUrl2(profe.cedula) || require('@/assets/img/img/logovincusinfondo.png')"
                                        @error="onImageError" class="w-100 h-100"
                                        style="object-fit: cover; object-position: center;" alt="Foto miembro">
                                </div>
                                <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                                    style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-map-marker-alt me-2"></i>Esmeraldas - Ecuador
                                    </small>
                                </div>
                            </div>

                            <div class="packages-content">
                                <div class="p-4 pb-0">
                                    <h5 class="mb-0">{{ profe.nombre_con_titulo }}</h5>
                                    <div class="mb-3">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                    <p class="mb-4">Proyecto: {{ profe.proyecto_nombre }}</p>
                                </div>
                                <div class="row rounded-bottom mx-0 boton">
                                    <div class="col-12 text-center px-0">

                                        <a class="btn-hover btn text-white py-2 px-4 w-100 text-wrap d-flex align-items-center justify-content-center"
                                            style="min-height: 60px;" href="#" v-if="profe.siglas === 'SC'">
                                            {{ profe.carrera }} - SEDE LA CONCORDIA
                                        </a>

                                        <a class="btn-hover btn text-white py-2 px-4 w-100 text-wrap d-flex align-items-center justify-content-center"
                                            style="min-height: 60px;" href="#" v-else>
                                            {{ profe.carrera }} - {{ profe.siglas }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0 justify-content-center bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-5" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cerrar Ventana
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="funcionesModal4" tabindex="-1" aria-labelledby="funcionesModal4Label"
        aria-hidden="true">
        <div class="modal-dialog custom-modal modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title text-primary fw-bold" id="funcionesModal4Label">
                        <i class="fas fa-users-cog me-2"></i> Estudiantado participante en los Proyectos de Vinculación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4 bg-light packages">
                    <div class="text-center mb-5">
                        <h5 class="text-uppercase text-primary">Estudiantado participante en los Proyectos de
                            Vinculación</h5>
                        <p class="text-muted mx-auto" style="max-width: 900px;">
                            Son los y las
                            estudiantes que participan activamente en la formulación, ejecución y evaluación del
                            proyecto de vinculación al cual pertenecen
                        </p>
                        <h3 class="mb-0 text-dark">
                            Estos son los Estudiantes de los <span class="text-primary">{{ directproyectos.length
                            }}</span> proyectos de vinculación con la sociedad aprobados
                        </h3>
                    </div>
                    <div class="packages-carousel owl-carousel">
                        <div class="packages-item" v-for="(est, index) in estudiantes" :key="index">
                            <div class="packages-img">
                                <div class="position-relative overflow-hidden w-100"
                                    style="aspect-ratio: 1 / 1; background-color: #f4f6f9;">
                                    <img :src="getPhotoUrl3(est.cedula) || require('@/assets/img/img/logovincusinfondo.png')"
                                        @error="onImageError" class="w-100 h-100"
                                        style="object-fit: cover; object-position: center;" alt="Foto miembro">
                                </div>
                                <div class="packages-info d-flex border border-start-0 border-end-0 position-absolute"
                                    style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                                    <small class="flex-fill text-center border-end py-2">
                                        <i class="fa fa-map-marker-alt me-2"></i>Esmeraldas - Ecuador
                                    </small>
                                </div>
                            </div>

                            <div class="packages-content">
                                <div class="p-4 pb-0">
                                    <h5 class="mb-0">{{ est.nombres_apellidos }}</h5>
                                    <div class="mb-3">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                    <p class="mb-4">Proyecto: {{ est.proyecto_nombre }}</p>
                                </div>
                                <div class="row rounded-bottom mx-0 boton">
                                    <div class="col-12 text-center px-0">

                                        <a class="btn-hover btn text-white py-2 px-4 w-100 text-wrap d-flex align-items-center justify-content-center"
                                            style="min-height: 60px;" href="#" v-if="est.siglas === 'SC'">
                                            {{ est.carrera }} - SEDE LA CONCORDIA
                                        </a>

                                        <a class="btn-hover btn text-white py-2 px-4 w-100 text-wrap d-flex align-items-center justify-content-center"
                                            style="min-height: 60px;" href="#" v-else>
                                            {{ est.carrera }} - {{ est.siglas }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer border-0 justify-content-center bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-5" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cerrar Ventana
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
    name: 'proyectosnue',
    data() {
        return {
            baseUrl: "/vin",
            directproyectos: [],
            subdirectores: [],
            profesores: [],
            estudiantes: [],
            proyectos: [],
            // ruta base de tu PDF
            pdfUrl: '/Docs/16_Agosto_Convocatoria_Proyectos_Vinculación_2024-signed.pdf',
            // página inicial (se reemplaza al llamar al modal)
            pdfPage: 1
        }
    },
    computed: {
        pdfSrc() {
            return `${this.pdfUrl}#page=${this.pdfPage}`;
        }
    },
    async mounted() {
        await Promise.all([
            this.getDirectoresProyectos(),
            this.getSubdirecProyectos(),
            this.getProfesoreProyectos(),
            this.getEstProyectos(),
            this.getProyectos()
        ]);
    },
    methods: {
        openPdfModal(page) {
            this.pdfPage = page;
            const modalEl = this.$refs.pdfModal;
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        },
        getPhotoUrl2(ci) {
            // Si no hay CI, retornamos una imagen vacía o un placeholder
            if (!ci) return '';

            const baseURL2 = API.defaults.baseURL;
            // Usamos el timestamp para evitar problemas de caché al cambiar de integrante
            return `${baseURL2}/vin/getFotoDocente/${ci}`;
        },
        getPhotoUrl3(ci) {
            // Si no hay CI, retornamos una imagen vacía o un placeholder
            if (!ci) return '';

            const baseURL2 = API.defaults.baseURL;
            // Usamos el timestamp para evitar problemas de caché al cambiar de integrante
            return `${baseURL2}/vin/getFoto/${ci}`;
        },
        onImageError(event) {
            // Reemplazamos la imagen rota por tu logo por defecto dinámicamente
            event.target.src = require('@/assets/img/img/logovincusinfondo.png');
        },
        async getDirectoresProyectos() {
            try {
                const response = await API.get(`${this.baseUrl}/getDirectoresProyectosVinculacion`);
                this.directproyectos = response.data.data;
                this.$nextTick(() => {
                    const $carousel = $(".packages-carousel");

                    // Destruimos la instancia previa por si el mixin la inicializó vacía
                    if ($carousel.hasClass('owl-loaded')) {
                        $carousel.trigger('destroy.owl.carousel');
                        $carousel.removeClass('owl-hidden');
                        $carousel.find('.owl-stage-outer').children().unwrap();
                    }
                    const totalMiembros = this.directproyectos.length;
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
        async getSubdirecProyectos() {
            try {
                const response = await API.get(`${this.baseUrl}/getSubdirectoresProyectosVinculacion`);
                this.subdirectores = response.data.data;
                this.$nextTick(() => {
                    const $carousel = $(".packages-carousel");

                    // Destruimos la instancia previa por si el mixin la inicializó vacía
                    if ($carousel.hasClass('owl-loaded')) {
                        $carousel.trigger('destroy.owl.carousel');
                        $carousel.removeClass('owl-hidden');
                        $carousel.find('.owl-stage-outer').children().unwrap();
                    }
                    const totalMiembros = this.subdirectores.length;
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
        async getProfesoreProyectos() {
            try {
                const response = await API.get(`${this.baseUrl}/getDocentesProyectosVinculacion`);
                this.profesores = response.data.data;
                this.$nextTick(() => {
                    const $carousel = $(".packages-carousel");

                    // Destruimos la instancia previa por si el mixin la inicializó vacía
                    if ($carousel.hasClass('owl-loaded')) {
                        $carousel.trigger('destroy.owl.carousel');
                        $carousel.removeClass('owl-hidden');
                        $carousel.find('.owl-stage-outer').children().unwrap();
                    }
                    const totalMiembros = this.profesores.length;
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
        async getEstProyectos() {
            try {
                const response = await API.get(`${this.baseUrl}/getEstudiantesProyectosVinculacion`);
                this.estudiantes = response.data.data;
                this.$nextTick(() => {
                    const $carousel = $(".packages-carousel");

                    // Destruimos la instancia previa por si el mixin la inicializó vacía
                    if ($carousel.hasClass('owl-loaded')) {
                        $carousel.trigger('destroy.owl.carousel');
                        $carousel.removeClass('owl-hidden');
                        $carousel.find('.owl-stage-outer').children().unwrap();
                    }
                    const totalMiembros = this.estudiantes.length;
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
        async getProyectos() {
            try {
                const response = await API.get(`${this.baseUrl}/getProyectosVinculacionInfo`);
                this.proyectos = response.data.data;
                console.log(this.proyectos);
                this.$nextTick(() => {
                    const $carousel = $(".testimonial-carousel");

                    // Destruimos la instancia previa por si el mixin la inicializó vacía
                    if ($carousel.hasClass('owl-loaded')) {
                        $carousel.trigger('destroy.owl.carousel');
                        $carousel.removeClass('owl-hidden');
                        $carousel.find('.owl-stage-outer').children().unwrap();
                    }
                    const totalMiembros = this.proyectos.length;
                    const activarEfectos = totalMiembros > 5;

                    // Inicializamos el carrusel con los datos reales
                    $carousel.owlCarousel({
                        autoplay: activarEfectos,
                        smartSpeed: 1000,
                        center: true,
                        dots: false,
                        loop: activarEfectos,
                        margin: 25,
                        nav: activarEfectos,
                        navText: [
                            '<i class="far fa-hand-point-left"></i>',
                            '<i class="far fa-hand-point-right"></i>',
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

        closePdfModal() {
            const modalEl = this.$refs.pdfModal;
            const modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
        }
    },

    mixins: [script2]
};
</script>

<style scoped>
@import url('@/assets/styles/css/style.css');

.modal-xl {
    max-width: 90%;
}

.custom-modal {
    max-width: 1200px;
    /* o el valor que prefieras */
    width: 100%;
}
</style>
