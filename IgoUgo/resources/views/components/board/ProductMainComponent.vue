<template>
<div><p class="product-headline">즐길거리</p></div>
<div>
    <div v-for="(products, condition) in allProduct" :key="condition" class="product-line">
        <!-- <div :style="{ backgroundImage: 'url(' + products[condition][0].firstimage + ')' }" class="product-main-img"> -->
        <div class="product-main-img" :class="'back-' + condition">
            <div class="product-main-title">
                <p v-if="condition === 'spot'">관광지</p>
                <p v-else-if="condition === 'culture'">문화시설</p>
                <p v-else-if="condition === 'sports'">레포츠</p>
                <p v-else-if="condition === 'shopping'">쇼핑</p>
                <p v-else>음식점</p>
            </div>
            <!-- <img src="/img_main/slide_img1.png" class="product-main-img"> -->
        </div>

        <div class="swiper-container">
            <swiper
            :slidesPerView="4"
            :spaceBetween="30"
            :navigation="{
                prevEl: '.swiper-button-prev',
                nextEl: '.swiper-button-next',
            }"
                :modules="modules"
                class="mySwiper"
                >
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][0].firstimage + ')' }">
                    <div class="slide-title">
                        <p>{{ products[condition][0].title }}</p>
                    </div>
                </swiper-slide>
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][1].firstimage + ')' }">
                    <div class="slide-title">
                        <p>{{ products[condition][1].title }}</p>
                    </div>
                </swiper-slide>
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][2].firstimage + ')' }">
                    <div class="slide-title">
                        <p>{{ products[condition][2].title }}</p>
                    </div>
                </swiper-slide>
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][3].firstimage + ')' }">
                    <div class="slide-title">
                        <p>{{ products[condition][3].title }}</p>
                    </div>
                </swiper-slide>
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][4].firstimage + ')' }">
                    <div class="slide-title">
                        <p>{{ products[condition][4].title }}</p>
                    </div>
                </swiper-slide>
                <swiper-slide>
                    <p class="move-page">더 알아보기</p>
                </swiper-slide>
                
                <button class="swiper-button-prev btn bg-clear"><</button>
                <button class="swiper-button-next btn bg-clear">></button>
            </swiper>
        </div>
    </div>
</div>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';

// Import required modules
import { Navigation } from 'swiper/modules';

// Register Swiper modules
const modules = [Navigation];

import { onBeforeMount, ref } from 'vue';
import axios from 'axios';

// 조건 목록
const conditions = [
    'spot',
    'culture',
    'sports',
    'shopping',
    'restaurant',
];

// DB
const allProduct = ref({}); // 조건별 데이터를 저장
const loading = ref(true); // 로딩 상태태

const fetchConditionProduct = (condition) => {
    return axios.get('/api/products', condition)
    .then((response) => {
        allProduct.value[condition] = response.data;
    })
    .catch((error) => {
        console.error(error);
    })
}

const fetchAllProduct = () => {
    loading.value = true;
    const promises = conditions.map((condition) => fetchConditionProduct(condition));
    Promise.all(promises)
    .then(() => {
        loading.value = false;
    })
    .catch((error) => {
        console.error(error);
        loading.value = false;
    })
}

onBeforeMount(() => {
    fetchAllProduct();
})    
</script>

<style scoped>
/* 타이틀-즐길거리 */
.product-headline {
    font-size: 50px;
    font-weight: 900;
    margin: 50px 0;
}

/* 한 줄 */
.product-line {
    display: flex;
    justify-content: center;
    gap: 70px;
    margin-bottom: 100px;
}

/* 상품 메인(젤 처음 사진) */
.product-main-img {
    border: 1px solid #e9e9e9;
    width: 220px;
    height: 320px;
    border-radius: 30px;
    object-fit: cover;
    background-position: center;
    padding: 20px 0;
}
.product-main-title {
    padding: 30px 20px;
    background-color: rgba(170, 170, 170, 0.7);
    font-size: 30px;
    font-weight: 900;
    margin-top: 140px;
}

/* swiper */
.swiper-container {
    max-width: 900px;
    overflow: hidden;
}
.swiper {
    width: 100%;
    height: 100%;
}
.swiper-slide {
    /* text-align: center;
    font-size: 18px; */
    border: 1px solid #e9e9e9;
    border-radius: 30px;

    /* Center slide text vertically */
    display: flex;
    justify-content: center;
    align-items: center;

    background-position: center;
    background-size: cover;
}
.slide-title {
    visibility: hidden;
    background-color: rgba(0, 0, 0, 0.6);
    color: #fff;
    font-size: 25px;
    font-weight: 900;
    width: 200px;
    height: 320px;
    border-radius: 30px;
    padding: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.move-page {
    font-size: 25px;
}
.swiper-slide:hover > .slide-title {
    cursor: pointer;
    visibility: visible;
}
.swiper-slide:hover > .move-page {
    background-color: #01083a;
    color: #fff;
    font-size: 25px;
    font-weight: 900;
    width: 200px;
    height: 320px;
    border-radius: 30px;
    padding: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
}
/* 화살표 */
.swiper-button-next::after, .swiper-button-prev::after {
    display: none;
}
.swiper-button-prev, .swiper-button-next {
    font-size: 20px;
    font-weight: 900;
    background-color: #fff;
    border: 1px solid #01083a;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    z-index: 1;
}
.back-spot {
    background-image: url('/img_product/spot.png');
}
.back-culture {
    background-image: url('/img_product/culture.png');
}
.back-sports {
    background-image: url('/img_product/sports.png');
}
.back-shopping {
    background-image: url('/img_product/shopping.png');
}
.back-restaurant {
    background-image: url('/img_product/restaurant.png');
}
</style>