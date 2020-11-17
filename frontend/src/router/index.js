import Vue from 'vue';
import VueRouter from 'vue-router'
import HelloWorld from '@/components/HelloWorld.vue'
import Login from '@/pages/Login.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'HelloWorld',
            component: HelloWorld
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        }
    ]
});