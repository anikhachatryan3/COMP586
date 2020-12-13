<template>
    <div>
        <div class="comment_error">{{ error }}</div>
        <div>
            <textarea v-model="comment_box" @keydown="error=''"></textarea>
        </div>
        <div>
            <button @click="submitComment()">Submit</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'CreateComment',
    props: {
        post_id: {
            type: Number,
            default: null
        }
    },
    data() {
        return {
            comment_box: '',
            error: ''
        }
    },
    methods: {
        submitComment() {
            if(this.comment_box.trim().length < 1) {
                this.error = 'Please write a comment';
            }
            else {
                let v = this;
                axios.post('http://localhost:8000/api/posts/' + this.post_id + '/comment', {
                    'text': this.comment_box,
                    'user_id': this.$session.get('user_id')
                })
                .then(function(response) {
                    v.$emit('comment', response.data.comment)
                    v.comment_box = ''
                })
                .catch(function() {
                    v.error = 'Error creating comment!';
                });
            }
        }
    }
}
</script>

<style scoped>
    .comment_error {
        color: red;
    }
</style>
