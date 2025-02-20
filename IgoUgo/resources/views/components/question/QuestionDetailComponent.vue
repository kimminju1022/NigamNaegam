<template>
    <div class="container" v-if="questionDetail">
        <h1><router-link :to="`/questions`">문의게시판</router-link></h1>
        <div v-if="$store.state.auth.userInfo.user_id === questionDetail.user_id" class="header-btn-box"> 
            <router-link :to="`/questions`"><button class="btn bg-navy header-btn">목록</button></router-link>
            <router-link :to="`/questions/${questionDetail.board_id}/edit`"><button class="btn bg-navy header-btn">수정</button></router-link>
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
                <!-- <p>내용</p> -->
                <div class="board-content">
                    <div class="board-content-img">
                        <!-- <img :src="questionDetail.board_img1">
                        <img :src="questionDetail.board_img2"> -->
                        <div class="img-grid">
                            <img v-for="(image, index) in questionDetail.board_images" :key="index" :src="image.board_img">
                        </div>
                    </div>
                    <div class="content-textarea">
                        <textarea ref="textArea" @input="resize" readonly>{{ questionDetail.board_content }}</textarea>
                    </div>
                    <div class="board-user">
                        <div class="border-user-profile">
                            <img :src="questionDetail.user.user_profile">
                            <p>by  {{ questionDetail.user.user_nickname }}</p>
                        </div>
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
import { computed, onBeforeMount, reactive, ref } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();

const questionDetail = computed(() => store.state.question.questionDetail);

const boardInfo = reactive({
    board_id: route.params.id,
});

onBeforeMount(()=>{
    store.dispatch('question/questionDetail', boardInfo);
});

const textArea = ref(null);

const resize = () => {
    textArea.value.style.height = "1px";
    textArea.value.style.height = textArea.value.scrollHeight + "px";
};

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
    font-size: 2rem;
    margin: 25px 0;
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

.board-content > div:not(:last-child){
    width: 90%;
    margin: 20px auto;
}

.board-box p, .board-content textarea {
    /* padding: 10px; */
    font-size: 17px;
}

/* .board-box > div:not(:first-child){
    display: grid;
    grid-template-columns: 1fr 5fr;
} */

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
/* .board-box > div > :first-child, .board-title-box > p:not(.board-title-category :last-child){ */
.board-box >.board-box-flex > :first-child, .board-title-box > p:not(.board-title-category :last-child){
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

.border-user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.board-user img {
    width: 35px;
    height: 35px;
    border-radius: 50px;
    border: 2px solid #01083a18;
}

.board-content textarea {
    resize: none;
    height: 250px;
    width: 99%;
    margin: 10px;
    /* background-color: #f7f7f7; */
}

.board-content-img {
    /* display: grid; */
    /* grid-template-columns: 1fr 1fr; */
    /* place-items: center; */
    /* padding: 10px; */
    margin: 20px auto;
}

.img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    place-items: center;
    /* margin: 0 auto; */
}

.img-grid > img {
    max-width: 185px;
    max-height: 185px;
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