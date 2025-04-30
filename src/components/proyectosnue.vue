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
                                                        href='/Docs/16_Agosto_Convocatoria_Proyectos_Vinculación_2024-signed.pdf' download>Descargar la Convocatoria</a>
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
                            <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel"
                                aria-hidden="true" ref="pdfModal">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pdfModalLabel">Convocatoria de Proyectos</h5>
                                            <button type="button" class="btn-close" @click="closePdfModal()"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <!-- Iframe con el PDF -->
                                            <object :data="`${pdfUrl}#page=${pdfPage}`" type="application/pdf"
                                                width="100%" height="600">
                                                <p>
                                                    Tu navegador no soporta PDFs embebidos.
                                                    <a :href="`${pdfUrl}#page=${pdfPage}`" target="_blank"
                                                        rel="noopener">
                                                        Ábrelo aquí
                                                    </a>.
                                                </p>
                                            </object>
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
.modal-xl {
    max-width: 90%;
}
</style>
