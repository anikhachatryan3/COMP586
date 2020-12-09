import Vue from 'vue';
import VueRouter from 'vue-router'
import Home from '@/pages/Home.vue'
import Login from '@/pages/Login.vue';
import Post from '@/pages/Post.vue';
import Posts from '@/pages/Posts.vue';
import CreatePost from '@/pages/CreatePost.vue';

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
        },
        {
            path: '/posts',
            name: 'Posts',
            component: Posts
        },
        {
            path: '/posts/:post',
            name: 'Post',
            component: Post
        },
        {
            path: '/create-post',
            name: 'CreatePost',
            component: CreatePost
        }
    ]
});