import './bootstrap';
import { createApp } from 'vue';
import router from './router'
import store from './store'

const app = createApp({});

app.use(router).use(store).mount('#app');
