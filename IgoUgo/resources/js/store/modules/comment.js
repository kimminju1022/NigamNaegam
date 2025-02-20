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
        setUnshiftCommentList(state, data) {
            state.commentList.unshift(data);
        },
        setRemoveCommentById(state, commentId) {
            state.commentList = state.commentList.filter(commentList => commentList.comment_id !== commentId);
        }
        // // 댓글 입력란 초기화
        // setSearchDataComment(state, comment) {
        //     state.searchDataComment.comment = comment;
        // }
    },
    actions: {
        // 댓글 리스트
        commentList(context, data) {
            const url = `/api/testers/comments/${data.board_id}`;

            axios.get(url)
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
                context.commit('setUnshiftCommentList', response.data.data);
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
                context.commit('setRemoveCommentById', id);
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