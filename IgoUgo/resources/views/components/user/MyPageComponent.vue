<template>
    <div class="my-page">
        <div class="my-profile">
            <div class="my-profile-bg">
                <div class="my-profile-box">
                    <div class="my-profile-img">
                        <img :src="$store.state.auth.userInfo.user_profile" alt="">
                    </div>
                    <div class="my-profile-content">
                        <div class="profile-item">
                            <p class="bg-navy">이메일</p>
                            <p>{{ $store.state.auth.userInfo.user_email }}</p>
                        </div>
                        <div class="profile-item">
                            <p class="bg-navy">이름</p>
                            <p>{{ $store.state.auth.userInfo.user_name }}</p>
                        </div>
                        <div class="profile-item">
                            <p class="bg-navy">닉네임</p>
                            <p>{{ $store.state.auth.userInfo.user_nickname }}</p>
                        </div>
                        <div class="profile-item">
                            <p class="bg-navy">전화번호</p>
                            <p>{{ $store.state.auth.userInfo.user_phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-profile-update-btn">
                <router-link :to="`/password/${$store.state.auth.userInfo.user_id}`"><button class="btn bg-clear">비밀번호 변경</button></router-link>
                <router-link :to="`/user/${$store.state.auth.userInfo.user_id}/edit`"><button class="btn bg-navy">수정</button></router-link>
            </div>
        </div>
        <div class="my-question">
            <div class="question-box">
                <h3>내가 쓴 게시글</h3>
                <div class="sort">
                    <p @click="showReview">리뷰</p>
                    <p> | </p>
                    <p @click="showFree">자유</p>
                </div>
                <div v-if="isReview" class="question-content-box">
                    <div class="board-title">
                        <p>번호</p>
                        <p>카테고리</p>
                        <p></p>
                        <p>제목</p>
                        <p>좋아요</p>
                        <p>작성일자</p>
                    </div>
                    <div v-for="item in userReview" :key="item" class="board-content">
                        <p>{{ item?.board_id }}</p>
                        <p v-if="item?.product?.contenttypeid === '12'">관광지</p>
                        <p v-else-if="item?.product?.contenttypeid === '14'">문화시설</p>
                        <p v-else-if="item?.product?.contenttypeid === '28'">레포츠</p>
                        <p v-else-if="item?.product?.contenttypeid === '32'">호텔</p>
                        <p v-else-if="item?.product?.contenttypeid === '38'">쇼핑</p>
                        <p v-else="item?.product?.contenttypeid === '39'">음식점</p>
                        <p></p>
                        <router-link :to="`/boards/${item.board_id}`">{{ item.board_title }}</router-link>
                        <p>{{ item.likes_count }}</p>
                        <p>{{ item.created_at }}</p>
                    </div>
                </div>
                <div v-if="isFree" class="question-content-box">
                    <div class="board-title">
                        <p>번호</p>
                        <p></p>
                        <p></p>
                        <p>제목</p>
                        <p>좋아요</p>
                        <p>작성일자</p>
                    </div>
                    <div v-for="item in userFree" :key="item" class="board-content">
                        <p>{{ item.board_id }}</p>
                        <p></p>
                        <p></p>
                        <router-link :to="`/boards/${item.board_id}`">{{ item.board_title }}</router-link>
                        <p>{{ item.likes_count }}</p>
                        <p>{{ item.created_at }}</p>
                    </div>
                </div>
            </div>

            <!-- 페이지네이션 -->
            <!-- <PaginationComponent :actionName1="actionName1" :searchData="searchData" /> -->
            <PaginationComponent
                :actionName="actionName1"
                :searchData="searchData1"
                :currentPage="$store.state.pagination.userBoardCurrentPage"
                :lastPage="$store.state.pagination.userBoardLastPage"
                :viewPageNumber="$store.state.pagination.userBoardViewPageNumber"
            />
        </div>

        <div class="my-question">
            <div class="question-box">
                <h3>나의 문의 내역</h3>
                <div class="question-content-box">
                    <div class="question-title">
                        <p>번호</p>
                        <p>상태</p>
                        <p>제목</p>
                        <p>작성일자</p>
                    </div>
                    <div v-for="item in userQuestion" :key="item" class="question-content">
                        <p>{{ item.board_id }}</p>
                        <div v-if="item.question.que_status === '0'">
                            <p class="reply-yet">대기</p>
                        </div>
                        <div v-else>
                            <p class="reply-done">완료</p>
                        </div>
                        <!-- <p>{{ item.questions.que_status }}</p> -->
                        <router-link :to="`/questions/${item.board_id}`">{{ item.board_title }}</router-link>
                        <p>{{ item.created_at }}</p>
                    </div>
                </div>
            </div>

            <!-- 페이지네이션 -->
            <!-- <PaginationComponent :actionName="actionName" :searchData="searchData" /> -->
            <PaginationComponent
                :actionName="actionName3"
                :searchData="searchData3"
                :currentPage="$store.state.pagination.userQuestionCurrentPage"
                :lastPage="$store.state.pagination.userQuestionLastPage"
                :viewPageNumber="$store.state.pagination.userQuestionViewPageNumber"
            />
        </div>
        
        <div class="user-delete-button">
            <button @click="openModal" class="btn bg-clear btn-exit">회원 탈퇴  ></button>
        </div>

        <!-- 회원 탈퇴 모달 -->
        <div v-show="modalFlg" class="delete-container">
            <div class="delete-box">
                <div class="delete-text">
                    <img src="/default/icon_x.png" alt="">
                    <p>탈퇴하셔도 작성한 게시물이 자동으로 삭제되지 않습니다.</p>
                    <p>정말로 탈퇴하시겠습니까?</p>
                </div>
                <div class="delete-btn">
                    <button @click="deletemodal(userInfo)" class="btn bg-clear">탈퇴</button>
                    <button @click="closeModal" class="btn bg-clear">취소</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onBeforeMount, computed, reactive } from 'vue';
import { useStore } from 'vuex';
import PaginationComponent from '../PaginationComponent.vue';

const store = useStore();
const userInfo = computed(()=> store.state.auth.userInfo);
// const actionName = ['question/userQuestionList', 'board/userReviewList', 'board/userFreeList'];
const actionName1 = 'board/userReviewList';
const actionName2 = 'board/userFreeList';
const actionName3 = 'question/userQuestionList';

const searchData1 = reactive({
    user_id: store.state.auth.userInfo.user_id,
    page: store.state.pagination.userBoard_currentPage,
});
const searchData2 = reactive({
    user_id: store.state.auth.userInfo.user_id,
    page: store.state.pagination.userBoard_currentPage,
});
const searchData3 = reactive({
    user_id: store.state.auth.userInfo.user_id,
    page: store.state.pagination.user_questionCurrentPage,
});

// ***************** 문의 내역 *****************
// 비포 마운트 처리
onBeforeMount(() => {
    store.dispatch(actionName1, searchData1);
    store.dispatch(actionName2, searchData2);
    store.dispatch(actionName3, searchData3);
});

const userQuestion = computed(() => store.state.question.userQuestionList);
const userReview = computed(() => store.state.board.userReviewList);
const userFree = computed(() => store.state.board.userFreeList);

const isReview = ref(true); // 기본적으로 리뷰를 보여줌
const isFree = ref(false); // 기본적으로 자유는 숨김

// 리뷰 클릭 시 호출
const showReview = () => {
    isReview.value = true;
    isFree.value = false;
    
    store.commit('pagination/setPaginationInitialize');
    // 리뷰 데이터를 가져오기
    store.dispatch(actionName1, searchData1);
};

// 자유 클릭 시 호출
const showFree = () => {
    isFree.value = true;
    isReview.value = false;
    
    store.commit('pagination/setPaginationInitialize');
    // 자유 데이터를 가져오기
    store.dispatch(actionName2, searchData2);
};


// console.log(userQuestion);

// ***************** 탈퇴 *****************
// Modal
const modalFlg = ref(false);
const openModal = () => {
    modalFlg.value = true;
}
const closeModal = () => {
    modalFlg.value = false;
}

// 탈퇴 처리
const deletemodal = (userInfo) => {
    store.dispatch('user/destroyUser', userInfo);
}

</script>

<style scoped>
.my-page {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 400px 1fr;
    place-items: center;
    gap: 70px;
    width: 100%;
    margin-top: 70px;
}

.my-page > div  {
    width: 100%;
}

/* .my-page > .my-profile, .my-page > .my-question  {
    width: 100%;
} */

/* 프로필 */
.my-profile-bg {
    background-color: rgb(133, 177, 218, 0.2) !important;
}

.my-profile-box {
    display: grid;
    grid-template-columns: 1fr 1fr;
    place-items: center;
    padding: 20px;
    /* background-color: rgb(133, 177, 218, 0.2); */
}

.my-profile-img {
    background: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 50%;
    width: 220px;
    height: 220px;
}

.my-profile-img > img {
    max-width: 200px;
    max-height: 200px;
    border-radius: 50%;
    /* background: #000;  */
}

.my-profile-content {
    padding: 10px;
}

.profile-item {
    display: flex;
    gap: 20px;
    margin-bottom: 10px;
}

.profile-item :nth-child(1) {
    min-width: 130px;
    padding: 10px 15px;
    font-weight: 600;
    text-align: center;
    border-radius: 15px;
    font-size: 20px;
}

.profile-item :nth-child(2) {
    min-width: 300px;
    padding: 10px 15px;
    font-weight: 500;
    text-align: center;
    font-size: 18px;
    border-bottom: 2px solid #01083a;
    background-color: transparent;
}

/* 수정 버튼 */

.my-profile-update-btn {
    display: flex;
    justify-content: flex-end;
    padding: 10px 5px;
}

.my-profile-update-btn button {
    font-size: 20px;  
    padding: 7px 15px;
    border-radius: 50px;  
}

.my-profile-update-btn :nth-child(1) button:hover {
    color: #01083a;
    font-weight: 600;
}

.my-profile-update-btn :nth-child(2) button:hover {
    /* background-color: #7e7e85;
    color: #ffffff;
    transition: ease-in-out 0.3s; */
    color: #01083a;
    background-color: #fff;
    /* border: 2px solid #01083a; */
    box-shadow: 0 0 0 2px #01083a inset;
}

/* 탈퇴 버튼 */

.btn-exit {
    font-size: 15px;  
    padding: 7px 15px;
    border-radius: 50px; 
    color: #929292; 
}

.btn-exit:hover {
    color: #f72222;
    font-weight: 600;
}

/* **************************************** */

/* 1:1 문의내역 */

.question-box h3{
    margin-bottom: 30px;
    font-size: 30px;
    color: #01083a;
}

.sort {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}

.question-content-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    max-width: 1250px;
    min-width: 500px;
    margin-bottom: 30px;
}

