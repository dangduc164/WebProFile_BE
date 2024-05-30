import { createWebHistory, createRouter } from "vue-router";
import { ROUTER_PATH, TYPE_USER } from "@/const";
import { auth, guest } from "./middlewares";

const Home = () => import("@/Pages/Home");
const NotFound = () => import("@/Components/NotfoundPage");
const Register = () => import("@/Pages/RegisterPage");
const Login = () => import("@/Pages/LoginPage");
const ForgetPasssword = () => import("@/Pages/ForgetPassword");

const routes = [
    {
        path: ROUTER_PATH.ADMIN,
        name: "Home",
        component: Home,
        meta: {
            middleware: [(context) => auth(context, TYPE_USER.ADMIN)],
        },
    },
    {
        path: ROUTER_PATH.LOGIN,
        name: "adminLogin",
        component: Login,
        meta: {
            middleware: [(context) => guest(context, TYPE_USER.ADMIN)],
        },
    },
    {
        path: "/admin/register",
        name: "adminRegister",
        component: Register,
        meta: {
            middleware: [(context) => guest(context, TYPE_USER.ADMIN)],
        },
    },
    { path: "/admin/forget-password", component: ForgetPasssword },
    { path: "/:pathMatch(.*)*", component: NotFound },
];

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: "active",
    scrollBehavior() {
        return { top: 0, left: 0, behavior: "smooth" };
    },
    routes,
});

const middlewarePipeline = (context, middleware, index) => {
    const nextMiddleware = middleware[index];
    if (!nextMiddleware) {
        return context.next;
    }
    return () => {
        const nextPipeline = middlewarePipeline(context, middleware, index + 1);
        nextMiddleware({ ...context, next: nextPipeline });
    };
};
router.beforeEach((to, from, next) => {
    if (to.path === "/") {
        next({ path: ROUTER_PATH.ADMIN });
    }
    if (!to.meta.middleware) {
        return next();
    }
    const { middleware } = to.meta;
    const context = { to, from, next };
    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1),
    });
});

export default router;
