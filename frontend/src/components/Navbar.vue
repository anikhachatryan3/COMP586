<template>
  <div>
    <div v-if="token">{{ token }}</div>
    <router-link :to="'/login'" v-if="!token">Login</router-link>
    <router-link :to="''" @click="logout()" v-if="token">Logout</router-link>
  </div>
</template>

<script>
export default {
  name: 'Navbar',
  computed: {
    token() {
      return localStorage.getItem('token');
    }
  },
  methods: {
    logout() {
      localStorage.clear();
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
