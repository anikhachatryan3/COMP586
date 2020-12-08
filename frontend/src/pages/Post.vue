<template>
  <div v-if="post">
    <h1>{{ post.title }}</h1>
    <h4><div>{{ post.user.username }}</div></h4>
    <hr class="post">
    <div class="post">
        <div>{{ post.body }}</div>
        <div class="date">{{ timeFormat(post.created_at) }}</div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Post',
  data() {
    return {
      post: null
    }
  },
  created() {
    let post_id = this.$route.params.post;
    if(localStorage.getItem('token')) {
      let v = this;
      axios.get('http://localhost:8000/api/posts/' + post_id)
      .then(function(response) {
        v.post = response.data;
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
