<template>
    <header>
        <!-- 경로표시 -->
        <div class="board-update-category">
            <h2>boardtitle    ></h2>
            <h3>category    ></h3>
            <h3>category</h3>
        </div>
    </header>
    <main>  
        <!-- 상세 글머리_정보불러오기-->
        <div class="board-update-head">
            <input type="text" id="board-update-title">
            <div class="board-update-evaluation">
                <h3 style="margin-right: 20px;">별점</h3>
                <input type="radio" class="star" value="1">
                <input type="radio" class="star" value="2">
                <input type="radio" class="star" value="3">
                <input type="radio" class="star" value="4">
                <input type="radio" class="star" value="5">
            </div>            
            <span>최초 작성일 : 2024.12.05</span>
        </div>
        <!-- 리뷰게시판(value=1)경우 검색창활성화 -->
        <input type="text" placeholder="주소 혹은 상호를 입력해 주세요">
        <button class="btn bg-navy board-search-btn">검색</button>
        <!-- 등록이미지 불러오기 -->
        <div class="board-create-file">
            <h3>파일첨부</h3>
            <input type="file" name="file" accept="imge/*">
        </div>
        <div class="board-update-img">
            <img src="../../../../../ex/img/slack.png" alt="test">
            <img src="../../../../../ex/img/slack.png" alt="test">
        </div>
        <hr>
        <!-- 내용 -->
        <div class="board-update-content">
            <textarea name="board-update-content" id="board-update-content">값불러오기</textarea>
        </div>
            <!-- 버튼영역 -->
        <div class="board-updateItem-btn"> 
            <a href="#" class="btn bg-navy board-update-btn">완료</a>
            <router-link to="/boards/update"><button class="btn bg-navy board-update-btn">취소</button></router-link>
        </div>
    </main>
</template>

<script setup>

</script>

<style scoped>
header{
    display: grid;
    grid-template-columns: 5fr 2fr;
    margin: 30px auto;
    align-items: flex-end;
}
/* main{
    position: relative;
} */
.board-update-category {
    display: flex;
    align-items: flex-end;
    column-gap: 10px;
}
.board-updateItem-btn{
    display: flex;
    align-items: flex-end;
    justify-content: center;
    column-gap: 10px;
}
.board-update-btn{
    font-size: large;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    gap: 50px;
    margin-right: 20px;
    color: #fff;
}
.board-update-head{
    display: grid;
    grid-template-columns: 7fr 2fr 2fr 1fr 1fr;
    justify-content: center;
    text-align: start;
    margin-bottom: 30px;
    align-items: flex-end;
}
.board-update-head>button{
    border: none;
    background: transparent;
}
.board-search-btn{
    font-size: large;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-left: -60px;
}
#board-update-title{
    border: none;
    border-bottom: double #01083a 5px;
    text-align: left;
    font-weight: 600;
    font-size: 1.5rem;
}
.board-update-img{
    display: grid;
    grid-template-columns: 1fr 1fr;
    margin: 10px 30px;
    padding: 10px;
    justify-content: center;
    align-items: center;
    
}
.board-update-content{
    padding: 20px;
    width: 90%;
    min-height: 500px;
    max-height: 1000px;
}

/* @media(max-width: 800px){
    .board-update-head{
        flex-wrap: wrap;
        flex-direction: column; 
        align-items: flex-start; 
    }
} */
@media(max-width:800px){
    
    /* .board-update-head {
        grid-template-columns: 1fr;  한 줄로 정렬 
        grid-template-rows: repeat(5, auto);  각 요소가 한 줄씩 차지 
        justify-items: center;  요소를 가운데 정렬 
        text-align: center;
        gap: 10px;
   }  */
    .board-update-head {
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
    /* .board-update-btn{
        display: grid;
        grid-template-columns: 1fr 1fr    
    } */
    .board-update-img{
        max-width: 600px;

    }
    .board-update-reply{
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