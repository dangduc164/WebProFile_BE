import { createWebHistory, createRouter } from 'vue-router'


const Home = () => import('@/Pages/Home')
const NotFound = () => import('@/Components/NotfoundPage')
const Register = () => import('@/Pages/RegisterPage')
const Login = () => import('@/Pages/LoginPage')
const ForgetPasssword = () => import('@/Pages/ForgetPassword')


const routes = [
    { path: '/admin', name: "Home", component: Home, meta: { requiresAuth: true } },
    { path: '/admin/login', name: 'adminLogin', component: Login, },
    { path: '/admin/register', component: Register },
    { path: '/admin/forget-password', component: ForgetPasssword },
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

const authMiddleware = (to, from, next) => {
    const isAuthenticated = !to?.meta?.requiresAuth

    isAuthenticated ? next() : next({ name: 'adminLogin' });
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        authMiddleware(to, from, next);
    } else {
        next();
    }
});

export default router;
