<script>
import {mapState, mapActions, mapMutations} from "vuex";
import PaginateBlock from "@/components/PaginateBlock.vue";

export default {
    components: {
        PaginateBlock,
    },
    methods: {
        ...mapMutations({
            setProducts: 'product/setProducts',
            setTotalPages: 'product/setTotalPages',
            setLoading: 'product/setLoading',
            setPage: 'product/setPage',
        }),
        ...mapActions({
            fetchProducts: "product/fetchProducts",
        }),
        changeCreateFormStatus() {
            this.$emit('show', [1, true]);
        },
        showInfo(product) {
            this.$emit('get-product', product);
            this.$emit('show', [3, true]);
        }
    },
    computed: {
        ...mapState({
            products: state => state.product.products,
            totalPages: state => state.product.totalPages,
            page: state => state.product.page,
            loading: state => state.product.loading,
        }),
    },
    mounted() {
        this.fetchProducts();
    }
}
</script>

<template>
    <div class="products">
        <button class="btn add_item" @click="changeCreateFormStatus">Добавить</button>
        <table v-if="!loading">
            <thead>
            <tr>
                <th>АРТИКУЛ</th>
                <th>НАЗВАНИЕ</th>
                <th>СТАТУС</th>
                <th>АТРИБУТЫ</th>
            </tr>
            </thead>
            <tbody
                v-if="products.length > 0">
            <tr
                v-for="product in products"
                :key="`product-${product.id}`"
                @click="showInfo(product)">
                <td>{{ product.article }}</td>
                <td>{{ product.name }}</td>
                <td v-if="product.status==='available'">Доступен</td>
                <td v-else>Не доступен</td>
                <td>
                    <div v-for="(value, attribute) in JSON.parse(product.data)"
                         :key="attribute">
                        {{ attribute }}: {{ value }}
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <h2 v-else>Загрузка продуктов...</h2>
        <PaginateBlock></PaginateBlock>
    </div>
</template>

<style scoped>
h2 {
    position: absolute;
    top: 50%;
    left: 50%;
}

tbody tr:hover {
    cursor: pointer;
    filter: brightness(0.97);
    border-color: #9b9b9b;
}

.add_item {
    position: absolute;
    right: 18px;
    margin-top: 18px;
}

.products {
    background-color: #F2F6FA;
    flex-grow: 1;
    color: #6E6E6F;
    font-size: 12px;
    font-weight: 400;
}

table {
    border-collapse: collapse;
}

th {
    background-color: #F2F6FA;
    height: 30px;
    text-align: left;
    padding: 9px 18px 9px;
    font-weight: 300;
}

td {
    padding: 22px 18px 22px;
    width: 200px;
    height: 50px;
    background-color: #FFFFFF;
}

tr {
    border: solid;
    border-width: 1px 0;
    border-color: #C4C4C4;
}

tr:first-child {
    border-top: none;
}

</style>
