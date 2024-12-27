<template>
    <div class="total-container"> 
        <div>
            <div class="category-name">
                <span class="content-title">{{ productTitle }}</span>
            </div>
            <div class="right-small-container select-result-box">
                <h2><span class="font-blue">{{ productsCnt }}</span> 개의 결과</h2>
                <div class="select-list font-default-size" :class="{'dis-none':flg}">
                    <div v-for="code in searchData.area_code" :key="code" class="select-list-item">
                        <p>{{ getAreaNameWithAreaCode(code) }}</p>
                        <img src="/img_product/img_x.png" @click="closeFilter(code)" class="img-x">
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
                        <img src="/img_product/img_star.png" class="img-order">
                    </div>
                    <p>|</p>
                    <div class="order-list-item">
                        <p>최신순</p>
                        <span class="order-list-item-update font-bold">NEW</span>
                    </div>
                    <p>|</p>
                    <div class="order-list-item">
                        <p>별점순</p>
                        <img src="/img_product/img_thumb.png" class="img-order">
                    </div>
                </div>
                <div class="order-box-last">
                    <div @click="openmodal" class="order-list-item">
                        <p class >필터</p>
                        <img src="/img_product/img_filter.png" class="img-order">
                    </div>
                    <p>|</p>
                    <div class="order-list-item">
                        <img src="/img_product/img_placeholder.png" class="img-map">
                        <p>지도 보기</p>
                    </div>
                </div>
            </div>
            <div>
                <!-- <div v-else-if="error">{{ error }}</div> -->
                <div class="card-list">
                    <div v-for="item in products" :key="item" class="card">
                        <img :src="item.firstimage" @error="e => e.target.src='default/board_default.png'" class="img-card">
                        <p class="font-bold card-title">{{ item.title }}</p>
                    </div>
                </div>
                <!-- <div v-else>상품 데이터를 불러오는 중...</div> -->

                <!-- 페이지네이션 -->
                <PaginationComponent :actionName="actionName" :searchData="searchData" />
            </div>
        </div>
    </div> 

    <!-- 모달모달 -->
    <div v-if="isVisible" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-x-button">
                <img @click="closemodal" class="modal_x_img" src="/img_product/img_x.png" alt="">
            </div>
            <p class="modal-region-text1 font-bold">지역</p>

            <div class="modal-region">
                <div v-for="item in $store.state.product.productArea" :key="item">
                    <input v-model="searchData.area_code" :value="item.area_code" @change="updateFilters()" class="modal-input" type="checkbox" :id="'input-' + item.area_code">
                    <label :for="'input-' + item.area_code">{{ item.area_name }}</label>
                </div>
            </div>
        </div>
    </div>
</template>
    
<script setup>
import { computed, onBeforeMount, reactive, ref} from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
import PaginationComponent from '../PaginationComponent.vue';

const store = useStore();
const route = useRoute();
// const conttentTypeId = route.params.contenttypeid; // url의 conttenttypeid 가져오기

// id에 따른 타이틀명 - 객체
const productIdList = {
    12: '관광지',
    14: '문화시설',
    28: '레포츠',
    38: '쇼핑',
    39: '음식점',
};

// 상품 리스트 타이틀
const productTitle = ref('');

// 상품 리스트 관련
const products = computed(() => store.state.product.productList);
const productsCnt = computed(() => store.state.product.productCnt);
const actionName = 'product/getProductsPagination';

// 필터 관련
const searchData = reactive({
    page: store.state.pagination.currentPage,
    contentTypeId: route.params.contenttypeid,
    area_code: [],
});

// const areaData = computed(() => store.state.hotel.hotelArea);

// 반응형
const flg = ref(false);
const flgSetup = () => {
    flg.value = window.innerWidth >= 1000 ? false : true;
}
onBeforeMount(async () => {
    // 타이틀
    productTitle.value = productIdList[route.params.contenttypeid];

    flgSetup(); // 리사이즈 이벤트
    await store.dispatch(actionName, searchData);
    await store.dispatch('product/getProductsArea', searchData);
    // console.log('에리아데이터', areaData);
});

