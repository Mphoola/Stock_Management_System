/* eslint-disable no-empty-pattern */
import {
    getJson,
    postJson
} from '@/util/http'

export default {
    state: {
        sales: [],
        sale: {},
    },
    getters: {
        sales: state => state.sales,
        sale: state => state.sale
    },
    mutations: {
        SET_SALES(state, sales) {
            state.sales = sales
        },
        SET_SALE(state, sale) {
            state.sale = sale
        }, 
    },
    actions: {
        getSales({commit}){
            return getJson({
                url: '/sales'
            }).then(res => {
                if(res){
                  commit('SET_SALES', res)
                }
                return res
            })
        },
        addSale({},sale){
            return postJson({
                url: '/sales',
                data: sale
            }).then(res => {
                return res
            })
        }, 
        updateSale({}, sale){
            return postJson({
                url: '/sales/' + sale.id,
                data: sale
            }).then(res => {
                return res
            })
        }, 
        showSale({}, id){
            return getJson({
                url: '/sales/' + id
            }).then(res => {
                
                return res
            })
        }
    }
}