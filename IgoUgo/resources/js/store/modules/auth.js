import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        accessToken: localStorage.getItem('accessToken') ? localStorage.getItem('accessToken') : '',
        authFlg: localStorage.getItem('accessToken') ? true : false,
        userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
        errorMsgList: [],
    }),
    mutations: {
        setAuthFlg(state, flg) {
            state.authFlg = flg;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
        setAccessToken(state, accessToken) {
            state.accessToken = accessToken;
            localStorage.setItem('accessToken', accessToken);
        },
        setErrorMsgList(state, msgList) {
            state.errorMsgList = msgList;
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

            // console.log(userInfo,data);
            context.commit('setErrorMsgList', []);
            
            axios.post(url, data)
            .then(response => {

                // 토큰 저장
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                context.commit('setAuthFlg', true);
                context.commit('setUserInfo', response.data.data);

                alert('어서와 처음이지');

                // router.replace('/');
                router.go(-1); // 이전 히스토리로 이동
            })
            .catch(error => {
                let errorMsgList = [];
                const errorData = error.response.data;
                if(error.response.status === 422) {
                    // 유효성 체크 에러
                    if(errorData.data.email) {
                        // errorMsgList.push(errorData.data.email[0]);
                        errorMsgList.push('이메일이 유효하지 않습니다.');
                    }
                    if(errorData.data.password) {
                        // errorMsgList.push(errorData.data.password[0]);
                        errorMsgList.push('비밀번호가 유효하지 않습니다.');
                    }
                    
                } else if(error.response.status === 401) {
                    // 비밀번호 오류
                    errorMsgList.push(errorData.msg);
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }

                // alert(errorMsgList.join('\n'));
                context.commit('setErrorMsgList', errorMsgList);
                alert('아이디 또는 비밀번호가 틀렸습니다.');
            });
        },

        /**
         * 로그아웃
         */
        logout(context, userInfo) {
            const url = '/api/logout';
            const config = {
                headers: {
                    // content-type은 axios 불러와서 생략
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                } // bearer token 세팅
            }

            axios.post(url, null, config)
            .then(response => {
                alert('로그아웃 완료');
            })
            .catch(error => {
                alert('문제가 발생하여 로그아웃 처리');
            })
            .finally(() => {
                localStorage.clear();
    
                // state 초기화
                context.commit('setAuthFlg', false);
                context.commit('setUserInfo', {});
    
                router.replace('/');
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

    },
    getters: {

    },
}