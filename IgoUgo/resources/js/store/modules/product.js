import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        productTypeList: {},
        productList: [],
        productArea: [],
        productCnt: ''
    }),
    mutations: {
        setProductTypeList(state, data) {
            state.productTypeList = data;
        },
        setProductList(state, data) {
            state.productList = data;
        },
        setProductArea(state, data) {
            state.productArea = data;
        },
        setProductCnt(state, data) {
            state.productCnt = data;
        }
    },
    actions: {
        takeProducts(context) {
            return new Promise((resolve, reject) => {
                axios.get('/api/products')
                .then(response => {
                    // console.log(response.data);
                    context.commit('setProductTypeList', response.data.products);
                    return resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    return reject();
                });
            });
        },

        getProductsPagination(context, searchData) {
            return new Promise((resolve, reject) => {
                const url = '/api/products/'+ searchData.contentTypeId;
                const config = {
                    params: searchData
                };

                axios.get(url, config)
                .then(response => {
                    context.commit('setProductList', response.data.products.data);
                    context.commit('setProductCnt', response.data.products.total);
                    context.commit('pagination/setPagination', response.data.products, {root: true});
                    return resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    return reject();
                })
            })
        },

        getProductsArea(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/areas';

                axios.get(url)
                .then(response => {
                    context.commit('setProductArea', response.data);
                    return resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    return reject();
                });
            });
        },
    },
    getters: {
    
    },
}