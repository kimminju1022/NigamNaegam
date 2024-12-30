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
        <!-- <div v-if="isMobileView">
            <div class="question-box">
                <h3>나의 문의 내역</h3>
                <div class="question-content-box">
                    <div class="question-title">
                        <p>상태</p>
                        <p>제목</p>
                        <p>작성일자</p>
                    </div>
                    <hr>
                    <div class="question-content">
                        <p>대기</p>
                        <a href="">대표가 정말 뽀빠이인가요?</a>
                        <p>24 / 12 / 05</p>
                    </div>
                    <div class="question-content">
                        <p>대기</p>
                        <a href="">깁스는 언제 풀 수 있을까요?</a>
                        <p>24 / 12 / 05</p>
                    </div>
                    <div class="question-content">
                        <p>완료</p>
                        <a href="">충격파 치료가 그렇게 아픈가요?</a>
                        <p>24 / 12 / 05</p>
                    </div>
                    <div class="question-content">
                        <p>완료</p>
                        <a href="">여백의 미가 진정한 미인가요?</a>
                        <p>24 / 12 / 05</p>
                    </div>
                    <div class="question-content">
                        <p>완료</p>
                        <a href="">세븐밸리 살려내라</a>
                        <p>24 / 12 / 05</p>
                    </div>
                </div>
            </div>
            <div class="pagination">
                <a href="#"><button class="btn bg-clear"><</button></a>
                <a href="#"><button class="btn bg-clear">1</button></a>
                <a href="#"><button class="btn bg-clear">2</button></a>
                <a href="#"><button class="btn bg-clear">3</button></a>
                <a href="#"><button class="btn bg-clear">4</button></a>
                <a href="#"><button class="btn bg-clear">5</button></a>
                <a href="#"><button class="btn bg-clear">></button></a>
            </div>
        </div> -->
        <!-- <div v-else> -->
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
                        <div v-if="item.questions.que_status === '0'">
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
            <PaginationComponent :actionName="actionName" :searchData="searchData" />
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
const actionName = 'question/userQuestionList';


// ***************** 문의 내역 *****************
// 비포 마운트 처리
onBeforeMount(() => {
    store.dispatch(actionName, searchData);
});

const userQuestion = computed(() => store.state.question.questionList);

// 필터 관련
const searchData = reactive({
    user_id: store.state.auth.userInfo.user_id,
    page: store.state.pagination.currentPage,
});

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
    /* background-color: rgb(133, 177, 218);
    color: #01083a; */
    background-color: #7e7e85;
    color: #ffffff;
    transition: ease-in-out 0.3s;
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

.question-content-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    max-width: 1250px;
    min-width: 500px;
    margin-bottom: 30px;
}

.question-title {
    display: grid;
    grid-template-columns: 1fr 1fr 9fr 2.5fr;
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
    grid-template-columns: 1fr 1fr 9fr 2.5fr;
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