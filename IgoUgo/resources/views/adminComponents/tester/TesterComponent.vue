<template>
    <div class="tester-container">
        <div class="header-flex">
            <div>
                <p class="tester-title">체험단</p>
                <hr class="hr-style">
            </div>
            <router-link to="/admin/tester/create"><button class="btn bg-navy btn-create">작성</button></router-link>
        </div>
        <div class="tester-content-box">
            <div class="tester-list-title">
                <p>번호</p>
                <p>지역</p>
                <p>가게 주소</p>
                <p>게시글 제목</p>
                <p>댓글 수</p>
                <p>관리자 이름</p>
                <p>작성날짜</p>
                <p>마감날짜</p>
                <p>당첨인원</p>
            </div>
            <div class="tester-list-box">
                <div>
                    <div v-for="item in testerList" class="tester-item">
                        <p>{{ item.board_id }}</p>
                        <p>{{ item.tester_management?.tester_area }}</p>
                        <p>{{ item.tester_management?.tester_place }}</p>
                        <router-link :to="`/admin/tester/${item.board_id}`">{{ item.board_title }}</router-link>
                        <p>{{ item.comments_count }}</p>
                        <p>{{ item.user?.user_name }}</p>
                        <!-- <p>2025-02-06 00:00:00</p> -->
                        <p>{{ item.created_at_timestamps }}</p>
                        <p>{{ item.tester_management?.dd }}</p>
                        <p>0/10</p>
                        <!-- 당첨인원은 마감일자 후에 띄우기 -->
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
        </div>
    </div>
</template>

<script setup>

import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import PaginationComponent from '../../components/PaginationComponent.vue';

const store = useStore();

const testerList = computed(() => store.state.adminTester.boardList);

const actionName = 'adminTester/testerList';
const searchData = reactive({
    page: store.state.pagination.CurrentPage,
});

onBeforeMount(() => {
    store.dispatch(actionName, searchData);
});
</script>

<style scoped>
/* 체험단 큰 틀 */
.tester-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

.header-flex {
    display: flex;
    justify-content: space-between;
}

.btn-create {
    width: 70px;
    height: 45px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 20px;
}

.btn-create:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
}

/* 체험단 타이틀 */
.tester-title {
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
.tester-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.tester-list-title {
    display: grid;
    grid-template-columns: 0.5fr 0.5fr 1.5fr 1.5fr 0.5fr 0.5fr 1fr 0.7fr 0.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    border-bottom: 1px solid #01083a;
}
.tester-list-box {
    padding: 5px;
}
.tester-list-box {
    margin-bottom: 15px;
}
.tester-item{
    display: grid;
    grid-template-columns: 0.5fr 0.5fr 1.5fr 1.5fr 0.5fr 0.5fr 1fr 0.7fr 0.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 15px;
}
.tester-item > :nth-child(n + 3):nth-child(-n + 4) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>