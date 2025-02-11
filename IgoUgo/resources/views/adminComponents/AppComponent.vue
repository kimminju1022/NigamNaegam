<template>
<!-- 로그인 유무 체크 필요 -->
<div v-if="$store.state.auth.managerAuthFlg" class="admin">
    <div class="admin-header-left">
        <div>
            <router-link to="/admin/main"><img class="admin-header-image" src="/img_admin/admin_logo.png" alt=""></router-link>
            <!-- <hr> -->
            <div class="admin-header-dropdown">
                <router-link to="/admin/user"><p>유저관리</p></router-link>

                <div @mouseenter="showDropdown" @mouseleave="hideDropdown">
                    <p>게시판관리</p>
                    <div v-if="dropdownVisible" class="admin-dropdown-menu">
                        <!-- <router-link to="/admin/board/api"><p>API통합 관리</p></router-link> -->
                        <router-link to="/admin/board/review"><p>리뷰게시판</p></router-link>
                        <router-link to="/admin/board/free"><p>자유게시판</p></router-link>
                    </div>
                </div>
                
                <router-link to="/admin/tester"><p>체험단</p></router-link>
                <!-- <router-link to="/admin/recommend"><p>이달의 추천</p></router-link>
                <router-link to="/admin/notification"><p>공지사항</p></router-link> -->
                <router-link to="/admin/question"><p>문의 관리</p></router-link>
                <!-- <p>통계</p> -->
            </div>
        </div>
        <div>
            <div class="admin-user">
                <div class="admin-user-image-info">
                    <img class="admin-user-image" :src="user.user_profile">
                    <p class="admin-user-name">{{ user.user_nickname }}</p>
                </div>

                <div class="admin-user-info">
                    <p>아이디 {{ user.user_email }}</p>
                    <p>닉네임 {{ user.user_nickname }}</p>
                </div>

                <!-- <div class="admin-user-box">
                    <div class="admin-user-option">
                        <p>운영진</p>
                        <div class="admin-user-image-view">
                            <img class="admin-user-image-small" src="\logo_gam.png" alt="">
                            <img class="admin-user-image-small" src="\logo_gam.png" alt="">
                            <img class="admin-user-image-small" src="\logo_gam.png" alt="">
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="admin-user-btn">
            <button @click="logout" class="admin-logout-btn">로그아웃</button>
        </div>
    </div>
    <div class="admin-header-right">
        <router-view></router-view>
    </div>
</div>

<!-- 로그인 안 했을 때 로그인 페이지만 뜸 -->
<div v-if="!$store.state.auth.managerAuthFlg" class="login-container">
    <router-view></router-view>
</div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const dropdownVisible = ref(false);

const showDropdown = () => {
    dropdownVisible.value = true;
};

const hideDropdown = () => {
    dropdownVisible.value = false;
};

const user = computed(()=> store.state.auth.managerInfo);

const logout = () =>{
    const check = confirm('로그아웃 하시겠습니까?');
    if(check) {
        store.dispatch('auth/adminLogout');
    }
}
</script>

<style>
/* 왼쪽 오른쪽 나눈거 */
.admin {
    display: grid;
    grid-template-columns: 300px 1fr;
}


/* 왼쪽 헤더 */
.admin-header-left {
    display: grid;
    grid-template-rows: 1.2fr 1fr 60px;
    background-color: #01083a;
    height: 100vh;
}
.admin-header-image {
    width: 300px;
    padding: 10px 20px;
}
.admin-header-dropdown {
    display: flex;
    flex-direction: column;
    /* color: #fff; */
    font-size: 20px;
    padding: 20px 0px 20px 30px;
    gap: 15px;
}
.admin-header-dropdown a {
    color: #fff;
}
.admin-header-dropdown p {
    color: #fff;
    width: fit-content;
}
.admin-dropdown-menu {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.admin-dropdown-menu > a {
    /* padding: 3px 0px 0px 30px; */                                                                                                                                                                               
    /* margin: 3px 0px 0px 30px; */
    margin-left: 30px;
    font-size: 18px;
}
.admin-dropdown-menu > :nth-child(1) {
    margin-top: 10px;
}

/* 유저 회색 박스쪽 */
.admin-user {
    background-color: #bcbcbc;
    width: 230px;
    display: grid;
    /* grid-template-rows: 180px 60px 120px; */
    grid-template-rows: 3fr 1fr 1.5fr;
    border-radius: 10px;
    gap: 10px;
    justify-self: center;
}
.admin-user-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
}
.admin-user-image-info {
    justify-self: center;
    margin-top: 10px;
}
.admin-user-name {
    justify-self: center;
    font-size: 25px;
    color: #000;
}
.admin-user-info {
    display: grid;
    grid-template-rows: 1fr 1fr;
    justify-content: center;
    align-content: center;
    color: #000;
}

/* 회색박스 안에 작은 흰색? 박스 */
.admin-user-box {
    justify-self: center;
    align-items: center;
}
.admin-user-option {
    display: grid;
    /* grid-template-rows: 30px 60px; */
    grid-template-rows: 1fr 2fr;
    /* background-color: #4c4c4c; */
    background-color: #888888;
    width: 200px;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    text-align: center;
    /* color: #bcbcbc; */
    color: #000;
}
.admin-user-image-view {
    display: grid;
    grid-template-columns: 50px 50px 50px;
}

.admin-user-image-small {
    width: 50px;
    height: 50px;
}

/* 버튼 */
.admin-user-btn{
    display: flex;
    justify-content: end;
    margin-right: 10px;
    padding: 10px 0;
}

.admin-logout-btn {
    height: 40px;
    width: 100px;
    border-radius: 10px;
    border: solid #fff 2px;
    background-color: rgba(255, 255, 255, 0.33);
    font-size: 18px;
    color: white;
}

/* 버튼 밑줄 생기는 css */
.admin-header-dropdown p {
    position: relative;
}

.admin-header-dropdown p::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0; /* 처음에는 밑줄이 보이지 않음 */
    height: 2px;
    background-color: white;
    transition: width 0.3s ease; /* 밑줄 길이가 늘어나는 애니메이션 */
}

.admin-header-dropdown p:hover::after {
  width: 100%; /* 호버 시 밑줄이 텍스트 길이에 맞게 확장 */
}


/* 오른쪽 */
.admin-header-right {
    background-color: #eeeeee;
    padding: 20px 50px;
}

/* 로그인 페이지일 때 */
.login-container {
    background-color: #eeeeee;
    height: 100vh;
}
</style>