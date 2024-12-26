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
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
        setUserUnshift(state, userInfo) {
            state.userInfo = userInfo;
        },
        setAuthFlg(state, flg) {
            state.authFlg = flg;
        },
        setAccessToken(state, accessToken) {
            state.accessToken = accessToken;
            localStorage.setItem('accessToken', accessToken);
        },
        setErrorMsgList(state, errorMsgList) {
            state.errorMsgList = errorMsgList;
        },
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
                localStorage.setItem('auth/accessToken', response.data.accessToken);
                localStorage.setItem('auth/refreshToken', response.data.refreshToken);

                // 후속 처리 진행
                callbackProcess();
            })
            .catch(error => {
                console.error(error);
            });
        },

        // 유저 정보 업데이트
        updateUser(context, userData) {
            const url = `/api/user/${userData.userInfo.user_id}`;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            // console.log(userInfo);
            
            const formData = new FormData();

            formData.append('user_name', userData.userInfo.user_name);
            formData.append('user_nickname', userData.userInfo.user_nickname);
            formData.append('user_phone', userData.userInfo.user_phone);
            if (userData.file) {
                formData.append('user_profile', userData.file);
            }

            // for (let [key, value] of formData.entries()) {
            //     console.log(key, value);
            // }
            
            axios.post(url, formData, config)
            .then(response => {

                context.commit('auth/setUserInfo', response.data.userInfo, {root: true});
                localStorage.setItem('auth/userInfo', JSON.stringify(response.data.userInfo), {root: true});

                alert('수정 성공');
                router.replace(`/user/${userData.userInfo.user_id}`);
                }
            )
            .catch(error => {
                alert('수정 실패');
                console.error(error);
            });
        },

        // 유저 탈퇴
        destroyUser(context, userInfo) {
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
        },

        // 유저 비밀번호 확인
        chkPW(context, userInfo) {
            const url = `/api/password/${userInfo.user_id}`;
            const data = JSON.stringify(userInfo);
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            context.commit('auth/setErrorMsgList', [], {root: true});

            axios.post(url, data, config)
            .then(response => {
                
                router.replace(`/password/${userInfo.user_id}/edit`);
            })
            .catch(error => {
                let errorMsgList = [];
                const errorData = error.response.data;

                if(error.response.status === 422) {
                    if(errorData.data.password) {
                        errorMsgList.push('비밀번호가 유효하지 않습니다.');
                    }
                } 
                else if(error.response.status === 401) {
                    errorMsgList.push('비밀번호가 틀렸습니다.');
                } 
                else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }
                
                context.commit('auth/setErrorMsgList', errorMsgList, {root: true});
                // alert(errorMsgList);
            });
        },

        // 유저 비밀번호 업데이트
        updateUserPW(context, userInfo) {
            const url = `/api/password/${userInfo.user_id}`;
            const data = {
                currentPassword: userInfo.currentPassword,
                newPassword: userInfo.newPassword,
                newPasswordChk: userInfo.newPasswordChk,
            };
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.put(url, data, config)
            .then(response => {
                alert('비밀번호가 성공적으로 변경되었습니다!');

                // TODO : 로그아웃 시키고 로그인 페이지로 보내야하나?
                // router.replace(`/user/${userInfo.user_id}`);

                localStorage.clear();
                // localStorage.removeItem('accessToken');
    
                context.commit('auth/setAuthFlg', false, {root: true});
                context.commit('auth/setUserInfo', {}, {root: true});
    
                router.replace('/login');
            })
            .catch(error => {
                console.log(error.response);
                let errorMsgList = [];
                // const errorData = error.response.data;

                if(error.response.status === 422) {
                    alert('비밀번호가 유효하지 않습니다.');
                    errorMsgList.push('비밀번호가 유효하지 않습니다.');
                    
                } else if(error.response.status === 401) {
                    alert('현재 비밀번호가 올바르지 않습니다.');
                    errorMsgList.push('현재 비밀번호가 올바르지 않습니다.');
                } else {
                    alert('비밀번호 변경 중 오류가 발생했습니다. 다시 시도해주세요.');
                    errorMsgList.push('비밀번호 변경 중 오류가 발생했습니다. 다시 시도해주세요.');
                }
                
                context.commit('auth/setErrorMsgList', errorMsgList);
            });
        }
    },
    getters: {

    },
}