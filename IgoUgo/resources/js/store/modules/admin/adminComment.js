import axios from "axios";
import router from "../../../router";

export default {
    namespaced: true,
    state: () => ({
		commentList: [],
		commentDetail: [],
    }),
    mutations: {
        setCommentList(state, list){
            state.commentList = list;
        },
        setCommentDetail(state, data){
            state.commentDetail = data;
        },
    },
    actions: {
        // 댓글 리스트
        showCommentList(context, searchData) {
            return new Promise ((resolve, reject) => {
                const url = '/api/admin/comment';
                const config = {
                    params: searchData
                }
                console.log(url);
                axios.get(url, config)
                .then(response => {
                    context.commit('setCommentList', response.data.commentList.data);
                    context.commit('pagination/setPagination', response.data.commentList, {root: true});
                    return resolve();
                })
                .catch(error => {
                    console.error(error);
                    return reject();
                });
            });
        },

        // 댓글 상세
        showCommentDetail(context, findData) {
            return new Promise ((resolve, reject) => {
                const url = '/api/admin/comment/' + findData.comment_id;
                const config = {
                    params: findData
                }

                axios.get(url, config)
                .then(response => {
                    context.commit('setCommentDetail', response.data.commentDetail);
                    return resolve();
                }).catch(error => {
                    console.log(error);
                    return reject();
                });
            });
        },

        // 댓글 삭제
        destroyComment(context, findData) {
            const url = '/api/admin/comment/destroy/' + findData.comment_id;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.delete(url, config)
            .then(reponse => {
                alert('삭제 성공');
                router.push('/admin/comment');
            })
            .catch(error => {
                console.error(error);
                alert('삭제 실패');
            });
        }
    },
    getters: {
				
    },
}