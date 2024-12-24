import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        productTypeList: {}
    }),
    mutations: {
        setProductTypeList(state, data) {
            state.productTypeList = data;
        },
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
    },
    getters: {
    
    },
}