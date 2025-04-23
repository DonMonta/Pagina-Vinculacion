<template>
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <div class="container-fluid services py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 800px;">
                <h1 class="display-3">Normativas de la Dirección de Vinculación con la Sociedad</h1>
            </div>

        </div>
    </div>
    <!-- Service Start -->
    <div class="container-xxl service1 py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded text-primary fw-semi-bold py-1 px-3">Conoce</p>
                <h1 class="display-5 mb-5">Normativas Vigentes</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-4">
                    <div class="nav nav-pills d-flex justify-content-between w-100 h-100 me-4">
                        <button class="nav-link w-100 d-flex align-items-center text-start border p-4 mb-4"
                            v-for="(book, index) in books" :key="book.id" @click="activeTab = index"
                            :class="['nav-link', { active: activeTab === index }]" type="button">
                            <h5 class="m-0"><i class="fa fa-bars text-primary me-3"></i>
                                {{ book.label }}</h5>
                        </button>

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="flipbook-wrapper w-100">
                        <div v-for="(book, index) in books" :key="book.id" v-show="activeTab === index">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="position-relative h-100">
                                        <div class="flipbook-container" ref="flipbookContainers"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-4"> {{ book.titulo }}</h3>
                                    <p class="mb-4"> {{ book.descripcion }}</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>{{ book.elaborado }}</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>{{ book.revisado }}</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>{{ book.aprobado }}</p>
                                    <a href="" class="btn btn-primary py-3 px-5 mt-3 text-white">Descargar Documento</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
</template>

<script>
import 'owl.carousel';
import script2 from '@/assets/scripts/js/main.js'
import { PageFlip } from 'page-flip';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

