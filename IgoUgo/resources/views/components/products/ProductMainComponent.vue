<template>
<div><p class="product-headline">즐길거리</p></div>
<div v-if="$store.state.product.productTypeList.spot">
    <div v-for="(condition, idx) in conditions" :key="idx" class="product-line">
        <!-- <div :style="{ backgroundImage: 'url(' + products.firstimage + ')' }" class="product-main-img"> -->
        <router-link :to="getProductLink(condition)">
            <!-- <div class="product-main-img" :class="'back-' + condition"> -->
            <div class="product-main-img">
                <div class="product-main-title">
                    <p v-if="condition === 'spot'">관광지</p>
                    <p v-else-if="condition === 'culture'">문화시설</p>
                    <p v-else-if="condition === 'sports'">레포츠</p>
                    <p v-else-if="condition === 'shopping'">쇼핑</p>
                    <p v-else>음식점</p>
                </div>
                <!-- <img src="/img_main/slide_img1.png" class="product-main-img"> -->
            </div>
        </router-link>
        <ProductSwiperComponent :condition="condition"></ProductSwiperComponent>
    </div>
</div>
</template>

<script setup>
import { onBeforeMount, ref } from 'vue';
import { useStore } from 'vuex';
import ProductSwiperComponent from './ProductSwiperComponent.vue';

const store = useStore();

// 조건 목록
const conditions = [
    'spot',
    'culture',
    'sports',
    'shopping',
    'restaurant',
];

// 조건에 따른 id - 객체
const contentTypeId = {
    spot: 12,
    culture: 14,
    sports: 28,
    shopping: 38,
    restaurant: 39,
};

onBeforeMount(async () => {
    // fetchAllProduct();
    await store.dispatch('product/takeProducts');
})    

// 조건에 따른 url 생성
const getProductLink = (condition) => {
    const contentMatch = contentTypeId[condition];
    return `/products/${contentMatch}`;
};

// DB
const loading = ref(true); // 로딩 상태
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
    background-image: url('/img_product/pattern2.png');
    background-size: cover;
}
.product-main-title {
    padding: 30px 20px;
    background-color: rgba(170, 170, 170, 0.7);
    font-size: 30px;
    font-weight: 900;
    margin-top: 140px;
}
/* .back-spot {
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
} */
</style>