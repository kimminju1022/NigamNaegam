<template>
    <main>
        <h2 style="margin: 30px 0; font-size: 3rem;">
            {{ boardTitle.bc_name }}
        </h2>
        <div class="board-head">
            <div class="board-category">
                <select name="select-category" class="bg-clear btn select-category">
                    <option disabled hidden selected>카테고리</option>
                    <option value="0">맛집</option>
                    <option value="1">액티비티</option>
                    <option value="2">힐링</option>
                    <option value="3">쇼핑</option>       
                </select>
                <select name="select-category" class="bg-clear btn select-category">
                    <option disabled hidden selected>지역</option>
                    <option value="0">서울</option>
                    <option value="1">인천</option>
                    <option value="2">대전</option>
                    <option value="3">세종</option>        
                    <option value="4">대구</option>
                    <option value="5">광주</option>
                    <option value="6">부산</option>
                    <option value="7">울산</option>
                    <option value="8">경기</option>
                    <option value="9">강원</option>
                    <option value="10">충북</option>
                    <option value="11">충남</option>        
                    <option value="12">경북</option>
                    <option value="13">경남</option>
                    <option value="14">전북</option>
                    <option value="15">전남</option>        
                    <option value="16">제주</option>        
                </select>
            </div>
            <div id="board-search-tb">
                <input v-model="keyword" class="board-search" type="text" placeholder="검색어를 입력해 주세요">
                <button @click="keywordSearch" class="btn bg-navy board-search-btn">검색</button>
            </div>
        </div>
        
    <!-- 리스트항목 -->
        <div class="board-list">
            <!-- 리스트 헤드 -->
            <div class="board-li-title">
                <span>번호</span>
                <span>지역</span>
                <span>제목</span>
                <span>닉네임</span>
                <span>작성일자</span>
                <span>좋아요</span>
                <span>조회수</span>
            </div>
            <!-- 리스트 목록 -->
            <div class="board-li-items">
                <div id="board-li-notice" >
                    <div id="board-li-item">
                        <p>5</p>
                        <p>공지</p>
                        <p>12월 여행 주의 사항</p>
                        <p>라라핑</p>
                        <p>2024.12.11</p>
                        <p>2</p>
                        <p>50</p>
                    </div>
                    <div id="board-li-item">
                        <p>4</p>
                        <p>공지</p>
                        <p>11월 단풍놀이 명소 전국 Top 20</p>
                        <p>차나핑</p>
                        <p>2024.11.11</p>
                        <p>20</p>
                        <p>50</p>
                    </div>
                    <div id="board-li-item">
                        <p>3</p>
                        <p>공지</p>
                        <p>11월 여행 주의 사항</p>
                        <p>라라핑</p>
                        <p>2024.11.11</p>
                        <p>2</p>
                        <p>30</p>
                    </div>
                    <div id="board-li-item">
                        <p>2</p>
                        <p>공지</p>
                        <p>전국 여행자랑~ 여행자협회와 함께하는 여행후기 공모전</p>
                        <p>믿어핑</p>
                        <p>2024.11.01</p>
                        <p>2</p>
                        <p>50</p>
                    </div>
                    <div id="board-li-item">
                        <p>1</p>
                        <p>공지</p>
                        <p>10월 여행 주의 사항</p>
                        <p>차캐핑</p>
                        <p>2024.12.11</p>
                        <p>10</p>
                        <p>30</p>
                    </div>
                </div>
                <!-- 현재 리스트가 호출이 불가함함 -->
                <div v-for="item in boardList" :key="item" id="board-li-item">
                    <p>{{ item.bc_id }}</p>
                    <p>{{ item.area_name }}</p>
                    <router-link :to="'/boards/' + item.bc_id"><p>{{ item.board_title }}</p></router-link>
                    <p>{{ item.user_nickname }}</p>
                    <p>{{ item.created_at }}</p>
                    <p>{{ item.like_flg }}</p>
                    <p>{{ item.view_cnt }}</p>
                </div>
            </div>
        </div>
    </main>
<!-- 페이지네이션 -->
    <footer>
        <div class="pagination">
            <a href="#"><button class="btn bg-clear"><</button></a>
            <a href="#"><button class="btn bg-clear">1</button></a>
            <a href="#"><button class="btn bg-clear">2</button></a>
            <a href="#"><button class="btn bg-clear">3</button></a>
            <a href="#"><button class="btn bg-clear">4</button></a>
            <a href="#"><button class="btn bg-clear">5</button></a>
            <a href="#"><button class="btn bg-clear">></button></a>
        </div>
        <router-link to="/boards/create"><button class="btn bg-navy board-create-btn">작성</button></router-link>
    </footer>
