import { MODULE_STORE } from "@/const";

const auth = {
    namespaced: true,
    state() {
        return {
            isAuthenticated: false,
        };
    },
    getters: {
        [MODULE_STORE.COMMON.GETTERS.ISAUTH](state) {
            return state.isAuthenticated;
        },
    },
};
export default auth;
