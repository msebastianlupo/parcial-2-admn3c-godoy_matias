import Vue from 'vue'
import VueRouter from 'vue-router'
import IdeasVista from '../views/IdeasVista.vue'
import NotasVista from '../views/NotasVista.vue'
import AcercaVista from '../views/AcercaVista.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'ideas',
    component: IdeasVista
  },
  {
    path: '/notas',
    name: 'notas',
    component: NotasVista
  },
  {
    path: '/acerca-de',
    name: 'acerca-de',
    component: AcercaVista
  }
]

const router = new VueRouter({
  routes
})

export default router