import { auth, guest } from "./middlewares";
import { ROUTER_PATH, TYPE_USER, } from "@/const";

const Home = () => import('@/Pages/Home')
const NotFound = () => import('@/Components/NotfoundPage')
const Register = () => import('@/Pages/RegisterPage')
const Login = () => import('@/Pages/LoginPage')
const ForgetPasssword = () => import('@/Pages/ForgetPassword')


export default [
    {
        path: ROUTER_PATH.ADMIN,
        name: "Home",
        component: Home,
        // meta: {
        //     middleware: [(context) => auth(context, TYPE_USER.ADMIN)],
        // },
    },
    {
        path: ROUTER_PATH.LOGIN,
        name: 'adminLogin',
        component: Login,
        // meta: {
        //     middleware: [(context) => guest(context, TYPE_USER.ADMIN)],
        // },
    },
    { path: '/admin/register', component: Register },
    { path: '/admin/forget-password', component: ForgetPasssword },
    { path: '/:pathMatch(.*)*', component: NotFound }
]
