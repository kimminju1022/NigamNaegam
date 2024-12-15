<template>
    <div class="form-box">
        <h1>로그인</h1>
        <div class="login-form">
            <!-- v-if 넣어야함 -->
            <!-- <p class="test" :class="test1">아이디 혹은 비밀번호가 일치하지 않습니다.</p> -->
            <p>아이디 혹은 비밀번호가 일치하지 않습니다.</p>
            <input v-model="userInfo.email" class="input-login" type="text" placeholder="e-mail">
            <input v-model="userInfo.password" class="input-login" type="password" placeholder="password">
        </div>
        <div class="login-btn">
            <button @click="$store.dispatch('auth/login', userInfo)" class="btn bg-navy btn-login">로그인</button>
            <div class="go-registration">
                <p>회원이 아니시라면?</p>
                <router-link to="/registration"><button class="btn bg-clear btn-registration">회원가입</button></router-link> 
            </div>
        </div>
    </div>
</template>

<script setup>
// import { reactive, ref, watch } from 'vue';
import { reactive } from 'vue';



// const input = ref('');
// const msg = ref('');
// const color = ref('color: red');

const userInfo = reactive({
    email: ''
    ,password: ''
});

// watch(input, (val) => {
//     console.log(val);
// });


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

.btn-login {
    min-width: 350px;
    height: 50px;
    font-size: 20px;
    font-weight: 500;
    border-radius: 20px;
}

.go-registration {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
}

.go-registration > p {
    color: #4C4C4C;
}

.btn-registration {
    width: 80px;
    font-size: 20px;
    font-weight: 500;
}


/* .test {
    color:gray;
}

.test1 {
    color: green !important;
} */
</style>