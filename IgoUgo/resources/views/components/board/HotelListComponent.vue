<template>
    <div class="total-container"> 
        <div>
            <div class="category-name">
                <span class="name-hotel">호텔</span>
            </div>
            <div class="right-small-container select-result-box">
                <h2><span class="font-blue">200</span> 개의 결과</h2>
                <div class="select-list font-default-size" :class="{'dis-none':flg}">
                    <div v-for="filter in selectedFilters" :key="filter.value" class="select-list-item">
                        <p>{{ filter.name }}</p>
                        <img src="img_product/img_x.png" class="img-x">
                    </div>
                </div>
            </div>
            <div class="order-box font-default-size">
                
                <div class="order-box-first">
                    <div>
                        <span class="font-bold">정렬 순서</span>
                    </div>
                    <p>|</p>
                    <div class="order-list-item">
                        <p>에디터 추천</p>
                        <img src="img_product/img_star.png" class="img-order">
                    </div>
                    <p>|</p>
                    <div class="order-list-item">
                        <p>최신순</p>
                        <span class="order-list-item-update font-bold">NEW</span>
                    </div>
                    <p>|</p>
                    <div class="order-list-item">
                        <p>별점순</p>
                        <img src="img_product/img_thumb.png" class="img-order">
                    </div>
                </div>
                <div class="order-box-last">
                    <div @click="isVisible = true" class="order-list-item">
                        <p class >필터</p>
                        <img src="img_product/img_filter.png" class="img-order">
                    </div>
                    <p>|</p>
                    <div class="order-list-item">
                        <img src="img_product/img_placeholder.png" class="img-map">
                        <p>지도 보기</p>
                    </div>
                </div>
            </div>
            <div>
                <!-- <div v-else-if="error">{{ error }}</div> -->
                <div v-if="hotels.length > 0" class="card-list">
                    <div v-for="item in hotels" :key="item" class="card">
                        <img :src="item.firstimage" @error="e => e.target.src='default/board_default.png'" class="img-card">
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

    <!-- 모달모달 -->
    <div v-if="isVisible" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-x-button">
                <img @click="isVisible = false" class="modal_x_img" src="/img_product/img_x.png" alt="">
            </div>
            <p class="modal-region-text1 font-bold">지역</p>

            <div class="modal-region">
                <div>
                    <input value="seoul" @change="updateFilters('seoul', $event)" class="modal-input" type="checkbox" id="seoul">
                    <label for="seoul">서울</label>
                </div>

                <div>
                    <input value="Incheon" @change="updateFilters('Incheon', $event)" class="modal-input" type="checkbox" id="Incheon">
                    <label for="Incheon">인천</label>
                </div>

                <div>
                    <input value="daejeon" @change="updateFilters('daejeon', $event)" class="modal-input" type="checkbox" id="daejeon">
                    <label for="daejeon">대전</label>
                </div>

                <div>
                    <input value="daegu" @change="updateFilters('daegu', $event)" class="modal-input" type="checkbox" id="daegu">
                    <label for="daegu">대구</label>
                </div>

                <div>
                    <input value="gwangju" @change="updateFilters('gwangju', $event)" class="modal-input" type="checkbox" id="gwangju">
                    <label for="gwangju">광주</label>
                </div>

                <div>
                    <input value="부산" @change="updateFilters('busan', $event)" class="modal-input" type="checkbox" id="busan">
                    <label for="busan">부산</label>
                </div>

                <div>
                    <input value="ulsan" @change="updateFilters('ulsan', $event)" class="modal-input" type="checkbox" id="ulsan">
                    <label for="ulsan">울산</label>
                </div>

                <div>
                    <input value="Sejong" @change="updateFilters('Sejong', $event)" class="modal-input" type="checkbox" id="Sejong">
                    <label for="Sejong">세종</label>
                </div>

                <div>
                    <input value="gyeonggido" @change="updateFilters('gyeonggido', $event)" class="modal-input" type="checkbox" id="gyeonggido">
                    <label for="gyeonggido">경기도</label>
                </div>

                <div>
                    <input value="gangwondo" @change="updateFilters('gangwondo', $event)" class="modal-input" type="checkbox" id="gangwondo">
                    <label for="gangwondo">강원도</label>
                </div>

                <div>
                    <input value="chungcheongbugdo" @change="updateFilters('chungcheongbugdo', $event)" class="modal-input" type="checkbox" id="chungcheongbugdo">
                    <label for="chungcheongbugdo">충청북도</label>
                </div>
                
                <div>
                    <input value="chungcheongnamdo" @change="updateFilters('chungcheongnamdo', $event)" class="modal-input" type="checkbox" id="chungcheongnamdo">
                    <label for="chungcheongnamdo">충청남도</label>
                </div>

                <div>
                    <input value="gyeongsangbugdo" @change="updateFilters('gyeongsangbugdo', $event)" class="modal-input" type="checkbox" id="gyeongsangbugdo">
                    <label for="gyeongsangbugdo">경상북도</label>
                </div>

                <div>
                    <input value="gyeongsangnamdo" @change="updateFilters('gyeongsangnamdo', $event)" class="modal-input" type="checkbox" id="gyeongsangnamdo">
                    <label for="gyeongsangnamdo">경상남도</label>
                </div>

                <div>
                    <input value="jeonlabugdo" @change="updateFilters('jeonlabugdo', $event)" class="modal-input" type="checkbox" id="jeonlabugdo">
                    <label for="jeonlabugdo">전라북도</label>
                </div>

                <div>
                    <input value="jeonlanamdo" @change="updateFilters('jeonlanamdo', $event)" class="modal-input" type="checkbox" id="jeonlanamdo">
                    <label for="jeonlanamdo">전라남도</label>
                </div>

                <div>
                    <input value="jejudo" @change="updateFilters('jejudo', $event)" class="modal-input" type="checkbox" id="jejudo">
                    <label for="jeju">제주도</label>
                </div>
            </div>

            <p class="modal-region-text2 font-bold">카테고리</p>
            <div class="modal-region">
                <div>
                    <input class="modal-input" type="checkbox" id="pool">
                    <label for="pool">수영장</label>
                </div>
                <div>
                    <input class="modal-input" type="checkbox" id="grill">
                    <label for="grill">바베큐장</label>
                </div>
                <div>
                    <input class="modal-input" type="checkbox" id="fire">
                    <label for="fire">캠프파이어</label>
                </div>
                <div>
                    <input class="modal-input" type="checkbox" id="beauty">
                    <label for="beauty">뷰티시설</label>
                </div>
                <div>
                    <input class="modal-input" type="checkbox" id="fitness">
                    <label for="fitness">피트니스</label>
                </div>
                <div>
                    <input class="modal-input" type="checkbox" id="pickup">
                    <label for="pickup">픽업서비스</label>
                </div>
            </div>

        </div>
    </div>
