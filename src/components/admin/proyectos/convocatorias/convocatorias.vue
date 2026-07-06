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
            <input type="text" placeholder="Ingresa el nombre número de la convocatoria a buscar..."
              v-model="searchQuery" @input="debouncedFilter"
              class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pl-12 pr-14 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 xl:w-[430px]" />
          </div>
        </form>
      </div>

      <div class="flex items-center gap-3">


        <div class="flex items-center gap-3">
          <button @click="abrirModalRegistro"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
            Añadir Convocatoria
          </button>
        </div>
      </div>
    </div>
    <div class="max-w-full overflow-x-auto custom-scrollbar">
      <table class="min-w-full">
        <thead>
          <tr class="border-t border-gray-100 dark:border-gray-800">
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">ID</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Num_Conv / Título / Elaboración /
                resolución</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Fecha Inicio / Fin</p>
            </th>

            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Estado</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Archivo</p>
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
          <tr v-else v-for="post in filteredarray" :key="post.id_convocatoria"
            class="border-t border-gray-100 hover:bg-gray-50/50 dark:border-gray-800 dark:hover:bg-white/[0.02] transition-colors">

            <td class="py-5 px-4 whitespace-nowrap">
              <p class="text-gray-600 text-sm font-medium dark:text-gray-400">{{ post.id_convocatoria }}</p>
            </td>

            <td class="py-5 px-4 whitespace-nowrap">
              <div>
                <p class="font-bold text-gray-800 text-base dark:text-white/90">
                  {{ post.num_convocatoria }}
                </p>
                <p class="text-xs text-gray-500 mt-0.5 italic">Título: {{ post.titulo_convocatoria }}</p>
                <p class="text-xs text-gray-500 mt-0.5 italic">Elaboración: {{ post.elaboracion }}</p>
                <p class="text-xs text-gray-500 mt-0.5 italic">Resolución: {{ post.num_resolucion }}</p>
              </div>
            </td>
            <td class="py-5 px-4">
              <div class="flex flex-col gap-1">
                <span class="text-xs font-medium text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full w-fit">
                  {{ post.fecha_inicio }} Subsistemas
                </span>
                <span class="text-xs font-medium text-cyan-600 bg-cyan-50 px-2 py-0.5 rounded-full w-fit">
                  {{ post.fecha_fin }} Objetivos
                </span>
              </div>
            </td>
            <td class="py-5 px-4 whitespace-nowrap">
              <span :class="{
                'rounded-lg px-3 py-1 text-xs font-bold uppercase tracking-wider': true,
                'bg-green-100 text-green-700 dark:bg-success-500/15 dark:text-success-500': post.estado === 1,
                'bg-orange-100 text-orange-700 dark:bg-warning-500/15 dark:text-orange-400': post.estado === 0
              }">
                {{ post.estado === 1 ? 'Activo' : 'Inactivo' }}
              </span>
            </td>

            <td class="py-5 px-4">
              <div v-if="post.archivo">
                <a :href="`http://vinculacionbackend.test/Documentos/Vinculación/Convocatorias/${post.num_convocatoria}/${post.archivo}`"
                  target="_blank"
                  class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors dark:bg-red-500/10 dark:text-red-400">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                    <polyline points="14 2 14 8 20 8" />
                    <line x1="16" y1="13" x2="8" y2="13" />
                    <line x1="16" y1="17" x2="8" y2="17" />
                    <polyline points="10 9 9 9 8 9" />
                  </svg>
                  <span>PDF</span>
                </a>
              </div>
              <span v-else class="text-xs text-gray-400 italic">Sin documento</span>
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

                <button @click="eliminar(post.id_convocatoria, post.num_convocatoria)" v-if="post.estado === 1"
                  class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                  </svg>
                </button>
                <button @click="habilitar(post.id_convocatoria, post.num_convocatoria)" v-if="post.estado === 0"
                  class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors dark:text-gray-400 dark:hover:bg-white/10"
                  title="Refrescar lista">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M23 4v6h-6"></path>
                    <path d="M1 20v-6h6"></path>
                    <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
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
    <Modal v-if="isModalOpen" @close="cerrarModal">
      <template #body>
        <div
          class="no-scrollbar relative w-[calc(100%-2rem)] max-w-[800px] max-h-[90vh] mx-auto overflow-y-auto rounded-3xl bg-white p-4 shadow-2xl dark:bg-gray-900 lg:p-8">
          <button @click="cerrarModal"
            class="transition-color absolute right-5 top-5 z-50 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                fill="" />
            </svg>
          </button>

          <div class="px-2 mb-6">
            <h4 class="mb-2 text-2xl font-semibold text-gray-800">
              {{ isEditMode ? 'Editar Convocatoria' : 'AgregarConvocatoria' }}
            </h4>
            <p class="text-sm text-gray-500">Complete los datos de la convocatoria.</p>
          </div>

          <form class="flex flex-col gap-5 px-2" @submit.prevent>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
              <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Número de Convocatoria</label>
                <input v-model="formulario.num_convocatoria" type="text"
                  class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm outline-none focus:border-brand-500"
                  placeholder="Ej: CONV-2026-01" />
              </div>
              <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Título</label>
                <input v-model="formulario.titulo_convocatoria" type="text"
                  class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm outline-none focus:border-brand-500"
                  placeholder="Título de la convocatoria" />
              </div>
              <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Fecha Inicio</label>
                <input v-model="formulario.fecha_inicio" type="date"
                  class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm outline-none focus:border-brand-500" />
              </div>
              <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Fecha Fin</label>
                <input v-model="formulario.fecha_fin" type="date"
                  class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm outline-none focus:border-brand-500" />
              </div>
              <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Número de Resolución</label>
                <input v-model="formulario.num_resolucion" type="text"
                  class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm outline-none focus:border-brand-500" />
              </div>

              <div class="flex flex-col justify-center">
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Estado de la Convocatoria</label>
                <label class="relative inline-flex items-center cursor-pointer mt-2">
                  <input type="checkbox" v-model="estadoBool" class="sr-only peer">
                  <div
                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand-500">
                  </div>
                  <span class="ml-3 text-sm font-medium text-gray-700">
                    {{ estadoBool ? 'Activo (Visible)' : 'Inactivo (Cerrada)' }}
                  </span>
                </label>
              </div>
            </div>

            <hr class="my-2 border-gray-100">

            <div v-for="campo in camposResponsables" :key="campo.id"
              class="p-4 bg-gray-50 rounded-xl border border-gray-100">
              <div class="flex items-center justify-between mb-4">
                <label class="text-sm font-bold text-gray-800 capitalize">{{ campo.label }}</label>

                <div class="flex p-1 bg-gray-200 rounded-lg">
                  <button type="button" @click="campo.tipo = 'persona'"
                    :class="{ 'bg-white shadow-sm text-brand-600 font-semibold': campo.tipo === 'persona', 'text-gray-500': campo.tipo !== 'persona' }"
                    class="px-3 py-1 text-xs rounded-md transition-all">Persona</button>
                  <button type="button" @click="campo.tipo = 'departamento'"
                    :class="{ 'bg-white shadow-sm text-brand-600 font-semibold': campo.tipo === 'departamento', 'text-gray-500': campo.tipo !== 'departamento' }"
                    class="px-3 py-1 text-xs rounded-md transition-all">Departamento</button>
                </div>
              </div>

              <div v-if="campo.tipo === 'persona'" class="flex flex-col gap-3">
                <div class="flex gap-2">
                  <input v-model="campo.cedula" @input="validarNumeros(campo)" type="text" maxlength="10"
                    placeholder="Ingrese 10 dígitos de la Cédula"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm outline-none focus:border-brand-500" />
                  <button @click="buscarDocente(campo)" type="button"
                    class="bg-gray-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition-colors whitespace-nowrap">
                    Buscar
                  </button>
                </div>
                <div v-if="campo.docente"
                  class="flex items-center gap-4 bg-white p-3 rounded-lg border border-green-100 shadow-sm mt-1">
                  <div
                    class="w-12 h-12 rounded-full bg-gray-200 flex-shrink-0 border-2 border-gray-300 overflow-hidden flex items-center justify-center">
                    <img :src="getPhotoUrl(campo.docente.CIInfPer)"
                                            class="w-full h-full object-cover animate-fadeIn" alt="Foto de perfil" />
                    
                  </div>
                  <div>
                    <p class="text-sm font-semibold text-gray-800">{{ campo.docente.NombInfPer }} {{
                      campo.docente.ApellInfPer }} {{ campo.docente.ApellMatInfPer }}</p>
                    <p class="text-xs text-gray-500">C.I: {{ campo.docente.CIInfPer }} | Género: {{
                      campo.docente.GeneroPer }}</p>
                  </div>
                </div>
                <p v-if="campo.error" class="text-xs text-red-500">{{ campo.error }}</p>
              </div>

              <div v-else>
                <input v-model="campo.texto" type="text"
                  :placeholder="`Nombre del departamento encargado de la ${campo.label}`"
                  class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm outline-none focus:border-brand-500" />
              </div>
            </div>

            <div class="mt-2">
              <label class="mb-1.5 block text-sm font-medium text-gray-700">Documento Convocatoria (PDF)</label>
              <div @click="$refs.fileFoto.click()"
                class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer transition-all"
                :class="archivoPreviewName ? 'border-brand-500 bg-brand-50/20' : 'border-gray-300 hover:border-brand-400 bg-gray-50'">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                  <svg v-if="!archivoPreviewName" class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                  </svg>
                  <svg v-else class="w-8 h-8 mb-3 text-brand-600" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                    <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                  </svg>
                  <p class="mb-1 text-sm text-gray-500">
                    <span class="font-semibold" v-if="!archivoPreviewName">Haga clic para cargar</span>
                    <span class="font-semibold text-brand-600" v-else>{{ archivoPreviewName }}</span>
                  </p>
                  <p class="text-xs text-gray-400" v-if="!archivoPreviewName">PDF (Máx. 10MB)</p>
                </div>
                <input type="file" ref="fileFoto" class="hidden" accept="application/pdf" @change="handleFileChange" />
              </div>
            </div>

            <div class="flex items-center gap-3 mt-6 justify-end">
              <button @click="cerrarModal" type="button"
                class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancelar</button>
              <button @click="registrar" type="button"
                class="rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 shadow-lg transition-all">
                {{ isEditMode ? 'Guardar Cambios' : 'Registrar Convocatoria' }}
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

