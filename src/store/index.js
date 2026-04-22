import { createStore } from 'vuex'

export default createStore({
  state: {
    role: localStorage.getItem('Rol_vinc') || null,
    email: localStorage.getItem('email_vinc') || null,
    idusu: localStorage.getItem('id_vinc') || null,
    name: localStorage.getItem('name_vinc') || null,
    token: localStorage.getItem('token_vinc') || null,
    token_type: localStorage.getItem('token_type_vinc') || null,
  },
  getters: {
    getIdusu: state => state.idusu,
    isAuthenticated: state => !!state.token,
    getFullToken: state => `${state.token_type} ${state.token}`,
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
    logout_vinc(state) {
      // Limpia el state y localStorage al cerrar sesión
      state.role = null;
      state.email = null;
      state.idusu = null;
      state.name = null;
      state.token = null;
      state.token_type = null;

      localStorage.removeItem('Rol_vinc');
      localStorage.removeItem('email_vinc');
      localStorage.removeItem('id_vinc');
      localStorage.removeItem('name_vinc');
      localStorage.removeItem('token_vinc');
      localStorage.removeItem('token_type_vinc');
      localStorage.removeItem('user_vinc');
    },
  },
  actions: {},
  modules: {}
})
