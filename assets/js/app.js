import { createApp, h, defineComponent, computed } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import Home from './components/Home.vue'
import Faves from './components/Faves.vue'
import '../css/app.css'

const routes = [
  { path: '/', component: Home },
  { path: '/favourites', component: Faves }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

const AppWrapper = defineComponent({
  setup () {
    const currentComponent = computed(() => {
      return router.currentRoute.value.path === '/favourites' ? Faves : Home
    })

    return {
      currentComponent
    }
  },
  render () {
    return h(this.currentComponent)
  }
})

createApp(AppWrapper).use(router).mount('#app')
