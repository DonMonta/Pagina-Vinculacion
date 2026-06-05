<template>
  <admin-layout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">
      <div class="col-span-12 space-y-6 xl:col-span-7">
        <ecommerce-metrics />
      </div>
      <div class="col-span-12">
        <graduados-stadist />
      </div>
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from '../components/layout/AdminLayout.vue'
import EcommerceMetrics from '../components/estadisticas/ProyectoStadist.vue'
import GraduadosStadist from '@/components/estadisticas/GraduadosStadist.vue';
export default {
  components: {
    AdminLayout,
    EcommerceMetrics,
    GraduadosStadist,
  },
  name: 'DashUiView',
}
</script>
