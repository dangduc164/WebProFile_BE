import { createApp } from 'vue';
import App from '@/Pages/App.vue';
import router from '@/router';
import Antd from 'ant-design-vue';


const app = createApp(App);
app.config.productionTip = false;
app.use(router);
app.use(Antd);
app.mount('#app');


