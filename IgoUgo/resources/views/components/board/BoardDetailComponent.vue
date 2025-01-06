<template>
    <div class="board-detail-header">
        <!-- 경로표시 -->
        <div class="board-detail-category">
            <h1>{{ $store.state.board.bcName }}</h1>
            <h3 v-if="$store.state.board.rcName">  > {{ $store.state.board.rcName }}</h3>
            <h3 v-if="$store.state.board.areaName">  > {{ $store.state.board.areaName }}</h3>
        </div>
        <!-- 버튼영역 -->
        
        <div class="board-detailItem-btn"> 
            <!-- <router-link :to="`/boards/${boardDetail.board_id}/edit`"><button class="btn bg-navy board-detail-btn" @click="detailConfirm(boardDetail.board_id)">수정</button></router-link> -->
            <!--<button class="btn bg-navy board-detail-btn" @click="deleteConfirm(boardDetail.board_id)">삭제</button>
            <router-link to="/boards"><button class="btn bg-navy board-detail-btn">목록</button></router-link> -->
            
            <button class="btn bg-navy board-detail-btn" @click="detailConfirm(boardDetail.board_id)">수정</button>
            <button class="btn bg-navy board-detail-btn" @click="deleteConfirm(boardDetail.board_id)">삭제</button>
            <router-link to="/boards"><button class="btn bg-navy board-detail-btn">목록</button></router-link>

        </div>
    </div>
    
    <!-- 상세 글머리_정보불러오기-->
    <h1>{{ boardDetail.board_title }}</h1>
    <div class="board-detail-head">
        <p v-if="boardDetail.bc_type === '0'" class="star-label">{{'★'.repeat(boardRate)+'☆'.repeat(5-boardRate)}}</p>
        <p>작성자 :  {{ boardDetail.user_nickname }}</p>
        <p>{{ boardDetail.created_at }}</p>
        <button @click="boardLikeEvent"><img style="height: 15px;" src="../../../../../ex/img/heart.png">   : </button>
        <!-- <p> {{ loveIt[0] }}</p> -->
        <p>조회 : </p>
        <!-- {{ absolve[1]++ }} -->
        <button @click="boardNotify">🚨 신고</button>
    </div>
    
    <!-- 등록이미지 불러오기 -->
    <div class="board-detail-img">
        <img :src="boardDetail.board_img1">
        <img :src="boardDetail.board_img2">
    </div>
    <!-- 내용 -->
    <!-- <textarea readonly class="board-detail-content" ref="boardTextarea" :style="{height: 'auto'}">{{ boardDetail.board_content}}</textarea> -->
    <textarea readonly class="board-detail-content">{{ boardDetail.board_content}}</textarea>

    <!-- 댓글 -->
    <div class="board-reply-container">
        <hr>
        <div class="board-detail-reply ">
            <p>댓글</p>
            <input type="text" maxlength="100" placeholder="소통하고 싶은 글이 있다면 남겨 주세요">
            <button class="btn bg-navy board-detail-btn">작성</button>
            <p style="text-align: end; padding-right: 40px;">총 댓글 : {{ $store.state.board.commentsTotal }}</p>
        </div>
        <hr>
        <div class="board-detail-replyList">
            <div class="replyList-head">
                <p>내용</p>
                <p>닉네임</p>
                <p>작성일시</p>
            </div>
            <div v-for="item in $store.state.board.boardComments" :key="item" class="replyList">
                <p>{{ item.comment_content }}</p>
                <p>{{ item.user_nickname }}</p>
                <p>{{ item.created_at }}</p>
            </div>
        </div>
        <div class="pagination-btn">
            <!-- 페이지네이션 -->
            <PaginationComponent :actionName="actionName" :searchData="searchData" />
        </div>
    </div>

</template>

<script setup>
import PaginationComponent from '../PaginationComponent.vue';
import { computed, onBeforeMount, reactive } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const route = useRoute();
const router = useRouter();
// board출력값
const boardDetail = computed(() => store.state.board.boardDetail);

// alert 안내문구---------------------start-----------------
const detailConfirm = () => {
    const userResponse = confirm('해당 글을 수정 하시겠습니까?');
    if (userResponse) {
        router.push(`/boards/${route.params.id}/update`);
    }
}

