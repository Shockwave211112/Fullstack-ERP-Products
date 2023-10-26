<script>
import ProductsList from './ProductsList.vue'
import NavBar from './NavBar.vue'
import TopBar from './TopBar.vue'
import NewProductForm from './NewProductForm.vue'
import EditProductForm from './EditProductForm.vue'
import ShowProductForm from './ShowProductForm.vue'

export default {
  name: 'MainView',
  data() {
    return {
      currentObject: {},
      new_form_status: false,
      edit_form_status: false,
      show_form_status: false,
    }
  },
  components: {
    ProductsList,
    NavBar,
    TopBar,
    NewProductForm,
    EditProductForm,
    ShowProductForm,
  },
  methods: {
    changeStatus(data) {
      switch (data[0]) {
        case 1:
          this.new_form_status = data[1];
          break;
        case 2:
          this.edit_form_status = data[1];
          break;
        case 3:
          this.show_form_status = data[1];
          break;
      }
    },
    getCurrentObject(object) {
      this.currentObject = object;
    },
  }
}
</script>

<template>
  <NavBar></NavBar>
  <div class="main">
    <TopBar></TopBar>
    <ProductsList
        @show="changeStatus"
        @get-product="getCurrentObject">
    </ProductsList>
  </div>
  <transition-group>
    <div v-if="new_form_status" class="new_item overlay">
      <NewProductForm
          @update-list="updateList"
          @close="changeStatus"></NewProductForm>
    </div>
    <div v-if="show_form_status" class="show_item overlay ">
      <ShowProductForm
          v-model:product="currentObject"
          @update="changeStatus"
          @close="changeStatus"></ShowProductForm>
    </div>
    <div v-if="edit_form_status" class="edit_item overlay">
      <EditProductForm
          v-model:product="currentObject"
          @close="changeStatus"
      ></EditProductForm>
    </div>
  </transition-group>
</template>

<style>
  * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Roboto;
      font-style: normal;
    }
  #app {
    display: flex;
    width: 100vw;
    height: 100vh;
  }
  .main {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }
  .btn {
    background: none;
    border: none;
    cursor: pointer;
  }

  .btn:hover {
    filter: brightness(1.1);
  }

  .btn:active {
    filter: brightness(0.8);
  }

  table tr {
    vertical-align: top;
  }
  .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }
  header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }
  .form {
    width: 630px;
    height: auto;
    border-radius: 5px;
    border: 1px solid #000;
    background: #374050;
    color: #FFFFFF;
    font-size: 12px;
    font-weight: 400;
    padding: 25px 12px;
    display: flex;
    flex-direction: column;
  }
  .form h2 {
    font-size: 24px;
    margin-bottom: 30px;
  }
  .form p {
    margin-bottom: 8px;
  }
  .form input, .dropdown {
    width: 470px;
    height: 30px;
    border-radius: 5px;
    background: #FFFFFF;
    border: none;
    padding-left: 9px;
    color: #000;
    font-size: 15px;
    font-weight: 300;
    margin-bottom: 13px;
    margin-right: 10px;
  }
  .form input:active, .dropdown:active {
    background: #eaeaea;
  }
  .form input:focus{
    outline: none;
  }
  .form h3 {
    font-size: 20px;
    margin-bottom: 18px;
  }
  .string_btn {
    border-bottom: 1px dashed #0FC5FF;
    color: #0FC5FF;
    font-size: 10px;
    font-weight: 400;
    margin-bottom: 30px;
    width: 100px;
  }
  .close_btn {
    width: 30px;
    height: 30px;
    margin-left: 6px;
  }
  .v-enter-active,
  .v-leave-active {
    transition: opacity 0.5s ease;
  }
  .v-enter-from,
  .v-leave-to {
    opacity: 0;
  }
  .add_item {
      width: 136px;
      height: 30px;
      border-radius: 6px;
      background: #0FC5FF;
      color: #FFFFFF;
      font: inherit;
      font-size: 12px;
      font-weight: 500;
      font-style: normal;
  }
  .dropdown {
    font-weight: 300;
    position: relative;
    user-select: none;
    padding: 6px 9px;
  }

  .default_borders {
    border-radius: 5px !important;
  }

  .active_borders {
    border-radius: 5px 5px 0 0 !important;
  }

  .dropdown_btn {
    cursor: pointer;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .dropdown_arrow {
    width: 20px;
    height: 20px;
  }

  .down {
    transform: rotate(0deg);
  }

  .up {
    transform: rotate(180deg);
  }

  .dropdown_list {
    list-style: none;
    background-color: white;
    font-weight: 300;
    border-top: none;
    border-radius: 0 0 5px 5px;
    overflow: hidden;
    position: absolute;
    width: 100%;
    right: 0px;
    top: 30px;
  }

  .dropdown_list li {
    height: 30px;
    padding: 6px 9px;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  .dropdown_list li:hover {
    background-color: #50A9FC;
  }
</style>
