<template>
<div><p class="product-headline">즐길거리</p></div>
<div>
    <div v-for="(products, condition) in allProduct" :key="condition" class="product-line">
        <div :style="{ backgroundImage: 'url(' + products[condition][0].firstimage + ')' }" class="product-main-img">
            <div class="product-main-title">
                <p>{{ condition }}</p>
            </div>
            <!-- <img src="/img_main/slide_img1.png" class="product-main-img"> -->
        </div>

        <div class="swiper-container">
            <swiper
            :slidesPerView="3"
            :spaceBetween="20"
            :navigation="{
                prevEl: '.swiper-button-prev',
                nextEl: '.swiper-button-next',
            }"
                :modules="modules"
                class="mySwiper"
                >
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][0].firstimage + ')' }"></swiper-slide>
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][1].firstimage + ')' }"></swiper-slide>
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][2].firstimage + ')' }"></swiper-slide>
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][3].firstimage + ')' }"></swiper-slide>
                <swiper-slide :style="{ backgroundImage: 'url(' + products[condition][4].firstimage + ')' }"></swiper-slide>
                <swiper-slide>더 알아보기</swiper-slide>
                
            </swiper>
        </div>
        <button class="swiper-button-prev btn bg-clear" :class="'class-prev-' + condition"><</button>
        <button class="swiper-button-next btn bg-clear" :class="'class-next-' + condition">></button>
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

import { onBeforeMount, onMounted, ref } from 'vue';
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
    gap: 50px;
    margin-bottom: 100px;
}

/* 상품 메인(젤 처음 사진) */
.product-main-img {
    width: 300px;
    height: 400px;
    border-radius: 30px;
    object-fit: cover;
    background-position: center;
}
.product-main-title {
    padding: 50px 20px;
    background-color: rgba(174, 174, 174, 0.7);
    font-size: 30px;
    font-weight: 900;
    margin-top: 220px;
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
    text-align: center;
    font-size: 18px;
    background: #fff;
    border: 2px solid #000;
    border-radius: 30px;

    /* Center slide text vertically */
    display: flex;
    justify-content: center;
    align-items: center;

    background-position: center;
    background-size: cover;
}
/* 화살표 */
.swiper-button-next::after, .swiper-button-prev::after {
    display: none;
}
.swiper-button-prev, .swiper-button-next {
    font-size: 30px;
    font-weight: 900;
    background-color: #fff;
    border: 1px solid #01083a;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    z-index: 1;
}
/* .swiper-button-next {
    font-size: 30px;
    font-weight: 900;
    background-color: #fff;
    border: 1px solid #01083a;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    z-index: 1;
} */
.class-prev-spot {
    margin-left: 464px;
    margin-top: 195px;
}
.class-next-spot {
    margin-right: 114px;
    margin-top: 195px;
}
.class-prev-culture {
    margin-left: 464px;
    margin-top: 695px;
}
.class-next-culture {
    margin-right: 114px;
    margin-top: 695px;
}
.class-prev-sports {
    margin-left: 464px;
    margin-top: 1195px;
}
.class-next-sports {
    margin-right: 114px;
    margin-top: 1195px;
}
.class-prev-shopping {
    margin-left: 464px;
    margin-top: 1695px;
}
.class-next-shopping {
    margin-right: 114px;
    margin-top: 1695px;
}
.class-prev-restaurant {
    margin-left: 464px;
    margin-top: 2195px;
}
.class-next-restaurant {
    margin-right: 114px;
    margin-top: 2195px;
}
</style>