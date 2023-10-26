<script>
import axios from "axios";

export default {
  data() {
    return {
      username: null,
    }
  },
  methods:
    {
      checkAuth() {
        this.username = localStorage.getItem('username');

        if (localStorage.getItem('token') == null) {
          alert('Ошибка авторизации.');
          this.$router.push('/auth');
        }
      },
      async logout() {
        try {
          await axios
              .get("/api/auth/logout");

          localStorage.removeItem('token', null);
          localStorage.removeItem('username', null);

          this.$router.push('/auth');
        } catch (e) {
          alert('Ошибка!' + "\n" + e.response.data.message);
        }
      }
    },
  mounted()
  {
    this.checkAuth();
  }
}
</script>

<template>
  <header class="topBar">
    <div class="links">
      <div class="link">
        <button id='products' class='btn selected_page' href="#">ПРОДУКТЫ</button>
      </div>
    </div>
    <div class="user">
      <button
          class="btn"
          title="Нажмите, чтобы выйти из учётной записи"
          @click="logout">
        <span v-if="this.username != null">{{ this.username }}</span>
        <span v-else>Выйти</span>
      </button>
    </div>
  </header>
</template>

<style scoped>
.btn {
  text-decoration: none;
  color: #A6AFB8;
  align-self: right;
  font-size: 16px;
}

.selected_page {
  color: #ED1C24;
  border-bottom: 3px solid #ED1C24;
  padding-bottom: 18px;
}

.user a {
  color: #A6AFB8;
  align-self: right;
}

.topBar {
  background-color: #FFFFFF;
  height: 65px;
  text-decoration: none;
  color: #A6AFB8;
  font-size: 16px;
  padding: 25px 18px 25px;
  display: flex;
  justify-content: space-between;
}

.link {
  display: flex;
  align-items: center;
  flex-direction: column;
}

</style>