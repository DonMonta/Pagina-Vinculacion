<template>
  <div class="max-w-4xl mx-auto p-4 lg:p-6">
    <div class="mb-8 text-center">
      <h2 class="text-2xl font-bold text-gray-900 dark:text-white lg:text-3xl">Formulario de Inscripción</h2>
      <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Convocatoria de Ayudantes de Cátedra</p>
    </div>

    <div class="mb-8">
      <div class="flex items-center justify-between max-w-md mx-auto relative">
        <div class="absolute left-0 top-1/2 w-full h-0.5 bg-gray-200 dark:bg-gray-700 -translate-y-1/2 z-0"></div>
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
        <p class="text-sm font-medium text-gray-500 mt-4">Cargando detalles de la postulación...</p>
      </div>

      <div v-else-if="errorMsg" class="text-center py-8 text-red-500 font-medium">
        {{ errorMsg }}
      </div>

      <div v-else>
        <div v-if="activeTab === 1" class="space-y-4">
          <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ formularioData.NOMBRE }}</h3>
          <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
            La Universidad Técnica "Luis Vargas Torres" de Esmeraldas reafirma su compromiso con la excelencia educativa
            y el desarrollo integral de su estudiantado.
            Con el objetivo de fortalecer el proceso de enseñanza aprendizaje se convoca este concurso para seleccionar
            a los/as 40 mejores alumnos/as que, durante un semestre,
            se desempeñarán como Ayudantes de Cátedra. Este programa reconoce el rendimiento académico, impulsando la
            formación de futuros/as líderes/as académicos/as.
          </p>
          <div class="p-4 bg-amber-50 dark:bg-amber-950/20 border border-amber-200 dark:border-amber-900/40 rounded-xl">
            <h5 class="text-sm font-bold text-amber-800 dark:text-amber-400 mb-1">Requisitos para ayudante de cátedra
            </h5>
            <p class="text-xs text-amber-700 dark:text-amber-300">
              * Promedio académico mínimo: 7/10.
            </p>
            <p class="text-xs text-amber-700 dark:text-amber-300">
              * Para ser ayudante de cátedra se requiere haber cursado y aprobado al menos el quinto nivel de la
              carrera.
            </p>
            <p class="text-xs text-amber-700 dark:text-amber-300">
              * No ser becado.
            </p>
            <p class="text-xs text-amber-700 dark:text-amber-300">
              * No tener sanciones disciplinarias registradas en el expediente académico.
            </p>
            <p class="text-xs text-amber-700 dark:text-amber-300">
              * No estar afiliado al IEES. Enlace: <a
                href="https://www.iess.gob.ec/afiliado-web/pages/opcionesGenerales/seleccionCertificadoDeAfiliacion.jsf"
                target="_blank" class="text-amber-600 dark:text-amber-400 hover:underline">IEES</a>
            </p>
            <p class="text-xs text-amber-700 dark:text-amber-300">
              * Tener un certificado de actividades extracurriculares (Voluntariado, Congresos, Seminarios, Simposios,
              etc.)
            </p>
            <p class="text-xs text-amber-700 dark:text-amber-300">
              * No estar cursando una segunda carrera.
            </p>
            <p class="text-xs text-amber-700 dark:text-amber-300">
              * Curriculum Vitae Normalizado actualizado (CVN) Enlace: <a
                href="http://vinculacionconlasociedad.utelvt.edu.ec/cvn/home" target="_blank"
                class="text-amber-600 dark:text-amber-400 hover:underline">CVN UTLVTE</a>
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
          <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Fase 2: Inscripción</h3>

          <div v-for="(pregunta, idx) in formularioData.seguipreguntas" :key="pregunta.ID"
            class="border-b border-gray-100 dark:border-gray-800 pb-5 last:border-0">
            <div v-if="idx === formularioData.seguipreguntas.length - 1"
              class="mb-6 p-4 bg-blue-50 dark:bg-blue-950/30 border border-blue-200 dark:border-blue-900/40 rounded-xl flex flex-col sm:flex-row items-start gap-3">
              <div class="text-blue-600 dark:text-blue-400 shrink-0 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
              </div>
              <div>
                <p class="text-sm font-bold text-blue-900 dark:text-blue-200 mb-1">Paso Importante Requerido:</p>
                <p class="text-xs text-blue-700 dark:text-blue-300 leading-relaxed">
                  Antes de pasar a la última pregunta debes generar el documento word donde estará el anexo 5 el cual
                  debes llenar y subir a tu drive personal como lo indica el siguiente video:
                  <a href="https://youtu.be/xK-uqnv00tI" target="_blank"
                    class="inline-flex items-center font-bold text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300 ml-1 underline">
                    Ver video tutorial aquí
                    <svg class="w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                  </a>
                </p>
                <p class="text-xs text-blue-700 dark:text-blue-300 leading-relaxed">
                  <b>Nota: los documentos como el CVN debes entregarlo por separado del Anexo5</b>

                </p>
                <p class="text-xs text-blue-700 dark:text-blue-300 leading-relaxed mt-2">
                  Clic en el siguiente enlace para generar el documento Word Anexo 5:
                  <a href="#" @click.prevent="descargarAnexoWord"
                    class="inline-flex items-center font-bold text-brand-600 hover:text-brand-700 dark:text-brand-400 dark:hover:text-brand-300 ml-1 underline">
                    <span v-if="isDownloadingWord"
                      class="w-3.5 h-3.5 border-2 border-brand-600 border-t-transparent rounded-full animate-spin mr-1"></span>
                    {{ isDownloadingWord ? 'Generando Documento...' : 'Generar Documento Word Anexo 5' }}
                    <svg v-if="!isDownloadingWord" class="w-3.5 h-3.5 ml-0.5" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                  </a>
                </p>
              </div>
            </div>
            <label class="block text-sm font-semibold text-gray-800 dark:text-white mb-3">
              {{ idx + 1 }}. {{ pregunta.PREGUNTA }}
              <span class="text-xs font-normal text-gray-400 italic">({{ pregunta.tipo }})</span>
            </label>

            <div v-if="pregunta.tipo === 'Abierta'">
              <textarea rows="3" v-model="respuestasEstudiante[pregunta.ID].textorespuesta"
                placeholder="Escribe tu respuesta detallada aquí..."
                class="w-full px-4 py-3 text-sm border border-gray-200 rounded-xl focus:ring-brand-500 focus:border-brand-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white"></textarea>
            </div>

            <div v-else-if="pregunta.tipo === 'Selección Única'" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
              <div v-for="opcion in pregunta.seguitiporespuesta" :key="opcion.ID"
                class="flex items-center px-4 py-3 border border-gray-200 dark:border-gray-800 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors">
                <input type="radio" :id="'radio_' + opcion.ID" :name="'preg_' + pregunta.ID" :value="opcion.ID"
                  v-model="respuestasEstudiante[pregunta.ID].idtiporespuesta"
                  class="w-4 h-4 text-brand-600 border-gray-300 focus:ring-brand-500" />
                <label :for="'radio_' + opcion.ID"
                  class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer w-full">
                  {{ opcion.TIPORESPUESTA }}
                </label>
              </div>
            </div>

            <div v-else-if="pregunta.tipo === 'SELECCIÓN MÚLTIPLE'" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
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
            Hemos verificado tus respuestas satisfactoriamente. Al presionar el botón "Finalizar Inscripción", se
            guardará tu postulación en el sistema de Vinculación de manera permanente.
          </p>

          <div class="flex justify-between pt-8 border-t border-gray-100 dark:border-gray-800">
            <button @click="prevTab" :disabled="submitting"
              class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl dark:bg-gray-800 dark:text-gray-300 transition-all">
              Atrás
            </button>
            <button @click="finalizarInscripcion" :disabled="submitting"
              class="px-6 py-2.5 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-all shadow-md flex items-center gap-2">
              <span v-if="submitting"
                class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
              {{ submitting ? 'Guardando...' : 'Finalizar Inscripción' }}
            </button>
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
      respuestasEstudiante: {}
    };
  },
  async mounted() {
    const usuario = await getMe();
    this.PersonalInfo = usuario;
    this.UsuarioInfo = useUsuario();
    await this.fetchFormulario();
  },
  methods: {
    async fetchFormulario() {
      this.loading = true;
      try {
        const response = await API.get("/vin/getFormularioInscripcion");
        if (response.data?.success) {
          this.formularioData = response.data.data;

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
      } catch (error) {
        this.errorMsg = error.response?.data?.message || "Ocurrió un error al cargar el formulario dinámico.";
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
    async descargarAnexoWord() {
      if (this.isDownloadingWord) return;
      this.isDownloadingWord = true;

      try {
        // Carga diferida de la librería para optimizar performance
        const docx = await import("docx");

        // 1. Obtener la imagen de fondo completa desde la carpeta /public
        let fondoBuffer = null;
        try {
          const bgRes = await fetch("/fondo.png");
          if (bgRes.ok) {
            fondoBuffer = new Uint8Array(await bgRes.arrayBuffer());
          }
        } catch (err) {
          console.warn("No se pudo cargar la imagen de fondo desde la carpeta public", err);
        }

        // 2. Mapear datos personales cargados desde PersonalInfo
        const nombres = `${this.PersonalInfo.NombInfPer} ${this.PersonalInfo.ApellInfPer} ${this.PersonalInfo.ApellMatInfPer || ''}`.trim() || "_________________________________";
        const cedula = this.PersonalInfo.CIInfPer || "_________________________________";
        const correo = this.PersonalInfo.mailInst || "_________________________________";
        const telefono = this.PersonalInfo.TelInfPer || "_________________________________";
        const carrera = this.UsuarioInfo.carreraUsuario || "_________________________________";
        const facultad = this.UsuarioInfo.facultadUsuario || "_________________________________";
        const nivel = this.UsuarioInfo.nivelUsuario || "_________________________________";

        // 3. Formatear la fecha del día automáticamente
        const fechaActual = new Date();
        const fechaFormateada = `${String(fechaActual.getDate()).padStart(2, '0')} / ${String(fechaActual.getMonth() + 1).padStart(2, '0')} / ${fechaActual.getFullYear()}`;

        // 4. Instanciar el Documento Word aplicando Estilos Globales (Times New Roman 12, Interlineado 1.5)
        const doc = new docx.Document({
          styles: {
            default: {
              document: {
                run: {
                  font: "Times New Roman",
                  size: 24, // 12pt reales
                },
                paragraph: {
                  spacing: {
                    line: 360, // Interlineado de 1.5
                  },
                },
              },
            },
          },
          sections: [{
            properties: {
              page: {
                // DIMENSIONES NUMÉRICAS EXACTAS DE UNA HOJA A4 EN TWIPS (Evita el error de 'A4' undefined)
                size: {
                  width: 11906,
                  height: 16838,
                },
                // Márgenes normales para el contenido del texto
                margin: { top: 1440, bottom: 1440, left: 1440, right: 1440 }
              }
            },
            headers: {
              default: new docx.Header({
                children: fondoBuffer ? [
                  new docx.Paragraph({
                    children: [
                      new docx.ImageRun({
                        data: fondoBuffer,
                        transformation: {
                          // MEDIDAS EN PÍXELES EXACTAS PARA ADAPTARSE A LA HOJA A4 (96 DPI)
                          width: 794,
                          height: 1122,
                        },
                        floating: {
                          horizontalPosition: {
                            relative: docx.HorizontalPositionRelativeFrom.PAGE,
                            offset: 0, // Alineado al borde izquierdo absoluto de la hoja
                          },
                          verticalPosition: {
                            relative: docx.VerticalPositionRelativeFrom.PAGE,
                            offset: 0, // Alineado al borde superior absoluto de la hoja
                          },
                          wrap: {
                            type: docx.TextWrappingType.NONE, // Permite que el texto se dibuje encima
                          },
                          behindText: true // Envía la imagen al fondo por detrás del texto
                        },
                      }),
                    ],
                  }),
                ] : [],
              }),
            },
            children: [
              // Encabezados de Título
              new docx.Paragraph({ alignment: docx.AlignmentType.CENTER, spacing: { after: 100, line: 360 }, children: [new docx.TextRun({ text: "ANEXO 5: FORMATO DE POSTULACIÓN", bold: true })] }),
              new docx.Paragraph({ alignment: docx.AlignmentType.CENTER, spacing: { after: 100, line: 360 }, children: [new docx.TextRun({ text: "CONCURSO DE SELECCIÓN DE AYUDANTES DE CÁTEDRA 2026", bold: true })] }),
              new docx.Paragraph({ alignment: docx.AlignmentType.CENTER, spacing: { after: 300, line: 360 }, children: [new docx.TextRun({ text: "“Ayudantías de Cátedra: Impulso a la Excelencia Académica 2026”", italic: true })] }),

              // Sección 1: Datos Personales
              new docx.Paragraph({ spacing: { before: 150, after: 100, line: 360 }, children: [new docx.TextRun({ text: "I. DATOS PERSONALES", bold: true })] }),
              new docx.Paragraph({ spacing: { after: 50, line: 360 }, children: [new docx.TextRun({ text: `Nombres y Apellidos: `, bold: true }), new docx.TextRun({ text: nombres })] }),
              new docx.Paragraph({ spacing: { after: 50, line: 360 }, children: [new docx.TextRun({ text: `Cédula de Identidad: `, bold: true }), new docx.TextRun({ text: cedula })] }),
              new docx.Paragraph({ spacing: { after: 50, line: 360 }, children: [new docx.TextRun({ text: `Correo Institucional: `, bold: true }), new docx.TextRun({ text: correo })] }),
              new docx.Paragraph({ spacing: { after: 50, line: 360 }, children: [new docx.TextRun({ text: `Número Telefónico de Contacto: _________________________________` })] }),
              new docx.Paragraph({ spacing: { after: 50, line: 360 }, children: [new docx.TextRun({ text: `Carrera: `, bold: true }), new docx.TextRun({ text: carrera })] }),
              new docx.Paragraph({ spacing: { after: 50, line: 360 }, children: [new docx.TextRun({ text: `Facultad: `, bold: true }), new docx.TextRun({ text: facultad })] }),
              new docx.Paragraph({ spacing: { after: 50, line: 360 }, children: [new docx.TextRun({ text: `Nivel actual (indicar ciclo): `, bold: true }), new docx.TextRun({ text: nivel })] }),
              new docx.Paragraph({ spacing: { after: 200, line: 360 }, children: [new docx.TextRun({ text: `Promedio General (últimos dos periodos): _____________________` })] }),


              // Sección 3: Experiencia
              new docx.Paragraph({ spacing: { before: 150, after: 100, line: 360 }, children: [new docx.TextRun({ text: "II. EXPERIENCIA RELEVANTE Y MÉRITOS (adjuntar respaldos)", bold: true })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "Participación en actividades académicas o investigativas previas:" })] }),
              new docx.Paragraph({ spacing: { after: 100, line: 360 }, children: [new docx.TextRun({ text: "Describir brevemente:" })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "Eventos científicos, cursos, seminarios o congresos:" })] }),
              new docx.Paragraph({ spacing: { after: 100, line: 360 }, children: [new docx.TextRun({ text: "Describir brevemente:" })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "Experiencia en tutorías, ferias académicas, vinculación, etc.:" })] }),
              new docx.Paragraph({ spacing: { after: 200, line: 360 }, children: [new docx.TextRun({ text: "Describir brevemente:" })] }),

              // Sección 4: Documentos
              new docx.Paragraph({ spacing: { before: 150, after: 100, line: 360 }, children: [new docx.TextRun({ text: "III. DOCUMENTOS QUE SE ADJUNTAN (en formato PDF)", bold: true })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "☐  Copia de cédula (lado y lado)" })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "☐  Certificado de promedio académico (mínimo 7/10)" })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "☐  Certificado de haber aprobado o estar cursando al menos el tercer nivel de la carrera." })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "☐  Certificado de no tener sanciones disciplinarias." })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "☐  Certificados de actividades extracurriculares." })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "☐  No estar afiliado al IESS." })] }),
              new docx.Paragraph({ spacing: { after: 40, line: 360 }, children: [new docx.TextRun({ text: "☐  Curriculum Vitae Normalizado actualizado." })] }),
              new docx.Paragraph({ spacing: { after: 200, line: 360 }, children: [new docx.TextRun({ text: "☐  Declaración de no cursar una segunda carrera en la UTLVTE." })] }),

              // Sección 5: Declaración
              new docx.Paragraph({ spacing: { before: 150, after: 100, line: 360 }, children: [new docx.TextRun({ text: "IV. DECLARACIÓN PERSONAL", bold: true })] }),
              new docx.Paragraph({ spacing: { after: 100, line: 360 }, children: [new docx.TextRun({ text: "Declaro que la información proporcionada es veraz y que cumplo con todos los requisitos estipulados en la convocatoria. Me comprometo a cumplir con las responsabilidades asignadas en caso de ser seleccionado/a." })] }),
              new docx.Paragraph({ spacing: { before: 150, after: 300, line: 360 }, children: [new docx.TextRun({ text: `Fecha: ${fechaFormateada}`, bold: true })] }),
              new docx.Paragraph({ spacing: { before: 300, line: 360 }, children: [new docx.TextRun({ text: "Firma del Postulante: _________________________________" })] }),
            ]
          }]
        });

        // 5. Compilar y disparar la descarga directa en el navegador
        const blob = await docx.Packer.toBlob(doc);
        const url = window.URL.createObjectURL(blob);
        const link = document.createElement("a");
        link.href = url;
        link.download = `Anexo_5_Postulacion_${cedula}.docx`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(url);

      } catch (error) {
        mostraralertas2("Ocurrió un error inesperado al intentar generar el Word desde el navegador.", "error");
        console.error(error);
      } finally {
        this.isDownloadingWord = false;
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
        alert("Por favor, responda todas las preguntas antes de avanzar.");
        return;
      }
      this.nextTab();
    },
    async finalizarInscripcion() {
      this.submitting = true;
      try {
        const respuestasPayload = Object.values(this.respuestasEstudiante);

        const payload = {
          idformulario: this.formularioData.ID,
          cedula_estudiante: this.PersonalInfo.CIInfPer,
          idcarr: this.UsuarioInfo.idcarreraUsuario,
          respuestas: respuestasPayload
        };

        const response = await API.post("/vin/guardarInscripcion", payload);

        if (response.data?.success) {
          mostraralertas2("Encuesta guardada con éxito", "success");
          this.$router.push("/site-admin/perfil");
        }
      } catch (error) {
        mostraralertas2(error.response?.data?.error || "Error al registrar la encuesta.", "error");
        console.error(error);
      } finally {
        this.submitting = false;
      }
    }
  }
}
</script>