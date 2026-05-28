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
            <input type="text" placeholder="Ingresa el nombre del formulario a buscar..." v-model="searchQuery"
              @input="debouncedFilter"
              class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pl-12 pr-14 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-900 dark:bg-white/[0.03] dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 xl:w-[430px]" />
          </div>
        </form>
      </div>

      <div class="flex items-center gap-3">


        <button @click="isProfileAddressModal = true"
          class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
          Crear Formulario
        </button>
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
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Nombre</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Total Preguntas/Respuestas</p>
            </th>
            <th class="py-5 px-4 text-left">
              <p class="font-semibold text-gray-500 text-sm dark:text-gray-400">Estado</p>
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
          <tr v-else v-for="post in filteredarray" :key="post.ID"
            class="border-t border-gray-100 hover:bg-gray-50/50 dark:border-gray-800 dark:hover:bg-white/[0.02] transition-colors">

            <td class="py-5 px-4 whitespace-nowrap">
              <p class="text-gray-600 text-sm font-medium dark:text-gray-400">{{ post.ID }}</p>
            </td>

            <td class="py-5 px-4 whitespace-nowrap">
              <div>
                <p class="font-bold text-gray-800 text-base dark:text-white/90">
                  {{ post.NOMBRE }}
                </p>
              </div>
            </td>
            <td class="py-5 px-4">
              <div class="flex flex-col gap-1">
                <span class="text-xs font-medium text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full w-fit">
                  {{ post.total_preguntas }} Preguntas
                </span>
                <span class="text-xs font-medium text-cyan-600 bg-cyan-50 px-2 py-0.5 rounded-full w-fit">
                  {{ post.total_encuestas }} Respuestas
                </span>
              </div>
            </td>
            <td class="py-5 px-4 whitespace-nowrap">
              <span :class="{
                'rounded-lg px-3 py-1 text-xs font-bold uppercase tracking-wider': true,
                'bg-green-100 text-green-700 dark:bg-success-500/15 dark:text-success-500': post.ACTIVO === 1,
                'bg-orange-100 text-orange-700 dark:bg-warning-500/15 dark:text-orange-400': post.ACTIVO === 0
              }">
                {{ post.ACTIVO === 1 ? 'Activo' : 'Inactivo' }}
              </span>
            </td>
            <!-- Acciones de Edición y Eliminación -->
            <td class="py-3 text-right whitespace-nowrap">
              <div class="flex justify-end gap-2">
                <button v-if="post.total_encuestas > 0" @click="abrirModalInscritos(post)"
                  class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors"
                  title="Ver Alumnos Inscritos">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                  </svg>
                </button>
                <button @click="abrirModalEdicion(post)"
                  class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                  </svg>
                </button>
                <button v-if="post.ACTIVO === 1" @click="abrilModalPreguntas(post)"
                  class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors"
                  title="Gestionar Objetivos">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 3v18m9-9H3" />
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                  </svg>
                </button>
                <button @click="eliminar(post.ID, post.NOMBRE)" v-if="post.ACTIVO === 1"
                  class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                  </svg>
                </button>
                <button @click="habilitar(post.ID, post.NOMBRE)" v-if="post.ACTIVO === 0"
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
    <div v-if="mostrarModalInscritos" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 z-99999">
      <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col">
        <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-900">
          <div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ formularioSeleccionado?.NOMBRE }}</h3>
            <p class="text-sm text-gray-500 mt-1">Total de Personas Inscritas/Evaluadas: <span class="font-bold text-brand-600 px-2 py-0.5 bg-brand-50 rounded-md">{{ totalInscritos }}</span></p>
          </div>
          <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" @click="mostrarModalInscritos = false">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>

        <div class="p-6 overflow-y-auto flex-grow">
          <div v-if="cargandoInscritos" class="flex flex-col items-center justify-center py-12 gap-2">
            <span class="animate-spin h-8 w-8 border-4 border-brand-500 border-t-transparent rounded-full"></span>
            <p class="text-gray-500 text-sm">Cargando base de alumnos...</p>
          </div>
          <table v-else class="min-w-full">
            <thead>
              <tr class="border-b border-gray-100 dark:border-gray-800 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
                <th class="pb-3 px-4">Foto</th>
                <th class="pb-3 px-4">Cédula</th>
                <th class="pb-3 px-4">Nombres y Apellidos</th>
                <th class="pb-3 px-4">Carrera / Nivel</th>
                <th v-if="esEvaluacion" class="pb-3 px-4 text-center">Puntaje</th>
                <th class="pb-3 px-4 text-right">Detalles</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="alumno in listaInscritos" :key="alumno.CIInfPer" class="border-b border-gray-50 dark:border-gray-800/50 hover:bg-gray-50/50 dark:hover:bg-white/[0.01]">
                <td class="py-3 px-4">
                  <div class="w-10 h-10 rounded-full overflow-hidden border border-gray-200 bg-gray-100">
                    <img :src="getPhotoUrl(alumno.CIInfPer)" alt="Perfil" class="w-full h-full object-cover" />
                  </div>
                </td>
                <td class="py-3 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">{{ alumno.CIInfPer }}</td>
                <td class="py-3 px-4 text-sm font-bold text-gray-900 dark:text-white">{{ alumno.NombInfPer }} {{ alumno.ApellInfPer }} {{ alumno.ApellMatInfPer }}</td>
                <td class="py-3 px-4 text-xs text-gray-600 dark:text-gray-400">
                  <p class="font-medium">{{ alumno.NombCarr }}</p>
                  <p class="text-gray-400 mt-0.5">{{ alumno.nivel }}to Ciclo ({{ alumno.facultad_siglas }})</p>
                </td>
                
                <td v-if="esEvaluacion" class="py-3 px-4 text-center">
                  <div v-if="alumno.puntaje !== null" class="flex flex-col items-center gap-1">
                    <span class="text-lg font-black" :class="alumno.puntaje >= 7 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400'">{{ alumno.puntaje }}</span>
                    <span class="px-2 py-0.5 text-[10px] uppercase font-bold tracking-wider rounded-md" :class="alumno.puntaje >= 7 ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'">
                      {{ alumno.puntaje >= 7 ? 'Aprobado' : 'Reprobado' }}
                    </span>
                  </div>
                  <span v-else class="text-xs text-gray-400">N/A</span>
                </td>

                <td class="py-3 px-4 text-right">
                  <button @click="abrirDetalleRespuestas(alumno.CIInfPer)" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-brand-700 bg-brand-50 hover:bg-brand-100 transition-colors rounded-lg">
                    Ver {{ esEvaluacion ? 'respuestas' : 'detalles' }}
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div v-if="mostrarModalRespuestas" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 z-99999">
      <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col border border-gray-100 dark:border-gray-800">
        <div class="p-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/30 dark:bg-gray-800/30">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white">Hoja de {{ esEvaluacionDetalle ? 'Calificación' : 'Respuestas' }} Individual</h3>
          <button class="text-gray-400 hover:text-gray-600" @click="mostrarModalRespuestas = false">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>

        <div class="p-6 overflow-y-auto flex-grow" v-if="detalleAlumno">
          <div class="flex flex-col sm:flex-row gap-5 p-4 bg-gray-50 dark:bg-white/[0.02] rounded-xl border border-gray-100 dark:border-gray-800 mb-6 items-center">
            <div class="w-20 h-20 rounded-xl overflow-hidden border border-gray-200 bg-white shrink-0 mx-auto sm:mx-0">
              <img :src="getPhotoUrl(detalleAlumno.persona.CIInfPer)" alt="Perfil" class="w-full h-full object-cover" />
            </div>
            <div class="text-center sm:text-left flex-grow">
              <h4 class="text-base font-bold text-gray-900 dark:text-white">{{ detalleAlumno.persona.NombInfPer }} {{ detalleAlumno.persona.ApellInfPer }} {{ detalleAlumno.persona.ApellMatInfPer }}</h4>
              <p class="text-xs text-gray-500 mt-0.5">Cédula: {{ detalleAlumno.persona.CIInfPer }} | {{ detalleAlumno.persona.mailInst }}</p>
              <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1 border-t border-gray-200/60 dark:border-gray-700/50 pt-2 text-xs">
                <p class="text-gray-600 dark:text-gray-400"><b class="text-gray-800 dark:text-gray-200">Carrera:</b> {{ detalleAlumno.persona.NombCarr }}</p>
                <p class="text-gray-600 dark:text-gray-400"><b class="text-gray-800 dark:text-gray-200">Nivel:</b> {{ detalleAlumno.persona.nivel }}to Ciclo ({{ detalleAlumno.persona.facultad_siglas }})</p>
              </div>
            </div>

            <div v-if="esEvaluacionDetalle" class="shrink-0 text-center px-6 py-3 rounded-xl border-2 bg-white dark:bg-gray-800" :class="puntajeDetalle >= 7 ? 'border-emerald-200 dark:border-emerald-800' : 'border-red-200 dark:border-red-800'">
              <p class="text-[10px] font-bold uppercase tracking-wider mb-1 text-gray-400">Puntaje Total</p>
              <div class="text-3xl font-black" :class="puntajeDetalle >= 7 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400'">
                {{ puntajeDetalle }} <span class="text-lg text-gray-400 font-medium">/ {{ totalPreguntasDetalle }}</span>
              </div>
              <p class="text-[10px] font-bold uppercase tracking-wider mt-1" :class="puntajeDetalle >= 7 ? 'text-emerald-600' : 'text-red-600'">
                {{ puntajeDetalle >= 7 ? 'Aprobado' : 'Reprobado' }}
              </p>
            </div>
          </div>

          <div class="space-y-4">
            <div v-for="(item, index) in detalleAlumno.respuestas" :key="index" 
                 class="p-4 rounded-xl border"
                 :class="esEvaluacionDetalle ? (item.valor == 1 ? 'bg-emerald-50/30 border-emerald-100 dark:bg-emerald-900/10 dark:border-emerald-900/40' : 'bg-red-50/30 border-red-100 dark:bg-red-900/10 dark:border-red-900/40') : 'border-gray-100 dark:border-gray-800 bg-white dark:bg-transparent'">
              
              <div class="flex justify-between items-start gap-4 mb-2">
                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ index + 1 }}. {{ item.PREGUNTA }}</p>
                <div v-if="esEvaluacionDetalle" class="shrink-0 mt-0.5">
                  <svg v-if="item.valor == 1" class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  <svg v-else class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
              </div>
              
              <div class="mt-3 text-sm px-3 py-2 rounded-lg flex items-center gap-2 border" 
                   :class="esEvaluacionDetalle ? 'bg-white dark:bg-gray-900 border-gray-100 dark:border-gray-800' : 'bg-gray-50 dark:bg-white/[0.01] border-dashed border-gray-200 dark:border-gray-800'">
                <span class="font-bold text-gray-400">Respuesta:</span>
                <span class="font-medium break-words" :class="esEvaluacionDetalle ? (item.valor == 1 ? 'text-emerald-700 dark:text-emerald-400' : 'text-red-700 dark:text-red-400') : 'text-gray-900 dark:text-white'" 
                      v-html="renderizarTextoConEnlaces(item.opcion_seleccionada || item.textorespuesta || 'Sin respuesta registrada')"></span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div v-if="isPreguntasModalOpen"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 z-99999">

      <div
        class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">

        <div
          class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-white/[0.02]">
          <div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Preguntas y Opciones de respuesta del Formulario
            </h3>
            <p class="text-sm text-success-600 font-medium">{{ selectedFormulario?.NOMBRE }}</p>
          </div>

          <button @click="cerrarModalPreguntas" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 6L6 18M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-100 dark:bg-blue-500/10 dark:border-blue-500/20">
          <div class="flex gap-3">
            <svg class="text-blue-600 dark:text-blue-400 shrink-0" width="20" height="20" viewBox="0 0 24 24"
              fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10" />
              <line x1="12" y1="16" x2="12" y2="12" />
              <line x1="12" y1="8" x2="12.01" y2="8" />
            </svg>
            <p class="text-xs text-blue-800 dark:text-blue-300 leading-relaxed">
              <strong>Nota importante:</strong> Las preguntas y opciones de respuesta que añada aquí deben ser
              únicamente las que se encuentran
              registradas en el formulario seleccionado.
            </p>
          </div>
        </div>

        <div class="flex-1 overflow-y-auto p-6 grid grid-cols-1 md:grid-cols-12 gap-8">

          <div class="md:col-span-4 border-r border-gray-100 dark:border-gray-800 pr-0 md:pr-8">

            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 uppercase tracking-wider">
              {{ isEditingPregunta ? 'Editar Pregunta' : 'Nueva Pregunta' }}
            </h4>
            <div class="space-y-4">
              <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Pregunta</label>
                <textarea v-model="PreguntasForm.PREGUNTA" rows="4"
                  class="w-full px-4 py-2 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 outline-none"
                  placeholder="Escriba la pregunta..."></textarea>
              </div>
              <div class="relative">
                <select v-model="PreguntasForm.tipo"
                  class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:text-white/90 truncate pr-10 cursor-pointer hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                  <option value="" selected>Seleccione...</option>
                  <option value="Abierta">Abierta</option>
                  <option value="Selección Única">Selección Única</option>
                  <option value="Selección Múltiple">Selección Múltiple</option>
                </select>

                <span
                  class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500 dark:text-gray-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4">
                    </path>
                  </svg>
                </span>
              </div>
              <div class="flex gap-2">
                <button @click="guardarPreguntas"
                  class="flex-1 btn-primary text-white font-bold py-2 rounded-lg transition-colors">
                  {{ isEditingPregunta ? 'Actualizar' : 'Guardar' }}
                </button>
                <button v-if="isEditingPregunta" @click="cancelarEdicionPreguntas"
                  class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg">
                  ✕
                </button>
              </div>
            </div>
          </div>
          <div class="md:col-span-8 flex flex-col min-h-0">
            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 uppercase tracking-wider">
              Registrados
            </h4>
            <div class="overflow-y-auto border rounded-xl dark:border-gray-800 custom-scrollbar"
              style="max-height: 400px;">
              <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-800/50 sticky top-0 z-10">
                  <tr>
                    <th
                      class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider bg-gray-50 dark:bg-gray-800">
                      Pregunta/Tipo
                    </th>
                    <th
                      class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-50 dark:bg-gray-800">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-transparent">
                  <tr v-for="sub in ListaPreguntas" :key="sub.ID"
                    class="hover:bg-gray-50 dark:hover:bg-white/[0.02] transition-colors">
                    <td class="px-4 py-3">
                      <p class="text-xs font-semibold text-purple-600 mb-1">{{ sub.PREGUNTA }}</p>
                      <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Tipo: {{ sub.tipo }}</p>
                      <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Total Opciones: {{
                        sub.seguitiporespuesta_count }}</p>
                    </td>
                    <td class="px-4 py-3 text-right space-x-2 whitespace-nowrap">
                      <button v-if="sub.tipo !== 'Abierta'" @click="abrirModalOpciones(sub)"
                        class="text-emerald-600 hover:text-emerald-800 font-medium text-xs transition-colors bg-emerald-50 dark:bg-emerald-500/10 px-2 py-1 rounded">
                        + Opciones
                      </button>
                      <button @click="preparaEdicionPreguntas(sub)"
                        class="text-blue-600 hover:text-blue-800 font-medium text-xs transition-colors">Editar</button>
                      <button @click="eliminarPreguntas(sub.ID)"
                        class="text-red-600 hover:text-red-800 font-medium text-xs transition-colors">Eliminar</button>
                    </td>
                  </tr>

                  <tr v-if="ListaPreguntas.length === 0">
                    <td colspan="2" class="px-4 py-12 text-center text-gray-400 text-sm italic">
                      No hay preguntas registradas
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="isOpcionesModalOpen"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 z-99999">

      <div
        class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[85vh] overflow-hidden flex flex-col">
        <div
          class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-white/[0.02]">
          <div>
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Opciones de Respuesta</h3>
            <p class="text-xs text-purple-600 font-semibold mt-0.5">Pregunta: "{{ selectedPregunta?.PREGUNTA }}"</p>
          </div>
          <button @click="cerrarModalOpciones" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 6L6 18M6 6l12 12" />
            </svg>
          </button>
        </div>

        <div class="flex-1 overflow-y-auto p-6 grid grid-cols-1 md:grid-cols-12 gap-6">
          <div class="md:col-span-4 border-r border-gray-100 dark:border-gray-800 pr-0 md:pr-6">
            <h4 class="text-xs font-bold text-gray-700 dark:text-gray-300 mb-4 uppercase tracking-wider">
              {{ isEditingOpcion ? 'Editar Opción' : 'Nueva Opción' }}
            </h4>
            <div class="space-y-4">
              <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Texto de Opción</label>
                <textarea v-model="OpcionesForm.TIPORESPUESTA" rows="4"
                  class="w-full px-4 py-2 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 outline-none"
                  placeholder="Ej: Excelente, Sí, No..."></textarea>
              </div>
              <div>
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Valor / Peso Numérico</label>
                <input type="number" v-model="OpcionesForm.valor" min="0" step="0.01"
                  class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white outline-none"
                  placeholder="Ej: 1.00 ó 0" />
              </div>
              <div class="flex gap-2 pt-2">
                <button @click="guardarOpciones"
                  class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 rounded-lg text-sm transition-colors">
                  {{ isEditingOpcion ? 'Actualizar' : 'Guardar' }}
                </button>
                <button v-if="isEditingOpcion" @click="cancelarEdicionOpciones"
                  class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm">✕</button>
              </div>
            </div>
          </div>

          <div class="md:col-span-8 flex flex-col min-h-0">
            <h4 class="text-xs font-bold text-gray-700 dark:text-gray-300 mb-4 uppercase tracking-wider">Opciones
              Agregadas</h4>
            <div class="overflow-y-auto border rounded-xl dark:border-gray-800 custom-scrollbar"
              style="max-height: 320px;">
              <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-800/50 sticky top-0 z-10">
                  <tr>
                    <th
                      class="px-4 py-2.5 text-left text-xs font-bold text-gray-500 uppercase bg-gray-50 dark:bg-gray-800">
                      Descripción Opción</th>
                    <th
                      class="px-4 py-2.5 text-center text-xs font-bold text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 w-24">
                      Valor</th>
                    <th
                      class="px-4 py-2.5 text-right text-xs font-medium text-gray-500 uppercase bg-gray-50 dark:bg-gray-800 w-32">
                      Acciones</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 bg-white dark:bg-transparent">
                  <tr v-for="opc in ListaOpciones" :key="opc.ID"
                    class="hover:bg-gray-50 dark:hover:bg-white/[0.02] transition-colors">
                    <td class="px-4 py-2.5 text-xs font-medium text-gray-800 dark:text-gray-200">{{ opc.TIPORESPUESTA }}
                    </td>
                    <td class="px-4 py-2.5 text-center text-xs text-gray-600 dark:text-gray-400 font-bold">
                      {{ opc.valor !== null ? opc.valor : '-' }}
                    </td>
                    <td class="px-4 py-2.5 text-right space-x-2 whitespace-nowrap">
                      <button @click="preparaEdicionOpciones(opc)"
                        class="text-blue-600 hover:text-blue-800 text-xs font-medium">Editar</button>
                      <button @click="eliminarOpciones(opc.ID)"
                        class="text-red-600 hover:text-red-800 text-xs font-medium">Eliminar</button>
                    </td>
                  </tr>
                  <tr v-if="ListaOpciones.length === 0">
                    <td colspan="3" class="px-4 py-8 text-center text-gray-400 text-xs italic">No hay opciones para esta
                      pregunta</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
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
              Crear Formulario
            </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
              Llene todos los campos para crear un nuevo formulario.
            </p>
          </div>
          <form class="flex flex-col">
            <div class="px-2 overflow-y-auto custom-scrollbar">
              <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                <div class="lg:col-span-3">
                  <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nombre del Formulario
                  </label>
                  <input type="text" v-model="objetoguardar.NOMBRE"
                    placeholder="Ej: Formulario de Inscripción a Ayudantes de Cátedra IS-2026"
                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:text-white/90" />
                  <p class="mt-1.5 text-xs text-gray-500">Use un nombre descriptivo y el periodo actual.</p>
                </div>

              </div>
              <div class="mt-5">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 whitespace-nowrap">
                  Tipo de Formulario
                </label>

                <div class="relative">
                  <select v-model="objetoguardar.tipoencuesta"
                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:text-white/90 truncate pr-10 cursor-pointer hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                    <option value="" selected>Seleccione...</option>
                    <option value="Inscripción a Ayudantes de Cátedra">Inscripción a Ayudantes de Cátedra</option>
                    <option value="Examen de Admisión a Ayudantes de Cátedra">Examen de Admisión a Ayudantes de Cátedra
                    </option>
                  </select>

                  <span
                    class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500 dark:text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                    </svg>
                  </span>
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
                Crear Formulario
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
              Editar Formulario
            </h4>
            <p class="mb-6 text-sm text-gray-500 dark:text-gray-400 lg:mb-7">
              Los datos mostrados son los actuales del Formulario. Realice los cambios necesarios y guarde.
            </p>
          </div>
          <form class="flex flex-col">
            <div class="px-2 overflow-y-auto custom-scrollbar">
              <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <div class="lg:col-span-3">
                  <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nombre del Formulario
                  </label>
                  <input type="text" v-model="objetoeditar.NOMBRE"
                    placeholder="Ej: Formulario de Inscripción a Ayudantes de Cátedra IS-2026"
                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:text-white/90" />
                  <p class="mt-1.5 text-xs text-gray-500">Use un nombre descriptivo y el periodo actual.</p>
                </div>
              </div>
              <div class="mt-5">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Tipo de
                  Formulario</label>
                <div class="relative">
                  <select v-model="objetoeditar.tipoencuesta"
                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:text-white/90 truncate pr-10 cursor-pointer hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                    <option value="" selected>Seleccione...</option>
                    <option value="Inscripción a Ayudantes de Cátedra">Inscripción a Ayudantes de Cátedra</option>
                    <option value="Examen de Admisión a Ayudantes de Cátedra">Examen de Admisión a Ayudantes de Cátedra
                    </option>
                  </select>
                  <span
                    class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500 dark:text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                    </svg>
                  </span>
                </div>
              </div>
              <div class="mt-5">
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Estado del
                  Formulario</label>
                <div class="relative">
                  <select v-model="objetoeditar.ACTIVO"
                    class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:text-white/90 truncate pr-10 cursor-pointer hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                    <option value="" selected>Seleccione...</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>

                  <span
                    class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500 dark:text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                    </svg>
                  </span>
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
      objetoguardar: {
        NOMBRE: "",
        tipoencuesta: "",
      },
      objetoeditar: {
        ID: 0,
        NOMBRE: "",
        tipoencuesta: "",
        ACTIVO: 0,
      },
      filteredarray: [],
      searchQuery: "",
      selectedStatus: "", // Nuevo: estado seleccionado
      isFilterDropdownOpen: false, // Nuevo: control del menu
      isProfileAddressModal: false,
      cargando: false,
      currentPage: 1,
      lastPage: 1,
      buscando: false, // Mantenido, pero no se usa en la lógica de paginación actual
      debouncedFilter: null,
      isPreguntasModalOpen: false,
      selectedFormulario: null,
      ListaPreguntas: [],
      isEditingPregunta: false,
      PreguntasForm: {
        ID: null,
        IDFORMULARIO: null,
        PREGUNTA: '',
        tipo: '',
      },
      isOpcionesModalOpen: false,
      selectedPregunta: null,
      ListaOpciones: [],
      isEditingOpcion: false,
      OpcionesForm: {
        ID: null,
        IDPREGUNTA: null,
        TIPORESPUESTA: '',
        valor: null
      },
      mostrarModalInscritos: false,
      mostrarModalRespuestas: false,
      cargandoInscritos: false,
      totalInscritos: 0,
      listaInscritos: [],
      formularioSeleccionado: null,
      detalleAlumno: null,
      esEvaluacion: false,
      esEvaluacionDetalle: false,
      puntajeDetalle: 0,
      totalPreguntasDetalle: 0
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
      return (
        this.objetoguardar.NOMBRE.trim() !== '' &&// <--- Validación aquí
        this.objetoguardar.tipoencuesta !== null // Si es obligatorio
      );
    },
    formIsValidEdit() {
      return (
        this.objetoeditar.NOMBRE.trim() !== '' &&
        this.objetoeditar.tipoencuesta !== null // Si es obligatorio
      );
    },
  },
  methods: {
    getPhotoUrl(ci) {
      return `${API.defaults.baseURL}/vin/getFoto/${ci}`;
    },
    async cerrarModalPreguntas() {
      this.isPreguntasModalOpen = false;
      this.selectedFormulario = null;
      this.PreguntasForm.IDFORMULARIO = null;
      await this.GetData(1, this.searchQuery);
    },
    async cerrarModalOpciones() {
      this.isOpcionesModalOpen = false;
      this.selectedPregunta = null;
      this.OpcionesForm.IDPREGUNTA = null;
      await this.gtePreguntas();
    },
    async abrilModalPreguntas(obj) {
      this.selectedFormulario = obj;
      this.PreguntasForm.IDFORMULARIO = obj.ID;
      this.cancelarEdicionPreguntas(); // Limpia el form
      await this.gtePreguntas();
      this.isPreguntasModalOpen = true;
    },
    async abrirModalOpciones(preguntaObj) {
      this.selectedPregunta = preguntaObj;
      this.OpcionesForm.IDPREGUNTA = preguntaObj.ID;
      this.cancelarEdicionOpciones();
      await this.getOpciones();
      this.isOpcionesModalOpen = true;
    },
    async abrirModalInscritos(formulario) {
      this.formularioSeleccionado = formulario;
      this.mostrarModalInscritos = true;
      this.cargandoInscritos = true;
      try {
        const response = await API.get(`${this.baseUrl}/getEstudiantesInscritos/${formulario.ID}`);
        this.listaInscritos = response.data.estudiantes;
        this.totalInscritos = response.data.total;
        this.esEvaluacion = response.data.esEvaluacion;
      } catch (error) {
        console.error("Error cargando alumnos inscritos", error);
      } finally {
        this.cargandoInscritos = false;
      }
    },
    async abrirDetalleRespuestas(cedula) {
      try {
        const response = await API.get(`${this.baseUrl}/getDetalleRespuestasEstudiante/${this.formularioSeleccionado.ID}/${cedula}`);
        this.detalleAlumno = response.data;
        // 1. Verificar de forma dinámica si esta tabla de respuestas contiene puntajes ("valor" !== null)
        this.esEvaluacionDetalle = this.detalleAlumno.respuestas.some(item => item.valor !== null);
        
        // 2. Si es una evaluación, calculamos el puntaje sobre 10
        if (this.esEvaluacionDetalle) {
          this.totalPreguntasDetalle = this.detalleAlumno.respuestas.length;
          
          // Uso del reducer para sumar dinámicamente +1 por cada item con valor 1 (Correcto)
          this.puntajeDetalle = this.detalleAlumno.respuestas.reduce((total, item) => {
            return total + (item.valor !== null && parseInt(item.valor) === 1 ? 1 : 0);
          }, 0);
        }
        this.mostrarModalRespuestas = true;
      } catch (error) {
        console.error("Error al recuperar respuestas del estudiante", error);
      }
    },
    renderizarTextoConEnlaces(texto) {
      if (!texto) return '';
      // Expresión regular para identificar URLs de forma segura (http, https y www)
      const regexUrl = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
      
      return texto.replace(regexUrl, function(url) {
        return `<a href="${url}" target="_blank" rel="noopener noreferrer" class="text-brand-600 hover:text-brand-700 underline font-semibold inline-flex items-center gap-0.5">${url} <svg class="w-3 h-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg></a>`;
      });
    },

    async getOpciones() {
      try {
        const resp = await API.get(`${this.baseUrl}/seguitiporespuesta?idPregunta=${this.selectedPregunta.ID}&all=true`);
        this.ListaOpciones = resp.data.data || [];
      } catch (error) {
        console.error("Error al obtener opciones:", error);
      }
    },
    async guardarOpciones() {
      if (!this.OpcionesForm.TIPORESPUESTA) {
        mostraralertas2("El campo Texto de Opción es obligatorio", "warning");
        return;
      }

      try {
        const metodo = this.isEditingOpcion ? 'PUT' : 'POST';
        const url = this.isEditingOpcion
          ? `${this.baseUrl}/seguitiporespuesta/${this.OpcionesForm.ID}`
          : `${this.baseUrl}/seguitiporespuesta`;

        const exito = await enviarsolig(metodo, this.OpcionesForm, url, 'Opción guardada con éxito');
        if (exito) {
          this.cancelarEdicionOpciones();
          this.getOpciones();
        }
      } catch (error) {
        console.error("Error al guardar opciones de respuesta:", error);
      }
    },

    preparaEdicionOpciones(opcObj) {
      this.isEditingOpcion = true;
      this.OpcionesForm.ID = opcObj.ID;
      this.OpcionesForm.IDPREGUNTA = opcObj.IDPREGUNTA;
      this.OpcionesForm.TIPORESPUESTA = opcObj.TIPORESPUESTA;
      this.OpcionesForm.valor = opcObj.valor;
    },

    cancelarEdicionOpciones() {
      this.isEditingOpcion = false;
      this.OpcionesForm.ID = null;
      this.OpcionesForm.TIPORESPUESTA = '';
      this.OpcionesForm.valor = null;
    },

    async eliminarOpciones(id) {
      const response = await elimnarpermanente(
        `${this.baseUrl}/seguitiporespuesta/`,
        id,
        'Eliminar Opción',
        '¿Realmente desea eliminar esta opción de respuesta?'
      );
      if (response && response.status === 200) {
        this.ListaOpciones = this.ListaOpciones.filter(opc => opc.ID !== id);
      }
    },

    async gtePreguntas() {
      try {
        const resp = await API.get(`${this.baseUrl}/seguipreguntas?idFormulario=${this.selectedFormulario.ID}&all=true`);
        this.ListaPreguntas = resp.data.data || [];
      } catch (error) {
        console.error("Error al obtener preguntas:", error);
      }
    },

    async guardarPreguntas() {
      if (!this.PreguntasForm.PREGUNTA || !this.PreguntasForm.tipo) {
        mostraralertas2("Todos lo campos son obligatorios", "warning");
        return;
      }

      try {

        const metodo = this.isEditingPregunta ? 'PUT' : 'POST';
        const url = this.isEditingPregunta
          ? `${this.baseUrl}/seguipreguntas/${this.PreguntasForm.ID}`
          : `${this.baseUrl}/seguipreguntas`;

        const exito = await enviarsolig(metodo, this.PreguntasForm, url, 'Operación exitosa');
        if (exito) {
          this.cancelarEdicionPreguntas();
          this.gtePreguntas();
        }
      } catch (error) {
        console.error("Error al guardar preguntas:", error);
      }
    },

    preparaEdicionPreguntas(obj) {
      this.isEditingPregunta = true;
      this.PreguntasForm.ID = obj.ID;
      this.PreguntasForm.PREGUNTA = obj.PREGUNTA;
      this.PreguntasForm.tipo = obj.tipo;
    },

    cancelarEdicionPreguntas() {
      this.isEditingPregunta = false;
      this.PreguntasForm.ID = null;
      this.PreguntasForm.PREGUNTA = '';
      this.PreguntasForm.tipo = '';

    },

    async eliminarPreguntas(id) {
      const response = await elimnarpermanente(
        `${this.baseUrl}/seguipreguntas/`,
        id,
        'Eliminar Pregunta',
        '¿Realmente desea eliminar la pregunta?'
      );
      if (response && response.status === 200) {
        this.ListaPreguntas = this.ListaPreguntas.filter(sub => sub.ID !== id);
      }
    },
    abrirModalEdicion(user) {
      // Clonamos el objeto para no modificar la tabla directamente antes de guardar
      this.objetoeditar = {
        ID: user.ID,
        NOMBRE: user.NOMBRE,
        tipoencuesta: user.tipoencuesta,
        ACTIVO: user.ACTIVO
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
        const response = await API.get(`${this.baseUrl}/seguiformulario`, { params });
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
          NOMBRE: this.objetoguardar.NOMBRE,
          tipoencuesta: this.objetoguardar.tipoencuesta,
        };
        const exito = await enviarsolig('POST', params, `${this.baseUrl}/seguiformulario`, 'Formulario creado con éxito');
        if (exito) {
          this.$.setupState.isProfileAddressModal = false;

          this.limpiarFormulario();
          this.actualizar();
        } else {
          mostraralertas2("No se pudo registrar el Formulario", "error");
        }
      } catch (error) {
        console.error("❌ Error al registrar Formulario:", error.response?.data || error);
      }
    },
    async Update() {
      try {
        const params = {
          NOMBRE: this.objetoeditar.NOMBRE,
          tipoencuesta: this.objetoeditar.tipoencuesta,
          ACTIVO: this.objetoeditar.ACTIVO
        };
        const exito = await enviarsolig('PUT', params, `${this.baseUrl}/seguiformulario/${this.objetoeditar.ID}`, 'Formulario actualizado con éxito');
        if (exito) {
          this.$.setupState.isEditModalOpen = false;

          this.limpiarFormulario();
          this.actualizar();
        } else {
          this.$.setupState.isEditModalOpen = false;
          mostraralertas2("No se pudo editar el Formulario", "error");
        }
      } catch (error) {
        console.error("❌ Error al registrar Formulario:", error.response?.data || error);
      }
    },
    limpiarFormulario() {
      this.objetoguardar = {
        NOMBRE: "",
        tipoencuesta: ""
      };
      this.objetoeditar = {
        ID: 0,
        NOMBRE: "",
        tipoencuesta: "",
        ACTIVO: 0
      };
    },
    eliminar(id, nombre) {
      try {
        eliminacion(
          `${this.baseUrl}/inhabilitar_formulario/`,
          id,
          'Deshabilitar registro',
          '¿Realmente desea deshabilitar el Formulario  ' + nombre + '?',
          this.actualizar   // 👈 callback para refrescar la tabla al confirmar
        );
      } catch (error) {
        console.error("Error al eliminar el Formulario:", error);
        this.cargando = false;
      }
    },
    async habilitar(id, nombre) {
      try {
        // No hace falta poner this.cargando = true aquí si confimarhabi maneja la alerta,
        // pero si lo haces, asegúrate de cerrarlo.
        await confimarhabi(
          `${this.baseUrl}/habilitar_formulario/`,
          id,
          'Habilitar registro',
          `¿Desea habilitar el Formulario "${nombre}"?`,
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
