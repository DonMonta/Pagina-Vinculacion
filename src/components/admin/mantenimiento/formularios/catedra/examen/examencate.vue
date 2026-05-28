<template>
    <div class="max-w-4xl mx-auto p-4 lg:p-6">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white lg:text-3xl">Evaluación de Conocimientos </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Concurso de Ayudantías de Cátedra</p>
        </div>

        <div v-if="!loading && !errorMsg && !yaRendido" class="mb-8">
            <div class="flex items-center justify-between max-w-md mx-auto relative">
                <div class="absolute left-0 top-1/2 w-full h-0.5 bg-gray-200 dark:bg-gray-700 -translate-y-1/2 z-0">
                </div>
                <div class="absolute left-0 top-1/2 h-0.5 bg-brand-500 -translate-y-1/2 z-0 transition-all duration-300"
                    :style="{ width: ((activeTab - 1) * 50) + '%' }"></div>

                <div class="relative z-10 flex flex-col items-center">
                    <div
                        :class="['w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-colors duration-300', activeTab >= 1 ? 'bg-brand-600 text-white' : 'bg-gray-200 text-gray-600 dark:bg-gray-800']">
                        1</div>
                    <span class="text-xs font-semibold mt-2 text-gray-700 dark:text-gray-300">Información</span>
                </div>
                <div class="relative z-10 flex flex-col items-center">
                    <div
                        :class="['w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-colors duration-300', activeTab >= 2 ? 'bg-brand-600 text-white' : 'bg-gray-200 text-gray-600 dark:bg-gray-800']">
                        2</div>
                    <span class="text-xs font-semibold mt-2 text-gray-700 dark:text-gray-300">Preguntas</span>
                </div>
                <div class="relative z-10 flex flex-col items-center">
                    <div
                        :class="['w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-colors duration-300', activeTab >= 3 ? 'bg-brand-600 text-white' : 'bg-gray-200 text-gray-600 dark:bg-gray-800']">
                        3</div>
                    <span class="text-xs font-semibold mt-2 text-gray-700 dark:text-gray-300">Finalizar</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 shadow-sm">

            <div v-if="loading" class="flex flex-col items-center justify-center py-12">
                <div class="w-10 h-10 border-4 border-brand-500 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-sm font-medium text-gray-500 mt-4">Cargando detalles de la evaluación...</p>
            </div>

            <div v-else-if="errorMsg" class="text-center py-8 text-red-500 font-medium">
                {{ errorMsg }}
            </div>

            <div v-else>
                <div v-if="yaRendido" class="space-y-6 animate-fade-in">

                    <div class="p-6 rounded-2xl border text-center sm:text-left flex flex-col sm:flex-row justify-between items-center gap-6"
                        :class="puntaje >= 7 ? 'bg-emerald-50/60 border-emerald-200 dark:bg-emerald-950/20 dark:border-emerald-900/40' : 'bg-red-50/60 border-red-200 dark:bg-red-950/20 dark:border-red-900/40'">

                        <div class="space-y-2">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold"
                                :class="indigo, puntaje >= 7 ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-400' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Examen ya Respondido
                            </div>
                            <h3 class="text-xl font-extrabold text-gray-900 dark:text-white">¡Evaluación Finalizada con
                                Éxito!</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 max-w-md">
                                Tus respuestas se encuentran registradas permanentemente en el Sistema de Vinculación de
                                la UTLVTE.
                            </p>
                        </div>

                        <div class="shrink-0 text-center px-8 py-4 rounded-xl border bg-white dark:bg-gray-800 shadow-sm min-w-[140px]"
                            :class="puntaje >= 7 ? 'border-emerald-200 dark:border-emerald-800' : 'border-red-200 dark:border-red-800'">
                            <p class="text-[10px] font-black uppercase tracking-wider text-gray-400 mb-1">Tu Puntaje</p>
                            <div class="text-3xl font-black"
                                :class="indigo, puntaje >= 7 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400'">
                                {{ puntaje }} <span class="text-base font-normal text-gray-400">/ {{ totalPreguntas
                                    }}</span>
                            </div>
                            <p class="text-[11px] font-bold mt-1"
                                :class="puntaje >= 7 ? 'text-emerald-600' : 'text-red-600'">
                                {{ puntaje >= 7 ? 'Aprobado' : 'No aprobado' }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-bold text-gray-800 dark:text-white uppercase tracking-wider mb-4">
                            Revisión de respuestas enviadas</h4>
                        <div class="space-y-4">
                            <div v-for="(item, index) in respuestasHistoricas" :key="index"
                                class="p-4 rounded-xl border"
                                :class="item.valor == 1 ? 'bg-emerald-50/20 border-emerald-100 dark:bg-emerald-950/10 dark:border-emerald-900/30' : 'bg-red-50/20 border-red-100 dark:bg-red-950/10 dark:border-red-900/30'">

                                <div class="flex justify-between items-start gap-4">
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ index + 1 }}.
                                        {{ item.PREGUNTA }}</p>
                                    <span class="shrink-0">
                                        <svg v-if="item.valor == 1" class="w-5 h-5 text-emerald-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <svg v-else class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                </div>

                                <div
                                    class="mt-3 text-xs px-3 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700/60 flex items-center gap-2">
                                    <span class="font-bold text-gray-400">Tu respuesta:</span>
                                    <span class="font-medium"
                                        :class="item.valor == 1 ? 'text-emerald-700 dark:text-emerald-400' : 'text-red-700 dark:text-red-400'">
                                        {{ item.opcion_seleccionada || item.textorespuesta || 'Sin responder' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <router-link to="/site-admin/perfil"
                            class="px-5 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 rounded-xl transition-all">
                            Volver al Perfil
                        </router-link>
                    </div>
                </div>

                <div v-else>
                    <div v-if="activeTab === 1" class="space-y-4">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ formularioData?.NOMBRE }}</h3>
                        <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            Con el objetivo de seleccionar a los/as mejores estudiantes para desempeñarse como ayudantes
                            de
                            cátedra e investigación. La presente evaluación tiene como propósito valorar los
                            conocimientos
                            teóricos y prácticos fundamentales relacionados con la gestión académica universitaria, el
                            rol
                            del/la ayudante y los lineamientos institucionales vigentes.
                        </p>
                        <div
                            class="p-4 bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-900/40 rounded-xl">
                            <h5 class="text-sm font-bold text-amber-800 dark:text-amber-400 mb-1">Ten en cuenta lo
                                siguiente: </h5>
                            <p class="text-xs text-amber-700 dark:text-amber-300">
                                Cada pregunta tiene una sola respuesta correcta, por lo que se recomienda leer
                                cuidadosamente antes de responder.
                                Esta evaluación busca identificar a estudiantes con habilidades analíticas, compromiso
                                ético y conocimiento del contexto académico universitario,
                                cualidades fundamentales para desempeñar con excelencia la labor de ayudantía.
                            </p>
                            <p class="text-xs text-amber-700 dark:text-amber-300 mt-2">
                                <b>Nota: Luego de responder todas las preguntas, se le pedirá que confirme la respuesta.
                                    Tu nota de postulación será enviada a tu correo institucional.</b>
                            </p>
                        </div>
                        <div class="flex justify-end pt-4">
                            <button @click="nextTab"
                                class="px-5 py-2.5 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 rounded-xl transition-all shadow-md shadow-brand-500/10">
                                Siguiente Paso
                            </button>
                        </div>
                    </div>

                    <div v-if="activeTab === 2" class="space-y-6">
                        <div class="flex items-center justify-between bg-red-50 dark:bg-red-950/20 border border-red-100 dark:border-red-900/40 p-4 rounded-xl mb-4 sticky top-0 z-20 backdrop-blur-md">
                            <span class="text-sm font-semibold text-red-700 dark:text-red-400 flex items-center gap-2">
                                <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Tiempo restante para rendir el examen:
                            </span>
                            <span class="text-xl font-black text-red-600 dark:text-red-400 tracking-wider">
                                {{ tiempoFormateado }}
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Fase 2: Evaluación de
                            Conocimientos</h3>

                        <div v-for="(pregunta, idx) in formularioData?.seguipreguntas" :key="pregunta.ID"
                            class="border-b border-gray-100 dark:border-gray-800 pb-5 last:border-0">

                            <label class="block text-sm font-semibold text-gray-800 dark:text-white mb-3">
                                {{ idx + 1 }}. {{ pregunta.PREGUNTA }}
                                <span class="text-xs font-normal text-gray-400 italic">({{ pregunta.tipo }})</span>
                            </label>

                            <div v-if="pregunta.tipo === 'Abierta'">
                                <textarea rows="3" v-model="respuestasEstudiante[pregunta.ID].textorespuesta"
                                    placeholder="Escribe tu respuesta detallada aquí..."
                                    class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:ring-brand-500 focus:border-brand-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white"></textarea>
                            </div>

                            <div v-else-if="pregunta.tipo === 'Selección Única'"
                                class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div v-for="opcion in pregunta.seguitiporespuesta" :key="opcion.ID"
                                    class="flex items-center px-4 py-3 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors">
                                    <input type="radio" :id="'radio_' + opcion.ID" :name="'preg_' + pregunta.ID"
                                        :value="opcion.ID" v-model="respuestasEstudiante[pregunta.ID].idtiporespuesta"
                                        class="w-4 h-4 text-brand-600 border-gray-300 focus:ring-brand-500" />
                                    <label :for="'radio_' + opcion.ID"
                                        class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer w-full">
                                        {{ opcion.TIPORESPUESTA }}
                                    </label>
                                </div>
                            </div>

                            <div v-else-if="pregunta.tipo === 'SELECCIÓN MÚLTIPLE'"
                                class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div v-for="opcion in pregunta.seguitiporespuesta" :key="opcion.ID"
                                    class="flex items-center px-4 py-3 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors">
                                    <input type="checkbox" :id="'check_' + opcion.ID" :value="opcion.ID"
                                        v-model="respuestasEstudiante[pregunta.ID].idtiporespuesta"
                                        class="w-4 h-4 text-brand-600 border-gray-300 rounded focus:ring-brand-500" />
                                    <label :for="'check_' + opcion.ID"
                                        class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer w-full">
                                        {{ opcion.TIPORESPUESTA }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between pt-4 border-t border-gray-100 dark:border-gray-800">
                            <button @click="prevTab"
                                class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl dark:bg-gray-800 dark:text-gray-300 transition-all">
                                Atrás
                            </button>
                            <button @click="validarYContinuar"
                                class="px-5 py-2.5 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 rounded-xl transition-all shadow-md">
                                Validar y Continuar
                            </button>
                        </div>
                    </div>

                    <div v-if="activeTab === 3" class="text-center py-4 space-y-5">
                        <div
                            class="w-16 h-16 bg-brand-100 dark:bg-brand-950/40 text-brand-600 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">¡Todo listo para enviar!</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                            Hemos verificado tus respuestas satisfactoriamente. Al presionar el botón "Finalizar
                            Evaluación", se guardarán tus respuestas en el sistema de Vinculación de manera permanente.

                            <b class="block mt-2 text-brand-600 dark:text-brand-400">Tu nota de postulación será enviada
                                a tu correo institucional.</b>
                        </p>

                        <div class="flex justify-between pt-8 border-t border-gray-100 dark:border-gray-800">
                            <button @click="prevTab" :disabled="submitting"
                                class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl dark:bg-gray-800 dark:text-gray-300 transition-all">
                                Atrás
                            </button>
                            <button @click="finalizarevaluacion" :disabled="submitting"
                                class="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-md flex items-center gap-2">
                                <span v-if="submitting"
                                    class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                                {{ submitting ? 'Guardando...' : 'Finalizar Evaluación' }}
                            </button>
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
import { mostraralertas2, enviarsolig, eliminacion, confimarhabi, elimnarpermanente } from '@/assets/js/function/funciones';

export default {
    data() {
        return {
            activeTab: 1,
            loading: true,
            submitting: false,
            isDownloadingWord: false,
            errorMsg: null,
            PersonalInfo: {},
            UsuarioInfo: {},
            formularioData: null,
            respuestasEstudiante: {},
            // Nuevas propiedades para control de examen ya rendido
            yaRendido: false,
            puntaje: 0,
            totalPreguntas: 0,
            respuestasHistoricas: [],
            tiempoRestante: 15 * 60, // 15 minutos en segundos (900s)
            intervaloTimer: null
        };
    },
    computed: {
        // Formatea los segundos sobrantes a estructura MM:SS
        tiempoFormateado() {
            const minutos = Math.floor(this.tiempoRestante / 60);
            const segundos = this.tiempoRestante % 60;
            return `${minutos.toString().padStart(2, '0')}:${segundos.toString().padStart(2, '0')}`;
        }
    },
    watch: {
        // Monitorea el cambio de tabs para activar o frenar el tiempo
        activeTab(newTab) {
            if (newTab === 2) {
                this.iniciarCronometro();
            } else if (newTab === 3) {
                this.detenerCronometro();
            }
        }
    },
    beforeDestroy() {
        // Limpieza del intervalo si el usuario destruye o sale del componente proactivamente
        this.detenerCronometro();
    },
    async mounted() {
        const usuario = await getMe();
        this.PersonalInfo = usuario;
        this.UsuarioInfo = useUsuario();
        await this.fetchFormulario();
    },
    methods: {
        iniciarCronometro() {
            // Asegurar que no existan múltiples intervalos abiertos
            this.detenerCronometro(); 
            this.intervaloTimer = setInterval(() => {
                if (this.tiempoRestante > 0) {
                    this.tiempoRestante--;
                } else {
                    this.detenerCronometro();
                    this.manejarTiempoExpirado();
                }
            }, 1000);
        },
        detenerCronometro() {
            if (this.intervaloTimer) {
                clearInterval(this.intervaloTimer);
                this.intervaloTimer = null;
            }
        },
        async manejarTiempoExpirado() {
            // Si el alumno continúa estancado en el tab de preguntas (Fase 2)
            if (this.activeTab === 2) {
                mostraralertas2(
                    "Ya pasó el tiempo límite para rendir el examen. Tus respuestas seleccionadas hasta el momento han sido enviadas de manera automática.", 
                    "warning"
                );
                await this.finalizarevaluacion();
            }
        },
        async fetchFormulario() {
            this.loading = true;
            try {
                const response = await API.get("/vin/getFormularioEvaluacion");
                if (response.data?.success) {
                    this.formularioData = response.data.data;
                    // 2. Comprobamos si el estudiante ya rindió este examen
                    const resEstado = await API.get("/vin/getCatedraEvaluacion", {
                        params: { cedula: this.PersonalInfo.CIInfPer }
                    });

                    // Extraemos si ya fue evaluado
                    const yaEvaluado = resEstado.data?.yaEvlauado;

                    if (yaEvaluado) {
                        this.yaRendido = true;

                        // 3. Traemos las respuestas guardadas e históricas usando el ID del formulario y su cédula
                        const resDetalle = await API.get(`/vin/getDetalleRespuestasEstudiante/${this.formularioData.ID}/${this.PersonalInfo.CIInfPer}`);
                        if (resDetalle.data && resDetalle.data.respuestas) {
                            this.respuestasHistoricas = resDetalle.data.respuestas;
                            this.totalPreguntas = this.respuestasHistoricas.length;

                            // Calculamos la suma de las respuestas que tengan valor === 1
                            this.puntaje = this.respuestasHistoricas.reduce((total, item) => {
                                return total + (parseInt(item.valor) === 1 ? 1 : 0);
                            }, 0);
                        }
                    } else {
                        this.yaRendido = false;
                        // Inicializar las estructuras de datos según el tipo de pregunta
                        this.formularioData.seguipreguntas.forEach(preg => {
                            this.respuestasEstudiante[preg.ID] = {
                                idpregunta: preg.ID,
                                // Si es múltiple se inicializa como Array [], si no, como null
                                idtiporespuesta: preg.tipo === 'SELECCIÓN MÚLTIPLE' ? [] : null,
                                textorespuesta: ""
                            };
                        });
                    }

                }
            } catch (error) {
                this.errorMsg = error.response?.data?.message || "Ocurrió un error al cargar el formulario dinámico.";
                console.error(error);
            } finally {
                this.loading = false;
            }
        },

        nextTab() {
            if (this.activeTab < 3) this.activeTab++;
        },
        prevTab() {
            if (this.activeTab > 1) this.activeTab--;
        },
        validarYContinuar() {
            let incompleto = false;

            this.formularioData.seguipreguntas.forEach(preg => {
                const resp = this.respuestasEstudiante[preg.ID];

                if (preg.tipo === 'Abierta' && !resp.textorespuesta.trim()) {
                    incompleto = true;
                }
                else if (preg.tipo === 'Selección Única' && !resp.idtiporespuesta) {
                    incompleto = true;
                }
                else if (preg.tipo === 'SELECCIÓN MÚLTIPLE' && (!resp.idtiporespuesta || resp.idtiporespuesta.length === 0)) {
                    incompleto = true;
                }
            });

            if (incompleto) {
                mostraralertas2("Por favor, responda todas las preguntas antes de avanzar.", "warning");
                return;
            }
            this.nextTab();
        },
        async finalizarevaluacion() {
            this.submitting = true;
            try {
                const respuestasPayload = Object.values(this.respuestasEstudiante);

                const payload = {
                    idformulario: this.formularioData.ID,
                    cedula_estudiante: this.PersonalInfo.CIInfPer,
                    idcarr: this.UsuarioInfo.idcarreraUsuario,
                    respuestas: respuestasPayload
                };

                const response = await API.post("/vin/guardarEvaluacion", payload);

                if (response.data?.success) {
                    mostraralertas2("Evaluación guardada con éxito", "success");
                    this.$router.push("/site-admin/perfil");
                }
            } catch (error) {
                mostraralertas2(error.response?.data?.error || "Error al registrar la evaluación.", "error");
                console.error(error);
            } finally {
                this.submitting = false;
            }
        }
    }
}
</script>