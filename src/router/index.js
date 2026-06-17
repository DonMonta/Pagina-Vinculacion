import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home/HomeView.vue'
import NoticiasView from '../views/Pages/NoticiasView.vue'
import EquiposView from '../views/Pages/EquiposView.vue'
import NormativasView from '../views/Pages/NormativasView.vue'
import ProyectosNuevosView from '../views/Pages/ProyectosNuevosView.vue'

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
  {
    path: '/normativas',
    name: 'normativas',
    component: NormativasView
  },
  {
    path: '/proyectosnuevos',
    name: 'proyectosnuevos',
    component: ProyectosNuevosView
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
