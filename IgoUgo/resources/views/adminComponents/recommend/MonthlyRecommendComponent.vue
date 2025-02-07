<template>
    <div class="monthly-container">
        <div class="monthly-header">
            <div>
                <p class="monthly-title">이달의 추천</p>
                <hr class="hr-style">
            </div>
            <div class="btn-area">
                <button class="btn bg-clear monthly-btn">작성</button>
            </div>
        </div>
        <div class="monthly-content-box">
            <div class="monthly-list-title">
                <p>번호</p>
                <p>지역</p>
                <p>카테고리</p>
                <p>상품 이름</p>
                <p>작성일자</p>
                <p>해당 월</p>
            </div>
            <div class="monthly-list-box" >
                <div class="monthly-item">
                    <p>3</p>
                    <p>서울</p>
                    <p>호텔</p>
                    <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                    <p>2025-01-01 00:00:00</p>
                    <p>2025-02</p>
                </div>
                <div class="monthly-item">
                    <p>2</p>
                    <p>서울</p>
                    <p>관광지</p>
                    <p>관광지관광지관광지관광지관광지관광지관광지관광지관광지관광지관광지관광지관광지관광지관광지관광지관광지관광지</p>
                    <p>2024-12-01 00:00:00</p>
                    <p>2025-01</p>
                </div>
                <div class="monthly-item">
                    <p>1</p>
                    <p>서울</p>
                    <p>쇼핑</p>
                    <p>쇼핑쇼핑쇼핑쇼핑쇼핑쇼핑쇼핑쇼핑쇼핑쇼핑쇼핑쇼핑</p>
                    <p>2024-11-01 00:00:00</p>
                    <p>2024-12</p>
                </div>
                <div style="text-align: center;">여기에도 페이지네이션 넣어야함</div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* 이달의 추천 큰 틀 */
.monthly-container {
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
.monthly-btn {
    font-size: 25px;
    font-weight: 600;
    padding: 5px 10px;
}
.monthly-btn:hover {
    border-radius: 10px;
    background-color: #01083a;
    color: #fff;
}

/* 이달의 추천 맨 위에 */
.monthly-header {
    display: flex;
    justify-content: space-between;
}

/* 이달의 추천 타이틀 */
.monthly-title {
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
.monthly-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.monthly-list-title {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 5fr 1.5fr 1fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.monthly-list-box {
    padding: 5px;
}
.monthly-item{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 5fr 1.5fr 1fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.monthly-item > p:nth-child(4) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>