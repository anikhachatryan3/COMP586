<template>
    <div>
        <div>{{ username }}</div>
        <div>{{ text }}</div>
        <div class="date">{{ timeFormat(created_at) }}</div>
        <button v-if="user_id == userId || userRole == 'ADMIN'" @click="deleteComment()">Delete Comment</button>
        <hr v-if="index+1!=size">
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Comment',
    props: {
        id: {
            type: Number,
            default: null
        },
        text: {
            type: String,
            default: null
        },
        user_id: {
            type: Number,
            default: null
        },
        username: {
            type: String,
            default: null
        },
        created_at: {
            type: String,
            default: null
        },
        index: {
            type: Number,
            default: null
        },
        size: {
            type: Number,
            default: null
        }
    },
    computed: {
        userId() {
            return this.$session.get('user_id');
        },
        userRole() {
            return this.$session.get('role');
        }
    },
    methods: {
        timeFormat(dateTime) {
            let date = new Date(dateTime);
            let hour = '';
            if(date.getHours() == 0) {
                hour = 12;
            } else if(date.getHours() > 12) {
                hour = date.getHours() - 12;
            } else {
                hour = date.getHours();
            }
            let minute = date.getMinutes();
            if(minute < 10) {
                minute = '0' + minute;
            }
            let AmPm = date.getHours() > 11 ? 'pm' : 'am';
            return date.toDateString().substring(4) + ' at ' + hour + ':' + date.getMinutes() + AmPm;
        },
        deleteComment() {
            let v = this;
            axios.delete('http://localhost:8000/api/comments/' + this.id, {
                "data": {
                    'user_id': this.$session.get('user_id')
                }
            })
            .then(function() {
                v.$emit('deletedComment', v.id)
            })
            .catch(function() {
                alert('Error deleting comment.');
            });
            
        }
    }
}
</script>

<style scoped>
    .date {
        font-size: 13px;
        font-style: italic;
    }
</style>
