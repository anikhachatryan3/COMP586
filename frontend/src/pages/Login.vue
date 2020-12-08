<template>
  <div>
    <h1>Login</h1>
    <form>
      <div>
        <label>
          email:
        </label>
        <input type="email" v-model="email">
      </div>
      <div>
        <label>
          password:
        </label>
        <input type="password" v-model="password">
      </div>
      <div>
        <input type="button" value="Submit" @click="login()">
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    login() {
      axios.post('http://localhost:8000/api/login', {
        'email': this.email,
        'password': this.password
      })
      .then(function(response) {
        localStorage.setItem('user_id', response.data.user.id);
        localStorage.setItem('first_name', response.data.user.first_name);
        localStorage.setItem('last_name', response.data.user.last_name);
        localStorage.setItem('email', response.data.user.email);
        localStorage.setItem('username', response.data.user.username);
        localStorage.setItem('token', response.data.token);
        window.location.href = '/'
      })
      .catch(function(error) {
        console.log(error.response);
      });
    }
  }
}
</script>

<style scoped>
</style>
