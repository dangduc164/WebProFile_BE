import { createMemoryHistory, createRouter } from 'vue-router'

import Home from '@/Pages/Home'
import NotFound from '@/Components/NotfoundPage'
import Register from '@/Pages/RegisterPage'
import Login from '@/Pages/LoginPage'

const routes = [
    { path: '/', component: Home },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/:any(.*)*', component: NotFound },
]

const router = createRouter({
    history: createMemoryHistory(),
    linkActiveClass: 'active',
    scrollBehavior() {
        return { top: 0, left: 0, behavior: 'smooth' }
    },
    routes,
})


export default router
