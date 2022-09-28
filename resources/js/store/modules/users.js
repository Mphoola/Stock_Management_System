/* eslint-disable no-empty-pattern */
import {
    getJson,
    postJson
} from '@/util/http'

export default {
    state: {
        users: [],
        user: {},
    },
    getters: {
        users: state => state.users,
        user: state => state.user
    },
    mutations: {
        SET_USERS(state, users) {
            state.users = users
        },
        SET_USER(state, user) {
            state.user = user
        }, 
    },
    actions: {
        getUsers({commit}){
            return getJson({
                url: '/users'
            }).then(res => {
                if(res){
                  commit('SET_USERS', res)
                }
                return res
            })
        },
        addUser({},user){
            return postJson({
                url: '/auth/register',
                data: user
            }).then(res => {
                return res
            })
        }, 
        updateUser({}, user){
            return postJson({
                url: '/users/' + user.id,
                data: user
            }).then(res => {
                return res
            })
        }, 
        showUser({commit}, id){
            return getJson({
                url: '/users/' + id
            }).then(res => {
                
                return res
            })
        }
    }
}