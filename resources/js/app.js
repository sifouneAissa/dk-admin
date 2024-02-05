import './bootstrap';
import '../css/app.css';

import "../../public/adminlte/plugins/jquery/jquery.min.js";
import "../../public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js";
import "../../public/adminlte/dist/js/adminlte.min.js";
import 'primevue/resources/themes/aura-light-green/theme.css'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import ToastService from 'primevue/toastservice';
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/aura-light-green/theme.css'


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(ToastService)
            .use(PrimeVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
