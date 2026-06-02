<template>
  <div
    class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
    <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <!-- Search Form -->
        <form class="flex-grow">
          <div class="relative">
            <button class="absolute -translate-y-1/2 left-4 top-1/2">
              <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M3.04175 9.37363C3.04175 5.87693 5.87711 3.04199 9.37508 3.04199C12.8731 3.04199 15.7084 5.87693 15.7084 9.37363C15.7084 12.8703 12.8731 15.7053 9.37508 15.7053C5.87711 15.7053 3.04175 12.8703 3.04175 9.37363ZM9.37508 1.54199C5.04902 1.54199 1.54175 5.04817 1.54175 9.37363C1.54175 13.6991 5.04902 17.2053 9.37508 17.2053C11.2674 17.2053 13.003 16.5344 14.357 15.4176L17.177 18.238C17.4699 18.5309 17.9448 18.5309 18.2377 18.238C18.5306 17.9451 18.5306 17.4703 18.2377 17.1774L15.418 14.3573C16.5365 13.0033 17.2084 11.2669 17.2084 9.37363C17.2084 5.04817 13.7011 1.54199 9.37508 1.54199Z"
                  fill="" />
              </svg>
            </button>
            <!-- @input llama al debouncedFilter, que inicia la nueva consulta al backend -->
            <input type="text" placeholder="Ingresa el ruc de la empresa a buscar..." v-model="searchQuery"
              @input="debouncedFilter"
              class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pl-12 pr-14 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 xl:w-[430px]" />
          </div>
        </form>
      </div>

      <div class="flex items-center gap-3">


        <button @click="isProfileAddressModal = true"
          class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
          Añadir Empresa
        </button>
      </div>
    </div>
    <div class="max-w-full overflow-x-auto custom-scrollbar">
      <table class="min-w-full">
        <thead>
          <tr class="border-t border-gray-100 dark:border-gray-800">
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Ruc</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Empresa</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Pais/ciudad</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Estado</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Archivo</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">CRE/ACT</p>
            </th>

            <th class="py-5 px-4 text-right">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Acciones</p>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-t border-gray-100 dark:border-gray-800" v-if="cargando">
            <td class="px-5 py-6" colspan="5">
              <div class="flex justify-center items-center gap-2">
                <span class="animate-spin h-5 w-5 border-2 border-brand-500 border-t-transparent rounded-full"></span>
                <h3 class="text-gray-500 font-medium">Cargando datos...</h3>
              </div>
            </td>
          </tr>
          <tr v-else v-for="post in filteredarray" :key="post.idempresa"
            class="border-t border-gray-100 hover:bg-gray-50/50 dark:border-gray-800 dark:hover:bg-white/[0.02] transition-colors">
            <td class="py-5 px-4 whitespace-nowrap">
              <p class="text-gray-600 text-sm font-medium dark:text-gray-400">{{ post.ruc }}</p>
            </td>
            <td class="py-5 px-4 whitespace-nowrap">
              <div>
                <p class="font-bold text-gray-800 text-base dark:text-white/90">
                  {{ post.empresacorta }}
                </p>
              </div>
            </td>
            <td class="py-5 px-4 whitespace-nowrap">
              <p class="text-gray-600 text-sm font-medium dark:text-gray-400">{{ post.pais }} / {{ post.lugar }}
              </p>
            </td>
            <td class="p-3 text-center">
              <span :class="post.estado_empr === 0 ? 'text-red-500 bg-red-50' : 'text-green-600 bg-green-50'"
                class="px-2 py-1 rounded-full text-[10px] font-bold uppercase">
                {{ post.estado_empr === 0 ? 'Inac' : 'Act' }}
              </span>
            </td>
            <td class="p-3 text-center">
              <div v-if="post.archivo" class="flex justify-center">
                <a :href="`http://vinculacion.test/Documentos/Vinculación/AnexoIntegrante/${post.ruc}/${post.archivo}`"
                  target="_blank"
                  class="group relative flex items-center justify-center p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm"
                  title="Ver documento PDF">
                  <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path
                      d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    <path d="M9 15h6M9 11h6" />
                  </svg>
                </a>
              </div>
              <span v-else class="text-[10px] text-gray-300 italic">Sin anexo</span>
            </td>
            <td class="p-3 whitespace-nowrap">
              <div class="flex flex-col gap-1">
                <div class="flex items-center gap-1 text-[10px] text-gray-500">
                  <span class="font-bold text-blue-500">CRE:</span>
                  {{ formatDate(post.created_at) }}
                </div>
                <div class="flex items-center gap-1 text-[10px] text-gray-400">
                  <span class="font-bold text-orange-400">ACT:</span>
                  {{ formatDate(post.updated_at) }}
                </div>
              </div>
            </td>

            <!-- Acciones de Edición y Eliminación -->
            <td class="py-3 text-right whitespace-nowrap">
              <div class="flex justify-end gap-2">
                <button @click="abrirModalEdicion(post)"
                  class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                  </svg>
                </button>
                <button @click="eliminar(post.idempresa, post.empresacorta)"
                  class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                  </svg>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <br /><br />
    <!-- Botones de Paginación -->
    <div class="d-flex justify-content-center mb-4">
      <button @click="previousPage" :disabled="currentPage === 1 || buscando" class="btn btn-primary text-white">
        <i class="fas fa-angle-left"></i></button>&nbsp; <span class="text-dark">Página {{ currentPage }} de {{ lastPage
        }}</span>&nbsp;
      <button @click="nextPage" :disabled="currentPage === lastPage || buscando" class="btn btn-primary text-white">
        <i class="fas fa-angle-right"></i>
      </button>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <div class="d-flex justify-content-center mb-4" v-if="!cargando">
      &nbsp;&nbsp;&nbsp;
      <button class="btn btn-primary text-white" @click="actualizar">
        Actualizar
      </button>
    </div>
    <!-- Modal de Registro-->
    <Modal v-if="isProfileAddressModal" @close="isProfileAddressModal = false">
      <template #body>
        <div
          class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
          <!-- close btn -->
          <button @click="isProfileAddressModal = false"
            class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                fill="" />
            </svg>
          </button>
          <div class="px-2 pr-14">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
              Agregar Empresa
            </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
              Llene todos los campos para agregar un nueva Empresa.
            </p>
          </div>
          <form class="flex flex-col">
            <div class="px-2 overflow-y-auto custom-scrollbar">
              <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                <div>
                  <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Ruc de la Empresa
                  </label>
                  <input type="text" v-model="objetoguardar.ruc" placeholder="Ej: 1234567890"
                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:text-white/90" />
                  <p class="mt-1.5 text-xs text-gray-500">Ingrese el RUC de la Empresa</p>
                </div>
              </div>
            </div>

            <div class="flex items-center gap-3 mt-6 lg:justify-end">
              <button @click="isProfileAddressModal = false" type="button"
                class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 sm:w-auto">
                Cerrar
              </button>
              <button v-if="formIsValid" @click="registrar" type="button"
                class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto shadow-lg transition-all">
                Guardar Dominio Académico
              </button>
            </div>
          </form>
        </div>
      </template>
    </Modal>
    <!-- Modal de Edición-->
    <Modal v-if="isEditModalOpen" @close="isEditModalOpen = false">
      <template #body>
        <div
          class="no-scrollbar relative w-full max-w-[700px] overflow-y-auto rounded-3xl bg-white p-4 dark:bg-gray-900 lg:p-11">
          <!-- close btn -->
          <button @click="isEditModalOpen = false"
            class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                fill="" />
            </svg>
          </button>
          <div class="px-2 pr-14">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800 dark:text-white/90">
              Editar Empresa
            </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
              Los datos mostrados son los actuales de la Empresa. Realice los cambios necesarios y guarde.
            </p>
          </div>
          <form class="flex flex-col">
            <div class="px-2 overflow-y-auto custom-scrollbar">
              <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                <div>
                  <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Ruc de la Empresa
                  </label>
                  <input type="text" v-model="objetoeditar.ruc" placeholder="Ej: 1234567890"
                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:text-white/90" />
                  <p class="mt-1.5 text-xs text-gray-500">Ingrese el RUC de la Empresa</p>
                </div>
              </div>

            </div>

            <div class="flex items-center gap-3 mt-6 lg:justify-end">
              <button @click="isEditModalOpen = false" type="button"
                class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 sm:w-auto">
                Cerrar
              </button>
              <button v-if="formIsValidEdit" @click="Update" type="button"
                class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto shadow-lg transition-all">
                Guardar cambios
              </button>
            </div>
          </form>
        </div>
      </template>
    </Modal>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Modal from '@/components/Modal/Modal.vue'