// Exposición básica por si el layout principal lo requiere
const isModalOpen = ref(false)
const cerrarModalDesdeAfuera = () => { isModalOpen.value = false }
defineExpose({ isModalOpen, cerrarModalDesdeAfuera })
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
      formulario: {
        id_convocatoria: null,
        num_convocatoria: "",
        titulo_convocatoria: "",
        fecha_inicio: "",
        fecha_fin: "",
        num_resolucion: "",
        estado: 1, // Por defecto activo
      },
      filteredarray: [],
      searchQuery: "",
      isModalOpen: false,
      isEditMode: false,
      cargando: false,
      currentPage: 1,
      lastPage: 1,
      buscando: false, // Mantenido, pero no se usa en la lógica de paginación actual
      debouncedFilter: null,
      archivoSeleccionado: null,
      archivoPreviewName: '',
      uploading: false,
      estadoBool: true,
      // Configuraciones dinámicas para Elaboración, Revisión y Aprobación
      camposResponsables: {
        elaboracion: { id: 'elaboracion', label: 'elaboración', tipo: 'departamento', cedula: '', texto: '', docente: null, error: '' },
        revision: { id: 'revision', label: 'revisión', tipo: 'departamento', cedula: '', texto: '', docente: null, error: '' },
        aprobacion: { id: 'aprobacion', label: 'aprobación', tipo: 'departamento', cedula: '', texto: '', docente: null, error: '' }
      }

    };
  },
  watch: {
    estadoBool(val) {
      this.formulario.estado = val ? 1 : 0;
    }
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
      const regexAnio = /^\d{4}-\d{4}$/;

      return (
        this.objetoguardar.num_convocatoria.trim() !== '' &&
        regexAnio.test(this.objetoguardar.titulo_convocatoria) && // <--- Validación aquí
        this.objetoguardar.estado !== null &&
        this.archivoSeleccionado !== null // Si es obligatorio
      );
    },
    formIsValidEdit() {
      const regexAnio = /^\d{4}-\d{4}$/;

      return (
        this.objetoeditar.num_convocatoria.trim() !== '' &&
        regexAnio.test(this.objetoeditar.titulo_convocatoria) && // <--- Validación aquí
        this.objetoeditar.estado !== null
        // En edición, el archivo no es obligatorio, así que no lo validamos aquí
      );
    },


  },
  methods: {
    validarNumeros(campo) {
      campo.cedula = campo.cedula.replace(/\D/g, '');
    },
    async buscarDocente(campo) {
      if (campo.cedula.length !== 10) {
        campo.error = 'La cédula debe tener 10 dígitos.';
        return;
      }
      campo.error = '';
      try {
        // Ajusta la URL según el endpoint real que programaste
        const resp = await API.get(`${this.baseUrl}/getalldoce/${campo.cedula}`);
        if (resp.data && resp.data.data) {
          campo.docente = resp.data.data;
        } else {
          campo.error = 'Docente no encontrado.';
          campo.docente = null;
        }
      } catch (e) {
        campo.error = 'Error en el servidor al buscar.';
        campo.docente = null;
      }
    },
    abrirModalRegistro() {
      this.isEditMode = false;
      this.limpiarFormulario();
      this.$.setupState.isModalOpen = true;
    },
    abrirModalEdicion(user) {
      this.isEditMode = true;
      this.limpiarFormulario();

      this.formulario = {
        id_convocatoria: user.id_convocatoria,
        num_convocatoria: user.num_convocatoria,
        titulo_convocatoria: user.titulo_convocatoria,
        fecha_inicio: user.fecha_inicio,
        fecha_fin: user.fecha_fin,
        num_resolucion: user.num_resolucion,
        estado: user.estado
      };
      this.estadoBool = user.estado === 1;

      // Función helper para procesar cómo viene el dato (Cédula 10 dígitos o Texto normal)
      const parseCampo = (clave, valor) => {
        if (!valor) return;
        const esCedula = /^\d{10}$/.test(valor.trim());
        if (esCedula) {
          this.camposResponsables[clave].tipo = 'persona';
          this.camposResponsables[clave].cedula = valor;
          this.buscarDocente(this.camposResponsables[clave]); // Para cargar la data visual
        } else {
          this.camposResponsables[clave].tipo = 'departamento';
          this.camposResponsables[clave].texto = valor;
        }
      };

      parseCampo('elaboracion', user.elaboracion);
      parseCampo('revision', user.revision);
      parseCampo('aprobacion', user.aprobacion);

      this.$.setupState.isModalOpen = true;
    },
    handleFileChange(event) {
      //Obtener el archivo seleccionado por el usuario
      const file = event.target.files[0];
      //Validar que el archivo seleccionado sea un archivo PDF, si no se cumple se muestra una alerta y se limpia el archivo seleccionado
      if (!file) return;
      // validación básica: pdf y tamaño si quieres
      if (file.type !== 'application/pdf') {
        //Mostrar una alerta de advertencia si el archivo seleccionado no es un archivo PDF, se usa la función mostraralertas2 para mostrar un mensaje de advertencia
        mostraralertas2('Solo se permiten archivos PDF', 'warning');
        //Limpiar el archivo seleccionado
        this.$refs.fileFoto.value = null;
        //Devolver sin hacer nada más
        return;
      }
      //Validar que el tamaño del archivo no exceda el límite de 10 MB, si no se cumple se muestra una alerta y se limpia el archivo seleccionado
      const maxMB = 10;
      //Si el tamaño del archivo es mayor que el límite de 10 MB, se muestra una alerta y se limpia el archivo seleccionado
      if (file.size > maxMB * 1024 * 1024) {
        //Mostrar una alerta de advertencia si el tamaño del archivo es mayor que el límite de 10 MB, se usa la función mostraralertas2 para mostrar un mensaje de advertencia
        mostraralertas2(`Archivo muy grande. Máx ${maxMB} MB`, 'warning');
        //Limpiar el archivo seleccionado
        this.$refs.fileFoto.value = null;
        //Devolver sin hacer nada más
        return;
      }
      //Asignar el archivo seleccionado a la variable archivoSeleccionado
      this.archivoSeleccionado = file;
      //Asignar el nombre del archivo seleccionado a la variable archivoPreviewName
      this.archivoPreviewName = file.name;
    },
    cerrarModal() {
      this.$.setupState.isModalOpen = false;
      this.limpiarFormulario();
    },
    getPhotoUrl(ci) {
      // Si no hay CI, retornamos una imagen vacía o un placeholder
      if (!ci) return '';

      const baseURL2 = API.defaults.baseURL;
      // Usamos el timestamp para evitar problemas de caché al cambiar de integrante
      return `${baseURL2}/vin/getFotoDocente/${ci}?t=${new Date().getTime()}`;
    },
    async uploadArchivo(num_convocatoria, oldFilename = null) {
      if (!this.archivoSeleccionado) return null; // nada que subir
      try {
        this.uploading = true;
        const form = new FormData();
        form.append('file', this.archivoSeleccionado);
        form.append('num_convocatoria', num_convocatoria);
        if (oldFilename) {
          form.append('old_filename', oldFilename); // Enviamos el nombre del archivo viejo
        }

        // Si tu backend exige otros campos (ej: tipo), añade aquí
        const resp = await API.post(`${this.baseUrl}/subir_archivo_convocatoria`, form, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });
        if (resp && resp.data && resp.data.filename) {
          this.archivoSeleccionado = null;
          this.archivoPreviewName = '';
          this.$refs.fileFoto.value = null;
          return resp.data; // { filename, url }
        } else {
          mostraralertas2('Error subiendo archivo', 'danger');
          return null;
        }
      } catch (error) {
        mostraralertas2('Error subiendo archivo', 'danger');
        return null;
      } finally {
        this.uploading = false;
      }
    },
    async GetData(page = 1, searchQuery = "") {
      this.cargando = true;

      try {
        const params = {
          page: page,
          search_query: searchQuery // Parámetro para búsqueda
        };
        const response = await API.get(`${this.baseUrl}/invi_convocatoria`, { params });

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
      const procesarCampo = (campo) => campo.tipo === 'persona' ? campo.cedula : campo.texto;
      const params = {
        ...this.formulario,
        elaboracion: procesarCampo(this.camposResponsables.elaboracion),
        revision: procesarCampo(this.camposResponsables.revision),
        aprobacion: procesarCampo(this.camposResponsables.aprobacion),
      };

      try {
        if (this.archivoSeleccionado) {
          const uploadResp = await this.uploadArchivo(this.formulario.num_convocatoria);
          if (uploadResp && uploadResp.filename) params.archivo = uploadResp.filename;
        }

        let exito = false;
        if (this.isEditMode) {
          exito = await enviarsolig('PUT', params, `${this.baseUrl}/invi_convocatoria/${this.formulario.id_convocatoria}`, 'Convocatoria actualizada');
        } else {
          exito = await enviarsolig('POST', params, `${this.baseUrl}/invi_convocatoria`, 'Convocatoria registrada');
        }

        if (exito) {
          this.cerrarModal();
          this.GetData(this.currentPage, this.searchQuery);
        } else {
          mostraralertas2("Error al procesar la solicitud", "error");
        }
      } catch (error) {
        console.error("Error:", error);
      }
    },
    
    limpiarFormulario() {
      this.formulario = { id_convocatoria: null, num_convocatoria: "", titulo_convocatoria: "", fecha_inicio: "", fecha_fin: "", num_resolucion: "", estado: 1 };
      this.estadoBool = true;
      this.archivoSeleccionado = null;
      this.archivoPreviewName = '';

      // Reiniciar configuraciones dinámicas
      Object.keys(this.camposResponsables).forEach(key => {
        this.camposResponsables[key] = { ...this.camposResponsables[key], tipo: 'departamento', cedula: '', texto: '', docente: null, error: '' };
      });
    },
    eliminar(id, nombre) {
      try {
        eliminacion(
          `${this.baseUrl}/inhabilitar_convocatoria/`,
          id,
          'Deshabilitar registro',
          '¿Realmente desea deshabilitar la convocatoria  ' + nombre + '?',
          this.actualizar   // 👈 callback para refrescar la tabla al confirmar
        );
      } catch (error) {
        console.error("Error al eliminar la convocatoria:", error);
        this.cargando = false;
      }
    },
    async habilitar(id, nombre) {
      try {
        await confimarhabi(
          `${this.baseUrl}/habilitar_convocatoria/`,
          id,
          'Habilitar registro',
          `¿Desea habilitar la convocatoria "${nombre}"?`,
          this.actualizar
        );
      } catch (error) {
        // Este catch capturaría errores si confimarhabi hace un 'throw'
        console.error("Error en el componente habilitar:", error);
      }
    },

  },
};
</script>
