import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        productTypeList: {},
        productList: [],
        productArea: [],
        productCnt: '',
        productImg: [],
        productDetail: {},
        productLat: null,
        productLng: null,
        productRandom: {}
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
        },
        setProductImg(state, data) {
            state.productImg = data;
        },
        setProductDetail(state, data) {
            state.productDetail = data;
        },
        setProductLat(state, data) {
            state.productLat = Number(data);
        },
        setProductLng(state, data) {
            state.productLng = Number(data);
        },
        setProductRandom(state, data) {
            state.productRandom = data;
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

        takeProductDetail(context, findData) {
            return new Promise((resolve, reject) => {
                const url = '/api/products/' + findData.contenttypeid + '/' + findData.contentid;
                const config = {
                    params: findData
                };
                
                axios.get(url, config)
                .then(response => {
                    const productImgs = response.data.productImg.response.body.items.item;
                    const imgs = productImgs.map((item) => item.originimgurl);
                    const productDetail = response.data.productDetail.response.body.items.item[0];
                    const productLat = productDetail.mapy;
                    const productLng = productDetail.mapx;
                    context.commit('setProductImg', imgs);
                    context.commit('setProductDetail', productDetail);
                    context.commit('setProductLat', productLat);
                    context.commit('setProductLng', productLng);
                    return resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    return reject();
                })
            })
        },

        takeProductRandom(context) {
            const url = '/api/product/random';

            axios.get(url)
            .then(response => {
                context.commit('setProductRandom', response.data.products);
            })
            .catch(error => {
                console.log(error.response);
            });
        }
    },
    getters: {
    
    },
}