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
                        <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img1.png">
                        <div class="banner-content-right">
                            <div class="banner-content-title title1">
                                <!-- <p>푸른 뱀의 해가</p>
                                <p>밝았습니다!</p> -->
                                <img src="/img_main/title1.png" class="banner-text-img">
                            </div>
                            <div class="banner-content-text">호미곶</div>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="banner-slide banner-slide2"></div>
                    <div class="banner-bottom-white"></div>
                    <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                        <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img2.png">
                        <div class="banner-content-right">
                            <div class="banner-content-title title2">
                                <!-- <p>GRAND</p>
                                <p>SANTA EXPRESS</p> -->
                                <img src="/img_main/title2.png" class="banner-text-img">
                            </div>
                            <div class="banner-content-text">파라다이스 시티 호텔</div>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="banner-slide banner-slide3"></div>
                    <div class="banner-bottom-white"></div>
                    <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                        <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img3.png">
                        <div class="banner-content-right">
                            <div class="banner-content-title title3">
                                <!-- <p>한국의</p>
                                <p>대표 설산</p> -->
                                <img src="/img_main/title3.png" class="banner-text-img-small">
                            </div>
                            <div class="banner-content-text">덕유산</div>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="banner-slide banner-slide4"></div>
                    <div class="banner-bottom-white"></div>
                    <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                        <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img4.jpg">
                        <div class="banner-content-right">
                            <div class="banner-content-title title4">
                                <!-- <p>숨겨진</p>
                                <p>일출 맛집</p> -->
                                <img src="/img_main/title4.png" class="banner-text-img-small">
                            </div>
                            <div class="banner-content-text title4-text">해동용궁사</div>
                        </div>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <div class="banner-slide banner-slide5"></div>
                    <div class="banner-bottom-white"></div>
                    <div :class="flg ? 'banner-content' : 'banner-content-flex'">
                        <img class="banner-content-img" :class="{'ch-size':flg}" src="/img_main/slide_img5.png">
                        <div class="banner-content-right">
                            <div class="banner-content-title title5">
                                <!-- <p>겨울에 야외 스파</p>
                                <p>어때요?</p> -->
                                <img src="/img_main/title5.png" class="banner-text-img">
                            </div>
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
    .title4 + .title4-text {
        color: #6170e2;
    }
    /* .title5 > p {
        font-family: 'SuseongHyejeong';
        font-size: 65px;
        color: #4c4c4c;
    } */
    .title5 + .title5-text {
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
        margin-left: 1090px;
        width: 70px;
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
        margin-left: 700px;
    }
    .swiper-scrollbar > .swiper-scrollbar-drag {
        background-color: #01083a;
        border-radius: 0;
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
    .banner-content {
        width: 80%;
        /* display: flex; */
        position: absolute;
        gap: 20px;
    }
    </style>