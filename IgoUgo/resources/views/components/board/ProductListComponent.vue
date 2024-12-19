<template>
<div class="total-container">
    

    <div>
        <div class="right-small-container order-box font-default-size">
            <div>
                <span class="font-bold">정렬 순서</span>
            </div>
            <div class="order-list">
                <p>|</p>
                <div class="order-list-item">
                    뽀빠이 추천
                    <img src="img_product/img_star.png" class="img-order">
                </div>
                <p>|</p>
                <div class="order-list-item">
                    최신순
                    <span class="order-list-item-update font-bold">NEW</span>
                </div>
                <p>|</p>
                <div class="order-list-item">
                    베스트셀러
                    <img src="img_product/img_thumb.png" class="img-order">
                </div>
                <p>|</p>
                <div class="order-list-item">
                    낮은 가격
                    <img src="img_product/img_won.png" class="img-order">
                </div>
            </div>
        </div>
        <div class="right-small-container">
            <!-- <div v-else-if="error">{{ error }}</div> -->
            <div v-if="productItems.length > 0" class="card-list">
                <div v-for="item in productItems" :key="item" class="card">
                    <img :src="item.firstimage" @error="e => e.target.src='/default/board_default.png'" class="img-card">
                    <p class="font-bold card-title">{{ item.title }}</p>
                </div>
            </div>
            <div v-else>상품 데이터를 불러오는 중...</div>

            
            <div class="pagination">
                <a href="#"><button class="btn bg-clear"><</button></a>
                <a href="#"><button class="btn bg-clear">1</button></a>
                <a href="#"><button class="btn bg-clear">2</button></a>
                <a href="#"><button class="btn bg-clear">3</button></a>
                <a href="#"><button class="btn bg-clear">4</button></a>
                <a href="#"><button class="btn bg-clear">5</button></a>
                <a href="#"><button class="btn bg-clear">></button></a>
            </div>
        </div>
    </div>
</div>
</template>

<script setup>
import { onBeforeMount, onMounted, ref } from 'vue';
import axios from 'axios';

const flg = ref(false);
const flgSetup = () => {
    flg.value = window.innerWidth >= 1000 ? false : true;
}
onBeforeMount(() => {
    flgSetup();
    // Axios로 API 호출
    axios.get('/api/products/list')
    .then((response) => {
        productItems.value = response.data.response.body.items.item;
        // response.data.response.body.items.item.forEach(item => {
        //     const TITLE = document.getElementById('title');
        //     TITLE.textContent = item.title;
        //     // console.log(item.title);
        // });
    })
    .catch((error) => {
        console.error(error);
    })
});
window.addEventListener('resize', flgSetup);

// API
const productItems = ref([]);

// 마운트된 후
onMounted(() => {
});
// data() {
//     return {
//         items: [], // tourAPI 데이터
//         loading: true, // 로딩 상태
//         error: null, // 에러 메시지
//     };
// }
</script>

<style scoped>
/* 전체를 감싸는 제일 큰 틀 */
/* .total-container {
    display: grid;
    grid-template-columns: 1fr 6fr;
    gap: 30px;
    padding: 0 50px;
} */

/* 작은 틀 */
.left-small-container {
    border: 1px solid #01083A;
    border-radius: 10px;
    margin: 1rem 0;
    padding: 20px;
}
.right-small-container {
    /* border: 1px solid #01083A; */
    border-radius: 10px;
    margin: 10px 0;
}

/* 리스트 아이템 */
.list-item {
    display: flex;
    gap: 10px;
    font-size: 20px;
    align-items: center;
}

/* 지도 관련 */
.map-box {
    /* height: 200px; */
    background-image: url('/default/map_example.png');
    background-position: center;
}
.map-box-title {
    margin-top: 140px;
    background-color: rgba(255, 255, 255, .7);
    text-align: center;
    /* border-radius: 10px; */
}

/* 카테고리 관련 */
.cat-box-title {
    text-align: center;
}
.cat-list {
    display: flex;
    flex-direction: column;
    /* justify-content: space-around; */
    gap: 20px;
    margin-top: 10px;
}
.cat-input {
    width: 20px;
    height: 20px;
    border: 1px solid #01083A;
    border-radius: 50%;
    appearance: none;
}
.cat-input:checked {
    background-color: #01083A;
}

/* 가격 관련 */
.pri-box-title {
    text-align: center;
}
.pri-box {
    margin-top: 20px;
}
.pri-input {
    border: 1px solid #01083A;
    border-radius: 10px;
    height: 30px;
    min-width: 100px;
    padding-left: 20px;
}
.pri-wave {
    text-align: center;
}

/* 버튼 */
.button-position {
    text-align: center;
}
.button-wide {
    min-width: 150px;
    font-size: 1.5rem;
    border-radius: 10px;
}

/* 선택 결과 관련 */
.select-result-box {
    padding: 20px;
}
.select-list {
    padding: 20px;
    display: flex;
    gap: 20px;
}
.select-list-item {
    border: 1px solid #01083A;
    border-radius: 20px;
    padding: 10px;
}

/* 정렬 순서 관련 */
.order-box {
    display: flex;
    gap: 20px;
}
.order-list {
    display: flex;
    gap: 20px;
}
.order-list-item {
    display: flex;
    align-items: center;
}
.order-list-item-update {
    color: #ff0000;
    font-size: 15px;
    margin-left: 5px;
}

/* 카드 관련 */
.card-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 15px;
    margin-top: 50px;
}
.card {
    height: 300px;
    border: 1px solid #01083A;
    border-radius: 10px;
    display: grid;
    padding: 15px;
    margin: 0 auto;
}
.card-title {
    width: 175px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: center;
}
.img-card {
    width: 200px;
    height: 185px;
    object-fit: cover;
    background-repeat: no-repeat;
    border-radius: 5px;
}

/* 페이지네이션 */
.pagination {
    /* margin: 0 auto; */
    /* text-align: center; */
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 20px;
}
.pagination button {
    font-size: 20px;
    border-radius: 50px;
    width: 40px;
    height: 40px;
    text-align: center;
}
.pagination button:hover, .pagination button:active {
    color: #fff;
    background: #01083a;
}

/* 폰트 관련 */
.font-default-size {
    font-size: 18px;
}
.font-blue {
    color: #0000ff;
}
.font-bold {
    font-weight: 900;
}

/* 기타 등등 */
.img-x { 
    width: 12px;
    height: 12px;
    margin-left: 10px;
}
.img-order { 
    width: 20px;
    height: 20px;
    margin-left: 5px;
}
/* 일단 얘는 나중에 글자 크기 조절 */
.test {
    font-size: 5px;
}

/* --------------------------------- */
/* 반응형 구현 */
/* --------------------------------- */

/* 사라짐 */
.dis-none {
    display: none;
}

/* 지도 */
.map-height {
    height: 150px;
}

/* 카테고리 */
.cat-list-change {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
}
.cat-input-change {
    width: 16px;
    height: 16px;
}
.cat-list-item-change {
    font-size: 16px;
}

/* 가격 */
.pri-box-change {
    display: flex;
    gap: 5px;
}

/* 미디어쿼리 */
@media (max-width: 1000px) {
    .total-container {
        display: flex;
        flex-direction: column;
        padding: 0;
    }
}
</style>