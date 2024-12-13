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
                    <span class="test" :class="test1">이메일 형식에 맞지 않습니다.</span>
                </div>
                <input v-model="userInfo.email" class="input-login" type="text" id="email" name="email" placeholder="이메일을 입력해주세요">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="password">비밀번호</label>
                    <!-- <span>비밀번호 형식에 맞지 않습니다.</span> -->
                    <!-- <div>
                        <ul class="password-regex">
                            <li :class="{password-regex-chk:flg}">대소문자</li>
                            <li :class="{password-regex-chk:flg}">숫자</li>
                            <li :class="{password-regex-chk:flg}">특수기호 !, @</li>
                        </ul>
                    </div> -->
                </div>
                <input v-model="userInfo.password" class="input-login" type="password" id="password" name="password" placeholder="비밀번호 입력(문자, 숫자, 특수문자 포함 8 - 20글자)">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="password_chk">비밀번호 확인</label>
                    <span>비밀번호가 맞지 않습니다.</span>
                </div>
                <input v-model="userInfo.password_chk" class="input-login" type="password" id="password_chk" name="password_chk" placeholder="비밀번호 확인">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="name">이름</label>
                    <span>이름 형식에 맞지 않습니다.</span>
                </div>
                <input v-model="userInfo.name" class="input-login" type="text" id="name" name="name" placeholder="이름을 입력해주세요">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="nickname">닉네임</label>
                    <span>닉네임 형식에 맞지 않습니다.</span>
                </div>
                <input v-model="userInfo.nickname" class="input-login" type="text" id="nickname" name="nickname" placeholder="닉네임을 입력해주세요">
            </div>
            <div class="login-input-box">                
                <div class="login-label-flex">
                    <label for="tel">전화번호</label>
                    <span>전화번호 형식에 맞지 않습니다.</span>
                </div>
                <input v-model="userInfo.tel" class="input-login" type="text" id="tel" name="tel" placeholder="'-'를 생략하고 숫자만 입력해주세요">
            </div>
        </div>
        <div class="registration-btn">
            <button @click="$store.dispatch('user/registration', userInfo)" class="btn bg-navy btn-registration">회원가입</button>
            <button @click="$router.replace('/login')" class="btn bg-clear btn-cancel">취소</button>
        </div>
    </div>
</template>

<script setup>

import { reactive, ref } from 'vue';

// import { ref } from 'vue';

// const flg = ref(false);
// const validatePassword = /^[A-Za-z0-9_\\.\\-]+@[A-Za-z0-9\\-]+\.[A-Za-z0-9\\-]+/;

// if(validatePassword) {
//     flg.value = true;
// }
const userInfo = reactive({
    email: ''
    ,password: ''
    ,password_chk: ''
    ,name: ''
    ,nickname: ''
    ,tel: ''
});

</script>

<style scoped>
@font-face {
    font-family: 'SUITE-Regular';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2304-2@1.0/SUITE-Regular.woff2') format('woff2');
    font-weight: 400;
    font-style: normal;
}
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
    /* background: #F5F5F5; */
    /* border-radius: 20px; */
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


.test {
    color:gray;
}

.test1 {
    color: green !important;
}
</style>