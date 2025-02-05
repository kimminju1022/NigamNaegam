<template>
    <header>
        <!-- header -->

        <div class="header-header" v-if="flg === '0'">
            <div class="header-title">
                <!-- <router-link to="/"><img class="header-logo-img" src="/train.png" alt=""></router-link> -->
                <router-link to="/"><img class="header-title-img" src="/logo_IgoUgo.png" alt=""></router-link>
                <div class="header-search"> 
                    <input v-model="search" class="header-search-bar" type="text" placeholder="Q 어디로 놀러가세요?">
                    <button @click="mainSearch" class="btn bg-navy header-bg-btn">검색</button>
                </div>
                <div v-if="!$store.state.auth.authFlg" class="header-title-button">
                    <!-- FAQ는 통계기능이 생기면 합시당 -->
                    <router-link to="/questions" @click="$store.commit('pagination/setPaginationInitialize')"><button class="btn bg-clear header-btn">공지사항</button></router-link>
                    <!-- FAQ는 통계기능이 생기면 합시당 -->
                    <router-link to="/questions" @click="$store.commit('pagination/setPaginationInitialize')"><button class="btn bg-clear header-btn">문의</button></router-link>
                    <router-link to="/before/registration"><button class="btn bg-clear header-btn">회원가입</button></router-link>
                    <router-link to="/login"><button class="btn bg-navy header-bg-btn">로그인</button></router-link>
                </div>
                <div v-else class="header-title-button">
                    <router-link to="/questions" @click="$store.commit('pagination/setPaginationInitialize')"><button class="btn bg-clear header-btn">공지사항</button></router-link>
                    <router-link to="/questions" @click="$store.commit('pagination/setPaginationInitialize')"><button class="btn bg-clear header-btn">문의</button></router-link>
                    <!-- <button @click="$store.dispatch('auth/logout')" class="btn bg-logout header-logout">로그아웃</button> -->
                    <button @click="logout" class="btn bg-logout header-logout">로그아웃</button>
                    <router-link :to="`/user/${user.user_id}`" @click="$store.commit('pagination/setPaginationInitialize')"><img :src="user.user_profile"></router-link>
                </div>
            </div>
            <div class="header-list">
                <div class="header-list-box">
                    <ul class="header-list-flex">
                        <li class="header-list-hover">
                            <router-link to="/hotels" @click="$store.commit('pagination/setPaginationInitialize')">호텔</router-link>
                            <div class="dropdown-content">
                                <div class="dropdown-menu">
                                    <div class="dropdown-list">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list">
                                        <router-link to="/products/12" @click="$store.commit('pagination/setPaginationInitialize')">관광지</router-link>
                                        <router-link to="/products/14" @click="$store.commit('pagination/setPaginationInitialize')">문화시설</router-link>
                                        <router-link to="/products/28" @click="$store.commit('pagination/setPaginationInitialize')">레포츠</router-link>
                                        <router-link to="/products/38" @click="$store.commit('pagination/setPaginationInitialize')">쇼핑</router-link>
                                        <router-link to="/products/39" @click="$store.commit('pagination/setPaginationInitialize')">음식점</router-link>
                                    </div>
                                    <div class="dropdown-list">
                                        <a @click="redirectBoards('0')">리뷰게시판</a>
                                        <a @click="redirectBoards('1')">자유게시판</a>
                                        <router-link to="">공지사항</router-link>
                                        <router-link to="/questions">문의사항</router-link>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="header-list-hover">
                            <router-link to="/products" @click="$store.commit('pagination/setPaginationInitialize')">즐길거리</router-link>
                            <div class="dropdown-content">
                                <div class="dropdown-menu">
                                    <div class="dropdown-list">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list">
                                        <router-link to="/products/12" @click="$store.commit('pagination/setPaginationInitialize')">관광지</router-link>
                                        <router-link to="/products/14" @click="$store.commit('pagination/setPaginationInitialize')">문화시설</router-link>
                                        <router-link to="/products/28" @click="$store.commit('pagination/setPaginationInitialize')">레포츠</router-link>
                                        <router-link to="/products/38" @click="$store.commit('pagination/setPaginationInitialize')">쇼핑</router-link>
                                        <router-link to="/products/39" @click="$store.commit('pagination/setPaginationInitialize')">음식점</router-link>
                                    </div>
                                    <div class="dropdown-list">
                                        <a @click="redirectBoards('0')">리뷰게시판</a>
                                        <a @click="redirectBoards('1')">자유게시판</a>
                                        <router-link to="">공지사항</router-link>
                                        <router-link to="/questions">문의사항</router-link>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="header-list-hover">
                            <router-link to="">커뮤니티</router-link>
                            <div class="dropdown-content">
                                <div class="dropdown-menu">
                                    <div class="dropdown-list">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list">
                                        <router-link to="/products/12" @click="$store.commit('pagination/setPaginationInitialize')">관광지</router-link>
                                        <router-link to="/products/14" @click="$store.commit('pagination/setPaginationInitialize')">문화시설</router-link>
                                        <router-link to="/products/28" @click="$store.commit('pagination/setPaginationInitialize')">레포츠</router-link>
                                        <router-link to="/products/38" @click="$store.commit('pagination/setPaginationInitialize')">쇼핑</router-link>
                                        <router-link to="/products/39" @click="$store.commit('pagination/setPaginationInitialize')">음식점</router-link>
                                    </div>
                                    <div class="dropdown-list">
                                        <a @click="redirectBoards('0')">리뷰게시판</a>
                                        <a @click="redirectBoards('1')">자유게시판</a>
                                        <router-link to="">공지사항</router-link>
                                        <router-link to="/questions">문의사항</router-link>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="header-list-hover">
                            <router-link to="">체험단 신청</router-link>
                            <div class="dropdown-content">
                                <div class="dropdown-menu">
                                    <div class="dropdown-list">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list">
                                        <router-link to="/products/12" @click="$store.commit('pagination/setPaginationInitialize')">관광지</router-link>
                                        <router-link to="/products/14" @click="$store.commit('pagination/setPaginationInitialize')">문화시설</router-link>
                                        <router-link to="/products/28" @click="$store.commit('pagination/setPaginationInitialize')">레포츠</router-link>
                                        <router-link to="/products/38" @click="$store.commit('pagination/setPaginationInitialize')">쇼핑</router-link>
                                        <router-link to="/products/39" @click="$store.commit('pagination/setPaginationInitialize')">음식점</router-link>
                                    </div>
                                    <div class="dropdown-list">
                                        <a @click="redirectBoards('0')">리뷰게시판</a>
                                        <a @click="redirectBoards('1')">자유게시판</a>
                                        <router-link to="">공지사항</router-link>
                                        <router-link to="/questions">문의사항</router-link>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="header-list-hover">
                            <router-link to="">이달의 추천</router-link>
                            <div class="dropdown-content">
                                <div class="dropdown-menu">
                                    <div class="dropdown-list">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list">
                                        <router-link to="/products/12" @click="$store.commit('pagination/setPaginationInitialize')">관광지</router-link>
                                        <router-link to="/products/14" @click="$store.commit('pagination/setPaginationInitialize')">문화시설</router-link>
                                        <router-link to="/products/28" @click="$store.commit('pagination/setPaginationInitialize')">레포츠</router-link>
                                        <router-link to="/products/38" @click="$store.commit('pagination/setPaginationInitialize')">쇼핑</router-link>
                                        <router-link to="/products/39" @click="$store.commit('pagination/setPaginationInitialize')">음식점</router-link>
                                    </div>
                                    <div class="dropdown-list">
                                        <a @click="redirectBoards('0')">리뷰게시판</a>
                                        <a @click="redirectBoards('1')">자유게시판</a>
                                        <router-link to="">공지사항</router-link>
                                        <router-link to="/questions">문의사항</router-link>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                    <div class="dropdown-list dropdown-list2">
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </li>   
                    </ul>
                </div>
            </div>
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
                            <div v-if="!$store.state.auth.authFlg" class="app-header-btn">
                                <router-link to="/before/registration"><button class="app-resist-login btn bg-navy">회원가입</button></router-link>
                                <router-link to="/login"><button class="app-resist-login btn bg-navy">로그인</button></router-link>
                            </div>
                            <div v-else class="app-resist-logout">
                                <button @click="$store.dispatch('auth/logout')" class="app-resist-login btn bg-navy">로그아웃</button>
                                <router-link :to="`/user/${user.user_id}`" @click="$store.commit('pagination/setPaginationInitialize')"><img :src="$store.state.user.userInfo.user_profile" alt=""></router-link>
                            </div>
                        </div>
                        <ul class="app-content-flex">
                            <li class="app-content"><router-link to="/hotels" @click="$store.commit('pagination/setPaginationInitialize')">호텔</router-link></li>
                            <li class="app-content">
                                <div class="app-content-dropdown">
                                    <router-link to="/products" @click="$store.commit('pagination/setPaginationInitialize')">즐길거리</router-link>
                                        <div class="app-content app-content-dropdown-content">
                                            <router-link to="/products/12" @click="$store.commit('pagination/setPaginationInitialize')">관광지</router-link>
                                            <router-link to="/products/14" @click="$store.commit('pagination/setPaginationInitialize')">문화시설</router-link>
                                            <router-link to="/products/28" @click="$store.commit('pagination/setPaginationInitialize')">레포츠</router-link>
                                            <router-link to="/products/38" @click="$store.commit('pagination/setPaginationInitialize')">쇼핑</router-link>
                                            <router-link to="/products/39" @click="$store.commit('pagination/setPaginationInitialize')">음식점</router-link>
                                        </div>
                                </div></li>
                            <li class="app-content">
                                <div class="app-content-dropdown">
                                    <p class="app-content-dropbtn">게시판</p>
                                    <div class="app-content app-content-dropdown-content app-dropdown-board">
                                        <a @click="redirectBoards('0')" class="app-review-board">리뷰</a>
                                        <a @click="redirectBoards('1')" class="app-review-board">자유</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
    </header>

    <!-- main -->

    <main class="main">
        <router-view></router-view>
    </main>


    <!-- footer -->

    <div v-if="flg === '0'">
        <footer>
            <div class="footer-inner">
                <div class="footer-menu">
                    <router-link to="">공지사항</router-link>
                    <router-link to="">FAQ</router-link>
                    <router-link to="/questions">문의게시판</router-link>
                </div>
                <div class="footer-line"></div>
                <div class="footer-text-box">
                    <div class="footer-logo">
                        <img src="/logo_footer_gam.png" alt="">
                    </div>
                    <div>
                        <div class="footer-text">
                            <p>(주)  절어서 한국속으로</p>
                        </div>
                        <div class="footer-text">
                            <!-- <p>(주)  절어서 한국속으로</p> -->
                            <p>팀원 : 김민주</p>
                            <p>얘들아 그만하고 제발 좀 자~</p>
                        </div>
                        <div class="footer-text">
                            <!-- <p>(주)  절어서 한국속으로</p> -->
                            <p>팀원 : 김지민</p>
                            <p>이게 왜 되지? 이게 왜 안 되지?</p>
                        </div>
                        <div class="footer-text">
                            <!-- <p>(주)  절어서 한국속으로</p> -->
                            <p>팀원 : 윤종승</p>
                            <p>(이마 탁!) 앗!</p>
                        </div>
                        <div class="footer-text">
                            <!-- <p>(주)  절어서 한국속으로</p> -->
                            <p>팀원 : 이경진</p>
                            <p>어?!아까 됐는데 왜 또 안되지?</p>
                        </div>
                        
                        <div class="copy-right">
                            <p>COPYRIGHT ⓒ 2024 IgoUgo All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="footer-bottom">
                <div class="copy-right">
                    <p>COPYRIGHT ⓒ 2024 IgoUgo All rights reserved</p>
                </div>
            </div> -->
        </footer>
    </div>


    <div v-if="flg === '1'">
        <footer>
            <div class="footer-inner">
                <div class="footer-text">
                    <p>Tel : 053.572.1005</p>
                    <p>(주)  절어서 한국속으로</p>
                    <p>대표 : 미어캣</p>
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
import { useRoute, useRouter } from 'vue-router';

