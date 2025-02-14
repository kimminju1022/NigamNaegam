<template>
    <div class="container">
        <h1>체험단 신청</h1>
        <div class="board-head">
            <!-- <input v-model="search" type="text" placeholder="검색어를 입력해 주세요"> -->
            <!-- <input type="text" placeholder="검색어를 입력해 주세요"> -->
            <!-- <button class="btn bg-navy board-search-btn">검색</button> -->
        </div>
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
            <div class="board-notice-box" >
                <div class="board-content">
                    <p>5</p>
                    <p>공지</p>
                    <p></p>
                    <p>파일업로드 오류 시 간단해결방법</p>
                    <p></p>
                    <p>2024.12.11</p>
                    <p>204</p>
                </div>
                <div class="board-content">
                    <p>4</p>
                    <p>공지</p>
                    <p></p>
                    <p>로그인 에러 시 문의방법</p>
                    <p></p>
                    <p>2024.11.11</p>
                    <p>224</p>
                </div>
                <div class="board-content">
                    <p>3</p>
                    <p>공지</p>
                    <p></p>
                    <p>게시글 수정 오류 해결방법</p>
                    <p></p>
                    <p>2024.11.11</p>
                    <p>763</p>
                </div>
                <div class="board-content">
                    <p>2</p>
                    <p>공지</p>
                    <p></p>
                    <p>자주 질문하는 오류 해결방법</p>
                    <p></p>
                    <p>2024.11.01</p>
                    <p>744</p>
                </div>
                <div class="board-content">
                    <p>1</p>
                    <p>공지</p>
                    <p></p>
                    <p>민원 해결 절차 안내</p>
                    <p></p>
                    <p>2024.12.11</p>
                    <p>428</p>
                </div>
            </div>
            <div class="board-content-box">
                <div v-for="item in testerList" :key="item" class="board-content">
                    <p>{{ item.board_id }}</p>
                    <p>카테고리</p>
                    <p></p>
                    <router-link :to="`/testers/${item.board_id}`">{{ item.board_title }}</router-link>
                    <p></p>
                    <p>{{ item.created_at }}</p>
                    <p>{{ item.view_cnt }}</p>
                </div>
            </div>

            <!-- <div class="card-list">
                <div v-for="item in testerList" :key="item" >
                    <router-link :to="`/testers/${item.board_id}`">
                        <div class="card">
                            <img :src="item.board_images[0]" @error="e => e.target.src='default/board_default.png'" class="img-card">
                            <p class="font-bold card-title">{{ item.board_title }}</p>
                        </div>
                    </router-link>
                </div>
            </div> -->
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
const actionName = 'tester/testerList';
const testerList = computed(() => store.state.tester.testerList);

// 필터 관련
const searchData = reactive({
    page: store.state.pagination.currentPage,
});

onBeforeMount(() => {
    store.dispatch(actionName, searchData);
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

.board-notice-box > .board-content > p:nth-child(2) {
    font-weight: 600;
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

/* .board-content-box > .board-content > :nth-child(4){
    text-align: left;
    padding: 0 20px;
} */

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
</style>