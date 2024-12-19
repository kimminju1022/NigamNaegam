<template>
    <div class="form-box">
        <div class="form-header-title">
            <h1>회원가입</h1>
            <p>회원이 되어 다양한 경험을 공유해보세요!</p>
        </div>

        <div class="login-form">
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="email">이메일</label>
                    <!-- 유효성 검사 실패 시에만 메시지 표시 -->
                    <span v-if="emailError" class="error-message">{{ emailError }}</span>
                </div>
                <input v-model="userInfo.user_email" class="input-login" type="text" id="email" name="user_email" placeholder="이메일을 입력해주세요">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="password">비밀번호</label>
                    <!-- 유효성 검사 실패 시 메시지 컬러 red -> green -->
                    <div>
                        <ul class="password-regex">
                            <li :style="color1">{{ msg1 }}</li> <!-- 대소문자 -->
                            <li :style="color2">{{ msg2 }}</li> <!-- 숫자 -->
                            <li :style="color3">{{ msg3 }}</li> <!-- 특수기호 -->
                        </ul>
                    </div>
                </div>
                <input v-model="userInfo.user_password" class="input-login" type="password" id="password" name="user_password" placeholder="비밀번호 입력(문자, 숫자, 특수문자 포함 8 - 20글자)">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="password_chk">비밀번호 확인</label>
                    <!-- 유효성 검사 실패 시에만 메시지 표시 -->
                    <span v-if="passwordChkError">비밀번호가 맞지 않습니다.</span>
                </div>
                <input v-model="userInfo.user_password_chk" class="input-login" type="password" id="password_chk" name="user_password_chk" placeholder="비밀번호 확인">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="name">이름</label>
                    <!-- 유효성 검사 실패 시에만 메시지 표시 -->
                    <span v-if="nameError" >이름 형식에 맞지 않습니다.</span>
                </div>
                <input v-model="userInfo.user_name" class="input-login" type="text" id="name" name="user_name" placeholder="이름을 입력해주세요">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="nickname">닉네임</label>
                    <!-- 유효성 검사 실패 시에만 메시지 표시 -->
                    <span v-if="nicknameError" >닉네임 형식에 맞지 않습니다.</span>
                </div>
                <input v-model="userInfo.user_nickname" class="input-login" type="text" id="nickname" name="user_nickname" placeholder="닉네임을 입력해주세요">
            </div>
            <div class="login-input-box">                
                <div class="login-label-flex">
                    <label for="phone">전화번호</label>
                    <!-- 유효성 검사 실패 시에만 메시지 표시 -->
                    <span v-if="phoneError" >전화번호 형식에 맞지 않습니다.</span>
                </div>
                <input v-model="userInfo.user_phone" class="input-login" type="text" id="phone" name="user_phone" maxlength="13" placeholder="'-'를 생략하고 숫자만 입력해주세요">
            </div>
        </div>
        <div class="registration-btn">
            <button @click="$store.dispatch('user/registration', userInfo)" class="btn bg-navy btn-registration">회원가입</button>
            <button @click="$router.replace('/login')" class="btn bg-clear btn-cancel">취소</button>
        </div>
    </div>
</template>

<script setup>

import { reactive, ref, watch } from 'vue';

const userInfo = reactive({
    user_email: ''
    ,user_password: ''
    ,user_password_chk: ''
    ,user_name: ''
    ,user_nickname: ''
    ,user_phone: ''
});

const emailError = ref('');
const passwordError = ref('');
const passwordChkError = ref('');
const nameError = ref('');
const nicknameError = ref('');
const phoneError = ref('');

const msg1 = ref('✔ 문자');
const msg2 = ref('✔ 숫자');
const msg3 = ref('✔ 특수기호');

const color1 = reactive({color: 'red'});
const color2 = reactive({color: 'red'});
const color3 = reactive({color: 'red'});

// 이메일 유효성 검사 함수
const validateEmail = (user_email) => {
    if (!user_email) {
        return ''; // input 비어 있을 때 메시지 숨김
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(user_email) ? '' : '이메일 형식에 맞지 않습니다.';
};

const validatePassword = (user_password) => {
    const passwordRegex1 = /^.*[a-zA-Z].*$/;
    const passwordRegex2 = /^.*[0-9].*$/;
    const passwordRegex3 = /^.*[!@#$%^&*].*$/;

    if (passwordRegex1.test(user_password)) {
        color1.color = 'green';
    } else {
        color1.color = 'red';
    }
    if (passwordRegex2.test(user_password)) {
        color2.color = 'green';
    } else {
        color2.color = 'red';
    }
    if (passwordRegex3.test(user_password)) {
        color3.color = 'green';
    } else {
        color3.color = 'red';
    }
}

const validatePasswordChk = (user_password_chk, user_password) => {
    if (user_password_chk != user_password) {
        return '비밀번호가 맞지 않습니다.';
    } else {
        return '';
    }
}

const validateName = (user_name) => {
    if (!user_name) {
        return ''; // input 비어 있을 때 메시지 숨김
    }

    const nameRegex = /^[a-zA-Z가-힣]+$/;
    return nameRegex.test(user_name) ? '' : '이름 형식에 맞지 않습니다.';
};

const validateNickname = (user_nickname) => {
    if (!user_nickname) {
        return ''; // input 비어 있을 때 메시지 숨김
    }

    const nicknameRegex = /^[0-9a-zA-Z가-힣]+$/;
    return nicknameRegex.test(user_nickname) ? '' : '닉네임 형식에 맞지 않습니다.';
};

const validatePhone = (user_phone) => {
    if (!user_phone) {
        return ''; // input 비어 있을 때 메시지 숨김
    }

    const phoneRegex = /^[0-9]+$/;
    return phoneRegex.test(user_phone) ? '' : '전화번호 형식에 맞지 않습니다.';
};

watch(userInfo, (newObj) => {
    emailError.value = validateEmail(newObj.user_email);
    passwordError.value = validatePassword(newObj.user_password);
    passwordChkError.value = validatePasswordChk(newObj.user_password_chk, newObj.user_password);
    nameError.value = validateName(newObj.user_name);
    nicknameError.value = validateNickname(newObj.user_nickname);
    phoneError.value = validatePhone(newObj.user_phone);
});

</script>

<style scoped>
input {
    border-bottom: 1px solid #01083a;
    background: transparent;
}
input::placeholder {
    opacity: 0.6;
}
.form-box {
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
    place-items: center;
    margin: 90px auto;
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
    width: 400px;
    height: 50px;
    padding: 5px 10px;
    font-size: 15px;
}
.registration-btn {
    display: flex;
    gap: 20px;
    margin-top: 30px;
}
.btn-registration {
    width: 190px;
    height: 50px;
    font-size: 1.1rem;
    font-weight: 500;
    border-radius: 20px;
}
.btn-cancel {
    width: 190px;
    height: 50px;
    font-size: 1.1rem;
    font-weight: 500;
    border-radius: 20px;
    border: 2px solid #01083a;
}
</style>