<template>
  <index/>
</template>
<script>
// @ is an alias to /src
import Home from '@/components/home/PageHome.vue'
import index from '@/components/pages/index.vue'
export default {
  name: 'PageHomeView',
  components: {
    Home,
    index
  }
}
</script>