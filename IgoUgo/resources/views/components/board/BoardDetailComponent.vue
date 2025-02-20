<template>
    <div class="board-detail-header">
        <!-- 경로표시 -->
        <div class="board-detail-category">
            <h1>{{ $store.state.board.bcName }}</h1>
            <h3 v-if="store.state.board.bcCode === '0'" >≫ {{ $store.state.board.rcName }}</h3>
            <h3 v-if="store.state.board.bcCode === '0'" >≫ {{ $store.state.board.areaName }}</h3>
        </div>
        <!-- 버튼영역 -->
        
        <div class="board-detailItem-btn"> 
            <!-- <router-link :to="`/boards/${boardDetail.board_id}/edit`"><button class="btn bg-navy board-detail-btn" @click="editConfirm(boardDetail.board_id)">수정</button></router-link> -->
            <!--<button class="btn bg-navy board-detail-btn" @click="deleteConfirm(boardDetail.board_id)">삭제</button>
            <router-link to="/boards"><button class="btn bg-navy board-detail-btn">목록</button></router-link> -->
            
            <router-link to="/boards"><button class="btn bg-navy board-detail-btn">목록</button></router-link>
            <!-- <button v-if="$store.state.auth.userInfo.user_id === boardDetail.user_id" class="btn bg-navy board-detail-btn" @click="editConfirm(boardDetail.board_id)">수정</button> -->
            <!-- ---------------- 경진 start ----------------- -->
            <router-link :to="`/boards/${boardDetail.board_id}/update`"><button v-if="$store.state.auth.userInfo.user_id === boardDetail.user_id" class="btn bg-navy board-detail-btn">수정</button></router-link>
            <!-- ---------------- 경진 end ----------------- -->
            <button v-if="$store.state.auth.userInfo.user_id === boardDetail.user_id" class="btn bg-navy board-detail-btn" @click="deleteConfirm(boardDetail.board_id)">삭제</button>

        </div>
    </div>

    <div class="board-box">
        <div class="board-title-flex">
            <p>제목</p>
            <p>{{ boardDetail.board_title }}</p>
            <p v-if="boardDetail.bc_code === '0'" class="star-label">{{'★'.repeat(boardRate)+'☆'.repeat(5-boardRate)}}</p>
        </div>
        <div class="board-review-flex">
            <p>리뷰</p>
            <p>{{ boardDetail.title }}</p>
            <div class="btn-list">
                <div class="btn-like">
                    <button class="btn loveIt_btn" @click="likeProccess(boardDetail.board_id)">
                        <img style="height: 20px;" :src="$store.state.board.likeImgPath">
                    </button>
                    <p>{{ boardDetail.likes_count }}</p>
                </div>
                <button class="btn boardReport_btn" @click="boardReport(boardDetail.board_id)">🚨 신고 </button>
            </div>
        </div>
        <div class="board-content-box">
            <div class="board-content">
                <div class="board-content-img">
                    <div class="img-grid">
                        <img v-for="(image, index) in boardDetail.board_images" :key="index" :src="image.board_img">
                    </div>
                </div>
                <div class="content-textarea">
                    <textarea ref="textArea" @input="resize" readonly>{{ boardDetail.board_content }}</textarea>
                </div>
                <div class="board-user">
                    <div class="border-user-profile">
                        <img :src="boardDetail.user_profile">
                        <p>by  {{ boardDetail.user_nickname }}</p>
                    </div>
                    <p>{{ boardDetail.created_at }}</p>
                </div>
            </div>
        </div>
    </div>

        <h1 style="margin: 200px 0;">----------------------------------------------------------------</h1>

    <!-- 상세 글머리_정보불러오기-->
    <h1>{{ boardDetail.board_title }}</h1>
    <div class="board-detail-head" :class="gridDetail">
        <p v-if="boardDetail.bc_code === '0'" class="star-label">{{'★'.repeat(boardRate)+'☆'.repeat(5-boardRate)}}</p>
        <b v-if="boardDetail.bc_code === '0'" style="text-align: left; font-size: 1.3rem;">상품명   :   {{ boardDetail.title }}</b>
        <!-- <p v-if="boardDetail.bc_code === '0'">{{ $store.state.board.productTitle }}</p> -->
        <p>작성자 :  {{ boardDetail.user_nickname }}</p>
        <p>{{ boardDetail.created_at }}</p>
        <button class="loveIt_btn" @click="likeProccess(boardDetail.board_id)">
            <img style="height: 20px;" :src="$store.state.board.likeImgPath">
            <span>{{ boardDetail.likes_count }}</span>
        </button>
        <!-- <p> {{ loveIt[0] }}</p> -->
        <!-- <p>조회 : {{ absolve[]++ }}</p> -->
        <button class="boardReport_btn" @click="boardReport(boardDetail.board_id)">🚨 신고 </button>
    </div>
    
    <!-- 등록이미지 -->
    <div class="board-detail-img">
        <div v-for="(image, index) in boardDetail.board_images" :key="index">
            <img :src="image.board_img" @click="modalOpen(image)" class="detailImg_slot" alt="등록 이미지" />
        </div>

        <!-- img 확대 모달창 -->
        <!-- <div class="modal-img" v-show="modalCheck">
            <img :src="selectedImage" class="modalImg"/>
            <div class="modal-container">
                <div class="btn bg-navy board-detail-btn">
                    <button @click="modalClose">닫기</button>
                </div>
            </div>
        </div> -->
    </div>
    <!-- <div class="board-detail-img">
        <img :src="boardDetail.board_img">
    </div> -->
    <!-- 내용 -->
    <!-- <textarea readonly class="board-detail-content" ref="boardTextarea" :style="{height: 'auto'}">{{ boardDetail.board_content}}</textarea> -->
    <textarea readonly class="board-detail-content">{{ boardDetail.board_content}}</textarea>

    <!-- 댓글 -->
    <div class="board-reply-container">
        <hr>
        <div class="board-detail-reply ">
            <p>댓글</p>
            <input type="text" maxlength="100" placeholder="소통하고 싶은 글이 있다면 남겨 주세요" v-model="commentsInfo.comment_content">
            <button @click="storeComment();" class="btn bg-navy board-detail-btn">작성</button>
            <p style="text-align: end; padding-right: 40px;">총 댓글 : {{ $store.state.board.commentsTotal }}</p>
        </div>
        <hr>
        <div class="board-detail-comments">
            <div class="comments-head">
                <p>내용</p>
                <p style="margin-left: 10px;">닉네임</p>
                <p>작성일시</p>
            </div>
            <div v-for="item in $store.state.board.boardComments" :key="item" class="comments">
                <p>{{ item.comment_content }}</p>
                <p>                    
                    <button class="boardReport_btn" @click="commentReport(item.comment_id)">🚨</button>
                    {{ item.user.user_nickname }}
                </p>
                <p>{{ item.created_at }}</p>
                <button v-if="$store.state.auth.userInfo.user_id == item.user.user_id" class="clear_btn" @click="deleteComments(item.comment_id)">🗑️</button>
            </div>
        </div>
        <div class="pagination-btn">
            <!-- 페이지네이션 -->
            <PaginationComponent
                :actionName="actionName"
                :searchData="searchData"
                :currentPage="$store.state.pagination.currentPage"
                :lastPage="$store.state.pagination.lastPage"
                :viewPageNumber="$store.state.pagination.viewPageNumber"
            />
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
// contenttypeid명칭정의
// const readableRcName = computed(() => store.state.board.rcName);
// const image = ;
const commentsInfo =  reactive({
    comment_content: ''
    ,board_id: route.params.id
});

