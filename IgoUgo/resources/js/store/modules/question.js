import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        questionList: [],
        page: 0,
        questionDetail: null,
    }),
    mutations: {
        setQuestionList(state, questionList) {
            state.questionList = questionList;
        },
        setPage(state, page) {
            state.page = page;
        },
        setQuestionDetail(state, data) {
            state.questionDetail = data;
        },
    },
    actions: {
        // 문의내역 리스트
        questionList(context, searchData) {
            const url = '/api/questions';
            const config = {
                params: searchData,
            }

            axios.get(url, config)
            .then(response => {
                // console.log('getUserQuestionList',response.data);
                context.commit('setQuestionList', response.data.data.data);
                context.commit('pagination/setPagination', response.data.data, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        // 유저 1:1 문의내역
        userQuestionList(context, searchData) {
            const url = `/api/user/questions/${searchData.user_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
                params: searchData,
            }
            
            axios.get(url, config)
            .then(response => {
                // console.log('getUserQuestionList',response.data);
                context.commit('setQuestionList', response.data.data.data);
                context.commit('pagination/setPagination', response.data.data, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        // 게시글 상세
        questionDetail(context, data) {
            const url = `/api/questions/${data.board_id}`;
            // const url = `/api/questions/190`;
            const config = {
                params: data,
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response.data);
                
                context.commit('setQuestionDetail', response.data.data);
            })
            .catch(error => {
                console.error(error.response.data);
            });
        },

        // 게시글 작성
        storeQuestion(context, data) {
            const url = '/api/questions';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            const formData = new FormData();
            formData.append('board_title', data.board_title);
            formData.append('board_content', data.board_content);     
            formData.append('qc_code', data.qc_code);     
            formData.append('qc_name', data.qc_name);     
            
            // if(data.board_img) {
            //     formData.append('board_img', data.board_img);
            // }

            // 이미지 배열 넘기기
            if (data.board_img && data.board_img.length > 0) {
                data.board_img.forEach((file) => {
                    formData.append('board_img[]', file);
                });
            }

            axios.post(url, formData, config)
            .then(response => {
                // console.log(response);                
                context.commit('setQuestionList', response.data.data);
                
                router.replace('/questions');
            })
            .catch(error => {
                console.error(error.response.data);
            });
        },

        // 게시글 수정
        updateQuestion(context, question) {
            const url = `/api/questions/${question.questionDetail.board_id}`;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
                // params: question,
            }
            // console.log(question);
            const formData = new FormData();

            formData.append('board_id', question.questionDetail.board_id);
            formData.append('board_title', question.questionDetail.board_title);
            formData.append('board_content', question.questionDetail.board_content);
            if(question.board_img1) {
                formData.append('board_img1', question.board_img1);
            }
            if(question.board_img2) {
                formData.append('board_img2', question.board_img2);
            }

            // console.log('formData는', formData);

            axios.post(url, formData, config)
            .then(response => {
                context.commit('setQuestionList', response.data.data);

                alert('수정 성공');
                router.replace(`/questions/${question.questionDetail.board_id}`);
                }
            )
            .catch(error => {
                alert('수정 실패');
                console.error(error.response.data);
            });
        },

        // 게시글 삭제
        destroyQuestion(context, id) {
            const url = `/api/questions/${id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.delete(url, config)
            .then(response => {
                alert('삭제 성공');
                router.push('/questions');
            })
            .catch(error => {
                console.error(error.response);
                alert('삭제 실패');
            });
        }   
    },
    getters: {
    },
}