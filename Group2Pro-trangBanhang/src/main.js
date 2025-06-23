import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import { createPinia } from 'pinia'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faCartShopping } from '@fortawesome/free-solid-svg-icons'
import router from './router'
library.add(faCartShopping)
const app = createApp(App)
const pinia = createPinia();
app.use(router)
app.component('font-awesome-icon', FontAwesomeIcon)
app.use(pinia)
app.mount('#app')
