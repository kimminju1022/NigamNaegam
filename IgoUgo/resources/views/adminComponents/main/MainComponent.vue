<template>
    <div class="mainpage-container">
        <div>
            <p class="main-title">메인 페이지</p>
            <!-- <hr class="hr-style"> -->
        </div>
        <div class="main-content-container">
            <div>
                <p class="main-stat-title">가입 현황</p>
                <div class="main-stat-box"></div>
            </div>
            <div>
                <p class="main-stat-title">탈퇴 현황</p>
                <div class="main-stat-box"></div>
            </div>
            <div>
                <p class="main-stat-title">리뷰 게시판</p>
                <div class="main-stat-box"></div>
            </div>
            <div>
                <p class="main-stat-title">자유 게시판</p>
                <div class="main-stat-box"></div>
            </div>
            <div>
                <p class="main-stat-title">문의 게시판 - 답변 대기</p>
                <div class="main-stat-box"></div>
            </div>
            <div>
                <p class="main-stat-title">문의 게시판 - 답변 완료</p>
                <div class="main-stat-box"></div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* 메인페이지 큰 틀 */
.mainpage-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 메인 페이지 타이틀 */
.main-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    width: 500px;
    margin-top: 5px;
}

/* 내용 컨테이너 */
.main-content-container {
    display: grid;
    grid-template-columns: repeat(3, minmax(300px, 1fr));
    gap: 30px;
}

/* 각 통계의 타이틀 */
.main-stat-title {
    font-size: 20px;
    margin-bottom: 10px;
}

/* 통계 넣을 박스 */
.main-stat-box {
    min-width: 300px;
    height: 350px;
    background-color: white;
}
</style>