import axios from "../../axios";

export default {
    state: () => ({
        userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
    }),
    mutations: {
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
    },
    actions: {
        /**
         * 회원가입
         */
        registration(context, userInfo) {
            const url = '/api/registration';
            const formData = new FormData();


            axios.post(url, data)
            .then(() => {
                alert('회원가입 성공');

                router.replace('/login');
            })
            .catch(error => {
                console.log(error);
            });
        },

        /**
         * 토큰 만료 후 처리
         */

        /**
         * 토큰 재발급
         */
    },
    getters: {

    },
}