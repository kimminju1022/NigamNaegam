<template>
    <div class="container" v-if="testerDetail">
        <h1><router-link :to="`/testers`">체험단 신청</router-link></h1>
        <div class="header-btn-box">
            <router-link :to="`/testers`"><button class="btn bg-navy header-btn">목록</button></router-link>
        </div>
        <div class="board-box">
            <div class="board-box-flex">
                    <p>{{ testerDetail.tester_management?.tester_area }}</p>
                    <p>{{ testerDetail.tester_management?.tester_name }}</p>
                <p>{{ testerDetail.board_title }}</p>
                <p>{{ testerDetail.created_at_timestamps }}</p>
            </div>
            <div class="board-content-box">
                <div class="board-content">
                    <div class="board-content-img">
                        <img :src="testerDetail.board_images[0]?.board_img">
                    </div>
                    <div class="content-textarea">
                        <!-- <textarea ref="textArea" @input="resize" readonly>{{ testerDetail.board_content }}</textarea> -->
                        <pre ref="textArea" @input="resize" readonly>{{ testerDetail.board_content }}</pre>
                    </div>
                    <div class="board-place-box">
                        <p>장소 : {{ testerDetail.tester_management?.tester_place }}</p>
                        <p>모집 기한 : {{ testerDetail.tester_management?.dd }}</p>
                        <p>신청은 댓글로 부탁드립니다.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment">
            <h2>댓글</h2>
            <div class="comment-box">
                <div class="comment-list-box">
                    <div class="comment-flex">
                        <!-- <textarea @click="chkAuth" class="comment-text-box" :disabled="!store.state.auth.authFlg"></textarea> -->
                        <textarea v-model="searchDataComment.comment" @click="chkAuth" class="comment-text-box"></textarea>
                        <button @click="storeComment" class="btn bg-store" :disabled="!store.state.auth.authFlg">작성</button>
                    </div>
                    <p>총 댓글 : {{ testerDetail.comments_count }}</p>
                    <div class="comment-list">
                        <div v-for="item in commentList" class="comment-user">
                            <div class="comment-user-header">
                                <div class="user-profile-flex">
                                    <img :src="item.user?.user_profile" alt="">
                                    <div class="user-flex">
                                        <p>{{ item.user?.user_nickname }}</p>
                                        <p>{{ item.created_at }}</p>
                                    </div>
                                </div>
                                <button @click="deleteComment(item.comment_id)" v-if="$store.state.auth.userInfo.user_id === item.user_id" class="btn bg-clear btn-delete">X</button>
                            </div>
                            <p>{{ item.comment_content }}</p>
                        </div>
                    </div>
                </div>
                <PaginationComponent
                    :actionName="actionNameCommentList"
                    :searchData="searchData"
                    :currentPage="$store.state.pagination.currentPage"
                    :lastPage="$store.state.pagination.lastPage"
                    :viewPageNumber="$store.state.pagination.viewPageNumber"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive, ref } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
import PaginationComponent from '../PaginationComponent.vue';

const store = useStore();
const route = useRoute();
const actionName = 'tester/testerDetail';
const actionNameCommentList = 'comment/commentList';

const testerDetail = computed(() => store.state.tester.testerDetail);
const commentList = computed(() => store.state.comment.commentList);

// const boardInfo = reactive({
//     board_id: route.params.id,
// });

const searchData = reactive({
    board_id: route.params.id,
    page: store.state.pagination.currentPage,
});

const searchDataComment = reactive({
    board_id: route.params.id,
    comment: '',
    page: store.state.pagination.currentPage,
});

const textArea = ref(null);

const resize = () => {
    textArea.value.style.height = "1px";
    textArea.value.style.height = textArea.value.scrollHeight + "px";
};

onBeforeMount(()=>{
    store.dispatch(actionName, searchData);
    store.dispatch(actionNameCommentList, searchData);
});

// 댓글 로그인 체크
const chkAuth = () => {
    if(!store.state.auth.authFlg) {
        alert('로그인 후 작성 가능');
    }
}

