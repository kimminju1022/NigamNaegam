<template>
    <div class="main-page-container">
        <div class="main-banner">
            <swiper
                :pagination="{
                    el: '.swiper-pagination',
                    type: 'fraction',
                }"
                :scrollbar="{
                    el: '.swiper-scrollbar',
                }"
                :autoplay="{
                    delay: 3600,
                    disableOnInteraction: false,
                }"
                :centeredSlides="true"
                :slidesPerView="1"
                :spaceBetween="30"
                :loop="true"
                :navigation="{
                    prevEl: '.swiper-button-prev',
                    nextEl: '.swiper-button-next',
                }"
                :modules="modules"
                class="mySwiper"
            >
                <swiper-slide>
                    <div class="banner-slide banner-slide1"></div>
                    <div class="banner-bottom-white"></div>
                    <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                        <router-link to="/products/12/129168">
                            <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img1.png">
                        </router-link>
                        <div class="banner-content-right">
                            <router-link to="/products/12/129168">
                                <div class="banner-content-title title1">
                                    <img src="/img_main/title1.png" class="banner-text-img">
                                </div>
                            </router-link>
                            <div class="banner-content-text">호미곶</div>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="banner-slide banner-slide2"></div>
                    <div class="banner-bottom-white"></div>
                    <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                        <router-link to="/products/12/2650745">
                            <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img2.png">
                        </router-link>
                        <div class="banner-content-right">
                            <router-link to="/products/12/2650745">
                                <div class="banner-content-title title2">
                                    <img src="/img_main/title2.png" class="banner-text-img">
                                </div>
                            </router-link>
                            <div class="banner-content-text">파라다이스 시티 호텔</div>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="banner-slide banner-slide3"></div>
                    <div class="banner-bottom-white"></div>
                    <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                        <router-link to="/products/12/126238">
                            <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img3.png">
                        </router-link>
                        <div class="banner-content-right">
                            <router-link to="/products/12/126238">
                                <div class="banner-content-title title3">
                                    <img src="/img_main/title3.png" class="banner-text-img-small">
                                </div>
                            </router-link>
                            <div class="banner-content-text">덕유산</div>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="banner-slide banner-slide4"></div>
                    <div class="banner-bottom-white"></div>
                    <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                        <router-link to="/products/12/126848">
                            <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img4.jpg">
                        </router-link>
                        <div class="banner-content-right">
                            <router-link to="/products/12/126848">
                                <div class="banner-content-title title4">
                                    <img src="/img_main/title4.png" class="banner-text-img-small">
                                </div>
                            </router-link>
                            <div class="banner-content-text title4-text">해동용궁사</div>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="banner-slide banner-slide5"></div>
                    <div class="banner-bottom-white"></div>
                    <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                        <router-link to="/hotels/142962">
                            <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img5.png">
                        </router-link>
                        <div class="banner-content-right">
                            <router-link to="/hotels/142962">
                                <div class="banner-content-title title5">
                                    <img src="/img_main/title5.png" class="banner-text-img">
                                </div>
                            </router-link>
                            <div class="banner-content-text title5-text">덕구온천</div>
                        </div>
                    </div>
                </swiper-slide>
                <button class="swiper-button-prev btn bg-clear"><</button>
                <button class="swiper-button-next btn bg-clear">></button>
                <div class="swiper-pagination"></div>
                <div class="swiper-scrollbar">
                    <div class="swiper-scrollbar-drag"></div>
                </div>
            </swiper>
        </div>
        
        <div class="main-together-container">
            <h2>같이 갈래? 나랑! 너랑?</h2>
            <hr>
            <div v-if="productRandom" class="main-together-list">
                <div class="main-card">
                    <router-link :to="`/products/12/${productRandom.spot.contentid}`" class="together-card-content">
                        <img :src="productRandom.spot.firstimage">
                        <p class="type-title">관광지</p>
                        <p>{{ productRandom.spot.title }}</p>
                    </router-link>
                </div>
                <div class="main-card together-card">
                    <router-link :to="`/products/14/${productRandom.culture.contentid}`" class="together-card-content">
                        <img :src="productRandom.culture.firstimage">
                        <p class="type-title">문화시설</p>
                        <p>{{ productRandom.culture.title }}</p>
                    </router-link>
                </div>
                <div class="main-card">
                    <router-link :to="`/products/28/${productRandom.sports.contentid}`" class="together-card-content">
                        <img :src="productRandom.sports.firstimage">
                        <p class="type-title">레포츠</p>
                        <p>{{ productRandom.sports.title }}</p>
                    </router-link>
                </div>
                <div class="main-card">
                    <router-link :to="`/products/38/${productRandom.shopping.contentid}`" class="together-card-content">
                        <img :src="productRandom.shopping.firstimage">
                        <p class="type-title">쇼핑</p>
                        <p>{{ productRandom.shopping.title }}</p>
                    </router-link>
                </div>
                <div class="main-card">
                    <router-link :to="`/products/39/${productRandom.restaurant.contentid}`" class="together-card-content">
                        <img :src="productRandom.restaurant.firstimage">
                        <p class="type-title">음식점</p>
                        <p>{{ productRandom.restaurant.title }}</p>
                    </router-link>
                </div>
            </div>
        </div>
        
        <div class="main-ppl-container">
            <a href="https://stolantern.com/photo/photo_history" target="_blank"><img src="/img_main/seoul_light_festival.png"></a>
            <a href="https://www.dtmsa.or.kr/" target="_blank"><img src="/img_main/daegu_market.png"></a>
            <a href="https://ramenfestival.co.kr/introduce" target="_blank"><img src="/img_main/ramen.png"></a>
        </div>
        
        <div class="main-popular-container">
            <h2>현재 인기글</h2>
            <div class="main-popular-review">
                <h3>리뷰</h3>
                <div class="main-popular-box">
                    <div v-for="item in boardReview" :key="item" class="main-card review-card">
                        <router-link :to="`/boards/${item.board_id}`" class="review-card-content">
                            <img :src="item.board_images[0]?.board_img">
                            <p>{{ item.board_title }}</p>
                            <p>{{ item.board_content }}</p>
                            <div class="user">
                                <img :src="item.user.user_profile" alt=""><p>by {{ item.user.user_nickname }}</p>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
    
            <div class="main-popular-free">
                <h3>자유</h3>
                <div class="main-popular-box">
                    <div v-for="item in boardFree" :key="item" class="main-card free-card">
                        <router-link :to="`/boards/${item.board_id}`" class="free-card-content">
                            <!-- <img :src="item.board_img1"> -->
                            <p>{{ item.board_title }}</p>
                            <p>{{ item.board_content }}</p>
                            <div class="user">
                                <img :src="item.user.user_profile"><p>by {{ item.user.user_nickname }}</p>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="divisverysad">
            <div class="announcement">
                <div class="announcement-sidebar">
                    <div class="announcement-text">
                        <p>내 감! 니 감? 의 소식을<br>확인해보세요</p>
                    </div>
                    <div class="announcement-info">
                        <router-link to="/questions">
                            <div class="announcement-info-content">
                                <div>
                                    <div class="announcement-info-qna-group">
                                        <p class="announcement-info-qna">문의 게시판 바로가기</p>
                                        <p class="announcement-info-qna">-></p>
                                    </div>
                                    <hr class="hr-style">
                                </div>
                                <p>내감!니감?에 대한 궁금한 점을<br>물어보세요</p>
                            </div>
                        </router-link>
                    </div>
                </div>
                <div class="announcement-item">
                    <div>
                        <div class="announcement-title">
                            <p>공지사항</p>
                            <router-link to="/notices"><button class="btn bg-clear" style="font-size: 30px;">+</button></router-link>
                        </div>
                        <hr class="hr-style">
                    </div>
                    <div>
                        <div v-for="item in noticeTopList" class="announcement-list"> 
                            <router-link :to="`/notices/${item.board_id}`">{{ item.board_title }}</router-link>
                            <p class="announcement-date">{{ item.created_at }}</p>
                        </div>
                        <!-- <div class="announcement-list"> 
                            <p>안녕하세요 반갑습니다.</p> 
                            <p class="announcement-date">2024-12-17</p>
                        </div>
                        <div class="announcement-list"> 
                            <p>안녕하세요 반갑습니다.</p> 
                            <p class="announcement-date">2024-12-17</p>
                        </div>
                        <div class="announcement-list"> 
                            <p>안녕하세요 반갑습니다.</p> 
                            <p class="announcement-date">2024-12-17</p>
                        </div>
                        <div class="announcement-list"> 
                            <p>안녕하세요 반갑습니다.</p> 
                            <p class="announcement-date">2024-12-17</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { computed, onBeforeMount, ref } from 'vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import 'swiper/css/scrollbar';

