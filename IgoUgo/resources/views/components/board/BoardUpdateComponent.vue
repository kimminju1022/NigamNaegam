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
                <button class="btn bg-clear board-update-btn" @click="updateConfirm">취소</button>
                <a href="#" class="btn bg-navy board-update-btn"><p>완료</p></a>
            </div>  
        </div>

        <div class="board-update-head">
            <select name="" id="">
                <option  disabled hidden selected></option>
                <option value="0">리뷰게시판</option>
                <option value="1">자유게시판</option>
            </select>

           <div class="board-update-evaluation">
                <h3>선택업체명</h3>
                <button @click="openModal" class="btn bg-navy board-search-btn">검색</button>
                <!-- 모달검색 -->
                <!-- modal -->
                <div v-show="modalFlg" class="board-searchContainer">
                    <div class="searchItem">
                        <input type="text">
                        <hr>
                        <p>내용</p>
                        <hr>
                        <div class="et-box">
                            <span>작성자</span>
                            <button @click="closeModal">닫기</button>
                        </div>
                    </div>
                </div>
                <!--모달 팝업-->
                
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
import router from '../../../js/router';

const updateConfirm = () => {
    const userResponse = confirm('수정 페이지에서 벗어납니다. 수정을 취소하시겠습니까?');
    if (userResponse) {
        router.push('/boards/detail');
    } else {
        alert('수정을 계속 진행합니다.');
    }
}
// 모달
const modal = document.querySelector('.modal');
const modalOpen = document.querySelector('.modal_btn');
const modalClose = document.querySelector('.close_btn');

//열기 버튼을 눌렀을 때 모달팝업이 열림
modalOpen.addEventListener('click',function(){
    modal.style.display = 'block';
});
//닫기 버튼을 눌렀을 때 모달팝업이 닫힘
modalClose.addEventListener('click',function(){
    modal.style.display = 'none';
});
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
@media screen and (max-width:800px){
    
    /* .board-update-head {
        grid-template-columns: 1fr;  한 줄로 정렬 
        grid-template-rows: repeat(5, auto);  각 요소가 한 줄씩 차지 
        justify-items: center;  요소를 가운데 정렬 
        text-align: center;
        gap: 10px;
   }  */
    .board-update-head {
        /* display: flex; /* Flexbox로 전환 */
        /* grid-template-rows: repeat(4, 1fr); */
        /* grid-column: span 3; */
        display: grid; /* Grid 활성화 */
        grid-template-rows: repeat(4, auto); /* 4줄로 분할 */
        flex-direction: column;
        align-items:center; 
        text-align: center; 
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
        max-width: 300px;
        display: grid;
        grid-template-rows: repeat(2, 1fr);
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
    /* 모달 */
    .modal_btn {
    display: block;
    margin: 40px auto;
    padding: 10px 20px;
    background-color: royalblue;
    border: none;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    transition: box-shadow 0.2s;
    }
    .modal_btn:hover {
        box-shadow: 3px 4px 11px 0px #00000040;
    }

    /*모달 팝업 영역 스타일링*/
    .modal {
        display: none; /*평소에는 보이지 않도록*/
        position: absolute;
        top:0;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        background: rgba(0,0,0,0.5);
    }
    .modal.on {
        display: block;
    }
    .modal .modal_popup {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background: #ffffff;
        border-radius: 20px;
    }
    .modal .modal_popup .close_btn {
        display: block;
        padding: 10px 20px;
        background-color: rgb(116, 0, 0);
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        transition: box-shadow 0.2s;
    }
}
</style>