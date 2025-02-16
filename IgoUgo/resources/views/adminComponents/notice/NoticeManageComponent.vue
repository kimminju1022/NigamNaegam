<template>
    <div class="noti-container" v-if="noticeList">
        <div class="noti-header">
            <div>
                <p class="noti-title">공지사항</p>
                <hr class="hr-style">
            </div>
            <div class="btn-area">
                <router-link :to="'/admin/notice/create'"><button class="btn bg-navy noti-btn">작성</button></router-link>
            </div>
        </div>
        <div class="noti-content-box">
            <div class="noti-list-title">
                <p>번호</p>
                <p>제목</p>
                <p>관리자 이름</p>
                <p>작성일자</p>
            </div>
            <div class="noti-list-box" >
                <div v-for="item in noticeList" class="noti-item">
                    <p>{{ item.board_id }}</p>
                    <router-link :to="`/admin/notice/${item.board_id}`"><p>{{ item.board_title }}</p></router-link>
                    <p>{{ item.user?.user_name }}</p>
                    <p>{{ item.created_at_timestamps }}</p>
                </div>
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
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import PaginationComponent from '../../components/PaginationComponent.vue';

const store = useStore();

const actionName = 'adminNotice/noticeList';
const noticeList = computed(() => store.state.adminNotice.noticeList);

const searchData = reactive({
    page: store.state.pagination.adminQuestionYetCurrentPage,
});

onBeforeMount(() => {
    store.dispatch(actionName, searchData);
});
</script>

<style scoped>
/* 공지사항 큰 틀 */
.noti-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 버튼 */
.btn-area {
    display: flex;
    align-items: center;
}
.noti-btn {
    /* font-size: 25px;
    font-weight: 600;
    padding: 5px 10px; */
    width: 70px;
    height: 45px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 20px;
}
.noti-btn:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
}

/* 공지사항 맨 위에 */
.noti-header {
    display: flex;
    justify-content: space-between;
}

/* 공지사항 타이틀 */
.noti-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    width: 500px;
    margin-top: 5px;
}

/* 게시판 리스트 */
.noti-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.noti-list-title {
    display: grid;
    grid-template-columns: 1fr 4fr 1fr 1.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.noti-list-box {
    padding: 5px;
}
.noti-item{
    display: grid;
    grid-template-columns: 1fr 4fr 1fr 1.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.noti-item > :nth-child(2) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>