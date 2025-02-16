<template>
<div class="main-btn">
    <button class="main-btn-size">삭제</button>
    <button class="main-btn-size">취소</button>
</div>
<div class="main-table-background-color">
    <p class="main-table-name">리뷰게시판</p>
    <p class="main-table-report">신고 : </p>
    <div class="main-table">
        <div class="adminboard-table">
            <div class="adminboard-column">번호</div>
            <div class="adminboard-table-left adminboard-table-grid" >
                <p class="adminboard-content">안농</p>
                <div class="admin-table-info">
                    <p>카테고리 : 호텔 </p>
                    <p>작성자 : 싫어핑</p>
                    <p>작성일자 : 2024-24-24</p>
                </div>
            </div>
        </div>
        <div class="adminboard-table">
            <div class="adminboard-column">제목</div>
            <div class="adminboard-table-left first-table-aline">
                <p class="adminboard-content">방가워</p>
            </div>
        </div>
        <div class="adminboard-table">
            <div class="adminboard-column">내용</div>
            <div class="adminboard-table-left">
                <p class="adminboard-content">잘가</p>
            </div>
        </div>
    </div>
</div>
</template>
<script setup>

import { computed, onBeforeMount, reactive } from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex/dist/vuex.cjs.js';

const store = useStore();
const route = useRoute();

const actionName = 'adminBoard/getPostDetail';

const postDetail = computed(()=> store.state.adminBoard.postDetail);

const searchData = reactive({
    bc_code: '0',
    board_id: route.params.boardid,
    page: store.state.pagination.currentPage,
});

onBeforeMount(async() => {
    await store.dispatch(actionName, searchData);
    console.log(store.state.adminBoard.postDetail);
    // console.log(searchData.board_id)
})

</script>
<style scoped>
/* 메인버튼 */
.main-btn {
    display: flex;
    justify-content: flex-end;
}
.main-btn-size {
    height: 50px;
    width: 100px;
    background-color: transparent;
    border: none;
    font-size: 30px;
    font-weight: 900;
    margin-bottom: 10px;
}

/* 테이블쪽 */
.main-table-name {
    font-size: 40px;
    font-weight: 900;
}
.main-table-report {
    font-size: 18px;
    margin: 10px 0;
}
.main-table-background-color {
    background-color: #fff;
    height: 850px;
    padding: 30px;
}
.main-table {
    display: grid;
    grid-template-rows: 0.5fr 0.8fr 3fr;
    height: 700px;
    font-size: 18px;
}
.main-table >:nth-child(3) {
    border-bottom: solid 2px #000;
}
.adminboard-table {
    display: grid;
    grid-template-columns: 1fr 8fr;
    border-top: solid 2px #000;
}
.adminboard-table-left {
    display: flex;
    border-left: solid 2px #000;
}
.first-table-aline {
    align-items: center;
}
.adminboard-table-grid {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.admin-table-info {
    display: flex;
    gap: 50px;
}
.admin-table-info > :last-child {
    margin-right: 50px;
}
.adminboard-column {
    text-align: center;
    align-self: center;
}
.adminboard-content {
    padding: 20px;
}

</style>