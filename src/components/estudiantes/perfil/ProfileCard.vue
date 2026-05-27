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
              {{ UsuarioInfo.nombreUsuario }}
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

    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6 relative z-10">
      <div class="max-w-3xl">
        <div
          class="inline-flex items-center gap-2 px-3 py-1 mb-4 text-xs font-semibold text-brand-700 bg-brand-100 rounded-full dark:bg-brand-900/40 dark:text-brand-400">
          <span class="w-2 h-2 rounded-full bg-brand-500"
            :class="{ 'animate-pulse': !yaInscrito, 'bg-emerald-500': yaInscrito }"></span>
          {{ yaInscrito ? 'Inscripción Registrada' : 'Convocatoria Activa' }}
        </div>

        <h4 class="text-xl font-extrabold text-gray-900 dark:text-white mb-3">
          ¡Inscripciones Abiertas para Ayudantías de Cátedra!
        </h4>
        <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
          La Dirección de Vinculación con la Sociedad te invita a formar parte de los líderes académicos de la UTLVTE.
          Si cumples con los requisitos y buscas expandir tu experiencia profesional, postula completando el formulario
          obligatorio.
        </p>
        <p class="text-xs font-medium text-amber-600 dark:text-amber-400 mt-2 flex items-center gap-1">
          Requisito permanente: Estar cursando el 5to ciclo o superior.
        </p>
      </div>

      <div v-if="!yaInscrito" class="w-full lg:w-auto shrink-0">
        <router-link to="/site-admin/formulario_catedra/inscripcion"
          class="inline-flex items-center justify-center w-full lg:w-auto px-6 py-3 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 transition-all duration-200 rounded-xl shadow-lg shadow-brand-500/20 hover:shadow-brand-600/30 hover:-translate-y-0.5">
          Comenzar Inscripción
          <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </router-link>
      </div>
    </div>

    <div v-if="yaInscrito"
      class="mt-6 p-4 bg-emerald-50 dark:bg-emerald-950/20 border border-emerald-200 dark:border-emerald-900/40 rounded-xl flex items-start gap-3">
      <div class="text-emerald-600 dark:text-emerald-400 shrink-0 mt-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <div>
        <p class="text-sm font-bold text-emerald-900 dark:text-emerald-200 mb-0.5">Ya te encuentras inscrito con éxito
        </p>
        <p class="text-xs text-emerald-700 dark:text-emerald-300 leading-relaxed">
          Tu postulación para el concurso de Ayudantía de Cátedra ha sido guardada en nuestra base de datos. Por favor,
          <b>debes esperar las fechas oficiales establecidas en el cronograma institucional para rendir la prueba de
            conocimiento</b>.
        </p>
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
      yaInscrito: false
    };
  },
  async mounted() {
    await getMe();
    const usuario = await getMe();
    this.PersonalInfo = usuario;
    this.UsuarioInfo = useUsuario();
    this.getFormulario();
  },
  methods: {
    getPhotoUrl(ci) {
      return `${API.defaults.baseURL}/vin/getFoto/${ci}`;
    },
    async getFormulario() {
      try {
        const response = await API.get(`${this.baseUrl}/getCatedraInscripcion`, {
          params: { cedula: this.PersonalInfo.CIInfPer }
        });

        if (response.data.data && response.data.data.ACTIVO === 1) {
          this.forminscripcion = true;
          this.yaInscrito = response.data.yaInscrito; // Mapeamos el estado desde el backend
        } else {
          this.forminscripcion = false;
          this.yaInscrito = false;
        }
      } catch (error) {
        console.error("Error al obtener formulario:", error);
      }
    }
  },

}

</script>
