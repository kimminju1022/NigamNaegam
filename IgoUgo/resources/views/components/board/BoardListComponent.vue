<template>
    <h2 style="margin: 30px 0; font-size: 3rem;">
        <!-- {{ bcName }} »  -->
        {{ bcName }} »
        <!-- {{ selectArea }} -->
    </h2>
    <div class="board-head">
        <div class="board-category">
            <div v-show="boardInfo.bc_type === '0'" class="board-selectType">
                <h3 class="board-category">유형
                    <select v-model="boardInfo.rc_type" name="rc_type" class="board-category">
                        <option disabled hidden selected>--유형선택--</option>
                        <option value="0">숙박</option>
                        <option value="1">맛집</option>
                        <option value="2">관광</option>
                        <option value="3">문화</option>
                        <option value="4">레포츠</option>
                        <option value="5">쇼핑</option>
                    </select>
                </h3>
                <h3 class="board-category">지역
                    <select v-model="boardInfo.area_code" name="area_code" class="board-category">
                        <option disabled hidden selected>--지역선택--</option>
                        <option value="1">서울</option>
                        <option value="2">인천</option>
                        <option value="3">대전</option>
                        <option value="4">대구</option>
                        <option value="5">광주</option>
                        <option value="6">부산</option>
                        <option value="7">울산</option>
                        <option value="8">세종</option>
                        <option value="31">경기</option>
                        <option value="32">강원</option>
                        <option value="33">충북</option>
                        <option value="34">충남</option>
                        <option value="35">경북</option>
                        <option value="36">경남</option>
                        <option value="37">전북</option>
                        <option value="38">전남</option>
                        <option value="39">제주</option>
                    </select>
                </h3>
            </div>
        </div>
        <div id="board-search-tb">
            <!--  v-model="keyword" -->
            <input class="board-search" type="text" placeholder="검색어를 입력해 주세요">
            <!-- @click="keywordSearch"  -->
            <button class="btn bg-navy board-search-btn">검색</button>
        </div>
    </div>
    
<!-- 리스트항목 -->
    <div class="board-list">
        <!-- 리스트 헤드 -->
        <div class="board-li-title">
            <p>번호</p>
            <p v-show="$store.state.board.bcType === 0">지역</p>
            <p>제목</p>
            <p>닉네임</p>
            <p>작성일자</p>
            <p>좋아요</p>
            <p>조회수</p>
        </div>
        <!-- [관리자] 리스트 목록 -->
        <div>
            <div id="board-li-notice" >
                <div id="board-li-item">
                    <p>5</p>
                    <!-- v-show="$store.state.board.bcType === 0" -->
                    <p>공지</p>
                    <p class="board-li-innertitle">12월 여행 주의 사항</p>
                    <p>라라핑</p>
                    <p>2024.12.11</p>
                    <p>-</p>
                    <p>50</p>
                </div>
                <div id="board-li-item">
                    <p>4</p>
                    <p>공지</p>
                    <p class="board-li-innertitle">11월 단풍놀이 명소 전국 Top 20</p>
                    <p>차나핑</p>
                    <p>2024.11.11</p>
                    <p>-</p>
                    <p>50</p>
                </div>
                <div id="board-li-item">
                    <p>3</p>
                    <p>공지</p>
                    <p class="board-li-innertitle">11월 여행 주의 사항</p>
                    <p>라라핑</p>
                    <p>2024.11.11</p>
                    <p>-</p>
                    <p>30</p>
                </div>
                <div id="board-li-item">
                    <p>2</p>
                    <p>공지</p>
                    <p class="board-li-innertitle">전국 여행자랑~ 여행자협회와 함께하는 여행후기 공모전</p>
                    <p>믿어핑</p>
                    <p>2024.11.01</p>
                    <p>-</p>
                    <p>50</p>
                </div>
                <div id="board-li-item">
                    <p>1</p>
                    <p>공지</p>
                    <p class="board-li-innertitle">10월 여행 주의 사항</p>
                    <p>차캐핑</p>
                    <p>2024.12.11</p>
                    <p>-</p>
                    <p>30</p>
                </div>
            </div>

            <!-- [유저] 리스트 시작 -->
            
            <div class="board-list" >
                <div  id="board-li-item" v-for="item in boardList" :key="item">
                    <p>{{ item.board_id }}</p>
                    <!-- v-if="item.board_type === 1" hidden -->
                    <p >{{ item.area_name }}</p>
                    <router-link :to="`/boards/${item.board_id}`" @click="$store.commit('pagination/setPaginationInitialize')" class="board-li-innertitle">{{ item.board_title }}</router-link>
                    <p>{{ item.user_nickname }}</p>
                    <p>{{ item.created_at }}</p>
                    <!--  v-if="item.board_type === 1" hidden -->
                    <p>{{ item.like_cnt }}</p>
                    <p>{{ item.view_cnt }}</p>
                </div>
                </div>
        </div>
    </div>
    <!-- 하단 기능버튼 -->
    <div class="pagination-btn">
        <!-- 페이지네이션 -->
        <PaginationComponent :actionName="actionName" :searchData="searchData" />
        <router-link to="/boards/create"><button class="btn bg-navy header-bg-btn board-create-btn">작성</button></router-link>
    </div>