// alert 안내문구---------------------start-----------------
    // 게시물수정
// const editConfirm = () => {
//     const userResponse = confirm('해당 글을 수정 하시겠습니까?');
//     if (userResponse) {
//         router.push(`/boards/${route.params.id}/update`);
//     }
// }

    /*2차
    if (userResponse) {
        store.dispatch('board/boardDelete', route.params.id);
        router.push('/boards/');
    }  */

    // 신고
const boardReport= (id) => {
    const userResponse = confirm('본 게시물을 신고 하시겠습니까?\n신고 조건은 다음과 같습니다\n    *유해성 내용 포함\n    *악의적, 의도적 비방글\n    -조건에 부합할 시 신고해 주시길 바라며,\n신고는 신중히 생각하고 요청해 주세요-');
    if (userResponse) {
        // 신고적용할 조건필요
        // router.push('/boards/');
        store.dispatch('board/boardReport', id); 
    }
}

// ------------------ meerkat Start ------------------
// 댓글 작성
const storeComment = () => {
    store.dispatch('board/storeComment', commentsInfo)
    .then(() => {
        commentsInfo.comment_content = '';
    });
};
// 댓글 삭제
const deleteComments = (id) => {
    const check = confirm('해당 글을 삭제 하시겠습니까?\n삭제 시 게시글을 되돌릴 수 없습니다');
    const data = {
        page: searchData.page,
        board_id: searchData.board_id,
        comment_id: id
    };

    if(check) {
        store.dispatch('board/commentsDelete', data);
    }
};
    // 댓글 신고
