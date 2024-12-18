<template>

    <!-- header -->

    <div class="header-header" v-if="flg === '0'">
        <header>
            <div>
                <div class="header-title">
                    <router-link to="/"><img class="header-logo-img" src="/logo_gam.png" alt=""></router-link>
                    <!-- {{ console.log(flg) }} -->
                    <router-link to="/"><img class="header-title-img" src="/logo_IgoUgo.png" alt=""></router-link>
                    <div v-if="!$store.state.auth.authFlg" class="header-title-button">
                        <button class="btn bg-clear header-btn">FAQ</button>
                        <router-link to="/registration"><button class="btn bg-clear header-btn">회원가입</button></router-link>
                        <router-link to="/login"><button class="btn bg-navy header-bg-btn">로그인</button></router-link>
                    </div>
                    <div v-else class="header-title-button">
                        <button class="btn bg-clear header-btn">FAQ</button>
                        <button @click="$store.dispatch('auth/logout')" class="btn bg-navy header-logout">로그아웃</button>
                        <!-- <router-link :to="`/user/${user.user_id}`"><img :src="$store.state.user.userInfo.user_profile" alt=""></router-link> -->
                        <router-link :to="`/user/${user.user_id}`"><img :src="user.user_profile" alt=""></router-link>
                    </div>
                </div>
                <div class="header-list">
                    <ul class="header-list-flex">
                        <li class="header-list-hover"><router-link to="/hotels">호텔</router-link></li>
                        <li class="header-list-hover"><router-link to="/products">상품</router-link></li>
                        <li class="header-list-hover">
                            <div class="header-list-dropdown">
                                <p class="header-list-dropbtn">게시판</p>
                                <div class="header-list-hover header-list-dropdown-content">
                                    <router-link to="/boards">리뷰</router-link>
                                    <router-link to="/boards">자유</router-link>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="header-search"> 
                        <input class="header-search-bar" type="text" required placeholder="Q 어디로 놀러가세요?" >
                        <button class="btn bg-navy header-bg-btn">검색</button>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <!-- header 반응형 -->

    <div class="v-if-header" v-if="flg === '1'">
        <div class="if-header">
            <div id="menu">
                <!-- 햄버거 버튼 -->
                <button class="hamburger" @click="toggleMenu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>

                <!-- 메뉴 -->
                <div class="nav" v-show="isMenuOpen">
                    
                    <div class="app-resist-login-div" @click="toggleMenu">
                        <div class="close close3"></div>
                        <div v-if="!$store.state.auth.authFlg">
                            <router-link to="/registration"><button class="app-resist-login btn bg-navy">회원가입</button></router-link>
                            <router-link to="/login"><button class="app-resist-login btn bg-navy">로그인</button></router-link>
                        </div>
                        <div v-else class="app-resist-logout">
                            <button @click="$store.dispatch('auth/logout')" class="app-resist-login btn bg-navy">로그아웃</button>
                            <router-link to="/user"><img :src="$store.state.user.userInfo.user_profile" alt=""></router-link>
                        </div>
                    </div>
                    <ul class="app-content-flex">
                        <li class="app-content"><router-link to="/hotels">호텔</router-link></li>
                        <li class="app-content"><router-link to="/products">상품</router-link></li>
                        <li class="app-content">
                            <div class="app-content-dropdown">
                                <p class="app-content-dropbtn">게시판</p>
                                <div class="app-content app-content-dropdown-content">
                                    <router-link to="/boards" class="app-review-board">리뷰 게시판</router-link>
                                    <router-link to="/boards" class="app-review-board">자유 게시판</router-link>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!-- <router-link to="/hotels" class="app-content bg-navy">호텔</router-link>
                    <router-link to="/products" class="app-content bg-navy">상품</router-link>
                    <p class="app-content bg-navy">게시판</p>
                    <router-link to="/boards" class="app-review-board bg-navy">리뷰 게시판</router-link>
                    <router-link to="/boards" class="app-review-board bg-navy">자유 게시판</router-link> -->

                </div>
            </div>

            <router-link to="/"><img class="header-title-img-1" src="/short_logo.png" alt=""></router-link>

            <div> </div>
        </div>

        <div class="header-search"> 
            <input class="header-search-bar" type="text" required placeholder="Q 어디로 놀러가세요?" >
            <button class="btn bg-navy header-bg-btn">검색</button>
        </div>
    </div>

    <!-- main -->

    <main class="main">
        <!-- TODO : 나중에 버튼 제거 -->
        <!-- <button @click="$store.dispatch('user/chkTokenAndContinueProcess', () => {console.log('테스트')})" >토큰 만료 체크</button> -->
        <router-view></router-view>
    </main>


    <!-- footer -->

    <div v-if="flg === '0'">
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
    </div>


    <div v-if="flg === '1'">
        <footer>
            <div class="footer-inner">
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
    </div>

