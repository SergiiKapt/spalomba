<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <login/>
<!--      <HelloWorld msg="Welcome to Your Vue.js App"/>-->
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue';
import Login from '@/components/Login.vue';
// import axiosInstance from '@/api/index'
export default {
  name: 'Home',
  components: {
    // HelloWorld,
    Login,
  },
  data() {
    return {
      email: '',
      password: '',
      message: 'login',
      info: null,
      users:'',
    }
  },

  created() {
    // this.$store.dispatch('fetchUsers');

  },
  // mounted() {
    // this.$store.dispatch('fetchCharacter');
    // axiosInstance
    //         .get('https://eurolombard.ksask.net/api/user')
    //         .then(response => (this.info = response));

  // .then(res => {
  //     console.log('native',res)
  //   })

  // .then(function(res) {
  //   console.log(res)
  //
  // })
  // }
}
</script>
