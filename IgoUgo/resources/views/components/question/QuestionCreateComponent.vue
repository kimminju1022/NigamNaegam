<template>
    <div class="container">
        <h1>문의게시판</h1>
        <div class="header-btn-box"> 
            <button @click="$store.dispatch('question/storeQuestion', question)" class="btn bg-navy header-btn">완료</button>
            <router-link :to="'/questions'"><button @click="" class="btn bg-navy header-btn">취소</button></router-link>
        </div>
        <div class="board-box">  
            <div class="board-title-box">
                <p>제목</p>
                <input v-model="question.board_title" type="text" name="board_title">
            </div>
            <div class="board-img">
                <p>파일 첨부</p>
                <div class="board-img-content">
                    <input @change="setFile1" type="file" name="board_img1" accept="image/*">
                    <input @change="setFile2" type="file" name="board_img2" accept="image/*">
                    <div class="img-preview">
                        <img :src="preview1">
                        <button @click="clearFile1" v-show="preview1" class="btn bg-clear">X</button>
                    </div>
                    <div class="img-preview">
                        <img :src="preview2">
                        <button @click="clearFile2" v-show="preview2" class="btn bg-clear">X</button>
                    </div>
                </div>
            </div>
            <div class="board-content">
                <p>내용</p>
                <textarea v-model="question.board_content" name="board_content"></textarea>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';

const question = reactive({
    board_title: ''
    ,board_content: ''
    ,board_img1: null
    ,board_img2: null
});

const preview1 = ref('');
const preview2 = ref('');

const setFile1 = (e) => {
    question.file1 = e.target.files[0];
    preview1.value = URL.createObjectURL(question.file1);
}

const setFile2 = (e) => {
    question.file2 = e.target.files[0];
    preview2.value = URL.createObjectURL(question.file2);
}

const clearFile1 = () => {
    question.file1 = null;
    preview1.value = null;
}

const clearFile2 = () => {
    question.file2 = null;
    preview2.value = null;
}


// import router from '../../../js/router';


// const cancelConfirm = () =>{
//     const userResponse = confirm('작성 페이지에서 벗어납니다. 작성을 취소하시겠습니까?');
//     if (userResponse) {
//         router.push('/boards/question');
//     }
// }
// const doneConfirm = () =>{
//     const userResponse = confirm('작성을 완료하시겠습니까?');
//     if (userResponse) {
//         router.push('/boards/question/detail');
//         // 이때, post로 정보 전달해줘야함...어떻게?
//     }
// }

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

.header-btn:hover{
    color: #01083a;
    background-color: #fff;
    border: 2px solid #01083a;
}

.board-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    margin-top: 50px;
}

.board-box > div {
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
    font-size: 20px;
    text-align: center;
    font-weight: 600;
}

.board-box p, .board-title-box > input ,.board-content > textarea {
    padding: 10px;
    font-size: 17px;
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