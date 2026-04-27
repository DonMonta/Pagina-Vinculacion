<template>
    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6">
        <div class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <form class="flex-grow" @submit.prevent>
                    <div class="relative">
                        <button class="absolute -translate-y-1/2 left-4 top-1/2">
                            <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.04175 9.37363C3.04175 5.87693 5.87711 3.04199 9.37508 3.04199C12.8731 3.04199 15.7084 5.87693 15.7084 9.37363C15.7084 12.8703 12.8731 15.7053 9.37508 15.7053C5.87711 15.7053 3.04175 12.8703 3.04175 9.37363ZM9.37508 1.54199C5.04902 1.54199 1.54175 5.04817 1.54175 9.37363C1.54175 13.6991 5.04902 17.2053 9.37508 17.2053C11.2674 17.2053 13.003 16.5344 14.357 15.4176L17.177 18.238C17.4699 18.5309 17.9448 18.5309 18.2377 18.238C18.5306 17.9451 18.5306 17.4703 18.2377 17.1774L15.418 14.3573C16.5365 13.0033 17.2084 11.2669 17.2084 9.37363C17.2084 5.04817 13.7011 1.54199 9.37508 1.54199Z" />
                            </svg>
                        </button>
                        <input type="text" placeholder="Ingresa el nombre del pei a buscar..." v-model="searchQuery"
                            @input="debouncedFilter"
                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pl-12 pr-14 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 xl:w-[430px]" />
                    </div>
                </form>
            </div>

            <div class="flex items-center gap-3">
                <button @click="isProfileAddressModal = true"
                    class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                    Añadir PEI
                </button>
            </div>
        </div>

        <div class="max-w-full overflow-x-auto custom-scrollbar">
            <table class="min-w-full">
                <thead>
                    <tr class="border-t border-gray-100 dark:border-gray-800">
                        <th class="py-5 px-4 text-left">
                            <p class="font-semibold text-gray-500 text-sm">Cod</p>
                        </th>
                        <th class="py-5 px-4 text-left">
                            <p class="font-semibold text-gray-500 text-sm">Proyecto / Título</p>
                        </th>
                        <th class="py-5 px-4 text-left">
                            <p class="font-semibold text-gray-500 text-sm">Fecha Inicio/Fin</p>
                        </th>
                        <th class="py-5 px-4 text-right">
                            <p class="font-semibold text-gray-500 text-sm">Acciones</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="cargando">
                        <td class="px-5 py-6" colspan="4">
                            <div class="flex justify-center items-center gap-2">
                                <span
                                    class="animate-spin h-5 w-5 border-2 border-brand-500 border-t-transparent rounded-full"></span>
                                <h3 class="text-gray-500 font-medium">Cargando datos...</h3>
                            </div>
                        </td>
                    </tr>
                    <tr v-else v-for="post in filteredarray" :key="post.proyect_id"
                        class="border-t border-gray-100 hover:bg-gray-50/50 dark:border-gray-800 transition-colors">
                        <td class="py-5 px-4 whitespace-nowrap">
                            <p class="text-gray-600 text-sm font-medium dark:text-gray-400">{{ post.proyect_cod }}</p>
                        </td>

                        <td class="py-5 px-4 min-w-[300px] max-w-[500px]">
                            <div class="break-words">
                                <p class="font-bold text-gray-800 text-sm dark:text-white/90 leading-tight">
                                    {{ post.proyect_nombre }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1 italic leading-relaxed">
                                    Título: {{ post.proyect_titulo }}
                                </p>
                            </div>
                        </td>

                        <td class="py-5 px-4 whitespace-nowrap">
                            <div class="flex flex-col gap-1 text-[11px]">
                                <span
                                    class="font-medium text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full w-fit">Inicio:
                                    {{ post.fechainicio }}</span>
                                <span class="font-medium text-cyan-600 bg-cyan-50 px-2 py-0.5 rounded-full w-fit">Fin:
                                    {{ post.fechafin }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <button @click="abrirDetallesProyecto(post.proyect_id)"
                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                title="Ver Detalles">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex items-center justify-between border-t border-gray-100 pt-5 dark:border-gray-800">
            <div class="flex items-center gap-4">
                <button @click="previousPage" :disabled="currentPage === 1 || cargando"
                    class="flex h-8 w-8 items-center justify-center rounded-md border border-gray-200 bg-white text-gray-600 shadow-theme-xs hover:bg-gray-50 disabled:opacity-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-400">
                    Página {{ currentPage }} de {{ lastPage }}
                </span>
                <button @click="nextPage" :disabled="currentPage === lastPage || cargando"
                    class="flex h-8 w-8 items-center justify-center rounded-md border border-gray-200 bg-white text-gray-600 shadow-theme-xs hover:bg-gray-50 disabled:opacity-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <button class="btn btn-primary text-white text-xs px-4 py-2" @click="actualizar" :disabled="cargando">
                {{ cargando ? 'Cargando...' : 'Actualizar Lista' }}
            </button>
        </div>
        <div v-if="showModalDetalles"
            class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 z-99999">
            <div
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col">
                <div
                    class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{
                            proyectoSeleccionado.proyect_nombre }}</h2>
                        <p class="text-sm text-gray-500">Título: {{ proyectoSeleccionado.proyect_titulo }}</p>
                    </div>
                    <button @click="showModalDetalles = false" class="text-gray-400 hover:text-gray-600">✕</button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl bg-brand-50 border border-brand-100 dark:bg-brand-500/5">
                            <h4 class="text-xs font-bold uppercase text-brand-600 mb-2">Facultad Principal (Prioritaria)
                            </h4>
                            <p class="text-sm font-medium"
                                v-for="fac in proyectoSeleccionado.invi_detalle_fac_proy.filter(f => f.facultades_priori)"
                                :key="fac.id_det_fac">
                                {{ fac.facultades_priori?.siglas }}
                            </p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 dark:bg-gray-800">
                            <h4 class="text-xs font-bold uppercase text-gray-500 mb-2">Facultades Participantes</h4>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="fac in proyectoSeleccionado.invi_detalle_fac_proy" :key="fac.id_det_fac"
                                    class="px-2 py-1 bg-white dark:bg-gray-700 rounded border text-xs">
                                    {{ fac.facultades.siglas }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-if="integranteEdit"
                        class="mt-6 p-6 border-2 border-dashed border-blue-200 rounded-2xl bg-blue-50/30">
                        <h4 class="font-bold text-blue-800 mb-4">Editar Integrante: {{ integranteEdit.nombre }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-bold mb-1">Horas</label>
                                <input type="number" v-model="formInt.horas" class="w-full border rounded-lg p-2">
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-1">Función</label>
                                <select v-model="formInt.id_funcion" class="w-full border rounded-lg p-2">
                                    <option v-for="f in funciones" :key="f.id_funcion" :value="f.id_funcion">{{
                                        f.nombre_funcion }}</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-1">Carrera</label>
                                <select v-model="formInt.idCarr" class="w-full border rounded-lg p-2">
                                    <option v-for="c in carreras" :key="c.idCarr" :value="c.idCarr">{{ c.NombCarr }}
                                    </option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" v-model="formInt.reemplazado" :true-value="1"
                                        :false-value="0">
                                    <span class="text-sm font-bold text-red-600">¿Reemplazar?</span>
                                </label>
                            </div>
                        </div>

                        <div v-if="formInt.reemplazado == 1"
                            class="mt-6 p-4 bg-white rounded-xl shadow-sm border border-red-100">
                            <h5 class="text-sm font-bold text-red-700 mb-3 uppercase">Datos del Nuevo Reemplazo</h5>
                            <div class="flex gap-4 mb-4">
                                <input type="text" v-model="cedulaBusqueda" placeholder="Cédula del nuevo..."
                                    class="flex-1 border rounded-lg p-2">
                                <button @click="buscarNuevoIntegrante"
                                    class="bg-gray-800 text-white px-4 py-2 rounded-lg">Buscar</button>
                            </div>
                            <div v-if="nuevoIntegranteData"
                                class="grid grid-cols-1 md:grid-cols-3 gap-4 animate-fadeIn">
                                <p class="text-sm"><b>Nombre:</b> {{ nuevoIntegranteData.nombre_completo }}</p>
                                <input type="number" v-model="formInt.horasNuevo" placeholder="Horas"
                                    class="border rounded-lg p-2">
                                <select v-model="formInt.funcionNuevo" class="border rounded-lg p-2">
                                    <option v-for="f in funciones" :key="f.id_funcion" :value="f.id_funcion">{{
                                        f.nombre_funcion }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end gap-3">
                            <button @click="integranteEdit = null" class="px-4 py-2 text-gray-500">Cancelar</button>
                            <button @click="guardarCambiosIntegrante"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold shadow-lg shadow-blue-200">
                                Guardar Cambios
                            </button>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-gray-800 dark:text-white">Integrantes del Proyecto</h3>
                            <input type="text" v-model="filtroIntegrante" placeholder="Filtrar por cédula..."
                                class="text-sm border rounded-lg px-3 py-1.5 dark:bg-gray-800">
                        </div>

                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="p-3 text-left">Cédula</th>
                                    <th class="p-3 text-left">Nombre</th>
                                    <th class="p-3 text-center">Horas</th>
                                    <th class="p-3 text-center">Reemplazado</th>
                                    <th class="p-3 text-left">Función</th>
                                    <th class="p-3 text-right">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="int in integrantesFiltrados" :key="int.id_deta_invi_proyect"
                                    class="border-t dark:border-gray-800 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                                    <td class="p-3">{{ int.ciinfper_doc || int.ciinfper_est }}</td>
                                    <td class="p-3">
                                        {{ int.informacion_personal_d?.NombInfPer || int.informacionpersonal?.NombInfPer
                                        }}
                                        {{ int.informacion_personal_d?.ApellInfPer ||
                                        int.informacionpersonal?.ApellInfPer }}
                                    </td>
                                    <td class="p-3 text-center">{{ int.horas }}</td>
                                    <td class="p-3 text-center">
                                        <span :class="int.reemplazado ? 'text-red-500' : 'text-green-500'">
                                            {{ int.reemplazado ? 'Sí' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="p-3">{{ int.funciones?.nombre_funcion || 'N/A' }}</td>
                                    <td class="p-3 text-right">
                                        <button @click="seleccionarIntegrante(int)"
                                            class="text-blue-600 hover:underline mr-2">Editar</button>
                                        <button @click="inhabilitarIntegrante(int)"
                                            class="text-red-600 hover:underline">Baja</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import Modal from '@/components/Modal/Modal.vue'

const isProfileAddressModal = ref(false)
const isEditModalOpen = ref(false)
const showPassword = ref(false)
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
import { mostraralertas2, enviarsolig } from '@/assets/js/function/funciones';

export default {
    data() {
        return {
            idus: 0,
            baseUrl: "/vin",
            filteredarray: [],
            searchQuery: "",
            isProfileAddressModal: false,
            cargando: false,
            currentPage: 1,
            lastPage: 1,
            buscando: false, // Mantenido, pero no se usa en la lógica de paginación actual
            debouncedFilter: null,
            showModalDetalles: false,
            proyectoSeleccionado: { invi_detalle_fac_proy: [], invi_detalle_integrante: [] },
            filtroIntegrante: '',
            integranteEdit: null,
            formInt: { horas: 0, id_funcion: null, idCarr: null, reemplazado: 0, horasNuevo: 0, funcionNuevo: null },
            funciones: [],
            carreras: [],
            cedulaBusqueda: '',
            nuevoIntegranteData: null,

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
        integrantesFiltrados() {
            if (!this.filtroIntegrante) return this.proyectoSeleccionado.invi_detalle_integrante;
            return this.proyectoSeleccionado.invi_detalle_integrante.filter(i => {
                const ced = i.ciinfper_doc || i.ciinfper_est;
                return ced.includes(this.filtroIntegrante);
            });
        }
    },
    methods: {
        async abrirDetallesProyecto(id) {
            try {
                const [resProj, resCat] = await Promise.all([
                    API.get(`${this.baseUrl}/invi_proyectos/${id}`),
                    API.get(`${this.baseUrl}/catalogos-integrantes`)
                ]);
                this.proyectoSeleccionado = resProj.data;
                console.log(resProj);
                const facultades = resProj.data.invi_detalle_fac_proy.map(f => f.facultades_priori.siglas);
                console.log('Facultades:', facultades);
                this.funciones = resCat.data.funciones;
                this.carreras = resCat.data.carreras;
                this.showModalDetalles = true;
            } catch (e) {
                console.error(e);
            }
        },
        seleccionarIntegrante(int) {
            this.integranteEdit = {
                id: int.id_deta_invi_proyect,
                nombre: (int.informacion_personal_d?.NombInfPer || int.informacionpersonal?.NombInfPer)
            };
            this.formInt = {
                horas: int.horas,
                id_funcion: int.id_funcion,
                idCarr: int.idCarr,
                reemplazado: int.reemplazado
            };
            this.nuevoIntegranteData = null;
            this.cedulaBusqueda = '';
        },
        async buscarNuevoIntegrante() {
            if (!this.cedulaBusqueda) return;
            try {
                const res = await API.get(`${this.baseUrl}/buscar-integrante`, { params: { cedula: this.cedulaBusqueda } });
                this.nuevoIntegranteData = res.data;
            } catch (e) {
                alert("Integrante no encontrado en la base de datos.");
            }
        },

        async inhabilitarIntegrante(int) {
            if (!confirm("¿Desea dar de baja a este integrante?")) return;
            try {
                await API.post(`${this.baseUrl}/inhabilitar-integrante`, { id: int.id_deta_invi_proyect });
                this.abrirDetallesProyecto(this.proyectoSeleccionado.proyect_id); // Recargar
            } catch (e) { console.error(e); }
        },

        async guardarCambiosIntegrante() {
            try {
                let payload = {
                    id_detalle_actual: this.integranteEdit.id,
                    ...this.formInt
                };

                if (this.formInt.reemplazado == 1 && this.nuevoIntegranteData) {
                    payload.nuevo = {
                        cedula: this.nuevoIntegranteData.cedula,
                        tipo: this.nuevoIntegranteData.tipo,
                        horas: this.formInt.horasNuevo,
                        id_funcion: this.formInt.funcionNuevo,
                        idCarr: this.formInt.idCarr // Usamos la misma carrera por defecto
                    };
                    await API.post(`${this.baseUrl}/reemplazar-integrante`, payload);
                } else {
                    await API.put(`${this.baseUrl}/actualizar-integrante/${this.integranteEdit.id}`, payload);
                }

                this.integranteEdit = null;
                this.abrirDetallesProyecto(this.proyectoSeleccionado.proyect_id);
                alert("Información actualizada correctamente");
            } catch (e) { console.error(e); }
        },

        async GetData(page = 1, searchQuery = "") {
            this.cargando = true;

            try {
                const params = {
                    page: page,
                    search_query: searchQuery // Parámetro para búsqueda
                };
                const response = await API.get(`${this.baseUrl}/invi_proyectos`, { params });

                const data = response.data?.data || [];
                this.filteredarray = data
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

    },
};
</script>
