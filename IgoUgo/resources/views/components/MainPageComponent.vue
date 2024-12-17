<template>
<div class="main-page-container">
    <div class="main-banner">
        <!-- <img src="default/main_banner.png" class="main-banner-img"> -->
        <swiper
            :pagination="{
                type: 'fraction',
            }"
            :scrollbar="true"
            :autoplay="{
                delay: 360000,
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
                    <img class="banner-content-img" :class="{'ch-size':flg}" src="img_main/homi.png">
                    <div class="banner-content-right">
                        <div>새해는 일출과 함께</div>
                        <div>호미곶</div>
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="banner-slide banner-slide2"></div>
                <div class="banner-bottom-white"></div>
                <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                    <img class="banner-content-img" :class="{'ch-size':flg}" src="img_main/chris.jpg">
                    <div class="banner-content-right">
                        <div>메리 크리스마스~</div>
                        <div>더현대</div>
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="banner-slide banner-slide3"></div>
                <div class="banner-bottom-white"></div>
                <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                    <img class="banner-content-img" :class="{'ch-size':flg}" src="img_main/duck.png">
                    <div class="banner-content-right">
                        <div>나랑~ 설산에~ 등산~ 갈래~?</div>
                        <div>한국의 대표 설산으로 꼽히는 덕유산</div>
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="banner-slide banner-slide4"></div>
                <div class="banner-bottom-white"></div>
                <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                    <img class="banner-content-img" :class="{'ch-size':flg}" src="img_main/souna.png">
                    <div class="banner-content-right">
                        <div>자연을 만끽하며 뜨끈한 물에~</div>
                        <div>사우나</div>
                    </div>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="banner-slide banner-slide5"></div>
                <div class="banner-bottom-white"></div>
                <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                    <img class="banner-content-img" :class="{'ch-size':flg}" src="img_main/haedong.png">
                    <div class="banner-content-right">
                        <div>숨겨진 일출 맛집</div>
                        <div>부산 해동용궁사</div>
                    </div>
                </div>
            </swiper-slide>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </swiper>
    </div>
    
    <div class="main-together-container">
        <div>
            <h2>같이 할래? 나랑! 너랑?</h2>
            <hr>
        </div>
        <div class="main-together-first">
            <div>
                <img src="default/board_default.png" class="main-together-img-big">
            </div>
            
            <div class="main-together-second">
                <div>재밋는 곳! 같이 감!</div>
                <hr>
                <div class="main-together-third">
                    <div class="main-card">
                        <img src="default/board_default.png" class="main-together-img">
                        <p>같이 체험할</p>
                    </div>
                    <div class="main-card">
                        <img src="default/board_default.png" class="main-together-img">
                        <p>체험상품들을</p>
                    </div>
                    <div class="main-card">
                        <img src="default/board_default.png" class="main-together-img">
                        <p>여기에 등록할것</p>
                    </div>
                    <div class="main-card">
                        <img src="default/board_default.png" class="main-together-img">
                        <p>디자인은 알아서</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <!-- 관광특구와 같은 홍보글 넣을것, 일단 이미지로 넣었음 -->
        <div class="main-ppl-container">
            <img src="default/profile_default.png" class="main-ppl-ex">
            <img src="default/profile_default.png" class="main-ppl-ex">
            <img src="default/profile_default.png" class="main-ppl-ex">
        </div>
    </div>
    
    <div class="main-popular-container">
        <div>
            <h2>현재 인기글</h2>
            <hr>
        </div>
        <div>
            <h2>리뷰</h2>
            <div class="main-popular-box">
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
            </div>
        </div>

        <div>
            <h2>자유</h2>
            <div class="main-popular-box">
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <img src="default/gongzi.png">
    </div>
</div>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { onBeforeMount, ref } from 'vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';
import 'swiper/css/scrollbar';

// Import required modules
import { Pagination, Navigation, Scrollbar, Autoplay } from 'swiper/modules';

// Register Swiper modules
const modules = [Pagination, Navigation, Scrollbar, Autoplay];

const flg = ref(false);
const flgSetup = () => {
    flg.value = window.innerWidth >= 1000 ? false : true;
}
onBeforeMount(() => {
    flgSetup();
});
window.addEventListener('resize', flgSetup);
</script>

<style scoped>
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
/* .main-banner-img {
    width: 100%;
} */
/* ***** swiper CSS ***** */
/* swiper 전체 */
.swiper {
  width: 100%;
  height: 100%;
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
/* img 없으니까 일단 뺌 */
/* .swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
} */
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
.banner-content {
    width: 80%;
    /* display: flex; */
    position: absolute;
    gap: 20px;
}
.banner-content-img {
    width: 400px;
    height: 400px;
    border-radius: 30px;
}
.banner-content-right {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
}

.banner-slide1 {
    background-color: #faba90;
}
.banner-slide2 {
    background-color: #025B00;
}
.banner-slide3 {
    background-color: #99bff2;
}
.banner-slide4 {
    background-color: #d7bda6;
}
.banner-slide5 {
    background-color: lavender;
}
.swiper-button-prev, .swiper-button-next {
  color: #01083a;
}

/* 같이할래 부분 */
.main-together-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.main-together-first {
    display: grid;
    grid-template-columns: 1fr 4fr;
    gap: 20px;
}
.main-together-second {
    padding: 50px 0;
}
.main-together-third {
    margin: 20px 0;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 10px;
}
.main-together-img {
    width: 200px;
    height: 200px;
}
.main-together-img-big {
    width: 300px;
    height: 500px;
}

/* 광고 관련 */
.main-ppl-container {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}
/* 광고 예시 이미지만 넣어두었으니 나중에 지울것 */
.main-ppl-ex {
    height: 100px;
}

/* 인기글 관련 */
.main-popular-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.main-popular-box {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

/* 카드 공통 */
.main-card {
    border: 1px solid #01083a;
    border-radius: 10px;
    min-width: 200px;
}

/* ---------- 반응형 ---------- */
/* 베너 관련 */
.ch-size {
    width: 250px;
    height: 350px;
}
.banner-content-flex {
    width: 80%;
    display: flex;
    position: absolute;
    gap: 20px;
}
</style>