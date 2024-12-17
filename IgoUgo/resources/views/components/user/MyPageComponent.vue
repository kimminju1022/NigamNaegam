<template>
    <div class="my-page">
        <div>
            <div class="my-profile-box">
                <div class="my-profile-img">
                    <img src="/logo_gam.png" alt="">
                </div>
                <div class="my-profile-content">
                    <div class="profile-item">
                        <p class="bg-navy">이메일</p>
                        <p>admin@admin.com</p>
                    </div>
                    <div class="profile-item">
                        <p class="bg-navy">이름</p>
                        <p>김그린</p>
                    </div>
                    <div class="profile-item">
                        <p class="bg-navy">닉네임</p>
                        <p>그린컴퓨터</p>
                    </div>
                    <div class="profile-item">
                        <p class="bg-navy">전화번호</p>
                        <p>010-2345-6789</p>
                    </div>
                </div>
            </div>
            <div class="my-profile-update-btn">
                <router-link to="/myPage/update"><button class="btn bg-navy">수정</button></router-link>
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
        <div>
            <div class="question-box">
                <h3>나의 문의 내역</h3>
                <div class="question-content-box">
                    <div class="question-title">
                        <p>번호</p>
                        <p>상태</p>
                        <p>제목</p>
                        <p>작성일자</p>
                    </div>
                    <hr>
                    <div class="question-content">
                        <p>5</p>
                        <p class="reply-yet">대기</p>
                        <a href="">대표가 정말 뽀빠이인가요?</a>
                        <p>2024-12-05</p>
                    </div>
                    <div class="question-content">
                        <p>4</p>
                        <p class="reply-yet">대기</p>
                        <a href="">깁스는 언제 풀 수 있을까요?</a>
                        <p>2024-12-05</p>
                    </div>
                    <div class="question-content">
                        <p>3</p>
                        <p class="reply-done">완료</p>
                        <a href="">충격파 치료가 그렇게 아픈가요?</a>
                        <p>2024-12-05</p>
                    </div>
                    <div class="question-content">
                        <p>2</p>
                        <p class="reply-done">완료</p>
                        <a href="">여백의 미가 진정한 미인가요?</a>
                        <p>2024-12-05</p>
                    </div>
                    <div class="question-content">
                        <p>1</p>
                        <p class="reply-done">완료</p>
                        <a href="">세븐밸리 살려내라</a>
                        <p>2024-12-05</p>
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
        </div>
        
        <div>
            
            <button class="btn bg-clear btn-exit">회원 탈퇴  ></button>
        </div>
    </div>
</template>

<script setup>
// import { onBeforeUnmount, onMounted, ref } from 'vue';

// const flg = ref('0');

// const flgSetUp = () => {
//     flg.value = window.innerWidth > 390 ? '0' : '1';
// }

// onMounted(() => {
//     flgSetUp();
//     window.addEventListener('resize', flgSetUp);
// });

// onBeforeUnmount(() => {
//     window.removeEventListener('resize', flgSetUp);
// });


// **************************************************************************************
import { ref, onMounted, onUnmounted } from 'vue';

// 반응형 상태를 저장하는 변수
const isMobileView = ref(false);

// 화면 너비를 확인하는 함수
const checkScreenWidth = () => {
    isMobileView.value = window.innerWidth <= 320;
};

// 컴포넌트가 마운트되면 현재 너비 확인 및 이벤트 리스너 등록
onMounted(() => {
    checkScreenWidth(); // 초기 너비 확인
    window.addEventListener('resize', checkScreenWidth); // 리사이즈 이벤트 등록
});

// 컴포넌트가 언마운트되면 이벤트 리스너 제거
onUnmounted(() => {
    window.removeEventListener('resize', checkScreenWidth);
});

</script>

<style scoped>
.my-page {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 400px 1fr;
    place-items: center;
    gap: 70px;
    width: 100%;
}

.my-page > div {
    width: 100%;
}

/* 프로필 */

.my-profile-box {
    display: grid;
    grid-template-columns: 1fr 1fr;
    place-items: center;
    padding: 20px;
    background: rgba(133, 177, 218, 0.2);
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

.my-profile-update-btn button:hover {
    background-color: rgb(133, 177, 218);
    color: #01083a;
}

/* 탈퇴 버튼 */

.btn-exit {
    font-size: 15px;  
    padding: 7px 15px;
    border-radius: 50px; 
    color: #929292; 
}

/* **************************************** */

/* 1:1 문의내역 */

.question-box h3{
    margin-bottom: 30px;
    font-size: 30px;
    color: #01083a;
}

.question-content-box {
    border-top: 1px solid #01083a;
    border-bottom: 1px solid #01083a;
    max-width: 1250px;
    min-width: 500px;
    margin-bottom: 30px;
    /* color: #01083a; */
}

.question-title {
    display: grid;
    grid-template-columns: 1fr 1fr 9fr 2.5fr;
    text-align: center;
    padding: 10px;
    font-weight: 600;
    font-size: 18px;
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
}

.reply-yet {
    color: red;
}

.reply-done {
    color: blue;
}

/* 페이지네이션 */

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    min-width: 340px;
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