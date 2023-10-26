<script>
import NewAttribute from './NewAttribute.vue'
import axios from "axios";
import {mapActions} from "vuex";

export default {
  components: {
    NewAttribute
  },
  props: {
    product: {
      type: Object,
      required: true,
    }
  },
  data() {
    return {
      name: this.product.name,
      article: this.product.article,
      status: this.product.status,
      attributesArray: [],
      showDropdown: false,
      selectedOption: null,
      dropdownBorders: "default_borders"
    }
  },
  methods: {
    ...mapActions({
      updateProductsList: "product/fetchProducts"
    }),
    async updateProduct() {
      try {
        const jsonAttributes = {};
        this.attributesArray.forEach((item) => jsonAttributes[item.name] = item.value);
        const data = {
          name: this.name,
          article: this.article,
          status: this.status,
          data: JSON.stringify(jsonAttributes)
        };
        await axios
            .patch("/api/products/" + this.product.id, data)
            .then(() => this.updateProductsList());

        this.$emit('close', [2, false]);
      } catch (e) {
        alert('Ошибка!' + "\n" + e.response.data.message);
      }
    },
    closeForm() {
      this.$emit('close', [2, false]);
    },
    addAttribute(name, value) {
      this.attributesArray.push(
          {
            id: Date.now(),
            name: name,
            value: value
          }
      )
    },
    removeAttribute(id) {
      this.attributesArray.splice(this.attributesArray.findIndex((obj => obj.id === id)), 1);
    },
    fillAttributesArray() {
      const data = JSON.parse(this.product.data);
      for (const key in data) {
        const value = data[key];
        this.addAttribute(key, value);
      }
    },
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
      if (this.showDropdown) {
        this.dropdownBorders = "active_borders";
      } else this.dropdownBorders = "default_borders";
    },
    selectOption(option) {
      this.selectedOption = option;
      switch (option) {
        case 'Доступен':
          this.status = 'available';
          break;
        case 'Не доступен':
          this.status = 'unavailable';
          break;
      }
      this.showDropdown = false;
      this.dropdownBorders = "default-borders";
    },
  },
  mounted() {
    this.fillAttributesArray();
  }
}
</script>

<template>
  <div class="form">
    <header>
      <h2>Редактирование {{ this.product.name }}</h2>
      <button
          class="btn close_btn"
          id="close_btn"
          @click="closeForm">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
          <path d="M22.5 7.5L7.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"/>
          <path d="M7.5 7.5L22.5 22.5" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"/>
        </svg>
      </button>
    </header>
    <div class="inputs">
      <p>Артикул</p>
      <input
          type="text"
          v-model="article"
      />
      <p>Название</p>
      <input
          type="text"
          placeholder="Введите название"
          v-model="name"
      />
      <p>Статус</p>
      <div class="dropdown" :class="dropdownBorders">
        <div class="dropdown_btn" @click="toggleDropdown">
          {{ selectedOption || 'Выберите статус' }}
          <i class="dropdown_arrow" :class="{'down': !showDropdown, 'up': showDropdown}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
              <path d="M15 7.5L10 12.5L5 7.5" stroke="#C4C4C4" stroke-width="2"/>
            </svg>
          </i>
        </div>
        <ul v-if="showDropdown" class="dropdown_list">
          <li @click="selectOption('Доступен')">
            Доступен
          </li>
          <li @click="selectOption('Не доступен')">
            Не доступен
          </li>
        </ul>
      </div>
    </div>
    <h3>Атрибуты</h3>
    <div v-for="item in attributesArray" :key="item.id">
      <NewAttribute
          v-model:id="item.id"
          v-model:name="item.name"
          v-model:value="item.value"
          @remove="removeAttribute">
      </NewAttribute>
    </div>
    <button class="btn string_btn" @click="addAttribute('','')">+ Добавить атрибут</button>
    <button
        class="btn add_item"
        @click="updateProduct">
      Сохранить
    </button>
  </div>
</template>

<style scoped>

</style>