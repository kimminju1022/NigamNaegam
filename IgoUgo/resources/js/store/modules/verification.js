import axios from 'axios';

export default {
    namespaced: true,
    state: () => ({
        errMsg: '',
        successMsg: ''
    }),

    mutations: {
        setErrorMessage(state, message) {
            state.errMsg = message;
        },
        setSuccessMessage(state, message) {
            state.successMsg = message;
        }
    },

    actions: {
        send(context, userInfo) {
            // const url = `/api/email/verify/${userInfo.user_id}`;
            const url = '/api/email/verification-notification';
            // const data = JSON.stringify(userInfo.user_email);
            const data = {
                user_email: userInfo.user_email,
                user_id: userInfo.user_id,
            };
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            };

            // console.log(data);

            axios.post(url, data, config)
            .then((response) => {
                console.log(response.data);
                console.log('성공??');
                alert('성공인가');
                // errMsg.value = "이메일 전송 성공"
            })
            .catch((error) => {
                console.error(error.response.data);
                console.log('실패??');
                alert('실패인가');
                // errMsg.value = "이메일 전송 실패"
            })
        }
    },

    getters: {
        
    },
};