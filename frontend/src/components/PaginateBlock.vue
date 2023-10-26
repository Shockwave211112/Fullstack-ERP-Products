<script>
import {mapActions, mapMutations, mapState} from "vuex";

export default {
  computed: {
    ...mapState({
      products: state => state.product.products,
      links: state => state.product.links,
      currentPage: state => state.product.currentPage,
      prevPage: state => state.product.prevPage,
      nextPage: state => state.product.nextPage
    }),
  },
  methods: {
    ...mapMutations({
      setCurrentPage: 'product/setCurrentPage',
    }),
    ...mapActions({
      fetchProducts: "product/fetchProducts",
    }),
    changePage(page_id) {
      this.setCurrentPage(page_id);
      this.fetchProducts();
    },
  }
}
</script>

<template>
  <div class="paginate__btns">
      <button class='btn'
              @click="changePage(this.prevPage)"
              :disabled="(this.prevPage == null)" >
          &lt;
      </button>
      <div class="number__btns">
          <div
              :class="{ 'selected_page': link.label == this.currentPage }"
              v-for="(link, index) in links"
              :key="index">
              <button
                  class='btn'
                  @click="changePage(link.label)"
                  :disabled="(link.label == this.currentPage)">
                  {{ link.label }}
              </button>
          </div>
      </div>
      <button
          class='btn'
          @click="changePage(this.nextPage)"
          :disabled="(this.nextPage == null)">
          >
      </button>
  </div>
</template>

<style scoped>
.number__btns {
    display: flex;
}
.paginate__btns {
  font-weight: 300;
  display: flex;
  position: absolute;
  background-color: #FFFFFF;
  border-bottom: solid;
  border-width: 2px 0;
  border-color: #C4C4C4;
  border-radius: 5px;
  color: #6E6E6F;
  bottom: 30px;
  left: 50%;
  height: auto;
  width: auto;
  max-width: 300px;
}

button span {
  height: 100%;
  width: 100%;
}

button {
  font-size: 16px;
  height: 40px;
  min-width: 40px;
}

button:hover {
  background-color: #C4C4C4;
  border-color: #505050;
}

button:active {
  background-color: #50A9FC;
}

.selected_page {
  background-color: #0FC5FF;
}
</style>