const store = useStore();
const user = computed(()=> store.state.auth.userInfo);
const router = useRouter();

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

const logout = () =>{
    const check = confirm('로그아웃 하시겠습니까?');
    if(check) {
        store.dispatch('auth/logout');
    }
}

// 검색
const search = ref('');
const mainSearch = (() => {
    store.commit('pagination/setPaginationInitialize'); // pagination 초기화    
    // console.log('search :',search.value);
    store.commit('search/setSearchKeyword', search.value); // 검색 키워드 저장
    router.push('/search');
})

// ---------- 게시판 이동 관련 start ----------
const redirectBoards = async (bcCode) => {
    store.commit('pagination/setPaginationInitialize');
    store.commit('board/setBcCode', bcCode);
    await store.dispatch('board/getBoardListPagination', {page: 1, bc_code: bcCode});
    router.push('/boards');
}
// ---------- 게시판 이동 관련 end ----------
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
    color: #01083a;
    cursor: pointer;
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

header {
    background-color: #fff;
    position: sticky;
    top: 0;
    z-index: 2;
    box-shadow: 3px 0px 20px #e7e7e7;
}

.header-header {
    display: grid;
    grid-template-rows: 100px 50px;
    background-color: #fff;
    position: sticky;
    top: 0;
    /* z-index: 1; */
    margin: 0 auto;
    /* max-width: 1300px; */
    max-width: 1920px;
    gap: 15px;
}

