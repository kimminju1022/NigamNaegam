import axios from "../../axios";

export default {
    namespaced: true,
    state: () => ({
        commentList: [],
    }),
    mutations: {
        setCommentList(state, commentList) {
            state.commentList = commentList;
        },
        // 댓글 입력란 초기화
        setSearchDataComment(state, comment) {
            state.searchDataComment.comment = comment;
        }
    },
    actions: {
        // 댓글 리스트
        commentList(context, data) {
            const url = `/api/testers/comments/${data.board_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
                params: data,
            }

            axios.get(url, config)
            .then(response => {
                // console.log('setCommentList',response.data);
                context.commit('setCommentList', response.data.data.data);
                context.commit('pagination/setPagination', response.data.data, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        // 댓글 작성
        // storeComment({state, rootGetters, commit}, data) {
        storeComment(context, data) {
            const url = '/api/testers/comments';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
                params: data,
            }
            // console.log(data);

            const formData = new FormData();
            formData.append('comment_content', data.comment);     

            axios.post(url, formData, config)
            .then(response => {
                // console.log(response.data);                
                context.commit('setCommentList', response.data.data);
                // context.commit('pagination/setPagination', response.data.data, {root: true});
                
                // if(state.commentList.length < 10) {
                //     commit('setCommentList', response.data.data);
                // } else {
                //     commit('pagination/setPaginationRegulation', rootGetters['pagination/getPlusOneLastPage'], {root: true});
                // }
            })
            .catch(error => {
                console.error(error);
            });
        },

        // 댓글 삭제
        destroyComment(context, id) {
            const url = `/api/testers/comments/${id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.delete(url, config)
            .then(response => {
                alert('삭제 성공');
                // router.push('/testers');
            })
            .catch(error => {
                console.error(error.response);
                alert('삭제 실패');
            });
        },   
    },
    getters: {
    },
}