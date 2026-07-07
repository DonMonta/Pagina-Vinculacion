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
                        <input type="text" placeholder="Ingresa el código del proyecto a buscar..."
                            v-model="searchQuery" @input="debouncedFilter"
                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-200 bg-transparent py-2.5 pl-12 pr-14 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 xl:w-[430px]" />
                    </div>
                </form>
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
                            <div class="flex justify-end gap-2">
                                <button @click="abrirEdicion(post.proyect_id)"
                                    class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors"
                                    title="Editar Proyecto">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </button>
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
                            </div>
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
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden flex flex-col">

                <div
                    class="p-6 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50">
                    <div class="max-w-[80%]">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white truncate">{{
                            proyectoSeleccionado.proyect_nombre }}</h2>
                        <p class="text-sm text-gray-500 italic">Título: {{ proyectoSeleccionado.proyect_titulo }}</p>
                    </div>
                    <button @click="cerraModal" class="p-2 hover:bg-gray-100 rounded-full transition-colors">✕</button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl bg-brand-50 border border-brand-100 dark:bg-brand-500/5">
                            <h4 class="text-[10px] font-bold uppercase text-brand-600 mb-1">Facultad Prioritaria</h4>
                            <p class="text-sm font-bold text-gray-800 dark:text-white">{{
                                proyectoSeleccionado.facultades_priori?.siglas }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 dark:bg-gray-800">
                            <h4 class="text-[10px] font-bold uppercase text-gray-500 mb-1">Participantes</h4>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="fac in proyectoSeleccionado.facultades" :key="fac.idfacultad"
                                    class="px-2 py-0.5 bg-white dark:bg-gray-700 border rounded text-[11px] font-medium">
                                    {{ fac.siglas }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div v-if="integranteEdit || modoNuevo"
                        class="p-6 border-2 border-blue-100 rounded-2xl bg-blue-50/20 animate-fadeIn">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="font-bold text-blue-800">
                                {{ modoNuevo ? 'Añadir Nuevo Integrante' : `Editando ${integranteEdit.funcion}:
                                ${integranteEdit.nombre} ${integranteEdit.apellido} ${integranteEdit.apellidomaterno}`
                                }}
                            </h4>
                            <button @click="cancelarEdicion"
                                class="text-xs text-red-500 font-bold hover:underline">Cancelar</button>
                        </div>
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="flex flex-col items-center space-y-2">
                                <div
                                    class="w-32 h-32 rounded-xl border-2 border-dashed border-blue-200 bg-white dark:bg-gray-800 flex items-center justify-center overflow-hidden shadow-sm">

                                    <template v-if="nuevoIntegranteData || integranteEdit">
                                        <img :src="getPhotoUrl(nuevoIntegranteData?.cedula || integranteEdit?.cedula)"
                                            class="w-full h-full object-cover animate-fadeIn" alt="Foto de perfil" />
                                    </template>

                                    <template v-else>
                                        <span class="text-[10px] text-gray-400 text-center px-2">
                                            Esperando integrante...
                                        </span>
                                    </template>

                                </div>
                                <p class="text-[10px] font-bold text-blue-500 uppercase">Perfil</p>
                            </div>
                            <div class="flex-1">
                                <div v-if="modoNuevo || (formInt.reemplazado == 1)"
                                    class="mb-6 flex gap-3 p-4 bg-white dark:bg-gray-800 rounded-xl border border-blue-100 shadow-sm">
                                    <div class="flex-1">
                                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Buscar
                                            por
                                            Cédula</label>
                                        <input type="text" v-model="cedulaBusqueda" placeholder="Ej: 08xxxxxxx"
                                            class="w-full border rounded-lg p-2 text-sm focus:ring-2 ring-blue-200 outline-none">
                                    </div>
                                    <button @click="buscarNuevoIntegrante"
                                        class="mt-5 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold">
                                        Verificar
                                    </button>
                                </div>
                                <div v-if="!modoNuevo || (modoNuevo && nuevoIntegranteData)"
                                    class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div v-if="nuevoIntegranteData"
                                        class="md:col-span-3 p-3 bg-green-50 border border-green-100 rounded-lg text-sm text-green-700">
                                        Confirmado: <b>{{ nuevoIntegranteData.nombre_completo }}</b> ({{
                                            nuevoIntegranteData.tipo == 'doc' ? 'Docente' : 'Estudiante' }})
                                    </div>

                                    <div class="relative">
                                        <label class="block text-[10px] font-bold mb-1">Función</label>
                                        <select v-model="formInt.id_funcion" @change="calcularHoras"
                                            class="w-full border rounded-lg p-2 text-sm bg-white dark:bg-gray-800 max-w-full overflow-hidden truncate">
                                            <option :value="null">Seleccione Función</option>
                                            <option v-for="f in funciones" :key="f.id_funcion" :value="f.id_funcion">{{
                                                f.nombre_funcion }}</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-bold mb-1">Horas (Automático)</label>
                                        <input type="number" v-model="formInt.horas" disabled
                                            class="w-full border rounded-lg p-2 text-sm bg-gray-100 dark:bg-gray-700 cursor-not-allowed font-bold text-blue-600">
                                    </div>

                                    <div class="relative">
                                        <label class="block text-[10px] font-bold mb-1">Carrera</label>
                                        <select v-model="formInt.idCarr"
                                            class="w-full border rounded-lg p-2 text-sm bg-white dark:bg-gray-800 max-w-full overflow-hidden truncate">
                                            <option v-for="c in carreras" :key="c.idCarr" :value="c.idCarr">{{
                                                c.NombCarr }}
                                            </option>
                                        </select>
                                    </div>

                                    <div v-if="formInt.reemplazado == 1 || modoNuevo" class="md:col-span-2">
                                        <label class="block text-[10px] font-bold mb-1">Documento Respaldo (PDF)</label>
                                        <div @click="$refs.fileFoto.click()"
                                            class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer transition-all"
                                            :class="archivoPreviewName ? 'border-brand-500 bg-brand-50/20' : 'border-gray-300 hover:border-brand-400 bg-gray-50 dark:bg-gray-800/50'">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg v-if="!archivoPreviewName" class="w-8 h-8 mb-3 text-gray-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <svg v-else class="w-8 h-8 mb-3 text-brand-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                                                    <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                                                </svg>

                                                <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="font-semibold" v-if="!archivoPreviewName">Haga clic
                                                        para
                                                        cargar</span>
                                                    <span class="font-semibold text-brand-600" v-else>{{
                                                        archivoPreviewName
                                                        }}</span>
                                                </p>
                                                <p class="text-xs text-gray-400" v-if="!archivoPreviewName">PDF (Máx.
                                                    10MB)</p>
                                            </div>

                                            <input type="file" ref="fileFoto" class="hidden" accept="application/pdf"
                                                @change="handleFileChange" />
                                        </div>
                                    </div>

                                    <div v-if="!modoNuevo" class="flex items-center pt-4">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" v-model="formInt.reemplazado" :true-value="1"
                                                :false-value="0">
                                            <span class="text-sm font-bold text-red-600">Reemplazar Integrante</span>
                                        </label>
                                    </div>
                                    <div v-if="!modoNuevo && formInt.reemplazado == 1" class="md:col-span-3 space-y-4">

                                        <div class="flex items-center p-3 bg-blue-50 rounded-xl border border-blue-100">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" v-model="continuarEnProyecto" :true-value="true"
                                                    :false-value="false" class="w-4 h-4 text-blue-600 rounded">
                                                <span class="text-sm font-bold text-gray-700">
                                                    ¿El integrante al que estás reemplazando seguirá en el proyecto?
                                                </span>
                                            </label>
                                        </div>

                                        <div v-if="continuarEnProyecto"
                                            class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 border rounded-xl bg-gray-50 animate-fadeIn">
                                            <div>
                                                <label
                                                    class="block text-[10px] font-bold mb-1 uppercase text-blue-600">Nueva
                                                    Función para el integrante saliente</label>
                                                <select v-model="formInt.id_funcion_reemplazado"
                                                    @change="calcularHorasReemplazo"
                                                    class="w-full border rounded-lg p-2 text-sm bg-white">
                                                    <option :value="null">Seleccione nueva función</option>
                                                    <option v-for="f in funcionesFiltradasSinDireccion"
                                                        :key="f.id_funcion" :value="f.id_funcion">
                                                        {{ f.nombre_funcion }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-[10px] font-bold mb-1 uppercase text-blue-600">Nuevas
                                                    Horas</label>
                                                <input type="number" v-model="formInt.horas_reemplazado" disabled
                                                    class="w-full border rounded-lg p-2 text-sm">
                                            </div>
                                            <div class="md:col-span-2">
                                                <label
                                                    class="block text-[10px] font-bold mb-1 uppercase text-blue-600">Nueva
                                                    Carrera (Opcional)</label>
                                                <select v-model="formInt.idCarr_reemplazado"
                                                    class="w-full border rounded-lg p-2 text-sm bg-white">
                                                    <option v-for="c in carreras" :key="c.idCarr" :value="c.idCarr">{{
                                                        c.NombCarr }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-end gap-3">
                                    <button @click="guardarCambios" :disabled="enviando"
                                        class="bg-blue-700 text-white px-8 py-2 rounded-xl font-bold text-sm shadow-lg shadow-blue-100 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2">
                                        <span v-if="enviando">
                                            Procesando...
                                        </span>
                                        <span v-else>
                                            {{ modoNuevo ? 'Registrar Integrante' : 'Guardar Cambios' }}
                                        </span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-4">
                            <h3 class="font-bold text-gray-800 dark:text-white flex items-center gap-2">
                                Integrantes Activos
                                <span class="bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full text-xs">{{
                                    integrantesFiltrados.length }}</span>
                            </h3>
                            <div class="flex gap-2 w-full sm:w-auto">
                                <input type="text" v-model="filtroIntegrante" placeholder="Filtrar cédula..."
                                    class="text-xs border rounded-xl px-4 py-2 flex-1 outline-none focus:border-blue-400">
                                <button @click="activarModoNuevo"
                                    class="bg-green-600 text-white px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap">
                                    + Añadir
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-gray-50 dark:bg-gray-800 text-[11px] uppercase text-gray-400">
                                    <tr>
                                        <th class="p-3 text-left">Cédula</th>
                                        <th class="p-3 text-left">Integrante</th>
                                        <th class="p-3 text-center">Horas</th>
                                        <th class="p-3 text-center">Reemplazado</th>
                                        <th class="p-3 text-left">Función / Carrera</th>
                                        <th class="p-3 text-left">Registro / Act.</th>
                                        <th class="p-3 text-center">Anexo Reemplazo</th>
                                        <th class="p-3 text-center">Anexo Original</th>
                                        <th class="p-3 text-center">Estado</th>
                                        <th class="p-3 text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm divide-y divide-gray-100 dark:divide-gray-800">
                                    <tr v-for="int in integrantesFiltrados" :key="int.id_deta_invi_proyect"
                                        class="hover:bg-gray-50/50 transition-colors">

                                        <td class="p-3 font-mono text-xs text-gray-500">
                                            {{ int.ciinfper_doc || int.ciinfper_est }}
                                        </td>

                                        <td class="p-3">
                                            <p class="font-bold text-gray-700 dark:text-gray-200">
                                                {{ (int.informacion_personal_d || int.informacionpersonal)?.NombInfPer
                                                }}
                                                {{ (int.informacion_personal_d || int.informacionpersonal)?.ApellInfPer
                                                }}
                                            </p>
                                        </td>

                                        <td class="p-3 text-center font-bold text-blue-600">
                                            {{ int.horas }}h
                                        </td>

                                        <td class="p-3 text-center">
                                            <span
                                                :class="int.reemplazado ? 'text-red-500 bg-red-50' : 'text-green-600 bg-green-50'"
                                                class="px-2 py-1 rounded-full text-[10px] font-bold uppercase">
                                                {{ int.reemplazado ? 'Si' : 'No' }}
                                            </span>
                                        </td>

                                        <td class="p-3">
                                            <p class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                                {{ int.funciones?.nombre_funcion || '---' }}
                                            </p>
                                            <p class="text-[10px] text-gray-400 truncate max-w-[150px]">
                                                {{ int.carreras?.NombCarr }}
                                            </p>
                                        </td>

                                        <td class="p-3 whitespace-nowrap">
                                            <div class="flex flex-col gap-1">
                                                <div class="flex items-center gap-1 text-[10px] text-gray-500">
                                                    <span class="font-bold text-blue-500">CRE:</span>
                                                    {{ formatDate(int.created_at) }}
                                                </div>
                                                <div class="flex items-center gap-1 text-[10px] text-gray-400">
                                                    <span class="font-bold text-orange-400">ACT:</span>
                                                    {{ formatDate(int.updated_at) }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="p-3 text-center" v-if="int.estado === 0">
                                            <div v-if="int.anexo_integrante" class="flex justify-center">
                                                <a :href="`http://vinculacion.test/Documentos/Vinculación/Bajas_Docentes/Anexo/${int.ciinfper_doc || int.ciinfper_est}/${int.anexo_integrante}`"
                                                    target="_blank"
                                                    class="group relative flex items-center justify-center p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm"
                                                    title="Ver documento PDF">
                                                    <svg width="18" height="18" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                        <path d="M9 15h6M9 11h6" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <span v-else class="text-[10px] text-gray-300 italic">Sin anexo</span>
                                        </td>
                                        <td class="p-3 text-center" v-else>
                                            <div v-if="int.anexo_integrante" class="flex justify-center">
                                                <a :href="`http://vinculacion.test/Documentos/Vinculación/AnexoIntegrante/${int.ciinfper_doc || int.ciinfper_est}/${int.anexo_integrante}`"
                                                    target="_blank"
                                                    class="group relative flex items-center justify-center p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm"
                                                    title="Ver documento PDF">
                                                    <svg width="18" height="18" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                        <path d="M9 15h6M9 11h6" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <span v-else class="text-[10px] text-gray-300 italic">Sin anexo</span>
                                        </td>
                                        <td class="p-3 text-center">
                                            <div v-if="int.anexo_integrante2" class="flex justify-center">
                                                <a :href="`http://vinculacion.test/Documentos/Vinculación/AnexoIntegrante/${int.ciinfper_doc || int.ciinfper_est}/${int.anexo_integrante2}`"
                                                    target="_blank"
                                                    class="group relative flex items-center justify-center p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm"
                                                    title="Ver documento PDF">
                                                    <svg width="18" height="18" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                        <path d="M9 15h6M9 11h6" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <span v-else class="text-[10px] text-gray-300 italic">Sin anexo</span>
                                        </td>
                                        <td class="p-3 text-center">
                                            <span
                                                :class="int.estado === 0 ? 'text-red-500 bg-red-50' : 'text-green-600 bg-green-50'"
                                                class="px-2 py-1 rounded-full text-[10px] font-bold uppercase">
                                                {{ int.estado === 0 ? 'Inac' : 'Act' }}
                                            </span>
                                        </td>

                                        <td class="p-3 text-right">
                                            <div class="flex justify-end gap-2" v-if="int.estado === 1">
                                                <button @click="seleccionarIntegrante(int)"
                                                    class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                    <svg width="16" height="16" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button @click="inhabilitarIntegrante(int)" v-if="int.estado === 1"
                                                    class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                    <svg width="16" height="16" fill="none" stroke="currentColor"
                                                        stroke-width="2" viewBox="0 0 24 24">
                                                        <path
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showModalBaja"
            class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 z-99999">
            <div
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col">
                <div class="p-6 border-b dark:border-gray-800 flex justify-between items-center bg-red-50/50">
                    <h3 class="text-lg font-bold text-red-700">Confirmar Baja de Integrante</h3>
                    <button @click="showModalBaja = false" class="text-gray-400 hover:text-gray-600">✕</button>
                </div>

                <div class="p-6 space-y-4">
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-500 uppercase font-bold">Integrante seleccionado:</p>
                        <p class="text-sm font-bold text-gray-800 dark:text-white">
                            {{ (integranteBaja.informacion_personal_d || integranteBaja.informacionpersonal)?.NombInfPer
                            }}
                            {{ (integranteBaja.informacion_personal_d ||
                                integranteBaja.informacionpersonal)?.ApellInfPer }}
                        </p>
                        <p class="text-[10px] text-gray-400 font-mono">{{ integranteBaja.ciinfper_doc ||
                            integranteBaja.ciinfper_est }}</p>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold mb-1">Documento Respaldo (PDF)</label>
                        <div @click="$refs.fileInputBaja.click()"
                            class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-xl cursor-pointer transition-all"
                            :class="archivoBajaName ? 'border-brand-500 bg-brand-50/20' : 'border-gray-300 hover:border-brand-400 bg-gray-50 dark:bg-gray-800/50'">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg v-if="!archivoBajaName" class="w-8 h-8 mb-3 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <svg v-else class="w-8 h-8 mb-3 text-brand-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z" />
                                    <path d="M3 8a2 2 0 012-2v10h8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                                </svg>

                                <p class="mb-1 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold" v-if="!archivoBajaName">Haga clic para
                                        cargar</span>
                                    <span class="font-semibold text-brand-600" v-else>{{ archivoBajaName
                                    }}</span>
                                </p>
                                <p class="text-xs text-gray-400" v-if="!archivoBajaName">PDF (Máx. 10MB)</p>
                            </div>

                            <input type="file" ref="fileInputBaja" class="hidden" accept="application/pdf"
                                @change="handleFileBajaChange" />
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-gray-50 dark:bg-gray-800 flex gap-2">
                    <button @click="showModalBaja = false"
                        class="flex-1 px-4 py-2 text-sm font-bold text-gray-500 hover:bg-gray-200 rounded-xl transition-colors">
                        Cancelar
                    </button>
                    <button @click="confirmarInhabilitar" :disabled="!archivoBaja || cargandoBaja"
                        class="flex-1 px-4 py-2 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-lg disabled:opacity-50 transition-all">
                        {{ cargandoBaja ? 'Procesando...' : 'Confirmar Baja' }}
                    </button>
                </div>
            </div>
        </div>
        <div v-if="showEditModal"
            class="fixed inset-0 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4 z-[99999] transition-all duration-300">
            <div
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col border border-gray-100 dark:border-gray-800 transform scale-100 transition-transform duration-300">

                <div
                    class="flex justify-between items-center p-6 border-b border-gray-100 dark:border-gray-800 bg-gradient-to-r from-gray-50 to-white dark:from-gray-900 dark:to-gray-850">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="text-brand-500" width="22" height="22" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            Gestión y Edición del Proyecto
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">Modifica la información estructural del proyecto y su
                            alineación
                            estratégica.</p>
                    </div>
                    <button @click="cerrarEdicion"
                        class="p-2 rounded-xl text-gray-400 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div
                    class="flex border-b border-gray-100 dark:border-gray-800 px-6 pt-3 bg-gray-50/50 dark:bg-gray-900 gap-2">
                    <button @click="activeTab = 'generales'"
                        :class="activeTab === 'generales'
                            ? 'border-brand-500 text-brand-600 dark:text-brand-400 bg-white dark:bg-gray-850 shadow-sm rounded-t-xl border-t border-x'
                            : 'text-gray-500 hover:text-gray-800 hover:bg-gray-100/60 dark:hover:bg-gray-800 rounded-t-xl border-transparent'"
                        class="pb-3 pt-2.5 px-4 text-sm font-medium transition-all duration-200 border-b-2 -mb-[1px] flex items-center gap-2">
                        <span
                            class="flex h-5 w-5 items-center justify-center rounded-full bg-brand-100 dark:bg-brand-900/40 text-[11px] font-bold text-brand-600 dark:text-brand-400">1</span>
                        Datos Generales
                    </button>
                </div>

                <div class="p-6 overflow-y-auto custom-scrollbar flex-1 bg-white dark:bg-gray-900">
                    <div v-if="cargandoEdicion" class="flex flex-col justify-center items-center py-20 gap-3">
                        <span
                            class="animate-spin h-10 w-10 border-4 border-brand-500 border-t-transparent rounded-full"></span>
                        <p class="text-sm text-gray-500 font-medium">Sincronizando información del PEI...</p>
                    </div>

                    <div v-else-if="activeTab === 'generales'" class="space-y-6 progress-fade">

                        <div
                            class="bg-gray-50/60 dark:bg-gray-800/30 p-4 rounded-xl border border-gray-100 dark:border-gray-800/60">
                            <div class="flex items-start gap-2.5 mb-4">
                                <span class="p-1 rounded-md bg-blue-50 text-blue-600 mt-0.5">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 111.063 1.06l-.042.02a.75.75 0 01-1.063-1.06zm0 0a8.25 8.25 0 11-16.5 0 8.25 8.25 0 0116.5 0zM12 7h.008v.008H12V7z" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Identificación
                                        del
                                        Proyecto</h4>
                                    <p class="text-xs text-gray-500">Asegúrate de que los títulos coincidan
                                        rigurosamente con la
                                        documentación oficial aprobada.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div class="group flex flex-col">
                                    <label
                                        class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 transition-colors group-focus-within:text-brand-600">
                                        Nombre del Proyecto (ES)
                                    </label>
                                    <textarea v-model="editForm.proyect_nombre" @input="yaTraducido = false" rows="4"
                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-850 p-3 text-sm text-gray-800 dark:text-gray-100 shadow-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-200 outline-none resize-none"
                                        placeholder="Escribe el nombre del proyecto..."></textarea>
                                    <p class="mt-2 text-[11px] leading-relaxed text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold text-gray-600 dark:text-gray-300">Guía:</span> Se
                                        refiere a
                                        un término más informal o distintivo que se utiliza para identificar el proyecto
                                        de
                                        manera única. Puede ser más creativo y no necesariamente describir el contenido
                                        del
                                        proyecto de manera detallada.
                                    </p>
                                </div>

                                <div class="flex flex-col">
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5">
                                        Nombre del Proyecto (EN)
                                    </label>
                                    <textarea v-model="editForm.proyect_nombre_en" rows="4"
                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50/70 dark:bg-gray-800/50 p-3 text-sm text-gray-700 dark:text-gray-300 shadow-inner focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-200 outline-none resize-none"
                                        placeholder="Traducción automática o manual..."></textarea>
                                    <p class="mt-2 text-[11px] leading-relaxed text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold text-gray-600 dark:text-gray-300">Guía:</span>
                                        Traducción al
                                        inglés del nombre del proyecto. Debe mantener el tono distintivo e informal del
                                        original.
                                    </p>
                                </div>

                                <div class="group flex flex-col">
                                    <label
                                        class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1.5 transition-colors group-focus-within:text-brand-600">
                                        Título del proyecto (ES)
                                    </label>
                                    <textarea v-model="editForm.proyect_titulo" @input="yaTraducido = false" rows="3"
                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-850 p-3 text-sm text-gray-800 dark:text-gray-100 shadow-sm focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-200 outline-none resize-none"
                                        placeholder="Escribe el Título del proyecto ..."></textarea>
                                    <p class="mt-2 text-[11px] leading-relaxed text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold text-gray-600 dark:text-gray-300">Guía:</span> Es una
                                        frase
                                        corta y descriptiva que resume el propósito o enfoque central del proyecto. El
                                        título
                                        proporciona una visión general y a menudo incluye palabras clave que destacan la
                                        naturaleza y el alcance del proyecto.
                                    </p>
                                </div>

                                <div class="flex flex-col">
                                    <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1.5">
                                        Título del proyecto (EN)
                                    </label>
                                    <textarea v-model="editForm.proyect_titulo_en" rows="3"
                                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50/70 dark:bg-gray-800/50 p-3 text-sm text-gray-700 dark:text-gray-300 shadow-inner focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all duration-200 outline-none resize-none"
                                        placeholder="Traducción automática o manual..."></textarea>
                                    <p class="mt-2 text-[11px] leading-relaxed text-gray-500 dark:text-gray-400">
                                        <span class="font-semibold text-gray-600 dark:text-gray-300">Guía:</span>
                                        Traducción al
                                        inglés del título técnico. Debe conservar las palabras clave y la descripción
                                        precisa
                                        del alcance establecidas en la versión en español.
                                    </p>
                                </div>

                            </div>

                            <div
                                class="mt-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 bg-amber-50 dark:bg-amber-950/20 border border-amber-200/70 dark:border-amber-900/40 p-3.5 rounded-xl">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-amber-600 dark:text-amber-400 shrink-0">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <p class="text-xs text-amber-800 dark:text-amber-300 font-medium">
                                        <span class="font-bold">Nota de Calidad:</span> Para garantizar la precisión
                                        técnica,
                                        verifique el resultado traducido antes de guardar los cambios finales.
                                    </p>
                                </div>
                                <button @click="traducirTextos"
                                    :disabled="yaTraducido || (!editForm.proyect_nombre && !editForm.proyect_titulo)"
                                    :class="yaTraducido
                                        ? 'bg-emerald-100 text-emerald-700 border border-emerald-200 cursor-not-allowed opacity-80'
                                        : 'bg-gray-900 dark:bg-gray-800 text-white hover:bg-gray-800 dark:hover:bg-gray-700 active:scale-95 shadow-md shadow-gray-900/10'"
                                    class="text-xs px-4 py-2.5 font-semibold rounded-lg transition-all duration-200 flex items-center gap-2 shrink-0 w-full sm:w-auto justify-center">
                                    <span v-if="yaTraducido"
                                        class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    {{ yaTraducido ? '✓ Textos Traducidos' : 'Auto-Traducir Textos' }}
                                </button>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="p-1 rounded-md bg-purple-50 text-purple-600 mt-0.5 dark:bg-purple-950/40 dark:text-purple-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Objetivos del
                                        Plan
                                        Estratégico Institucional</h4>
                                    <p class="text-xs text-gray-500">Vincule los objetivos operativos de este proyecto
                                        con las
                                        metas globales del PEI vigente. Por defecto queda seleccionado el objetivo que
                                        lleva
                                        relación con la vinculción con la sociedad</p>
                                </div>
                            </div>

                            <div
                                class="border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm bg-white dark:bg-gray-950">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                                    <thead class="bg-gray-50 dark:bg-gray-900/80">
                                        <tr>
                                            <th
                                                class="px-5 py-3 text-left w-14 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                                Sel.</th>
                                            <th
                                                class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-1/4">
                                                Subsistema</th>
                                            <th
                                                class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Detalle del Objetivo Estratégico</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        <tr v-for="obj in objetivosPeiDisponibles" :key="obj.id_obj_pei" :class="editForm.objetivos.includes(obj.id_obj_pei)
                                            ? 'bg-brand-50/40 dark:bg-brand-950/20 transition-colors'
                                            : 'hover:bg-gray-50/70 dark:hover:bg-gray-800/30 transition-colors'"
                                            class="cursor-pointer" @click="toggleObjetivo(obj.id_obj_pei)">
                                            <td class="px-5 py-4 text-center" @click.stop>
                                                <input type="checkbox" :value="obj.id_obj_pei"
                                                    v-model="editForm.objetivos"
                                                    class="w-4 h-4 text-brand-600 rounded border-gray-300 dark:border-gray-700 focus:ring-brand-500/30 transition-all duration-150">
                                            </td>
                                            <td class="px-5 py-4 text-xs font-bold text-gray-700 dark:text-gray-300">
                                                <span
                                                    :class="obj.subsistemas_pei?.nombre_subsistema.toLowerCase().includes('vinculación') ? 'bg-purple-100 text-purple-800 dark:bg-purple-950 dark:text-purple-300' : 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-400'"
                                                    class="px-2.5 py-1 rounded-md tracking-wide">
                                                    {{ obj.subsistemas_pei ? obj.subsistemas_pei.nombre_subsistema :
                                                        'N/A' }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-5 py-4 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                                <span
                                                    class="font-mono text-xs text-brand-600 dark:text-brand-400 bg-brand-50 dark:bg-brand-950/50 px-1.5 py-0.5 rounded mr-1.5 font-bold">{{
                                                        obj.cod_obj }}</span>
                                                {{ obj.detalle_obj }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div v-if="editForm.objetivos.length === 0"
                                class="flex items-center gap-2 text-red-500 dark:text-red-400 text-xs font-semibold p-1 animate-pulse">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Restricción: Es obligatorio seleccionar como mínimo un objetivo estratégico
                                institucional.
                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="p-1 rounded-md bg-emerald-50 text-emerald-600 mt-0.5 dark:bg-emerald-950/40 dark:text-emerald-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Políticas del
                                        Plan de Desarrollo para el Nuevo Ecuador (PLANDE)</h4>
                                    <p class="text-xs text-gray-500">Vincule las políticas del PLANDE habilitado
                                        vigentes que
                                        dan soporte normativo y estratégico a las actividades del proyecto.</p>
                                </div>
                            </div>

                            <div
                                class="border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm bg-white dark:bg-gray-950">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                                    <thead class="bg-gray-50 dark:bg-gray-900/80">
                                        <tr>
                                            <th
                                                class="px-5 py-3 text-left w-14 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                                Sel.</th>
                                            <th
                                                class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-1/4">
                                                Código Política</th>
                                            <th
                                                class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Detalle de la Política de Desarrollo</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        <tr v-for="pol in politicasPlandeDisponibles" :key="pol.id_pol_pladne"
                                            :class="editForm.politicas.includes(pol.id_pol_pladne) ? 'bg-brand-50/40 dark:bg-brand-950/20 transition-colors' : 'hover:bg-gray-50/70 dark:hover:bg-gray-800/30 transition-colors'"
                                            class="cursor-pointer" @click="togglePolitica(pol.id_pol_pladne)">

                                            <td class="px-5 py-4 text-center" @click.stop>
                                                <input type="checkbox" :value="pol.id_pol_pladne"
                                                    v-model="editForm.politicas"
                                                    class="w-4 h-4 text-brand-600 rounded border-gray-300 dark:border-gray-700 focus:ring-brand-500/30 transition-all duration-150">
                                            </td>
                                            <td class="px-5 py-4 text-xs font-bold text-gray-700 dark:text-gray-300">
                                                <span
                                                    class="bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 px-2.5 py-1 rounded-md tracking-wide font-mono">
                                                    {{ pol.cod_pol }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-5 py-4 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                                {{ pol.detalle_pol }}
                                            </td>
                                        </tr>
                                        <tr v-if="politicasPlandeDisponibles.length === 0">
                                            <td colspan="3" class="px-5 py-8 text-center text-sm text-gray-400">
                                                No hay políticas disponibles para el PLANDE activo.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="p-1 rounded-md bg-emerald-50 text-emerald-600 mt-0.5 dark:bg-emerald-950/40 dark:text-emerald-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 21a9 9 0 100-18 9 9 0 000 18z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.6 9h16.8M3.6 15h16.8M12 3a16.5 16.5 0 00-4 18M12 3a16.5 16.5 0 014 18" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                        Agenda 2030 y los Objetivos de desarrollo sostenible una oportunidad para
                                        América Latina
                                        y el Caribe
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        Vincule los objetivos de la Agenda ODS que estén relacionados con su proyecto.
                                    </p>
                                </div>
                            </div>

                            <div
                                class="border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm bg-white dark:bg-gray-950">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                                    <thead class="bg-gray-50 dark:bg-gray-900/80">
                                        <tr>
                                            <th
                                                class="px-5 py-3 text-left w-14 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                                Sel.</th>
                                            <th
                                                class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-1/4">
                                                Código ODS</th>
                                            <th
                                                class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Detalle del ODS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        <tr v-for="ods in objetivosODSDisponibles" :key="ods.id_ods"
                                            :class="editForm.ods.includes(ods.id_ods) ? 'bg-brand-50/40 dark:bg-brand-950/20 transition-colors' : 'hover:bg-gray-50/70 dark:hover:bg-gray-800/30 transition-colors'"
                                            class="cursor-pointer" @click="toggleODS(ods.id_ods)">
                                            <td class="px-5 py-4 text-center" @click.stop>
                                                <input type="checkbox" :value="ods.id_ods" v-model="editForm.ods"
                                                    class="w-4 h-4 text-brand-600 rounded border-gray-300 dark:border-gray-700 focus:ring-brand-500/30 transition-all duration-150">
                                            </td>
                                            <td class="px-5 py-4 text-xs font-bold text-gray-700 dark:text-gray-300">
                                                <span
                                                    class="bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 px-2.5 py-1 rounded-md tracking-wide font-mono">
                                                    {{ ods.cod_ods }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-5 py-4 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                                {{ ods.detalle_ods }}
                                            </td>
                                        </tr>
                                        <tr v-if="objetivosODSDisponibles.length === 0">
                                            <td colspan="3" class="px-5 py-8 text-center text-sm text-gray-400">
                                                No hay ODS disponibles para la Agenda ODS.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="p-1 rounded-md bg-blue-50 text-blue-600 mt-0.5 dark:bg-blue-950/40 dark:text-blue-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Objetivos del
                                        Plan de
                                        Desarrollo para el Nuevo Ecuador (PLANDE)</h4>
                                    <p class="text-xs text-gray-500">Objetivos que corresponden a las políticas que ha
                                        seleccionado previamente.</p>
                                </div>
                            </div>

                            <div v-if="!editForm.politicas || editForm.politicas.length === 0"
                                class="p-4 border border-blue-100 bg-blue-50/50 dark:border-blue-950/50 dark:bg-blue-950/20 rounded-xl flex items-center gap-3">
                                <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs text-blue-700 dark:text-blue-400">
                                    Debe seleccionar al menos una **Política del PlanDNE** en la sección anterior para
                                    que
                                    aparezcan sus objetivos correspondientes de forma automática.
                                </p>
                            </div>

                            <div v-else
                                class="border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm bg-white dark:bg-gray-950">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                                    <thead class="bg-gray-50 dark:bg-gray-900/80">
                                        <tr>
                                            <th
                                                class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-1/4">
                                                Código Objetivo</th>
                                            <th
                                                class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                                Detalle del Objetivo de la Política</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        <tr v-for="objPol in objetivosPoliticasDisponibles"
                                            :key="objPol.id_obj_pol_pladne" class="bg-brand-50/10 dark:bg-brand-950/5">
                                            <td class="px-5 py-4 text-xs font-bold text-gray-700 dark:text-gray-300">
                                                <span
                                                    class="bg-blue-100 text-blue-800 dark:bg-blue-950 dark:text-blue-300 px-2.5 py-1 rounded-md tracking-wide font-mono">
                                                    {{ objPol.cod_obj_pol }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-5 py-4 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                                {{ objPol.detalle_obj_pol }}
                                            </td>
                                        </tr>
                                        <tr v-if="objetivosPoliticasDisponibles.length === 0">
                                            <td colspan="2" class="px-5 py-8 text-center text-sm text-gray-400">
                                                Las políticas seleccionadas no tienen objetivos registrados.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="p-1 rounded-md bg-indigo-50 text-indigo-600 mt-0.5 dark:bg-indigo-950/40 dark:text-indigo-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Enfoque del
                                        Proyecto</h4>
                                    <p class="text-xs text-gray-500">Determine si la naturaleza de la investigación
                                        requiere la
                                        intervención de múltiples áreas del conocimiento.</p>
                                </div>
                            </div>

                            <div
                                class="p-5 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm bg-white dark:bg-gray-950 space-y-4">
                                <label
                                    class="block text-xs font-medium uppercase tracking-wider text-gray-400 dark:text-gray-500">
                                    ¿El proyecto es multidisciplinario?
                                </label>

                                <div class="flex flex-wrap gap-6">
                                    <label
                                        class="flex items-center gap-2 cursor-pointer group text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <input type="radio" :value="1" v-model="editForm.proyect_multidis"
                                            class="w-4 h-4 text-brand-600 border-gray-300 focus:ring-brand-500/30 dark:border-gray-700 dark:bg-gray-900 transition-all">
                                        <span class="group-hover:text-brand-600 transition-colors">Sí, es
                                            multidisciplinario</span>
                                    </label>

                                    <label
                                        class="flex items-center gap-2 cursor-pointer group text-sm font-medium text-gray-700 dark:text-gray-300">
                                        <input type="radio" :value="0" v-model="editForm.proyect_multidis"
                                            class="w-4 h-4 text-brand-600 border-gray-300 focus:ring-brand-500/30 dark:border-gray-700 dark:bg-gray-900 transition-all">
                                        <span class="group-hover:text-brand-600 transition-colors">No, pertenece a una
                                            sola
                                            disciplina</span>
                                    </label>
                                </div>

                                <div class="transition-all duration-300">
                                    <div v-if="editForm.proyect_multidis === 1"
                                        class="p-4 border border-emerald-100 bg-emerald-50/40 dark:border-emerald-950/40 dark:bg-emerald-950/10 rounded-xl space-y-2">
                                        <div
                                            class="flex items-center gap-2 text-emerald-800 dark:text-emerald-400 font-semibold text-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Configuración multidisciplinaria activa</span>
                                        </div>
                                        <p class="text-xs text-emerald-700 dark:text-emerald-400/90 leading-relaxed">
                                            Has seleccionado que **sí**. Eso significa que tu proyecto trabajará en
                                            conjunto con
                                            varias facultades y carreras.
                                        </p>
                                        <div
                                            class="pt-1 text-[11px] text-gray-500 dark:text-gray-400 italic border-t border-emerald-200/40 dark:border-emerald-900/40">
                                            **¿Qué implica?** Los proyectos multidisciplinarios integran metodologías,
                                            marcos
                                            teóricos y herramientas de distintas áreas profesionales para resolver un
                                            problema
                                            complejo común, enriqueciendo los resultados desde diferentes perspectivas
                                            académicas.
                                        </div>
                                    </div>

                                    <div v-else-if="editForm.proyect_multidis === 0"
                                        class="p-4 border border-gray-200 bg-gray-50/50 dark:border-gray-800 dark:bg-gray-900/30 rounded-xl space-y-2">
                                        <div
                                            class="flex items-center gap-2 text-gray-700 dark:text-gray-400 font-semibold text-xs">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Enfoque disciplinar estándar</span>
                                        </div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                                            El proyecto **solo pertenece a una facultad y una carrera en específica**.
                                            El
                                            desarrollo metodológico y operativo se concentrará de forma interna en su
                                            propia
                                            área técnica de estudios.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="p-1 rounded-md bg-purple-50 text-purple-600 mt-0.5 dark:bg-purple-950/40 dark:text-purple-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Facultades
                                        Participantes
                                    </h4>
                                    <p class="text-xs text-gray-500">Gestione la filiación de las facultades asociadas
                                        directamente a la ejecución del proyecto.</p>
                                </div>
                            </div>

                            <div
                                class="p-5 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm bg-white dark:bg-gray-950 space-y-5">

                                <div v-if="editForm.proyect_multidis === 1" class="space-y-5 animate-fadeIn">
                                    <div class="space-y-2">
                                        <label
                                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                            1. Seleccione la Facultad Prioritaria (A la que pertenece el proyecto) <span
                                                class="text-red-500">*</span>
                                        </label>
                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-60 overflow-y-auto pr-1">
                                            <div v-for="fac in facultadesCatalogo" :key="'priori-' + fac.idfacultad"
                                                class="flex items-start p-3 border rounded-xl bg-gray-50/50 dark:bg-gray-900/30 transition-all"
                                                :class="editForm.id_facultad_priori === fac.idfacultad ? 'border-brand-500 bg-brand-50/10 dark:border-brand-900/30 ring-2 ring-brand-500/20' : 'border-gray-200 dark:border-gray-800'">
                                                <div class="flex items-center h-5">
                                                    <input type="radio" :id="'priori-' + fac.idfacultad"
                                                        name="facultad_prioritaria" :value="fac.idfacultad"
                                                        v-model="editForm.id_facultad_priori"
                                                        @change="handleFacultadPrioriChange"
                                                        class="w-4 h-4 text-brand-600 border-gray-300 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900">
                                                </div>
                                                <label :for="'priori-' + fac.idfacultad"
                                                    class="ml-3 text-xs font-medium text-gray-700 dark:text-gray-300 cursor-pointer w-full">
                                                    <span class="block font-semibold"
                                                        :class="editForm.id_facultad_priori === fac.idfacultad ? 'text-brand-600 dark:text-brand-400' : ''">
                                                        {{ fac.facultad }} ({{ fac.siglas }})
                                                        <small v-if="editForm.id_facultad_priori === fac.idfacultad"
                                                            class="ml-1 text-[10px] bg-brand-100 text-brand-700 dark:bg-brand-950/80 dark:text-brand-300 px-1.5 py-0.5 rounded font-bold">Principal</small>
                                                    </span>
                                                    <span class="text-[11px] text-gray-400 block mt-0.5">Decano: {{
                                                        fac.decano
                                                        || 'No asignado' }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div v-if="editForm.id_facultad_priori"
                                        class="space-y-3 pt-2 border-t border-gray-100 dark:border-gray-800">
                                        <label
                                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                            2. Seleccione las otras Facultades que participan en conjunto:
                                        </label>

                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-60 overflow-y-auto pr-1">
                                            <div v-for="fac in facultadesCatalogo" :key="fac.idfacultad"
                                                class="flex items-start p-3 border rounded-xl bg-gray-50/50 dark:bg-gray-900/30 transition-all"
                                                :class="editForm.id_facultad_priori === fac.idfacultad ? 'border-brand-200 bg-brand-50/10 dark:border-brand-900/30' : 'border-gray-200 dark:border-gray-800'">
                                                <div class="flex items-center h-5">
                                                    <input type="checkbox" :id="'fac-' + fac.idfacultad"
                                                        :value="fac.idfacultad" v-model="editForm.facultades"
                                                        :disabled="editForm.id_facultad_priori === fac.idfacultad"
                                                        class="w-4 h-4 text-brand-600 border-gray-300 rounded focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900">
                                                </div>
                                                <label :for="'fac-' + fac.idfacultad"
                                                    class="ml-3 text-xs font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                                                    <span class="block font-semibold"
                                                        :class="editForm.id_facultad_priori === fac.idfacultad ? 'text-brand-600 dark:text-brand-400' : ''">
                                                        {{ fac.facultad }} ({{ fac.siglas }})
                                                        <small v-if="editForm.id_facultad_priori === fac.idfacultad"
                                                            class="ml-1 text-[10px] bg-brand-100 text-brand-700 dark:bg-brand-950/80 dark:text-brand-300 px-1.5 py-0.5 rounded font-bold">Principal</small>
                                                    </span>
                                                    <span class="text-[11px] text-gray-400 block mt-0.5">Decano: {{
                                                        fac.decano
                                                        || 'No asignado' }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-else class="space-y-3 animate-fadeIn">
                                    <label
                                        class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Seleccione la Facultad Única a la que pertenece el proyecto <span
                                            class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-60 overflow-y-auto pr-1">
                                        <div v-for="fac in facultadesCatalogo" :key="'unica-' + fac.idfacultad"
                                            class="flex items-start p-3 border rounded-xl bg-gray-50/50 dark:bg-gray-900/30 transition-all"
                                            :class="editForm.id_facultad_priori === fac.idfacultad ? 'border-brand-500 bg-brand-50/10 dark:border-brand-900/30 ring-2 ring-brand-500/20' : 'border-gray-200 dark:border-gray-800'">
                                            <div class="flex items-center h-5">
                                                <input type="radio" :id="'unica-' + fac.idfacultad"
                                                    name="facultad_unica" :value="fac.idfacultad"
                                                    v-model="editForm.id_facultad_priori"
                                                    class="w-4 h-4 text-brand-600 border-gray-300 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900">
                                            </div>
                                            <label :for="'unica-' + fac.idfacultad"
                                                class="ml-3 text-xs font-medium text-gray-700 dark:text-gray-300 cursor-pointer w-full">
                                                <span class="block font-semibold"
                                                    :class="editForm.id_facultad_priori === fac.idfacultad ? 'text-brand-600 dark:text-brand-400' : ''">
                                                    {{ fac.facultad }} ({{ fac.siglas }})
                                                    <small v-if="editForm.id_facultad_priori === fac.idfacultad"
                                                        class="ml-1 text-[10px] bg-brand-100 text-brand-700 dark:bg-brand-950/80 dark:text-brand-300 px-1.5 py-0.5 rounded font-bold">Seleccionada</small>
                                                </span>
                                                <span class="text-[11px] text-gray-400 block mt-0.5">Decano: {{
                                                    fac.decano ||
                                                    'No asignado' }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <p class="text-[11px] text-gray-400 italic">
                                        * Nota: Al no ser un proyecto multidisciplinario, la facultad seleccionada se
                                        definirá
                                        automáticamente como el núcleo prioritario y único del desarrollo de la
                                        investigación.
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="p-1 rounded-md bg-indigo-50 text-indigo-600 mt-0.5 dark:bg-indigo-950/40 dark:text-indigo-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Carreras
                                        Participantes
                                    </h4>
                                    <p class="text-xs text-gray-500">Gestione la filiación de las carreras asociadas
                                        directamente a la ejecución del proyecto.</p>
                                </div>
                            </div>

                            <div
                                class="p-5 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm bg-white dark:bg-gray-950 space-y-5">

                                <div v-if="editForm.proyect_multidis === 1" class="space-y-5 animate-fadeIn">
                                    <div class="space-y-2">
                                        <label
                                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                            1. Seleccione la Carrera Prioritaria (Debe pertenecer a la facultad
                                            prioritaria)
                                            <span class="text-red-500">*</span>
                                        </label>
                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-60 overflow-y-auto pr-1">
                                            <div v-for="carr in carrerasCatalogo.filter(c => c.facultad?.id == editForm.id_facultad_priori)"
                                                :key="'carr-priori-' + carr.id_carrera"
                                                class="flex items-start p-3 border rounded-xl bg-gray-50/50 dark:bg-gray-900/30 transition-all"
                                                :class="editForm.id_carr_priori === carr.id_carrera ? 'border-brand-500 bg-brand-50/10 dark:border-brand-900/30 ring-2 ring-brand-500/20' : 'border-gray-200 dark:border-gray-800'">
                                                <div class="flex items-center h-5">
                                                    <input type="radio" :id="'carr-priori-' + carr.id_carrera"
                                                        name="carrera_prioritaria" :value="carr.id_carrera"
                                                        v-model="editForm.id_carr_priori"
                                                        @change="handleCarreraPrioriChange"
                                                        class="w-4 h-4 text-brand-600 border-gray-300 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900">
                                                </div>
                                                <label :for="'carr-priori-' + carr.id_carrera"
                                                    class="ml-3 text-xs font-medium text-gray-700 dark:text-gray-300 cursor-pointer w-full">
                                                    <span class="block font-semibold"
                                                        :class="editForm.id_carr_priori === carr.id_carrera ? 'text-brand-600 dark:text-brand-400' : ''">
                                                        {{ carr.nombre_carrera }}
                                                        <small v-if="editForm.id_carr_priori === carr.id_carrera"
                                                            class="ml-1 text-[10px] bg-brand-100 text-brand-700 dark:bg-brand-950/80 dark:text-brand-300 px-1.5 py-0.5 rounded font-bold">Principal</small>
                                                    </span>
                                                    <span class="text-[11px] text-gray-400 block mt-0.5">Director: {{
                                                        carr.director_procesado
                                                        }}</span>
                                                </label>
                                            </div>
                                            <div v-if="carrerasCatalogo.filter(c => c.facultad?.id == editForm.id_facultad_priori).length === 0"
                                                class="col-span-2 text-xs text-gray-400 italic p-2">
                                                No hay carreras cargadas. Por favor, seleccione una facultad prioritaria
                                                primero.
                                            </div>
                                        </div>
                                    </div>

                                    <div v-if="editForm.id_carr_priori"
                                        class="space-y-3 pt-2 border-t border-gray-100 dark:border-gray-800">
                                        <label
                                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                            2. Seleccione las otras Carreras que participan en conjunto:
                                        </label>
                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-60 overflow-y-auto pr-1">
                                            <div v-for="carr in carrerasCatalogo" :key="carr.id_carrera"
                                                class="flex items-start p-3 border rounded-xl bg-gray-50/50 dark:bg-gray-900/30 transition-all"
                                                :class="editForm.id_carr_priori === carr.id_carrera ? 'border-brand-200 bg-brand-50/10 dark:border-brand-900/30' : 'border-gray-200 dark:border-gray-800'">
                                                <div class="flex items-center h-5">
                                                    <input type="checkbox" :id="'carr-' + carr.id_carrera"
                                                        :value="carr.id_carrera" v-model="editForm.carreras"
                                                        :disabled="editForm.id_carr_priori === carr.id_carrera"
                                                        class="w-4 h-4 text-brand-600 border-gray-300 rounded focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900">
                                                </div>
                                                <label :for="'carr-' + carr.id_carrera"
                                                    class="ml-3 text-xs font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                                                    <span class="block font-semibold"
                                                        :class="editForm.id_carr_priori === carr.id_carrera ? 'text-brand-600 dark:text-brand-400' : ''">
                                                        {{ carr.nombre_carrera }}
                                                        <small v-if="editForm.id_carr_priori === carr.id_carrera"
                                                            class="ml-1 text-[10px] bg-brand-100 text-brand-700 dark:bg-brand-950/80 dark:text-brand-300 px-1.5 py-0.5 rounded font-bold">Principal</small>
                                                    </span>
                                                    <span class="text-[11px] text-gray-400 block mt-0.5">Director: {{
                                                        carr.director_procesado
                                                        }}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-else class="space-y-3 animate-fadeIn">
                                    <label
                                        class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Seleccione la Carrera Única a la que pertenece el proyecto <span
                                            class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-60 overflow-y-auto pr-1">
                                        <div v-for="carr in carrerasCatalogo" :key="'unica-carr-' + carr.id_carrera"
                                            class="flex items-start p-3 border rounded-xl bg-gray-50/50 dark:bg-gray-900/30 transition-all"
                                            :class="editForm.id_carr_priori === carr.id_carrera ? 'border-brand-500 bg-brand-50/10 dark:border-brand-900/30 ring-2 ring-brand-500/20' : 'border-gray-200 dark:border-gray-800'">
                                            <div class="flex items-center h-5">
                                                <input type="radio" :id="'unica-carr-' + carr.id_carrera"
                                                    name="carrera_unica" :value="carr.id_carrera"
                                                    v-model="editForm.id_carr_priori"
                                                    class="w-4 h-4 text-brand-600 border-gray-300 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900">
                                            </div>
                                            <label :for="'unica-carr-' + carr.id_carrera"
                                                class="ml-3 text-xs font-medium text-gray-700 dark:text-gray-300 cursor-pointer w-full">
                                                <span class="block font-semibold"
                                                    :class="editForm.id_carr_priori === carr.id_carrera ? 'text-brand-600 dark:text-brand-400' : ''">
                                                    {{ carr.nombre_carrera }}
                                                    <small v-if="editForm.id_carr_priori === carr.id_carrera"
                                                        class="ml-1 text-[10px] bg-brand-100 text-brand-700 dark:bg-brand-950/80 dark:text-brand-300 px-1.5 py-0.5 rounded font-bold">Seleccionada</small>
                                                </span>
                                                <span class="text-[11px] text-gray-400 block mt-0.5">Director: {{
                                                    carr.director_procesado
                                                    }}</span>
                                            </label>
                                        </div>
                                        <div v-if="carrerasCatalogo.length === 0"
                                            class="col-span-2 text-xs text-gray-400 italic p-2">
                                            No hay carreras disponibles. Asegúrese de haber seleccionado la Facultad.
                                        </div>
                                    </div>
                                    <p class="text-[11px] text-gray-400 italic">
                                        * Nota: Al no ser un proyecto multidisciplinario, la carrera seleccionada se
                                        definirá
                                        automáticamente como el núcleo prioritario y único del desarrollo de la
                                        investigación.
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="p-1 rounded-md bg-amber-50 text-amber-600 mt-0.5 dark:bg-amber-950/40 dark:text-amber-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Dominios
                                        Humanísticos
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        Los dominios humanísticos representan áreas del conocimiento enfocadas en el
                                        desarrollo
                                        social, ético y cultural. En vinculación, guían el impacto del proyecto hacia el
                                        bienestar comunitario y la transformación del entorno social.
                                    </p>
                                </div>
                            </div>

                            <div
                                class="p-5 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm bg-white dark:bg-gray-950 space-y-4">

                                <div v-if="dominiosCatalogo.length > 0"
                                    class="p-3 bg-gradient-to-r from-indigo-50 to-brand-50/30 dark:from-indigo-950/20 dark:to-transparent rounded-lg border border-indigo-100/50 dark:border-indigo-900/30 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div class="space-y-0.5">
                                        <span
                                            class="text-[10px] font-bold tracking-wider text-indigo-600 dark:text-indigo-400 uppercase block">Asistente
                                            Inteligente</span>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">¿No está seguro de qué
                                            dominios
                                            elegir? Analice la información de su proyecto.</p>
                                    </div>
                                    <button type="button" @click="recomendarDominio"
                                        class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm transition-colors shrink-0 gap-1.5">
                                        <svg class="w-3.5 h-3.5 animate-pulse" fill="none" stroke="currentColor"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.813 15.904L9 21l8.982-8.982M18 12a6 6 0 11-12 0 6 6 0 0112 0z" />
                                        </svg>
                                        Recomendar Dominio
                                    </button>
                                </div>

                                <div class="space-y-2">
                                    <label
                                        class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Seleccione uno o más Dominios Humanísticos aplicables: <span
                                            class="text-red-500">*</span>
                                    </label>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-60 overflow-y-auto pr-1">
                                        <div v-for="dom in dominiosCatalogo" :key="'dom-' + dom.id_dom_huma"
                                            class="flex items-start p-3 border rounded-xl bg-gray-50/50 dark:bg-gray-900/30 transition-all cursor-pointer"
                                            :class="editForm.dominios_humanisticos.includes(dom.id_dom_huma) ? 'border-emerald-500 bg-emerald-50/10 dark:border-emerald-900/30 ring-1 ring-emerald-500/30' : 'border-gray-200 dark:border-gray-800'"
                                            @click="toggleDominio(dom.id_dom_huma)">

                                            <div class="flex items-center h-5" @click.stop>
                                                <input type="checkbox" :id="'dom-check-' + dom.id_dom_huma"
                                                    :value="dom.id_dom_huma" v-model="editForm.dominios_humanisticos"
                                                    class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900">
                                            </div>

                                            <label :for="'dom-check-' + dom.id_dom_huma"
                                                class="ml-3 text-xs font-medium text-gray-700 dark:text-gray-300 cursor-pointer w-full"
                                                @click.stop="toggleDominio(dom.id_dom_huma)">
                                                <span class="block font-semibold"
                                                    :class="editForm.dominios_humanisticos.includes(dom.id_dom_huma) ? 'text-emerald-700 dark:text-emerald-400' : ''">
                                                    {{ dom.detalle_dom_huma }}
                                                </span>
                                                <span v-if="dominioRecomendadoId === dom.id_dom_huma"
                                                    class="inline-block mt-1 text-[9px] bg-emerald-100 text-emerald-800 dark:bg-emerald-950/80 dark:text-emerald-300 font-bold px-1.5 py-0.5 rounded">
                                                    ⭐ Sugerido para este Proyecto
                                                </span>
                                            </label>
                                        </div>

                                        <div v-if="dominiosCatalogo.length === 0"
                                            class="col-span-2 text-xs text-gray-400 italic p-2 text-center">
                                            Cargando catálogo de dominios...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span
                                    class="p-1 rounded-md bg-blue-50 text-blue-600 mt-0.5 dark:bg-blue-950/40 dark:text-blue-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Convocatoria del
                                        Proyecto
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        Seleccione el número de la convocatoria activa bajo la cual se rige el
                                        desarrollo del
                                        proyecto.
                                    </p>
                                </div>
                            </div>

                            <div class="p-5 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm bg-white dark:bg-gray-950 space-y-4">
                                <div class="space-y-2">
                                    <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                        Seleccione la Convocatoria: <span class="text-red-500">*</span>
                                    </label>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-60 overflow-y-auto pr-1">
                                        <div v-for="conv in convocatoriasCatalogo" :key="'conv-' + conv.id_convocatoria"
                                            class="flex items-start p-3 border rounded-xl bg-gray-50/50 dark:bg-gray-900/30 transition-all cursor-pointer"
                                            :class="editForm.id_convocatoria === conv.id_convocatoria ? 'border-green-500 bg-green-50/10 dark:border-green-900/30 ring-1 ring-green-500/30' : 'border-gray-200 dark:border-gray-800'"
                                            @click="editForm.id_convocatoria = conv.id_convocatoria">

                                            <div class="flex items-center h-5" @click.stop>
                                                <input type="radio" :id="'conv-radio-' + conv.id_convocatoria"
                                                    :value="conv.id_convocatoria" v-model="editForm.id_convocatoria"
                                                    class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500 dark:border-gray-700 dark:bg-gray-900">
                                            </div>

                                            <label :for="'conv-radio-' + conv.id_convocatoria"
                                                class="ml-3 text-xs font-medium text-gray-700 dark:text-gray-300 cursor-pointer w-full"
                                                @click.stop="editForm.id_convocatoria = conv.id_convocatoria">
                                                <span class="block font-semibold"
                                                    :class="editForm.id_convocatoria === conv.id_convocatoria ? 'text-green-700 dark:text-green-400' : ''">
                                                    Nº {{ conv.num_convocatoria }}
                                                </span>
                                                <span class="block text-[11px] text-gray-500 dark:text-gray-400 font-normal mt-0.5 line-clamp-2">
                                                    {{ conv.titulo_convocatoria }}
                                                </span>
                                            </label>
                                        </div>

                                        <div v-if="convocatoriasCatalogo.length === 0"
                                            class="col-span-2 text-xs text-gray-400 italic p-2 text-center">
                                            No hay convocatorias activas disponibles en el sistema...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span class="p-1 rounded-md bg-indigo-50 text-indigo-600 mt-0.5 dark:bg-indigo-950/40 dark:text-indigo-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Investigación</h4>
                                    <p class="text-xs text-gray-500">Líneas y sublíneas vinculadas al proyecto.</p>
                                </div>
                            </div>

                            <div class="p-5 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm bg-white dark:bg-gray-950 space-y-4">
                                <div class="flex p-3 text-sm text-amber-800 rounded-lg bg-amber-50 dark:bg-gray-800 dark:text-amber-300" role="alert">
                                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <span class="font-medium">Selección Automática:</span> 
                                        Estos campos se asignan de manera automática basándose en la <strong>Facultad Prioritaria</strong> y 
                                        <strong>Carrera Prioritaria</strong>. 
                                        Modifique dichos parámetros arriba si desea cambiar las líneas.
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="p-3 border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/30 rounded-lg opacity-80">
                                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">
                                            Líneas de Investigación (Facultad)
                                        </label>
                                        <ul v-if="lineasFiltradas.length > 0" class="space-y-1">
                                            <li v-for="lin in lineasFiltradas" :key="lin.id_lin_investiga" class="flex items-start text-xs text-gray-600 dark:text-gray-400 font-medium">
                                                <span class="text-indigo-500 mr-1.5">✓</span> {{ lin.nombre_lin }}
                                            </li>
                                        </ul>
                                        <div v-else class="text-xs text-gray-400 italic">No hay líneas disponibles para esta facultad...</div>
                                    </div>

                                    <div class="p-3 border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/30 rounded-lg opacity-80">
                                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">
                                            Sublíneas de Investigación (Carrera)
                                        </label>
                                        <ul v-if="sublineasFiltradas.length > 0" class="space-y-1">
                                            <li v-for="sub in sublineasFiltradas" :key="sub.id_sublin_investiga" class="flex items-start text-xs text-gray-600 dark:text-gray-400 font-medium">
                                                <span class="text-indigo-500 mr-1.5">✓</span> {{ sub.nombre_sublin }}
                                            </li>
                                        </ul>
                                        <div v-else class="text-xs text-gray-400 italic">No hay sublíneas disponibles para esta carrera...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start gap-2.5">
                                <span class="p-1 rounded-md bg-emerald-50 text-emerald-600 mt-0.5 dark:bg-emerald-950/40 dark:text-emerald-400">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Clasificación UNESCO</h4>
                                    <p class="text-xs text-gray-500">Áreas, Subáreas y Áreas específicas de conocimiento vinculadas.</p>
                                </div>
                            </div>

                            <div class="p-5 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm bg-white dark:bg-gray-950 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    
                                    <div class="p-3 border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/30 rounded-lg">
                                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">
                                            1. Áreas de Conocimiento
                                        </label>
                                        <div class="max-h-48 overflow-y-auto space-y-1.5 pr-1 structure-scrollbar">
                                            <label v-for="area in unescoAreasPadre" :key="area.sau_id" class="flex items-start gap-2 p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-900 cursor-pointer text-xs">
                                                <input type="checkbox" 
                                                    :value="area.sau_id" 
                                                    v-model="editForm.unesco_areas"
                                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 mt-0.5">
                                                <span class="text-gray-700 dark:text-gray-300 font-medium">({{ area.sau_id }}) {{ area.sau_descripcion }}</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="p-3 border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/30 rounded-lg">
                                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">
                                            2. Subáreas de Conocimiento
                                        </label>
                                        <div v-if="unescoSubareasFiltradas.length > 0" class="max-h-48 overflow-y-auto space-y-1.5 pr-1 structure-scrollbar">
                                            <label v-for="subarea in unescoSubareasFiltradas" :key="subarea.sau_id" class="flex items-start gap-2 p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-900 cursor-pointer text-xs">
                                                <input type="checkbox" 
                                                    :value="subarea.sau_id" 
                                                    v-model="editForm.unesco_areas"
                                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 mt-0.5">
                                                <span class="text-gray-600 dark:text-gray-400">({{ subarea.sau_id }}) {{ subarea.sau_descripcion }}</span>
                                            </label>
                                        </div>
                                        <div v-else class="text-xs text-gray-400 italic p-2">Seleccione un Área para desplegar sus subáreas...</div>
                                    </div>

                                    <div class="p-3 border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/30 rounded-lg">
                                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">
                                            3. Áreas Específicas
                                        </label>
                                        <div v-if="unescoEspecificasFiltradas.length > 0" class="max-h-48 overflow-y-auto space-y-1.5 pr-1 structure-scrollbar">
                                            <label v-for="esp in unescoEspecificasFiltradas" :key="esp.sau_id" class="flex items-start gap-2 p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-900 cursor-pointer text-xs">
                                                <input type="checkbox" 
                                                    :value="esp.sau_id" 
                                                    v-model="editForm.unesco_areas"
                                                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 mt-0.5">
                                                <span class="text-gray-600 dark:text-gray-400">({{ esp.sau_id }}) {{ esp.sau_descripcion }}</span>
                                            </label>
                                        </div>
                                        <div v-else class="text-xs text-gray-400 italic p-2">Seleccione una Subárea para desplegar sus áreas específicas...</div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="p-5 border-t border-gray-100 dark:border-gray-800 flex justify-end gap-3 bg-gray-50/50 dark:bg-gray-900/50">
                    <button @click="cerrarEdicion"
                        class="px-5 py-2.5 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-750 active:scale-95 transition-all duration-150">
                        Cancelar
                    </button>
                    <button @click="guardarEdicion" :disabled="guardando || editForm.objetivos.length === 0"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-brand-600 rounded-xl hover:bg-brand-700 active:scale-95 disabled:opacity-40 disabled:cursor-not-allowed disabled:active:scale-100 shadow-md shadow-brand-500/10 transition-all duration-150 flex items-center gap-2">
                        <span v-if="guardando"
                            class="animate-spin h-4 w-4 border-2 border-white border-t-transparent rounded-full"></span>
                        {{ guardando ? 'Almacenando...' : 'Finalizar y Guardar Cambios' }}
                    </button>
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
            formInt: {
                id_deta_invi_proyect: null,
                horas: 0,
                id_funcion: null,
                idCarr: null,
                reemplazado: 0,
                anexo_integrante: null,
                id_funcion_reemplazado: null,
                horas_reemplazado: 0,
                idCarr_reemplazado: null

            },
            funciones: [],
            carreras: [],
            cedulaBusqueda: '',
            nuevoIntegranteData: null,
            modoNuevo: false,
            archivoSeleccionado: null,
            archivoPreviewName: '',
            uploading: false,
            continuarEnProyecto: true,
            showModalBaja: false,
            integranteBaja: null,
            archivoBaja: null,
            archivoBajaName: '',
            cargandoBaja: false,
            enviando: false,
            // Variables para el modal de edición de proyecto
            showEditModal: false,
            activeTab: 'generales',
            cargandoEdicion: false,
            guardando: false,
            yaTraducido: false,
            objetivosPeiDisponibles: [],
            politicasPlandeDisponibles: [],
            objetivosPoliticasDisponibles: [],
            objetivosODSDisponibles: [],
            facultadesCatalogo: [],
            carrerasCatalogo: [],
            dominiosCatalogo: [],
            convocatoriasCatalogo: [],
            dominioRecomendadoId: '',
            lineasCatalogo: [],
            sublineasCatalogo: [],
            unescoCatalogo: [],
            proyectoEditandoId: null,
            editForm: {
                proyect_nombre: '',
                proyect_titulo: '',
                proyect_nombre_en: '',
                proyect_titulo_en: '',
                proyect_multidis: 0,
                objetivos: [],
                politicas: [],
                ods: [],
                facultades: [],
                id_facultad_priori: '',
                carreras: [],
                id_carr_priori: '',
                dominios_humanisticos: [],
                id_convocatoria: '',
                sublineas_investigacion: [],
                unesco_areas: []
            }

        };
    },
    watch: {
        'editForm.politicas': {
            handler(nuevosIdsSeleccionados) {
                this.actualizarObjetivosPoliticas(nuevosIdsSeleccionados);
            },
            deep: true // deep: true asegura que detecte si se agregan/quitan elementos del array
        },
        'editForm.proyect_multidis'(nuevoValor) {
            if (nuevoValor === 0) {
                this.editForm.facultades = [];
                this.editForm.carreras = [];
            } else if (nuevoValor === 1) {
                if (this.editForm.id_facultad_priori && !this.editForm.facultades.includes(this.editForm.id_facultad_priori)) {
                    this.editForm.facultades.push(this.editForm.id_facultad_priori);
                }
                if (this.editForm.id_carr_priori && !this.editForm.carreras.includes(this.editForm.id_carr_priori)) {
                    this.editForm.carreras.push(this.editForm.id_carr_priori);
                }
            }
            this.obtenerCarrerasPorFacultades();
        },
        'editForm.id_facultad_priori'(nuevoId, viejoId) {
            // Evitamos borrar las carreras durante la carga inicial de abrirEdicion
            if (!this.cargandoEdicion && viejoId) {
                this.editForm.id_carr_priori = '';
                this.editForm.carreras = [];
            }
            this.obtenerCarrerasPorFacultades();
        },
        'editForm.facultades': {
            handler() {
                this.obtenerCarrerasPorFacultades();
            },
            deep: true
        },
        sublineasFiltradas: {
            handler(nuevasSublineas) {
                // Extrae solo los IDs de las sublíneas y los guarda en el form
                this.editForm.sublineas_investigacion = nuevasSublineas.map(sub => sub.id_sublin_investiga);
            },
            deep: true,
            immediate: true
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
        integrantesFiltrados() {
            if (!this.filtroIntegrante) return this.proyectoSeleccionado.invi_detalle_integrante;
            return this.proyectoSeleccionado.invi_detalle_integrante.filter(i => {
                const ced = i.ciinfper_doc || i.ciinfper_est;
                return ced.includes(this.filtroIntegrante);
            });
        },
        funcionesFiltradasSinDireccion() {
            return this.funciones.filter(f => {
                const nombre = f.nombre_funcion.toUpperCase();
                return !nombre.includes('DIRECTOR');
            });
        },
        lineasFiltradas() {
            if (!this.editForm.id_facultad_priori) return [];
            return this.lineasCatalogo.filter(lin => String(lin.idfacultad) === String(this.editForm.id_facultad_priori));
        },
        // Filtra las sublíneas basadas en la Carrera Prioritaria seleccionada
        sublineasFiltradas() {
            if (!this.editForm.id_carr_priori) return [];
            return this.sublineasCatalogo.filter(sub => String(sub.idCarr) === String(this.editForm.id_carr_priori));
        },
        unescoAreasPadre() {
            return this.unescoCatalogo.filter(item => item.tipo_area === 'Área de conocimiento');
        },
        // Muestra las subáreas cuyos padres (sau_pdid) estén seleccionados en el formulario
        unescoSubareasFiltradas() {
            return this.unescoCatalogo.filter(item => {
                return item.tipo_area === 'Subárea de conocimiento' && 
                       this.editForm.unesco_areas.includes(item.sau_pdid);
            });
        },
        // Muestra las áreas específicas cuyas subáreas de procedencia (sau_pdid) estén seleccionadas en el formulario
        unescoEspecificasFiltradas() {
            return this.unescoCatalogo.filter(item => {
                return item.tipo_area === 'Área específica de conocimiento' && 
                       this.editForm.unesco_areas.includes(item.sau_pdid);
            });
        }
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
        getPhotoUrl(ci) {
            // Si no hay CI, retornamos una imagen vacía o un placeholder
            if (!ci) return '';

            const baseURL2 = API.defaults.baseURL;
            // Usamos el timestamp para evitar problemas de caché al cambiar de integrante
            return `${baseURL2}/vin/getFotoDocente/${ci}?t=${new Date().getTime()}`;
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
        handleFileBajaChange(event) {
            const file = event.target.files[0];
            if (!file) return;

            if (file.type !== 'application/pdf') {
                mostraralertas2('Solo se permiten archivos PDF', 'warning');
                this.$refs.fileInputBaja.value = null; // Ref corregido
                return;
            }

            const maxMB = 10;
            if (file.size > maxMB * 1024 * 1024) {
                mostraralertas2(`Archivo muy grande. Máx ${maxMB} MB`, 'warning');
                this.$refs.fileInputBaja.value = null; // Ref corregido
                return;
            }

            this.archivoBaja = file;
            this.archivoBajaName = file.name;
        },
        async uploadarchivo(ci, oldFilename = null) {
            if (!this.archivoSeleccionado) return null; // nada que subir
            try {
                this.uploading = true;
                const form = new FormData();
                form.append('file', this.archivoSeleccionado);
                form.append('ci', ci);
                if (oldFilename) {
                    form.append('old_filename', oldFilename); // Enviamos el nombre del archivo viejo
                }

                // Si tu backend exige otros campos (ej: tipo), añade aquí
                const resp = await API.post(`${this.baseUrl}/subir_archivo_anexo`, form, {
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
        async uploadarchivoBaja(ci, oldFilename = null) {
            if (!this.archivoBaja) return null;
            try {
                this.cargandoBaja = true;
                const form = new FormData();
                form.append('file', this.archivoBaja);
                form.append('ci', ci);

                // Verifica que la URL del backend sea la correcta (que ya creaste en PHP)
                const resp = await API.post(`${this.baseUrl}/subir_archivo_anexo_darbaja`, form, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });

                // IMPORTANTE: Verifica qué devuelve exactamente tu backend. 
                // Si el backend devuelve { status: true, filename: "..." }, úsalo así:
                if (resp && resp.data && resp.data.filename) {
                    const dataRetornada = resp.data;

                    // Limpiamos DESPUÉS de guardar el nombre en una constante
                    this.archivoBaja = null;
                    this.archivoBajaName = '';
                    if (this.$refs.fileInputBaja) this.$refs.fileInputBaja.value = null;

                    return dataRetornada;
                } else {
                    console.error("Respuesta inesperada del servidor:", resp.data);
                    return null;
                }
            } catch (error) {
                console.error("Error en petición Axios:", error);
                return null;
            } finally {
                this.cargandoBaja = false;
            }
        },
        async confirmarInhabilitar() {
            if (!this.archivoBaja || this.cargandoBaja) return;

            try {
                const ciarchvi = this.integranteBaja.ciinfper_doc || this.integranteBaja.ciinfper_est;

                // Esperamos la subida del archivo
                const anexoData = await this.uploadarchivoBaja(ciarchvi);

                if (!anexoData || !anexoData.filename) {
                    mostraralertas2("Error al subir el archivo de respaldo", "error");
                    return;
                }

                // 1. Preparar Payload según lo que espera tu función inhabilitar(Request $request)
                const payload = {
                    id: this.integranteBaja.id_deta_invi_proyect, // Tu controlador usa $request->id
                    anexo_integrante: anexoData.filename
                };

                const resp = await API.post(`${this.baseUrl}/inhabilitar-integrante`, payload);

                if (resp && resp.status === 200) {
                    this.showModalBaja = false;
                    await this.abrirDetallesProyecto(this.proyectoSeleccionado.proyect_id);
                    mostraralertas2("Integrante inhabilitado con éxito", "success");
                }

            } catch (error) {
                console.error("❌ Error completo:", error.response?.data || error);
                mostraralertas2("Error al procesar la baja", "danger");
            }
        },
        async cerraModal() {
            this.cancelarEdicion();
            this.showModalDetalles = false;
        },
        calcularHoras() {
            const funcionObj = this.funciones.find(f => f.id_funcion === this.formInt.id_funcion);
            if (!funcionObj) return;

            const nombre = funcionObj.nombre_funcion.toLowerCase();
            if (nombre.includes('director') && !nombre.includes('sub')) {
                this.formInt.horas = 8;
            } else if (nombre.includes('subdirector')) {
                this.formInt.horas = 6;
            } else {
                this.formInt.horas = 4;
            }
        },
        calcularHorasReemplazo() {
            const funcionObj = this.funciones.find(f => f.id_funcion === this.formInt.id_funcion_reemplazado);
            if (!funcionObj) return;

            const nombre = funcionObj.nombre_funcion.toLowerCase();
            if (nombre.includes('director') && !nombre.includes('sub')) {
                this.formInt.horas_reemplazado = 8;
            } else if (nombre.includes('subdirector')) {
                this.formInt.horas_reemplazado = 6;
            } else {
                this.formInt.horas_reemplazado = 4;
            }
        },
        async abrirDetallesProyecto(id) {
            try {
                const [resProj, resCat] = await Promise.all([
                    API.get(`${this.baseUrl}/invi_proyectos/${id}`),
                    API.get(`${this.baseUrl}/catalogos-integrantes`)
                ]);
                this.proyectoSeleccionado = resProj.data;
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
                id_deta_invi_proyect: int.id_deta_invi_proyect,
                nombre: (int.informacion_personal_d?.NombInfPer || int.informacionpersonal?.NombInfPer),
                apellido: (int.informacion_personal_d?.ApellInfPer || int.informacionpersonal?.ApellInfPer),
                apellidomaterno: (int.informacion_personal_d?.ApellMatInfPer || int.informacionpersonal?.ApellMatInfPer),
                funcion: int.funciones?.nombre_funcion || 'N/A',
                cedula: int.ciinfper_doc || int.ciinfper_est,
            };
            this.formInt = {
                id_deta_invi_proyect: int.id_deta_invi_proyect,
                horas: int.horas,
                id_funcion: int.id_funcion,
                idCarr: int.idCarr,
                reemplazado: 0,
                anexo_integrante: int.anexo_integrante,
                // Campos para el que se queda:
                id_funcion_reemplazado: null,
                horas_reemplazado: 0,
                idCarr_reemplazado: int.idCarr
            };
            this.nuevoIntegranteData = null;
            this.cedulaBusqueda = '';
        },
        async buscarNuevoIntegrante() {
            if (!this.cedulaBusqueda) return;

            // Validación local: No reemplazarse a sí mismo
            if (this.integranteEdit && this.cedulaBusqueda === this.integranteEdit.cedula) {
                mostraralertas2("No puedes reemplazar a un integrante por sí mismo.", "warning");
                return;
            }

            try {
                const res = await API.get(`${this.baseUrl}/buscar-integrantes`, {
                    params: {
                        cedula: this.cedulaBusqueda,
                        proyect_id: this.proyectoSeleccionado.proyect_id,
                        // Si modoNuevo es falso y reemplazado es 1, entonces es un reemplazo real
                        es_reemplazo: (!this.modoNuevo && this.formInt.reemplazado == 1) ? 1 : 0
                    }
                });

                this.nuevoIntegranteData = res.data;
            } catch (e) {
                const mensajeError = e.response?.data?.message || "Error al buscar integrante.";
                mostraralertas2(mensajeError, "warning");
                this.nuevoIntegranteData = null;
                this.cedulaBusqueda = '';
            }
        },
        activarModoNuevo() {
            this.cancelarEdicion();
            this.modoNuevo = true;
        },
        cancelarEdicion() {
            this.integranteEdit = null;
            this.modoNuevo = false;
            this.nuevoIntegranteData = null;
            this.cedulaBusqueda = '';
            this.pdfFile = null;
            this.formInt = { horas: 0, id_funcion: null, idCarr: null, reemplazado: 0 };
        },

        async inhabilitarIntegrante(int) {
            this.integranteBaja = int;
            this.archivoBaja = null;
            this.archivoBajaName = '';
            this.showModalBaja = true;
        },

        async guardarCambios() {
            // 1. Validaciones Previas
            if (!this.formInt.id_funcion || !this.formInt.idCarr) {
                return mostraralertas2("Complete función y carrera.", "warning");
            }

            // Si es nuevo o reemplazo, el archivo es obligatorio
            if ((this.modoNuevo || this.formInt.reemplazado == 1) && !this.archivoSeleccionado && !this.formInt.anexo_integrante) {
                return mostraralertas2("El documento de respaldo PDF es obligatorio.", "warning");
            }
            // 2. Bloqueo de doble clic
            if (this.enviando) return;

            // 2. Validación de Director/Subdirector 
            const funcionSeleccionada = this.funciones.find(f => f.id_funcion === this.formInt.id_funcion);
            const nombreFun = funcionSeleccionada?.nombre_funcion.toUpperCase() || '';

            if (nombreFun.includes('DIRECTOR')) {
                const existeYa = this.integrantesFiltrados.find(i =>
                    i.id_funcion === this.formInt.id_funcion &&
                    i.reemplazado == 0 &&
                    (!this.integranteEdit || i.id_deta_invi_proyect !== this.integranteEdit.id_deta_invi_proyect)
                );

                if (existeYa) {
                    return mostraralertas2(`Ya existe un ${funcionSeleccionada.nombre_funcion} activo en este proyecto.`, "warning");
                }
            }

            try {
                this.enviando = true;
                let anexoData = null;
                const ciABuscar = this.modoNuevo ? this.nuevoIntegranteData.cedula : (this.formInt.reemplazado == 1 ? this.nuevoIntegranteData.cedula : (this.integranteEdit.ciinfper_doc || this.integranteEdit.ciinfper_est));

                // 3. Subir archivo si hay uno nuevo seleccionado
                if (this.archivoSeleccionado) {
                    anexoData = await this.uploadarchivo(ciABuscar);
                    if (!anexoData) {
                        this.enviando = false;
                        return;
                    }
                }

                // 4. Preparar Payload
                const payload = {
                    modo: this.modoNuevo ? 'nuevo' : 'editar',
                    proyect_id: this.proyectoSeleccionado.proyect_id,
                    id_deta_invi_proyect: this.integranteEdit?.id_deta_invi_proyect,
                    form: {
                        ...this.formInt,
                        cedula_nueva: this.nuevoIntegranteData?.cedula,
                        tipo_nuevo: this.nuevoIntegranteData?.tipo,
                        // Si es reemplazo, el archivo va a 'anexo_integrante' (el que entra)
                        anexo_integrante: (this.formInt.reemplazado == 1 && anexoData) ? anexoData.filename : this.formInt.anexo_integrante,
                        // Si es nuevo o edición simple, va a 'anexo_integrante2'
                        anexo_integrante2: (this.formInt.reemplazado == 0 && anexoData) ? anexoData.filename : this.formInt.anexo_integrante2
                    },
                    reemplazo_config: {
                        mantener_docente: this.continuarEnProyecto,
                        // Si el docente se queda, enviamos los datos del combo de edición que el usuario ajustó
                        nueva_funcion_reemplazado: this.formInt.id_funcion_reemplazado,
                        nuevas_horas_reemplazado: this.formInt.horas_reemplazado
                    }
                };

                const res = await API.post(`${this.baseUrl}/integrantes/guardar`, payload);

                if (res.data.status) {
                    mostraralertas2("Cambios guardados correctamente", "success");
                    this.cancelarEdicion() // O recargar la lista
                    await this.abrirDetallesProyecto(this.proyectoSeleccionado.proyect_id);
                    // Aquí deberías refrescar la lista de integrantes del proyecto
                }
            } catch (error) {
                mostraralertas2(error.response?.data?.message || "Error al procesar la solicitud", "danger");
            } finally {
                this.enviando = false; // Liberamos el botón siempre, sea éxito o error
            }
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
        handleFacultadPrioriChange() {
            if (this.editForm.proyect_multidis === 1 && this.editForm.id_facultad_priori) {
                // Si no existe dentro del array de facultades, la añadimos
                if (!this.editForm.facultades.includes(this.editForm.id_facultad_priori)) {
                    this.editForm.facultades.push(this.editForm.id_facultad_priori);
                }
            }
        },
        handleCarreraPrioriChange() {
            if (this.editForm.proyect_multidis === 1 && this.editForm.id_carr_priori) {
                if (!this.editForm.carreras.includes(this.editForm.id_carr_priori)) {
                    this.editForm.carreras.push(this.editForm.id_carr_priori);
                }
            }
        },
        async obtenerCarrerasPorFacultades() {
            let facultadesIds = [];

            if (this.editForm.proyect_multidis === 1) {
                facultadesIds = [...this.editForm.facultades];
            } else if (this.editForm.id_facultad_priori) {
                facultadesIds = [this.editForm.id_facultad_priori];
            }

            if (facultadesIds.length === 0) {
                this.carrerasCatalogo = [];
                return;
            }

            try {
                // Genera promesas dinámicas usando el endpoint existente
                const promesas = facultadesIds.map(id => API.get(`${this.baseUrl}/getCarrerasFacultad/${id}`));

                const respuestas = await Promise.all(promesas);

                let unificado = [];
                respuestas.forEach(res => {
                    if (res.data && res.data.data) {
                        unificado = [...unificado, ...res.data.data];
                        console.log(res.data.data);
                    }
                });

                // Evitar posibles duplicados por idCarr
                this.carrerasCatalogo = unificado.filter((item, index, self) =>
                    index === self.findIndex((t) => t.id_carrera === item.id_carrera)
                );
            } catch (error) {
                console.error("Error cargando el catálogo de carreras:", error);
            }
        },
        actualizarObjetivosPoliticas(politicasSeleccionadasIds) {
            // Si el array está vacío o no existe, limpiamos los objetivos
            if (!politicasSeleccionadasIds || politicasSeleccionadasIds.length === 0) {
                this.objetivosPoliticasDisponibles = [];
                return;
            }

            // Usamos un Map para evitar duplicados en caso de que 
            // dos políticas apunten al mismo objetivo
            const objetivosUnicos = new Map();

            // Recorremos las políticas que cargamos desde el backend
            this.politicasPlandeDisponibles.forEach(politica => {
                // Si el ID de esta política está dentro de los seleccionados en el form...
                if (politicasSeleccionadasIds.includes(politica.id_pol_pladne)) {
                    // Y si la política trae su objeto de relación (objetivos_plandne)
                    if (politica.objetivos_plandne) {
                        const objetivo = politica.objetivos_plandne;
                        // Lo agregamos al Map usando su ID como llave
                        if (!objetivosUnicos.has(objetivo.id_obj_pol_pladne)) {
                            objetivosUnicos.set(objetivo.id_obj_pol_pladne, objetivo);
                        }
                    }
                }
            });

            // Finalmente, convertimos los valores únicos del Map a un Array
            this.objetivosPoliticasDisponibles = Array.from(objetivosUnicos.values());
        },
        async abrirEdicion(id) {
            this.proyectoEditandoId = id;
            this.showEditModal = true;
            this.cargandoEdicion = true;
            this.activeTab = 'generales';
            this.yaTraducido = false;

            try {
                // Asegúrate de crear esta ruta en tus routes/api.php de Laravel
                const response = await API.get(`${this.baseUrl}/getEdicionDatos/${id}`);
                const data = response.data;

                this.objetivosPeiDisponibles = data.objetivos_pei;
                this.politicasPlandeDisponibles = data.politicas_plandne || [];
                this.objetivosPoliticasDisponibles = data.objetivos_politicas_seleccionadas || [];
                this.objetivosODSDisponibles = data.ods || [];
                this.facultadesCatalogo = data.facultades_catalogo || [];
                this.dominiosCatalogo = data.dominios_catalogo || [];
                this.convocatoriasCatalogo = data.convocatorias_catalogo || [];
                this.lineasCatalogo = data.lineas_catalogo || [];
                this.sublineasCatalogo = data.sublineas_catalogo || [];
                this.unescoCatalogo = data.unesco_catalogo || [];

                this.editForm = {
                    proyect_nombre: data.proyecto.proyect_nombre || '',
                    proyect_titulo: data.proyecto.proyect_titulo || '',
                    proyect_nombre_en: data.proyecto.proyect_nombre_en || '',
                    proyect_titulo_en: data.proyecto.proyect_titulo_en || '',
                    proyect_multidis: data.proyecto.proyect_multidis,
                    objetivos: data.seleccionados || [],
                    politicas: data.politicas_seleccionadas || [],
                    ods: data.ods_seleccionadas || [],
                    facultades: data.facultades_seleccionadas || [],
                    id_facultad_priori: data.id_facultad_priori || '',
                    carreras: data.carreras_seleccionadas || [],
                    id_carr_priori: data.id_carr_priori || '',
                    dominios_humanisticos: data.dominios_seleccionados || [],
                    id_convocatoria: data.proyecto.id_convocatoria || '',
                    sublineas_investigacion: [],
                    unesco_areas: data.unesco_seleccionadas || []
                };
            } catch (error) {
                mostraralertas2('Error al cargar datos del proyecto', 'error');
                this.cerrarEdicion();
            } finally {
                this.cargandoEdicion = false;
            }
        },
        toggleObjetivo(id_obj) {
            const index = this.editForm.objetivos.indexOf(id_obj);
            if (index > -1) {
                this.editForm.objetivos.splice(index, 1); // Deseleccionar
            } else {
                this.editForm.objetivos.push(id_obj); // Seleccionar
            }
        },
        togglePolitica(id_pol) {
            const index = this.editForm.politicas.indexOf(id_pol);
            if (index > -1) {
                this.editForm.politicas.splice(index, 1); // Deseleccionar
            } else {
                this.editForm.politicas.push(id_pol); // Seleccionar
            }
        },
        toggleODS(id_ods) {
            const index = this.editForm.ods.indexOf(id_ods);
            if (index > -1) {
                this.editForm.ods.splice(index, 1); // Deseleccionar
            } else {
                this.editForm.ods.push(id_ods); // Seleccionar
            }
        },
        toggleDominio(id) {
            const index = this.editForm.dominios_humanisticos.indexOf(id);
            if (index > -1) {
                this.editForm.dominios_humanisticos.splice(index, 1);
            } else {
                this.editForm.dominios_humanisticos.push(id);
            }
        },
        recomendarDominio() {
            if (this.dominiosCatalogo.length === 0) return;

            // Concatenamos el contexto lingüístico del proyecto actual
            const textoProyecto = `${this.editForm.proyect_titulo} ${this.editForm.proyect_nombre}`.toLowerCase();

            // Mapeo básico nativo de palabras clave por carreras seleccionadas para robustecer la búsqueda
            // (por ejemplo, si tiene carreras de salud o educación, asocia tokens humanísticos)
            let palabrasAdicionales = "";
            this.editForm.carreras.forEach(carrId => {
                const carreraObj = this.carrerasCatalogo.find(c => c.id_carrera === carrId);
                if (carreraObj) palabrasAdicionales += ` ${carreraObj.nombre_carrera.toLowerCase()}`;
            });

            const contextoCompleto = (textoProyecto + palabrasAdicionales);

            let mejorDominioId = null;
            let maxCoincidencias = -1;

            // Analizamos cada dominio del catálogo buscando la mayor densidad de coincidencia léxica
            this.dominiosCatalogo.forEach(dom => {
                const detalle = dom.detalle_dom_huma.toLowerCase();

                // Dividimos el nombre del dominio en palabras clave ignorando conectores cortos (< 4 letras)
                const palabrasClave = detalle.split(/\s+/).filter(palabra => palabra.length > 4);

                let coincidencias = 0;
                palabrasClave.forEach(palabra => {
                    // Quitamos sufijos comunes para una coincidencia flexible (por ejemplo: "educación" -> "educac")
                    const raiz = palabra.substring(0, palabra.length - 2);
                    if (contextoCompleto.includes(raiz)) {
                        coincidencias++;
                    }
                });

                if (coincidencias > maxCoincidencias && coincidencias > 0) {
                    maxCoincidencias = coincidencias;
                    mejorDominioId = dom.id_dom_huma;
                }
            });

            if (mejorDominioId) {
                this.dominioRecomendadoId = mejorDominioId;

                // Si el usuario no lo tiene seleccionado, lo agregamos automáticamente
                if (!this.editForm.dominios_humanisticos.includes(mejorDominioId)) {
                    this.editForm.dominios_humanisticos.push(mejorDominioId);
                }
                mostraralertas2('Se ha sugerido y marcado el dominio más compatible con el proyecto.', 'success');
            } else {
                // Fallback genérico si es muy abstracto: sugerir el primer dominio del catálogo
                this.dominioRecomendadoId = this.dominiosCatalogo[0].id_dom_huma;
                if (!this.editForm.dominios_humanisticos.includes(this.dominioRecomendadoId)) {
                    this.editForm.dominios_humanisticos.push(this.dominioRecomendadoId);
                }
                mostraralertas2('Dominio sugerido basándose en el alcance social estándar.', 'success');
            }
        },
        async traducirTextos() {
            if (!this.editForm.proyect_nombre && !this.editForm.proyect_titulo) {
                mostraralertas2('No hay textos para traducir', 'warning');
                return;
            }

            mostraralertas2('Traduciendo textos...', 'info');

            try {
                // Traducción del Nombre del Proyecto
                if (this.editForm.proyect_nombre) {
                    const urlNombre = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=es&tl=en&dt=t&q=${encodeURIComponent(this.editForm.proyect_nombre)}`;
                    const resNombre = await fetch(urlNombre);
                    const dataNombre = await resNombre.json();
                    // Google retorna fragmentos en un array anidado. Los unimos por seguridad.
                    this.editForm.proyect_nombre_en = dataNombre[0].map(item => item[0]).join('');
                }

                // Traducción del Título del Proyecto
                if (this.editForm.proyect_titulo) {
                    const urlTitulo = `https://translate.googleapis.com/translate_a/single?client=gtx&sl=es&tl=en&dt=t&q=${encodeURIComponent(this.editForm.proyect_titulo)}`;
                    const resTitulo = await fetch(urlTitulo);
                    const dataTitulo = await resTitulo.json();
                    this.editForm.proyect_titulo_en = dataTitulo[0].map(item => item[0]).join('');
                }
                this.yaTraducido = true;
                mostraralertas2('Traducción completada con éxito', 'success');
            } catch (error) {
                console.error("Error en traducción:", error);
                mostraralertas2('Error al conectar con el servicio de traducción', 'error');
            }
        },

        async guardarEdicion() {
            if (this.editForm.objetivos.length === 0) return;
            if (!this.editForm.id_facultad_priori) {
                mostraralertas2('Debe seleccionar una facultad prioritaria obligatoriamente.', 'error');
                return;
            }
            if (!this.editForm.id_carr_priori) {
                mostraralertas2('Debe seleccionar una carrera prioritaria obligatoriamente.', 'error');
                return;
            }
            if (this.editForm.dominios_humanisticos.length === 0) {
                mostraralertas2('Debe seleccionar al menos un dominio humanístico.', 'error');
                return;
            }
            if (!this.editForm.id_convocatoria) {
                mostraralertas2('Debe seleccionar una convocatoria obligatoriamente.', 'error');
                return;
            }

            this.guardando = true;
            try {
                // Asegúrate de crear esta ruta (PUT/POST) en tus routes/api.php de Laravel
                await API.put(`${this.baseUrl}/invi_proyectos/${this.proyectoEditandoId}`, this.editForm);

                mostraralertas2('Proyecto actualizado correctamente', 'success');
                this.cerrarEdicion();
                this.actualizar(); // Refresca tu tabla principal
            } catch (error) {
                mostraralertas2('Error al guardar los cambios', 'error');
            } finally {
                this.guardando = false;
            }
        },
        cerrarEdicion() {
            this.showEditModal = false;
            this.proyectoEditandoId = null;
            this.yaTraducido = false;
            this.unescoCatalogo = [];
            this.editForm = {
                proyect_nombre: '',
                proyect_titulo: '',
                nombre_en: '',
                titulo_en: '',
                objetivos: [],
                politicas: [],
                ods: [],
                facultades: [],
                id_facultad_priori: '',
                carreras: [],
                id_carr_priori: '',
                dominios_humanisticos: [],
                id_convocatoria: '',
                sublineas_investigacion: [],
                unesco_areas: []
            };
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