.question-title {
    display: grid;
    grid-template-columns: 1fr 1fr 9fr 1.5fr;
    text-align: center;
    padding: 10px;
    font-weight: 600;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}

.board-title {
    display: grid;
    grid-template-columns: 1fr 1fr 0.8fr 8fr 0.8fr 1.5fr;
    text-align: center;
    padding: 10px;
    font-weight: 600;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}

.question-content-box > hr{
    color: #4c4c4c;
}

.question-content {
    display: grid;
    grid-template-columns: 1fr 1fr 9fr 1.5fr;
    text-align: center;
    padding: 10px;
}

.board-content {
    display: grid;
    grid-template-columns: 1fr 1fr 0.8fr 8fr 0.8fr 1.5fr;
    text-align: center;
    padding: 10px;
}

.question-content :nth-child(3) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #000;
}

.reply-yet {
    color: red;
}

.reply-done {
    color: blue;
}

/* 회원 탈퇴 모달 */
.delete-container {
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.7);
    top: 0;
    left: 0;
    width: 100%;
    /* height: 100vh-150px; */
    height: 100vh;
    font-size: 20px;
    z-index: 2;
}

.delete-box {
    width: 50%;
    max-width: 700px;
    background: #fff;
    padding: 10px;
    display: grid;
    grid-template-rows: 3fr 1fr;
    gap: 30px;
    align-items: center;
    justify-content: center;
    padding-top: 30px;
    z-index: 3;
}

