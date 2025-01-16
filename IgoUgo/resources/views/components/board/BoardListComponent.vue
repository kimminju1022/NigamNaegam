<template>
    <h2 style="margin: 30px 0; font-size: 3rem;">
        <!-- {{ bcName }} »  -->
        {{ bcName }} 
        <!-- {{ selectArea }} -->
    </h2>
    <!-- <div class="board-head">
        <div class="board-selectType">
            <h3>유형</h3>
            <select v-model="boardInfo.rc_type" name="rc_type" class="board-category">
                <option value="0">숙박</option>
                <option value="1">맛집</option>
                <option value="2">관광</option>
                <option value="3">문화</option>
                <option value="4">레포츠</option>
                <option value="5">쇼핑</option>
            </select>
            
            <h3>지역</h3>
            <select v-model="boardInfo.area_code" name="area_code" class="board-category">
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
            
        </div>
        <div id="board-search-tb">
            <input class="board-search" type="text" placeholder="검색어를 입력해 주세요">
            <button class="btn bg-navy board-search-btn">검색</button>
        </div>
    </div> -->
    
<!-- 리스트항목 -->
    <div class="board-list">
        <!-- 리스트 헤드 -->
        <div class="board-li-title" :class="gridClass" >
            <p>번호</p>
            <p v-if="$store.state.board.bcCode === '0'">지역</p>
            <p>제목</p>
            <p>닉네임</p>
            <p>작성일자</p>
            <p>좋아요</p>
            <p>조회수</p>
        </div>
        
        <!-- [관리자] 리스트 목록 -->
        <div>
            <div class="board-li-notice" >
                <div class="board-li-item" :class="gridClass">
                    <p v-if="$store.state.board.bcCode === '0'">5</p>
                    <!-- v-show="$store.state.board.bcCode === 0" -->
                    <p>공지</p>
                    <p class="board-li-innertitle">12월 여행 주의 사항</p>
                    <p>라라핑</p>
                    <p>2024.12.11</p>
                    <p>-</p>
                    <p>50</p>
                </div>
                <div class="board-li-item" :class="gridClass">
                    <p v-if="$store.state.board.bcCode === '0'"p>4</p>
                    <p>공지</p>
                    <p class="board-li-innertitle">11월 단풍놀이 명소 전국 Top 20</p>
                    <p>차나핑</p>
                    <p>2024.11.11</p>
                    <p>-</p>
                    <p>50</p>
                </div>
                <div class="board-li-item" :class="gridClass">
                    <p v-if="$store.state.board.bcCode === '0'">3</p>
                    <p>공지</p>
                    <p class="board-li-innertitle">11월 여행 주의 사항</p>
                    <p>라라핑</p>
                    <p>2024.11.11</p>
                    <p>-</p>
                    <p>30</p>
                </div>
                <div class="board-li-item" :class="gridClass">
                    <p v-if="$store.state.board.bcCode === '0'">2</p>
                    <p>공지</p>
                    <p class="board-li-innertitle">전국 여행자랑~ 여행자협회와 함께하는 여행후기 공모전</p>
                    <p>믿어핑</p>
                    <p>2024.11.01</p>
                    <p>-</p>
                    <p>50</p>
                </div>
                <div class="board-li-item" :class="gridClass">
                    <p v-if="$store.state.board.bcCode === '0'">1</p>
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
                <div  class="board-li-item" :class="gridClass" v-for="item in boardList" :key="item">
                    <p>{{ item.board_id }}</p>
                    <p v-if="$store.state.board.bcCode === '0'">{{ item.area_name }}</p>
                    <!-- <router-link v-if="$store.state.board.bcCode === '1'" :to="`/boards/${item.board_id}`" @click="$store.commit('pagination/setPaginationInitialize')" class="{'grid-4': $store.state.board.bcCode === '2', 'grid-5': $store.state.board.bcCode === '1'}">{{ item.board_title }}</router-link> -->
                    <router-link :to="`/boards/${item.board_id}`" @click="$store.commit('pagination/setPaginationInitialize')" class="board-li-innertitle">{{ item.board_title }}</router-link>
                    <p>{{ item.user_nickname }}</p>
                    <p>{{ item.created_at }}</p>
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

const gridClass = computed(() => {
    return store.state.board.bcCode === '0' ? 'grid-7' : 'grid-6';
});

// const boardInfo = reactive({
//     board_title: ''
//     ,board_content: ''
//     ,board_img1: null
//     ,board_img2: null
//     ,bc_code: ''
//     ,area_code: ''
//     ,rc_type: ''
//     ,rate: ''
//     ,
// });

// // -------------------------------
// 페이지네이션 관련
const actionName = 'board/getBoardListPagination';
const searchData = reactive({
    page: store.state.pagination.currentPage,
    bc_code: store.state.board.bcCode,
});
watch(
    () => store.state.board.bcCode,
    (newVal) => {
        searchData.bc_code = newVal;
    }
);
// -------------------------------

// beforemount
onBeforeMount(async () => {
    // console.log('나온다아아아아앙')
    // 백앤드로 요청 보내는 액션메소드
    // if(boardList.value.length === 0){
        store.dispatch('board/getBoardListPagination', searchData);
    // }
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
.pagination-btn{
    display: inline-block;
    width: 100%;
} 

.board-head{
    display: flex;
    justify-content: space-between;
    grid-template-columns: 5fr 4fr;
    align-items: center;    
    gap: 30px; 
    margin: 20px auto;
    min-width: 800px;
}

.board-category{
    border: none;
    border-bottom: solid 1px #01083a;
    margin: 20px 20px;
    gap: 30px;
}
.board-selectType{
    display: flex;
    justify-content: left;
    grid-template-columns: repeat(2, 1fr 2fr);
    align-items: center; 
    text-align: center;   
    gap: 10px; 
}
/* .board-category{
    width: 200px;
    height: 30px;
    border: none;
    border-bottom: solid 1px #01083a;
    text-align: center;
    margin-left: 30px;
} */

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
/* 리스트 항목----------- */
.board-li-notice {
    /* display: inline-block; */
    font-weight: 500;
    font-size: 1.2rem;
    background-color: #eeeeeec0;
    width: 100%;
    padding: 10px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.board-li-innertitle{
    text-align: left;
    overflow-wrap: normal;
    word-break: break-word;
    text-decoration: none;
    display: inline-block;
    color: #000;
    padding: 0 10px;
    text-align: left;
    white-space: nowrap; /* 줄바꿈 금지 */
    overflow: hidden; /* 초과 텍스트 숨김 */
    text-overflow: ellipsis; /* 말줄임 효과 */
    width: 100%; /* 고정 너비 */
}
.board-li-item{
    width: 100%;
    /* height: 40px; */
    margin-top: 20px;
}
.board-li-item > p {
    width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    gap:10px
}
.grid-6{
    display: grid;
    grid-template-columns: 1fr 5fr 1.5fr 2fr 1fr 1fr;
    text-align: center;
    width: 100%;
}

.grid-7{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1.5fr 2fr 1fr 1fr;
    text-align: center;
    width: 100%;
}

.board-list{
    height: auto;
    width: 100%;
    /* justify-content: center;
    align-content: center; */
}

.board-li-title{
font-weight: 600;
font-size: 1.5rem;
padding-bottom: 5px;
border-bottom: double #01083a 5px;
overflow: hidden;
width: 100%;
height: 40px;
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