window.addEventListener('resize', flgSetup);

function getAreaNameWithAreaCode(code) {
    const areaList = store.state.product.productArea.filter((item) => item.area_code === code);
    return areaList[0].area_name;
}

    
// 카테카테고리고리
const selectedFilters = ref(JSON.parse(localStorage.getItem('selectedFilters')) || []);

function updateFilters() {
    // console.log(searchData.area_code);
    store.dispatch(actionName, searchData);
}

function closeFilter(value) {
    // console.log(serchData.area_code);
    searchData.area_code = searchData.area_code.filter(
        (item) => item !== value
    );
    store.dispatch('product/getProductsPagination', searchData);
    // localStorage.setItem('selectedFilters', JSON.stringify(selectedFilters.value));
}

// window.onbeforeunload = function() {
//     // localStorage.clear();
// };

// 모달모달
const isVisible = ref(false);

function openmodal() {
    isVisible.value = true;
}
    
function closemodal() {
    isVisible.value = false;
}

// 컨트롤러로 데이터 전송하는법?
// const category = ref([
//     { id: 1, name: '서울' },
// ]);

// async function applyFilters() { 
//     try {
//         await axios.get('/api/filters', {
//         filters: selectedFilters.value
//         });
//     } catch {
//         console.error(error);
//     }
// }



// ----------------------------------------------------------------------------    
// // 마운트된 후
// onMounted(async() => {
//     await loadHotels()
//     // console.log(hotels)
// });

// // 호텔 불러오기
// const hotels = ref([]);
// let current_page = ref(1)

// async function loadHotels() {
//     try {
//         const response = await axios.get(`/api/hotels?page=${current_page.value}`);
//         // console.log(response.data.data);
//         hotels.value = response.data.data
//     } catch (error) {
//         console.error(error);
//     }
// }

// // 페이지네이션

// // 페이지 버튼 계산
// // function maxPage() {
// //     loadHotels();
// //     console.log(hotels.value.per_page);
// //     return hotels.value.per_page;
// // }


// const pages = computed(() => {
//     // maxPage()
//     const totalPages = 46;
//     const pageCount = 5;
//     const startPage = Math.max(current_page.value - Math.floor(pageCount / 2), 1);
//     // 만약 current_page.value가 5면? 5 빼기 5/2=2(나머지버림)  3이나오니까 max에서 3이반환됨됨
//     const endPage = Math.min(startPage + pageCount - 1, totalPages);
//     // 3이 반환되서 5랑 더하면 8이됨 8이 나오니까 8-1 해서 min에서 7이 반환됨
//     const adjustedStartPage = Math.max(endPage - pageCount + 1, 1);
//     // 7-3+1 해서 5이된다 
    
//     return Array.from({ length: Math.min(pageCount, totalPages) }, (_, i) => adjustedStartPage + i)
//     // Array에서 i를쓰면 0에서 부터 반복됨
//     // 7-3에 +1 이니까 5가출력됨 5개의 공간을가진 배열이 만들어지고 5 i는 1씩상승하고 i가 증가할 때마다 startPage 값에 더해지는 구조
//     // 3이니까 3+0 은 3 3+1은 4... 해서 배열에 3 4 5 6 7 결국 현제페이지인 5가 가운데 오도록 작동
// });

// // 페이지 변경
// function changePage(page) {
//     // maxPage()
//     const totalPages = hotels.value.per_page;
//     if (page < 1 || page > totalPages) {
//         return 
//         // page가 1이하거나 46이상이면 작동안하고 리턴시켜버려서 함수를 나가버리기기
//     }
//     current_page.value = page;
//     loadHotels()
// }
</script>
    
<style scoped>
    .content-title {
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
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
        display: flex;
        gap: 20px;
    }
    .select-list-item {
        display: flex;
        justify-content: space-between;
        max-width: 170px;
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
        align-self: center;
        cursor: pointer;
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
        width: 500px;
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
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
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