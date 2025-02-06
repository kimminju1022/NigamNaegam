import axios from 'axios';
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
    }),

    mutations: {
    },

    actions: {
        send(context, userInfo) {
            const url = '/api/email/verification-notification';
            const data = {
                user_email: userInfo.user_email,
            };

            // console.log(data);

            axios.post(url, data)
            .then((response) => {
                // console.log(response.data);
                // console.log('이메일 전송 성공');

                sessionStorage.removeItem('EmailChk');
                alert('해당 이메일로 인증을 완료하세요. \n 브라우저 창이 꺼질 수 있습니다.');      
                // console.log('이메일 전송 성공');
                // errMsg.value = "이메일 전송 성공"

                window.close();
                // window.location.href = 'about:blank';
                router.replace('/');
            })
            .catch((error) => {
                console.error(error.response);
                console.log('이메일 전송 실패');
                // alert('이메일 전송 실패');
                // errMsg.value = "이메일 전송 실패"
            })
        },

        verifiedChk(context, verifiedInfo) {
            const url = `/api/email/verify/${verifiedInfo.id}/${verifiedInfo.hash}`;

            axios.get(url)
            .then((response) => {
                // console.log(response.data);
                // console.log('이메일 인증 성공');          
                // alert('이메일 인증 성공');
                // errMsg.value = "이메일 전송 성공"

                localStorage.setItem('verifiedEmail', response.data.user_email);

                router.replace('/registration');
            })
            .catch((error) => {
                console.error(error.response.data);
                console.log('이메일 인증 실패');
                // alert('이메일 인증 실패');
                // errMsg.value = "이메일 전송 실패"
            })
        },
    },

    getters: {
        
    },
};