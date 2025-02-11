import axios from 'axios';
// import router from '../../../router';

export default {
    namespaced: true,
    state: () => ({
        dailyUser: [],
        dailyDeleteUser: [],
        dailyReview: [],
        dailyFree: [],
        dailyQuestionYet: [],
        dailyQuestionDone: [],
    }),
    mutations: {
        setDailyUser(state, dailyUser) {
            state.dailyUser = dailyUser;
        },
        setDailyDeleteUser(state, dailyDeleteUser) {
            state.dailyDeleteUser = dailyDeleteUser;
        },
        setDailyReview(state, dailyReview) {
            state.dailyReview = dailyReview;
        },
        setDailyFree(state, dailyFree) {
            state.dailyFree = dailyFree;
        },
        setDailyQuestionYet(state, dailyQuestionYet) {
            state.dailyQuestionYet = dailyQuestionYet;
        },
        setDailyQuestionDone(state, dailyQuestionDone) {
            state.dailyQuestionDone = dailyQuestionDone;
        },
    },

    actions: { 
        // 일일 가입자 수
        dailyUser(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/daily/user/signup';
    
                axios.get(url)
                .then(response => {
                    context.commit('setDailyUser', response.data.data);
                    // console.log(response.data.data);
                    return resolve();
                })
                .catch(error => {
                    console.log('에러났당');
                    console.log(error);
                    return reject();
                }); 
            });
        },

        // 일일 탈퇴자 수
        dailyDeleteUser(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/daily/user/delete';
    
                axios.get(url)
                .then(response => {
                    context.commit('setDailyDeleteUser', response.data.data);
                    // console.log(response.data.data);
                    return resolve();
                })
                .catch(error => {
                    console.log('에러났당');
                    console.log(error);
                    return reject();
                }); 
            });
        },

        // 일일 리뷰게시글 수
        dailyReview(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/daily/review';
    
                axios.get(url)
                .then(response => {
                    context.commit('setDailyReview', response.data.data);
                    // console.log(response.data.data);
                    return resolve();
                })
                .catch(error => {
                    console.log('에러났당');
                    console.log(error);
                    return reject();
                }); 
            });
        },

        // 일일 자유게시글 수
        dailyFree(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/daily/free';
    
                axios.get(url)
                .then(response => {
                    context.commit('setDailyFree', response.data.data);
                    // console.log(response.data.data);
                    return resolve();
                })
                .catch(error => {
                    console.log('에러났당');
                    console.log(error);
                    return reject();
                }); 
            });
        },

        // 일일 자유게시글 수
        dailyQuestionYet(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/daily/question/yet';
    
                axios.get(url)
                .then(response => {
                    context.commit('setDailyQuestionYet', response.data.data);
                    // console.log(response.data.data);
                    return resolve();
                })
                .catch(error => {
                    console.log('에러났당');
                    console.log(error);
                    return reject();
                }); 
            });
        },

        // 일일 자유게시글 수
        dailyQuestionDone(context) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/daily/question/done';
    
                axios.get(url)
                .then(response => {
                    context.commit('setDailyQuestionDone', response.data.data);
                    // console.log(response.data.data);
                    return resolve();
                })
                .catch(error => {
                    console.log('에러났당');
                    console.log(error);
                    return reject();
                }); 
            });
        },
    },

    getters: {
    },
};