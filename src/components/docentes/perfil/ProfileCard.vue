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
              <p class="text-sm text-gray-500 dark:text-gray-400">Nivel Actual: {{ formatNivel(UsuarioInfo.nivelUsuario) }} Ciclo</p>
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
      return `${API.defaults.baseURL}/vin/getFotoDocente/${ci}`;
    },
    
  },

}

</script>
