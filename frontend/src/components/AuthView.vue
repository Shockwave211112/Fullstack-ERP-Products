<script>
import AuthPage from './AuthPage.vue'
import RegPage from './RegPage.vue'
import axios from "axios";
export default {
  name: 'AuthView',
  data() {
    return {
      reg_form_status: false
    }
  },
  components: {
    AuthPage,
    RegPage
  },
  methods: {
    async checkAuth() {
      let token = localStorage.getItem('token');
      if (token != null) {
        try {
          await axios
              .get("/api/products");
          this.$router.push('/main');
        }
        catch {
          localStorage.removeItem('token');
          localStorage.removeItem('username');
        }
      }
    },
    changeForm(new_status) {
      this.reg_form_status = new_status;
    }
  },
  mounted()
  {
    this.checkAuth();
  }
}
</script>

<template>
  <div class="window">
    <div class="form">
      <div v-if="!reg_form_status">
        <AuthPage @show-register="changeForm"></AuthPage>
      </div>
      <div v-if="reg_form_status">
        <RegPage @close-register="changeForm"></RegPage>
      </div>
    </div>
  </div>
</template>

<style>
  .error {
    display: flex;
    color: #ff0000;
    font-size: 16px;
    margin-bottom: 20px;
    font-weight: 600;
  }
  .window {
    display: flex;
    width: 100vw;
    height: 100vh;
    background-color: #505050;
    justify-content: center;
    align-items: center;
  }
  .window .form {
    align-items: center;
    width: 400px;
  }
  .window .form .inputs {
    display: flex;
    flex-flow: column;
    align-items: center;
  }
  .window .form input {
    width: 250px;
    margin-right: 0px;
  }
</style>
