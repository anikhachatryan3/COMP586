<template>
    <div>
        <h1>Create New Post</h1>
        <div>
            <label>
                Title
            </label>
            <input v-model="title" type="text">
        </div>
        <div>
            <label>
                Body
            </label>
            <textarea v-model="body"></textarea>
        </div>
        <button @click="create()">Submit</button>
        <div class="text-danger">{{ error }}</div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'CreatePost',
    data() {
        return {
            title: '',
            body: '',
            error: ''
        }
    },
    created() {
        this.loggedIn();
    },
    methods: {
        create() {
            let v = this;
            axios.post('http://localhost:8000/api/create-post', {
                'title': this.title,
                'body': this.body,
                'user_id': this.$session.get('user_id')
            })
            .then(function(response) {
                v.$router.push({
                    name: 'Post',
                    params: { post: response.data.post.id }
                });
            })
            .catch(function() {
                v.error = 'Error creating post!';
            });
        },
        loggedIn() {
            if(!this.$session.get('token')) {
                this.$router.push({
                    name: 'Login'
                });
            }
        }
    }
}
</script>