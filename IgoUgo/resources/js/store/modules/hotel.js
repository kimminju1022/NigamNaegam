import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        hotelList: [],
    }),
    mutations: {
        setHotelList(state, list) {
            state.hotelList = list;
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
                    console.log(response);
                    context.commit('setHotelList', response.data.data);

                    // 페이지 저장
                    context.commit('pagination/setPaginationInitialize', response.data, {root: true});
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