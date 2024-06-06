import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import 'ant-design-vue/dist/reset.css';
import Antd from "ant-design-vue";
import Layout from "./Shared/Layout.vue";

createInertiaApp({
    resolve: async (name) => {
        let page = await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
        page.default.layout ??= name.startsWith('Login') ? undefined : Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Antd)
            .mount(el)
    },
});
