import axios from "../../axios";

export default {
    namespaced: true,
    state: () => ({
        nearbyPlaceList: [], // 장소 목록
    }),
    mutations: {
        setNearbyPlaceList(state, list) {
            state.nearbyPlaceList = list;
        },
    },
    actions: {
        // 현재 위치 넘겨줘서 컨트롤러를 통해 받아온 결과값 반환
        takeNearbyPlaces(context, location) {
            return new Promise((resolve, reject) => {
                const url = '/api/hotels';
                const config = {
                    latitude: location.latitude,
                    longitude: location.longitude,
                    area_code: location.area_code,
                    hc_code: location.hc_code,
                };
                axios.post(url, config)
                .then(response => {
                    // console.log('API : ', response.data);
                    context.commit('setNearbyPlaceList', response.data);
                    resolve(response.data);
                })
                .catch(error => {
                    console.log(error.response);
                    reject(error);
                });
            });
        }
    },
    getters: {
    
    },
}