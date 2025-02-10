<template>
    <div class="que-container">
        <div>
            <p class="que-title">문의 관리</p>
            <hr class="hr-style">
        </div>
        <div class="que-content-container">
            <div class="que-content-box">
                <p class="que-content-title">문의 대기</p>
                <div>
                    <div class="que-list-title title-first">
                        <p>번호</p>
                        <p>카테고리</p>
                        <p>제목</p>
                        <p>작성자</p>
                        <p>작성일자</p>
                    </div>
                    <div class="que-list-box">
                        <div class="que-item item-first">
                            <p>3</p>
                            <p>호텔</p>
                            <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                            <p>유저이름</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div class="que-item item-first">
                            <p>2</p>
                            <p>호텔</p>
                            <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                            <p>유저이름</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div class="que-item item-first">
                            <p>1</p>
                            <p>호텔</p>
                            <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                            <p>유저이름</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="que-content-box">
                <p class="que-content-title">문의 완료</p>
                <div>
                    <div class="que-list-title title-second">
                        <p>번호</p>
                        <p>카테고리</p>
                        <p>제목</p>
                        <p>작성자</p>
                        <p>작성일자</p>
                        <p>관리자</p>
                        <p>답변일자</p>
                    </div>
                    <div class="que-list-box">
                        <div class="que-item item-second">
                            <p>3</p>
                            <p>호텔</p>
                            <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                            <p>유저이름</p>
                            <p>2025-02-06 00:00:00</p>
                            <p>관리자</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div class="que-item item-second">
                            <p>2</p>
                            <p>호텔</p>
                            <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                            <p>유저이름</p>
                            <p>2025-02-06 00:00:00</p>
                            <p>관리자</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div class="que-item item-second">
                            <p>1</p>
                            <p>호텔</p>
                            <p>호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔호텔</p>
                            <p>유저이름</p>
                            <p>2025-02-06 00:00:00</p>
                            <p>관리자</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* 문의 관리 큰 틀 */
.que-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 문의 관리 타이틀 */
.que-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    width: 500px;
    margin-top: 5px;
}

/* 문의 내역 리스트 관련 */
.que-content-container {
    display: grid;
    grid-template-rows: 1fr 1fr;
    gap: 20px;
}
.que-content-box {
    padding: 20px 10px;
    background-color: #fff;
    display: grid;
    grid-template-rows: 30px 1fr;
    gap: 10px;
}
.que-content-title {
    font-size: 20px;
    margin-left: 10px;
}
.que-list-title {
    display: grid;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.title-first {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr;
}
.title-second {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr 1fr 1.5fr;
}
.que-list-box {
    padding: 5px;
}
.que-item {
    display: grid;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.item-first {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr;
}
.item-second {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr 1fr 1.5fr;
}
.que-item > p:nth-child(3) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>