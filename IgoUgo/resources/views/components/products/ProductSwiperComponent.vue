<template>
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
    <swiper-slide v-for="item in $store.state.product.productTypeList[condition]">
        <!-- <div class="slide-img" :style="{ backgroundImage: 'url(' + item.firstimage + ')' }"> -->
        <router-link :to="getProductLinkDetail(condition, item.contentid)">
            <div class="slide-card">
                <img :src="item.firstimage" class="slide-img">
                <div class="slide-title">
                    <p>{{ item.title }}</p>
                </div>
            </div>
        </router-link>
    </swiper-slide>
    <swiper-slide>
        <router-link :to="getProductLink(condition)">
            <div class="move-page-card">
                <p class="move-page">더 알아보기</p>
            </div>
        </router-link>
    </swiper-slide>
    
    <button class="swiper-button-prev btn bg-clear"><</button>
    <button class="swiper-button-next btn bg-clear">></button>
</swiper>
</div>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import { defineProps } from 'vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';

// Import required modules
import { Navigation } from 'swiper/modules';

// Register Swiper modules
const modules = [Navigation];

const props = defineProps({
  'condition': String
});

// 조건에 따른 id - 객체
const contentTypeId = {
    spot: 12,
    culture: 14,
    sports: 28,
    shopping: 38,
    restaurant: 39,
};

// 조건에 따른 url 생성
const getProductLink = (condition) => {
    const contentMatch = contentTypeId[condition];
    return `/products/${contentMatch}`;
};
// 조건에 따른 url 생성-상세
const getProductLinkDetail = (condition, id) => {
    const contentMatch = contentTypeId[condition];
    return `/products/${contentMatch}/${id}`;
};
</script>

<style scoped>
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
    border: 1px solid #e9e9e9;
    border-radius: 30px;

    /* Center slide text vertically */
    display: flex;
    justify-content: center;
    align-items: center;

    /* background-position: center;
    background-size: cover; */
}
.slide-card {
    width: 200px;
    height: 318px;
    display: grid;
    grid-template-rows: 200px 118px;
}
.slide-img {
    border-radius: 30px 30px 0 0;
    width: 200px;
    height: 200px;
}
.slide-title {
    background-color: #fff;
    font-size: 20px;
    font-weight: 900;
    border-radius: 0 0 30px 30px;
    padding: 0 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.move-page-card {
    width: 202px;
    height: 320px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.move-page {
    font-size: 25px;
}
.swiper-slide:hover {
    cursor: pointer;
}
.move-page-card:hover > .move-page {
    background-color: #01083a;
    color: #fff;
    font-size: 25px;
    font-weight: 900;
    width: 200px;
    height: 318px;
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
</style>