const commentReport= (comment_id) => {
    const userResponse = confirm('본 게시물을 신고 하시겠습니까?\n신고 조건은 다음과 같습니다\n    *유해성 내용 포함\n    *악의적, 의도적 비방글\n    -조건에 부합할 시 신고해 주시길 바라며,\n신고는 신중히 생각하고 요청해 주세요-');
    if (userResponse) {
        // 신고적용할 조건필요
        // router.push('/boards/');
        store.dispatch('board/commentReport', comment_id); 
    } else {
    }
}

// 좋아요 관련
let debouncingLikeFlg = false;
const likeProccess = (id) => {
    // 로그인 체크
    if(!store.state.auth.authFlg) {
        alert('로그인이 필요한 기능입니다.');
        router.push('/login');
    } else {
        // 좋아요 처리
        if(!debouncingLikeFlg) {
            debouncingLikeFlg = true;
            store.dispatch('board/likeProcess', id)
            .then(() => {
                debouncingLikeFlg = false;
            });
        }
    }
}

// ------------------ meerkat End ------------------


// ----------------------- 경진 start ---------------------
    // 게시물삭제
    const deleteConfirm = (id) => {
    const userResponse = confirm('해당 글을 삭제 하시겠습니까?\n삭제 시 게시글을 되돌릴 수 없습니다');
    if(userResponse) {
        store.dispatch('board/boardDelete', id);
    }
};
// ----------------------- 경진 end ---------------------


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