export default {
    name: 'normativas',
    data() {
        return {
            activeTab: 0,
            config: {
                width: 430,
                height: 560,
                size: 'fixed',
                minWidth: 315,
                maxWidth: 1000,
                minHeight: 400,
                maxHeight: 1536,
                maxShadowOpacity: 0.5,
                showCover: true,
                mobileScrollSupport: false
            },
            books: [
                {
                    id: 'flipbook1',
                    label: 'Reglamento Vinculación 2024',
                    titulo: 'Reglamento de Vinculación con la Sociedad 2024',
                    descripcion: 'Reglamento reformado de vinculación con la Sociedad, fue aprobado en la sesión ordinaria del Consejo Superior Universitario, el 10 de junio de 2024.',
                    elaborado: 'Elaborado por la MSc. Belen Amador Rodriguez. PhD',
                    revisado: 'Revisado por el Ing. Manuel Quiñonez, Ph.D. ',
                    aprobado: 'Aprobado por el Consejo Superior Universitario',
                    images: [require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0001.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0002.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0003.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0004.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0005.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0006.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0007.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0008.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0009.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0010.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0011.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0012.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0013.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0014.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0015.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0016.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0017.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0018.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0019.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0020.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0021.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0022.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0023.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0024.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0025.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0026.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0027.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0028.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0029.jpg'),
                    require('@/assets/Pdf/Reforma/reglamernto_vincul_reformado_page-0030.jpg'),]
                },
                {
                    id: 'flipbook2',
                    label: 'Reglamento de Prácticas Pre Profesionales',
                    titulo: 'Reglamento de Prácticas Pre Profesionales 2020',
                    descripcion: 'Reglamento reformado de Prácticas Pre Profesionales, fue aprobado en la sesión ordinaria del Consejo Superior Universitario, el 2 de octubre de 2020.',
                    elaborado: 'Elaborado por el Ing. Alex Quis e Mera. M.Sc',
                    revisado: 'Revisado por el Ing. Manuel Quiñonez, Ph.D. ',
                    aprobado: 'Aprobado por el Consejo Superior Universitario',
                    images: [require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0001.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0002.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0003.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0004.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0005.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0006.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0007.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0008.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0009.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0010.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0011.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0012.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0013.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0014.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0015.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0016.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0017.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0018.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0019.jpg'),
                    require('@/assets/Pdf/Reglamento/Reglamento de Prácticas Pre Profesionales Secretaría General_page-0020.jpg'),]
                },
                {
                    id: 'flipbook3',
                    label: 'Plan Institucional de Vinculación con la Sociedad UTLVTE',
                    titulo: 'Plan Institucional de Vinculación con la Sociedad UTLVTE 2020-2024',
                    descripcion: 'El Plan Institucional de Vinculación con la Sociedad de la Universidad Técnica Luis Vargas Torres de Esmeraldas plantea la implementación de los componentes de Proyectos '+
                    'de Vinculación, Prácticas Preprofesionales y de Servicio a la Sociedad; que beneficien a'+
                    ' nuestros estudiantes, comunidades, asociaciones productivas, de participación ciudadana,'+
                    'entre otras; para el mejoramiento y/o fortalecimiento de sus capacidades. Los beneficiarios'+
                    'serán todos aquellos que participen en los diferentes proyectos basados en los programas antes mencionados.',
                    elaborado: 'Elaborado por el Ing. Alex Quis e Mera. M.Sc',
                    revisado: 'Revisado por el Ing. Manuel Quiñonez, Ph.D. ',
                    aprobado: 'Aprobado por el Consejo Superior Universitario',
                    images: [require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0001.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0002.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0003.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0004.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0005.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0006.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0007.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0008.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0009.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0010.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0011.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0012.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0013.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0014.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0015.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0016.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0017.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0018.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0019.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0020.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0021.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0022.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0023.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0024.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0025.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0026.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0027.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0028.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0029.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0030.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0031.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0032.jpg'),
                        require('@/assets/Pdf/Plan/Plan Institucional de vinculación con la sociedad UTLVTE 2020-2024_page-0033.jpg'),
                    ]
                },
                {
                    id: 'flipbook4',
                    label: 'Reglamento del Sistema de Seguimiento a Graduados',
                    titulo: 'Reglamento del Sistema de Seguimiento a Graduados 2016',
                    descripcion: 'Reglamento del Sistema de Seguimiento a Graduados, fue aprobado en la sesión ordinaria del Consejo Superior Universitario, el 28 de julio de 2016.',
                    elaborado: 'Elaborado por el Ing. Harold Oyarvide Raniirez',
                    revisado: 'Revisado por el Ab. Félix Preciado Q. y la Ing. Norma Avovi Real ',
                    aprobado: 'Aprobado por el Consejo Superior Universitario',
                    images: [require('@/assets/Pdf/Seguimiento a Graduados/Reglamento del Sistema de Seguimiento a Graduados_29-09-2016-100035_page-0001.jpg'),
                            require('@/assets/Pdf/Seguimiento a Graduados/Reglamento del Sistema de Seguimiento a Graduados_29-09-2016-100035_page-0002.jpg'),
                            require('@/assets/Pdf/Seguimiento a Graduados/Reglamento del Sistema de Seguimiento a Graduados_29-09-2016-100035_page-0003.jpg'),
                            require('@/assets/Pdf/Seguimiento a Graduados/Reglamento del Sistema de Seguimiento a Graduados_29-09-2016-100035_page-0004.jpg'),
                            require('@/assets/Pdf/Seguimiento a Graduados/Reglamento del Sistema de Seguimiento a Graduados_29-09-2016-100035_page-0005.jpg'),
                            require('@/assets/Pdf/Seguimiento a Graduados/Reglamento del Sistema de Seguimiento a Graduados_29-09-2016-100035_page-0006.jpg'),
                            require('@/assets/Pdf/Seguimiento a Graduados/Reglamento del Sistema de Seguimiento a Graduados_29-09-2016-100035_page-0007.jpg'),
                            require('@/assets/Pdf/Seguimiento a Graduados/Reglamento del Sistema de Seguimiento a Graduados_29-09-2016-100035_page-0008.jpg'),
                       
                    ]
                }
            ],
            flipbookInstances: []
        };
    },
    mounted() {
        // Vue sets $refs.flipbookContainers as an array due to v-for
        this.$nextTick(() => {
            // Initialize first flipbook
            this.initOrUpdateFlipbook(this.activeTab);

            // Watch for tab changes
            this.$watch('activeTab', idx => {
                this.$nextTick(() => {
                    this.initOrUpdateFlipbook(idx);
                });
            });
        });
    },
    methods: {
        initOrUpdateFlipbook(index) {
            const containers = this.$refs.flipbookContainers;
            if (!containers || !containers[index]) return;
            const el = containers[index];
            // If instance exists, update
            if (this.flipbookInstances[index]) {
                this.flipbookInstances[index].update();
            } else {
                // Create new instance
                const pf = new PageFlip(el, this.config);
                pf.loadFromImages(this.books[index].images);
                this.flipbookInstances[index] = pf;
            }
        }
    },
    mixins: [script2]
};
</script>

<style scoped>
.flipbook-wrapper {
    width: 430px;
    height: 560px;
    margin: 0 auto;
    position: relative;
}

.flipbook-container {
    width: 100%;
    height: 100%;
}
</style>
