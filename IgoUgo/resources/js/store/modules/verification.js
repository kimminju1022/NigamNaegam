import axios from 'axios';
import router from '../../router';

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
            const url = '/api/email/verification-notification';
            // const data = JSON.stringify(userInfo.user_email);
            const data = {
                user_email: userInfo.user_email,
                // user_id: userInfo.user_id, 
            };
            // const config = {
            //     headers: {
            //         'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
            //     }
            // };

            console.log(data);

            axios.post(url, data)
            .then((response) => {
                console.log(response.data);
                console.log('이메일 전송 성공');
                alert('이메일 전송 성공');
                // errMsg.value = "이메일 전송 성공"
                // router.replace('/');
            })
            .catch((error) => {
                console.error(error.response.data);
                console.log('이메일 전송 실패');
                alert('이메일 전송 실패');
                // errMsg.value = "이메일 전송 실패"
            })
        },
    },

    getters: {
        
    },
};