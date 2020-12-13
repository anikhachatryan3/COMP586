<template>
  <div>
    <h1>Login</h1>
    <form>
      <div class="error" v-if="error.length">{{ error }}</div>
      <div>
        <label>
          email:
        </label>
        <input type="email" v-model="email" @keydown="error=''">
      </div>
      <div>
        <label>
          password:
        </label>
        <input type="password" v-model="password" @keydown="error=''">
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
      password: '',
      error: '',
    }
  },
  created() {
    this.notLoggedIn();
  },
  methods: {
    login() {
      let v = this;
      axios.post('http://localhost:8000/api/login', {
        'email': this.email,
        'password': this.password
      })
      .then(function(response) {
        v.$session.set('user_id', response.data.user.id);
        v.$session.set('first_name', response.data.user.first_name);
        v.$session.set('last_name', response.data.user.last_name);
        v.$session.set('email', response.data.user.email);
        v.$session.set('username', response.data.user.username);
        v.$session.set('role', response.data.user.role);
        v.$session.set('token', response.data.token);
        v.$router.go();
      })
      .catch(function() {
        v.error = 'Incorrect email or password.';
      });
    },
    notLoggedIn() {
      if(!this.$session.get('token')) {
        this.$router.push({
          name: 'Home'
        });
      }
    }
  }
}
</script>

<style scoped>
.error {
  color: red;
}
</style>
