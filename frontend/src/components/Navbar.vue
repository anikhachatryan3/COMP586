<template>
  <div>
    <router-link :to="'/'" v-if="token">Home</router-link>
    <router-link :to="'/posts'" v-if="token">My Posts</router-link>
    <router-link :to="'/login'" v-if="!token">Login</router-link>
    <button @click="logout()" v-if="token">Logout</button>
  </div>
</template>

<script>
export default {
  name: 'Navbar',
  computed: {
    token() {
      return this.$session.get('token');
    }
  },
  methods: {
    logout() {
      this.$session.clear();
      this.$router.go();
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