</template>
    
<script setup>
    import { onBeforeMount, onMounted, ref } from 'vue';
    import axios from 'axios';

    // 카테카테고리고리
    const selectedFilters = ref([]);

    function updateFilters(filter, event) {
        if (event.target.checked) {
            selectedFilters.value.push({name: filter, value: filter});
        } else {
            selectedFilters.value = selectedFilters.value.filter(
                (item) => item.value !== filter
            );
        }
    }


    // 모달모달
    const isVisible = ref(false);

    // 반응형
    const flg = ref(false);
    const flgSetup = () => {
        flg.value = window.innerWidth >= 1000 ? false : true;
    }
    onBeforeMount(() => {
        flgSetup();
    });
    window.addEventListener('resize', flgSetup);
    
    // API
    const hotels = ref([]);
    
    // 마운트된 후
    onMounted(async() => {
        try {
            const response = await axios.get('/api/hotels');
            // console.log(response.data);
            hotels.value = response.data
        } catch (error) {
            console.error(error);
        }
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
    .name-hotel {
        font-size: 50px;
    }
    .category-name {
        padding-bottom: 10px;
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
        justify-content: space-between;
    }
    /* .order-list {
        display: flex;
        gap: 20px;
    } */
    .order-box-first {
        display: flex;
        gap: 20px;
    }
    .order-box-last {
        display: flex;
        gap: 20px;
    }
    .order-list-item {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    .order-list-item-update {
        color: #ff0000;
        font-size: 15px;
        margin-left: 5px;
    }
    
    /* 카드 관련 */
    .card-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        column-gap: 15px;
        row-gap: 40px;
        margin-top: 40px;
    }
    .card {
        height: 250px;
        width: 300px;
        border: 1px solid #e9e9e9;
        border-radius: 10px;
        display: grid;
        grid-template-rows: 185px 65px;
        margin: 0 auto;
        justify-items: center;
        /* 호버효과 css */
        position: relative;
        transition: 0.2s ease-in-out;
        /* flex: 1; */
    }
    /* 카드호버 */
    .card:hover {
        transform: translateY(-10px);
        cursor: pointer;
        box-shadow: 1px 1px 20px #ddd;
    }
    .card-title {
        width: 80%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: center;
        align-self: center;
    }
    .img-card {
        width: 100%;
        height: 185px;
        object-fit: cover;
        background-repeat: no-repeat;
        border-radius: 5px 5px 0px 0px;
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
    .img-map {
        width: 20px;
        height: 20px;
        margin-right: 5px;
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

    /* 모달모달 */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2;
    }
    .modal-content {
        width: 450px;
        background-color: white;
        padding: 20px 30px 40px 30px;
        border-radius: 10px;
    }
    .modal-region-text1 {
        font-size: 20px;
        padding-bottom: 30px;
    }
    .modal-region-text2 {
        font-size: 20px;
        padding: 30px 0;
    }
    .modal-region {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        row-gap: 15px;
    }
    .modal-input {
        margin-right: 5px;
    }
    .modal-x-button {
        display: flex;
        justify-content: flex-end;
    }
    .modal_x_img {
        width: 20px;
        height: 20px;
        cursor: pointer;
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