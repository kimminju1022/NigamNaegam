<template>
    <h1 class="title">검색 결과</h1>
    <div class="search-sort-btn">
        <button class="btn"><a href="#hotel">호텔</a></button>
        <button class="btn"><a href="#product">즐길거리</a></button>
        <button class="btn"><a href="#board">게시판</a></button>
        <button class="btn"><a href="#tester">체험단 신청</a></button>
    </div>
    <div class="search">
        <div class="search-box">
            <h1 id="hotel">호텔</h1>
            <p><span>{{ $store.state.search.searchHotelList.length }}</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <!-- <p></p> -->
                    <p>지역</p>
                    <p></p>
                    <p>제목</p>
                    <p></p>
                </div>
                <div v-for="(item, index) in $store.state.search.searchHotelList" :key="item" class="search-content">
                    <p>{{ index+1 }}</p>
                    <p v-if="item.area !== null">{{ item.area.area_name }}</p>
                    <p v-else></p>
                    <!-- <p></p> -->
                    <p></p>
                    <router-link :to="`/hotels/${item.contentid}`">{{ item.title }}</router-link>
                    <p></p>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <PaginationComponent :actionName="actionName" :searchData="searchData" />
    </div>
    <div class="search">
        <div class="search-box">
            <h1 id="product">즐길거리</h1>
            <p><span>{{ $store.state.search.searchProductList.length }}</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>지역</p>
                    <p>카테고리</p>
                    <p>제목 </p>
                    <p></p>
                </div>
                <div v-for="(item, index) in $store.state.search.searchProductList" :key="item" class="search-content">
                    <p>{{ index+1 }}</p>
                    <p v-if="item.area !== null">{{ item.area.area_name }}</p>
                    <p v-else></p>
                    <p>{{ item.area.area_name }}</p>
                    <router-link :to="`/products/${item.contenttypeid}/${item.contentid}`">{{ item.title }}</router-link>
                    <p></p>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <!-- <PaginationComponent :actionName="actionName" :searchData="searchData" /> -->
    </div>

    <div class="search">
        <div class="search-box">
            <h1 id="board">게시판</h1>
            <p><span>{{ $store.state.search.searchBoardList.length }}</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>분류</p>
                    <p>카테고리</p>
                    <p>제목 </p>
                    <p>작성일자</p>
                </div>
                <div v-for="(item, index) in $store.state.search.searchBoardList" :key="item" class="search-content">
                    <p>{{ index+1 }}</p>
                    <p>{{ item.board_category.bc_name }}</p>
                    <p>호텔</p>
                    <p>{{ item.board_title }}</p>
                    <p>{{ item.created_at }}</p>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <!-- <PaginationComponent :actionName="actionName" :searchData="searchData" /> -->
    </div>

    <div class="search">
        <div class="search-box">
            <h1 id="tester">체험단 신청</h1>
            <p><span>{{ $store.state.search.searchTesterList.length }}</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>몰라</p>
                    <p>카테고리</p>
                    <p>제목 </p>
                    <p>마감일자</p>
                </div>
                <div v-for="(item, index) in $store.state.search.searchBoardList" :key="item" class="search-content">
                    <p>{{ index+1 }}</p>
                    <p>몰라</p>
                    <p>{{ item.board_category.bc_name }}</p>
                    <p>{{ item.board_title }}</p>
                    <p>{{ item.created_at }}</p>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <!-- <PaginationComponent :actionName="actionName" :searchData="searchData" /> -->
    </div>
</template>
<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
import PaginationComponent from './PaginationComponent.vue';

const store = useStore();
const route = useRoute();

const actionName = 'search/searchHotel';
const actionName2 = 'search/searchProduct';
const actionName3 = 'search/searchBoard';
const actionName4 = 'search/searchTester';

// const searchList = computed(()=> store.state.search.searchHotel);

const searchData = reactive({
    search: route.params.search,
    page: store.state.pagination.currentPage,
});

// console.log('searchData :', searchData);

// onBeforeMount( () => {
//     store.dispatch(actionName1, searchData);
//     store.dispatch(actionName2, searchData);
//     store.dispatch(actionName3, searchData);
//     store.dispatch(actionName4, searchData);
// });

// onBeforeMount(async () => {
//     await store.dispatch(actionName1, searchData);
//     await store.dispatch(actionName2, searchData);
//     await store.dispatch(actionName3, searchData);
//     await store.dispatch(actionName4, searchData);
// });
</script>
<style scoped>
.title {
    font-size: 25px;
}

.search-sort-btn {
    display: grid;
    grid-template-columns: repeat(4, 100px);
    justify-content: center;
    gap: 10px;
    margin: 30px 0;
}

.search-sort-btn button {
    width: 100px;
    height: 50px;
    border-radius: 25px;
}

/* .search {
    margin-bottom: 50px;
} */

#hotel, #product, #board, #tester {
    scroll-margin-top: 200px;  /* header 높이만큼 여백을 추가 */
}

.search-box h1{
    margin: 40px 0;
    /* font-size: 30px; */
    color: #01083a;
}

.search-box > p {
    font-size: 22px;
    margin-bottom: 20px;
    margin-left: 20px;
}

.search-box > p span {
    color: red;
    font-weight: 600;
}

.sort {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}

.search-content-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    max-width: 1250px;
    min-width: 500px;
    margin-bottom: 30px;
}

.search-title {
    display: grid;
    /* grid-template-columns: 0.5fr 1fr 2fr 8fr 1fr; */
    grid-template-columns: 0.5fr 0.7fr 1fr 8fr 1fr;
    text-align: center;
    padding: 10px;
    font-weight: 600;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}

.search-content {
    display: grid;
    /* grid-template-columns: 0.5fr 1fr 2fr 8fr 1fr; */
    grid-template-columns: 0.5fr 0.7fr 1fr 8fr 1fr;
    text-align: center;
    padding: 10px;
}

.question-content :nth-child(3) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
}

.text {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    word-break: break-all;
}
</style>