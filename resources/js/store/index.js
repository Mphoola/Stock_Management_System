import { createStore } from 'vuex'
import auth from '@/store/modules/auth'
import products from '@/store/modules/products'
import users from '@/store/modules/users'
import sales from '@/store/modules/sales'
import transactions from '@/store/modules/transactions'


export default createStore({
  state: {
    token: localStorage.getItem('token') || null,
    isLoading: false,
  },
  getters: {
    token: state => state.token,
    isLoading: state => state.isLoading
  },
  mutations: {
    SET_TOKEN(state, token) {
      state.token = token
      localStorage.setItem('token', token)
    },
    SET_LOADING(state, isLoading) {
      state.isLoading = isLoading
    },
    CLEAR_TOKEN(state) {
      state.token = null
      localStorage.removeItem('token')
    }
  },
  actions: {

  },
  modules: {
    auth,
    products,
    transactions,
    sales,
    users
  }
})
