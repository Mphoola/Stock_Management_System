/* eslint-disable no-empty-pattern */
import {
    getJson,
    postJson
} from '@/util/http'

export default {
    state: {
        products: [],
        product: {},
    },
    getters: {
        products: state => state.products,
        product: state => state.product
    },
    mutations: {
        SET_PRODUCTS(state, products) {
            state.products = products
        },
        SET_PRODUCT(state, product) {
            state.product = product
        }, 
    },
    actions: {
        getProducts({commit}){
            return getJson({
                url: '/products'
            }).then(res => {
                if(res){
                  commit('SET_PRODUCTS', res)
                }
                return res
            })
        },
        addProduct({},product){
            return postJson({
                url: '/products',
                data: product
            }).then(res => {
                return res
            })
        }, 
        updateProduct({}, product){
            return postJson({
                url: '/products/' + product.id,
                data: product
            }).then(res => {
                return res
            })
        }, 
        showProduct({commit}, id){
            return getJson({
                url: '/products/' + id
            }).then(res => {
                
                return res
            })
        }
    }
}