<template>
    <div class="password">
        <h1>비밀번호 확인</h1>
        <div class="password-err">
            <p>비밀번호가 맞지 않습니다.</p>
        </div>
        <div class="password-item">
            <p class="bg-navy">현재 비밀번호</p>
            <input placeholder="비밀번호 입력">
        </div>
        <div class="my-profile-chk-btn">
            <button class="btn bg-navy btn-chk">확인</button>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
.password {
    max-width: 500px;
    gap: 20px;
    margin: 0 auto 140px auto;
    text-align: center;
}

.password h1 {
    color: #01083a;
    margin: 50px auto;
    font-size: 3rem;
}

.password-err {
    display: flex;
    justify-content: flex-end;
    color: red;
    font-size: 15px;
    margin-bottom: 15px;
}

.password-item {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 20px;
}

.password-item :nth-child(1) {
    min-width: 100px;
    padding: 10px 15px;
    text-align: center;
    border-radius: 15px;
    font-size: 18px;
}

.password-item :nth-child(2) {
    min-width: 200px;
    padding: 10px 15px;
    font-weight: 500;
    font-size: 18px;
    background: transparent;
    padding: 10px 15px;
    font-size: 18px;
    border-bottom: 2px solid #01083a;
}

/* 수정 버튼 */

.my-profile-chk-btn {
    display: flex;
    justify-content: flex-end;
    padding: 10px 5px;
    margin-top: 10px;
}

.my-profile-chk-btn button {
    font-size: 20px;  
    padding: 7px 15px;
    border-radius: 50px;
}

.my-profile-chk-btn button:hover {
    background-color: rgb(133, 177, 218);
    color: #01083a;
}
</style>