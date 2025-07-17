<template>
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <div class="container-fluid services py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 800px;">
                <h1 class="display-3">Noticias y Novedades</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-3" v-for="post in publicaciones" :key="post.id">
                    <div class="causes-item">
                        <div class="causes-img overflow-hidden rounded">
                            <img :src="post.full_picture" class="img-post img-fluid w-100" alt="Image">
                            <div class="causes-link pb-2 px-3">
                                <small class="text-white"><i class="fa fa-comments text-primary me-2"></i>Comentarios:
                                    {{ post.estadisticas?.comentarios }} </small>
                                <small class="text-white"><i class="fa fa-share text-primary me-2"></i>Compartidas:
                                    {{ post.estadisticas?.compartidas }} </small>
                            </div>
                            <div class="causes-dination p-2">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#"
                                    data-bs-toggle="modal" data-bs-target="#modalNoticia"
                                    @click.prevent="mostrarNoticia(post)">Ver aquí</a>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar"
                                :style="{ width: Math.min(post.estadisticas?.reacciones) + '%' }"
                                :aria-valuenow="post.estadisticas?.reacciones || 0" aria-valuemin="0"
                                aria-valuemax="500">
                                <span>{{ post.estadisticas?.reacciones || 0 }} </span>
                            </div>
                        </div>

                        <div class="causes-content p-4">
                            <h6 class="mb-3"><i class="fa fa-calendar"></i> {{
                                formatearFechaInteligente(post.created_time) }}</h6>
                            <p class="mb-4">{{ post.message.slice(0, 80) }}...</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" :href="post.permalink_url"
                                target="_blank">Ver en Facebook
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="modalNoticia" tabindex="-1" aria-labelledby="modalNoticiaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNoticiaLabel">{{ noticiaSeleccionada?.estadisticas?.titulo ||
                        'Noticia' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="overflow-hidden rounded">
                        <img :src="noticiaSeleccionada?.full_picture" class="img-fluid mb-3" alt="Imagen de noticia">
                        <div class="causes-link pb-2 px-3">
                            <small class=""><i class="fa fa-comments text-primary me-2"></i>Comentarios: 
                                {{ noticiaSeleccionada?.estadisticas?.comentarios }}  </small> &nbsp;&nbsp;&nbsp;&nbsp;
                            <small class=""><i class="fa fa-share text-primary me-2"></i>Compartidas:
                                {{ noticiaSeleccionada?.estadisticas?.compartidas }} </small> &nbsp;&nbsp;&nbsp;&nbsp;
                            <small class=""><i class="fa fa-thumbs-up text-primary me-2"></i>Reacciones:
                                {{ noticiaSeleccionada?.estadisticas?.reacciones }} </small> &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <h6 class="mb-3"><i class="fa fa-calendar"></i>
                        {{ formatearFechaInteligente(noticiaSeleccionada?.created_time) }}</h6>
                    <p class="text-"><strong></strong> {{ noticiaSeleccionada?.message }}</p>
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
import script3 from '@/assets/scripts/js/noticias.js'
export default {
    mixins: [script2, script3],
    name: 'noticias',

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