</template>
<script setup>

import { computed,onBeforeMount, reactive, watch } from 'vue';
import { useStore } from 'vuex'; // 스토어쓰니까 이거 선언해 줘야해
import PaginationComponent from '../PaginationComponent.vue';

const store = useStore();
// bcName
const bcName = computed(() => store.state.board.bcName);
// boardlist
const boardList = computed(() => store.state.board.boardList);

const boardInfo = reactive({
    board_title: ''
    ,board_content: ''
    ,board_img1: null
    ,board_img2: null
    ,bc_type: ''
    ,area_code: ''
    ,rc_type: ''
    ,rate: ''
});

// // -------------------------------
// 페이지네이션 관련
const actionName = 'board/getBoardListPagination';
const searchData = reactive({
    page: store.state.pagination.currentPage,
    bc_type: store.state.board.bcType,
});
watch(
    () => store.state.board.bcType,
    (newVal) => {
        searchData.bc_type = newVal;
    }
);
// -------------------------------

// beforemount
onBeforeMount(async () => {
    // console.log('나온다아아아아앙')
    // 백앤드로 요청 보내는 액션메소드
    if(boardList.value.length === 0){
        store.dispatch('board/getBoardListPagination', searchData);
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
/* 양식관련련 */
footer{
    height: 30px;
    display: inline;
}                  
.pagination-btn{
    display: inline-block;
    width: 100%;
}                                                                    
/* .scroll{
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
} */
/* ------------------------------ */
/*** Box1 스크롤바 설정 ***/
/* 스크롤바 설정*/
/* select-category::-webkit-scrollbar{
    width: 10px;
}
.select-category::-webkit-scrollbar:vertical {
    width: 10px;
}
.select-category::-webkit-scrollbar:horizontal {
    height: 10px;
}
/* 스크롤바 막대 설정*/
/* .select-category::-webkit-scrollbar-thumb{
    background-color: rgba(239, 242, 247, 0.1);
    border-radius: 10px;
    border: 2px solid #1f2845;;
}
/* 스크롤바 뒷 배경 설정*/
/* .select-category::-webkit-scrollbar-track{
    border-radius: 10px;
    background-color: #1f2845;
} */
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

/* .board-category{
    border-radius: 10px;
    height: 1.2rem;
    display: inline-flex;
    justify-content:end;
    margin: 20px 20px;
    gap: 30px;
} */
.board-category{
    width: 200px;
    border: none;
    border-bottom: solid 1px #01083a;
    text-align: center;
    margin-left: 30px;
}
/* 리스트 항목----------- */
#board-li-notice {
    font-weight: 500;
    font-size: 1.2rem;
    background-color: #eeeeeec0;
    padding: 10px;
}
/* #board-li-item>p:nth-child(3){
    text-align: left;
    overflow: hidden; */
.board-li-innertitle{
    /* text-align: left;
    white-space: normal;
    overflow-wrap: normal;
    word-break: break-word;
    text-decoration: none;
    display: inline-block;
    width: 100%; */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
    padding: 0 10px;
    text-align: left;
}
/* 검색 및 버튼---------------- */
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
.board-create-btn{
    align-items: center;
    text-align: center;
    /* margin-left: -30px; */
}
/* -------------------------- */
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