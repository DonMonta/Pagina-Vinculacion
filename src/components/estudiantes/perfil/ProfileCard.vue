<template>
  <div>
    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
      <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
        <div class="flex flex-col items-center w-full gap-6 xl:flex-row">
          <div class="w-20 h-20 overflow-hidden border border-gray-200 rounded-full dark:border-gray-800">
            <img :src="getPhotoUrl(PersonalInfo.CIInfPer)" alt="user" />
          </div>
          <div class="order-3 xl:order-2">
            <h4 class="mb-2 text-lg font-semibold text-center text-gray-800 dark:text-white/90 xl:text-left">
              {{ PersonalInfo.NombInfPer }} {{ PersonalInfo.ApellInfPer }} {{ PersonalInfo.ApellMatInfPer }}
            </h4>
            <div class="flex flex-col items-center gap-1 text-center xl:flex-row xl:gap-3 xl:text-left">
              <p class="text-sm text-gray-500 dark:text-gray-400">{{ UsuarioInfo.carreraUsuario }} ({{
                UsuarioInfo.facultadUsuario }})</p>
              <div class="hidden h-3.5 w-px bg-gray-300 dark:bg-gray-700 xl:block"></div>
              <p class="text-sm text-gray-500 dark:text-gray-400">Nivel Actual: {{ UsuarioInfo.nivelUsuario }}to Ciclo
              </p>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
  <div>
    <div class="p-5 mb-6 border border-gray-200 rounded-2xl dark:border-gray-800 lg:p-6">
      <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
        <div>
          <h4 class="text-lg font-semibold text-gray-800 dark:text-white/90 lg:mb-6">
            Información Personal
          </h4>
          <p class="text-[11px] text-gray-400 italic">
            Nota: Los datos obtenidos aquí son los que usted tiene registrados en el SIAD.
          </p>
          <br>
          <div class="grid grid-cols-1 gap-4 lg:grid-cols-2 lg:gap-7 2xl:gap-x-32">
            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Nombre</p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ PersonalInfo.NombInfPer }}</p>
            </div>

            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Apellidos</p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ PersonalInfo.ApellInfPer }} {{
                PersonalInfo.ApellMatInfPer }}</p>
            </div>

            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">
                Correo personal
              </p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                {{ PersonalInfo.mailPer }}
              </p>
            </div>

            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Correo Institucional</p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">
                {{ PersonalInfo.mailInst }}
              </p>
            </div>

            <div>
              <p class="mb-2 text-xs leading-normal text-gray-500 dark:text-gray-400">Carrera</p>
              <p class="text-sm font-medium text-gray-800 dark:text-white/90">{{ UsuarioInfo.carreraUsuario }}</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div v-if="forminscripcion && UsuarioInfo.nivelUsuario >= 5"
    class="relative overflow-hidden p-6 border border-brand-100 bg-gradient-to-r from-brand-50/60 to-white rounded-2xl dark:border-brand-900/30 dark:from-brand-950/20 dark:to-gray-900 shadow-md shadow-brand-500/5">
    <div class="absolute -right-10 -top-10 w-40 h-40 bg-brand-500/10 rounded-full blur-2xl"></div>

    <div v-if="!yaInscrito"
      class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 relative z-10">
      <div class="max-w-3xl">
        <div
          class="inline-flex items-center gap-2 px-3 py-1 mb-4 text-xs font-semibold text-brand-700 bg-brand-100 rounded-full">
          <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span> Convocatoria Activa
        </div>
        <h4 class="text-xl font-extrabold text-gray-900 dark:text-white mb-3">¡Inscripciones Abiertas para Ayudantías de
          Cátedra!</h4>
        <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">Si cumples con los requisitos, postula
          completando el formulario obligatorio.</p>
      </div>
      <div class="w-full lg:w-auto shrink-0">
        <router-link to="/site-admin/formulario_catedra/inscripcion"
          class="inline-flex items-center justify-center w-full lg:w-auto px-6 py-3 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 rounded-xl shadow-lg hover:-translate-y-0.5 transition-all">
          Comenzar Inscripción <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </router-link>
      </div>
    </div>

    <div v-else class="relative z-10">
      <div
        class="inline-flex items-center gap-2 px-3 py-1 mb-4 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full">
        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Inscripción Registrada
      </div>

      <div
        class="p-5 bg-white/80 dark:bg-gray-800/80 border border-gray-100 dark:border-gray-700 rounded-xl backdrop-blur-sm">

        <div v-if="!evaluacionActiva" class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
          <div class="p-3 bg-amber-50 text-amber-500 rounded-lg"><svg class="w-6 h-6" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg></div>
          <div>
            <p class="text-base font-bold text-gray-900 dark:text-white">Proceso en espera</p>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Tu postulación ha sido guardada con éxito. Por
              favor, <b>espera a la fecha oficial para que se habilite el examen de conocimientos</b>.</p>
          </div>
        </div>

        <div v-else-if="evaluacionActiva && !yaEvaluacion"
          class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
          <div class="flex gap-4 items-center">
            <div class="p-3 bg-brand-50 text-brand-500 rounded-lg"><svg class="w-6 h-6" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg></div>
            <div>
              <p class="text-base font-bold text-gray-900 dark:text-white">¡El Examen de Admisión está habilitado!</p>
              <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Ya puedes proceder a rendir tu evaluación de
                conocimientos técnicos.</p>
            </div>
          </div>
          <router-link to="/site-admin/formulario_catedra/examen"
            class="inline-flex items-center px-6 py-2.5 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 rounded-xl shadow-md transition-all whitespace-nowrap">
            Empezar Examen <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </router-link>
        </div>

        <div v-else class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
          <div class="flex gap-4 items-center">
            <div class="p-3 bg-emerald-50 text-emerald-500 rounded-lg"><svg class="w-6 h-6" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg></div>
            <div>
              <p class="text-base font-bold text-gray-900 dark:text-white">Evaluación Completada</p>
              <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Has culminado exitosamente tu postulación y
                examen de admisión.</p>
            </div>
          </div>
          <button @click="abrirResultados"
            class="inline-flex items-center px-5 py-2.5 text-sm font-bold text-emerald-700 bg-emerald-100 hover:bg-emerald-200 rounded-xl transition-all whitespace-nowrap">
            Ver Calificación y Respuestas
          </button>
        </div>

      </div>
    </div>
  </div>
  <div v-if="mostrarModalResultados"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 z-99999">
    <div
      class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">

      <div
        class="p-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50 dark:bg-gray-800/50 rounded-t-2xl">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Hoja de Calificación - Examen de Cátedra</h3>
        <button class="text-gray-400 hover:text-gray-600 dark:hover:text-white" @click="mostrarModalResultados = false">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div class="p-6 overflow-y-auto flex-grow" v-if="detalleResultados">

        <div
          class="flex flex-col sm:flex-row gap-6 p-5 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm mb-6 items-center">
          <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-gray-100 shrink-0">
            <img :src="getPhotoUrl(detalleResultados.persona.CIInfPer)" alt="Perfil"
              class="w-full h-full object-cover" />
          </div>
          <div class="flex-grow text-center sm:text-left">
            <h4 class="text-base font-bold text-gray-900 dark:text-white">{{ detalleResultados.persona.NombInfPer }} {{
              detalleResultados.persona.ApellInfPer }} {{ detalleResultados.persona.ApellMatInfPer }}</h4>
            <p class="text-xs text-gray-500 mt-1">{{ detalleResultados.persona.NombCarr }} - {{
              detalleResultados.persona.nivel }}to Ciclo</p>
          </div>
          <div class="shrink-0 text-center px-6 py-3 rounded-xl border-2"
            :class="puntaje >= 7 ? 'bg-emerald-50 border-emerald-200 dark:bg-emerald-900/20 dark:border-emerald-800' : 'bg-red-50 border-red-200 dark:bg-red-900/20 dark:border-red-800'">
            <p class="text-xs font-bold uppercase tracking-wider mb-1"
              :class="puntaje >= 7 ? 'text-emerald-600' : 'text-red-600'">Calificación Final</p>
            <div class="text-3xl font-black"
              :class="puntaje >= 7 ? 'text-emerald-700 dark:text-emerald-400' : 'text-red-700 dark:text-red-400'">
              {{ puntaje }} <span class="text-lg text-gray-400 font-medium">/ {{ totalPreguntas }}</span>
            </div>
          </div>
        </div>

        <h4 class="font-bold text-gray-800 dark:text-white mb-4 uppercase text-xs tracking-wider">Detalle de Respuestas
          Seleccionadas</h4>

        <div class="space-y-4">
          <div v-for="(item, index) in detalleResultados.respuestas" :key="index" class="p-4 rounded-xl border"
            :class="item.valor == 1 ? 'bg-emerald-50/50 border-emerald-100 dark:bg-emerald-900/10 dark:border-emerald-900/50' : 'bg-red-50/50 border-red-100 dark:bg-red-900/10 dark:border-red-900/50'">

            <div class="flex justify-between items-start gap-4 mb-2">
              <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ index + 1 }}. {{ item.PREGUNTA }}</p>
              <div class="shrink-0 mt-0.5">
                <svg v-if="item.valor == 1" class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg v-else class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>

            <div
              class="mt-2 text-sm px-3 py-2 rounded-lg bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 flex items-center gap-2">
              <span class="font-bold text-gray-400">Tu respuesta:</span>
              <span class="font-medium"
                :class="item.valor == 1 ? 'text-emerald-700 dark:text-emerald-400' : 'text-red-700 dark:text-red-400'">
                {{ item.opcion_seleccionada || item.textorespuesta || 'No respondida' }}
              </span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import API from "@/assets/js/services/axios";
