import { createRouter, createWebHistory } from 'vue-router'
import CallbackView from '../views/Callback.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: CallbackView
    },
  ]
})

export default router
