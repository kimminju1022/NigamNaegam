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
                    <span>이메일 형식에 맞지 않습니다.</span>
                </div>
                <input class="input-login" type="text" id="email" placeholder="이메일을 입력해주세요">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="password">비밀번호</label>
                    <span>비밀번호 형식에 맞지 않습니다.</span>
                </div>
                <input class="input-login" type="password" id="password" placeholder="비밀번호 입력(문자, 숫자, 특수문자 포함 8 - 20글자)">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="password_chk">비밀번호 확인</label>
                    <span>비밀번호가 맞지 않습니다.</span>
                </div>
                <input class="input-login" type="password" id="password_chk" placeholder="비밀번호 확인">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="name">이름</label>
                    <span>이름 형식에 맞지 않습니다.</span>
                </div>
                <input class="input-login" type="text" id="name" placeholder="이름을 입력해주세요">
            </div>
            <div class="login-input-box">
                <div class="login-label-flex">
                    <label for="nickname">닉네임</label>
                    <span>닉네임 형식에 맞지 않습니다.</span>
                </div>
                <input class="input-login" type="text" id="nickname" placeholder="닉네임을 입력해주세요">
            </div>
            <div class="login-input-box">                
                <div class="login-label-flex">
                    <label for="tel">전화번호</label>
                    <span>전화번호 형식에 맞지 않습니다.</span>
                </div>
                <input class="input-login" type="text" id="tel" placeholder="'-'를 생략하고 숫자만 입력해주세요">
            </div>
        </div>
        <div class="registration-btn">
            <button class="btn bg-navy btn-registration">회원가입</button>
            <button class="btn bg-clear btn-cancel">취소</button>
        </div>
    </div>
</template>

<script setup>

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
    margin-bottom: 10px;
}
.login-label-flex {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 20px;
}
.login-label-flex > label {
    font-size: 18px;
}
span {
    color: red;
    font-size: 13px;
}
.input-login {
    /* background: #F5F5F5; */
    /* border-radius: 20px; */
    width: 400px;
    height: 50px;
    padding: 20px 10px 10px 10px;
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