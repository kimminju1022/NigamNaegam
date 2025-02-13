import axios from 'axios';

export default {
    namespaced: true,
    state: () => ({
        questionYet: [],
        questionDone: [],
        questionDetail: null,
    }),
    mutations: {
        setQuestionYet(state, questionYet) {
            state.questionYet = questionYet;
        },
        setQuestionDone(state, questionDone) {
            state.questionDone = questionDone;
        },
        setQuestionDetail(state, questionDetail) {
            state.questionDetail = questionDetail;
        },
    },
    actions: { 
        // 메인 답변대기 리스트
        questionYet(context, searchData) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/question/yet';
                const config = {
                    params: {
                        page: searchData.page
                    },
                }
    
                axios.get(url, config)
                .then(response => {
                    // console.log('yet : ', response.data.data.data[0]);
                    context.commit('setQuestionYet', response.data.data.data);
                    context.commit('pagination/setAdminQuestionYetPagination', response.data.data, {root: true});
                    return resolve();
                })
                .catch(error => {
                    console.log(error);
                    return reject();
                });
            })
        },

        // 메인 답변완료 리스트
        questionDone(context, searchData) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/question/done';
                const config = {
                    params: {
                        page: searchData.page
                    },
                }

                axios.get(url, config)
                .then(response => {
                    // console.log('done : ', response.data.data.data[0]);
                    context.commit('setQuestionDone', response.data.data.data);
                    context.commit('pagination/setAdminQuestionDonePagination', response.data.data, {root: true});
                    return resolve();
                })
                .catch(error => {
                    console.log(error);
                    return reject();
                });
            })
        },

        // 문의게시글 디테일
        questionDetail(context, data) {
            return new Promise((resolve, reject) => {
                const url = `/api/admin/question/${data.board_id}`;
                const config = {
                    params: data,
                }
    
                axios.get(url, config)
                .then(response => {
                    // console.log('js: ', response.data.data);
                    context.commit('setQuestionDetail', response.data.data);
                    return resolve();
                })
                .catch(error => {
                    console.log(error);
                    return reject();
                });
            });
        },

        // 문의게시글 관리자 답변 작성
        questionStore(context, data) {
            const url = `/api/admin/question/${data.board_id}`;
            const config = {
                // headers: {
                //     'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                // },
                params: data,
            }

            axios.post(url, null, config)
            .then(response => {
                // console.log('js: ', response.data.question);
                alert('답변 작성 완료');
            })
            .catch(error => {
                console.log(error);
            });
        },

        // 게시글 삭제
        destroyQuestion(context, id) {
            const url = `/api/questions/${id}`;
            // const config = {
            //     headers: {
            //         'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
            //     }
            // }

            axios.delete(url)
            .then(response => {
                alert('삭제 성공');
                router.push('/admin/question');
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