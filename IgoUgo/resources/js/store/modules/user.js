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
        // 회원가입
        registration(context, userInfo) {
            const url = '/api/registration';

            const formData = new FormData();
            formData.append('email', userInfo.email);
            formData.append('password', userInfo.password);
            formData.append('password_chk', userInfo.password_chk);
            formData.append('name', userInfo.name);
            formData.append('nickname', userInfo.nickname);
            formData.append('phone', userInfo.phone);

            axios.post(url, formData)
            .then(() => {
                alert('회원가입 성공');

                router.replace('/login');
            })
            .catch(error => {
                console.log(error.response.data);
                alert('회원가입 실패');
            });
        },

        // 토큰 만료 후 처리
        chkTokenAndContinueProcess(context, callbackProcess) {
            // Payload 획득
            const payload = localStorage.getItem('accessToken').split('.')[1];
            const base64 = payload.replace(/-/g, '+').replace(/_/g, '/');
            const objPayload = JSON.parse(window.atob(base64));

            // console.log(payload, base64, objPayload);
            
            const now = new Date();
            if((objPayload.exp * 1000) > now.getTime()){
                // 토큰 유효

                // console.log('토큰 유효');
                callbackProcess();
            } else {
                // 토큰 만료

                // console.log('토큰 만료');
                // 토큰 재발급 필요
                context.dispatch('reissueAccessToken', callbackProcess);
            }
        },

        // 토큰 재발급
        reissueAccessToken(context, callbackProcess) {
            console.log('토큰 재발급 처리');
            callbackProcess();

            const url = '/api/reissue';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('refreshToken')
                }
            };
            axios.post(url, null, config)
            .then(response => {
                // 토큰 세팅
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);

                // 후속 처리 진행
                callbackProcess();
            })
            .catch(error => {
                console.error(error);
            });
        },
        

        // 마이페이지
        showUser() {
            const url = '/api/user';
            const data = JSON.stringify(userInfo);
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                } // bearer token 세팅
            }

            axios(url, data, config)
            .then(response => {
                console.log(response);
                }
            )
            .catch(error => {
                console.error(error);
            });
        },

        updateUser() {

        }
    },
    getters: {

    },
}