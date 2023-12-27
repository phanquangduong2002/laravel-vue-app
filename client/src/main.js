import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { MotionPlugin } from '@vueuse/motion';
import './style.css';
import axios from 'axios';
window.axios = axios;

import router from './router/index.js';
import App from './App.vue';

const pinia = createPinia();

const app = createApp(App);

app.use(pinia);
app.use(router);
app.use(MotionPlugin);
app.mount('#app');
