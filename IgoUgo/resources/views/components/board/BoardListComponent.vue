<template>
    <div class="container">
        <h1>{{ bcName }}</h1>
        <p v-if="store.state.board.bcCode === '0'" class="title-text">솔직한 리뷰를 남겨보세요!</p>
        <p v-else class="title-text">자유롭게 의견을 나누고 소통하는 공간입니다!</p>
        <div class="search-box">
            <div class="board-search-tb">
                <input v-model="searchData.search" class="board-search" type="text" placeholder="검색어를 입력해 주세요">
                <!-- <button @click="$store.dispatch('/search/board')" class="btn bg-navy board-search-btn">검색</button> -->
                <button @click="searchBoardContent" class="btn bg-navy board-search-btn">검색</button>
            </div>
        </div>

        
    <!-- 리스트항목 -->
        <!-- <div class="board-list"> -->
            <!-- 리스트 헤드 -->
            <!-- <div class="board-li-title" :class="gridClass" >
                <p>번호</p>
                <p v-if="$store.state.board.bcCode === '0'">지역</p>
                <p v-if="$store.state.board.bcCode === '0'">카테고리</p>
                <p>제목</p>
                <p>닉네임</p>
                <p>작성일자</p>
                <p>좋아요</p>
                <p>조회수</p>
            </div> -->
            
            <!-- [관리자] 리스트 목록 -->
            <!-- <div>
                <div class="board-li-notice" >
                    <div v-for="(item, index) in noticeTopList" class="board-li-item" :class="gridClass">
                        <p v-if="$store.state.board.bcCode === '0'">{{ index + 1 }}</p>
                        <p v-if="$store.state.board.bcCode === '0'">-</p> -->
                        <!-- v-show="$store.state.board.bcCode === 0" -->
                        <!-- <p class="notice-text">공지</p>
                        <router-link :to="`/notices/${item.board_id}`"><p>{{ item.board_title }}</p></router-link>
                        <p>관리자</p>
                        <p>{{ item.created_at }}</p>
                        <p>-</p>
                        <p>{{ item.view_cnt }}</p>
                    </div>
                </div> -->

                <!-- [유저] 리스트 시작 -->
<!--                 
                <div  class="board-list" >
                    <div class="board-li-item" :class="gridClass" v-for="item in boardList" :key="item">
                        <p>{{ item.board_id }}</p>
                        <p v-if="$store.state.board.bcCode === '0'">{{ item.area_name }}</p>
                        <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '12'">관광지</p>
                        <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '14'">문화시설</p>
                        <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '28'">레포츠</p>
                        <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '32'">호텔</p>
                        <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '38'">쇼핑</p>
                        <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '39'">음식점</p> -->
                        <!-- <router-link v-if="$store.state.board.bcCode === '1'" :to="`/boards/${item.board_id}`" @click="$store.commit('pagination/setPaginationInitialize')" class="{'grid-4': $store.state.board.bcCode === '2', 'grid-5': $store.state.board.bcCode === '1'}">{{ item.board_title }}</router-link> -->
                        <!-- <router-link :to="`/boards/${item.board_id}`" @click="$store.commit('pagination/setPaginationInitialize')" class="board-li-innertitle">{{ item.board_title }}</router-link>
                        <p>{{ item.user_nickname }}</p>
                        <p>{{ item.created_at }}</p>
                        <p>{{ item.like_cnt }}</p>
                        <p>{{ item.view_cnt }}</p>
                    </div>
                </div>
            </div>
        </div> -->


        <div class="board-box">
            <div class="board-title" :class="gridClassTitle">
                <p>번호</p>
                <p v-if="$store.state.board.bcCode === '0'">지역</p>
                <!-- <p v-if="$store.state.board.bcCode === '0'">카테고리</p> -->
                <p>카테고리</p>
                <p>제목</p>
                <p>닉네임</p>
                <p>작성일자</p>
                <p>좋아요</p>
                <p>조회수</p>
            </div>
            <div class="board-notice-box">
                <!-- <div v-for="(item, index) in noticeTopList" class="board-content" :class="gridClass"> -->
                <div v-for="(item, index) in noticeTopList" class="board-content" :class="gridClassNotice">
                    <p>{{ 5 - index }}</p>
                    <p v-if="$store.state.board.bcCode === '0'">-</p>
                    <!-- <p v-if="$store.state.board.bcCode === '0'">공지</p> -->
                    <p>공지</p>
                    <router-link :to="`/notices/${item.board_id}`"><p>{{ item.board_title }}</p></router-link>
                    <p>관리자</p>
                    <p>{{ item.created_at }}</p>
                    <p>-</p>
                    <p>{{ item.view_cnt }}</p>
                </div>
            </div>
            <div class="board-content-box">
                <div v-for="item in boardList" :key="item" class="board-content" :class="gridClass2">
                    <p>{{ item.board_id }}</p>
                    <p v-if="$store.state.board.bcCode === '0'">{{ item.area_name }}</p>
                    <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '12'">관광지</p>
                    <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '14'">문화시설</p>
                    <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '28'">레포츠</p>
                    <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '32'">호텔</p>
                    <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '38'">쇼핑</p>
                    <p v-if="$store.state.board.bcCode === '0' && item.contenttypeid === '39'">음식점</p>
                    <p v-if="$store.state.board.bcCode === '1'"></p>
                    <router-link :to="`/boards/${item.board_id}`" @click="$store.commit('pagination/setPaginationInitialize')">{{ item.board_title }}</router-link>
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
        <!-- <PaginationComponent :actionName="actionName" :searchData="searchData" /> -->
        <PaginationComponent
            :actionName="actionName"
            :searchData="searchData"
            :currentPage="$store.state.pagination.currentPage"
            :lastPage="$store.state.pagination.lastPage"
            :viewPageNumber="$store.state.pagination.viewPageNumber"
        />
        <router-link to="/boards/create"><button class="btn bg-navy header-bg-btn board-create-btn">작성</button></router-link>
    </div>
