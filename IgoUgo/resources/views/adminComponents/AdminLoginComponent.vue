<template>
<div class="form-box">
    <h1>로그인</h1>
    <div class="login-form">
        <p v-for="msg in $store.state.auth.errorMsgList" :key="msg">{{ msg }}</p>
        <input v-model="userInfo.user_email" class="input-login" type="email" placeholder="e-mail" name="user_email">
        <input v-model="userInfo.user_password" class="input-login" type="password" placeholder="password" name="user_password">
    </div>
    <div class="login-btn">
        <button @click="$store.dispatch('auth/login', userInfo)" class="btn bg-navy btn-login">로그인</button>
    </div>
</div>
</template>

<script setup>
import { reactive } from 'vue';

const userInfo = reactive({
    user_email: ''
    ,user_password: ''
});
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
    /* margin: 50px auto 23px auto; */
    max-width: 450px;
    /* padding: 0 20px 20px; */
    margin: 0 auto;
    padding-top: 280px;
}

.login-form{
    display: grid;
    gap: 10px;
    margin: 0 auto;
}

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

.input-login{
    background: #d5d5d5;
    min-width: 350px;
    padding: 15px 20px;
    font-size: 18px;
    border-radius: 20px;
}

.login-btn {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.btn-login {
    min-width: 350px;
    height: 50px;
    font-size: 20px;
    font-weight: 500;
    border-radius: 20px;
}
</style>