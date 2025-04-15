<template>
    <div
      id="spinner"
      class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center"
    >
      <div class="spinner-grow text-primary" role="status"></div>
    </div>
     <div class="container-fluid services py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 800px;">
                <h1 class="display-3">Noticias y Novedades</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-3">
                    <div class="causes-item">
                        <div class="causes-img">
                            <img src="@/assets/img/img/causes-4.jpg" class="img-fluid w-100" alt="Image">
                            <div class="causes-link pb-2 px-3">
                                <small class="text-white"><i class="fas fa-chart-bar text-primary me-2"></i>Goal: $3600</small>
                                <small class="text-white"><i class="fa fa-thumbs-up text-primary me-2"></i>Raised: $4000</small>
                            </div>
                            <div class="causes-dination p-2">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Donate Now</a>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                <span>65%</span>
                            </div>
                        </div>
                        <div class="causes-content p-4">
                            <h4 class="mb-3">First environments activity of</h4>
                            <p class="mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="causes-item">
                        <div class="causes-img">
                            <img src="@/assets/img/img/causes-4.jpg" class="img-fluid w-100" alt="Image">
                            <div class="causes-link pb-2 px-3">
                                <small class="text-white"><i class="fas fa-chart-bar text-primary me-2"></i>Goal: $3600</small>
                                <small class="text-white"><i class="fa fa-thumbs-up text-primary me-2"></i>Raised: $4000</small>
                            </div>
                            <div class="causes-dination p-2">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Donate Now</a>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                <span>65%</span>
                            </div>
                        </div>
                        <div class="causes-content p-4">
                            <h4 class="mb-3">First environments activity of</h4>
                            <p class="mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="causes-item">
                        <div class="causes-img">
                            <img src="@/assets/img/img/causes-4.jpg" class="img-fluid w-100" alt="Image">
                            <div class="causes-link pb-2 px-3">
                                <small class="text-white"><i class="fas fa-chart-bar text-primary me-2"></i>Goal: $3600</small>
                                <small class="text-white"><i class="fa fa-thumbs-up text-primary me-2"></i>Raised: $4000</small>
                            </div>
                            <div class="causes-dination p-2">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Donate Now</a>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                <span>85%</span>
                            </div>
                        </div>
                        <div class="causes-content p-4">
                            <h4 class="mb-3">Building clean-water system for rural poor.</h4>
                            <p class="mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="causes-item">
                        <div class="causes-img">
                            <img src="@/assets/img/img/causes-4.jpg" class="img-fluid w-100" alt="Image">
                            <div class="causes-link pb-2 px-3">
                                <small class="text-white"><i class="fas fa-chart-bar text-primary me-2"></i>Goal: $3600</small>
                                <small class="text-white"><i class="fa fa-thumbs-up text-primary me-2"></i>Raised: $4000</small>
                            </div>
                            <div class="causes-dination p-2">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-3" href="#">Donate Now</a>
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                <span>95%</span>
                            </div>
                        </div>
                        <div class="causes-content p-4">
                            <h4 class="mb-3">First environments activity of this summer.</h4>
                            <p class="mb-4">Help today because tomorrow you may be the one who needs more helping!</p>
                            <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
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
  name: 'noticias',
  
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
