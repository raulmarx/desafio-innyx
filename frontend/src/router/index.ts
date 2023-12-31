import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
import EditProductView from '../views/EditProductView.vue'
import CategoryProductView from '../views/CategoryProductView.vue'
import CreateUpdateCategoryProductView from '../views/CreateUpdateCategoryProductView.vue'
import Layout from '../components/layout/Layout.vue';
import LayoutInterno from '../components/layout/LayoutInterno.vue';
import routes from '../router/routes.js';
import EditUserView from '@/views/EditUserView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    { path: '', alias: '/', redirect:'/login' },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '',
      component: LayoutInterno,
      children: [{
        path: '/home',
        name: 'home',
        component: HomeView,
        meta: {
          auth: true
        },
      },
      {
        path: '/about',
        name: 'about',
        component: () => import('../views/AboutView.vue'),
        meta: {
          auth: true
        }
      },
      {
        path: '/category-product',
        name: 'category-product',
        component: CategoryProductView,
        meta: {
          auth: true
        }
      },
      {
        path: '/create-update-category-product',
        name: 'create-update-category-product',
        component: CreateUpdateCategoryProductView,
        meta: {
          auth: true
        }
      },
      {
        path: '/edit-product/:id',
        name: 'edit-product',
        component: EditProductView,
          meta: {
          auth: true
        }
      },
      {
        path: '/edit-user/:id',
        name: 'edit-user',
        component: EditUserView,
        meta: {
          auth: true
        }
      },
      ]
    },

  ]
})
router.beforeEach(routes);

export default router