const isProfileAddressModal = ref(false)
const isEditModalOpen = ref(false)
// Creamos una función para que el bloque de abajo pueda cerrar el modal
const cerrarModalDesdeAfuera = () => {
  isProfileAddressModal.value = false
}

// IMPORTANTE: Exponemos la variable y la función
defineExpose({
  isProfileAddressModal,
  isEditModalOpen,
  cerrarModalDesdeAfuera
})
</script>
<script>
import API from "@/assets/js/services/axios";
import { useRoute } from "vue-router";
import debounce from 'lodash.debounce';
import Modal from '@/components/Modal/Modal.vue'
import { mostraralertas2, enviarsolig, eliminacion, confimarhabi, elimnarpermanente } from '@/assets/js/function/funciones';

export default {
  data() {
    return {
      idus: 0,
      baseUrl: "/vin",

      usersarray: [],
      objetoguardar: {
        ruc: "", //ruc de la empresa
        empresa: "",//proceso que se realiza con la empresa. Ej. CARTA DE COMPROMISO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE LA EMPRESA LOGISPETROL SERVICIOS PETROLEROS CIA. LTDA. Y LA UNIVERSIDAD TÉCNICA LUIS VARGAS TORRES DE ESMERALDAS
        empresacorta: "",//nombre corto de la empresa. Ej. LOGISPETROL
        lugar: "",//lugar de la empresa. Ej. ESMERALDAS
        direccion: "",//direccion de la empresa. Ej. AV. DE LAS AMERICAS, S/N
        telefono: "",//telefono de la empresa. Ej. 0123456789
        email: "",//email de la empresa. Ej. info@logispetrol.com
        url: "",//url de la empresa. Ej. www.logispetrol.com
        tipo: "",//tipo de servio que ofrece la empresa. Ej. Pre-Profesionales, Servicio Comunitario, Vinculación, etc.
        titulo: "",//titulo del representante legal de la empresa. Ej. Dr, Ing. Abg., etc.
        representante: "",//nombre del representante legal de la empresa. Ej. Juan Pérez
        cargo: "",//cargo del representante legal de la empresa. Ej. Director
        actividad: "",//actividad de la empresa. Ej. Académica, Administración Pública, Prácticas de servicio comunitario, Prácticas de vinculación, etc.
        fechafin: "",//fecha de finalización de la relación con la empresa. Ej. 2024-12-31 00:00:00
        tipoinstitucion: "",//tipo de institución de la empresa. Ej. Institución Pública, Empresa Pública, etc.
        pais: "",//pais de la empresa. Ej. ECUADOR
        imagen: "",//imagen de la empresa.
        estado_empr: 0,//estado de la empresa. 0: Inactiva, 1: Activo
        vision: "",//visión de la empresa. Ej. Ser una empresa líder en el sector de servicios petroleros, reconocida por su compromiso con
        mision: "",//misión de la empresa. Ej. Promover la adopción de prácticas de servicio comunitario en la región de la provincia de Esmeraldas
      },
      objetoeditar: {
        idempresa: 0,
        ruc: "", //ruc de la empresa
        empresa: "",//proceso que se realiza con la empresa. Ej. CARTA DE COMPROMISO DE COOPERACIÓN INTERINSTITUCIONAL ENTRE LA EMPRESA LOGISPETROL SERVICIOS PETROLEROS CIA. LTDA. Y LA UNIVERSIDAD TÉCNICA LUIS VARGAS TORRES DE ESMERALDAS
        empresacorta: "",//nombre corto de la empresa. Ej. LOGISPETROL
        lugar: "",//lugar de la empresa. Ej. ESMERALDAS
        direccion: "",//direccion de la empresa. Ej. AV. DE LAS AMERICAS, S/N
        telefono: "",//telefono de la empresa. Ej. 0123456789
        email: "",//email de la empresa. Ej. info@logispetrol.com
        url: "",//url de la empresa. Ej. www.logispetrol.com
        tipo: "",//tipo de servio que ofrece la empresa. Ej. Pre-Profesionales, Servicio Comunitario, Vinculación, etc.
        titulo: "",//titulo del representante legal de la empresa. Ej. Dr, Ing. Abg., etc.
        representante: "",//nombre del representante legal de la empresa. Ej. Juan Pérez
        cargo: "",//cargo del representante legal de la empresa. Ej. Director
        actividad: "",//actividad de la empresa. Ej. Académica, Administración Pública, Prácticas de servicio comunitario, Prácticas de vinculación, etc.
        fechafin: "",//fecha de finalización de la relación con la empresa. Ej. 2024-12-31 00:00:00
        tipoinstitucion: "",//tipo de institución de la empresa. Ej. Institución Pública, Empresa Pública, etc.
        pais: "",//pais de la empresa. Ej. ECUADOR
        imagen: "",//imagen de la empresa.
        estado_empr: 0,//estado de la empresa. 0: Inactiva, 1: Activo
        vision: "",//visión de la empresa. Ej. Ser una empresa líder en el sector de servicios petroleros, reconocida por su compromiso con
        mision: "",//misión de la empresa. Ej. Promover la adopción de prácticas de servicio comunitario en la región de la provincia de Esmeraldas
      },
      filteredarray: [],
      searchQuery: "",
      isProfileAddressModal: false,
      cargando: false,
      currentPage: 1,
      lastPage: 1,
      buscando: false, // Mantenido, pero no se usa en la lógica de paginación actual
      debouncedFilter: null, 
    };
  },
  created() {
    // Ahora sí puedes usar this.filterAndFetch
    this.debouncedFilter = debounce(() => {
      this.filterAndFetch();
    }, 900);
  },
  async mounted() {
    const ruta = useRoute();
    this.GetData(1, this.searchQuery);

  },
  computed: {
    formIsValid() {
      const rucRegex = /^\d{10}$/; // Expresión regular para validar un RUC de 10 dígitos
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión regular para validar un correo electrónico
      const urlRegex = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/; // Expresión regular para validar una URL
      if (!urlRegex.test(this.objetoguardar.url.trim())) {
        return false;
      }
      if (!rucRegex.test(this.objetoguardar.ruc.trim())) {
        return false;
      }
      if (!emailRegex.test(this.objetoguardar.email.trim())) {
        return false;
      }
      return (
        this.objetoguardar.ruc.trim() !== '' &&
        this.objetoguardar.empresa.trim() !== '' &&
        this.objetoguardar.empresacorta.trim() !== '' &&
        this.objetoguardar.lugar.trim() !== '' &&
        this.objetoguardar.direccion.trim() !== '' &&
        this.objetoguardar.telefono.trim() !== '' &&
        this.objetoguardar.titulo.trim() !== '' &&
        this.objetoguardar.representante.trim() !== '' &&
        this.objetoguardar.cargo.trim() !== '' &&
        this.objetoguardar.actividad.trim() !== '' &&
        this.objetoguardar.fechafin.trim() !== '' &&
        this.objetoguardar.tipoinstitucion.trim() !== '' &&
        this.objetoguardar.pais.trim() !== '' &&
        this.objetoguardar.estado_empr.trim() !== '' &&
        this.objetoguardar.vision.trim() !== '' &&
        this.objetoguardar.mision.trim() !== ''
      );
    },
    formIsValidEdit() {
      const rucRegex = /^\d{10}$/; // Expresión regular para validar un RUC de 10 dígitos
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión regular para validar un correo electrónico
      const urlRegex = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/; // Expresión regular para validar una URL
      if (!urlRegex.test(this.objetoeditar.url.trim())) {
        return false;
      }
      if (!rucRegex.test(this.objetoeditar.ruc.trim())) {
        return false;
      }
      if (!emailRegex.test(this.objetoeditar.email.trim())) {
        return false;
      }
      return (
        this.objetoeditar.ruc.trim() !== '' &&
        this.objetoeditar.empresa.trim() !== '' &&
        this.objetoeditar.empresacorta.trim() !== '' &&
        this.objetoeditar.lugar.trim() !== '' &&
        this.objetoeditar.direccion.trim() !== '' &&
        this.objetoeditar.telefono.trim() !== '' &&
        this.objetoeditar.titulo.trim() !== '' &&
        this.objetoeditar.representante.trim() !== '' &&
        this.objetoeditar.cargo.trim() !== '' &&
        this.objetoeditar.actividad.trim() !== '' &&
        this.objetoeditar.fechafin.trim() !== '' &&
        this.objetoeditar.tipoinstitucion.trim() !== '' &&
        this.objetoeditar.pais.trim() !== '' &&
        this.objetoeditar.estado_empr.trim() !== '' &&
        this.objetoeditar.vision.trim() !== '' &&
        this.objetoeditar.mision.trim() !== ''
      );
    },
  },
  methods: {
    formatDate(date) {
      if (!date) return '---';

      const fecha = new Date(date);

      // Formatear la fecha: "29 abr 2026"
      const fechaLegible = fecha.toLocaleDateString('es-ES', {
        day: '2-digit',
        month: 'short',
        year: 'numeric'
      });

      // Formatear la hora: "09:44 AM"
      const horaLegible = fecha.toLocaleTimeString('es-ES', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
      });

      return `${fechaLegible} - ${horaLegible}`;
    },
    abrirModalEdicion(user) {
      // Clonamos el objeto para no modificar la tabla directamente antes de guardar
      this.objetoeditar = {
        idempresa: user.idempresa,
        ruc: user.ruc,
        empresa: user.empresa,
        empresacorta: user.empresacorta,
        lugar: user.lugar,
        direccion: user.direccion,
        telefono: user.telefono,
        email: user.email,
        url: user.url,
        tipo: user.tipo,
        titulo: user.titulo,
        representante: user.representante,
        cargo: user.cargo,
        actividad: user.actividad,
        fechafin: user.fechafin,
        tipoinstitucion: user.tipoinstitucion,
        pais: user.pais,
        imagen: user.imagen,
        estado_empr: user.estado_empr,
        vision: user.vision,
        mision: user.mision,
      };
      this.$.setupState.isEditModalOpen = true;
    },
    async GetData(page = 1, searchQuery = "") {
      this.cargando = true;

      try {
        const params = {
          page: page,
          search_query: searchQuery // Parámetro para búsqueda
        };
        const response = await API.get(`${this.baseUrl}/empresa`, { params });

        const data = response.data?.data || [];
        this.filteredarray = data;
        const pagination = response.data?.pagination || {};
        this.currentPage = pagination.current_page || 1;
        this.lastPage = pagination.last_page || 1;
      } catch (error) {
        console.warn("⚠️ Error al obtener datos:", error?.response?.data || error);
        this.filteredarray = [];
        this.currentPage = 1;
        this.lastPage = 1;
      } finally {
        this.cargando = false;
      }
    },
    filterAndFetch() {
      this.currentPage = 1;
      this.GetData(this.currentPage, this.searchQuery);
    },
    nextPage() {
      if (this.currentPage < this.lastPage && !this.cargando) {
        this.GetData(this.currentPage + 1, this.searchQuery);
      }
    },
    previousPage() {
      if (this.currentPage > 1 && !this.cargando) {
        this.GetData(this.currentPage - 1, this.searchQuery);
      }
    },
    actualizar() {
      // Simplemente recarga la página actual de datos
      this.GetData(this.currentPage, this.searchQuery);
    },
    async registrar() {

      try {
        const params = {
          detalle_dom_huma: this.objetoguardar.detalle_dom_huma
        };
        const exito = await enviarsolig('POST', params, `${this.baseUrl}/empresa`, 'Empresa registrada con éxito');
        if (exito) {
          this.$.setupState.isProfileAddressModal = false;

          this.limpiarFormulario();
          this.actualizar();
        } else {
          mostraralertas2("No se pudo registrar la Empresa", "error");
        }
      } catch (error) {
        console.error("❌ Error al registrar Empresa:", error.response?.data || error);
      }
    },
    async Update() {
      try {
        const params = {
          detalle_dom_huma: this.objetoeditar.detalle_dom_huma
        };
        const exito = await enviarsolig('PUT', params, `${this.baseUrl}/empresa/${this.objetoeditar.idempresa}`, 'Empresa actualizada con éxito');
        if (exito) {
          this.$.setupState.isEditModalOpen = false;

          this.limpiarFormulario();
          this.actualizar();
        } else {
          this.$.setupState.isEditModalOpen = false;
          mostraralertas2("No se pudo editar la Empresa", "error");
        }
      } catch (error) {
        console.error("❌ Error al actualizar la Empresa:", error.response?.data || error);
      }
    },
    limpiarFormulario() {
      this.objetoguardar = {
        detalle_dom_huma: ""
      };
      this.objetoeditar = {
        id_dom_huma: 0,
        detalle_dom_huma: ""
      };
    },
    async habilitar(id, nombre) {
      try {
        // No hace falta poner this.cargando = true aquí si confimarhabi maneja la alerta,
        // pero si lo haces, asegúrate de cerrarlo.
        await confimarhabi(
          `${this.baseUrl}/habilitar_empresa/`,
          id,
          'Habilitar registro',
          `¿Desea habilitar la Empresa "${nombre}"?`,
          this.actualizar
        );
      } catch (error) {
        // Este catch capturaría errores si confimarhabi hace un 'throw'
        console.error("Error en el componente habilitar:", error);
      }
    },
    eliminar(id, nombre) {
      try {
        eliminacion(
          `${this.baseUrl}/inhabilitar_empresa/`,
          id,
          'Deshabilitar registro',
          '¿Realmente desea deshabilitar la Empresa  ' + nombre + '?',
          this.actualizar   // 👈 callback para refrescar la tabla al confirmar
        );
      } catch (error) {
        console.error("Error al deshabilitar la Empresa:", error);
        this.cargando = false;
      }
    },

  },
};
</script>
