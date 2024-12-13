import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
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
            formData.append('email', userInfo.email);
            formData.append('password', userInfo.password);
            formData.append('password_chk', userInfo.password_chk);
            formData.append('name', userInfo.name);
            formData.append('nickname', userInfo.nickname);
            formData.append('tel', userInfo.tel);

            // console.log(url);
            // console.log(formData);

            axios.post(url, formData)
            .then(() => {
                alert('회원가입 성공');

                router.replace('/login');
            })
            .catch(error => {
                alert('회원가입 실패');
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