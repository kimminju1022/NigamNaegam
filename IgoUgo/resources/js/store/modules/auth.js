import axios from "../../axios";

export default {
    state: () => ({
        authFlg: localStorage.getItem('accessToken') ? true : false,
        userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
    }),
    mutations: {
        setAuthFlg(state, flg) {
            state.authFlg = flg;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
    },
    actions: {
        /**
         * 로그인
         * 
         * @param {*}   context
         * @param {*}   userInfo
         */
        login(context, userInfo) {
            const url = '/api/login';
            const data = JSON.stringify(userInfo);

            axios.post(url, data)
            .then(response => {
            })
            .catch(error => {
            });
        },

        /**
         * 로그아웃
         */
        logout(context, userInfo) {

        },
    },
    getters: {

    },
}