import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import store from './store'

setAuthHeader();
axios.defaults.baseURL = 'http://127.0.0.1:8001'

createApp(App).use(store).use(router).mount('#app');

export function setAuthHeader() {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
}
