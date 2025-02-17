import axios from "../../../axios";

export default {
    namespaced: true,
    state: () => ({
        userList: [],
        userDetail: {},
        userBoardCnt: [],
        userCommentCnt: null,
        userControl: [],
        userBoardReport: [],
        userCommentReport: [],
        userTodaySignUpCnt: null,
        userTodayDeleteCnt: null,
        userTodayOutCnt: null,
        userTodayControlCnt: null,
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
        setUserControl(state, data) {
            state.userControl = data;
        },
        setUserBoardReport(state, list) {
            state.userBoardReport = list;
        },
        setUserCommentReport(state, list) {
            state.userCommentReport = list;
        },
        setUserTodaySignUpCnt(state, data) {
            state.userTodaySignUpCnt = data;
        },
        setUserTodayDeleteCnt(state, data) {
            state.userTodayDeleteCnt = data;
        },
        setUserTodayOutCnt(state, data) {
            state.userTodayOutCnt = data;
        },
        setUserTodayControlCnt(state, data) {
            state.userTodayControlCnt = data;
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

        // 유저 제재 이력
        showUserControl(context, findData) {
            const url = '/api/admin/user/' + findData.user_id + '/controlcnt';
            const config = {
                params: findData
            };

            axios.get(url, config)
            .then(response => {
                context.commit('setUserControl', response.data);
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
                context.commit('setUserDetail', response.data.user);
                alert('수정 성공');
            })
            .catch(error => {
                alert('수정 실패');
                console.error(error);
            });
        },

        // 유저 신고 당한 게시글 리스트
        showBoardReport(context, findData) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/user/' + findData.user_id + '/boardreport';
                const config = {
                    params: findData
                };

                axios.get(url, config)
                .then(response => {
                    context.commit('setUserBoardReport', response.data.boardReport.data);
                    context.commit('pagination/setAdminUserBoardReportPagination', response.data.boardReport, {root: true});
                    return resolve();
                })
                .catch(error => {
                    console.error(error);
                    return reject();
                })
            })
        },

        // 유저 신고 당한 댓글 리스트
        showCommentReport(context, findData) {
            return new Promise((resolve, reject) => {
                const url = '/api/admin/user/' + findData.user_id + '/commentreport';
                const config = {
                    params: findData
                };

                axios.get(url, config)
                .then(response => {
                    context.commit('setUserCommentReport', response.data.commentReport.data);
                    context.commit('pagination/setAdminUserCommentReportPagination', response.data.commentReport, {root: true});
                    return resolve();
                })
                .catch(error => {
                    console.error(error);
                    return reject();
                })
            })
        },

        // 오늘 유저 현황
        // 신규 회원 수
        showUserTodaySignUpCnt(context) {
            const url = '/api/admin/today/signup';

            axios.get(url)
            .then(response => {
                context.commit('setUserTodaySignUpCnt', response.data.signupCnt);
                // console.log(response.data.signupCnt);
            })
            .catch(error => {
                console.error(error);
            })
        },
        // 탈퇴 회원 수
        showUserTodayDeleteCnt(context) {
            const url = '/api/admin/today/delete';

            axios.get(url)
            .then(response => {
                context.commit('setUserTodayDeleteCnt', response.data.deleteCnt);
            })
            .catch(error => {
                console.error(error);
            })
        },
        // 강퇴 회원 수
        showUserTodayOutCnt(context) {
            const url = '/api/admin/today/out';

            axios.get(url)
            .then(response => {
                context.commit('setUserTodayOutCnt', response.data.outCnt);
            })
            .catch(error => {
                console.error(error);
            })
        },
        // 제재 받은 회원 수
        showUserTodayControlCnt(context) {
            const url = '/api/admin/today/control';

            axios.get(url)
            .then(response => {
                context.commit('setUserTodayControlCnt', response.data.controlCnt);
            })
            .catch(error => {
                console.error(error);
            })
        },

        // 제재 기간 적용
        updateUserControl(context, control) {
            const url = '/api/admin/user/' + control.user_id + '/updatecontrol';
            const config = {
                params: control.user_id
            };

            const formData = new FormData();

            formData.append('expires_at', control.expires_at);

            axios.post(url, control, config)
            .then(response => {
                context.commit('setUserDetail', response.data.userControl);
                alert('적용되었습니다.');
            })
            .catch(error => {
                alert('적용 실패하였습니다.');
                console.error(error);
            });
        },
    },
    getters: {
    
    },
}