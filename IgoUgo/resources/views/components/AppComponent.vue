<template>
    <!-- <header class="header"> -->
    <header>
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


            <a href="#"><img class="header-logo-img" src="/logo_gam.png" alt=""></a>
            <a href="#"><img class="header-title-img" src="/logo_IgoUgo.png" alt=""></a>
            <div class="header-title-button">
                <button class="btn bg-clear header-btn">FAQ</button>
                <button class="btn bg-clear header-btn">회원가입</button>
                <button class="btn bg-navy header-bg-btn">로그인</button>
            </div>
        </div>
        <div class="header-list">
            <ul class="header-list-flex">
                <li class="header-list-hover"><a href="">호텔</a></li>
                <li class="header-list-hover"><a href="">상품</a></li>
                <li class="header-list-hover">
                    <div class="header-list-dropdown">
                        <a href="" class="header-list-dropbtn">게시판</a>
                        <div class="header-list-hover header-list-dropdown-content">
                            <a href="#">리뷰</a>
                            <a href="#">자유</a>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="header-search"> 
                <input class="header-search-bar" type="text" required placeholder="Q 어디로 놀러가세요?" >
                <button class="btn bg-navy header-bg-btn">검색</button>
            </div>
        </div>
    </header>

    <main class="main">
        <router-view></router-view>
    </main>

    <!-- <footer class="footer"> -->
    <footer>
        <div class="footer-inner">
            <div>
                <img class="footer-logo" src="/logo_footer.png" alt="">
            </div>
            <div class="footer-text">
                <p>Tel : 053.572.1005</p>
                <p>후원계좌 : IM뱅크 222-8282-222</p>
                <p>(주)  절어서 한국속으로</p>
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
    font-family: 'MinSans-Regular';
}

@font-face {
    font-family: 'MinSans-Regular';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2201-2@1.0/MinSans-Regular.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}

::-webkit-scrollbar {
    display: none;
}

a {
    text-decoration: none;
}

a:visited {
    color : #01083A;
}

li {
    list-style-type: none;
}

input, textarea {
    border: none;
    outline: none;
}

.btn {
    border: none;
    text-decoration: none;
    cursor: pointer;
    text-align: center; 
}

.bg-navy {
    background-color: #01083A;
    color: #ffff;
}

.bg-clear {
    background-color: transparent;
    color: #01083A;
}

/* 네비게이션 메뉴 -> 현재 생략 */
.navi {
    position: relative;
    width: 200px;
    height: 400px;
    background-color: #01083A;
}

/* ************************************ */

/* 헤더헤더 */

header {
    display: grid;
    grid-template-rows: 100px 50px;
    background-color: #fff;
    position: sticky;
    top: 0;
    z-index: 1000;
    margin: 0 auto;
    max-width: 1300px;
    min-width: 600px;
    gap: 15px;
}

/* 헤더 1 -> 로고 , 로그인 버튼 */
.header-title {
    display: grid;
    grid-template-columns: 270px 1fr 270px;
    align-items: center;
    justify-items: center;
}

.header-title > :first-child {
    justify-self: start;
    margin-left: 50px;
}

.header-title-button {
    display: flex;
    gap: 25px;
}

.header-list > :last-child {
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

/* 헤더 로그인 버튼 */
.header-btn {
    font-size: 18px;
}

.header-bg-btn {
    font-size: 18px;
    width: 70px;
    height: 35px;
    border-radius: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}


/* 헤더 2 -> 호텔, 상품, 게시판, 검색바 */
.header-list {
    display: flex;
    align-items: center;
    /* margin-left: 20px; */
    padding: 25px;
    gap: 20px;
}

/* 호텔, 상품, 게시판 hover */
.header-list-flex {
    display: flex;
    flex-direction: row;
    gap: 5px;
}

/* .header-list-hover {
    margin-top: 5px;
} */

.header-list-hover a {
    color: #01083A;
    font-size: 23px;
    font-weight: 400;
    padding: 5px 10px;
    /**/
    position: relative;
    display: block;
    text-decoration: none;
    text-transform: uppercase;
    text-align: center;
    margin-top: 5px;
}

.header-list-hover a:before, .header-list-hover a:after {
    content: "";
    transition: 0.3s all ease;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    position: absolute;
    width: 0;
    height: 2px;
}

.header-list-hover a:before {
    right: 0;
    top: 0;
}

.header-list-hover a:after {
    left: 0;
    bottom: 0;
}

.header-list-hover a:hover:before, .header-list-hover a:hover:after {
    width: 100%;
    background: #01083A;
}

.header-list-dropdown{
    position : relative;
    display : inline-block;
}

.header-list-dropdown-content{
    display : none;
    position : absolute;
    z-index : 1; /*다른 요소들보다 앞에 배치*/
}

.header-list-dropdown-content a{
    display : block;
    font-size: 18px;
}

.header-list-dropdown:hover .header-list-dropdown-content {
    display: block;
}

/* 헤더 검색바 */
.header-search {
    display: flex;
    align-items: center;
    /* margin-right: 10px; */
    gap: 20px;
}

.header-search-bar {
    border-radius: 50px;
    width: 330px;
    height: 35px;
    background-color: #f5f5f5;
    border-style: none;
    font-size: 16px;
    padding-left: 20px;
}

/* ************************************ */

/* 메인메인 */
.main {
    padding: 30px 25px 25px 25px;
    margin: 0 auto;
    max-width: 1300px;
    min-width: 600px;
}

/* ************************************ */

/* 푸터푸터 */
footer {
    height: 230px;
    /* width: 100vw; */
    background-color: #01083a;
    position: relative;
    transform: translateY(0%);
    display: grid;
    grid-template-rows: 140px 60px;
    z-index: 1000;
    margin-top: 100px;
    gap: 30px;
}

/* 푸터 사업자번호 */
.footer-inner {
    padding-top: 40px;
    /* display: grid;
    grid-template-columns: 4fr 5fr; */
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
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
    font-size: 15px;
    letter-spacing: 1px;
    white-space: nowrap;
    line-height: 1.7rem;
}

.footer-bottom {
    margin: 0 auto;
    padding: 10px;
}

.hr {
    width: 95vw;
}

.copy-right {
    font-size: 13px;
    color: #fff;
    margin: 10px 0;
    text-align: center;
    /* width: 400px; */
}
</style>