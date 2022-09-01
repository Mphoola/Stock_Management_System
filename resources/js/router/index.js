import { createRouter, createWebHistory } from 'vue-router'
import ProductsView from '@/views/Products/Products.vue'
import AddProduct from '@/views/Products/AddProduct.vue'
import ShowProduct from '@/views/Products/ShowProduct.vue'
import EditProduct from '@/views/Products/EditProduct.vue'
import DashboardView from '@/views/DashboardView.vue'
import UsersView from '@/views/Users/Users.vue'
import UserDetails from '@/views/Users/UserDetails.vue'
import ExpensesView from '@/views/Expenses.vue'
import TransactionsView from '@/views/Transactions.vue'
import SalesView from '@/views/Sales/Sales.vue'
import AddSaleView from '@/views/Sales/AddSale.vue'
import SaleUpdateView from '@/views/Sales/UpdateSale.vue'
import SaleShowView from '@/views/Sales/ShowSale.vue'
import StocksView from '@/views/Stocks.vue'
import store from '@/store/index'

function checkAuth (to, from, next) {
  if(!store.getters.token) {
    next('/login')
  }else{
    next()
  }
}

const routes = [
  {
    path: '/products',
    name: 'products',
    component: ProductsView,
    beforeEnter: checkAuth
  },
  {
    path: '/products-add',
    name: 'product-add',
    component: AddProduct,
    beforeEnter: checkAuth
  },
  {
    path: '/product/:id(\\d+)+/details',
    name: 'product-show',
    component: ShowProduct,
    props: true,
    beforeEnter: checkAuth
  },
  {
    path: '/product/:id(\\d+)+/update',
    name: 'product-update',
    component: EditProduct,
    props: true,
    beforeEnter: checkAuth
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: DashboardView,
    beforeEnter: checkAuth
  },
  {
    path: '/',
    name: 'home',
    component: DashboardView,
    beforeEnter: checkAuth
  },
  {
    path: '/users',
    name: 'users',
    component: UsersView,
    beforeEnter: checkAuth
  },
  {
    path: '/users/:id',
    name: 'user-show',
    component: UserDetails,
    beforeEnter: checkAuth
  },
  {
    path: '/transactions',
    name: 'transactions',
    component: TransactionsView,
    beforeEnter: checkAuth
  },
  {
    path: '/sales',
    name: 'sales',
    component: SalesView,
    beforeEnter: checkAuth
  },
  {
    path: '/sales/:id/details',
    name: 'show-sale',
    component: SaleShowView,
    props: true,
    beforeEnter: checkAuth
  },
  {
    path: '/sales/add',
    name: 'add-sale',
    component: AddSaleView,
    beforeEnter: checkAuth
  },
  {
    path: '/sales/:id/update',
    name: 'update-sale',
    props: true,
    component: SaleUpdateView,
    beforeEnter: checkAuth
  },
  {
    path: '/expenses',
    name: 'expenses',
    component: ExpensesView,
    beforeEnter: checkAuth
  },
  {
    path: '/stocks',
    name: 'stocks',
    component: StocksView,
    beforeEnter: checkAuth
  },
  {
    path: '/about',
    name: 'about',
    component: () => import('@/views/AboutView.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/Auth/Login.vue')
  },
  {
    path: '/forget-password',
    name: 'password',
    component: () => import('@/views/Auth/ForgetPassword.vue')
  },
  {
    path: '/reset-password',
    name: 'reset-password',
    component: () => import('@/views/Auth/ResetPassword.vue')
  },
  {
    path: '/:pathMatch(.*)',
    name: '404',
    component: () => import('@/views/PageNotFound.vue')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
