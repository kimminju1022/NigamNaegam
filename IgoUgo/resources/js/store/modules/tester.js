import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        testerList: [],
    }),
    mutations: {
        setTesterList(state, testerList) {
            state.testerList = testerList;
        },
    },
    actions: {
        // 체험단 게시글 리스트
        testerList(context, searchData) {
            const url = '/api/testers';
            const config = {
                params: searchData,
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response.data);
                // console.log('getUserQuestionList',response.data);
                context.commit('setTesterList', response.data.data.data);
                context.commit('pagination/setPagination', response.data.data, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },
    },
    getters: {

    },
}