<template>
    <div class="main-btn">
        <button v-if="commentDetail.comment_flg === '0'" @click="deletePost()" class="btn bg-navy main-btn-size">삭제</button>
        <p v-if="commentDetail.comment_flg === '1'">이미 삭제된 댓글입니다.</p>
        <router-link :to="'/admin/comment'" >
            <button class="btn bg-navy main-btn-size">취소</button>
        </router-link>
    </div>
    <div class="main-table-background-color">
        <p class="main-table-name">댓글</p>
        <div v-if="commentDetail" class="main-table">
            <div class="comment-table">
                <div class="comment-column">게시글 번호</div>
                <div class="comment-table-text" >
                    <router-link :to="`/admin/board/${commentDetail.bc_code === '0' ? 'review' : 'free'}/${commentDetail.board_id}`"><p class="comment-content">{{ commentDetail.board_id }}</p></router-link>
                </div>
            </div>
            <div class="comment-table">
                <div class="comment-column">게시글 제목</div>
                <div class="comment-table-text" >
                    <router-link :to="`/admin/board/${commentDetail.bc_code === '0' ? 'review' : 'free'}/${commentDetail.board_id}`"><p class="comment-content">{{ commentDetail.board_title }}</p></router-link>
                </div>
            </div>
            <div class="comment-table">
                <div class="comment-column">댓글 번호</div>
                <div class="comment-table-text comment-num-info" >
                    <p class="comment-content">{{ commentDetail.comment_id }}</p>
                    <div class="comment-table-info">
                        <p>작성자 : {{ commentDetail.user_nickname }}</p>
                        <p>작성일자 : {{ commentDetail.created_at }}</p>
                        <p>신고 : {{ commentDetail.report_cnt }}회</p>
                    </div>
                </div>
            </div>
            <div class="comment-table">
                <div class="comment-column">댓글 내용</div>
                <div class="comment-table-text" >
                    <p class="comment-content">{{ commentDetail.comment_content }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const route = useRoute();

const actionName = 'adminComment/showCommentDetail';

const commentDetail = computed(()=> store.state.adminComment.commentDetail);

const searchData = reactive({
    comment_id: route.params.commentid,
});

onBeforeMount(async() => {
    await store.dispatch(actionName, searchData);
})

function deletePost() {
    store.dispatch('adminComment/destroyComment', searchData);
}
</script>
<style scoped>
/* 메인버튼 */
.main-btn {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
.main-btn-size {
    /* height: 50px;
    width: 100px;
    background-color: transparent;
    border: none;
    font-size: 30px;
    font-weight: 900;
    margin-bottom: 10px;
    cursor: pointer; */
    width: 70px;
    height: 45px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 20px;
    margin-bottom: 10px;
    margin-left: 10px;
}
.main-btn-size:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
}

/* 테이블쪽 */
.main-table-name {
    font-size: 30px;
    font-weight: 900;
    margin-bottom: 20px;
}
.main-table-background-color {
    background-color: #fff;
    height: 850px;
    padding: 30px;
}
.main-table-report {
    font-size: 18px;
    margin: 10px 0;
}
.main-table {
    display: grid;
    grid-template-rows: 1fr 1fr 1fr 3fr;
    height: 700px;
    font-size: 18px;
}
.main-table > :nth-child(4) {
    border-bottom: solid 2px #000;
}
.comment-table {
    display: grid;
    grid-template-columns: 1fr 8fr;
    border-top: solid 2px #000;
}
.comment-column {
    text-align: center;
    align-self: center;
}
.comment-table-text {
    display: flex;
    border-left: solid 2px #000;
    /* overflow: scroll; */
    align-items: center;
}
.comment-table-grid {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.comment-content {
    padding: 20px;
}
.comment-num-info {
    display: flex;
    justify-content: space-between;
}
.comment-table-info {
    display: flex;
    gap: 50px;
}
.comment-table-info > :last-child {
    margin-right: 50px;
}
    </style>