.delete-text {
    display: grid;
    grid-template-rows: 3fr 1fr 1fr;
    place-items: center;
}

.delete-text img {
    width: 100px;
    height: 100px;
}

.delete-btn {
    display: grid;
    grid-template-columns: 1fr 1fr;
    justify-content: center;
    gap: 10px;
}

.delete-btn button {
    font-size: 18px;
}

.delete-btn button:nth-child(1):hover {
    color: red;
    font-size: 22px;
    font-weight: bold;
}

.delete-btn button:nth-child(2):hover {
    /* color: red; */
    font-size: 22px;
    font-weight: bold;
}

/* 반응형 미디어쿼리 */

@media (max-width: 800px) {

    .my-page {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 500px 1fr;
        place-items: center;
        gap: 70px;
        width: 100%;
    }
    
    /* 프로필 */
    .my-profile-bg {
        background-color: rgb(133, 177, 218, 0.2) !important;
    }
    
    .my-profile-box {
        display: flex;
        flex-direction: column;
    }
    .my-profile-img {
        background: #fff;
        padding: 10px;
        text-align: center;
        border-radius: 50%;
    }

    .my-profile-img > img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 50%;
    }

    .my-profile-content {
        padding: 10px;
    }

    .profile-item {
        display: flex;
        gap: 20px;
        margin-bottom: 10px;
    }

    .profile-item :nth-child(1) {
        min-width: 100px;
        padding: 5px;
        text-align: center;
        border-radius: 15px;
        font-size: 14px;
    }

    .profile-item :nth-child(2) {
        min-width: 150px;
        padding: 5px;
        text-align: center;
        font-size: 15px;
        border-bottom: 2px solid #01083a;
    }
    
    /* 수정 버튼 */

    .my-profile-update-btn {
        display: flex;
        justify-content: flex-end;
        padding: 10px 5px;
    }

    .my-profile-update-btn :nth-child(1) button:hover {
        color: #01083a;
        font-weight: 600;
    }

    .my-profile-update-btn :nth-child(2) button:hover {
        background-color: rgb(133, 177, 218);
        color: #01083a;
    }
    
    /* 1:1 문의내역 */

    .question-box h3{
        margin-bottom: 30px;
        font-size: 30px;
        color: #01083a;
    }

    .question-content-box {
        border-top: 1px solid #01083a;
        border-bottom: 1px solid #01083a;
        min-width: 300px;
        margin-bottom: 30px;
    }

    .question-title {
        display: grid;
        grid-template-columns: 1.1fr 2fr 8fr 3fr;
        text-align: center;
        padding: 10px;
    }

    .question-content-box > hr{
        color: #4c4c4c;
    }

    .question-content {
        display: grid;
        grid-template-columns: 1.1fr 2fr 8fr 3fr;
        text-align: center;
        padding: 10px;
    }

    .question-content :nth-child(3) {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .question-content :last-child {
        font-size: 15px;
    }

    /* 페이지네이션 */

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        min-width: 150px;
    }

    .pagination button {
        font-size: 20px;
        border-radius: 50px;
        width: 40px;
        height: 40px;
        text-align: center;
        /* border: 2px solid #01083a; */
    }

    .pagination button:hover, .pagination button:active {
        color: #fff;
        background: #01083a;
    }

}


