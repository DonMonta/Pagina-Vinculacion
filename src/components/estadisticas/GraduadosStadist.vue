<template>
  <div
    class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
    <div class="flex flex-col gap-5 mb-6 sm:flex-row sm:justify-between">
      <div class="w-full">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Estadísticas de Graduados</h3>
        <p class="mt-1 text-gray-500 text-theme-sm dark:text-gray-400">
          Aquí puedes ver las estadísticas de graduados registrados en el periodo lectivo seleccionado.
        </p>
      </div>
    </div>
    <div
      class="flex flex-col sm:flex-row items-start sm:items-center gap-3 p-4 rounded-xl border border-gray-100 dark:border-gray-800 bg-gray-50/40 dark:bg-transparent">
      <div class="w-full sm:w-72">
        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-1.5">Seleccionar
          Periodo Lectivo</label>
        <select v-model="periodoSeleccionado" @change="cargarEstadisticasPeriodo"
          class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-700 text-gray-800 dark:text-white focus:outline-none focus:border-brand-500">
          <option value="" disabled>-- Escoja un periodo --</option>
          <option v-for="per in listaPeriodos" :key="per.idper" :value="per.idper">
            {{ per.DescPerLec }}
          </option>
        </select>
      </div>
      <div v-if="periodoMetricasData?.datos_periodo" class="text-xs text-gray-500 sm:mt-5">
        Código del Periodo Académico: <span
          class="font-bold text-gray-800 dark:text-white bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">{{
            periodoMetricasData.datos_periodo.codigo_academico }}</span>
      </div>
    </div>

    <div v-if="cargandoEstadisticasPeriodo" class="text-center py-12 text-gray-500 text-sm">
      Buscando y mapeando métricas del periodo...
    </div>
    <div v-else-if="!periodoSeleccionado" class="flex flex-col items-center justify-center py-12 text-gray-400 text-sm">
      <svg class="w-12 h-12 stroke-1 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      Seleccione un periodo de la lista superior para procesar la gráfica.
    </div>
    <div v-else-if="periodoMetricasData?.total_graduados === 0" class="text-center py-12 text-gray-500 text-sm">
      No se registran datos de graduados ni encuestas finalizadas en el periodo lectivo seleccionado.
    </div>
    <div v-else class="p-5 rounded-2xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-transparent">
      <div class="mb-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
        <div>
          <h4 class="text-base font-bold text-gray-900 dark:text-white">Distribución de Graduados por Facultades</h4>
          <p class="text-xs text-gray-400 mt-0.5">Métricas calculadas dinámicamente en base a actas registradas</p>
        </div>
        <div class="text-right">
          <span class="text-xs text-gray-400 block">Total Graduados</span>
          <span class="text-lg font-black text-brand-600 dark:text-brand-400">{{
            periodoMetricasData?.total_graduados }}</span>
        </div>
      </div>

      <div class="max-w-full overflow-x-auto custom-scrollbar">
        <div class="-ml-4 min-w-[800px] xl:min-w-full pl-2">
          <apexchart type="area" height="310" :options="periodoChartOptions" :series="periodoChartSeries" />
        </div>
      </div>
    </div>
  </div>
</template>

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
      // Datos Tab 3 (Periodos)
      listaPeriodos: [],
      periodoSeleccionado: "",
      cargandoEstadisticasPeriodo: false,
      periodoMetricasData: null,
      periodoChartSeries: [],
      periodoChartOptions: {},
      baseChartOptions: {
        legend: { show: false, position: 'top', horizontalAlign: 'left' },
        colors: ['#465FFF', '#9CB9FF'],
        chart: {
          fontFamily: 'Outfit, sans-serif',
          type: 'area',
          toolbar: { show: false }
        },
        fill: {
          gradient: { enabled: true, opacityFrom: 0.55, opacityTo: 0 }
        },
        stroke: { curve: 'straight', width: [2, 2] },
        markers: { size: 0 },
        dataLabels: { enabled: false },
        grid: {
          xaxis: { lines: { show: false } },
          yaxis: { lines: { show: true } }
        },
        xaxis: {
          type: 'category',
          axisBorder: { show: false },
          axisTicks: { show: false },
          tooltip: { enabled: false }
        },
        yaxis: {
          title: { style: { fontSize: '0px' } }
        }
      }
    };
  },
  async mounted() {
    await this.cargarListaDePeriodos();
    this.cargarEstadisticasPeriodo();
  },
  methods: {
    async cargarListaDePeriodos() {
      try {
        const response = await API.get(`${this.baseUrl}/getPeriodosLectivos?all=true`);
        this.listaPeriodos = response.data.data;
      } catch (error) {
        console.error("Error recuperando catálogo de periodos", error);
      }
    },
    async cargarEstadisticasPeriodo() {
      if (!this.periodoSeleccionado) return;
      this.cargandoEstadisticasPeriodo = true;
      try {
        const response = await API.get(`${this.baseUrl}/getGraduadosPorPeriodo/${this.periodoSeleccionado}`);
        this.periodoMetricasData = response.data;

        if (this.periodoMetricasData && this.periodoMetricasData.total_graduados > 0) {
          
          // MAPEO POR FACULTAD: Extraemos el nombre o las siglas para las etiquetas del eje X
          // Nota: Puedes usar 'f.siglas' en lugar de 'f.facultad' si los nombres son demasiado largos para el gráfico
          const etiquetasFacultades = this.periodoMetricasData.distribucion_por_facultad.map(f => f.siglas);
          const cantidades = this.periodoMetricasData.distribucion_por_facultad.map(f => f.cantidad_graduados);

          this.periodoChartSeries = [{
            name: 'Graduados',
            data: cantidades
          }];

          this.periodoChartOptions = {
            ...this.baseChartOptions,
            xaxis: {
              ...this.baseChartOptions.xaxis,
              categories: etiquetasFacultades
            }
          };
        }
      } catch (error) {
        console.error("Error al consultar estadísticas del periodo", error);
      } finally {
        this.cargandoEstadisticasPeriodo = false;
      }
    },
  },
};

</script>