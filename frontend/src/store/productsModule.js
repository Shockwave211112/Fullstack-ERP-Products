import axios from "axios";

export const productsModule = {
    state: () => ({
        products: [],
        loading: false,
        links: [],
        currentPage: null,
        prevPage: null,
        nextPage: null
    }),
    getters: {},
    mutations: {
        setProducts(state, data) {
            state.products = data;
        },
        setLoading(state, status) {
            state.loading = status;
        },
        setLinks(state, data) {
            let sortedLinks = data.filter(
                link => (!link.label.includes('Previous') && !link.label.includes('Next'))
            );

            let currentIndex = sortedLinks.findIndex(item => item.active === true);
            let start = currentIndex < 1 ? currentIndex : currentIndex < 2 ? currentIndex - 1 : currentIndex + 2 == sortedLinks.length ? currentIndex - 3 : currentIndex + 1 == sortedLinks.length ? currentIndex - 4 : currentIndex - 2;
            let end = currentIndex < 1 ? currentIndex + 5 : currentIndex < 2 ? currentIndex + 4 : currentIndex + 3;
            sortedLinks = sortedLinks.slice(start, end);

            state.links = sortedLinks;
        },
        setCurrentPage(state, id) {
            state.currentPage = id;
        },
        setPrevPage(state, url) {
            if (url != null) state.prevPage = new URL(url).searchParams.get("page");
            else state.prevPage = null;
        },
        setNextPage(state, url) {
            if (url != null) state.nextPage = new URL(url).searchParams.get("page");
            else state.nextPage = null;
        },
    },
    actions: {
        async fetchProducts({state, commit}) {
            try {
                commit('setLoading', true);
                await axios
                    .get("/api/products", {
                        params: {
                            page: state.currentPage,
                        }
                    })
                    .then(response => {
                        commit('setProducts', response.data.data);
                        commit('setLoading', false);
                        commit('setLinks', response.data.links);
                        commit('setCurrentPage', response.data.current_page);
                        commit('setNextPage', response.data.next_page_url);
                        commit('setPrevPage', response.data.prev_page_url);
                    });
            } catch (e) {
                console.log('Ошибка соединения с сервером!' + "\n" + e.response.data.message);
            } finally {
                commit('setLoading', false);
            }
        },
    },
    namespaced: true,
}