@media (max-width: 320px) {

    .my-page {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 500px 1fr;
        place-items: center;
        gap: 70px;
        width: 100%;
    }
    .my-profile-box {
        display: flex;
        flex-direction: column;
        /* margin-top: 150px; */
    }
    .my-profile-img {
        background: #fff;
        padding: 10px;
        text-align: center;
        border-radius: 50%;
    }

    .my-profile-img > img {
        max-width: 200px;
        max-height: 200px;
        border-radius: 50%;
        /* background: #000;  */
    }

    .my-profile-content {
        padding: 10px;
    }

    .profile-item {
        display: flex;
        gap: 20px;
        margin-bottom: 10px;
    }

    .profile-item :nth-child(1) {
        min-width: 80px;
        padding: 5px;
        /* font-weight: 600; */
        text-align: center;
        border-radius: 15px;
        font-size: 14px;
    }

    .profile-item :nth-child(2) {
        min-width: 120px;
        padding: 5px;
        /* font-weight: 500; */
        text-align: center;
        font-size: 15px;
        border-bottom: 2px solid #01083a;
    }
    
    /* 수정 버튼 */

    .my-profile-update-btn {
        display: flex;
        justify-content: flex-end;
        padding: 10px 5px;
    }

    .my-profile-update-btn button {
        font-size: 15px;  
        padding: 5px 10px;
        border-radius: 50px;  
    }

    .my-profile-update-btn button:hover {
        background-color: rgb(133, 177, 218);
        color: #01083a;
    }

    /* 1:1 문의내역 */

    .question-box h3{
        margin-bottom: 30px;
        font-size: 30px;
        color: #01083a;
    }

    .question-content-box {
        border-top: 1px solid #01083a;
        border-bottom: 1px solid #01083a;
        min-width: 300px;
        margin-bottom: 30px;
    }

    .question-title {
        display: grid;
        grid-template-columns: 0.5fr 2fr 1fr;
        text-align: center;
        padding: 10px;
    }

    .question-content-box > hr{
        color: #4c4c4c;
    }

    .question-content {
        display: grid;
        grid-template-columns: 0.5fr 2fr 1fr;
        text-align: center;
        padding: 10px;
    }

    .question-content :nth-child(2) {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .question-content :last-child {
        font-size: 15px;
    }

    /* 페이지네이션 */

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        max-width: 100px;
    }

    .pagination button {
        font-size: 20px;
        border-radius: 50px;
        width: 40px;
        height: 40px;
        text-align: center;
        /* border: 2px solid #01083a; */
    }

    .pagination button:hover, .pagination button:active {
        color: #fff;
        background: #01083a;
    }

}
</style>