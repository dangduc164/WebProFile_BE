import { createMemoryHistory, createRouter } from 'vue-router'

const Home = () => import('@/Pages/Home')
const NotFound = () => import('@/Components/NotfoundPage')

const routes = [
    { path: '/', component: Home },
    { path: '/:pathMatch(.*)*', component: NotFound },
]

const router = createRouter({
    history: createMemoryHistory(),
    // linkActiveClass: 'active',
    // scrollBehavior() {
    //     return { top: 0, left: 0, behavior: 'smooth' }
    // },
    routes,
})


export default router
