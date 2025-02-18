<template>
    <div class="comment-container">
        <div>
            <p class="comment-title">댓글 관리</p>
            <hr class="hr-style">
        </div>
        <div class="comment-content-box">
            <div class="comment-list-title">
                <p>신고</p>
                <p>게시글 번호</p>
                <p>댓글 번호</p>
                <p>댓글 내용</p>
                <p>닉네임</p>
                <p>이름</p>
                <p>작성일자</p>
                <p>삭제여부</p>
            </div>
            <div class="comment-list-box" >
                <div v-for="item in commentList" :key=item class="comment-item">
                    <p>{{ item.report_cnt }}</p>
                    <p>{{ item.board_id }}</p>
                    <p :class="{ 'deleted-class': item.comment_flg === '1' }">{{ item.comment_id }}</p>
                    <router-link :to="`/admin/comment/${item.comment_id}`"><p>{{ item.comment_content }}</p></router-link>
                    <p>{{ item.user_nickname }}</p>
                    <p>{{ item.user_name }}</p>
                    <p>{{ item.created_at }}</p>
                    <p v-if="item.comment_flg === '0'"></p>
                    <p v-if="item.comment_flg === '1'"><img class="check-img-style" src="/img_admin/check.png"></p>
                </div>
                <div class="comment-post-List">
                    <PaginationComponent
                    :actionName="actionName"
                    :searchData="searchData"
                    :currentPage="$store.state.pagination.currentPage"
                    :lastPage="$store.state.pagination.lastPage"
                    :viewPageNumber="$store.state.pagination.viewPageNumber"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import PaginationComponent from '../../components/PaginationComponent.vue';
const store = useStore();

// 게시판 불러오기
const commentList = computed(()=> store.state.adminComment.commentList);
const actionName = 'adminComment/showCommentList';

const searchData = reactive({
    page: store.state.pagination.currentPage,
});

onBeforeMount(() => {
    store.dispatch(actionName, searchData);
});
</script>

<style scoped>
/* 댓글 관리 큰 틀 */
.comment-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 댓글 관리 타이틀 */
.comment-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    width: 500px;
    margin-top: 5px;
}

/* 댓글 리스트 */
.comment-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.comment-list-title {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 5fr 1fr 1fr 1.5fr 1fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.comment-list-box {
    padding: 5px;
}
.comment-item{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 5fr 1fr 1fr 1.5fr 1fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.comment-item >:nth-child(4) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
.comment-post-List {
    text-align: center;
    margin-top: 20px;
}
.deleted-class {
    opacity: 20%;
}

/* 기타 */
.check-img-style {
    width: 20px;
    height: 20px;
}
</style>