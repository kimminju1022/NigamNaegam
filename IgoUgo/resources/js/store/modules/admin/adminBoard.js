import axios from "axios";
import router from "../../../router";


export default {
    namespaced: true,
    state: () => ({
		postList: [],
        postDetail: null,
        freeList: []
    }),
    mutations: {
        setPostList(state, list) {
            state.postList = list;
        },
        setPostDetail(state, list) {
            state.postDetail = list;
        },
        setFreeList(state, list) {
            state.freeList = list;
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
                    context.commit('setPostDetail', response.data.boardPostDetail);
                    return resolve();
                }).catch(error => {
                    console.log('오류오류', error);
                    return reject();
                })
            });
        },

        destroyReview(context, data) {
            const url = `/api/admin/destroy/${data.board_id}`
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.delete(url, config)
            .then(reponse => {
                alert('삭제 성공');
                router.push('/admin/board/review');
            })
            .catch(error => {
                console.error(error.response.data);
                alert('삭제 실패');
            });
        },

        destroyFree(context, data) {
            const url = `/api/admin/destroy/${data.board_id}`
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.delete(url, config)
            .then(reponse => {
                alert('삭제 성공');
                router.push('/admin/board/free');
            })
            .catch(error => {
                console.error(error.response.data);
                alert('삭제 실패');
            });
        },
    },
    getters: {
				
    },
}