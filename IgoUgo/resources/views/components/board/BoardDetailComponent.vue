<template>
    <header>
        <!-- 경로표시 -->
        <div class="board-detail-category">
            <h2>boardtitle    ></h2>
            <h3>category    ></h3>
            <h3>category</h3>
        </div>
        <!-- 버튼영역 -->
        <div class="board-detailItem-btn"> 
            <button class="btn bg-navy board-detail-btn" @click="detailConfirm">수정</button>
            <button class="btn bg-navy board-detail-btn" @click="deleteConfirm">삭제</button>
        </div>
    </header>
    <main>  
        <!-- 상세 글머리_정보불러오기-->
        <h1>타이틀</h1>
        <div class="board-detail-head">
            <p>★★★☆☆</p>
            <span>작성자 : 닉네임</span>
            <span>2024.12.05</span>
            <button>💗  :</button>
            <!-- <span> {{ loveIt[0] }}</span> -->
            <span>조회 : </span>
            <!-- {{ absolve[1]++ }} -->
            <button>🚨 신고</button>
        </div>
        
        <!-- 등록이미지 불러오기 -->
        <div class="board-detail-img">
            <img src="../../../../../ex/img/내(신발).png" alt="test">
            <img src="../../../../../ex/img/slack.png" alt="test">
        </div>
        <hr>
        <!-- 내용 -->
        <div class="board-detail-content">
            <span>loem</span>
        </div>
        <hr>
        <!-- 댓글 -->
        <div class="board-reply-container">
            <div class="board-detail-reply ">
                <span>댓글</span>
                <input type="text" maxlength="100" placeholder="소통하고 싶은 글이 있다면 남겨 주세요">
                <button class="btn bg-navy board-detail-btn">작성</button>
                <span>총 댓글 : </span>
                <!-- {{ 댓글수[0] }} -->
            </div>
            <hr>
            <div class="board-detail-replyList">
                <div class="replyList-head">
                    <span>내용</span>
                    <span>닉네임</span>
                    <span>작성일시</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름1</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름2</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름3</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름1</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름2</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름3</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
                <div class="replyList">
                    <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름</span>
                    <span>놀라핑</span>
                    <span>24.12.10</span>
                </div>
            </div>
            <!-- 페이지네이션 -->
        </div>
        <div class="pagination">
            <a href="#"><button class="btn bg-clear"><</button></a>
            <a href="#"><button class="btn bg-clear">1</button></a>
            <a href="#"><button class="btn bg-clear">2</button></a>
            <a href="#"><button class="btn bg-clear">3</button></a>
            <a href="#"><button class="btn bg-clear">4</button></a>
            <a href="#"><button class="btn bg-clear">5</button></a>
            <a href="#"><button class="btn bg-clear">></button></a>
        </div>
        
    </main>
    </template>

<script setup>
import { onBeforeMount } from 'vue';
import router from '../../../js/router'
// // 비포마운트처리
// onBeforeMount(()=>{
//     console.log('')
// })
const detailConfirm = () => {
    const userResponse = confirm('해당 글을 수정 하시겠습니까?');
      if (userResponse) {
        router.push('/boards/update');
    }
}

const deleteConfirm = () => {
    const userResponse = confirm('해당 글을 삭제 하시겠습니까?\n 삭제 시 게시글을 되돌릴 수 없습니다');
      if (userResponse) {
        router.push('/boards');
    }
}
</script>

<style scoped>
hr{
    border: solid #01083a 1px;
}
header{
    display: grid;
    grid-template-columns: 5fr 2fr;
    margin: 30px auto;
    align-items: flex-end;
}
.board-detail-category {
    display: flex;
    align-items: flex-end;
    column-gap: 10px;
}
.board-detailItem-btn{
    display: flex;
    align-items: flex-end;
    justify-content: center;
    width: 100%;
    column-gap: 10px;
    float: right;
}
.board-detail-btn{
    font-size: large;       
    border-radius: 20px;
    width: 70px;
    height: 30px;
    gap: -200px;
    margin-right: 20px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}
.board-detail-head{
    display: grid;
    grid-template-columns: 7fr 2fr 1.5fr 1fr 1fr 1fr;
    justify-content: center;
    text-align: start;
    margin-bottom: 30px;
    align-items: flex-end;
}
.board-detail-head>button{
    border: none;
    background: transparent;
    font-size: 1.2rem;
}
.board-detail-img{
    display: grid;
    grid-template-columns: 1fr 1fr;
    margin: 20px;
    padding: 10px;
    justify-content: center;
    align-items: center;
    width: 100%;
    max-height: 300px;
}
.board-detail-img>img{
    display: block;
    margin: 0 auto;
    border-radius: 20px;
    max-width: 450px;
    max-height: 270px;
}
.board-detail-content{
    min-height: 70px;
    padding: 20px 30px;
}
.board-detail-replyList{
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
.board-detail-replyList:nth-last-child(1){
    padding-bottom: 10px;
    border-bottom: solid #01083a 1px;
}
.board-detail-reply{
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
.board-detail-reply>input{
    background-color:rgba(236, 236, 236, 0.575);
    height: 30px;
    border-radius: 10px;
    padding-left: 10px;
}
.board-detail-reply>button{
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
    .board-detail-head {
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
    .board-detail-img{
        max-width: 600px;

    }
    .board-detail-reply{
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