import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home/HomeView.vue'
import NoticiasView from '../views/NoticiasView.vue'
import EquiposView from '../views/EquiposView.vue'
import NormativasView from '../views/NormativasView.vue'
import ProyectosNuevosView from '../views/ProyectosNuevosView.vue'
import LoginView from '../views/LoginView.vue'
import Error404View from '../views/Erro404View.vue'
import DashUiView from '../views/DashUiView.vue'
import PeiAllView from '../views/Admin/Mantenimiento/Op_Pei/PeiAllView.vue'
import PlandneAllView from '../views/Admin/Mantenimiento/Op_PLANDE/PlandneAllView.vue'


const routes = [
  {
    path: '/site',
    name: 'site',
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
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/error404',
    name: 'error404',
    component: Error404View
  },
   {
    path: '/site-admin',
    name: 'site-admin',
    component: DashUiView
  },
  {
    path: '/site-admin/pei',
    name: 'site-admin-pei',
    component: PeiAllView
  },
  {
    path: '/site-admin/plandne',
    name: 'site-admin-plandne',
    component: PlandneAllView
  },

  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: 'active',
})

export default router
