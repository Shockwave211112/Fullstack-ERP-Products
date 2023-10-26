<script>
import axios from "axios";
import {setAuthHeader} from "@/main";

export default {
  data() {
    return {
      nameInput: "",
      emailInput: "",
      pwdInput: "",
      againPwdInput: ""
    }
  },
  methods:
      {
        closeForm() {
          this.$emit('close-register', false);
        },
        async regUser() {
          try {
            const regData = {
              name: this.nameInput,
              email: this.emailInput,
              password: this.pwdInput,
              password_confirmation: this.againPwdInput
            };
            axios
                .post("/api/auth/registration", regData)
                .then(response => {
                  localStorage.setItem('token', response.data.token);
                  localStorage.setItem('username', name);
                });

            alert('Вы успешно зарегистрировались!');

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
    <h2>Регистрация</h2>
    <button
        class="btn close_btn"
        id="close_btn"
        @click="closeForm">
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
        <path d="M22.5 7.5L7.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M7.5 7.5L22.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
  </header>
  <div class="inputs">
    <p>Ваше имя</p>
    <input
        @input="nameInput=$event.target.value"
        type="text"
        placeholder="Введите ваше имя"/>
    <p>E-mail</p>
    <input
        @input="emailInput=$event.target.value"
        type="text"
        placeholder="Введите адрес электронной почты"/>
    <p>Пароль</p>
    <input
        @input="pwdInput=$event.target.value"
        type="password"
        placeholder="Введите ваше пароль"/>
    <p>Повторите пароль</p>
    <input
        @input="againPwdInput=$event.target.value"
        type="password"
        placeholder="Введите пароль ещё раз"/>
    <button
        class="btn add_item"
        @click="regUser">
      Зарегистрироваться
    </button>
  </div>
</template>

<style scoped>

</style>