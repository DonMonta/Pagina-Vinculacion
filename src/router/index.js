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
import Agenda_ODSAllView from '../views/Admin/Mantenimiento/Op_Agenda_ODS/Agenda_ODSAllView.vue'
import FormCatedraAllView from '../views/Admin/Formulario/Cátedra/Form_CatedraAllView.vue'
import PerfilAllView from '../views/Estudiante/Perfil/PerilAllView.vue'
import InscripcionCatedraAllView from '../views/Admin/Formulario/Cátedra/Inscripcion/Inscripcion_CatedraAllView.vue'
import ExamenCatedraAllView from '../views/Admin/Formulario/Cátedra/Examen/Examen_CatedraAllView.vue'
import DominioAcademicoAllView from '../views/Admin/Mantenimiento/Op_dominio_Aca/Dom_AcademicoAllView.vue'
import LinInvestigaAllView from '../views/Admin/Mantenimiento/Op_Lin_Inves/Lin_InvestigaAllView.vue'


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
  {
    path: '/site-admin/agenda_ods',
    name: 'site-admin-agenda_ods',
    component: Agenda_ODSAllView
  },
  {
    path: '/site-admin/formulario_catedra',
    name: 'site-admin-formulario_catedra',
    component: FormCatedraAllView
  },
  {
    path: '/site-admin/perfil',
    name: 'perfil',
    component: PerfilAllView
  },
  {
    path: '/site-admin/formulario_catedra/inscripcion',
    name: 'site-admin-formulario_catedra-inscripcion',
    component: InscripcionCatedraAllView
  },
  {
    path: '/site-admin/formulario_catedra/examen',
    name: 'site-admin-formulario_catedra-examen',
    component: ExamenCatedraAllView
  },
  {
    path: '/site-admin/dominio_academico',
    name: 'site-admin-dominio_academico',
    component: DominioAcademicoAllView
  },
  {
    path: '/site-admin/linea_investigacion',
    name: 'site-admin-linea_investigacion',
    component: LinInvestigaAllView
  },

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: 'active',
})

export default router
