import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        hotelList: [],
        hotelArea: [],
        hotelAreaCode: JSON.parse(sessionStorage.getItem('hotelAreaCode')) ? JSON.parse(sessionStorage.getItem('hotelAreaCode')) : [],
        // hotelArea: JSON.parse(localStorage.getItem('hotelArea')) || [],
        hotelCategory: [],
        hotelCategoryCode: JSON.parse(sessionStorage.getItem('hotelCategoryCode')) ? JSON.parse(sessionStorage.getItem('hotelCategoryCode')) : [],
        count: [],
        hotelDetail: [],
        hotelDetailImg: [],
        hotelRank: [],
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
            sessionStorage.setItem('hotelAreaCode', JSON.stringify(list));
        },
        setHotelCategory(state, list) {
            state.hotelCategory = list;
        },
        setHotelCategoryCode(state, list) {
            state.hotelCategoryCode = list;
            sessionStorage.setItem('hotelCategoryCode', JSON.stringify(list));
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
        setHotelsRank(state, list) {
            state.hotelRank = list
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
            // console.log(data.area_code);
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

        getHotelCategoryCode(context, data) {
            const categoryCode = data.hc_code;
            // console.log(data.hc_code);
            context.commit('setHotelCategoryCode', categoryCode);
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
                    // const imgs = hotelImgs.map((item) => item.originimgurl);
                    const imgs = hotelImgs ? hotelImgs.map((item) => item.originimgurl) : [];
                    context.commit('setHotelDetail', response.data.hotelsDetail.response.body.items.item[0]);
                    context.commit('setHotelDetailImg', imgs);
                    // console.log(response.data.hotelsDetail.response.body.items.item[0])
                    // console.log(imgs)
                    return resolve();
                })
                .catch(error => {
                    // console.log(error.response);
                    console.log(error);
                    return reject();
                });
            });
        },

        getHotelsRank(context) {
            return new Promise((resolve, reject) => {
                const url = 'api/hotels/rank'
                axios.get(url)
                .then(response => {
                    context.commit('setHotelsRank', response.data);
                    return resolve;
                })
                .catch(error => {
                    console.log(error.response);
                    return reject;
                })
            })
        }
    },
    getters: {

    },
}