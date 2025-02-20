import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        testerList: [],
        testerDetail: null,
    }),
    mutations: {
        setTesterList(state, testerList) {
            state.testerList = testerList;
        },
        setTesterDetail(state, testerDetail) {
            state.testerDetail = testerDetail;
        },
    },
    actions: {
        // 체험단 게시글 리스트
        testerList(context, data) {
            const url = '/api/testers';
            const config = {
                params: data,
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

        // 게시글 상세
        testerDetail(context, data) {
            const url = `/api/testers/${data.board_id}`;
            const config = {
                params: data,
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response.data);
                context.commit('setTesterDetail', response.data.data);
            })
            .catch(error => {
                console.error(error.response.data);
            });
        },
    },
    getters: {

    },
}