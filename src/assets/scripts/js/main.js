import { WOW } from "wowjs";
import "waypoints/lib/jquery.waypoints.min.js";
import "jquery.counterup/jquery.counterup.min.js";

import $ from "jquery";
window.$ = $;
window.jQuery = $;

export default {
  name: "App",
  mounted() {
    setTimeout(() => {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);

    new WOW().init();

    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 300) {
        $(".sticky-top").addClass("shadow-sm").css("top", "0px");
      } else {
        $(".sticky-top").removeClass("shadow-sm").css("top", "-200px");
      }
    });

    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 300) {
        $(".back-to-top").fadeIn("slow");
      } else {
        $(".back-to-top").fadeOut("slow");
      }
    });
    $(".back-to-top").on("click", function () {
      $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
      return false;
    });

    if ($.fn.owlCarousel) {
      $(".pricing-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: false,
        dots: true,
        loop: true,
        margin: 25,
        nav: true,
        navText: [
          '<i class="bi bi-arrow-left"></i>',
          '<i class="bi bi-arrow-right"></i>',
        ],
        responsiveClass: true,
        responsive: {
          0: { items: 1 },
          576: { items: 2 },
          768: { items: 2 },
          992: { items: 3 },
          1200: { items: 4 },
        },
      });

      $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        dots: true,
        loop: true,
        margin: 25,
        nav: true,
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

      $(".event-carousel").owlCarousel({
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

      $(".packages-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: false,
        dots: false,
        loop: true,
        margin: 25,
        nav: true,
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
      $(".project-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 25,
        loop: true,
        center: true,
        dots: false,
        nav: true,
        navText: [
          '<i class="bi bi-chevron-left"></i>',
          '<i class="bi bi-chevron-right"></i>',
        ],
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
          },
          576: {
            items: 1,
          },
          768: {
            items: 2,
          },
          992: {
            items: 3,
          },
        },
      });
    } else {
      console.warn(
        "owlCarousel no está definido. Asegúrate de incluirlo correctamente."
      );
    }

    $(".progress").waypoint(
      function () {
        $(".progress-bar").each(function () {
          $(this).css("width", $(this).attr("aria-valuenow") + "%");
        });
      },
      { offset: "80%" }
    );

    // Modal Video: Configura los eventos para reproducir/parar el video
    let videoSrc;
    // Como ya estamos en mounted, no hace falta $(document).ready
    $(".btn-play").on("click", function () {
      videoSrc = $(this).data("src");
    });

    $("#videoModal").on("shown.bs.modal", function () {
      $("#video").attr(
        "src",
        videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"
      );
    });

    $("#videoModal").on("hide.bs.modal", function () {
      $("#video").attr("src", videoSrc);
    });

    // Contador de hechos: Inicializa counterUp
    $('[data-toggle="counter-up"]').counterUp({
      delay: 5,
      time: 2000,
    });
   this.initCarAnimation();
  
  },
  methods: {
    initCarAnimation() {
      const car = document.querySelector('.car-sprite');
      const carImage = document.querySelector('.car-image');
      const carWidth = carImage.offsetWidth;
      let carLeft = 0;
      let carTop = 0;
      let carSpeed = 0;

      function animateCar() {
        carLeft += carSpeed;
        car.style.left = `${carLeft}px`;
        if (carLeft > carWidth) {
          carLeft = -carWidth;
          carSpeed = -carSpeed;
        } else if (carLeft < -carWidth) {
          carLeft = carWidth;
          carSpeed = -carSpeed;
        }
        requestAnimationFrame(animateCar);
      }

      animateCar();
    },
  },
  computed: {
    showNavbar() {
      return this.$route.name !== "error404" && this.$route.name !== "login";
    },
    showNavbar2() {
      return this.$route.name !== "login";
    },
  },
};
