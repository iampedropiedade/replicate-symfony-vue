require('bootstrap');
import {createApp} from 'vue/dist/vue.esm-bundler';
import {createPinia, PiniaVuePlugin} from 'pinia'
import index from './src/Main.vue'
import VueDayjs from 'vue3-dayjs-plugin'
import { markRaw } from 'vue'
import './src/icons/font-awesome';
import './styles/main.scss';
import './bootstrap';
import "@vueform/slider/themes/default.css"
import router from './src/router/index'

const pinia = createPinia()
pinia.use(({ store }) => {
    store.$router = markRaw(router)
})

const app = createApp({
    components: {
        index
    },
})
    .use(PiniaVuePlugin)
    .use(VueDayjs)
    .use(pinia)
    .use(router)
    .mount('#app')
