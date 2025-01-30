import axios from "../../axios";

export default {
    namespaced: true,
    state: () => ({
        nearbyHotelList: [], // 호텔 목록
        nearbyProductList: [], // 즐길거리 목록
    }),
    mutations: {
        setNearbyHotelList(state, list) {
            state.nearbyHotelList = list;
        },
        setNearbyProductList(state, list) {
            state.nearbyProductList = list;
        },
    },
    actions: {
        // 현재 위치 넘겨줘서 컨트롤러를 통해 받아온 결과값 반환 - 호텔
        takeNearbyHotels(context, location) {
            return new Promise((resolve, reject) => {
                const url = '/api/hotels';
                const config = {
                    latitude: location.latitude,
                    longitude: location.longitude,
                    area_code: location.area_code,
                    hc_code: location.hc_code,
                };
                // console.log("api : ", config);
                axios.post(url, config)
                .then(response => {
                    // console.log('API : ', response.data);
                    context.commit('setNearbyHotelList', response.data);
                    // console.log("list : ", response.data);
                    resolve(response.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                });
            });
        },

        // 현재 위치 넘겨줘서 컨트롤러를 통해 받아온 결과값 반환 - 즐길거리
        takeNearbyProducts(context, location) {
            return new Promise((resolve, reject) => {
                const url = '/api/products';
                const config = {
                    latitude: location.latitude,
                    longitude: location.longitude,
                    area_code: location.area_code,
                    content_type_id: location.content_type_id,
                };
                // console.log("api : ", config);
                axios.post(url, config)
                .then(response => {
                    // console.log('API : ', response.data);
                    context.commit('setNearbyProductList', response.data);
                    // console.log("list : ", response.data);
                    resolve(response.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                });
            });
        },
    },
    getters: {
    
    },
}