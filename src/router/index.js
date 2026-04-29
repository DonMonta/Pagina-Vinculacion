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
import ProyectosView from '../views/Admin/Proyectos/Lista_Proyectos/ProyectosView.vue'


const routes = [
  {
    path: '/home',
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
    path: '/site-login',
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
  {
    path: '/site-admin/proyectos',
    name: 'site-admin-proyectos',
    component: ProyectosView
  },

  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: 'active',
})

export default router
