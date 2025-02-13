<template>
    <div class="user-detail-container">
        <div>
            <p class="user-detail-title">회원정보</p>
            <hr class="hr-style">
        </div>
        <div class="user-detail-content-container">
            <div class="user-detail-box box1">
                <img class="user-profile" :src="userDetail.user_profile">
                <div v-if="userDetailFlg" class="user-personal-info-box">
                    <div class="user-personal-info">
                        <div class="user-info-list">
                            <p>이메일</p>
                            <p>이름</p>
                            <p>닉네임</p>
                            <p>전화번호</p>
                        </div>
                        <div class="user-info-list">
                            <p>{{ userDetail.user_email }}</p>
                            <p>{{ userDetail.user_name }}</p>
                            <p>{{ userDetail.user_nickname }}</p>
                            <p>{{ userDetail.user_phone }}</p>
                        </div>
                    </div>
                    <button @click="updateBtn" class="btn bg-navy user-detail-btn">수정</button>
                </div>
                <div v-else class="user-personal-info-box">
                    <div class="user-personal-info">
                        <div class="user-info-list">
                            <p>이메일</p>
                            <p>이름</p>
                            <p>닉네임</p>
                            <p>전화번호</p>
                        </div>
                        <div class="user-info-list info-input-style">
                            <input v-model="userDetail.user_email">
                            <input v-model="userDetail.user_name">
                            <input v-model="userDetail.user_nickname">
                            <input v-model="userDetail.user_phone">
                        </div>
                    </div>
                    <button @click="finishBtn" class="btn bg-navy user-detail-btn">완료</button>
                </div>
            </div>

            <div class="user-detail-box box2">
                <div class="user-detail-box-second-title">활동 정보</div>
                <div class="user-active-info">
                    <div>가입일자 : {{ userDetail.created_at }}</div>
                    <div>최근 로그인 : {{ userDetail.user_last_login }}</div>
                    <div>
                        <p class="user-active-info-little-title">작성글 수</p>
                        <div class="pd-left">
                            <div v-for="item in userBoardCnt" :key="item" class="item-bottom">
                                <div v-if="item.bc_code === '0'">리뷰 : {{ item.cnt }}개</div>
                                <div v-else-if="item.bc_code === '1'">자유 : {{ item.cnt }}개</div>
                                <div v-else-if="item.bc_code === '2'">문의 : {{ item.cnt }}개</div>
                            </div>
                            <p class="item-bottom">댓글 : {{ userCommentCnt }}개</p>
                        </div>
                    </div>
                    <div>
                        <div class="user-active-info-little-box">
                            <p class="user-active-info-little-title">제재 누적 횟수</p>
                            <p class="pd-left">{{ userControlCnt }}회</p>
                        </div>
                        <div class="user-active-info-little-box">
                            <p class="user-active-info-little-title">제재 기간</p>
                            <p class="pd-left">
                                <input type="radio" name="time" id="three-days" value="1">
                                <label class="label-style" for="three-days">3일</label>
                                <input type="radio" name="time" id="seven-days" value="2">
                                <label class="label-style" for="seven-days">1주</label>
                                <input type="radio" name="time" id="one-month" value="3">
                                <label class="label-style" for="one-month">1달</label>
                                <input type="radio" name="time" id="one-year" value="4">
                                <label class="label-style" for="one-year">1년</label>
                                <input type="radio" name="time" id="forever" value="5">
                                <label class="label-style" for="forever">영구정지</label>
                                <button class="btn bg-navy user-control-btn">적용</button>
                            </p>
                        </div>
                        <div class="user-active-info-little-box">
                            <p class="user-active-info-little-title">제재 만료 일자</p>
                            <p class="pd-left">2025-02-06 00:00:00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-detail-box box3">
                <div>
                    <div class="user-detail-report">
                        <p>신고 당한 게시글</p>
                    </div>
                    <div class="user-detail-list-title">
                        <p>번호</p>
                        <p>제목</p>
                        <p>작성일자</p>
                        <p>신고 수</p>
                    </div>
                    <div class="user-detail-list-box" >
                        <div v-for="item in userBoardReport" :key="item" class="user-detail-item">
                            <p>{{ item.board_id }}</p>
                            <p>{{ item.board_title }}</p>
                            <p>{{ item.created_at }}</p>
                            <p>{{ item.reports[0].cnt }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="user-detail-report">
                        <p>신고 당한 댓글</p>
                    </div>
                    <div class="user-detail-list-title">
                        <p>글 번호</p>
                        <p>글 제목</p>
                        <p>댓글 작성일자</p>
                        <p>신고 수</p>
                    </div>
                    <div class="user-detail-list-box" >
                        <div v-for="item in userCommentReport" :key="item" class="user-detail-item">
                            <p>{{ item.board_id }}</p>
                            <p>{{ item.board.board_title }}</p>
                            <p>{{ item.created_at }}</p>
                            <p>{{ item.reports[0].cnt }}</p>
                        </div>
                    
                        <!-- <div class="user-detail-item">
                            <p>3</p>
                            <p>제목제목제목제목제목제목제목제목제목</p>
                            <p>2025-02-06 00:00:00</p>
                            <p>10</p>
                        </div>
                        <div class="user-detail-item">
                            <p>2</p>
                            <p>제목제목제목제목제목제목제목제목제목</p>
                            <p>2025-02-06 00:00:00</p>
                            <p>10</p>
                        </div>
                        <div class="user-detail-item">
                            <p>1</p>
                            <p>제목제목제목제목제목제목제목제목제목</p>
                            <p>2025-02-06 00:00:00</p>
                            <p>10</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive, ref } from 'vue';
