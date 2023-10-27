<script>
import axios from "axios";
import {setAuthHeader} from "@/main";

export default {
  data() {
    return {
      nameInput: "",
      emailInput: "",
      pwdInput: "",
      againPwdInput: "",
      errorStatus: false,
      errors: []
    }
  },
  methods:
      {
        closeForm() {
          this.$emit('close-register', false);
        },
        async regUser() {
          try {
            this.errorStatus = false;
            this.errors = [];
            const regData = {
              name: this.nameInput,
              email: this.emailInput,
              password: this.pwdInput,
              password_confirmation: this.againPwdInput
            };
            await axios
                .post("/api/auth/registration", regData)
                .then(async response => {
                  localStorage.setItem('token', response.data.token);
                  localStorage.setItem('username', this.nameInput);

                  console.log(this.nameInput);
                  await setAuthHeader();

                  this.$router.push('/main');
                });

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
        v-model="nameInput"
        type="text"
        placeholder="Введите ваше имя"/>
    <p>E-mail</p>
    <input
        v-model="emailInput"
        type="text"
        placeholder="Введите адрес электронной почты"/>
    <p>Пароль</p>
    <input
        v-model="pwdInput"
        type="password"
        placeholder="Введите ваше пароль"/>
    <p>Повторите пароль</p>
    <input
        v-model="againPwdInput"
        type="password"
        placeholder="Введите пароль ещё раз"/>
    <div v-if="errorStatus">
      <div class="error" v-for="(item, index) in this.errors" :key="index">{{ item }}</div>
    </div>
    <button
        class="btn add_item"
        @click="regUser">
      Зарегистрироваться
    </button>
  </div>
</template>

<style scoped>

</style>