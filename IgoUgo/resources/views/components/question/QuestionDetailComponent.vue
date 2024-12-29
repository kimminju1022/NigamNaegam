<template>
    <div class="container">
        <h1>FAQ</h1>
        <div v-if="$store.state.auth.userInfo.user_id === questionDetail.user_id" class="header-btn-box"> 
            <router-link :to="`/questions/${questionList.board_id}/edit`"><button class="btn bg-navy header-btn" @click="updateConfirm">수정</button></router-link>
            <!-- <router-link :to="`/questions/${$store.state.questions.questionDetail.board_id}/edit`"><button class="btn bg-navy header-btn" @click="updateConfirm">수정</button></router-link> -->
            <button class="btn bg-navy header-btn" @click="deleteQuestion">삭제</button>
        </div>
        <!-- <div v-if="questionDetail" class="board-box">   -->
        <div class="board-box">  
            <div class="board-title-box">
                <p>제목</p>
                <p>{{ questionDetail.board_title }}</p>
            </div>
            <div class="board-content-box">
                <p>내용</p>
                <div class="board-content">
                    <div class="board-content-img">
                        <img :src="questionDetail.board_img1">
                        <img :src="questionDetail.board_img2">
                    </div>
                    <p>{{ questionDetail.board_content }}</p>
                    <div class="board-user">
                        <p>닉네임 : {{ questionDetail.users.user_nickname }}</p>
                        <p>{{ questionDetail.created_at }}</p>
                    </div>
                </div>
            </div>
            <div class="admin-content-section">
                <div class="admin-content-box">
                    <p>관리자 답변</p>
                    <div class="admin-content">
                        <p>여기는 관리자 답변</p>
                        <div class="board-admin">
                            <p>관리자</p>
                            <p>2024.12.05</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import router from '../../../js/router'

const store = useStore();


const questionList = computed(() => store.state.question.questionList);
const questionDetail = computed(() => store.state.question.questionDetail);

const boardInfo = reactive({
    board_id: store.state.question.questionList.board_id,
});

onBeforeMount(()=>{
    store.dispatch('question/questionDetail', boardInfo.board_id);
});

// console.log('questionList', questionList.value);
// console.log('questionDetail', questionDetail);
// console.log('questionDetail', boardInfo);


// ******************************* button *******************************
// const updateConfirm = () => {
//     const userResponse = confirm('해당 글을 수정 하시겠습니까?');
//         if (userResponse) {
//         router.push('/boards/question/update');
//     }
// }

const deleteQuestion = (id) => {
    confirm('해당 글을 삭제 하시겠습니까?\n삭제 시 게시글을 되돌릴 수 없습니다');

    store.dispatch('question/destroyQuestion', id);
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
    /* gap: -200px; */
    margin-right: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.board-box {
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
    font-size: 20px;
    text-align: center;
    font-weight: 600;
}

.board-box > div:not(:last-child) {
    display: grid;
    grid-template-columns: 1fr 5fr;
    border-bottom: 1px solid #01083a;
    /* padding: 10px; */
}

/* 이렇게 써도되나? 밑에거가 맞는건가 */
.board-box > div > :first-child:not(:last-child) {
/* .board-box > div > p:nth-child(1) { */
    border-right: 1px solid #01083a;
}

.board-content > *:not(:last-child), .admin-content > *:not(:last-child) {
    border-bottom: 1px solid #01083a;
}

.board-user, .board-admin {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
}

.board-content-img {
    display: grid;
    grid-template-columns: 1fr 1fr;
    place-items: center;
}

.board-content-img > img {
    max-width: 300px;
    max-height: 300px;
}

.admin-content-section {
    background: #D9D9D9;
}

.admin-content-box {
    display: grid;
    grid-template-columns: 1fr 5fr;
}

.admin-content-box > :first-child{
    border-right: 1px solid #01083a;
}
</style>