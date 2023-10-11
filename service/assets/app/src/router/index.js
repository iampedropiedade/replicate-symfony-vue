import { createWebHistory, createRouter } from "vue-router"
import Intro from "../components/Intro/Main.vue"
import What from "../components/Settings/What.vue"
import Where from "../components/Settings/Where.vue"
import How from "../components/Settings/How.vue"
import Options from "../components/Settings/Options.vue"
import Generate from "../components/Generate/Main.vue"
import Start from "../components/Generate/Start.vue"
import Results from "../components/Results/Main.vue"
import Error from "../components/Error/Main.vue"

const routes = [];

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            component: Intro,
            name: "Intro",
            path:   "/",
            meta: { transition: 'slide-fade' },
        },
        {
            component: What,
            name: "What",
            path:   "/settings/what",
            meta: { transition: 'fade' },
        },
        {
            component: Where,
            name: "Where",
            path:   "/settings/where",
            meta: { transition: 'fade' },
        },
        {
            component: How,
            name: "How",
            path:   "/settings/how",
            meta: { transition: 'fade' },
        },
        {
            component: Options,
            name: "Options",
            path:   "/settings/options",
            meta: { transition: 'fade' },
        },
        {
            component: Selection,
            name: "Selection",
            path:   "/selection",
            meta: { transition: 'fade' },
        },
        {
            component: Generate,
            name: "Generate",
            path:   "/generate",
            meta: { transition: 'slide-fade' },
        },
        {
            component: Start,
            name: "Start",
            path:   "/generate/start",
            meta: { transition: 'slide-fade' },
        },
        {
            component: Results,
            name: "Results",
            path:   "/results",
            meta: { transition: 'slide-fade' },
        },
        {
            component: Error,
            name: "Error",
            path:   "/error",
            meta: { transition: 'slide-fade' },
        }
    ],
});

export default router;