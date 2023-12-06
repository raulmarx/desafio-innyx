import './assets/main.css'

import { createApp } from 'vue'
import { createStore } from 'vuex'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import { BootstrapIconsPlugin } from 'bootstrap-icons-vue';
import './scss/styles.scss'
import 'bootstrap'
 

const app = createApp(App)
app.use(createPinia())
app.use(BootstrapIconsPlugin)
app.use(router)

app.mount('#app')