// 댓글 작성
const storeComment = () => {
    if(!store.state.auth.authFlg) {
        alert('로그인 후 작성 가능');
    } else {
        store.dispatch('comment/storeComment', searchDataComment);
        testerDetail.value.comments_count++;
    }
}

// 댓글 삭제
const deleteComment = (id) => {
    const check = confirm('해당 댓글을 삭제 하시겠습니까?');
    if(check) {
        store.dispatch('comment/destroyComment', id);
    }
    testerDetail.value.comments_count--;
}
</script>

<style scoped>
.container{
    align-items: center;
}

.container > h1 {
    font-size: 2rem;
    margin: 25px 0;
}

.header-btn-box {
    display: flex;
    justify-content: flex-end;
}

.header-btn{
    font-size: 18px;       
    border-radius: 20px;
    width: 70px;
    height: 30px;
}

.board-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    margin-top: 50px;
}

.board-box p {
    padding: 10px;
    font-size: 17px;
}

.board-content {
    text-align: center;
}
.board-box p, .board-content textarea {
    font-size: 17px;
}

.board-place-box {
    background-color: #edf0f3;
    border-radius: 10px;
    margin: 70px auto;
    width: 70%;
    padding: 10px 0;
}

.board-box-flex {
    display: grid;
    grid-template-columns: 1fr 1fr 9fr 2fr;
    place-items: center;
    margin: 10px 0;
}

.board-box-flex :nth-child(3) {
    font-weight: 600;
}

.board-content-box {
    border-top: 1px solid #01083a;
}

.board-content {
    width: 70%;
    margin: 50px auto;
}

.board-content textarea {
    resize: none;
    min-height: 300px;
    width: 100%;
    /* height: 100%; */
}

/* .textarea-center {
    margin: 0 auto;
} */

.board-content-img {
    margin: 20px auto;
}

.board-content-img > img {
    margin: 0 auto;
    /* max-width: 500px; */
    min-width: 500px;
    max-height: 700px;
}

/* .img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    place-items: center;
}

.img-grid > img {
    max-width: 185px;
    max-height: 185px;
} */

/* 댓글 */

.comment {
    margin-top: 50px;
}

.comment h2 {
    margin-bottom: 20px;
}

.comment-box {
    background: #d1dceb;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    padding-bottom: 20px;
}

.comment-list-box {
    display: grid;
    grid-template-rows: 200px 1fr;
    width: 90%;
    margin-bottom: 50px;
}

.comment-list-box > p {
    padding-bottom: 10px;
    border-bottom: 1px solid #01083a50;
    font-size: 18px;
    font-weight: 600;
}

.comment-flex {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 50px;
}

.comment-text-box {
    background: #fff;
    width: 100%;
    height: 100px;
    margin: 20px auto;
    border-radius: 10px;
    resize: none;
    padding: 15px;
}

/* 댓글 등록 버튼 */
.bg-store {
    width: 75px;
    height: 40px;
    border-radius: 10px;
    background: #01083a;
    color: #fff;
    font-size: 20px;
}

/* 댓글 내용 */
.comment-user {
    border-bottom: 1px solid #01083a50;
    padding: 10px;
}

.comment-user > p {
    /* margin-left: 10px; */
    margin: 10px;
}

.comment-user-header {
    display: flex;
    justify-content: space-between;
}

/* 댓글 유저 프로필 */
.user-profile-flex {
    display: flex;
    gap: 10px;
}

.user-flex {
    display: flex;
    gap: 10px;
    align-items: center;
    font-size: 17px;
}

.user-flex :last-child {
    font-size: 14px;
    color: #4c4c4c;
}
/* 프로필 사진 */
.comment-user img {
    width: 30px;
    height: 30px;
    border-radius: 50px;
    border: 2px solid #01083a18;
}

.btn-delete {
    font-size: 18px;
    font-weight: 600;
}

.btn-delete:hover {
    color: red;
}
</style>