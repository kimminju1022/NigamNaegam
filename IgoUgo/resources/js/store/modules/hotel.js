import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        hotelList: [],
        hotelArea: [],
        hotelAreaCode: JSON.parse(localStorage.getItem('hotelAreaCode')),
        // hotelArea: JSON.parse(localStorage.getItem('hotelArea')) || [],
        hotelCategory: [],
        count: [],
        hotelDetail: [],
        hotelDetailImg: [],
    }),
    mutations: {
        setHotelList(state, list) {
            state.hotelList = list;
        },
        setHotelArea(state, list) {
            state.hotelArea = list;
        },
        setHotelAreaCode(state, list) {
            state.hotelAreaCode = list
            localStorage.setItem('hotelAreaCode', JSON.stringify(list));
        },
        setHotelCategory(state, list) {
            state.hotelCategory = list;
        },
        setCount(state, list) {
            state.count = list;
        },
        setHotelDetail(state, list) {
            state.hotelDetail = list;
        },
        setHotelDetailImg(state, list) {
            state.hotelDetailImg = list;
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
                    // console.log(response.data.total);
                    context.commit('pagination/setPagination', response.data, {root: true});
                    // console.log(response.data);
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

        getHotelAreaCode(context, data) {
            const areaCode = data.area_code;
            console.log(data.area_code)
            context.commit('setHotelAreaCode', areaCode);
        },

        getHotelsCategory(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/categories';

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
        },

        getHotelsDetail(context, findData) {
            return new Promise((resolve, reject) => {
                const url = '/api/hotels/' + findData.contentid;
                const config = {
                    params: findData
                };

                axios.get(url, config)
                .then(response => {
                    const hotelImgs = response.data.hotelsImg.response.body.items.item;
                    const imgs = hotelImgs.map((item) => item.originimgurl);
                    context.commit('setHotelDetail', response.data.hotelsDetail.response.body.items.item[0]);
                    context.commit('setHotelDetailImg', imgs);
                    // console.log(response.data.hotelsDetail.response.body.items.item[0])
                    // console.log(imgs)
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