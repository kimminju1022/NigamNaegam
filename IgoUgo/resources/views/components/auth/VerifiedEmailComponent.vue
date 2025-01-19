<template>
    <div class="form-box">
        <h1>이메일 인증하기</h1>
        <!-- <p v-for="msg in $store.state.auth.errorMsgList" :key="msg">{{ msg }}</p> -->
        <input v-model="user_email" type="email" name="user_email" class="input-verify" placeholder="이메일 입력">
        <button @click="verifyEmail" class="btn bg-navy btn-verify">인증하기</button>
        <div v-if="errMsg">{{ Msg }}</div>
    </div>
<!-- 
    <div class="form-box">
        <h1>이메일 인증하기</h1>
        <div class="login-form">
            <p v-for="msg in $store.state.auth.errorMsgList" :key="msg">{{ msg }}</p>
            <input v-model="userInfo.user_email" class="input-login" type="email" placeholder="e-mail" name="user_email">
        </div>
        <div class="login-btn">
            <button @click="$store.dispatch('auth/login', userInfo)" class="btn bg-navy btn-login">인증하기</button>
        </div>
    </div> -->
</template>

<script setup>
import { reactive, ref, } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

// const userInfo = reactive({
//     user_email: ''
// });
// const user_email = ref('');

const userInfo = computed(()=> store.state.auth.userInfo);
const errMsg = '';

const verifyEmail = () => {
    store.dispatch('verification/send', userInfo.user_email.value);
};
</script>

<style scoped>
@font-face {
    font-family: 'SUITE-Regular';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2304-2@1.0/SUITE-Regular.woff2') format('woff2');
    font-weight: 400;
    font-style: normal;
}

.form-box {
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
    place-items: center;
    margin: 41px auto 0 auto;
    max-width: 450px;
    padding: 0 20px 20px;
}

/* .login-form{
    display: grid;
    gap: 10px;
    margin: 0 auto;
} */

h1 {
    color: #01083a;
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 30px;
}

.login-form > p {
    color: red;
    font-size: 13px;
}

.input-verify{
    background: #F5F5F5;
    min-width: 350px;
    padding: 15px 20px;
    font-size: 18px;
    border-radius: 20px;
}

.login-btn {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.btn-verify {
    min-width: 150px;
    height: 50px;
    font-size: 20px;
    font-weight: 500;
    border-radius: 20px;
}
</style>