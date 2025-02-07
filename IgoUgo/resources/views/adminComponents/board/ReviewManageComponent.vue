<template>
    <div class="review-container">
        <div>
            <p class="review-title">리뷰게시판</p>
            <hr class="hr-style">
        </div>
        <div class="review-content-box">
            <div class="review-list-title">
                <p>신고</p>
                <p>번호</p>
                <p>제목</p>
                <p>닉네임</p>
                <p>이름</p>
                <p>작성일자</p>
            </div>
            <div class="review-list-box" >
                <div class="review-item">
                    <p>🚨</p>
                    <p>3</p>
                    <p>아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주</p>
                    <p>내가</p>
                    <p>누구게</p>
                    <p>2025-02-06 00:00:00</p>
                </div>
                <div class="review-item">
                    <p></p>
                    <p>2</p>
                    <p>짧은 제목</p>
                    <p>알아서</p>
                    <p>뭐하게</p>
                    <p>2025-02-06 00:00:00</p>
                </div>
                <div class="review-item">
                    <p>🚨</p>
                    <p>1</p>
                    <p>기이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이임</p>
                    <p>후후후</p>
                    <p>하하하</p>
                    <p>2025-02-06 00:00:00</p>
                </div>
                <div style="text-align: center;">여기에도 페이지네이션 넣어야함</div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* 리뷰 게시판 큰 틀 */
.review-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 리뷰 게시판 타이틀 */
.review-title {
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
.review-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.review-list-title {
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1fr 1fr 1.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.review-list-box {
    padding: 5px;
}
.review-item{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1fr 1fr 1.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.review-item > p:nth-child(3) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>