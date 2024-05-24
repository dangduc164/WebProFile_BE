import { createStore } from "vuex";
import { MODULE_STORE } from "@/const";
import auth from "./modules/auth";
import common from "./modules/common";

const store = createStore({
    modules: {
        [MODULE_STORE.AUTH.NAME]: auth,
        [MODULE_STORE.COMMON.NAME]: common,
    },
});

export default store;