const gridDetail = computed(() => {
    return store.state.board.bcCode === '0' ? 'grid-6' : 'grid-4';
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
    store.dispatch('board/showBoardDetail', {id: route.params.id, authFlg: store.state.auth.authFlg}); // 디테일
    store.dispatch(actionName, searchData); // 코멘트 페이지네이션
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
    column-gap: 20px;
}
.board-detailItem-btn{
    display: flex;
    align-items: flex-end;
    justify-content: right;
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
    margin: 20px auto;
    border-bottom: double #01083a 5px;
    font-size: 1.2rem;
    text-align: right;
}
.boardReport_btn{
    background-color: transparent;
    margin-right: 10px;
    font-size: 16px;
}
.loveIt_btn{
    /* cursor: url(/IgoUgo/public/images/Lcussor.png),auto; */
    /* cursor: url('/images/Lcussor.png'); */
    background-color: transparent;
    display: flex;
}
/* .loveIt_btn:active{
    background-image:url('/images/heart.png') 10 10;
} */
.grid-4{
    display: grid;
    grid-template-columns: 9fr 3fr 3fr 3fr;
    grid-auto-rows: 50px;
    align-items:end;
    line-height: 1.5;
    text-align: right;
    gap: 10px;
}
.grid-6{
    display: grid;
    grid-template-columns: 3fr 6fr 3fr 2fr 2fr 1.5fr;
    grid-auto-rows: 50px;
    justify-content: space-between;
    align-items:end;
    line-height: 1.5;
    gap: 10px;
}

    /* grid-template-columns: 7fr 4fr 3fr 2fr 2fr 2fr; */

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
    font-size: 1.6rem;
    color: rgba(255, 217, 1, 0.932);
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
    display: flex;
    grid-template-columns: repeat(5, 1fr);
    margin: 20px;
    padding: 10px;
    justify-content: center;
    place-items: center;
    max-height: 300px;
}
/* .board-detail-img>img{
    display: block;
    margin: 0 auto;
    max-width: 450px;
    max-height: 270px;
} */
.detailImg_slot{
    /* justify-content: center;
    align-items: center; */
    /* text-align: center; */
    height: 230px;
    width: 230px;
    gap: 10px;
    margin: 10px;
    object-fit: contain;
    background-color: transparent;
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
.comments-head, .comments{
    display: grid;
    grid-template-columns: 7fr 1fr 2fr 0.5fr;
    align-items: center;
}

.board-detail-comments{
    display: grid;
    /* grid-template-rows: repeat(1fr); */
    gap: 20px 40px;
    /* column-gap: 40px; */
}
.board-detail-comments:nth-last-child(1){
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

.comments-head{
    height: 40px;
    font-weight: 700;
    border-bottom: solid #071055b9 1px;
}
.comments-head:nth-child(1), .comments>p:nth-child(2), .comments>p:nth-child(3){
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
/** 모달------------------start */
.modal-img{
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.4);
}
.modal-container {
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 550px;
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    box-sizing: border-box;
}
.modalImg{
    width: 60%;
    height: 60%;
    justify-content: center;
    object-fit: contain;
    background-color: transparent;
}
/** 모달------------------end */

.clear_btn{
    border: none;
    background-color: transparent;
}

.clear_btn:hover{
    border: #01083a;
    border-radius: 20px;
}

/* @media(max-width: 800px){
    .board-detail-head{
        flex-wrap: wrap;
        flex-direction: column; 
        align-items: flex-start; 
    }
} */

/* 수정수정 */
.board-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    margin-top: 50px;
}

.board-box p {
    padding: 10px;
    font-size: 17px;
}

.board-title-flex > p:first-child
, .board-review-flex > p:first-child
, .board-content-box > p:first-child {
    font-size: 18px;
    text-align: center;
    font-weight: 600;
    border-right: 1px solid #01083a;
}

.board-content > div:not(:last-child){
    width: 90%;
    margin: 20px auto;
}

.board-box p, .board-content textarea {
    font-size: 17px;
}
.board-title-flex {
    display: grid;
    grid-template-columns: 1fr 5fr 1fr;
    border-bottom: 1px solid #01083a;
    /* align-items: center; */
}

.board-title-flex :last-child {
    font-size: 22px;
}

.board-review-flex {
    display: grid;
    grid-template-columns: 1fr 5fr 1fr;
    border-bottom: 1px solid #01083a;
}

.btn-list {
    display: flex;
    justify-content: space-around;
}

.btn-like {
    display: flex;
    align-items: center;
}

.board-content > :last-child {
    border-top: 1px solid #01083a;
}

.board-content textarea {
    resize: none;
    height: 250px;
    width: 99%;
    margin: 10px;
    /* background-color: #f7f7f7; */
}

.board-content-img {
    margin: 20px auto;
}

.img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    place-items: center;
    /* margin: 0 auto; */
}

.img-grid > img {
    max-width: 185px;
    max-height: 185px;
}

.board-user {
    display: flex;
    justify-content: flex-end;
    gap: 20px;
}

.border-user-profile {
    display: flex;
    align-items: center;
    gap: 10px;
}

.board-user img {
    width: 35px;
    height: 35px;
    border-radius: 50px;
    border: 2px solid #01083a18;
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
    .comments{
        width: 800px;
        display: grid;
        grid-template-columns: 7fr 1fr 1.5fr;
        align-items: center;    
        gap: 30px; 
        margin: 50px auto;
    }

}
</style>