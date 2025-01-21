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
                if(error.response.status === 422 || error.response.status === 401) {
                    // // 유효성 체크 에러
                    // if(errorData.data.user_email) {
                    //     // errorMsgList.push(errorData.data.email[0]);
                    //     errorMsgList.push('이메일 형식이 맞지 않습니다.');
                    // }
                    // if(errorData.data.user_password) {
                    //     // errorMsgList.push(errorData.data.password[0]);
                    //     errorMsgList.push('비밀번호 형식이 맞지 않습니다.');
                    // }
                    
                    errorMsgList.push('아이디 또는 비밀번호가 틀렸습니다.');
                // } else if(error.response.status === 401) {
                //     // 비밀번호 오류
                //     errorMsgList.push(errorData.msg);
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                    // errorMsgList.push('아이디 또는 비밀번호가 틀렸습니다.');
                }

                context.commit('setErrorMsgList', errorMsgList);
                // alert(errorMsgList.join('\n'));
                // alert('아이디 또는 비밀번호가 틀렸습니다.');
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

        findPW(context, userInfo) {
            const url = '/api/find/pw/send-email';
            const data = {
                user_email: userInfo.user_email,
            };

            console.log(data);

            axios.post(url, data)
            .then((response) => {
                // console.log(response.data);
                // console.log('이메일 전송 성공');

                alert('해당 이메일로 인증을 완료하세요.');
                // console.log('이메일 전송 성공');
                // errMsg.value = "이메일 전송 성공"

                window.close();
                // window.location.href = 'about:blank';
                router.replace('/');
            })
            .catch((error) => {
                console.error(error.response);
                console.log('이메일 전송 실패');
                alert('이메일 전송 실패');
                // errMsg.value = "이메일 전송 실패"
            })
        },

        verifiedChk(context, verifiedInfo) {
            const url = `/api/find/pw/${verifiedInfo.id}/${verifiedInfo.hash}`;

            axios.get(url)
            .then((response) => {
                console.log(response.data);
                console.log('이메일 인증 성공');
                alert('이메일 인증 성공\n비밀번호 페이지로 이동');
                // errMsg.value = "이메일 전송 성공"

                // localStorage.setItem('verifiedEmail', response.data.user_email);

                // 이거 비밀번호 변경 컴포넌트로 가야함
                // PasswordChangeComponent
                router.replace('/registration');
            })
            .catch((error) => {
                console.error(error.response.data);
                console.log('이메일 인증 실패');
                alert('이메일 인증 실패');
                // errMsg.value = "이메일 전송 실패"
            })
        },
    },
    getters: {

    },
}