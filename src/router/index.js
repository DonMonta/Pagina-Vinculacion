import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import NoticiasView from '../views/NoticiasView.vue'
import EquiposView from '../views/EquiposView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/noticias',
    name: 'noticias',
    component: NoticiasView
  },
  {
    path: '/equipo',
    name: 'equipo',
    component: EquiposView
  },
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: 'active',
})

export default router
