import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        hotelList: [],
        hotelArea: [],
        hotelCategory: [],
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
        }
    },
    actions: {
        getHotelsPagination(context, data) {
            console.log(data);
            return new Promise((resolve, reject) => {
                const url = '/api/hotels';
                const config = {
                    params: data
                };
    
                axios.get(url, config)
                .then(response => {
                    // console.log(response);
                    context.commit('setHotelList', response.data.data);
                    // 페이지 저장
                    context.commit('pagination/setPagination', response.data, {root: true});
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
                    // console.log('동작은하나??',response);
                    context.commit('setHotelArea', response.data);
                    // console.log('값을 받아오나??', response.data);
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
                    console.log('값을 받아오나??', response.data);
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