import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
        controllFlg: true,
        errorMsgList: [],
    }),
    mutations: {
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
        setControllFlg(state, flg) {
            state.controllFlg = flg;
        },
        setErrorMsgList(state, msgList) {
            state.errorMsgList = msgList;
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
            .then(response => {
                alert('회원가입 성공');

                localStorage.removeItem('verifiedEmail');
                router.replace('/login');
            })
            .catch(error => {               
                let errorMsgList = [];
                const errorData = error.response.data;

                if(error.response.status === 422) {
                    if(errorData.data.user_email) {
                        errorMsgList.push(errorData.data.user_email[0]);
                    }
                    if(errorData.data.user_password) {
                        errorMsgList.push(errorData.data.user_password[0]);
                    }
                    if(errorData.data.user_nickname) {
                        errorMsgList.push(errorData.data.user_nickname[0]);
                    }
                    if(errorData.data.user_phone) {
                        errorMsgList.push(errorData.data.user_phone[0]);
                    }
                } else if(error.response.status === 401) {
                    errorMsgList.push(errorData.msg);
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }

                alert(errorMsgList.join('\n'));
            });
        },

        // 유저 정보 업데이트
        updateUser(context, userData) {
            context.dispatch('auth/chkTokenAndContinueProcess'
                , () => {
                    if(context.state.controllFlg){
                        const url = `/api/user/${userData.userInfo.user_id}`;
                        const config = {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                            }
                        }

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
                            localStorage.setItem('userInfo', JSON.stringify(response.data.userInfo));

                            alert('수정 성공');
                            router.replace(`/user/${userData.userInfo.user_id}`);
                            }
                        )
                        .catch(error => {
                            let errorMsgList = [];
                            const errorData = error.response.data;
            
                            if(error.response.status === 422) {
                                if(errorData.data.user_email) {
                                    errorMsgList.push(errorData.data.user_email[0]);
                                }
                                if(errorData.data.user_password) {
                                    errorMsgList.push(errorData.data.user_password[0]);
                                }
                                if(errorData.data.user_nickname) {
                                    errorMsgList.push(errorData.data.user_nickname[0]);
                                }
                                if(errorData.data.user_phone) {
                                    errorMsgList.push(errorData.data.user_phone[0]);
                                }
                            } else if(error.response.status === 401) {
                                errorMsgList.push(errorData.msg);
                            } else {
                                errorMsgList.push('예기치 못한 오류 발생');
                            }
            
                            alert(errorMsgList.join('\n'));
                            // alert('수정 실패');
                        });
                    } 
                }
                , {root: true})
        },

        // 유저 탈퇴
        destroyUser(context, userInfo) {
            context.dispatch('auth/chkTokenAndContinueProcess'
                , () => {
                    if(context.state.controllFlg){
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
                            localStorage.clear();
                            
                            context.commit('auth/setAuthFlg', false, {root:true});
                            context.commit('auth/setUserInfo', {}, {root:true});
                            
                            alert('탈퇴 성공');
                            router.replace('/');
                        })
                        .catch(error => {
                            console.error(error);
                            alert('탈퇴 실패');
                        });
                    } 
                }
                , {root: true})
        },

        // 유저 비밀번호 확인
        chkPW(context, userInfo) {
            context.dispatch('auth/chkTokenAndContinueProcess'
                , () => {
                    if(context.state.controllFlg){
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
                            console.log(error.response.data);

                            if(error.response.status === 422) {
                                // if(errorData.data.user_password) {
                                    errorMsgList.push('비밀번호가 틀렸습니다.');
                                // }
                                // else {
                                    // errorMsgList.push(errorData);
                                // }
                            } 
                            else if(error.response.status === 401) {
                                errorMsgList.push('비밀번호가 틀렸습니다.');
                            } 
                            else {
                                errorMsgList.push('예기치 못한 오류 발생');
                            }
                            
                            context.commit('auth/setErrorMsgList', errorMsgList, {root: true});
                            alert(errorMsgList);
                        });
                    } 
                }
                , {root: true})
        },

        // 유저 비밀번호 업데이트
        updateUserPW(context, userInfo) {
            context.dispatch('auth/chkTokenAndContinueProcess'
                , () => {
                    if(context.state.controllFlg){
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
                            alert('비밀번호가 성공적으로 변경되었습니다.');

                            localStorage.clear();
                            context.commit('auth/setAuthFlg', false, {root: true});
                            context.commit('auth/setUserInfo', {}, {root: true});
                
                            router.replace('/login');
                        })
                        .catch(error => {
                            console.log(error.response);
                            let errorMsgList = [];
                            const errorData = error.response.data;

                            if(error.response.status === 400) {
                                errorMsgList.push('현재 비밀번호가 일치하지 않습니다.');
                            // } else if(error.response.status === 401) {
                            //     errorMsgList.push('현재 비밀번호가 올바르지 않습니다.');
                            } else if(error.response.status === 422) {
                                if(errorData.data.newPassword) {
                                    errorMsgList.push('비밀번호 형식이 맞지 않습니다.');
                                } else if(errorData.data.newPasswordChk)  {
                                    errorMsgList.push('비밀번호가 일치하지 않습니다.');
                                } else if(errorData.data.currentPassword) {
                                    errorMsgList.push('현재 비밀번호가 올바르지 않습니다.');
                                }
                            } else {
                                errorMsgList.push('비밀번호 변경 중 오류가 발생했습니다. 다시 시도해주세요.');
                            }

                            alert(errorMsgList.join('\n'));
                        });
                    } 
                }
                , {root: true})
        },

        // 이메일 중복체크
        chkAvailableEmail(context, user_email) {
            const url = '/api/available/email';
            const data = JSON.stringify({ user_email: user_email });

            // console.log(user_email,data);
            
            axios.post(url, data)
            .then(response => {
                // console.log(response.data);

                sessionStorage.setItem('EmailChk', true);
                alert('사용가능한 이메일입니다.');
            })
            .catch(error => {
                let errorMsgList = [];
                console.log(error.response.data);

                if(error.response.status === 422 || error.response.status === 401) {
                errorMsgList.push(error.response.data.data.user_email[0]);
                } else if(error.response.status === 409) {
                    errorMsgList.push(error.response.data.data.user_email[0]);
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }
                
                sessionStorage.removeItem('EmailChk');
                context.commit('setErrorMsgList', errorMsgList);
                alert(errorMsgList.join('\n'));
            });
        },

        // 전화번호 중복체크
        chkAvailablePhone(context, user_phone) {
            const url = '/api/available/phone';
            const data = JSON.stringify({ user_phone: user_phone });

            // console.log(user_phone,data);

            axios.post(url, data)
            .then(response => {
                // console.log(response.data);
                alert('사용가능한 전화번호입니다.');
            })
            .catch(error => {
                let errorMsgList = [];
                console.log(error.response.data);
                
                if(error.response.status === 422 || error.response.status === 401) {
                errorMsgList.push(error.response.data.data.user_phone[0]);
                } else if(error.response.status === 409) {
                    errorMsgList.push(error.response.data.data.user_phone[0]);
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }
                
                context.commit('setErrorMsgList', errorMsgList);
                alert(errorMsgList.join('\n'));
            });
        },

        // 이메일 인증 후 비밀번호 변경
        verifiedPWUpdate(context, userInfo) {
            const url = `/api/verify/pw/${userInfo.user_id}`;
            const data = {
                user_id: userInfo.id,
                newPassword: userInfo.newPassword,
                newPasswordChk: userInfo.newPasswordChk,
            };


            axios.put(url, data)
            .then(response => {
                alert('비밀번호가 성공적으로 변경되었습니다.');

                localStorage.clear();
                // context.commit('auth/setUserInfo', {}, {root: true});
    
                router.replace('/login');
            })
            .catch(error => {
                console.log(error.response);
                let errorMsgList = [];
                const errorData = error.response.data;

                if(error.response.status === 400) {
                    errorMsgList.push('현재 비밀번호가 일치하지 않습니다.');
                // } else if(error.response.status === 401) {
                //     errorMsgList.push('현재 비밀번호가 올바르지 않습니다.');
                } else if(error.response.status === 422) {
                    if(errorData.data.newPassword) {
                        errorMsgList.push('비밀번호 형식이 맞지 않습니다.');
                    } else if(errorData.data.newPasswordChk)  {
                        errorMsgList.push('비밀번호가 일치하지 않습니다.');
                    }
                } else {
                    errorMsgList.push('비밀번호 변경 중 오류가 발생했습니다. 다시 시도해주세요.');
                }

                alert(errorMsgList.join('\n'));
            });
        }
    },
    getters: {

    },
}