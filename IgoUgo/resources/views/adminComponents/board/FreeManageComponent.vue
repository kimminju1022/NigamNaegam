<template>
    <div class="free-container">
        <div>
            <p class="free-title">자유게시판</p>
            <hr class="hr-style">
        </div>
        <div class="free-content-box">
            <div class="free-list-title">
                <p>신고</p>
                <p>번호</p>
                <p>제목</p>
                <p>닉네임</p>
                <p>이름</p>
                <p>작성일자</p>
            </div>
            <div class="free-list-box" >
                <div v-for="item in postList" :key=item class="free-item">
                    <p v-if="item.report_count > 0">{{ item.report_count }}</p>
                    <p v-else>0</p>
                    <p :class="{ 'deleted-class': item.board_flg === '1' }">{{ item.board_id }}</p>
                    <router-link :to="`/admin/board/free/${item.board_id}`" >{{ item.board_title }}</router-link>
                    <p>{{ item.user_nickname }}</p>
                    <p>{{ item.user_name }}</p>
                    <p>{{ item.created_at }}</p>
                </div>
                <div class="free-post-List">
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
const postList = computed(()=> store.state.adminBoard.postList);
const actionName = 'adminBoard/getPostList';


const searchData = reactive({
    bc_code: 1,
    page: store.state.pagination.currentPage,
});

onBeforeMount(async() => {
    store.dispatch(actionName, searchData);
    // console.log(postList);
});


</script>

<style scoped>
/* 자유 게시판 큰 틀 */
.free-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 자유 게시판 타이틀 */
.free-title {
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
.free-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.free-list-title {
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1fr 1fr 1.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.free-list-box {
    padding: 5px;
}
.free-item{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1fr 1fr 1.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.free-item >:nth-child(3) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
.free-post-List {
    text-align: center;
    margin-top: 20px;
}
.deleted-class {
    opacity: 20%;
}
</style>