import { useStore } from 'vuex'; 
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();

// 유저 상세 정보
const userDetail = computed(() => store.state.userManage.userDetail);

// 유저가 작성한 게시글 수
const userBoardCnt = computed(() => store.state.userManage.userBoardCnt);

// 유저가 작성한 댓글 수
const userCommentCnt = computed(() => store.state.userManage.userCommentCnt);

// 유저 제재 이력 횟수
const userControlCnt = computed(() => store.state.userManage.userControlCnt);

// 유저 신고 당한 게시글
const userBoardReport = computed(() => store.state.userManage.userBoardReport);

// 유저 신고 당한 댓글
const userCommentReport = computed(() => store.state.userManage.userCommentReport);

// 유저id
const findData = reactive({
    user_id: route.params.id
});

onBeforeMount(() => {
    store.dispatch('userManage/showUserDetail', findData);
    store.dispatch('userManage/showUserBoardCnt', findData);
    store.dispatch('userManage/showUserCommentCnt', findData);
    store.dispatch('userManage/showUserControlCnt', findData);
    store.dispatch('userManage/showBoardReport', findData);
    store.dispatch('userManage/showCommentReport', findData);
});

// 수정 
const userDetailFlg = ref(true);

const user = reactive({
    userDetail: userDetail
});

function updateBtn() {
    userDetailFlg.value = false;
}

function finishBtn() {
    userDetailFlg.value = true;
    store.dispatch('userManage/updateUserDetail', user);
}
</script>

<style scoped>
/* 유저 상세 큰 틀 */
.user-detail-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 유저 상세 타이틀 */
.user-detail-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    /* width: 500px; */
    margin-top: 5px;
}

/* 유저 상세 내용 영역 */
.user-detail-content-container {
    display: grid;
    grid-template-columns: 350px 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 20px;
}
.user-detail-box {
    background-color: #fff;
    padding: 20px;
}

/* 유저 내용 박스 1 */
.box1 {
    grid-row: 1 / 3;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 30px;
}
.user-profile {
    width: 200px;
    height: 200px;
    border: 1px solid #01083a;
    border-radius: 50%;
}
.user-personal-info-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}
.user-personal-info {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 2fr;
}
.info-input-style {
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.user-info-list p {
    margin: 10px 0;
}
.user-info-list input {
    padding: 4px;
    border: 1px solid #01083a;
}
.user-detail-btn {
    font-size: 20px;
    padding: 5px 15px;
    border-radius: 10px;
    border: 1px solid #01083a;
}
.user-detail-btn:hover {
    background-color: #fff;
    color: #01083a;
    border: 1px solid #01083a;
}

/* 유저 내용 박스 2 */
.box2 {
    display: grid;
    grid-template-rows: 50px 1fr;
}
.user-detail-box-second-title {
    font-weight: 600;
    margin-bottom: 10px;
}
.user-active-info {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 30px 1fr;
    gap: 20px;
}
.user-active-info-little-title {
    padding-bottom: 5px;
    margin-bottom: 10px;
    border-bottom: 1px solid #01083a;
}
.user-active-info-little-box {
    margin-bottom: 20px;
}
.user-control-btn {
    padding: 0 5px;
    border: 1px solid #01083a;
    border-radius: 5px;
}
.user-control-btn:hover {
    background-color: #fff;
    color: #01083a;
    border: 1px solid #01083a;
}
.item-bottom {
    margin-bottom: 10px;
}

/* 유저 내용 박스 3 */
.box3 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}
.user-detail-report {
    font-weight: 600;
    margin-bottom: 10px;
}
.user-detail-list-title {
    display: grid;
    grid-template-columns: 1fr 2fr 2fr 1fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    border-bottom: 1px solid #01083a;
}
.user-detail-list-box {
    padding: 5px;
}
.user-detail-item{
    display: grid;
    grid-template-columns: 1fr 2fr 2fr 1fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.user-detail-item > :nth-child(n + 2):nth-child(-n + 4) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}

/* 기타 스타일 */
.pd-left {
    padding-left: 10px;
}
.label-style {
    margin: 0 10px;
}
</style>