const deleteConfirm = () => {
    const userResponse = confirm('해당 글을 삭제 하시겠습니까?\n 삭제 시 게시글을 되돌릴 수 없습니다');    
    if (userResponse) {
        store.dispatch('board/boardDelete', route.params.id);
        router.back();
    }
}

const boardNotify= () => {
    const userResponse = confirm('본 게시물을 신고 하시겠습니까?\n신고 조건은 다음과 같습니다\n    *유해성 내용 포함\n    *악의적, 의도적 비방글\n    -조건에 부합할 시 신고해 주시길 바라며,\n신고는 신중히 생각하고 요청해 주세요-');
    if (userResponse) {
        // 신고적용할 조건필요요
        router.push('/boards/');
    } else {
    }
}
// alert 안내문구---------------------end-----------------
const actionName = 'board/boardCommentPagination';
const searchData = reactive({
    page: store.state.pagination.currentPage,
    board_id: route.params.id,
});

// rate별점표기-----------------------start-----------------
const boardRate = computed(() => boardDetail.value.rate);

const boardInfo = reactive({
    board_id: route.params.id,
});

// // boardRate = computed(() => {
// //     return boardDetail.value?.rate ? 6 - boardDetail.value.rate
// });
// computed{
    // get() {
    //     // DB 값(5->1, 4->2, ...)을 UI 값으로 변환
    //     return value-store.state.board.boardDetail.rate;
    // },
    // set(value) {
    //     // UI 값(1->5, 2->4, ...)을 DB 값으로 변환
    //     store.state.board.boardDetail.rate = 6 - value;
    // },
    // computed(() => {
    // return store.state.board.boardDetail?.rate
    //     ? Math.max(6 - store.state.board.boardDetail.rate, 1)
    //     : 1;
//     return boardDetail.value?.rate ? 6 - boardDetail.value.rate : 0;
// });
// rate별점표기------------------------end------------------

// 비포마운트처리
onBeforeMount(()=>{
    store.dispatch('board/showBoardDetail', route.params.id);
    store.dispatch(actionName, searchData);
});

</script>

<style scoped>
hr{
    border: solid #01083a 1px;
}
.board-detail-header{
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
    grid-template-columns: 7fr 4fr 3fr 2fr 2fr 2fr;
    grid-auto-rows: 50px;
    justify-content: space-between;
    align-items:end;
    line-height: 1.5;
    margin: 20px auto;
    border-bottom: double #01083a 5px;
    font-size: 1.2rem;
    text-align: center;
}
/* .board-detail-head>:nth-child(){
    display: inline;
    text-align: center;
} */
.board-detail-head>button{
    border: none;
    background: transparent;
    font-size: 1.2rem;
}
.star-label {
    font-size: 30px;
    color: rgba(255, 217, 0, 0.5);
    text-align: left;
    margin-left: 10px;
}

/* [data-rate="1"] {
    color: gold;
    content: '★☆☆☆☆';
}
[data-rate="2"] {
    color: gold;
    content: '★★☆☆☆';
}
[data-rate="3"] {
    color: gold;
    content: '★★★☆☆';
}
[data-rate="4"] {
    color: gold;
    content: '★★★★☆';
}
[data-rate="5"] {
    color: gold;
    content: '★★★★★';
} */


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
    max-width: 450px;
    max-height: 270px;
}
.board-detail-content{
    padding: 20px 30px;
    width: 100%;
    min-height: 500px;
    max-height: 4000px;
    /* height: auto; */
    font-size: 1.2rem;
    line-height: 2rem;
    resize: none;
}

.board-reply-container{
    margin-top: 100px;
}
.replyList-head, .replyList{
    display: grid;
    grid-template-columns: 7fr 1fr 2fr;
    align-items: center;
}

.board-detail-replyList{
    display: grid;
    /* grid-template-rows: repeat(1fr); */
    gap: 20px 40px;
    /* column-gap: 40px; */
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
    grid-template-columns: 1fr 8fr 1fr 3fr;
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

.replyList-head{
    height: 40px;
    font-weight: 700;
    border-bottom: solid #071055b9 1px;
}
.replyList-head:nth-child(1), .replyList>p:nth-child(2), .replyList>p:nth-child(3){
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
        display: grid;
        grid-column: 8fr 3fr 3fr 3fr 3fr 1fr;
        align-items: center;
        text-align: center;
        gap: 10px;
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