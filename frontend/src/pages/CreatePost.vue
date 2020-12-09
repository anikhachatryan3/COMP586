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
    methods: {
        create() {
            let v = this;
            axios.post('http://localhost:8000/api/create-post', {
                'title': this.title,
                'body': this.body,
                'user_id': localStorage.getItem('user_id')
            })
            .then(function(response) {
                console.log(response.data)
            })
            .catch(function() {
                v.error = 'Error creating post!';
            });
        }
    }
}
</script>