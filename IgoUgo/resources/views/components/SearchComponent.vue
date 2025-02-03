<template>
    <h1 class="title">검색 결과</h1>
    <div class="search">
        <div class="search-box">
            <h1>호텔</h1>
            <p><span>20</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>지역</p>
                    <p>몰라</p>
                    <p>제목</p>
                    <p></p>
                </div>
                <!-- <div v-for="item in searchList" :key="item" class="search-content">
                    <p>{{ item.hotel.data.title }}</p>
                    <p>{{ item.hotel.data.area_code }}</p>
                    <p>{{ item.hotel.data.title }}</p>
                    <p>{{ item.hotel.data.title }}</p>
                    <p></p>
                </div> -->
                <div class="search-content">
                    <p>번호</p>
                    <p>지역</p>
                    <p>몰라</p>
                    <p>제목</p>
                    <p></p>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <PaginationComponent :actionName="actionName" :searchData="searchData" />
    </div>
    <div class="search">
        <div class="search-box">
            <h1>즐길거리</h1>
            <p><span>20</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>지역</p>
                    <p>카테고리</p>
                    <p>제목 </p>
                    <p></p>
                </div>
                <div class="search-content">
                    <p>번호</p>
                    <p>지역</p>
                    <p>맛집</p>
                    <p>제목 </p>
                    <p></p>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <PaginationComponent :actionName="actionName" :searchData="searchData" />
    </div>

    <div class="search">
        <div class="search-box">
            <h1>게시판</h1>
            <p><span>20</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>분류</p>
                    <p>카테고리</p>
                    <p>제목 </p>
                    <p>작성일자</p>
                </div>
                <div class="search-content">
                    <p>번호</p>
                    <p>리뷰</p>
                    <p>호텔</p>
                    <p>제목 </p>
                    <p>2024-01-01</p>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <PaginationComponent :actionName="actionName" :searchData="searchData" />
    </div>

    <div class="search">
        <div class="search-box">
            <h1>체험단</h1>
            <p><span>20</span>개의 결과</p>
            <div class="search-content-box">
                <div class="search-title">
                    <p>번호</p>
                    <p>지역</p>
                    <p>카테고리</p>
                    <p>제목 </p>
                    <p>마감일자</p>
                </div>
                <div class="search-content">
                    <p>번호</p>
                    <p>지역</p>
                    <p>호텔</p>
                    <p>제목 </p>
                    <p>2024-01-01</p>
                </div>
            </div>
        </div>

        <!-- 페이지네이션 -->
        <PaginationComponent :actionName="actionName" :searchData="searchData" />
    </div>
</template>
<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
import PaginationComponent from './PaginationComponent.vue';

const store = useStore();
const route = useRoute();

const actionName = 'search/search';

const searchList = computed(()=> store.state.search.searchList);

const searchData = reactive({
    search: route.params.search,
    page: store.state.pagination.currentPage,
});

console.log('searchData :', searchData);

onBeforeMount(() => {
    store.dispatch(actionName, searchData);
});
</script>
<style scoped>
.title {
    font-size: 50px;
}

.search {
    margin-bottom: 150px;
}

.search-box h1{
    margin: 50px 0;
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
    grid-template-columns: 0.5fr 0.7fr 1fr 8fr 1fr;
    text-align: center;
    padding: 10px;
    font-weight: 600;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}

.search-content {
    display: grid;
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
</style>