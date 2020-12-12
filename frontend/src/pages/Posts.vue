<template>
  <div class="text-center">
    <div class="notif" v-if="notification.length">{{ notification }}</div>
    <h1>My Posts</h1>
    <div>
        <router-link :to="'/create-post'">Create Post</router-link>
    </div>
    <hr class="post">
    <div v-if="loading">Loading...</div>
    <div v-else>
      <div v-for="post in posts" :key="post.id" class="post">
        <h2><router-link :to="'/posts/' + post.id" class="h2">{{ post.title }}</router-link></h2>
        <h4><div>{{ post.user.username }}</div></h4>
        <div>{{ post.body }}</div>
        <div class="date">{{ timeFormat(post.created_at) }}</div>
        <button v-if="post.user_id == userId || userRole == 'ADMIN'" @click="deletePost(post.id)">Delete Post</button>
        <hr>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Posts',
  data() {
    return {
      posts: [],
      notification: '',
      loading: false
    }
  },
  async created() {
    let user = localStorage.getItem('user_id');
    if(localStorage.getItem('token')) {
      this.loading = true;
      let v = this;
      await axios.get('http://localhost:8000/api/' + user + '/posts')
      .then(function(response) {
        v.posts = response.data.posts;
        v.loading = false;
      })
      .catch(function(error) {
        console.log(error.response);
        v.loading = false;
      });
    }

    if(localStorage.getItem('notification')) {
      this.notification = localStorage.getItem('notification')
      localStorage.removeItem('notification')
    }
  },
  computed: {
    userId() {
      return localStorage.getItem('user_id');
    },
    userRole() {
      return localStorage.getItem('role');
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
    deletePost(postId) {
      let v = this;
      axios.delete('http://localhost:8000/api/posts/' + postId, {
        "data": {
          'user_id': localStorage.getItem('user_id')
        }
      })
      .then(function() {
        localStorage.setItem('notification', 'Post was successfully deleted!');
        let index = v.posts.findIndex(post => post.id == postId);
        if(index > -1) {
          v.posts.splice(index, 1);
        }
      })
      .catch(function() {
        console.log('Error deleting post.');
      });
    }
  }
}
</script>

<style scoped>
  .post {
    width: 72%;
    text-align: center;
    display: inline-block;
  }
  .date {
    font-size: 13px;
    font-style: italic;
  }
  .notif {
    color: rgb(19, 179, 19);
  }
</style>
