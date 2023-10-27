<script>
import axios from "axios";
import {setAuthHeader} from "@/main";

export default {
  data() {
    return {
      emailInput: "",
      pwdInput: "",
      errors: [],
      errorStatus: false
    }
  },
  methods: {
    showRegisterForm() {
      this.$emit('show-register', true);
    },
    errorMessage() {
      if (this.pwdInput.length < 8) this.errors.push('Ваш пароль должен быть не меньше 8 символов!');
      else this.errors.pop();
    },
    async loginUser() {
      try {
        this.errorStatus = false;
        this.errors = [];
        const loginData = {
          email: this.emailInput,
          password: this.pwdInput
        };
        await axios
            .post("/api/auth/login", loginData)
            .then(response => {
              localStorage.setItem('token', response.data.token);
              localStorage.setItem('username', response.data.username);
            });

        await setAuthHeader();

        this.$router.push('/main');
      } catch (e) {
        this.errorStatus = true;
        for (let i in e.response.data.errors) {
          this.errors.push(e.response.data.errors[i].toString());
        }
      }
    }
  }
}
</script>

<template>
  <header>
    <h2>Авторизация</h2>
  </header>
  <div class="inputs">
    <p>E-mail</p>
    <input
        v-model="emailInput"
        type="text"
        placeholder="Введите e-mail"/>
    <p>Пароль</p>
    <input
        v-model="pwdInput"
        type="password"
        placeholder="Введите пароль"/>
    <button class="btn string_btn" @click="showRegisterForm">Не зарегистрированы?</button>
    <div v-if="errorStatus">
      <div class="error" v-for="(item, index) in this.errors" :key="index">{{ item }}</div>
    </div>
    <button
        @click="loginUser"
        class="btn add_item">
      Войти
    </button>
  </div>
</template>

<style scoped>
.string_btn {
  width: 110px;
}
</style>