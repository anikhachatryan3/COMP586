<template>
<div>
  <div v-if="$auth.user">
    <h2>{{ $auth.user.name }}</h2>
  </div>
  <div v-if="!loading">
    <button v-if="!$auth.isAuthenticated" @click="login()">Log in</button>
    <button v-if="$auth.isAuthenticated" @click="logout()">Log out</button>
  </div>
</div>
</template>

<script>
export default {
  name: 'Navbar',
  methods: {
    login() {
      console.log(this.$auth);
      this.$auth.loginWithRedirect();
    },
    logout() {
      this.$auth.logout({
        returnTo: window.location.origin
      });
    }
  },
  computed: {
    loading() {
      return this.$auth.loading
    }
  }
}
</script>