import { getMe } from '@/store/auth';
import { useUsuario } from "@/composables/useUsuario";
export default {
  data() {
    return {
      idus: 0,
      baseUrl: "/vin",
      PersonalInfo: {},
      UsuarioInfo: {},
      forminscripcion: false,
      yaInscrito: false,
      evaluacionActiva: false,
      yaEvaluacion: false,
      evaluacionFormularioId: null,

      // Modal Resultados
      mostrarModalResultados: false,
      detalleResultados: null,
      puntaje: 0,
      totalPreguntas: 0
    };
  },
  async mounted() {
    await getMe();
    const usuario = await getMe();
    this.PersonalInfo = usuario;
    this.UsuarioInfo = useUsuario();
    this.getFormulariosEstado();
  },
  methods: {
    getPhotoUrl(ci) {
      return `${API.defaults.baseURL}/vin/getFoto/${ci}`;
    },
    async getFormulariosEstado() {
      try {
        // 1. Obtener estado de Inscripción
        const resInscripcion = await API.get(`${this.baseUrl}/getCatedraInscripcion`, {
          params: { cedula: this.PersonalInfo.CIInfPer }
        });

        if (resInscripcion.data.data && resInscripcion.data.data.ACTIVO === 1) {
          this.forminscripcion = true;
          this.yaInscrito = resInscripcion.data.yaInscrito;

          // 2. Si ya está inscrito, verificamos si el examen de evaluación está habilitado
          if (this.yaInscrito) {
            const resEvaluacion = await API.get(`${this.baseUrl}/getCatedraEvaluacion`, {
              params: { cedula: this.PersonalInfo.CIInfPer }
            });
            console.log("Respuesta Evaluación:", resEvaluacion.data); // Debug

            if (resEvaluacion.data.data && resEvaluacion.data.data.ACTIVO === 1) {
              this.evaluacionActiva = true;
              this.evaluacionFormularioId = resEvaluacion.data.data.ID;
              // Ajustado para capturar la propiedad que devuelve tu backend si ya rindió el examen
              this.yaEvaluacion = resEvaluacion.data.yaEvlauado;
            } else {
              this.evaluacionActiva = false;
              this.yaEvaluacion = false;
            }
          }
        } else {
          this.forminscripcion = false;
        }
      } catch (error) {
        console.error("Error al obtener estado de los formularios:", error);
      }
    },
    async abrirResultados() {
      if (!this.evaluacionFormularioId) return;

      try {
        const response = await API.get(`${this.baseUrl}/getDetalleRespuestasEstudiante/${this.evaluacionFormularioId}/${this.PersonalInfo.CIInfPer}`);
        this.detalleResultados = response.data;

        // Cálculo del puntaje dinámico basado en la columna 'valor'
        this.totalPreguntas = this.detalleResultados.respuestas.length;
        this.puntaje = this.detalleResultados.respuestas.reduce((total, item) => {
          return total + (parseInt(item.valor) === 1 ? 1 : 0);
        }, 0);

        this.mostrarModalResultados = true;
      } catch (error) {
        console.error("Error al recuperar las respuestas del estudiante:", error);
      }
    }
  },

}

</script>
