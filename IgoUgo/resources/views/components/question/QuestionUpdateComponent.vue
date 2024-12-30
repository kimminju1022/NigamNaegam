<template>
    <div class="container">
        <h1>문의게시판</h1>
        <div class="header-btn-box"> 
            <button @click="$store.dispatch('question/updateQuestion', question)" class="btn bg-navy header-btn">완료</button>
            <router-link :to="'/questions'"><button @click="" class="btn bg-navy header-btn">취소</button></router-link>
        </div>
        <div class="board-box">  
            <div class="board-title-box">
                <p>제목</p>
                <input v-model="question.questionDetail.board_title" maxlength="100" name="board_title">
                <div class="board-num">
                    <p>글 번호</p>
                    <p>{{ question.questionDetail.board_id }}</p>
                </div>
            </div>
            <div class="board-img">
                <p>파일 첨부</p>
                <div class="board-img-content">
                    <input @change="setFile1" type="file" name="board_img1" accept="image/*">
                    <input @change="setFile2" type="file" name="board_img2" accept="image/*">
                    <div class="img-preview">
                        <img :src="preview1 || question.questionDetail.board_img1"> 
                        <button @click="clearFile1" v-show="preview1" class="btn bg-clear">X</button>
                    </div>
                    <div class="img-preview">
                        <img :src="preview2 || question.questionDetail.board_img2"> 
                        <button @click="clearFile2" v-show="preview2" class="btn bg-clear">X</button>
                    </div>
                </div>
            </div>
            <div class="board-content">
                <p>내용</p>
                <textarea maxlength="2000" v-model="question.questionDetail.board_content" name="board_content"></textarea>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useStore } from 'vuex';
import router from '../../../js/router';

const store =  useStore();

const question = reactive({
    questionDetail: store.state.question.questionDetail
    ,board_img1: null
    ,board_img2: null
});

const preview1 = ref('');
const preview2 = ref('');

const setFile1 = (e) => {
    question.board_img1 = e.target.files[0];
    preview1.value = URL.createObjectURL(question.board_img1);
}

const setFile2 = (e) => {
    question.board_img2 = e.target.files[0];
    preview2.value = URL.createObjectURL(question.board_img2);
}

const clearFile1 = () => {
    question.board_img1 = null;
    preview1.value = null;
}

const clearFile2 = () => {
    question.board_img2 = null;
    preview2.value = null;
}



// const updateConfirm = () => {
//     const userResponse = confirm('수정 페이지에서 벗어납니다. 수정을 취소하시겠습니까?');
//     if (userResponse) {
//         router.push('/boards/');
//     } else {
//         alert('수정을 계속 진행합니다.');
//     }
// }


// 모달
// const modal = document.querySelector('.modal');
// const modalOpen = document.querySelector('.modal_btn');
// const modalClose = document.querySelector('.close_btn');

// //열기 버튼을 눌렀을 때 모달팝업이 열림
// modalOpen.addEventListener('click',function(){
//     modal.style.display = 'block';
// });
// //닫기 버튼을 눌렀을 때 모달팝업이 닫힘
// modalClose.addEventListener('click',function(){
//     modal.style.display = 'none';
// });
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

.board-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    margin-top: 50px;
}

.board-box > div:not(:first-child) {
    display: grid;
    grid-template-columns: 1fr 5fr;
    border-bottom: 1px solid #01083a;
}

.board-box > div > :first-child{
    border-right: 1px solid #01083a;
}

.board-title-box > p:first-child
,.board-img > p:first-child
, .board-content> p:first-child {
    font-size: 18px;
    text-align: center;
    font-weight: 600;
}

.board-box p, .board-title-box > input ,.board-content > textarea {
    padding: 10px;
    font-size: 17px;
}

.board-title-box {
    display: grid;
    grid-template-columns: 1fr 4fr 1fr;
    border-bottom: 1px solid #01083a;
}

.board-num {
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-left: 1px solid #01083a;
}

.board-num :first-child {
    border-right: 1px solid #01083a;
    font-weight: 600;
    font-size: 18px;
    text-align: center;
}

.board-content > textarea {
    resize: none;
    height: 300px;
    margin: 10px;
}

.board-img-content {
    padding: 10px;
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.board-img-content :nth-child(-n + 2) {
    margin-bottom: 10px;
} 

.board-img-content img {
    max-width: 150px;
    max-height: 150px;
}

.img-preview {
    display: flex;
}

.img-preview > button {
    width: 20px;
    height: 20px;
}
</style>