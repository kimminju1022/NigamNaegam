<template>
    <div class="form-box">
        <div class="form-header-title">
            <h1>이메일 인증</h1>
        </div>

        <div class="login-form">
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="email">이메일</label>
                    <!-- 유효성 검사 실패 시에만 메시지 표시 -->
                    <span v-if="emailError" class="error-message">{{ emailError }}</span>
                </div>   
                <div class="login-btn-flex">
                    <input v-model="userInfo.user_email" class="input-login" type="email" id="email" name="user_email" placeholder="이메일을 입력해주세요">
                    <button @click="chkEmail" class="btn bg-clear btn-chk">중복확인</button>
                </div>
            </div>
            <div class="registration-btn">
                <button @click="$router.replace('/login')" class="btn bg-clear btn-cancel">취소</button>
                <button @click="$store.dispatch('user/registration', userInfo)" class="btn bg-navy btn-registration">회원가입</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref, watch } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const userInfo = reactive({
    user_email: ''
});

// 중복 확인
const chkEmail = () => {
    store.dispatch('user/chkAvailableEmail', userInfo.user_email);
}

// 에러메시지
const emailError = ref('');

// 이메일 유효성 검사 함수
const validateEmail = (user_email) => {
    if (!user_email) {
        return ''; // input 비어 있을 때 메시지 숨김
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(user_email) ? '' : '이메일 형식에 맞지 않습니다.';
};


watch(userInfo, (newObj) => {
    emailError.value = validateEmail(newObj.user_email);
});

</script>

<style scoped>
label::before {
    content: '* ';
    color: #ff0000;
}

input {
    border-bottom: 1px solid #01083a;
    background: transparent;
}

input::placeholder {
    opacity: 0.6;
}

.form-box {
    /* display: grid;
    grid-template-columns: 1fr; */ 
    /* grid안지우면 width지워도 적용안되는데 왜지 */
    gap: 30px;
    place-items: center;
    /* margin: 90px auto; */
    margin: 60px auto;
    width: 450px;
    padding: 0 20px 20px;
}

.form-header-title {
    place-items: center;
    margin-bottom: 50px;
    color: #01083a;
}

h1 {
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 10px;
}

.login-form {
    display: grid;
    gap: 10px;
    /* place-items: center; */
    margin: 0 auto;
}

.login-input-box {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 15px;
}

.login-label-flex {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 20px;
}

.login-btn-flex {
    /* display: flex;
    justify-content: flex-start;
    align-items: center; */
    display: grid;
    grid-template-columns: 1fr 80px;
    align-items: center;
    gap: 20px;
}

.btn-chk {
    width: 80px;
    height: 30px;
    font-size: 15px;
    border-radius: 50px;
    border: 1px solid #01083a;
}

.btn-chk:hover {
    color: #fff;
    background-color: #01083a;
}

.login-label-flex > label {
    font-size: 19px;
    font-weight: 500;
}

span {
    color: red;
    font-size: 13px;
}

.password-regex {
    display: flex;
    gap: 5px;
    font-size: 13px;
    color:#4c4c4c;
}

.password-regex-chk {
    color:green;
}

.input-login {
    /* width: 400px; */
    height: 50px;
    padding: 5px 10px;
    font-size: 15px;
}

.registration-btn {
    display: flex;
    gap: 20px;
    margin-top: 50px;
}

.btn-registration {
    width: 150px;
    height: 40px;
    font-size: 1.1rem;
    font-weight: 500;
    border-radius: 20px;
}

.btn-registration:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
}

.btn-cancel {
    width: 150px;
    height: 40px;
    font-size: 1.1rem;
    font-weight: 500;
    border-radius: 20px;
    border: 2px solid #01083a;
}
.btn-cancel:hover {
    color: #fff;
    background-color: #01083a;
}
</style>