/* 헤더 1 -> 로고 , 로그인 버튼 */
.header-title {
    display: grid;
    grid-template-columns: 1.5fr 5fr 2fr;
    align-items: center;
    margin-top: 25px;
    gap: 10px;
}

.header-title > :first-child {
    /* justify-self: center; */
    margin-left: 15%;
}

.header-title-button {
    display: flex;
    gap: 25px;
    align-items: center;
    justify-content: flex-end;
    margin-right: 15%;
}

.header-title-button img {
    border-radius: 50px;
    width: 50px;
    height: 50px;
    /* border: 2px solid #01083A; */
    border: 2px solid #01083a18;
}

/* .header-list > :last-child {
    margin-left: auto;
} */

.header-logo-img {
    width: 90px;
    height: 90px;
}

.header-title-img-1 {
    width: 110px;
}

.header-title-img {
    /* width: 450px; */
    width: 250px;
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

.header-bg-btn:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
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

.bg-logout {
    background-color: #c9c9c9;
}


/* 헤더 2 -> 호텔, 상품, 게시판, 검색바 */
.header-list {
    display: flex;
    align-items: center;
    justify-content: center;
    /* margin: 0 8px; */
    gap: 20px;
    margin-bottom: 20px;
}

/* 호텔, 상품, 게시판 hover */
.header-list-flex {
    display: flex;
    flex-direction: row;
    gap: 15px;
}

.header-list-hover a, .header-list-hover p {
    color: #01083A;
    font-size: 20px;
    font-weight: 500;
    padding: 5px 10px;
    position: relative;
    display: block;
    text-decoration: none;
    text-transform: uppercase;
    text-align: center;
}

.header-list-hover a:before
, .header-list-hover a:after {
/* .header-list-hover a:before
, .header-list-hover a:after
, .header-list-hover p:before
, .header-list-hover p:after { */
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
, .header-list-hover a:hover:after {
/* .header-list-hover a:hover:before
, .header-list-hover a:hover:after
, .header-list-hover p:hover:before
, .header-list-hover p:hover:after { */
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
}

.header-list-dropdown-content a{
    display: block;
    font-size: 19px;   
}

.header-list-dropdown:hover .header-list-dropdown-content {
    display: block;
    background: #fff;
}

.dropdown-content {
    display: none;
    position: absolute;
    width: 100%;
    left: 0;
    z-index: 1;
    background-color: #F4F6F8;
    padding: 20px;
}

.dropdown-menu {
    display: flex;
    justify-content: center;
    flex-direction: row;
    gap: 15px;
}

.header-list-hover:hover .dropdown-content {
    display: block;
}

.dropdown-menu p {
    width: 50px;
}

.dropdown-list2 p {
    width: 110px;
}

.dropdown-list a, .dropdown-list {
    font-size: 18px;
}


/* 헤더 검색바 */
.header-search {
    display: flex;
    align-items: center;
    gap: 10px;
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
    /* padding: 30px 25px 25px 25px; */
    padding: 30px 0 25px 0;
    margin: 50px auto 0 ;
    max-width: 1300px;
}

/* *********************************************************** */

/* 푸터푸터 */
footer {
    /* height: 230px; */
    background-color: #e0e0e0;
    /* position: relative;
    transform: translateY(0%); */
    /* display: grid;
    grid-template-rows: 1fr 60px; */
    /* z-index: 1; */
    margin-top: 50px;
    gap: 30px;
}

/* 푸터 사업자번호 */
.footer-inner {
    padding-top: 20px;
    display: flex;
    justify-content: center;
    /* align-items: center; */
    gap: 50px;
    margin: 0 auto;
}

.footer-menu {
    display: flex;
    flex-direction: column;
    font-size: 18px;
    line-height: 30px;
    align-items: flex-start;
}

.footer-menu a {
    color: #3f3f3f;
}

.footer-line {
    border-left: 1px solid #8a8a8a;
    height: 180px;
}

.footer-text-box {
    display: flex;
    gap: 50px;
}

.footer-logo img {
    height: 130px;
    width: 150px;
}

.footer-text {
    color: #3f3f3f;
    font-size: 15px;
    /* letter-spacing: 1px; */
    /* white-space: nowrap; */
    line-height: 1.7rem;
    display: flex;
    gap: 10px;
}
/* 
.footer-bottom {
    margin: 0 auto;
} */

/* .hr {
    width: 100vw;
} */

.copy-right {
    font-size: 13px;
    color: #3f3f3f;
    margin: 20px 0;
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

    .app-header-btn {
        display: flex;
        gap: 10px;
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

    .app-resist-logout img {
        border-radius: 50%;
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
        /* top: 75%;
        left: -30%; */
        top: -10%;
        left: 60%;
    }

    .app-dropdown-board {
        top: -10%;
        left: 50%;
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
        background-color: #c9c9c9;
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