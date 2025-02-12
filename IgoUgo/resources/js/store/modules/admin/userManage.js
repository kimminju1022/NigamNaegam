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
        // 유저 리스트
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

        // 유저 상세정보
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

        // 유저가 작성한 게시글 수
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

        // 유저가 작성한 댓글 수
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

        // 유저 제재 횟수
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

        // 유저 정보 수정
        updateUserDetail(context, user) {
            const url = '/api/admin/user/' + user.userDetail.user_id + '/updatedetail';
            const config = {
                params: user.userDetail.user_id
            };

            const formData = new FormData();

            formData.append('user_email', user.userDetail.user_email);
            formData.append('user_name', user.userDetail.user_name);
            formData.append('user_nickname', user.userDetail.user_nickname);
            formData.append('user_phone', user.userDetail.user_phone);

            axios.post(url, formData, config)
            .then(response => {
                context.commit('setUserList', response.data.user);
                alert('수정 성공');
            })
            .catch(error => {
                alert('수정 실패');
                console.error(error);
            });
        },
    },
    getters: {
    
    },
}