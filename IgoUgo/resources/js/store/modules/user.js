import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        // userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
    }),
    mutations: {
        // setUserInfo(state, userInfo) {
        //     state.userInfo = userInfo;
        // },
    },
    actions: {
        // 회원가입
        registration(context, userInfo) {
            const url = '/api/registration';

            const formData = new FormData();
            formData.append('user_email', userInfo.user_email);
            formData.append('user_password', userInfo.user_password);
            formData.append('user_password_chk', userInfo.user_password_chk);
            formData.append('user_name', userInfo.user_name);
            formData.append('user_nickname', userInfo.user_nickname);
            formData.append('user_phone', userInfo.user_phone);

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

        updateUser(context, userInfo) {
            const url = `/api/user/${userInfo.user_id}`;
            const data = JSON.stringify(userInfo);
            const config = {
                headers: {
                    // 'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.put(url, data, config)
            .then(response => {
                // console.log(response.data.userInfo);

                context.commit('auth/setUserInfo', response.data.userInfo, {root: true});
                localStorage.setItem('userInfo', JSON.stringify(response.data.userInfo));


                router.replace(`/user/${userInfo.user_id}`);
                }
            )
            .catch(error => {
                alert('수정 실패');
                console.error(error.response.data);
            });
        },

        destroyUser(context, userInfo) {
            // console.log(userInfo);
            const url = `/api/user/${userInfo.user_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            // console.log(url);
            // console.log(userInfo);

            axios.delete(url, config)
            .then(response => {
                alert('삭제 성공');

                router.replace('/');
            })
            .catch(error => {
                console.error(error);
                alert('삭제 실패');
            });
        }
    },
    getters: {

    },
}