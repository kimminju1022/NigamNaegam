<template>
    <div class="container" v-if="questionDetail">
        <h1>문의게시판</h1>
        <router-link :to="`/testers`"><button class="btn bg-navy header-btn">목록</button></router-link>
        <div class="board-box">
            <div class="board-box-flex">
                <!-- <div class="board-title-box board-title-category">
                    <p>카테고리</p>
                </div>
                <div class="board-title-box board-title">
                    <p>제목</p>
                    <input type="text" placeholder="바쁘다바빠">
                </div>
                <div class="board-user">
                    <p>2025-01-01 00:00</p>
                </div> -->
                    <p>카테고리</p>
                    <div class="board-title">
                        <p>제목</p>
                        <!-- <input type="text" placeholder="바쁘다바빠"> -->
                        <p>여기는 제목 바쁘다바빠</p>
                    </div>
                    <p>2025-01-01 00:00</p>
            </div>
            <div class="board-content-box">
                <!-- <p>내용</p> -->
                <div class="board-content">
                    <div class="board-content-img">
                        <div class="img-grid">
                            <!-- <img v-for="(image, index) in questionDetail.board_images" :key="index" :src="image.board_img"> -->
                        </div>
                    </div>
                    <div class="content-textarea">
                        <textarea readonly>카테고리</textarea>
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

.board-title {
    display: flex;
}

.board-content > div:not(:last-child){
    width: 90%;
    margin: 20px auto;
}

.board-box p, .board-content textarea {
    font-size: 17px;
}

.board-title-box textarea {
    font-size: 17px;
    resize: none;
    margin: 5px;
}

.board-box >.board-box-flex > :first-child {
    border-right: 1px solid #01083a;
}
/* .board-box >.board-box-flex > :first-child, .board-title-box > p:not(.board-title-category :last-child){
    border-right: 1px solid #01083a;
} */

.board-box-flex {
    display: grid;
    grid-template-columns: 1fr 3fr 1fr;
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
.board-box > div > :first-child:not(:last-child) {
    border-right: 1px solid #01083a;
}

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
}

.board-content-img {
    margin: 20px auto;
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
</style>