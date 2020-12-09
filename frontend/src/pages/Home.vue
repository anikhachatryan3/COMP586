<template>
  <div>
    <h1>Home</h1>
    <div>
        <router-link :to="'/create-post'">Create Post</router-link>
    </div>
    <hr class="post">
    <div>
      <div v-for="post in posts" :key="post.id" class="post">
        <h2><router-link :to="'/posts/' + post.id" class="h2">{{ post.title }}</router-link></h2>
        <h4><div>{{ post.user.username }}</div></h4>
        <div>{{ post.body }}</div>
        <div class="date">{{ timeFormat(post.created_at) }}</div>
        <hr>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Home',
  data() {
    return {
      posts: []
    }
  },
  created() {
    if(localStorage.getItem('token')) {
      let v = this;
      axios.get('http://localhost:8000/api/posts')
      .then(function(response) {
        v.posts = response.data.posts;
      })
      .catch(function(error) {
        console.log(error.response);
      });
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
</style>
