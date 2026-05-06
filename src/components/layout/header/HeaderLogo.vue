<template>
  <router-link to="/site-admin" class="lg:hidden">
    <img class="dark:hidden" src="@/assets/img/logo-icon.svg" alt="Logo" />
    <img class="hidden dark:block" src="@/assets/img/logo-icon.svg" alt="Logo" />
  </router-link>
</template>

<script setup>
import { RouterLink } from 'vue-router'
</script>
