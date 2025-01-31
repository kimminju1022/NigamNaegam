<template>
    <div class="my-page">
        <div class="my-profile-bg">
            <div class="my-profile-box">
                <div class="my-profile-img-box">
                    <div class="my-profile-img">
                        <img :src="preview || userData.userInfo.user_profile">
                    </div>
                    <input @change="setFile" type="file" name="user_profile" accept="image/*">
                </div>
                <div class="my-profile-content">
                    <div class="profile-item">
                        <p class="bg-navy">이메일</p>
                        <input v-model="userData.userInfo.user_email" class="input-update" name="user_email" readonly>
                    </div>
                    <div class="profile-item">
                        <p class="bg-navy">이름</p>
                        <input v-model="userData.userInfo.user_name" type="text" class="input-update" name="user_name">
                    </div>
                    <div class="profile-item">
                        <p class="bg-navy">닉네임</p>
                        <input v-model="userData.userInfo.user_nickname" type="text" class="input-update" name="user_nickname">
                    </div>
                    <div class="profile-item">
                        <p class="bg-navy">전화번호</p>
                        <input v-model="userData.userInfo.user_phone" type="tel" maxlength="11" class="input-update" name="user_phone">
                    </div>
                </div>
            </div>
        </div>
        <div class="my-profile-update-btn">
            <button @click="$store.dispatch('user/updateUser', userData)" class="btn bg-navy btn-update">완료</button>
            <router-link :to="`/user/${$store.state.auth.userInfo.user_id}`"><button @click="backToUser" class="btn bg-navy btn-update">취소</button></router-link>
            <!-- <button @click="backToUser" class="btn bg-navy btn-update">취소</button> -->
        </div>
    </div>
</template>

<script setup>

import { reactive, ref } from 'vue';
import { useStore } from 'vuex';

const store =  useStore();

const userData = reactive({
    userInfo: store.state.auth.userInfo,
    file: null,
});

const preview = ref('');

const setFile = (e) => {
    userData.file = e.target.files[0];
    preview.value = URL.createObjectURL(userData.file);
}
</script>

<style scoped>
.my-page {
    width: 100%;
    margin-top: 30px;
    margin-bottom: 80px;
    margin-top: 100px;
}

.my-page > div {
    width: 100%;
}

/* 프로필 */
.my-profile-bg {
    background-color: rgb(133, 177, 218, 0.2);
}

.my-profile-box {
    display: grid;
    grid-template-columns: 1fr 1fr;
    place-items: center;
    padding: 20px;
    /* background-color: rgb(133, 177, 218, 0.2); */
}

/* .my-profile-img-box {
    display: grid;
    grid-template-rows: 3fr 1fr;
} */

.my-profile-img-box > input {
    width: 200px;
}

.my-profile-img {
    background: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 50%;
    width: 220px;
    height: 220px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.my-profile-img > img {
    max-width: 200px;
    max-height: 200px;
    border-radius: 50%;
    /* background: #000; */
    object-fit: cover;
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
    min-width: 300px;
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

@media (max-width: 320px) {

.my-page {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 500px 1fr;
    place-items: center;
    gap: 70px;
    width: 100%;
}
.my-profile-box {
    display: flex;
    flex-direction: column;
    /* margin-top: 150px; */
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
    /* background: #000;  */
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
    min-width: 80px;
    padding: 5px;
    /* font-weight: 600; */
    text-align: center;
    border-radius: 15px;
    font-size: 14px;
}

.profile-item :nth-child(2) {
    min-width: 120px;
    padding: 5px;
    /* font-weight: 500; */
    text-align: center;
    font-size: 15px;
    border-bottom: 2px solid #01083a;
}

/* 수정 버튼 */

.my-profile-update-btn {
    display: flex;
    justify-content: flex-end;
    padding: 10px 5px;
}

.my-profile-update-btn button {
    font-size: 15px;  
    padding: 5px 10px;
    border-radius: 50px;  
}

.my-profile-update-btn button:hover {
    background-color: rgb(133, 177, 218);
    color: #01083a;
}

/* 1:1 문의내역 */

.question-box h3{
    margin-bottom: 30px;
    font-size: 30px;
    color: #01083a;
}

.question-content-box {
    border-top: 1px solid #01083a;
    border-bottom: 1px solid #01083a;
    min-width: 300px;
    margin-bottom: 30px;
}

.question-title {
    display: grid;
    grid-template-columns: 0.5fr 2fr 1fr;
    text-align: center;
    padding: 10px;
}

.question-content-box > hr{
    color: #4c4c4c;
}

.question-content {
    display: grid;
    grid-template-columns: 0.5fr 2fr 1fr;
    text-align: center;
    padding: 10px;
}

.question-content :nth-child(2) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.question-content :last-child {
    font-size: 15px;
}

/* 페이지네이션 */

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    max-width: 100px;
}

.pagination button {
    font-size: 20px;
    border-radius: 50px;
    width: 40px;
    height: 40px;
    text-align: center;
    /* border: 2px solid #01083a; */
}

.pagination button:hover, .pagination button:active {
    color: #fff;
    background: #01083a;
}

}

</style>