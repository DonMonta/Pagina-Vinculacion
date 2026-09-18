
import { createStore } from 'vuex'

export default createStore({
  state: {
    role: localStorage.getItem('Rol_vinc') || null,
    email: localStorage.getItem('email_vinc') || null,
    idusu: localStorage.getItem('id_vinc') || null,
    name: localStorage.getItem('name_vinc') || null,
    carrera: localStorage.getItem('carrera_vinc') || null,
    nivel: localStorage.getItem('nivel_vinc') || null,
    idcarrera: localStorage.getItem('idcarrera_vinc') || null,
    facultad: localStorage.getItem('facultad_vinc') || null,
    token: localStorage.getItem('token_vinc') || null,
    token_type: localStorage.getItem('token_type_vinc') || null,
    proyectos_ids: JSON.parse(localStorage.getItem('proyectos_ids_vinc') || '[]'),
    proyectos_detalles: JSON.parse(localStorage.getItem('proyectos_detalles_vinc') || '[]'),
  },
  getters: {
    getIdusu: state => state.idusu,
    getEmail: state => state.email,
    getName: state => state.name,
    getCarrera: state => state.carrera,
    getNivel: state => state.nivel,
    getIdcarrera: state => state.idcarrera,
    getFacultad: state => state.facultad,
    getRole: state => state.role,
    isAuthenticated: state => !!state.token,
    getFullToken: state => `${state.token_type} ${state.token}`,
    getProyectosIds: state => state.proyectos_ids,
    getProyectosDetalles: state => state.proyectos_detalles,
  },
  mutations: {
    setRol_vinc(state, nuevoRol) {
      state.role = nuevoRol;
      localStorage.setItem('Rol_vinc', nuevoRol);
    },
    setemail_vinc(state, nuevoemail) {
      state.email = nuevoemail;
      localStorage.setItem('email_vinc', nuevoemail);
    },
    setid_vinc(state, nuevoid) {
      state.idusu = nuevoid;
      localStorage.setItem('id_vinc', nuevoid);
    },
    setname_vinc(state, nuevoname) {
      state.name = nuevoname;
      localStorage.setItem('name_vinc', nuevoname);
    },
    setToken_vinc(state, token) {
      state.token = token;
      localStorage.setItem('token_vinc', token);
    },
    setTokenType_vinc(state, type) {
      state.token_type = type;
      localStorage.setItem('token_type_vinc', type);
    },
    setCarrera_vinc(state, carrera) {
      state.carrera = carrera;
      localStorage.setItem('carrera_vinc', carrera);
    },
    setNivel_vinc(state, nivel) {
      state.nivel = nivel;
      localStorage.setItem('nivel_vinc', nivel);
    },
    setIdcarrera_vinc(state, idcarrera) {
      state.idcarrera = idcarrera;
      localStorage.setItem('idcarrera_vinc', idcarrera);
    },
    setFacultad_vinc(state, facultad) {
      state.facultad = facultad;
      localStorage.setItem('facultad_vinc', facultad);
    },
    setProyectosIds_vinc(state, ids) {
      state.proyectos_ids = ids || [];
      localStorage.setItem('proyectos_ids_vinc', JSON.stringify(ids || []));
    },
    setProyectosDetalles_vinc(state, detalles) {
      state.proyectos_detalles = detalles || [];
      localStorage.setItem('proyectos_detalles_vinc', JSON.stringify(detalles || []));
    },
    logout_vinc(state) {
      // Limpia el state y localStorage al cerrar sesión
      state.role = null;
      state.email = null;
      state.idusu = null;
      state.name = null;
      state.token = null;
      state.token_type = null;
      state.proyectos_ids = [];
      state.proyectos_detalles = [];
      localStorage.removeItem('Rol_vinc');
      localStorage.removeItem('email_vinc');
      localStorage.removeItem('id_vinc');
      localStorage.removeItem('name_vinc');
      localStorage.removeItem('token_vinc');
      localStorage.removeItem('token_type_vinc');
      localStorage.removeItem('user_vinc');
      localStorage.removeItem('carrera_vinc');
      localStorage.removeItem('nivel_vinc');
      localStorage.removeItem('idcarrera_vinc');
      localStorage.removeItem('facultad_vinc');
      localStorage.removeItem('proyectos_ids_vinc');
      localStorage.removeItem('proyectos_detalles_vinc');
    },
  },
  actions: {},
  modules: {}
})
