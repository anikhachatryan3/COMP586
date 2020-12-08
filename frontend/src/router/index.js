import Vue from 'vue';
import VueRouter from 'vue-router'
import Home from '@/pages/Home.vue'
import Login from '@/pages/Login.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        }
    ]
});