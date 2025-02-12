import axios from "../../../axios";

export default {
    namespaced: true,
    state: () => ({
        userList: [],
        userDetail: {},
        userBoardCnt: [],
        userCommentCnt: null,
        userControlCnt: null,
    }),
    mutations: {
        setUserList(state, list) {
            state.userList = list;
        },
        setUserDetail(state, data) {
            state.userDetail = data;
        },
        setUserBoardCnt(state, list) {
            state.userBoardCnt = list;
        },
        setUserCommentCnt(state, data) {
            state.userCommentCnt = data;
        },
        setUserControlCnt(state, data) {
            state.userControlCnt = data;
        },
    },
    actions: {
        showUserList(context, searchData) {
            const url = '/api/admin/user';
            const config = {
                params: searchData,
            }

            axios.get(url, config)
            .then(response => {
                context.commit('setUserList', response.data.userList.data);
                context.commit('pagination/setPagination', response.data.userList, {root: true});
            })
            .catch(error => {
                console.error(error);
            });
        },

        showUserDetail(context, findData) {
            const url = '/api/admin/user/' + findData.user_id;
            const config = {
                params: findData
            };

            axios.get(url, config)
            .then(response => {
                context.commit('setUserDetail', response.data.userDetail);
                // console.log(response.data.userDetail);
            })
            .catch(error => {
                console.error(error);
            });
        },

        showUserBoardCnt(context, findData) {
            const url = '/api/admin/user/' + findData.user_id + '/boardcnt';
            const config = {
                params: findData
            };

            axios.get(url, config)
            .then(response => {
                context.commit('setUserBoardCnt', response.data.userBoardCnt);
                // console.log(response.data.userBoardCnt);
            })
            .catch(error => {
                console.error(error);
            });
        },

        showUserCommentCnt(context, findData) {
            const url = '/api/admin/user/' + findData.user_id + '/commentcnt';
            const config = {
                params: findData
            };

            axios.get(url, config)
            .then(response => {
                context.commit('setUserCommentCnt', response.data.userCommentCnt);
                // console.log(response.data.userCommentCnt);
            })
            .catch(error => {
                console.error(error);
            })
        },

        showUserControlCnt(context, findData) {
            const url = '/api/admin/user/' + findData.user_id + '/controlcnt';
            const config = {
                params: findData
            };

            axios.get(url, config)
            .then(response => {
                context.commit('setUserControlCnt', response.data.userControlCnt);
            })
            .catch(error => {
                console.error(error);
            })
        },
    },
    getters: {
    
    },
}