// Import required modules
import { Pagination, Navigation, Scrollbar, Autoplay } from 'swiper/modules';
import { useStore } from 'vuex';

const store = useStore();

const boardReview = computed(() => store.state.board.boardReview);
const boardFree = computed(() => store.state.board.boardFree);
const productRandom = computed(() => store.state.product.productRandom);
const actionNameNotice = 'notice/noticeTopList';
const noticeTopList = computed(() => store.state.notice.noticeTopList);

// Register Swiper modules
const modules = [Pagination, Navigation, Scrollbar, Autoplay];

const flg = ref(false);
const flgSetup = () => {
    flg.value = window.innerWidth >= 1000 ? false : true;
}
onBeforeMount(() => {
    flgSetup();
    
    store.dispatch('board/boardReview');
    store.dispatch('board/boardFree');
    store.dispatch('product/takeProductRandom');
    // console.log('1Review', boardReview.value);
    // console.log('test', store.state.board.boardReview);
    store.dispatch(actionNameNotice);
});
window.addEventListener('resize', flgSetup);
</script>

<style scoped>
/* 폰트 종류 */
/* 학교안심 물결 */
/* @font-face {
    font-family: 'TTHakgyoansimMulgyeolB';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2402_keris@1.0/TTHakgyoansimMulgyeolB.woff2') format('woff2');
    font-weight: 700;
    font-style: normal;
} */
/* 평창평화체 */
/* @font-face {
    font-family: 'PyeongChangPeace-Bold';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2206-02@1.0/PyeongChangPeace-Bold.woff2') format('woff2');
    font-weight: 700;
    font-style: normal;
} */
/* SF함박눈 */
/* @font-face {
    font-family: 'SF_HambakSnow';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2106@1.1/SF_HambakSnow.woff') format('woff');
    font-weight: normal;
    font-style: normal;
} */
/* 수성혜정체 */
/* @font-face {
    font-family: 'SuseongHyejeong';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2205-2@1.0/SuseongHyejeong.woff2') format('woff2');
    font-weight: normal;
    font-style: normal;
} */
/* 마초체 */
/* @font-face {
    font-family: 'EF_MACHO';
    src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2206-01@1.0/EF_MACHO.woff2') format('woff2');
    font-weight: normal;
    font-style: normal;
} */
a, a:visited {
    color: #000;
}
/* 전체를 감싸는 컨테이너 */
.main-page-container {
    display: flex;
    flex-direction: column;
    gap: 100px;
}

