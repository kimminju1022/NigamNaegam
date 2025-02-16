import axios from "axios";


export default {
    namespaced: true,
    state: () => ({
		postList: [],
        postDetail: null,
    }),
    mutations: {
        setPostList(state, list) {
            state.postList = list;
        },
        setPostDetail(state, list) {
            state.postDetail = list;
        }
    },
    actions: {
        // 보드 리스트 불러오기
		getPostList(context, data) {
            return new Promise ((resolve, reject) => {
                const url = '/api/admin/review';
                const config = {
                    params: data
                };
    
                axios.get(url, config)
                .then(response => {
                    // console.log(response.data.userBoardCnt.data)
                    context.commit('setPostList', response.data.userBoardCnt.data);
                    context.commit('pagination/setPagination', response.data.userBoardCnt, {root: true});
                    return resolve();
                }).catch(error => {
                    console.log('오류오류',error);
                    return reject();
                })
            });
        },

        // 보드 상세 불러오기
        getPostDetail(context, data) {
            return new Promise ((resolve, reject) => {
                const url = `/api/admin/review/${data.board_id}`;
                const config = {
                    params: {
                        bc_code: data.bc_code,  // bc_code는 쿼리 파라미터로 전달
                    }
                };
                
                axios.get(url, config)
                .then(response => {
                    // console.log(response.data)
                    context.commit('setPostDetail', response.data.userBoardCnt);
                    return resolve();
                }).catch(error => {
                    console.log('오류오류', error);
                    return reject();
                })
            });
        },
    },
    getters: {
				
    },
}