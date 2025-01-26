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
            <!-- <div class="go-registration">
                <p>회원이 아니시라면?</p>
                <router-link to="/registration/chk"><button class="btn bg-clear btn-registration">회원가입</button></router-link> 
            </div> -->
            <!-- <a href="http://127.0.0.1:8000/auth/login/google"><button class="btn btn-goggle"><img src="/images/google_login2.png"></button></a> -->
            <!-- <router-link to="/auth/login/google"><button class="btn btn-goggle"><img src="/images/google_login2.png"></button></router-link> -->
            <button @click="loginWithGoogle" class="btn btn-google"><img src="/images/google_login2.png"></button>
            <div class="go-registration">
                <router-link to="/find/pw/send-email"><button class="btn bg-clear btn-password">비밀번호 찾기</button></router-link>
                <p>|</p>
                <router-link to="/before/registration"><button class="btn bg-clear btn-registration">회원가입</button></router-link> 
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue';

// const store = useStore();

const userInfo = reactive({
    user_email: ''
    ,user_password: ''
});

// 소셜 로그인 함수
const loginWithGoogle = async () => {
    try {
        window.location.href = 'http://localhost:8000/api/auth/login/google';
    } catch (error) {
        console.error('Google 로그인 실패:', error);
    }
};

// const loginGoogle  = () => {
//     store.dispatch('auth.google');
// }
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
    margin: 50px auto 23px auto;
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
    gap: 20px;
}

.btn-google {
    background-color: transparent;
}

.btn-google img{
    /* min-width: 300px; */
    height: 50px;
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
    /* justify-content: center;
    align-items: center; */
    margin: 0 auto;
    gap: 10px;
}

.go-registration > p {
    color: #4C4C4C;
}

.btn-password {
    width: 110px;
    font-size: 18px;
    font-weight: 500;
}

.btn-registration {
    width: 80px;
    font-size: 18px;
    font-weight: 500;
}
</style>