<template>
    <header class="header">
        <div class="header-title">
            <!-- 햄버거 버튼 -->
            <!-- <button class="hamburger-btn">버튼버튼</button> -->
            
            <!-- 네비게이션 메뉴 -->
            <!-- <div v-if="isMenuOpen" class="navi">
                <button class="button-register">회원가입</button>
                <button class="button-btn">로그인</button>
                <button class="button-same">호텔</button>
                <button class="button-same">상품</button>
                <button class="button-same">게시판</button>
                <hr>
                <button class="button-FAQ">FAQ</button>
            </div> -->


            <img class="header-logo-img" src="/logo_gam.png" alt="">
            <img class="header-title-img" src="/logo_IgoUgo.png" alt="">
            <div class="header-title-button">
                <button class="button-FAQ">FAQ</button>
                <button class="button-register">회원가입</button>
                <button class="button-btn">로그인</button>
            </div>
        </div>
        <div class="header-btn">
            <button class="button-same">호텔</button>
            <button class="button-same">상품</button>
            <button class="button-same">게시판</button>
            <div class="header-search-btn"> 
                <input class="header-search" type="text" required placeholder="Q 어디로 놀러가세요?" >
                <button class="button-btn">검색</button>
            </div>
        </div>
    </header>

    <main class="main">
        <router-view></router-view>
    </main>

    <footer class="footer">
        <div class="footer-inner">
            <div>
                <img class="footer-logo" src="/logo_footer.png" alt="">
            </div>
            <div class="footer-text">
                <p>Tel : 053.572.1005</p>
                <p>후원계좌 : 농협 000-00000-00</p>
                <p>(주)  절어서 대구속으로</p>
                <p>대표 : 뽀빠이</p>
                <p>사업자 번호 : 123-45-678</p>
            </div>
        </div>
        <div class="footer-bottom">
            <hr class="hr">
            <div class="copy-right">
                <p>COPYRIGHT ⓒ 2024 IgoUgo All rights reserved</p>
            </div>
        </div>
    </footer>
</template>

<script setup>
// import { ref, onMounted, onBeforeUnmount } from 'vue';

// // 창 크기 여부
// const isHambuger = ref(window.innerWidth <= 900);  // 600 이하일 때 햄버거 메뉴 표시
// // 메뉴 상태 
// const isMenuOpen = ref(false);

// // 창 크기 변화 감지
// const handleResize = () => {
//     isHambuger.value = window.innerWidth <= 900;  // 창 크기 변화에 따라 햄버거 버튼 상태 변경
// };

// onMounted(() => {
//     isHambuger.value = window.innerWidth <= 900;
//   // 창 크기 변화 이벤트 리스너 등록
//     window.addEventListener('resize', handleResize);
// });

// onBeforeUnmount(() => {
//   // 컴포넌트가 언마운트 될 때 이벤트 리스너 제거
//     window.removeEventListener('resize', handleResize);
// });

// // 메뉴 열기/닫기
// const toggleMenu = () => {
//     isMenuOpen.value = !isMenuOpen.value;
// };
</script>

<style>
/* 기본 폰트와 마진패팅 설정 */
*{ 
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
header *, footer {
    font-family: 'MapoBackpacking';
}
main {
    font-family: 'SUITE-Regular';
}
@font-face {
    font-family: 'MapoBackpacking';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2001@1.1/MapoBackpackingA.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'SUITE-Regular';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2304-2@1.0/SUITE-Regular.woff2') format('woff2');
    font-weight: 400;
    font-style: normal;
}

input, textarea {
    border: none;
    outline: none;
}

/* 네비게이션 메뉴 */
.navi {
    position: relative;
    width: 200px;
    height: 400px;
    background-color: #01083A;
}

/* 헤더해더 */
.header {
    display: grid;
    grid-template-rows: 100px 50px;
    width: 100vw;
    background-color: #fff;
    position: fixed;
    font-family: 'MapoBackpacking';
    z-index: 1000;
}
.header-title {
    display: grid;
    grid-template-columns: 320px 1fr 320px;
    align-items: center;
    justify-items: center;
}
.header-title > :first-child {
    justify-self: start;
    margin-left: 80px;
}
.header-title-button {
    display: flex;
    gap: 25px;
}

.header-btn {
    display: flex;
    align-items: center;
    margin-left: 20px;
    gap: 20px;
}
.header-btn > :last-child {
    margin-left: auto;
}
.header-logo-img {
    width: 110px;
    height: 110px;
    /* min-width: 100px; */
}
.header-title-img {
    width: 450px;
    /* height: 110px; */
}
.button-FAQ {
    background-color:transparent;
    border-style: none;
    font-size: 20px;
    color: #01083A;
}
.button-register {
    background-color:transparent;
    border-style: none;
    font-size: 25px;
    color: #01083A;
}
.header-search {
    border-radius: 50px;
    width: 400px;
    height: 50px;
    background-color: #f5f5f5;
    border-style: none;
    font-size: 25px;
    padding-left: 15px;
    outline: none;
}
.header-search-btn {
    display: flex;
    align-items: center;
    margin-right: 20px;
    gap: 20px;
}

.button-btn {
    font-size: 25px;
    width: 100px;
    height: 50px;
    border-radius: 50px;
    border-style: none;
    color: #ffff;
    background-color: #01083A;
}
.button-same {
    background-color:transparent;
    border-style: none;
    font-size: 25px;
    color: #01083A;  
}

/* 여러곳에 사용될 버튼 css */
.btn {
    border: none;
    text-decoration: none;
    cursor: pointer;
    text-align: center; 
}

.button-navy {
    background-color: #01083A;
    color: #ffff;
}

.button-clear {
    background-color: transparent;
    color: #01083A;
}

/* 메인메인 */
.main {
    padding-top: 210px;
}

/* 푸터푸터 */
.footer {
    height: 200px;
    width: 100vw;
    background-color: #01083a;
    position: fixed;
    bottom: 0;
    /* transform: translateY(0%); */
    display: grid;
    grid-template-rows: 140px 60px;
}
.footer-inner {
    display: grid;
    grid-template-columns: 4fr 5fr;
    align-items: center;
}
.footer-inner > :nth-child(1) {
    justify-self: end;
}
.footer-inner > :nth-child(2) {
    justify-self: start;
}
.footer-logo {
    height: 140px;
    width: 140px;
}
.footer-text {
    color: #ffff;
    font-size: 1.1rem;
    letter-spacing: 3px;
    white-space: nowrap;
}
.footer-bottom {
    margin: 0 auto;
    padding: 10px;
}
.hr {
    width: 95vw;
}
.copy-right {
    font-size: 1rem;
    color: #fff;
    margin: 10px auto;
    width: 400px;
}
</style>