import {
    postJson
} from '@/util/http'

export default {
    state: {

    },
    getters: {

    },
    mutations: {
        
    },
    actions: {
        loginUser(context, data) {
            return postJson({
                url: '/auth/login',
                data
            }).then(res => {
                if (res.status) {
                    context.commit('SET_TOKEN', res.token)
                }
                return res
            })
        },
        logoutUser({ commit }) {
            return postJson({
                url: '/auth/logout',
            }).then(res => {
                if (res.status) {
                    commit('CLEAR_TOKEN', null)
                }
                return res
            });
        }
    }
}