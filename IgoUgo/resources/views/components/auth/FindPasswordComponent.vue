<template>
    <div class="form-box">
        <div class="title-box">
            <h1>비밀번호 찾기</h1>
            <p>이메일 인증 후 비밀번호를 변경하실 수 있습니다.</p>
        </div>
        <!-- <p v-for="msg in $store.state.auth.errorMsgList" :key="msg">{{ msg }}</p> -->
        <div class="verify-box">
            <div class="login-btn-flex">
                <input v-model="userInfo.user_email" type="email" name="user_email" class="input-verify" placeholder="이메일 입력">
                <!-- <span v-if="emailError" class="error-message">{{ emailError }}</span> -->
                <button @click="findPassword(userInfo)" class="btn bg-navy btn-verify">인증메일 발송</button>
                <!-- <button @click="chkEmail" class="btn bg-clear btn-chk">중복확인</button> -->
            </div>
            <!-- <div v-if="errMsg">{{ Msg }}</div> -->
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const userInfo = reactive({
    user_email: '',
});

const findPassword = (userInfo) => {
    console.log('유저정보 :', userInfo.user_email);  
    store.dispatch('auth/findPW', userInfo);
}
</script>

<style scoped>
@font-face {
    font-family: 'SUITE-Regular';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2304-2@1.0/SUITE-Regular.woff2') format('woff2');
    font-weight: 400;
    font-style: normal;
}

.form-box {
    /* display: grid;
    grid-template-columns: 1fr; */
    gap: 30px;
    place-items: center;
    /* margin: 100px auto 55px auto; */
    margin: 100px auto 23px auto;
    /* max-width: 450px; */
    padding: 0 20px 20px;
}

.title-box {
    color: #01083a;
    margin-bottom: 90px;
}

h1 {
    /* color: #01083a; */
    font-size: 3.5rem;
    font-weight: 900;
    /* margin-bottom: 100px; */
    margin-bottom: 20px;
}

.verify-box {
    max-width: 500px;
    margin: 50px auto 0;
    padding: 0 40px;
    background: #fff;
    border-radius: 4px;
    display: grid;
    grid-template-rows: 1fr 1fr;
    gap: 20px;
}

.login-form > p {
    color: red;
    font-size: 13px;
}

.input-verify{
    /* background: #F5F5F5;
    min-width: 350px;
    padding: 15px 20px;
    font-size: 18px;
    border-radius: 20px; */

    height: 50px;
    padding: 5px 10px;
    font-size: 15px;
    border-bottom: 1px solid #01083a;
    background: transparent;
}

.login-btn-flex {
    display: grid;
    grid-template-columns: 1fr 80px;
    align-items: center;
    gap: 30px;
}

.login-btn {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.btn-chk {
    width: 90px;
    height: 35px;
    font-size: 18px;
    border-radius: 50px;
    border: 1px solid #01083a;
}

.btn-chk:hover {
    color: #fff;
    background-color: #01083a;
}

.btn-verify {
    width: 120px;
    height: 40px;
    font-size: 18px;
    border-radius: 50px;
    margin: 0 auto;
}
</style>