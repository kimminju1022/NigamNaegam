<template>
    <div class="container">
        <h1>문의게시판</h1>
        <div class="board-head">
            <!-- <input v-model="search" type="text" placeholder="검색어를 입력해 주세요"> -->
            <input type="text" placeholder="검색어를 입력해 주세요">
            <button class="btn bg-navy board-search-btn">검색</button>
            <div class="board-create-btn">
                <router-link to="/questions/create"><button class="btn bg-navy">작성</button></router-link>
            </div>
        </div>
        <div class="board-box">
            <div class="board-title">
                <p>번호</p>
                <p>상태</p>
                <p>제목</p>
                <p>닉네임</p>
                <p>작성일자</p>
                <p>조회수</p>
            </div>
            <div class="board-notice-box" >
                <div class="board-content">
                    <p>5</p>
                    <p>공지</p>
                    <p>파일업로드 오류 시 간단해결방법</p>
                    <p>라라핑</p>
                    <p>2024.12.11</p>
                    <p>204</p>
                </div>
                <div class="board-content">
                    <p>4</p>
                    <p>공지</p>
                    <p>로그인 에러 시 문의방법</p>
                    <p>차나핑</p>
                    <p>2024.11.11</p>
                    <p>224</p>
                </div>
                <div class="board-content">
                    <p>3</p>
                    <p>공지</p>
                    <p>게시글 수정 오류 해결방법</p>
                    <p>라라핑</p>
                    <p>2024.11.11</p>
                    <p>763</p>
                </div>
                <div class="board-content">
                    <p>2</p>
                    <p>공지</p>
                    <p>자주 질문하는 오류 해결방법</p>
                    <p>믿어핑</p>
                    <p>2024.11.01</p>
                    <p>744</p>
                </div>
                <div class="board-content">
                    <p>1</p>
                    <p>공지</p>
                    <p>민원 해결 절차 안내</p>
                    <p>차캐핑</p>
                    <p>2024.12.11</p>
                    <p>428</p>
                </div>
            </div>
            <div class="board-content-box">
                <div v-for="item in questionList" :key="item" class="board-content">
                    <p>{{ item.board_id }}</p>
                    <div v-if="item.question.que_status === '0'">
                        <p class="reply-yet">대기</p>
                    </div>
                    <div v-else>
                        <p class="reply-done">완료</p>
                    </div>
                    <router-link :to="`/questions/${item.board_id}`">{{ item.board_title }}</router-link>
                    <p>{{ item.user.user_nickname }}</p>
                    <p>{{ item.created_at }}</p>
                    <p>{{ item.view_cnt }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- 페이지네이션 -->
    <PaginationComponent :actionName="actionName" :searchData="searchData" />
</template>
<script setup>

import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import PaginationComponent from '../PaginationComponent.vue';

const store = useStore();
const actionName = 'question/questionList';
const questionList = computed(() => store.state.question.questionList);

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
    max-width: 1250px;
    min-width: 500px;
    margin: 40px auto;
    font-size: 18px;
}

.board-title {
    display: grid;
    grid-template-columns: 1fr 1fr 9fr 1.5fr 1.5fr 1fr;
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
    grid-template-columns: 1fr 1fr 9fr 1.5fr 1.5fr 1fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 16px;
}

.board-content > :nth-child(n + 3):nth-child(-n + 4){
    /* text-align: left;
    overflow: hidden; */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
    padding: 0 10px;
}

.board-content-box > .board-content > :nth-child(3){
    text-align: left;
}

.reply-yet {
    color: red;
}

.reply-done {
    color: blue;
}

.board-create-btn{
    display: flex;
    flex-direction: row-reverse;
}

.board-create-btn button {
    font-size: 18px;
    border-radius: 20px;
    width: 70px;
    text-align: center;
    height: 33px;
}
</style>