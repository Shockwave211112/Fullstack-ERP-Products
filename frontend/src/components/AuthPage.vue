<script>
import axios from "axios";
import {setAuthHeader} from "@/main";

export default {
  data() {
    return {
      emailInput: "",
      pwdInput: ""
    }
  },
  methods: {
    showRegisterForm() {
      this.$emit('show-register', true);
    },
    async loginUser() {
      try {
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
        alert('Ошибка соединения с сервером!' + "\n" + e.response.data.message);
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
        @input="emailInput=$event.target.value"
        type="text"
        placeholder="Введите e-mail"/>
    <p>Пароль</p>
    <input
        @input="pwdInput=$event.target.value"
        type="password"
        placeholder="Введите пароль"/>
    <button class="btn string_btn" @click="showRegisterForm">Не зарегистрированы?</button>
    <button @click="loginUser"
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