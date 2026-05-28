<template>
  <AdminLayout>
    <div class="space-y-5 sm:space-y-6">

      <examencate />

    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import PageBreadcrumb from "@/components/common/PageBreadcrumb.vue";
import AdminLayout from "@/components/layout/AdminLayout.vue";
//import ComponentCard from "@/components/common/ComponentCard.vue";
import examencate from "@/components/admin/mantenimiento/formularios/catedra/examen/examencate.vue";
const currentPageTitle = ref("Formulario Cátedra");
</script>
