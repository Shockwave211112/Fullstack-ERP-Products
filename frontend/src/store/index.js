import {createStore} from 'vuex'
import {productsModule} from "@/store/productsModule";

export default createStore({
    state: () => ({

    }),
    getters: {},
    mutations: {
    },
    actions: {},
    modules: {
        product: productsModule
    }
})
