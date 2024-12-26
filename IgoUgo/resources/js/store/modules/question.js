import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        questionList: [],
        page: 0,
    }),
    mutations: {
        setQuestionList(state, questionList) {
            state.questionList = questionList;
        },
        setPage(state, page) {
            state.page = page;
        },
    },
    actions: {
        // 유저 1:1 문의내역
        getUserQuestionList(context,userInfo) {
            const url = `/api/questions/${userInfo.user_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
            }

            axios.get(url, config)
            .then(response => {
                // console.log('getUserQuestionList',response.data);
                context.commit('setQuestionList', response.data.data.data);
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        getUserQuestionPagination(context, data) {
            return new Promise((resolve, reject) => {
                const url = `/api/questions/${userInfo.user_id}`;
                const config = {
                    params: data
                };
    
                axios.get(url, config)
                .then(response => {
                    context.commit('setQuestionList', response.data.data);
                    // 페이지 저장
                    context.commit('pagination/setPagination', response.data, {root: true});
                    console.log(response.data);
                    console.log(response.data.data);
                    return resolve();
                })
                .catch(error => {
                    console.log(error.response);
                    return reject();
                });
            });
        },
    },
    getters: {
    },
}