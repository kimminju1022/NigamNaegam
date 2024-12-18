<template>
    <div class="my-page">
        <div class="my-profile-bg">
            <div class="my-profile-box">
                <div class="my-profile-img">
                    <!-- <img :src="$store.state.user.userInfo.profile"> -->
                    <img :src="userInfo.profile">
                    <!-- <input v-model="userInfo.profile" type="file" name="profile" id="profile"> -->
                </div>
                <div class="my-profile-content">
                    <div class="profile-item">
                        <p class="bg-navy">이메일</p>
                        <input v-model="userInfo.email" class="input-update" name="email" readonly>
                    </div>
                    <div class="profile-item">
                        <p class="bg-navy">이름</p>
                        <input v-model="userInfo.name" class="input-update" name="name">
                    </div>
                    <div class="profile-item">
                        <p class="bg-navy">닉네임</p>
                        <input v-model="userInfo.nickname" class="input-update" name="nickname">
                    </div>
                    <div class="profile-item">
                        <p class="bg-navy">전화번호</p>
                        <input v-model="userInfo.phone" class="input-update" name="phone">
                    </div>
                </div>
            </div>
        </div>
        <div class="my-profile-update-btn">
            <!-- 수정버튼 button @click? -->
            <!-- <button class="btn bg-navy btn-update">완료</button> -->
            <button @click="$store.dispatch('user/updateUser', userInfo)" class="btn bg-navy btn-update">완료</button>
            <button @click="backToUser" class="btn bg-navy btn-update">취소</button>
        </div>
    </div>
</template>

<script setup>

import { reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

const store =  useStore();
const router = useRouter();

const userInfo = reactive({
    email: store.state.user.userInfo.user_email
    ,name: store.state.user.userInfo.user_name
    ,nickname: store.state.user.userInfo.user_nickname
    ,phone: store.state.user.userInfo.user_phone
    ,profile: store.state.user.userInfo.user_profile
    ,user_id: store.state.user.userInfo.user_id
});

const backToUser = () => {
    router.replace(`/user/${store.state.user.userInfo.user_id}`);
};

</script>

<style scoped>
.my-page {
    width: 100%;
    margin-top: 30px;
    margin-bottom: 80px;
    margin-top: 70px;
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