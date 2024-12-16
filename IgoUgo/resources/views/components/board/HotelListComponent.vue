<template>
<div class="total-container">
    <div class="left-container">
        <div class="left-small-container map-box" :class="{'map-height':flg}">
            <!-- <h2 class="map-box-title" :class="{'test':false}">지도로 보기</h2> -->
            <h2 class="map-box-title" :class="{'dis-none': flg}">지도로 보기</h2>
        </div>
        <div class="left-small-container">
            <div class="cat-list" :class="{'cat-list-change':flg}">
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="accomcountlodging" value="0">
                    <label for="accomcountlodging">수용가능인원</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="checkintime" value="1">
                    <label for="checkintime">입실시간</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="checkouttime" value="2">
                    <label for="checkouttime">퇴실시간</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="chkcooking" value="3">
                    <label for="chkcooking">객실 내 취사</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="foodplace" value="4">
                    <label for="foodplace">식음료장</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="pickup" value="5">
                    <label for="pickup">픽업서비스</label>
                </div>
                <h2 class="cat-box-title">객실수</h2>
                <h2 class="cat-box-title">객실유형</h2>
                <h2 class="cat-box-title">부대시설 (기타)</h2>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="barbecue" value="음식점">
                    <label for="barbecue">바베큐장</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="beauty" value="음식점">
                    <label for="beauty">뷰티시설</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="campfire" value="음식점">
                    <label for="campfire">캠프파이어</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="bicycle" value="음식점">
                    <label for="bicycle">자전거대여</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="fitness" value="음식점">
                    <label for="fitness">휘트니스센터</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="bicycle" value="음식점">
                    <label for="bicycle">노래방여부</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="publicbath" value="음식점">
                    <label for="publicbath">공용샤워실</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="publicpc" value="음식점">
                    <label for="publicpc">공용 PC실</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="sauna" value="음식점">
                    <label for="sauna">사우나실</label>
                </div>
                <div class="list-item" :class="{'cat-list-item-change':flg}">
                    <input class="cat-input" :class="{'cat-input-change':flg}" type="checkbox" name="category" id="sports" value="음식점">
                    <label for="sports">스포츠시설</label>
                </div>
            </div>
        </div>
        <!-- <div class="left-small-container">
            <h2 class="pri-box-title">가격</h2>
            <div class="pri-box" :class="{'pri-box-change':flg}">
                <input type="number" class="pri-input" max="300000000">
                <div class="pri-wave">
                    <h3>~</h3>
                </div>
                <input type="number" class="pri-input" max="300000000">
            </div>
        </div>
        <div class="button-position">
            <button class="btn bg-navy button-wide">적용</button>
        </div> -->
    </div>

    <div>
        <div class="right-small-container select-result-box">
            <h2><span class="font-blue">200</span> 개의 결과</h2>
            <div class="select-list font-default-size" :class="{'dis-none':flg}">
                <div class="select-list-item">
                    선택사항1
                    <img src="img_product/img_x.png" class="img-x">
                </div>
                <div class="select-list-item">
                    선택사항2
                    <img src="img_product/img_x.png" class="img-x">
                </div>
                <div class="select-list-item">
                    선택사항3
                    <img src="img_product/img_x.png" class="img-x">
                </div>
                <div class="select-list-item">
                    전체 해제
                    <img src="img_product/img_x.png" class="img-x">
                </div>
            </div>
        </div>
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
        <!-- <div class="right-small-container order-box font-default-size">
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
        </div> -->
        <div class="right-small-container">
            <div  v-if="publicData.length > 0" class="card-list">
                <div v-for="item in publicData" :key="item" class="card">
                    <img :src="item.firstimage" @error="setDefaultImage" class="img-card">
                    <p class="font-bold card-title">{{ item.title }}</p>
                    <p>₩ 30,000</p>
                </div>
            </div>
            <p class="loding-msg" v-else>호텔정보를 불러오는중...</p>

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
});
window.addEventListener('resize', flgSetup);

// 이미지 없을때 나오는 사진
const setDefaultImage = (event) => {
  event.target.src = '/default/board_default.png';
}

// API 받아온거 axios로 불러오기기
const publicData = ref([]);

onMounted(async() => {
    try {
        const response = await axios.get('http://localhost:8000/api/hotels');
        publicData.value = response.data.response.body.items.item;
    } catch (error) {
        console.error(error);
    }
});


</script>

<style scoped>
/* 전체를 감싸는 제일 큰 틀 */
.total-container {
    display: grid;
    grid-template-columns: 1fr 6fr;
    gap: 30px;
    padding: 0 50px;
}

/* 작은 틀 */
.right-small-container {
    /* border: 1px solid #01083A; */
    border-radius: 10px;
    margin: 10px 0;
}
.left-small-container {
    border: 1px solid #01083A;
    border-radius: 10px;
    margin: 1rem 0;
    padding: 20px;
    min-width: 200px;
    overflow-y: auto;
    box-sizing: border-box;
    clip-path: inset(0 round 11px); 
}

/* 스크롤바 커스텀 */
.left-small-container::-webkit-scrollbar {
    width: 7px;
    display: contents;
}
.left-small-container::-webkit-scrollbar-thumb {
    background-color: #e6e6e6;
    border-radius: 3.5px;
}
.left-small-container::-webkit-scrollbar-track {
    background-color: #fff;
    margin: 10px;
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
    height: 545px;
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
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
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
    /* min-width: 100px;
    min-height: 100px; */
    width: 175px;
    height: 185px;
    object-fit: cover;
    background-repeat: no-repeat;
    border-radius: 5px;
}
.lodingmsg {
    margin-top: 50px;
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