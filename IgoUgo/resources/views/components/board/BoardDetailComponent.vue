<template>
    <header>
        <!-- 경로표시 -->
        <div class="board-detail-category">
            <h2>boardtitle    ></h2>
            <h3>category    ></h3>
            <h3>category</h3>
        </div>
        <!-- 버튼영역 -->
        <div class="board-detail-btn">
            <a href="#" class="board-btn">수정</a>
            <a href="#" class="board-btn">삭제</a>
        </div>
    </header>
    <main>  
        <!-- 상세 글머리_정보불러오기-->
        <div class="board-detail-head">
            <h1>타이틀</h1>
            <p>★★★☆☆</p>
            <span>작성자 : 닉네임</span>
            <span>2024.12.05</span>
            <button>🚨 신고</button>
        </div>
        
        <!-- 등록이미지 불러오기 -->
         <div class="board-detail-img">
            <img src="../../../../../ex/img/slack.png" alt="test">
            <img src="../../../../../ex/img/slack.png" alt="test">
         </div>
         <hr>
         <!-- 내용 -->
        <div>
            <span>내용</span>
            <p>happy</p>
        </div>
         <!-- 댓글 -->
         <div class="board-detail-reply ">
            <span>댓글</span>
            <input type="text" maxlength="100" placeholder="소통하고 싶은 글이 있다면 남겨 주세요">
            <button class="board-btn">작성</button>
         </div>
         <div class="board-detail-replyList">
            <div class="replyList">
                <span>내용</span>
                <span>닉네임</span>
                <span>작성일시</span>
            </div>
            <div class="replyList">
                <span>여기 가보고 깜짝 놀라 자지러지듯 소리지름</span>
                <span>놀라핑</span>
                <span>24.12.10</span>
            </div>
         </div>


    </main>
    </template>

<script setup>

</script>

<style>
header{
    display: grid;
    grid-template-columns: 5fr 2fr;
    margin-top: 20px;
    margin-bottom: 30px;
    align-items: flex-end;
}
.board-detail-category{
    display: flex;
    align-items: flex-end;
    column-gap: 10px;
}
.board-detail-btn{
    gap: 20px;
    /* align-items: flex-end; */

}
.board-btn{
    /*  왜 넓이지정 안되지? */
    background-color: #01083a;
    border-radius: 15px;
    padding: 5px;
    font-weight: 500;
    color: #fff !important;
    width: 70px;
    margin-right: 20px;
}
.board-detail-head{
    display: grid;
    grid-template-columns: 7fr 2fr 2fr 1fr 1fr;
    justify-content: center;
    text-align: start;
    margin-bottom: 30px;
    align-items: flex-end;
}
.board-detail-head>button{
    border: none;
    background: transparent;
}
/* @media(max-width: 800px){
    .board-detail-head{
        flex-wrap: wrap;
        flex-direction: column; 
        align-items: flex-start; 
    }
} */
.board-detail-reply{
    width: 800px;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    align-items: center;    
    gap: 30px; 
    margin: 50px auto;
}
.replyList{
    min-width: 800px;
    width: 1200px;
    display: grid;
    grid-template-columns: 7fr 1fr 1.5fr;
    align-items: center;    
    gap: 30px; 
    margin: 20px auto;
    border-bottom: solid #01083a 1px;
}
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