<template>
<div class="admin">
    <div class="admin-header-left">
        <div>
            <img class="admin-header-image" src="/logo_IgoUgo.png" alt="">
            <hr>
            <div class="admin-header-dropdown">
                <p>유저관리</p>

                <div @mouseenter="showDropdown" @mouseleave="hideDropdown">
                    <p>게시판관리</p>
                    <div v-if="dropdownVisible" class="admin-dropdown-menu">
                        <p>호텔게시판</p>
                        <p>상세게시판</p>
                        <p>추천루트게시판</p>
                        <p>리뷰게시판</p>
                        <p>자유게시판</p>
                    </div>
                </div>

                <p>문의 관리</p>
                <p>통계</p>
            </div>
        </div>
        <div>
            <div class="admin-user">
                <div class="admin-user-image-info">
                    <img class="admin-user-image" src="\logo_gam.png" alt="">
                    <p class="admin-user-name">믿어핑</p>
                </div>

                <div class="admin-user-info">
                    <p>아이디 admin@admin.com</p>
                    <p>유형 직책/닉네임</p>
                </div>

                <div class="admin-user-box">
                    <div class="admin-user-option">
                        <p>운영진 설정</p>
                        <div class="admin-user-image-view">
                            <img class="admin-user-image-small" src="\logo_gam.png" alt="">
                            <img class="admin-user-image-small" src="\logo_gam.png" alt="">
                            <img class="admin-user-image-small" src="\logo_gam.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-user-btn">
            <button class="admin-logout-btn">로그아웃</button>
        </div>
    </div>
    <div>

    </div>
</div>
</template>

<script setup>
import { ref } from 'vue';

const dropdownVisible = ref(false);

const showDropdown = () => {
    dropdownVisible.value = true;
};

const hideDropdown = () => {
    dropdownVisible.value = false;
};
</script>

<style>
/* 왼쪽 오른쪽 나눈거 */
.admin {
    display: grid;
    grid-template-columns: 250px 1fr;
}


/* 왼쪽 헤더 */
.admin-header-left {
    display: grid;
    grid-template-rows: 1fr 1fr 50px;
    background-color: #01083a;
    height: 100vh;
}
.admin-header-image {
    width: 250px;
    padding: 10px 0;
}
.admin-header-dropdown {
    display: flex;
    flex-direction: column;
    color: #fff;
    font-size: 20px;
    padding: 20px 0px 20px 10px;
    gap: 15px;
}
.admin-header-dropdown p {
    width: fit-content;
}
.admin-dropdown-menu {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.admin-dropdown-menu > p {
    /* padding: 3px 0px 0px 30px; */                                                                                                                                                                               
    margin: 3px 0px 0px 30px;
    font-size: 18px;
}

/* 유저 회색 박스쪽 */
.admin-user {
    background-color: #dadada;
    width: 230px;
    display: grid;
    grid-template-rows: 200px 60px 120px;
    border-radius: 10px;
    gap: 20px;
    justify-self: center;
}
.admin-user-image {
    width: 150px;
    height: 150px;
}
.admin-user-image-info {
    justify-self: center;
}
.admin-user-name {
    justify-self: center;
    font-size: 25px;
    color: #fff;
}
.admin-user-info {
    display: grid;
    grid-template-rows: 30px 30px;
    justify-content: center;
}

/* 회색박스 안에 작은 흰색? 박스 */
.admin-user-box {
    justify-self: center;
}
.admin-user-option {
    display: grid;
    grid-template-rows: 30px 60px;
    background-color: #f7f7f7;
    width: 200px;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    text-align: center;
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
</style>