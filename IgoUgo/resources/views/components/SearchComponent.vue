<template>
    <h1 class="title">검색 결과</h1>
    <div class="search-sort-btn">
        <a href="#hotel">호텔</a>
        <a href="#product">즐길거리</a>
        <a href="#board">게시판</a>
        <a href="#tester">체험단 신청</a>
    </div>
    <div class="search">
        <div class="search-box">
            <h1 id="hotel">호텔</h1>
            <p><span>{{ $store.state.search.searchHotelCnt }}</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>지역</p>
                    <p></p>
                    <p>제목</p>
                    <p></p>
                    <p></p>
                </div>
                <div v-if="$store.state.search.searchHotelCnt === 0" class="no-data">
                    <p class="no-data">검색 결과 없음</p>
                </div>
                <div v-else>
                    <div v-for="(item, index) in $store.state.search.searchHotelList" :key="item" class="search-content">
                        <p>{{ index+1 }}</p>
                        <p class="area_name">{{ item.area.area_name }}</p>
                        <p></p>
                        <router-link :to="`/hotels/${item.contentid}`" class="title">{{ item.title }}</router-link>
                        <p></p>
                        <p></p>
                    </div>
                </div>
                <!-- <div v-for="(item, index) in $store.state.search.searchHotelList" :key="item" class="search-content">
                    <p>{{ index+1 }}</p>
                    <p>{{ item.area.area_name }}</p>
                    <p></p>
                    <router-link :to="`/hotels/${item.contentid}`" class="title">{{ item.title }}</router-link>
                    <p></p>
                </div> -->
            </div>
        </div>

        <!-- 페이지네이션 -->
        <PaginationComponent
            :actionName="actionName1"
            :searchData="searchData1"
            :currentPage="$store.state.pagination.hotelCurrentPage"
            :lastPage="$store.state.pagination.hotelLastPage"
            :viewPageNumber="$store.state.pagination.hotelViewPageNumber"
        />
    </div>

    <div class="search">
        <div class="search-box">
            <h1 id="product">즐길거리</h1>
            <p><span>{{ $store.state.search.searchProductCnt }}</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>지역</p>
                    <p>카테고리</p>
                    <p>제목</p>
                    <p></p>
                    <p></p>
                </div>
                <div v-if="$store.state.search.searchProductCnt === 0" class="no-data">
                    <p class="no-data">검색 결과 없음</p>
                </div>
                <div v-else>
                    <div v-for="(item, index) in $store.state.search.searchProductList" :key="item" class="search-content">
                        <p>{{ index+1 }}</p>
                        <p class="area_name">{{ item.area.area_name }}</p>
                        <p v-if="item.contenttypeid === '12'">관광지</p>
                        <p v-else-if="item.contenttypeid === '14'">문화시설</p>
                        <p v-else-if="item.contenttypeid === '28'">레포츠</p>
                        <p v-else-if="item.contenttypeid === '38'">쇼핑</p>
                        <p v-else="item.contenttypeid === '39'">음식점</p>
                        <router-link :to="`/products/${item.contenttypeid}/${item.contentid}`" class="title">{{ item.title }}</router-link>
                        <p></p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <PaginationComponent
                :actionName="actionName2"
                :searchData="searchData2"
                :currentPage="$store.state.pagination.productCurrentPage"
                :lastPage="$store.state.pagination.productLastPage"
                :viewPageNumber="$store.state.pagination.productViewPageNumber"
        />
    </div>

    <div class="search">
        <div class="search-box">
            <h1 id="board">게시판</h1>
            <p><span>{{ $store.state.search.searchBoardCnt }}</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>분류</p>
                    <p>카테고리</p>
                    <p>제목</p>
                    <p></p>
                    <p>작성일자</p>
                </div>
                <div v-if="$store.state.search.searchBoardCnt === 0" class="no-data">
                    <p class="no-data">검색 결과 없음</p>
                </div>
                <div v-else>
                    <div v-for="(item, index) in $store.state.search.searchBoardList" :key="item" class="search-content">
                        <p>{{ index+1 }}</p>
                        <p class="area_name">{{ item.board_category.bc_name }}</p>
                        <!-- <p></p> -->
                        <p v-if="item.product.contenttypeid === '12'">관광지</p>
                        <p v-else-if="item.product.contenttypeid === '14'">문화시설</p>
                        <p v-else-if="item.product.contenttypeid === '28'">레포츠</p>
                        <p v-else-if="item.product.contenttypeid === '32'">호텔</p>
                        <p v-else-if="item.product.contenttypeid === '38'">쇼핑</p>
                        <p v-else="item.product.contenttypeid === '39'">음식점</p>
                        <router-link :to="`/boards/${item.board_id}`" class="title">{{ item.board_title }}</router-link>
                        <p></p>
                        <p>{{ item.created_at }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <PaginationComponent
                :actionName="actionName3"
                :searchData="searchData3"
                :currentPage="$store.state.pagination.boardCurrentPage"
                :lastPage="$store.state.pagination.boardLastPage"
                :viewPageNumber="$store.state.pagination.boardViewPageNumber"
        />
    </div>

    <div class="search">
        <div class="search-box">
            <h1 id="tester">체험단 신청</h1>
            <p><span>{{ $store.state.search.searchTesterCnt }}</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>몰라</p>
                    <p>카테고리</p>
                    <p>제목</p>
                    <p></p>
                    <p>마감일자</p>
                </div>
                <div v-if="$store.state.search.searchTesterCnt === 0" class="no-data">
                    <p class="no-data">검색 결과 없음</p>
                </div>
                <div v-else>
                    <div v-for="(item, index) in $store.state.search.searchTesterList" :key="item" class="search-content">
                        <p>{{ index+1 }}</p>
                        <p class="area_name">몰라</p>
                        <p>{{ item.board_category.bc_name }}</p>
                        <router-link :to="`/boards/${item.board_id}`" class="title">{{ item.board_title }}</router-link>
                        <p></p>
                        <p>{{ item.created_at }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <PaginationComponent
            :actionName="actionName4"
            :searchData="searchData4"
            :currentPage="$store.state.pagination.testerCurrentPage"
            :lastPage="$store.state.pagination.testerLastPage"
            :viewPageNumber="$store.state.pagination.testerViewPageNumber"
        />    
    </div>
</template>
<script setup>
import { onBeforeMount, reactive, watch } from 'vue';
import { useStore } from 'vuex';
// import { useRoute } from 'vue-router';
import PaginationComponent from './PaginationComponent.vue';

const store = useStore();
// const route = useRoute();

const actionName1 = 'search/searchHotel';
const actionName2 = 'search/searchProduct';
const actionName3 = 'search/searchBoard';
const actionName4 = 'search/searchTester';

const searchData1 = reactive({
    search: store.state.search.searchKeyword,
    page: store.state.pagination.hotelCurrentPage,
});
const searchData2 = reactive({
    search: store.state.search.searchKeyword,
    page: store.state.pagination.productCurrentPage,
});
const searchData3 = reactive({
    search: store.state.search.searchKeyword,
    page: store.state.pagination.boardCurrentPage,
});
const searchData4 = reactive({
    search: store.state.search.searchKeyword,
    page: store.state.pagination.testerCurrentPage,
});

// console.log('searchData :', searchData);

onBeforeMount(() => {
    store.dispatch(actionName1, searchData1);
    store.dispatch(actionName2, searchData2);
    store.dispatch(actionName3, searchData3);
    store.dispatch(actionName4, searchData4);
});

watch(() => store.state.search.searchKeyword, newKeyword => {
    searchData1.search = newKeyword;
    searchData2.search = newKeyword;
    searchData3.search = newKeyword;
    searchData4.search = newKeyword;
    store.dispatch(actionName1, searchData1);
    store.dispatch(actionName2, searchData2);
    store.dispatch(actionName3, searchData3);
    store.dispatch(actionName4, searchData4);
});
</script>
<style scoped>
.title {
    font-size: 25px;
}

.search-sort-btn {
    display: grid;
    grid-template-columns: repeat(4, 130px);
    justify-content: center;
    gap: 30px;
    margin: 20px 0;
}

.search-sort-btn a {
    width: 130px;
    height: 50px;
    border-radius: 15px;
    font-size: 18px;
    text-align: center;
    line-height: 50px;
    color: #01083a;
    background-color: #ebebeb;
}

.search-sort-btn a:hover {
    transform: translateY(-3px);
    box-shadow: 2px 2px 10px #b3b3b3;
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
    /* border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a; */
    border-top: 2px solid #c2c2c2;
    border-bottom: 2px solid #c2c2c2;
    max-width: 1300px;
    min-width: 500px;
    margin-bottom: 30px;
}

.search-title {
    display: grid;
    /* grid-template-columns: 0.5fr 1fr 2fr 8fr 1fr; */
    /* grid-template-columns: 0.5fr 1.1fr 1fr 7fr 1.1fr; */
    grid-template-columns: 1fr 1fr 2fr 15fr 1.5fr 2.5fr;
    text-align: center;
    padding: 10px;
    font-weight: 600;
    font-size: 18px;
    border-bottom: 1px solid #c2c2c2;
}

.search-content {
    display: grid;
    /* grid-template-columns: 0.5fr 1fr 2fr 8fr 1fr; */
    grid-template-columns: 1fr 1fr 2fr 15fr 1.5fr 2.5fr;
    text-align: center;
    padding: 10px;
}

.search-content a {
    font-size: 17px;
}

.no-data {
    margin: 10px auto;
    font-size: 18px;
    width: 110px;
}

/* 
.question-content :nth-child(3) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
} */

.title {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
    word-break: break-all;
    padding: 0 10px;
}

.area_name {
    width: 40px;
    height: 19px;
    overflow: hidden;
    margin: 0 auto;
}
</style>