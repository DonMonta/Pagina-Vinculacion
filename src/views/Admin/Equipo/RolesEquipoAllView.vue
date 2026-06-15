<template>
  <AdminLayout>
    <PageBreadcrumb :pageTitle="currentPageTitle" />
    <div class="space-y-5 sm:space-y-6">

      <RolesEquipo_Vin />

    </div>
  </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import PageBreadcrumb from "@/components/common/PageBreadcrumb.vue";
import AdminLayout from "@/components/layout/AdminLayout.vue";
//import ComponentCard from "@/components/common/ComponentCard.vue";
import RolesEquipo_Vin from "@/components/admin/mantenimiento/equipo_vin/RolesEquipo_Vin.vue";
const currentPageTitle = ref("Roles del Equipo de Vinculación");
</script>
