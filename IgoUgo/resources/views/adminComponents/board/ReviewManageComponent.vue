<template>
    <div class="review-container">
        <div>
            <p class="review-title">리뷰게시판</p>
            <hr class="hr-style">
        </div>
        <div class="review-content-box">
            <div class="review-list-title">
                <p>신고</p>
                <p>번호</p>
                <p>카테고리</p>
                <p>제목</p>
                <p>닉네임</p>
                <p>이름</p>
                <p>작성일자</p>
            </div>
            <div class="review-list-box" >
                <div v-for="item in postList" :key="item" class="review-item">
                    <p v-if="item.report_count > 0">{{ item.report_count }}</p>
                    <p v-else>0</p>
                    <p>{{ item.board_id }}</p>
                    <p v-if="item.contenttypeid === '12'">관광지</p>
                    <p v-else-if="item.contenttypeid === '14'">문화시설</p>
                    <p v-else-if="item.contenttypeid === '28'">레포츠</p>
                    <p v-else-if="item.contenttypeid === '32'">호텔</p>
                    <p v-else-if="item.contenttypeid === '38'">쇼핑</p>
                    <p v-else>음식점</p>
                    <router-link :to="`/admin/board/review/${item.board_id}`" >{{ item.board_title }}</router-link>
                    <p>{{ item.user_nickname }}</p>
                    <p>{{ item.user_name }}</p>
                    <p>{{ item.created_at }}</p>
                </div>
                <div class = "review-post-List">
                    <PaginationComponent
                    :actionName="actionName"
                    :searchData="searchData"
                    :currentPage="$store.state.pagination.currentPage"
                    :lastPage="$store.state.pagination.lastPage"
                    :viewPageNumber="$store.state.pagination.viewPageNumber"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import PaginationComponent from '../../components/PaginationComponent.vue';
const store = useStore();

// 게시판 불러오기
const postList = computed(()=> store.state.adminBoard.postList);
const actionName = 'adminBoard/getPostList';


const searchData = reactive({
    bc_code: '0',
    page: store.state.pagination.currentPage,
});

onBeforeMount(async() => {
    store.dispatch(actionName, searchData)
});
</script>

<style scoped>
/* 리뷰 게시판 큰 틀 */
.review-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 리뷰 게시판 타이틀 */
.review-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    width: 500px;
    margin-top: 5px;
}

/* 게시판 리스트 */
.review-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.review-list-title {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 5fr 1fr 1fr 1.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.review-list-box {
    padding: 5px;
}
.review-item{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 5fr 1fr 1fr 1.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.review-item > :nth-child(4) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
.review-post-List {
    text-align: center;
    margin-top: 20px;
}
</style>