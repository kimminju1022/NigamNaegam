// productSearch.js
// 상품검색 관련 모듈
// 이력
// v001 meerkat 신기작성

import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        searchProductList : []
        ,selectedProduct: {}
    }),
    mutations: {
        setSearchProductList(state, data) {
            state.searchProductList = data;
        }
        ,setSelectedProduct(state, data) {
            state.selectedProduct = data;
        }
    },
    actions: {
        searchProductList(context, data) {
            return new Promise(resolve => {
                const url = '/api/search/product';
                const config = {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    }
                    ,params: data
                }
    
                axios.get(url, config)
                .then(response => {
                    context.commit('setSearchProductList', response.data.product);
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => resolve());
            });
        },
    },
    getters: {
        // 검색 상품 리스트에서 특정 product_id의 아이템 획득
        getSelectProduct(state) {
            return productId => {
                return state.searchProductList.find(item => item.product_id == productId);
            };
        }
    },
}