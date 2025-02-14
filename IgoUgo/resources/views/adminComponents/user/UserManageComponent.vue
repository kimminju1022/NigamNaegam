<template>
    <div class="user-container">
        <div>
            <p class="user-title">유저 관리</p>
            <hr class="hr-style">
        </div>
        <div class="user-content-container">
            <div class="user-content-box">
                <div class="user-current-title">
                    <p>오늘의 유저 현황</p>
                </div>
                <div class="user-current-list">
                    <div class="user-current-item">
                        <p>신규 가입</p>
                        <p class="user-current-cnt">2</p>
                    </div>
                    <div class="user-current-item">
                        <p>탈퇴 회원</p>
                        <p class="user-current-cnt">5</p>
                    </div>
                    <div class="user-current-item">
                        <p>강제 탈퇴 회원</p>
                        <p class="user-current-cnt">10</p>
                    </div>
                    <div class="user-current-item">
                        <p>신고 누적 회원</p>
                        <p class="user-current-cnt">2</p>
                    </div>
                    <div class="user-current-item">
                        <p>제재 받은 회원</p>
                        <p class="user-current-cnt">7</p>
                    </div>
                </div>
            </div>

            <div class="user-content-box">
                <div class="user-list-title">
                    <p>번호</p>
                    <p>이메일</p>
                    <p>닉네임</p>
                    <p>이름</p>
                    <p>가입일자</p>
                    <p>탈퇴 여부</p>
                    <p>제재 만료일자</p>
                </div>
                <div class="user-list-box" >
                    <div v-for="item in userList" :key="item" class="user-item">
                        <router-link :to="`/admin/user/${item.user_id}`">
                            <p>{{ item.user_id }}</p>
                            <p>{{ item.user_email }}</p>
                            <p>{{ item.user_nickname }}</p>
                            <p>{{ item.user_name }}</p>
                            <p>{{ item.created_at }}</p>
                            <p v-if="item.user_flg === '1'">탈퇴</p>
                            <p v-else></p>
                            <p>{{ item.expires_at }}</p>
                        </router-link>
                    </div>
                </div>
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
const actionName = 'userManage/showUserList';

// 유저 리스트
const userList = computed(() => store.state.userManage.userList);

// 필터 관련
const searchData = reactive({
    page: store.state.pagination.currentPage,
});

onBeforeMount(() => {
    store.dispatch(actionName, searchData);
});
</script>

<style scoped>
/* 유저 관리 큰 틀 */
.user-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 유저 관리 타이틀 */
.user-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    /* width: 500px; */
    margin-top: 5px;
}

/* 내용 감싸는 틀 */
.user-content-container {
    display: grid;
    grid-template-rows: 1fr 5fr;
    gap: 20px;
}

/* 각각의 상자 */
.user-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}

/* 오늘의 유저 현황 관련 */
.user-current-list {
    display: flex;
    gap: 50px;
    margin: 30px 0 0 30px;
}
.user-current-item {
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    gap: 10px;
}
.user-current-title {
    font-size: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #01083a;
}
.user-current-title p {
    margin-left: 10px;
}
.user-current-cnt {
    color: #ff0000;
}

/* 유저 리스트 영역 관련 */
.user-list-title {
    display: grid;
    grid-template-columns: 1fr 2fr 1.5fr 1.5fr 1.5fr 1fr 1.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.user-list-box {
    padding: 5px;
    margin-bottom: 15px;
}
.user-item a{
    display: grid;
    grid-template-columns: 1fr 2fr 1.5fr 1.5fr 1.5fr 1fr 1.5fr;
    text-align: center;
    width: 100%;
    height: 25px;
    margin-top: 10px;
}
.user-item > :nth-child(n + 2):nth-child(-n + 4){
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
    padding: 0 10px;
}

/* 체크 아이콘 */
.icon-check {
    width: 20px;
}
</style>