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
        <div class="board-update-detail">
            <!-- 상세 글머리_정보불러오기-->
            <input type="text" id="board-update-title">
            <!-- 버튼영역 -->
            <div class="board-updateItem-btn"> 
                <router-link to="/boards"><button class="btn bg-clear board-update-btn">목록</button></router-link>
                <router-link to="/boards/update"><button class="btn bg-clear board-update-btn">취소</button></router-link>
                <a href="#" class="btn bg-navy board-update-btn">완료</a>
            </div>  
        </div>

        <div class="board-update-head">
            <select name="" id="">
                <option  disabled hidden selected>확인게시글</option>
                <option value="0">리뷰게시판</option>
                <option value="1">자유게시판</option>
            </select>

           <div class="board-update-evaluation">
                <h3>선택업체명</h3>
                <button class="btn bg-navy board-search-btn">검색</button>
                <!-- 모달검색 -->

                <!-- 별점 -->
                <div class="star-update">
                    <h3 style="margin-right: 20px;">별점</h3>
                    <input type="radio" class="star" value="1">
                    <input type="radio" class="star" value="2">
                    <input type="radio" class="star" value="3">
                    <input type="radio" class="star" value="4">
                    <input type="radio" class="star" value="5">
                </div>
            </div>            
            <span>최초 작성일 : 2024.12.05</span>
        </div>
        <!-- 리뷰게시판(value=1)경우 검색창활성화 -->
       
        <!-- 내용 -->
        <textarea name="board-update-content" id="board-update-content">값불러오기</textarea>
        <hr>
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
.board-update-detail{
    display: grid;
    grid-template-columns: 7fr 3fr;
    justify-content: center;
    text-align: start;
    align-items: flex-end;
    column-gap: 20px;
    padding-bottom: 10px;
    margin: 20PX auto;
    border-bottom: double #01083a 3px;
}
 .board-update-evaluation{
    display: grid;
    grid-template-columns: 7fr 2fr 4fr;
    justify-content: center;
    text-align: start;
    /* margin-bottom: 30px; */
    align-items: flex-end;
    column-gap: 20px;
 }

.board-update-category, .board-create-file {
    display: flex;
    align-items: flex-end;
    column-gap: 20px;
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
    border: solid 1px #01083a;
    width: 70px;
    height: 30px;
    gap: 50px;
    margin-right: 20px;    
}
.board-update-head{
    display: grid;
    grid-template-columns: 1fr 6fr 2fr;
    justify-content: center;
    text-align: start;
    margin-bottom: 30px;
    padding-bottom: 20px;
    align-items: flex-end;
    column-gap: 20px;
    border-bottom: solid #01083a 1px;
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
    text-align: left;
    font-weight: 600;
    font-size: 1.5rem;
    width: 100%;
    padding-left: 10px;
}
.star-update{
        display: flex;
        justify-content: center;
        align-items: center;
}
.board-update-img{
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    margin: 10px 30px;
    padding: 10px;
    justify-content: center;
    align-items: center;
}
#board-update-content{
    padding: 20px;
    width: 90%;
    min-height: 300px;
    height: 500px;
    /* vertical-align: baseline;   */
    box-sizing: content-box;  
    /* resize: none; */
    position: relative;
    -webkit-text-size-adjust: none;
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
    .star-update{
        display: flex;
        justify-content: center;
        align-items: center;
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