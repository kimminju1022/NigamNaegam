<template>
    <div class="que-container">
        <div>
            <p class="que-title">문의 관리</p>
            <hr class="hr-style">
        </div>
        <div>
            <div class="que-content-box">
                <p>문의 대기</p>
                <div class="que-list-title">
                    <p>번호</p>
                    <p>지역</p>
                    <p>카테고리</p>
                    <p>상품 이름</p>
                    <p>작성일자</p>
                    <p>해당 월</p>
                </div>
            </div>
            <div class="que-content-box"></div>
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
    grid-template-rows: 50px 1fr;
}
/* .que-content-list-box {

}
.que-list-title {

} */
</style>