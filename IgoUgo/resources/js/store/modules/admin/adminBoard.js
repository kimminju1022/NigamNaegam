import axios from "axios";


export default {
    namespaced: true,
    state: () => ({
		postList: [],
    }),
    mutations: {
        setHotelList(state, list) {
            state.postList = list
        }
    },
    actions: {
		getHotelList(context, data) {
            return new Promise ((reject, resolve) => {
                const url = '/api/admin/review';
                const config = {
                    params: data
                };
    
                axios.get(url, config)
                .then(response => {
                    context.commit('setPostList', response.userBoardCnt.data);
                    return reject;
                }).catch(error => {
                    console.log(error.response);
                    return resolve;
                })
            });
        }
    },
    getters: {
				
    },
}