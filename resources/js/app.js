import './bootstrap';

import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'

createInertiaApp({
    id: 'root-container',
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .component('Link', Link)
            .use(plugin)
        
        setGlobalVariables(app)
        .mount(el)
    },
})

const setGlobalVariables = (app) => {
    app.config.globalProperties.csrfToken = getCsrfToken()
    return app;
}

function getCsrfToken() {
    const elem = document.querySelector('meta[name="csrf-token"]')
    const token = elem.getAttribute('content')
    return token;
}
