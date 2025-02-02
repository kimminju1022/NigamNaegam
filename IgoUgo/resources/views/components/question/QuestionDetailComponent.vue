<template>
    <div class="container" v-if="questionDetail">
        <h1>문의게시판</h1>
        <div v-if="$store.state.auth.userInfo.user_id === questionDetail.user_id" class="header-btn-box"> 
            <router-link :to="`/questions`"><button class="btn bg-navy header-btn">목록</button></router-link>
            <router-link :to="`/questions/${questionDetail.board_id}/edit`"><button class="btn bg-navy header-btn" @click="updateConfirm">수정</button></router-link>
            <!-- <router-link :to="`/questions/${$store.state.questions.questionDetail.board_id}/edit`"><button class="btn bg-navy header-btn" @click="updateConfirm">수정</button></router-link> -->
            <button class="btn bg-navy header-btn" @click="deleteQuestion(questionDetail.board_id)">삭제</button>
        </div>
        <div v-else class="header-btn-box">
            <router-link :to="`/questions`"><button class="btn bg-navy header-btn">목록</button></router-link>
        </div>
        <div class="board-box">
            <!-- <div class="board-title-box">
                <p>제목</p>
                <div class="board-num">
                    <textarea readonly>{{ questionDetail.board_title }}</textarea>
                    <p>조회수</p>
                    <p>{{ questionDetail.view_cnt }}</p>
                </div>  
            </div> -->
            <div class="board-box-flex">
                <div class="board-title-box board-title">
                    <p>제목</p>
                    <textarea readonly>{{ questionDetail.board_title }}</textarea>
                </div>
                <div class="board-title-box board-title-category">
                    <p>카테고리</p>
                    <p>{{ questionDetail.question_category.qc_name }}</p>
                </div>
            </div>
            <div class="board-content-box">
                <p>내용</p>
                <div class="board-content">
                    <div class="board-content-img">
                        <!-- <img :src="questionDetail.board_img1">
                        <img :src="questionDetail.board_img2"> -->
                        <div class="img-grid">
                            <img v-for="(image, index) in questionDetail.board_images" :key="index" :src="image.board_img">
                        </div>
                    </div>
                    <textarea readonly>{{ questionDetail.board_content }}</textarea>
                    <div class="board-user">
                        <p>닉네임 : {{ questionDetail.user.user_nickname }}</p>
                        <p>{{ questionDetail.created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div v-show="questionDetail.question.que_content !== null" class="admin-content-section">
            <div class="admin-content-box">
                <p>관리자 답변</p>
                <div class="admin-content">
                    <p>{{ questionDetail.question.que_content }}</p>
                    <div class="board-admin">
                        <p>관리자</p>
                        <p>{{ questionDetail.question.updated_at }}</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();

const questionDetail = computed(() => store.state.question.questionDetail);
// console.log(questionDetail);

const boardInfo = reactive({
    board_id: route.params.id,
});

onBeforeMount(()=>{
    store.dispatch('question/questionDetail', boardInfo);
});

const deleteQuestion = (id) => {
    const check = confirm('해당 글을 삭제 하시겠습니까?\n삭제 시 게시글을 되돌릴 수 없습니다');
    if(check) {
        store.dispatch('question/destroyQuestion', id);
    }
}
</script>

<style scoped>
.container{
    align-items: center;
}

.container > h1 {
    font-size: 3rem;
    margin: 50px 0;
}

.header-btn-box {
    display: flex;
    justify-content: flex-end;
}

.header-btn{
    font-size: 18px;       
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-right: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.board-box, .admin-content-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    margin-top: 50px;
}

.board-box p {
    padding: 10px;
    font-size: 17px;
}

.board-title-box > p:first-child
, .board-content-box > p:first-child
, .admin-content-box > p:first-child {
    font-size: 18px;
    text-align: center;
    font-weight: 600;
}

.board-box p, .board-content > textarea {
    /* padding: 10px; */
    font-size: 17px;
}

.board-box > div:not(:first-child){
    display: grid;
    grid-template-columns: 1fr 5fr;
}

/* .board-title-box {
    display: grid;
    grid-template-columns: 1fr 5fr;
    border-bottom: 1px solid #01083a;
} */

.board-title-box textarea {
    font-size: 17px;
    resize: none;
    margin: 5px;
}
.board-box > div > :first-child, .board-title-box > p:not(.board-title-category :last-child){
    border-right: 1px solid #01083a;
}

.board-box-flex {
    display: grid;
    grid-template-columns: 2fr 1fr;
}

.board-title {
    display: grid;
    grid-template-columns: 1fr 2.99fr;
    border-bottom: 1px solid #01083a;
}

.board-title-category {
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-bottom: 1px solid #01083a;
}

.board-title-category :last-child {
    font-size: 17px;
    margin: 0  auto;
    /* width: 80%; */
}

/* 
.board-num {
    display: grid;
    grid-template-columns: 6fr 1fr 1fr;
}

.board-num :nth-child(2) {
    border-left: 1px solid #01083a;
    border-right: 1px solid #01083a;
    font-weight: 600;
    font-size: 18px;
    text-align: center;
} */

/* 이렇게 써도되나? 밑에거가 맞는건가 */
.board-box > div > :first-child:not(:last-child) {
/* .board-box > div > p:nth-child(1) { */
    border-right: 1px solid #01083a;
}

/* .board-content > *:first-child, .admin-content > *:not(:last-child) { */
.admin-content > *:not(:last-child) {
    border-bottom: 1px solid #01083a;
}

.board-content > :last-child {
    border-top: 1px solid #01083a;
}

.board-user, .board-admin {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
}

.board-content > textarea {
    resize: none;
    height: 300px;
    width: 100%;
    margin: 10px;
}

.board-content-img {
    /* display: grid; */
    /* grid-template-columns: 1fr 1fr; */
    /* place-items: center; */
    padding: 10px;
}

.img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    place-items: center;
}

.img-grid > img {
    max-width: 300px;
    max-height: 300px;
}

/* 관리자 */
.admin-content-box {
    display: grid;
    grid-template-columns: 1fr 5fr;
    background: #D9D9D9;
}
.admin-content-box p {
    padding: 10px;
    font-size: 17px;
}

.admin-content-box > :first-child{
    border-right: 1px solid #01083a;
}
</style>