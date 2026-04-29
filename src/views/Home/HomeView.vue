<template>
  <shadow-root>
    <div class="pagehome">
      <component is="style" v-html="bootstrapStyles2"></component>
      <Home />
      <index />
    </div>
  </shadow-root>
</template>
<script>
// @ is an alias to /src
import Home from '@/components/home/PageHome.vue'
import index from '@/components/index.vue'
import stylos from '@/assets/styles/css/style.css'
export default {
  name: 'PageHomeView',
  components: {
    Home,
    index
  },
  data() {
    return {
      bootstrapStyles: stylos,
      bootstrapStyles2: require('@/assets/styles/css/bootstrap.min.css').default
      
    }
  }
}
</script>