</template>
<script setup>

import { computed,onBeforeMount, ref } from 'vue';
import { useStore } from 'vuex'; // 스토어쓰니까 이거 선언해 줘야해

const store = useStore();
// boardTitle
const boardTitle = computed(() => store.state.board.boardTitle);
// boardlist
const boardList = computed(() => store.state.board.boardList);


// beforemount
onBeforeMount(() => {
    // console.log('나온다아아아아앙')
    // 백앤드로 요청 보내는 액션메소드

    if(store.state.board.boardList.length<1){
        store.dispatch('board/getBoardListPagination');
    }
});

// const keyword = ref('');
/**
 * 키워드 검색 처리

const keywordSearch = () => {
    
}
 */
// return{
//     boardList,
//     keyword,
// }
</script>
<style scoped>  
footer{
    height: 30px;
    display: inline;
}                                                                                      
.scroll{
    display: inline-block;
    width: 100px;
    height: 200px;  
    padding: 20px;
    overflow-y: scroll;
    border: 1px solid black;
    box-sizing: border-box;
    color: white;
    font-family: 'Nanum Gothic';
    background-color: #01083a55;
}

/*** Box1 스크롤바 설정 ***/
/* 스크롤바 설정*/
select-category::-webkit-scrollbar{
    width: 10px;
}
.select-category::-webkit-scrollbar:vertical {
    width: 10px;
}
.select-category::-webkit-scrollbar:horizontal {
    height: 10px;
}
/* 스크롤바 막대 설정*/
.select-category::-webkit-scrollbar-thumb{
    background-color: rgba(239, 242, 247, 0.1);
    border-radius: 10px;
    border: 2px solid #1f2845;;
}
/* 스크롤바 뒷 배경 설정*/
.select-category::-webkit-scrollbar-track{
    border-radius: 10px;
    background-color: #1f2845;
}
/*  */
main{
    align-items: center;

}

.board-head{
    display: flex;
    justify-content: space-between;
    /* display: grid; */
    grid-template-columns: 2fr 7fr;
    align-items: center;    
    gap: 30px; 
    margin: 20px auto;
    min-width: 800px;
}

.board-category{
    border-radius: 10px;
    height: 1.2rem;
    display: inline-flex;
    justify-content:end;
    margin: 20px 20px;
    gap: 30px;
}

#board-li-notice {
    font-weight: 500;
    font-size: 1.2rem;
    background-color: #eeeeeec0;
    padding: 10px;
}
#board-li-item>p:nth-child(3){
    text-align: left;
    overflow: hidden;
}

#board-search-tb{
    display: inline-flex;
    /* float: right; */
    justify-content:end;
    align-items: flex-end;
}
.board-search {
    /* margin-right: -22px;  */
    border: #01083a solid 1px;
    color: #01083a;
    border-radius: 20px;
    width: 300px;
    height: 31px;
    text-indent: 20px; 
    margin-right: 30px;
}

.board-search-btn{
    font-size: large;
    float: right;
    border-radius: 20px;
    width: 70px;
    height: 32px;
}
.board-create-btn{
    float: right;
    font-size: large;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-top: -30px;
}

.board-list{
    height: auto;
    width: 100%;
    /* justify-content: center;
    align-content: center; */
}
.board-li-title{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1.5fr 1fr 1fr 1fr;
    text-align: center;
    width: 100%;
    height: 40px;
    font-weight: 600;
    font-size: 1.2rem;
    letter-spacing: 0.3rem;
    border-bottom: double #01083a 5px;
    margin-top: 20px;
}
.select-category{
    width: 100px;
    height: 30px;
    text-align: center;
    border: solid #01083a 1px;
    border-radius: 20px;
    font-size: 1.2rem;
}
.select-category>option{
    border: none;
}
#board-li-item{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1.5fr 1fr 1fr 1fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 30px;
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

@media screen and (max-width: 320px) {
    .board-li-title > span:nth-child(2),
    .board-li-title > span:nth-child(3),
    .board-li-title > span:nth-child(4) { 
        display: block; /* 2, 3, 4번째 요소만 보이게 */ 
    } 
    .board-category{
        display: flex;
        text-align: end;
    }
    .board-li-title{
        display: grid;
        grid-template-columns: 1fr 5fr 1.5fr;
    }
    .board-li-title > span {
        display: none;
    }
    .board-head{
    display: grid;
    grid-template-rows: repeat(2, 1fr);
    align-items: center;    
    gap: 30px; 
    margin: 50px auto;}

}
</style>