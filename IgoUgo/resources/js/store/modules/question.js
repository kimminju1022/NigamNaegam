import axios from "../../axios";
// import router from '../../router';

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
        setQuestionDetail(state, question) {
            state.questionDetail = question;
        },
    },
    actions: {
        // 문의내역 리스트
        getQuestionList(context, searchData) {
            const url = '/api/questions';
            const config = {
                params: searchData,
            }

            axios.get(url, config)
            .then(response => {
                console.log('getUserQuestionList',response.data);
                context.commit('setQuestionList', response.data.data.data);
                context.commit('pagination/setPagination', response.data.data, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        // 유저 1:1 문의내역
        getUserQuestionList(context, searchData) {
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

        // 문의 게시글 상세
        getQuestionDetail(context, data) {
            const url = `/api/questions/${data.board_id}`;

            axios.get(url, config)
            .then(response => {
                // console.log(response);
                context.commit('setQuestionDetail', response.data.question);
            })
            .catch(error => {
                console.error(error);
            });
        }
    },
    getters: {
    },
}