</template>

<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import { useStore } from 'vuex';

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
const flg = ref('0');

const flgSetUp = () => {
    flg.value = window.innerWidth >= 1000 ? '0' : '1';
}

onMounted(() => {
    flgSetUp();
    window.addEventListener('resize', flgSetUp);
});

onBeforeUnmount(() => {
    window.removeEventListener('resize', flgSetUp);
});

// 메뉴 열림/닫힘 상태
const isMenuOpen = ref(false)

// 메뉴 토글 함수
const toggleMenu = () => {

    isMenuOpen.value = !isMenuOpen.value
}

const store = useStore();
// const id = computed(()=> store.state.user.userInfo.user_id);
const user = computed(()=> store.state.user.userInfo);

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
      /* // a태그 이제 안사용 하는듯? // */
    color : #01083A;
}

/*  p태그로 바꾸니까 css꺠지는거 고치려다 만거
    .header-list-dropbtn {
    text-decoration: none;
    color: #01083A;
    font-size: 23px;
    font-weight: 500;
    padding: 5px 10px;
} */

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
/* .navi {
    position: relative;
    width: 200px;
    height: 400px;
    background-color: #01083A;
} */

/* ************************************ */

/* 헤더헤더 */

.header-header {
    display: grid;
    grid-template-rows: 100px 50px;
    background-color: #fff;
    position: sticky;
    top: 0;
    z-index: 1000;
    margin: 0 auto;
    max-width: 1300px;
    gap: 15px;
}

/* 헤더 1 -> 로고 , 로그인 버튼 */
.header-title {
    display: grid;
    grid-template-columns: 1fr 3.5fr 1fr;
    align-items: center;
    justify-items: center;
}

/* 감로고 뺀 버전 */
/* .header-title-2 {
    display: grid;
    grid-template-columns: 1fr 3.5fr;
    align-items: center;
    justify-items: center;
} */
 /* 감로고는 사이드바 안에 넣어볼까 */
 /* 내감니감 사진을 좀 작은 버전 만들어서 1000보다 작아지면 그 사진으로 대체하는 걸로? */
 /* 아니면  */
 /* ***** 지우지마 ***** */

.header-title > :first-child {
    justify-self: start;
    margin-left: 50px;
}

.header-title-button {
    display: flex;
    gap: 25px;
    align-items: center;
}

.header-title-button img {
    border-radius: 50px;
    width: 50px;
    height: 50px;
    border: 2px solid #01083A; 
}

.header-list > :last-child {
    margin-left: auto;
}

.header-logo-img {
    width: 110px;
    height: 110px;
}

.header-title-img-1 {
    width: 110px;
}

