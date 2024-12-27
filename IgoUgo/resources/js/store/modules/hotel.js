import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        hotelList: [],
        hotelArea: [],
        hotelCategory: [],
        count: [],
    }),
    mutations: {
        setHotelList(state, list) {
            state.hotelList = list;
        },
        setHotelArea(state, list) {
            state.hotelArea = list;
        },
        setHotelCategory(state, list) {
            state.hotelCategory = list;
        },
        setCount(state, list) {
            state.count = list;
        },
    },
    actions: {
        getHotelsPagination(context, data) {
            return new Promise((resolve, reject) => {
                const url = '/api/hotels';
                const config = {
                    params: data
                };
    
                axios.get(url, config)
                .then(response => {
                    context.commit('setHotelList', response.data.data);
                    // 페이지 저장
                    context.commit('setCount', response.data.total);
                    console.log(response.data.total);
                    context.commit('pagination/setPagination', response.data, {root: true});
                    console.log(response.data);
                    return resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    return reject();
                });
            });

        },

        getHotelsArea(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/areas';

                axios.get(url)
                .then(response => {
                    context.commit('setHotelArea', response.data);
                    return resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    return reject();
                });
            });
        },

        getHotelsCategory(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/category';

                axios.get(url)
                .then(response => {
                    context.commit('setHotelCategory', response.data);
                    return resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    return reject();
                });
            });
        }
    },
    getters: {

    },
}