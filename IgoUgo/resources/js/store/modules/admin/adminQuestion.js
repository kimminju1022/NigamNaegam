import axios from 'axios';

export default {
    namespaced: true,
    state: () => ({
        questionYet: [],
        questionDone: [],
    }),
    mutations: {
        setQuestionYet(state, questionYet) {
            state.questionYet = questionYet;
        },
        setQuestionDone(state, questionDone) {
            state.questionDone = questionDone;
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
                    console.log('yet : ', response.data.data.data[0]);
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
                    console.log('done : ', response.data.data.data[0]);
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
    },

    getters: {
    },
}