<template>
    <div class="tester-container">
        <div>
            <p class="tester-title">체험단</p>
            <hr class="hr-style">
        </div>
        <div class="tester-content-box">
            <div class="tester-list-title">
                <p>번호</p>
                <p>지역</p>
                <p>상품 이름</p>
                <p>게시글 제목</p>
                <p>댓글 수</p>
                <p>관리자 이름</p>
                <p>작성날짜</p>
                <p>마감날짜</p>
                <p>당첨인원</p>
            </div>
            <div class="tester-list-box" >
                <div class="tester-item">
                    <p>3</p>
                    <p>서울</p>
                    <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                    <p>제목제목제목제목제목제목제목제목제목제목제목제목제목제목제목제목</p>
                    <p>50</p>
                    <p>김지민</p>
                    <p>2025-02-06 00:00:00</p>
                    <p>2025-02-06 00:00:00</p>
                    <p></p>
                    <!-- 당첨인원은 마감일자 후에 띄우기 -->
                </div>
                <div class="tester-item">
                    <p>2</p>
                    <p>서울</p>
                    <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                    <p>제목제목제목제목제목제목제목제목제목제목제목제목제목제목제목제목</p>
                    <p>50</p>
                    <p>김지민</p>
                    <p>2025-02-06 00:00:00</p>
                    <p>2025-02-06 00:00:00</p>
                    <p>5</p>
                </div>
                <div class="tester-item">
                    <p>1</p>
                    <p>서울</p>
                    <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                    <p>제목제목제목제목제목제목제목제목제목제목제목제목제목제목제목제목</p>
                    <p>50</p>
                    <p>김지민</p>
                    <p>2025-02-06 00:00:00</p>
                    <p>2025-02-06 00:00:00</p>
                    <p>7</p>
                </div>
                <div style="text-align: center;">여기에도 페이지네이션 넣어야함</div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* 체험단 큰 틀 */
.tester-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 체험단 타이틀 */
.tester-title {
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
.tester-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.tester-list-title {
    display: grid;
    grid-template-columns: 0.5fr 0.5fr 1.5fr 1.5fr 0.5fr 1fr 1fr 1fr 0.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.tester-list-box {
    padding: 5px;
}
.tester-item{
    display: grid;
    grid-template-columns: 0.5fr 0.5fr 1.5fr 1.5fr 0.5fr 1fr 1fr 1fr 0.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.tester-item > p:nth-child(n + 3):nth-child(-n + 4) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>