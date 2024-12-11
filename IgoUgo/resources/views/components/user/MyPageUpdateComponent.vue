<template>
    <div class="my-page">
        <div class="my-profile-box">
            <div class="my-profile-img">
                <img src="/logo_gam.png" alt="">
            </div>
            <div class="my-profile-content">
                <div class="profile-item">
                    <p class="bg-navy">이메일</p>
                    <input class="input-update" value="이메일">
                </div>
                <div class="profile-item">
                    <p class="bg-navy">이름</p>
                    <input class="input-update" value="이름">
                </div>
                <div class="profile-item">
                    <p class="bg-navy">닉네임</p>
                    <input class="input-update" value="닉네임">
                </div>
                <div class="profile-item">
                    <p class="bg-navy">전화번호</p>
                    <input class="input-update" value="전화번호">
                </div>
            </div>
        </div>
        <div class="my-profile-update-btn">
            <button class="btn bg-navy btn-update">수정</button>
            <button class="btn bg-navy btn-update">취소</button>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
.my-page {
    width: 100%;
    margin-top: 30px;
    margin-bottom: 80px;
}

.my-page > div {
    width: 100%;
}

/* 프로필 */

.my-profile-box {
    display: grid;
    grid-template-columns: 1fr 1fr;
    place-items: center;
    padding: 20px;
    background: rgba(133, 177, 218, 0.2);
}

.my-profile-img {
    background: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 50%;
}

.my-profile-img > img {
    max-width: 200px;
    max-height: 200px;
    border-radius: 50%;
    /* background: #000; */
}

.my-profile-content {
    padding: 10px;
}

.profile-item {
    display: flex;
    gap: 20px;
    margin-bottom: 10px;
}

.profile-item :nth-child(1) {
    min-width: 130px;
    padding: 10px 15px;
    font-weight: 600;
    text-align: center;
    border-radius: 15px;
    font-size: 20px;
}

.profile-item :nth-child(2) {
    min-width: 200px;
    padding: 10px 15px;
    font-weight: 500;
    text-align: center;
    font-size: 18px;
}

.input-update {
    background: transparent;
    min-width: 350px;
    padding: 10px 15px;
    font-size: 18px;
    border-bottom: 2px solid #01083a;
}


/* 수정 버튼 */

.my-profile-update-btn {
    display: flex;
    justify-content: flex-end;
    padding: 10px 5px;
    gap: 10px;
}

.my-profile-update-btn button {
    font-size: 20px;  
    padding: 7px 15px;
    border-radius: 50px;  
}

.my-profile-update-btn button:hover {
    background-color: rgb(133, 177, 218);
    color: #01083a;
}

</style>