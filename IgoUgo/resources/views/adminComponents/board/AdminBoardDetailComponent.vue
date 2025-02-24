<template>
<div class="main-btn">
    <button v-if="postDetail && postDetail[0]?.board_flg === '0'" @click="deletePost()" class="btn bg-navy main-btn-size">삭제</button>
    <p v-if="postDetail && postDetail[0]?.board_flg === '1'">이미 삭제된 게시글입니다.</p>
    <!-- <button @click="deletePost()" class="main-btn-size">삭제</button> -->
    <router-link :to="'/admin/board/review'" >
        <button class="btn bg-navy main-btn-size">취소</button>
    </router-link>
</div>
<div class="main-table-background-color">
    <p class="main-table-name">리뷰게시판</p>
    <!-- <p v-if="postDetail" class="main-table-report">신고 : {{ postDetail[0].report_count }}회</p> -->
    <div v-if="postDetail" class="main-table">
        <div class="adminboard-table">
            <div class="adminboard-column">번호</div>
            <div class="adminboard-table-left adminboard-table-grid" >
                <p class="adminboard-content">{{ postDetail[0].board_id }}</p>
                <div class="admin-table-info">
                    <p>카테고리 : 호텔 </p>
                    <p>작성자 : {{ postDetail[0].user_nickname }}</p>
                    <p>작성일자 : {{ postDetail[0].created_at }}</p>
                    <p>신고 : {{ postDetail[0].report_count }}회</p>
                </div>
            </div>
        </div>
        <div class="adminboard-table">
            <div class="adminboard-column">제목</div>
            <div class="adminboard-table-left first-table-aline">
                <p class="adminboard-content">{{ postDetail[0].board_title }}</p>
            </div>
        </div>
        <div class="adminboard-table">
            <div class="adminboard-column">내용</div>
            <div class="adminboard-table-left">
                <!-- ------------ 경진 start ------------  -->
                <div class="img-grid">
                    <img v-for="(image, index) in postDetail[0].board_images" :key="index" :src="image.board_img">
                </div>
                <!-- ------------ 경진 end ------------  -->
                <p class="adminboard-content">{{ postDetail[0].board_content }}</p>
            </div>
        </div>
    </div>
</div>
</template>
<script setup>

import { computed, onBeforeMount, reactive } from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const route = useRoute();

const actionName = 'adminBoard/getPostDetail';

const postDetail = computed(()=> store.state.adminBoard.postDetail);

const searchData = reactive({
    bc_code: '0',
    board_id: route.params.boardid,
});

onBeforeMount(async() => {
    await store.dispatch(actionName, searchData);
    // console.log(store.state.adminBoard.postDetail);
})

function deletePost() {
        store.dispatch('adminBoard/destroyReview', searchData);
}

console.log(postDetail.value);

</script>
<style scoped>
/* 메인버튼 */
.main-btn {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
.main-btn-size {
    /* height: 50px;
    width: 100px;
    background-color: transparent;
    border: none;
    font-size: 30px;
    font-weight: 900;
    margin-bottom: 10px;
    cursor: pointer; */
    width: 70px;
    height: 45px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 20px;
    margin-bottom: 10px;
    margin-left: 10px;
}
.main-btn-size:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
}

/* 테이블쪽 */
.main-table-name {
    font-size: 30px;
    font-weight: 900;
    margin-bottom: 20px;
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
/* .adminboard-table-left {
    display: flex;
    border-left: solid 2px #000;
    overflow: scroll;
} */

/* ------------ 경진 start ------------ */
.adminboard-table-left {
    /* display: flex; */
    border-left: solid 2px #000;
    margin-top: 10px;
}

.img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    place-items: center;
}

.img-grid > img {
    max-width: 185px;
    max-height: 185px;
}
/* ------------ 경진 end ------------ */

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