<template>
    <div class="container">
        <!-- 경로표시 -->
        <h1>FAQ</h1>
        <!-- 버튼영역 -->
        <div class="header-btn-box"> 
            <button class="btn bg-navy header-btn" @click="updateConfirm">수정</button>
            <button class="btn bg-navy header-btn" @click="deleteConfirm">삭제</button>
        </div>
        <div class="board-box">  
            <div class="">
                <!-- 상세 글머리_정보불러오기-->
                <h1>타이틀</h1>
                <div class="question-detail-head">
                    <span>작성자 : 닉네임</span>
                    <span>2024.12.05</span>
                </div>
            </div>
            
            <!-- 등록이미지 불러오기 -->
            <div class="question-detail-img">
                <img src="../../../../../ex/img/내(신발).png" alt="test">
                <img src="../../../../../ex/img/slack.png" alt="test">
            </div>
            <hr>
            <!-- 내용 -->
            <div class="question-detail-content">
                <span>loem</span>
            </div>
            <hr>
            <!-- 댓글 -->
            <div class="question-reply-container">
                <div class="question-detail-reply ">
                    <span>댓글</span>
                    <input type="text" maxlength="100" placeholder="소통하고 싶은 글이 있다면 남겨 주세요">
                    <button class="btn bg-navy question-detail-btn">작성</button>
                    <span>총 댓글 : </span>
                    <!-- {{ 댓글수[0] }} -->
                </div>
                <hr>
                <div class="question-detail-replyList">
                    <div class="replyList-head">
                        <span>내용</span>
                        <span>닉네임</span>
                        <span>작성일시</span>
                    </div>
                    
                </div>
            </div>

        </div>
        
    </div>
</template>

<script setup>
import { onBeforeMount } from 'vue';
import router from '../../../js/router'
// // 비포마운트처리
// onBeforeMount(()=>{
//     console.log('')
// })
const updateConfirm = () => {
    const userResponse = confirm('해당 글을 수정 하시겠습니까?');
        if (userResponse) {
        router.push('/boards/question/update');
    }
}

const deleteConfirm = () => {
    const userResponse = confirm('해당 글을 삭제 하시겠습니까?\n 삭제 시 게시글을 되돌릴 수 없습니다');
        if (userResponse) {
        router.push('/boards/question');
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
    /* gap: -200px; */
    margin-right: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.board-box {
    
}

.question-detail-category {
    display: flex;
    align-items: flex-end;
    column-gap: 10px;
}
.question-detailItem-btn{
    display: flex;
    align-items: flex-end;
    justify-content: center;
    width: 100%;
    column-gap: 10px;
    float: right;
}
.question-detail-head{
    display: grid;
    grid-template-columns: 7fr 2fr 1.5fr 1fr 1fr 1fr;
    justify-content: center;
    text-align: start;
    margin-bottom: 30px;
    align-items: flex-end;
}
.question-detail-head>button{
    border: none;
    background: transparent;
    font-size: 1.2rem;
}
.question-detail-img{
    display: grid;
    grid-template-columns: 1fr 1fr;
    margin: 20px;
    padding: 10px;
    justify-content: center;
    align-items: center;
    width: 100%;
    max-height: 300px;
}
.question-detail-img>img{
    display: block;
    margin: 0 auto;
    border-radius: 20px;
    max-width: 450px;
    max-height: 270px;
}
.question-detail-content{
    min-height: 70px;
    padding: 20px 30px;
}
.question-detail-replyList{
    /*width: 100%;
    position: relative;
    display: grid;
    gap: 10px;
    /* margin-left: 20px;    
    gap: 30px;  */
    display: grid;
    grid-template-rows: repeat(1fr);
    row-gap: 10px;
}
.question-detail-replyList:nth-last-child(1){
    padding-bottom: 10px;
    border-bottom: solid #01083a 1px;
}
.question-detail-reply{
    /* position: absolute; */
    width: 100%;
    gap: 5px;
    display: grid;
    grid-template-columns: 1fr 8fr 1fr 2fr;
    justify-content: center;
    align-items: center;
    margin: 10px ;
    font-size: 1.2rem;
    padding-left: 15px;
}
.question-detail-reply>input{
    background-color:rgba(236, 236, 236, 0.575);
    height: 30px;
    border-radius: 10px;
    padding-left: 10px;
}
.question-detail-reply>button{
    margin-left: -30px;
}
.replyList-head, .replyList{
    width: 100%;
    display: grid;
    grid-template-columns: 7fr 1fr 1.5fr;
    align-items: center;
}
.replyList-head{
    height: 40px;
    font-weight: 700;
    border-bottom: solid #071055b9 1px;
}
.replyList{
    padding-left: 25px;
}
.replyList-head:nth-child(1), .replyList>span:nth-child(2), .replyList>span:nth-child(3){
    text-align: center;
}
.pagination {
    /* margin: 0 auto; */
    /* text-align: center; */
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

.pagination button {
    font-size: 20px;
    border-radius: 50px;
    width: 40px;
    height: 40px;
    /*  */
    /* border: 2px solid #01083a; */
    text-align: center;
}

.pagination button:hover, .pagination button:active {
    color: #fff;
    background: #01083a;
}
/* @media(max-width: 800px){
    .board-detail-head{
        flex-wrap: wrap;
        flex-direction: column; 
        align-items: flex-start; 
    }
} */
@media(max-width:800px){
    
    /* .board-detail-head {
        grid-template-columns: 1fr;  한 줄로 정렬 
        grid-template-rows: repeat(5, auto);  각 요소가 한 줄씩 차지 
        justify-items: center;  요소를 가운데 정렬 
        text-align: center;
        gap: 10px;
   }  */
    .question-detail-head {
        display: flex; /* Flexbox로 전환 */
        grid-row: span 3;
        grid-column: span 1;
        flex-direction: column; /* 세로 정렬 */
        align-items: center; /* 가로 중앙 정렬 */
        text-align: center; /* 텍스트 중앙 정렬 */
        gap: 10px; /* 요소 간 간격 */
    }

    /* header{
        display: grid;
        grid-template-rows: 1fr 1fr;
    } */
    /* .board-detail-btn{
        display: grid;
        grid-template-columns: 1fr 1fr    
    } */
    .question-detail-img{
        max-width: 600px;

    }
    .question-detail-reply{
        width: 800px;
        max-width: 1200px;
        display: grid;
        grid-template-columns: 1fr 9fr 2fr;
        align-items: center;    
        gap: 30px; 
        margin: 50px auto;
    }
    .replyList{
        width: 800px;
        display: grid;
        grid-template-columns: 7fr 1fr 1.5fr;
        align-items: center;    
        gap: 30px; 
        margin: 50px auto;
    }

}
</style>