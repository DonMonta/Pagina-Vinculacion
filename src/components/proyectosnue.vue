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
                                        <a class="fw-semi-bold" href="">Leer Más <i
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
                                <a class="fw-semi-bold" href="">Leer Más <i class="fa fa-arrow-right ms-1"></i></a>
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
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">NOMBRE DEL PROYECTO: Fortalecimiento de las capacidades locales del
                            Sector Agropecuario de 5 Parroquias rurales del Cantón Esmeraldas
                        </p>
                        <p class="text-center mb-5"> LÍNEA DE INVESTIGACIÓN: Desarrollo agropecuario sostenible
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="@/assets/img/img/facultades/faci.jpg" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">FACULTAD PROPONENTE: FACAP</h5>
                        <p class="mb-0">Carrera:</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">NOMBRE DEL PROYECTO: Capacitaciones continuas y asesorías técnicas
                            relacionadas con aspectos sociales, tecnológicos y ambientales para el desarrollo
                            socio-económico de la Provincia de Esmeraldas
                        </p>
                        <p class="text-center mb-5">LÍNEA DE INVESTIGACIÓN: Desarrollo de sectores tecnológicos y
                            productivos
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="@/assets/img/img/facultades/faci.jpg" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">FACULTAD PROPONENTE: FACI</h5>
                        <p class="mb-0">Carrera:</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">NOMBRE DEL PROYECTO: Fomento innovador de modelos empresariales y
                            gestión de la calidad a emprendimientos y MiPymes en el entorno comercial, económico,
                            social, ambiental y tecnológico de la Provincia de Esmeraldas
                        </p>
                        <p class="text-center mb-5">LÍNEA DE INVESTIGACIÓN: Desarrollo local y perfeccionamiento
                            empresarial
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="@/assets/img/img/facultades/FACAE.jpg" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">FACULTAD PROPONENTE: FACAE</h5>
                        <p class="mb-0">Carrera:</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">NOMBRE DEL PROYECTO: La FACPED impulsando el desarrollo educativo,
                            la cultura, los saberes ancestrales y la recreaciión en la Provincia de Esmeraldas
                        </p>
                        <p class="text-center mb-5">LÍNEA DE INVESTIGACIÓN: Educación y Sociedad / Desarrollo de
                            sectores tecnológicos y productivos
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="@/assets/img/img/facultades/FACPED.jpg" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">FACULTAD PROPONENTE: FACPED</h5>
                        <p class="mb-0">Carrera:</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">NOMBRE DEL PROYECTO: Centro de transferencia tecnológica y apoyo al
                            emprendimiento para el desarrollo socioeconómico de la población del Cantón La Concordia
                        </p>
                        <p class="text-center mb-5">LÍNEA DE INVESTIGACIÓN: Desarrollo local y perfeccionamiento
                            empresarial / Desarrollo de sectores tecnológicos y productivos
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="@/assets/img/img/facultades/SEDE LA CONCORDIA.png" class="img-fluid rounded-circle"
                            alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">FACULTAD PROPONENTE: SEDE LA CONCORDIA</h5>
                        <p class="mb-0">Carrera:</p>
                        <div class="d-flex justify-content-center">
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                            <i class="fas fa-star text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item text-center rounded pb-4">
                    <div class="testimonial-comment bg-light rounded p-4">
                        <p class="text-center mb-5">NOMBRE DEL PROYECTO: Fortalecimiento del tejido social a través de
                            la conformación del Consejo Consultivo Interinstitucional de Vinculación con la Sociedad
                            para el desarrollo socioeconómico de la Provincia de Esmeraldas
                        </p>
                        <p class="text-center mb-5">LÍNEA DE INVESTIGACIÓN: Desarrollo, memoria social histórica /
                            Desarrollo local y perfeccionamiento empresarial
                        </p>
                    </div>
                    <div class="testimonial-img p-1">
                        <img src="@/assets/img/img/facultades/faci.jpg" class="img-fluid rounded-circle" alt="Image">
                    </div>
                    <div style="margin-top: -35px;">
                        <h5 class="mb-0">FACULTAD PROPONENTE: FACSOS</h5>
                        <p class="mb-0">Carrera:</p>
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
    <!-- Modal 2 -->
    <div class="modal fade" id="funcionesModal2" tabindex="-1" aria-labelledby="funcionesModal2Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg custom-modal modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="funcionesModal2Label">
                        Director (a) y/o Subdirector(a) de Proyectos de Vinculación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <!-- Projects Start -->
                    <div class="container-xxl py-3">
                        <div class="container">
                            <div class="text-center mx-auto" style="max-width: 600px;">
                                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Son los
                                    profesores(as) Titulares u Ocasionales que lideran la formulación, ejecución y
                                    evaluación
                                    del proyecto de vinculación presentado y aprobados por el Consejo Superior
                                    Universitario</p>
                                <h3 class="display-5 mb-5">
                                </h3>
                            </div>
                            <div class="container section-title py-3">
                                <h2>Directores de los Proyectos de Vinculación con la Sociedad</h2>
                                <p>Estas son los directores de los proyectos de vinculación con la sociedad de cada
                                    carrera
                                </p>
                            </div>
                            <div class="project-carousel owl-carousel">
                                <div class="project-item pe-5 pb-5">
                                    <div class="position-relative overflow-hidden">
                                        <img class="img-fluid" src="@/assets/img/img/logovincu.jpeg" alt="">
                                    </div>
                                    <div class="project-title">
                                        <div class="bg-light">
                                            <h5 class="fw-bold mb-0">Full Name</h5>
                                            <small>Designation</small>
                                        </div>
                                        <div class="bg-primary">
                                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                                        </div>
                                    </div>


                                </div>
                                <div class="project-item pe-5 pb-5">
                                    <div class="project-img mb-3">
                                        <img class="img-fluid rounded" src="@/assets/img/img/logovincu.jpeg" alt="">
                                        <a href=""><i class="fa fa-link fa-3x text-primary"></i></a>
                                    </div>
                                    <div class="project-title">
                                        <h4 class="mb-0">Cash Investment</h4>
                                    </div>
                                </div>
                                <div class="project-item pe-5 pb-5">
                                    <div class="project-img mb-3">
                                        <img class="img-fluid rounded" src="@/assets/img/img/logovincu.jpeg" alt="">
                                        <a href=""><i class="fa fa-link fa-3x text-primary"></i></a>
                                    </div>
                                    <div class="project-title">
                                        <h4 class="mb-0">Financial Consultancy</h4>
                                    </div>
                                </div>
                                <div class="project-item pe-5 pb-5">
                                    <div class="project-img mb-3">
                                        <img class="img-fluid rounded" src="@/assets/img/img/logovincu.jpeg" alt="">
                                        <a href=""><i class="fa fa-link fa-3x text-primary"></i></a>
                                    </div>
                                    <div class="project-title">
                                        <h4 class="mb-0">Business Loans</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Projects End -->
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
    name: 'proyectosnue',
    data() {
        return {
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
