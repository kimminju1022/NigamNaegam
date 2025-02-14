import axios from "axios";


export default {
    namespaced: true,
    state: () => ({
		postList: [],
    }),
    mutations: {
        setPostList(state, list) {
            state.postList = list
        }
    },
    actions: {
		getPostList(context, data) {
            return new Promise ((resolve, reject) => {
                const url = '/api/admin/review';
                const config = {
                    params: data
                };
    
                axios.get(url, config)
                .then(response => {
                    context.commit('setPostList', response.data.userBoardCnt.data);
                    context.commit('pagination/setPagination', response.data.userBoardCnt, {root: true});
                    return resolve();
                }).catch(error => {
                    console.log('오류오류',error);
                    return reject();
                })
            });
        }
    },
    getters: {
				
    },
}