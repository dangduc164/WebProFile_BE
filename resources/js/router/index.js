import { createWebHistory, createRouter } from 'vue-router'


const Home = () => import('@/Pages/Home')
const NotFound = () => import('@/Components/NotfoundPage')
const Register = () => import('@/Pages/RegisterPage')
const Login = () => import('@/Pages/LoginPage')


const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/:pathMatch(.*)*', component: NotFound }
]

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    scrollBehavior() {
        return { top: 0, left: 0, behavior: 'smooth' }
    },
    routes,
})


export default router
