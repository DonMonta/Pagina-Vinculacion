import axios from 'axios';

export default {
  data() {
    return {
      emaillo: "",
      clave: "",
      url2: "http://vinculacion.test/api/vin/auth/login",
    };
  },
  methods: {
    async login() {
      const data = {
        email: this.emaillo,
        password: this.clave,
      };
      try {
        const response = await axios.post(this.url2, data);
        
          const token = response.data.token;
          const token_type = response.data.token_type;
          localStorage.setItem("token", token);
          localStorage.setItem("token_type", token_type);
          window.location.href = "/error404";
        
      } catch (error) {
        if(error.response) {
          console.error("Error en la solicitud:", error.response.data);
          alert("Error en la solicitud: " + error.response.data.message);
        }else {
          console.error("Error:", error.message);
          alert("Error: " + error.message);
        }
      }
    }
  },
};