.header-title-img {
    width: 450px;
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

/* 헤더 로그아웃 버튼 */
.header-logout {
    font-size: 18px;
    width: 80px;
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
    margin: 0 8px;
    gap: 20px;
    background-color: #fff;
}

/* 호텔, 상품, 게시판 hover */
.header-list-flex {
    display: flex;
    flex-direction: row;
    gap: 5px;
}

.header-list-hover a, .header-list-hover p {
    color: #01083A;
    font-size: 23px;
    font-weight: 500;
    padding: 5px 10px;
    /**/
    position: relative;
    display: block;
    text-decoration: none;
    text-transform: uppercase;
    text-align: center;
    /* margin-top: 5px; */
}

.header-list-hover a:before
, .header-list-hover a:after
, .header-list-hover p:before
, .header-list-hover p:after {
    content: "";
    transition: 0.3s all ease;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    position: absolute;
    width: 0;
    height: 2px;
}

.header-list-hover a:before
, .header-list-hover p:before {
    right: 0;
    top: 0;
}

.header-list-hover a:after
, .header-list-hover p:after {
    left: 0;
    bottom: 0;
}

.header-list-hover a:hover:before
, .header-list-hover a:hover:after
, .header-list-hover p:hover:before
, .header-list-hover p:hover:after {
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
    z-index : 1;
    top: 0;
    left: 100%;
}

.header-list-dropdown-content a{
    white-space: nowrap; 
    font-size: 20px;
}

.header-list-dropdown:hover .header-list-dropdown-content {
    display: flex;
}

/* 헤더 검색바 */
.header-search {
    display: flex;
    align-items: center;
    gap: 20px;
}

.header-search-bar {
    border-radius: 50px;
    width: 330px;
    height: 35px;
    background-color: #f5f5f5;
    font-size: 16px;
    padding-left: 20px;
}

/* *********************************************************** */

/* 메인메인 */
.main {
    padding: 30px 25px 25px 25px;
    margin: 0 auto;
    max-width: 1300px;
}

/* *********************************************************** */

/* 푸터푸터 */
footer {
    height: 230px;
    background-color: #01083a;
    position: relative;
    transform: translateY(0%);
    display: grid;
    grid-template-rows: 140px 60px;
    z-index: 1000;
    margin-top: 50px;
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
@media (max-width: 1000px) {
    @font-face {
        font-family: 'MinSans-Regular';
        src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2201-2@1.0/MinSans-Regular.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }
    *{ 
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'MinSans-Regular';
    }
    .if-header {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        /* margin: 20px; */
    }

    .if-header :nth-child(2){
        justify-self: center;
        align-content: center;
    }

    #menu {
        position: relative;
    }

    .hamburger {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 30px;
        height: 25px;
        background: transparent;
        border: none;
        cursor: pointer;
        margin: 20px;
    }

    .bar {
        width: 30px;
        height: 4px;
        background-color: #000;
        border-radius: 2px;
    }

    .nav {
        display: flex;
        flex-direction: column;
        background-color: #01083a;
        position: absolute;
        top: 0;
        left: 0;
        width: 250px;
        height: 100vh;
        border: 1px solid #ccc;
        z-index: 100;
    } 
    .app-resist-login-div {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
        cursor: pointer;
    }

    .app-resist-login-div img {
    background-color: #fff;
    border-radius: 50px;
    width: 50px;
    height: 50px;
    }

    .app-resist-login {
        font-size: 20px;
        gap: 5px;
        font-weight: 900;
    }

    .app-resist-logout {
        display: grid;
        grid-template-columns: 2fr 1fr;
    }

    .app-content {
        font-size: 20px;
        margin-top: 10px;
        margin-left: 30px;
    }


    /* 햄버거 */

    .app-content-flex {
        display: flex;
        flex-direction: column;
        margin-top: 30px;
        gap: 5px;
    }

    .app-content a, .app-content p {
        color: #fff;
        font-size: 20px;
        font-weight: 500;
        padding: 5px;
        /**/
        position: relative;
        display: inline-block;
        text-decoration: none;
        text-transform: uppercase;
    }

    .app-content a:before
    , .app-content a:after
    , .app-content p:before
    , .app-content p:after {
        content: "";
        transition: 0.3s all ease;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        position: absolute;
        width: 0;
        height: 2px;
    }

    .app-content a:before
    , .app-content p:before {
        right: 0;
        top: 0;
    }

    .app-content a:after
    , .app-content p:after {
        left: 0;
        bottom: 0;
    }

    .app-content a:hover:before
    , .app-content a:hover:after
    , .app-content p:hover:before
    , .app-content p:hover:after {
        width: 100%;
        background: #fff;
    }

    .app-content-dropdown{
        position : relative;
        display : inline-block;
    }

    .app-content-dropdown-content{
        display : none;
        position : absolute;
        z-index : 1;
        top: 75%;
        left: -30%;
    }

    .app-content-dropdown-content a{
        display: inline-block;
        white-space: nowrap; 
        font-size: 16px;
    }

    .app-content-dropdown:hover .app-content-dropdown-content {
        display: block;
    }

    .v-if-header {
        display: grid;
        grid-template-rows: 125px 50px;
        background-color: #fff;
        position: sticky;
        top: 0;
        z-index: 1000;
        max-width: 1300px;
    }
    .header-search {
        justify-self: center;
    }
    .header-search-bar {
        border-radius: 50px;
        max-width: 500px;
        width: 100%;
        height: 35px;
        background-color: #f5f5f5;
        font-size: 16px;
        padding-left: 20px;
    }
    
    footer {
        height: 230px;
        background-color: #01083a;
        position: relative;
        transform: translateY(0%);
        display: grid;
        grid-template-rows: 140px 60px;
        z-index: 1000;
        margin-top: 50px;
        gap: 30px;
    }

    .footer-inner {
        justify-self: center;
    }

    .close3:after {content: "\00d7"; font-size:30pt;line-height:35px;}

    .close3 {
        color: #fff;
    }
}

</style>