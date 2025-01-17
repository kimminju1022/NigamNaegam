import axios from "../../axios";

export default {
    namespaced: true,
    state: () => ({
        nearbyPlaceList: {},
    }),
    mutations: {
        setNearbyPlaceList(state, data) {
            state.nearbyPlaceList = data;
        }
    },
    actions: {
        takeNearbyPlaces(context, searchData) {
            return new Promise((resolve, reject) => {
                const url = '/api/testtest';
                const config = {
                    params: searchData
                };
                axios.get(url, config)
                .then(response => {
                    context.commit('setNearbyPlaceList', response.data);
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