import { createApp } from "vue";
import App from "@/Pages/App.vue";
import router from "@/router";
import Antd from "ant-design-vue";
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
import store from "@/store";


const app = createApp(App);
app.config.productionTip = false;
app.use(router);
app.use(Antd);
app.use(store);
app.use(VueToast, {
    position: "top-right",
});
app.mount("#app");
