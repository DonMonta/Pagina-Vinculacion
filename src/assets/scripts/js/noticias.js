
import axios from 'axios';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import localizedFormat from 'dayjs/plugin/localizedFormat';
import 'dayjs/locale/es';

dayjs.extend(relativeTime);
dayjs.extend(localizedFormat);
dayjs.locale('es');
export default {
    data() {
        return {
            publicaciones: [],
            publicacionPrincipal: null,
            publicacionsecundaria: null,
            publicaciontercera: null,
            publiacioncuarta: null,
            publiacionquinta: null,
            publiacionsexta: null,
            publiacionseptima: null,
            publiacionoctava: null,
            estadisticas: null,
            noticiaSeleccionada: null,
            activeNav: "",
            pageId: '708979342294904',
            accessToken: 'EAAUbvwr8S4UBRHEQUtdPWZAKbQ2MKHmx1em59WdkxztN9KfkWIEdVLQNZCeJDZCLmGZCl9mFhLizApMZAZBvYrgh30qXEUbjzZB8QLoDN7ZCTRh4ZAGHsh3OmIE7ZAp9rZCTZA0zGaFOUxgZCdfjDKJ5Abyz1HjLev09qXiNQmqaS2ESH5uOIbhL3AL8pX3UIn8SQ3ZCBN5Gt9BJe8',
        };
    },
    async mounted() {
        await this.cargarPublicacionesFacebook2();
        await this.cargarPublicacionesFacebook();
    },
    methods: {
        async cargarPublicacionesFacebook2() {
            try {
                const response = await fetch(`https://graph.facebook.com/v17.0/${this.pageId}/posts?fields=message,created_time,full_picture,permalink_url&access_token=${this.accessToken}`);
                const data = await response.json();

                if (data && data.data) {
                    this.publicaciones = data.data;
                    this.publicacionPrincipal = this.publicaciones[0];
                    this.publicacionsecundaria = this.publicaciones[1];
                    this.publicaciontercera = this.publicaciones[2];
                    this.publiacioncuarta = this.publicaciones[3];
                    this.publiacionquinta = this.publicaciones[4];
                    this.publiacionsexta = this.publicaciones[5];
                    this.publiacionseptima = this.publicaciones[6];
                    this.publiacionoctava = this.publicaciones[7];
                } else {
                    console.error('No se encontraron publicaciones o el formato de datos es incorrecto.');
                }
            } catch (error) {
                console.error('Error al cargar las publicaciones de Facebook:', error);
            }
        },
        formatearFechaInteligente(fechaIso) {
            const fecha = dayjs(fechaIso);
            const ahora = dayjs();

            // Si fue hoy o ayer, usar 'hace 3 horas', 'hace 1 día', etc.
            if (ahora.diff(fecha, 'day') < 2) {
                return fecha.fromNow(); // ejemplo: "hace 3 horas"
            }

            // Si fue hace más de 1 día, mostrar fecha completa
            return fecha.format('D [de] MMMM [de] YYYY, HH:mm');
        },

        truncateText(texto, limite) {
            if (!texto) return '';
            return texto.length > limite ? texto.slice(0, limite) + '...' : texto;
        },
        async cargarPublicacionesFacebook() {
            try {
                const fields = 'message,created_time,full_picture,permalink_url';
                const url = `https://graph.facebook.com/${this.pageId}/posts?fields=${fields}&access_token=${this.accessToken}`;

                const response = await axios.get(url);
                const posts = response.data.data.filter(post => post.message && post.full_picture);
                const postsConEstadisticas = await Promise.all(
                    posts.slice(0, 24).map(async (post) => {
                        const estadisticas = await this.cargarEstadisticas(post.id);
                        return {
                            ...post,
                            estadisticas,
                        };
                    })
                );

                this.publicacionPrincipal = postsConEstadisticas[0];
                this.publicacionsecundaria = postsConEstadisticas[1];
                this.publicaciontercera = postsConEstadisticas[2];
                this.publiacioncuarta = postsConEstadisticas[3];
                this.publiacionquinta = postsConEstadisticas[4];
                this.publiacionsexta = postsConEstadisticas[5];
                this.publiacionseptima = postsConEstadisticas[6];
                this.publiacionoctava = postsConEstadisticas[7];
                this.publicaciones = postsConEstadisticas.slice(0, 24);

            } catch (error) {
                console.error('Error al obtener publicaciones de Facebook:', error);
            }
        },
        async cargarEstadisticas(postId) {
            try {
                const url = `https://graph.facebook.com/${postId}?fields=comments.summary(true),shares,reactions.summary(true)&access_token=${this.accessToken}`;
                const res = await axios.get(url);
                return {
                    comentarios: res.data.comments?.summary?.total_count || 0,
                    compartidas: res.data.shares?.count || 0,
                    reacciones: res.data.reactions?.summary?.total_count || 0,
                    vistas: res.data.insights?.data?.[0]?.values?.[0]?.value || 0,
                    titulo: res.data.story || ''
                };
            } catch (error) {
                console.error('Error al obtener estadísticas:', error);
                return {
                    comentarios: 0,
                    compartidas: 0,
                    reacciones: 0,
                    vistas: 0,
                    titulo: ''
                };
            }
        },
        setActive(item) {
            // Si se hace clic en el mismo activo, se desactiva
            if (this.activeNav === item) {
                this.activeNav = "";
            } else {
                this.activeNav = item;
            }
        },
        calcularPorcentajeReacciones(reacciones) {
            const max = 500; // Ajusta este valor según lo que consideres "100%"
            const valor = reacciones || 0;
            return Math.min((valor / max) * 100, 100).toFixed(0);
        },
        mostrarNoticia(post) {
            this.noticiaSeleccionada = post;
        }
    },

}