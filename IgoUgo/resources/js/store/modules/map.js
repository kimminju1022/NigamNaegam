import axios from "../../axios";

export default {
    namespaced: true,
    state: () => ({
        nearbyPlaceList: [], // 장소 목록록
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
                const url = '/api/testtest';
                const config = {
                    latitude: location.latitude,
                    longitude: location.longitude,
                };
                axios.post(url, config)
                .then(response => {
                    console.log('API : ', response.data);
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