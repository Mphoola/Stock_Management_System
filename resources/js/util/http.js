import router from '@/router/index';
import store from '@/store/index';

import axios from 'axios';

// const baseUrl = 'https://ndiwo-shop-api.herokuapp.com/api/v1';
const baseUrl = '/api/v1';

let token = localStorage.getItem('token') || '';

const HTTP = axios.create({
    baseURL: baseUrl,
    headers: {
        Authorization: `Bearer ${token}`,
        Accept: "application/json"
    }
})

function checkAuth(res) {
    store.commit('SET_LOADING', false);
    if (res.status === 401) {
        router.push('/login');
    }
    return res.data;
}

const postJson = async function (options) {

    store.commit('SET_LOADING', true);

    try {
        const res = await HTTP.post(options.url, options.data)

        return checkAuth(res);
    } catch (error) {
        console.log(error);
        store.commit('SET_LOADING', false);
    }
}

const getJson = async function (options) {

    store.commit('SET_LOADING', true);

    try {
        const res = await HTTP.get(options.url)
        return checkAuth(res);
    } catch (error) {
        console.log(error);
        store.commit('SET_LOADING', false);
    }
}

const deleteJson = async function (options) {

    store.commit('SET_LOADING', true);

    try {
        const res = await HTTP.delete(options.url)
        return checkAuth(res);
    } catch (e) {
        console.log(e);
        store.commit('SET_LOADING', false);
    }
}

export {
    postJson,
    getJson,
    deleteJson
}