</template>
<script setup>

import { computed,onBeforeMount, ref, reactive, watch } from 'vue';
import { useStore } from 'vuex'; // 스토어쓰니까 이거 선언해 줘야해
import PaginationComponent from '../PaginationComponent.vue';

const store = useStore();
// bcName
const bcName = computed(() => store.state.board.bcName);
// boardlist
const boardList = computed(() => store.state.board.boardList);

// const gridClass = computed(() => {
//     return store.state.board.bcCode === '0' ? 'grid-7' : 'grid-6';
// });

/* 페이지네이션 관련------------start*/
const actionName = 'board/getBoardListPagination';
const searchData = reactive({
    page: store.state.pagination.currentPage,
    bc_code: store.state.board.bcCode,
    search: '',
});
watch(
    () => store.state.board.bcCode,
    (newVal) => {
        searchData.bc_code = newVal;
    }
);
// -------------------------------pagination_end******

// ------------- 경진 -----------------------------
const actionNameNotice = 'notice/noticeTopList';
const noticeTopList = computed(() => store.state.notice.noticeTopList);

const gridClassTitle = computed(() => {
    return store.state.board.bcCode === '0' ? 'review-title' : 'free-title';
});

const gridClassNotice = computed(() => {
    return store.state.board.bcCode === '0' ? 'review-notice' : 'free-notice';
});

const gridClass2 = computed(() => {
    return store.state.board.bcCode === '0' ? 'review-content' : 'free-content';
});
// ------------- 경진 -----------------------------

// --------------------------- meerkat Start ---------------------------
// 검색 처리
const searchBoardContent = () => {
    store.commit('pagination/setPaginationInitialize'); // pagination 초기화    
    store.dispatch(actionName, searchData);
}

// 게시판 이동시 검색어 초기화
watch(() => store.state.board.bcCode, () => {
    searchData.search = '';
});
// --------------------------- meerkat End ---------------------------

// beforemount
onBeforeMount(async () => {
    // console.log('나온다아아아아앙')
    // 백앤드로 요청 보내는 액션메소드
    // if(boardList.value.length === 0){
        store.dispatch(actionName, searchData);
    // }
    store.dispatch(actionNameNotice);

});

</script>
<style scoped> 
.container{
    align-items: center;
}

.container > h1 {
    font-size: 2rem;
    margin: 25px 0;
}

.title-text {
    font-size: 18px;
}

/* [ 순서 ]
1. 보드,페이지 관련
2. 검색색
3. 버튼 */
/* board,pagination 관련 --------------board,pagination*/             
.board-category{
    border: none;
    border-bottom: solid 1px #01083a;
    margin: 20px 20px;
    gap: 30px;
}
/* .board-category{
    width: 200px;
    height: 30px;
    border: none;
    border-bottom: solid 1px #01083a;
    text-align: center;
    margin-left: 30px;
} */
.board-selectType{
    display: flex;
    justify-content: left;
    grid-template-columns: repeat(2, 1fr 2fr);
    align-items: center; 
    text-align: center;   
    gap: 10px; 
}

