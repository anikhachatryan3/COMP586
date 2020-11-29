import Vue from 'vue';
import VueRouter from 'vue-router'
import Home from '@/pages/Home.vue';
import Callback from '@/pages/Callback.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/callback',
            name: 'Callback',
            component: Callback
        }
    ]
});