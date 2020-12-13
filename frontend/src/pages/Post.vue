<template>
  <div v-if="post">
    <h1>{{ post.title }}</h1>
    <h4><div>{{ post.user.username }}</div></h4>
    <div class="post">
        <div>{{ post.body }}</div>
        <div class="date">{{ timeFormat(post.created_at) }}</div>
        <button v-if="post.user_id == userId || userRole == 'ADMIN'" @click="deletePost()">Delete Post</button>
    </div>
    <!-- <hr class="post"> -->
    <div>
      <comments v-if="post.comments.length"
        :comments="post.comments"
        @deletedComment="deletedComment"
      ></comments>
      <div v-else>
        <hr class="post">
        <div>No Comments</div>
        <br>
      </div>
    </div>
    <!-- <hr class="post"> -->
    <create-comment :post_id="post.id" @comment="newComment"></create-comment>
  </div>
</template>

<script>
import axios from 'axios'
import Comments from '../components/Comments.vue'
import CreateComment from '../components/CreateComment.vue'

export default {
  name: 'Post',
  data() {
    // Comments{
      return {
        post: null
      }
    // }
  },
  components: {
    Comments,
    CreateComment
  },
  created() {
    this.loggedIn();
    let post_id = this.$route.params.post;
    if(this.$session.get('token')) {
      let v = this;
      axios.get('http://localhost:8000/api/posts/' + post_id)
      .then(function(response) {
        v.post = response.data.post;
      })
      .catch(function() {
        alert('Error fetching post.');
      });
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
    newComment(value) {
      this.post.comments.push(value);
    },
    deletedComment(value) {
      let index = this.post.comments.findIndex(comment => comment.id == value);
      if(index > -1) {
        this.post.comments.splice(index, 1);
      }
    },
    deletePost() {
      let v = this;
      axios.delete('http://localhost:8000/api/posts/' + this.post.id, {
        "data": {
          'user_id': this.$session.get('user_id')
        }
      })
      .then(function() {
        this.$session.set('notification', 'Post was successfully deleted!');
        v.$router.push({
          name: 'Posts',
        });
      })
      .catch(function() {
        alert('Error deleting post.');
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