.board-li-notice {
    /* display: inline-block; */
    /* font-weight: 500;
    font-size: 1.2rem; */
    background-color: #eeeeeec0;
    /* width: 100%; */
    padding: 5px;
    /* overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis; */
}

.notice-text {
    font-weight: 600;
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
    white-space: nowrap; 
    overflow: hidden; 
    text-overflow: ellipsis;
    width: 100%;
}
.board-li-item{
    width: 100%;
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
    grid-template-columns: 1fr 5fr 1fr 1fr 0.7fr 0.7fr;
    text-align: center;
    width: 100%;
}

.grid-7{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 5fr 1.5fr 1.5fr 0.7fr 0.7fr;
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
    /* margin-top: 30px; */
}

/* search 관련 --------------search*/     
.search-box {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 30px;
}        
.board-search-tb{
    display: inline-flex;
    /* float: right; */
    justify-content:end;
    align-items: flex-end;
}
.board-search {
    border: #01083a solid 1px;
    color: #01083a;
    border-radius: 20px;
    width: 300px;
    height: 31px;
    text-indent: 20px; 
    margin-right: 30px;
}

/* btn 관련 --------------btn*/             
.pagination-btn{
    display: inline-block;
    width: 100%;
} 
.board-search-btn{
    font-size: large;
    float: right;
    border-radius: 20px;
    width: 70px;
    height: 32px;
    margin-left: -60px;
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


/* --------------- 경진 start ---------------- */
.board-box{
    /* width: 100%; */
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    /* max-width: 1250px; */
    min-width: 500px;
    margin: 40px auto;
    font-size: 18px;
}

.board-notice-box {
    background-color: #eeeeee;
    padding:  5px;
}

.board-notice-box > .board-content > p:nth-child(3) {
    font-weight: 600;
}

.board-content-box {
    padding: 5px;
}

/* 리뷰게시판일 경우 */
.review-title {
    display: grid;
    grid-template-columns: 1fr 1.2fr 1.2fr 7fr 1.5fr 1.5fr 0.7fr 0.7fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 16px;
    font-weight: 600;
    border-bottom: 1px solid #01083a;
}

.review-notice{
    display: grid;
    grid-template-columns: 1fr 1.2fr 1.2fr 7fr 1.5fr 1.5fr 0.7fr 0.7fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 16px;
}

.review-content{
    display: grid;
    grid-template-columns: 1fr 1.2fr 1.2fr 7fr 1.5fr 1.5fr 0.7fr 0.7fr;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 16px;
    text-align: center;
}

/* 자유게시판일 경우 */
.free-title {
    display: grid;
    grid-template-columns: 1fr 1fr 7fr 1.5fr 1.5fr 0.7fr 0.7fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 16px;
    font-weight: 600;
    border-bottom: 1px solid #01083a;
}

.free-notice{
    display: grid;
    grid-template-columns: 1fr 1fr 7fr 1.5fr 1.5fr 0.7fr 0.7fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 16px;
}

.free-content{
    display: grid;
    grid-template-columns: 1fr 1fr 7fr 1.5fr 1.5fr 0.7fr 0.7fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 16px;
}

/* 제목, 닉네임 말줄임표 */
.review-content > :nth-child(n + 4):nth-child(-n + 5)
, .free-content > :nth-child(n + 3):nth-child(-n + 4){
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
    padding: 0 10px;
}

.review-notice > :nth-child(3)
, .free-notice > :nth-child(2) {
    font-weight: 600;
}

.review-content > :nth-child(4)
, .free-content > :nth-child(3) {
    text-align: left;
    padding: 0 20px;
}
/* --------------- 경진 end ---------------- */

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

    .board_head{
    display: grid;
    grid-template-columns: 1fr, 1fr;
    justify-content: end;
    align-items: center;    
    gap: 30px; 
    margin: 50px auto;
    }
    /* .board-head{
    display: flex;
    justify-content: space-between;
    grid-template-columns: 5fr 4fr;
    align-items: center;    
    gap: 30px; 
    margin: 20px auto;
    min-width: 800px; */
}


</style>