/* 베너 */
.main-banner {
    height: 500px;
}

/* ***** swiper CSS ***** */
/* swiper 전체 */
.swiper {
    width: 100%;
    /* width: 100vw; */
    height: 100%;
    /* overflow: visible; */
}
/* swiper 내부 */
.swiper-slide {
    text-align: center;
    font-size: 18px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* slide */
.banner-slide {
    width: 100%;
    height: 75%;
}
.banner-bottom-white {
    background-color: #fff;
    width: 100%;
    height: 25%;
}
.banner-content-flex {
    width: 90%;
    display: flex;
    position: absolute;
    gap: 50px;
}
.banner-content-img {
    width: 600px;
    height: 400px;
    /* border-radius: 30px; */
    object-fit: cover;
    margin-top: 20px;
    box-shadow: 5px 5px 10px rgba(76, 76, 76, .7);
}
.banner-content-right {
    display: flex;
    flex-direction: column;
    text-align: start;
    gap: 90px;
    padding: 20px 0;
    width: 100%;
}
.banner-content-text {
    color: #fff;
    font-weight: 500;
}
.banner-content-title > p {
    color: #fff;
    margin-bottom: 10px;
}
/* 슬라이드 타이틀 */
/* .title1 > p {
    font-family: 'TTHakgyoansimMulgyeolB';
    font-size: 65px;
} */
/* .title2 > p {
    font-family: 'PyeongChangPeace-Bold';
    font-size: 55px;
} */
/* .title3 > p {
    font-family: 'SF_HambakSnow';
    font-size: 65px;
} */
/* .title4 > p {
    font-family: 'EF_MACHO';
    font-size: 65px;
    color: #6170e2;
} */
/* .title4 + .title4-text {
    color: #6170e2;
} */
.title4-text {
    color: #6170e2;
}
/* .title5 > p {
    font-family: 'SuseongHyejeong';
    font-size: 65px;
    color: #4c4c4c;
} */
/* .title5 + .title5-text {
    color: #4c4c4c;
} */
.title5-text {
    color: #4c4c4c;
}
/* 텍스트 이미지 */
.banner-text-img {
    width: 500px;
    height: 150px;
}
.banner-text-img-small {
    width: 300px;
    height: 150px;
}
/* 슬라이드 배경 */
.banner-slide1 {
    /* background-color: rgba(255, 168, 93, 0.7); */
    background-image: url('/img_main/back1.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}
.banner-slide2 {
    /* background-color: #025B00; */
    background-image: url('/img_main/back2.jpg');
    background-repeat: no-repeat;
    /* background-position: center; */
    background-size: cover;
}
.banner-slide3 {
    /* background-color: #99bff2; */
    background-image: url('/img_main/back3.jpg');
    background-repeat: no-repeat;
    /* background-position: center; */
    background-size: cover
}
.banner-slide4 {
    /* background-color: rgba(255, 211, 88, 0.8); */
    background-image: url('/img_main/back4.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}
.banner-slide5 {
    /* background-color: #d7bda6; */
    background-image: url('/img_main/back5.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover
}
/* 화살표 */
.swiper-button-next::after, .swiper-button-prev::after {
    display: none;
}
.swiper-button-prev {
    /* color: #01083a; */
    width: 30px;
    height: 20px;
    font-size: 20px;
    margin-left: 1050px;
    margin-top: 156px;
}
.swiper-button-next {
    /* color: #01083a; */
    width: 30px;
    height: 20px;
    font-size: 20px;
    margin-right: 50px;
    margin-top: 156px;
}

/* 페이지네이션 */
.swiper-pagination {
    color: #01083a;
    margin-bottom: 65px;
    margin-left: 1095px;
    width: 105px;
}
/* 스크롤 */
.swiper-scrollbar {
    width: 500px;
    height: 10px;
    background-color: transparent;
    border-top: 1px solid #01083a;
    border-bottom: 1px solid #01083a;
    border-radius: 0;
    margin-bottom: 40px;
    margin-left: 730px;
}
.swiper-scrollbar > .swiper-scrollbar-drag {
    background-color: #01083a;
    border-radius: 0;
}

/* 같이할래 부분 */
.main-together-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}

.main-page-container h2, .main-page-container h3 {
    margin-bottom: 20px;
}

.main-together-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
    /* margin: 50px 0; */
    padding: 10px;
    place-items: center;
}

/* .main-together-list img {
    max-width: 220px;
    max-height: 220px;
} */

.together-card-content {
    display: grid;
    grid-template-rows: 200px 40px 70px;
    gap: 10px;
}

.type-title {
    font-size: 20px;
}

.type-title + p {
    font-size: 20px;
    font-weight: 900;
}

/* 광고 관련 */
.main-ppl-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    justify-items: center;
}

.main-ppl-container img {
    position: relative;
    transition: 0.2s ease-in-out;
    cursor: pointer;
}

.main-ppl-container img:hover {
    transform: translateY(-10px);
    box-shadow: 2px 2px 20px #ddd;
}

.main-ppl-container img{
    max-height: 300px;
    /* max-width: 300px; */
}

/* 인기글 관련 */
.main-popular-container {
    /* display: flex;
    flex-direction: column; */
    display: grid;
    grid-template-rows: 0fr 1fr 0.5fr;
    gap: 20px;
    margin: 50px 0;
}

.main-popular-review {
    border-top: 1px solid #4c4c4c;
}

.main-popular-review h3, .main-popular-free h3 {
    margin-top: 20px;
}

.main-popular-box {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
}

/* 카드 공통 */
.main-card {
    border: 1px solid #e7e7e7;
    border-radius: 10px;
    /* min-width: 180px; */
    width: 100%;
    position: relative;
    transition: 0.2s ease-in-out;
}

.main-card:hover {
    transform: translateY(-10px);
    cursor: pointer;
    box-shadow: 2px 2px 20px #ddd;
}

.review-card-content {
    display: grid;
    grid-template-rows: 200px 40px 70px 50px;
    gap: 10px;
}

.free-card-content {
    display: grid;
    grid-template-rows: 40px 70px 50px;
    gap: 10px;
}

.main-card img {
    object-fit: cover;
    background-repeat: no-repeat;
    width: 100%;
    /* max-height: 200px; */
    height: 100%;
    border-radius: 10px 10px 0px 0px;
}

.main-card p:not(:nth-of-type(3)), .user {
    width: 90%;
    margin: 0 auto;
    /* white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; */
}

.review-card p:nth-of-type(1):not(:last-child), .free-card p:nth-of-type(1):not(:last-child) {
    width: 90%;
    margin: 10px auto;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    word-break: break-all;
    height: 20px;
    font-weight: 600;
}

.review-card p:nth-of-type(2), .free-card p:nth-of-type(2) {
    width: 90%;
    margin: 0 auto;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    word-break: break-all;
    height: 60px;
}

.review-card-content > .user img, .free-card-content > .user img {
    border-radius: 50px;
    width: 35px;
    height: 35px;
    border: 2px solid #01083a18;
}

.user {
    display: flex;
    gap: 10px;
    align-items: center;
}


/* .main-card p:nth-of-type(3) {
    width: 90%;
    margin: 0 auto;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    word-break: break-all;
    height: 60px;
} */

/* 공지사항 부분 */
.divisverysad {
    display: grid;
    place-items: center;
    margin: 70px 0;
}

/* 내감니감의 소식을 확인해보세요 */
.announcement {
    display: grid;
    grid-template-columns: 1fr 2fr;
    justify-items: center;
    gap: 80px;
    /* max-width: 900px; */
    width: 90%;
}

.announcement-sidebar{
    /* display: flex;
    flex-direction: column; */
    display: grid;
    grid-template-rows: 1fr 1fr;
    /* justify-content: space-between; */
    width: 100%;
}

.announcement-sidebar > :first-child {
    /* align-content: center; */
    font-size: 25px;
}

/* 문의게시판 바로가기쪽 */
.announcement-info {
    padding: 20px;
    border-radius: 10px; 
    box-shadow: 2px 2px 15px rgba(175, 175, 175, 0.7);
}

.announcement-info-content {
    display: grid;
    grid-template-rows: 1fr 1fr;
    gap: 10px;
}

.announcement-info-qna-group{
    display: flex;
    justify-content: space-between;
}

.announcement-info-qna {
    font-size: 20px;
    padding: 10px 0;
    font-weight: 600;
}

/* 공지사항 */
hr {
    opacity: 50%;
}

.announcement-item {
    display: flex;
    flex-direction: column;
    padding: 20px;
    border-radius: 10px;
    /* min-width: 600px; */
    width: 100%;
    font-size: 16px;
    gap: 10px;
    box-shadow: 3px 3px 10px rgba(114, 114, 114, 0.7);
}

.announcement-item .announcement-title {
    display: flex;
    font-size: 22px;
    justify-content: space-between;
    font-weight: 600;
    margin: 0 10px;
}

.announcement-item > :first-child > :first-child {
    margin: 10px 0;
}

.announcement-list {
    display: grid;
    grid-template-columns: 4fr 1fr;
    gap: 30px;
    padding: 10px 30px;
    color: #4c4c4c;
}

.hr-style {
    border: 1px solid #01083a;
}

.announcement-date {
    text-align: end;
}

.announcement-text {
    font-weight: 600;
}

/* ---------- 반응형 ---------- */
/* 베너 관련 */
.ch-size {
    width: 250px;
    height: 350px;
}

.banner-content {
    width: 80%;
    /* display: flex; */
    position: absolute;
    gap: 20px;
}
</style>