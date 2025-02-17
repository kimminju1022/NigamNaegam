<template>
    <div class="container">
        <h1>공지사항</h1>
        <div class="board-box">
            <div class="board-title">
                <p>번호</p>
                <p>카테고리</p>
                <p></p>
                <p>제목</p>
                <p></p>
                <p>작성일자</p>
                <p>조회수</p>
            </div>
            <!-- <div class="board-notice-box" >
                <div v-for="(item, index) in noticeTopList" class="board-content">
                    <p>{{ index + 1 }}</p>
                    <p>공지</p>
                    <p></p>
                    <router-link :to="`/notices/${item.board_id}`"><p>{{ item.board_title }}</p></router-link>
                    <p></p>
                    <p>{{ item.created_at }}</p>
                    <p>{{ item.view_cnt }}</p>
                </div>
            </div> -->
            <div class="board-content-box">
                <div v-for="(item, index) in noticeList" class="board-content">
                    <p>{{ item.board_id }}</p>
                    <p>공지</p>
                    <p></p>
                    <router-link :to="`/notices/${item.board_id}`"><p>{{ item.board_title }}</p></router-link>
                    <p></p>
                    <p>{{ item.created_at }}</p>
                    <p>{{ item.view_cnt }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- 페이지네이션 -->
    <PaginationComponent
        :actionName="actionName"
        :searchData="searchData"
        :currentPage="$store.state.pagination.currentPage"
        :lastPage="$store.state.pagination.lastPage"
        :viewPageNumber="$store.state.pagination.viewPageNumber"
    />
</template>
<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import PaginationComponent from '../PaginationComponent.vue';

const store = useStore();
const actionName = 'notice/noticeList';
const actionNameTop = 'notice/noticeTopList';
const noticeList = computed(() => store.state.notice.noticeList);
const noticeTopList = computed(() => store.state.notice.noticeTopList);

// 필터 관련
const searchData = reactive({
    page: store.state.pagination.currentPage,
});

onBeforeMount(() => {
    store.dispatch(actionName, searchData);
    store.dispatch(actionNameTop);
});

</script>

<style scoped>
.container{
    align-items: center;
}

.container > h1 {
    font-size: 3rem;
    margin: 50px 0;
}

.board-head{
    display: flex;
    justify-content: flex-end;
    gap: 20px;
}

.board-head > input {
    border: #01083a solid 1px;
    color: #01083a;
    border-radius: 20px;
    width: 300px;
    padding: 5px 20px;
    font-size: 16px;
}

.board-search-btn{
    font-size: 18px;
    border-radius: 20px;
    width: 70px;
    text-align: center;
}

.board-box{
    /* width: 100%; */
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    /* max-width: 1250px; */
    min-width: 500px;
    margin: 40px auto;
    font-size: 18px;
}

.board-title {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 7fr 1fr 1.5fr 1fr;
    text-align: center;
    padding: 10px;
    font-weight: 600;
    border-bottom: 1px solid #01083a;
}

.board-notice-box {
    background-color: #eeeeee;
    padding:  5px;
}


.board-content-box {
    padding: 5px;
}

.board-content{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 7fr 1fr 1.5fr 1fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 16px;
}

.board-content > :nth-child(4){
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
    padding: 0 10px;
}

.board-content span {
    font-size: 13px;
    color: #4c4c4c;
}
</style>