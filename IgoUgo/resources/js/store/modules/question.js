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
        /** 게시글획득
         *  @param{*} context
        */

        // 유저 1:1 문의내역
        getUserQuestionList(context,userInfo) {
            const url = `/api/questions/${userInfo.user_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
                // params: {
                //     bc_type: 2,
                //     user_id: userInfo.user_id,
                //     page: context.state.page,
                // },
            }

            axios.get(url, config)
            .then(response => {
                // console.log('getUserQuestionList',response.data);
                context.commit('setQuestionList', response.data.data.data);
            }) 
            .catch(error => {
                console.error(error);
            });

        }
    },
    getters: {
        getNextPage(state){
            return state.page + 1;
        }
    },
}