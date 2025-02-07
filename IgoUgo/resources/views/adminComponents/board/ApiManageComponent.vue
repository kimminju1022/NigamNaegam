<template>
    <div class="api-container">
        <div>
            <p class="api-title">API통합 관리</p>
            <hr class="hr-style">
        </div>
        <div class="api-content-box">
            <div class="api-list-title">
                <p>전체 개수</p>
                <p>수정날짜</p>
            </div>
            <div class="api-list-box" >
                <div class="api-item">
                    <p>222222</p>
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
/* API통합 관리 큰 틀 */
.api-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* API통합 관리 타이틀 */
.api-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    width: 500px;
    margin-top: 5px;
}

/* API 내용 영역 */
.api-content-box {
    height: 100%;
    background-color: #fff;
    padding: 20px 10px;
}
.api-list-title {
    display: grid;
    grid-template-columns: 1fr 1fr;
    text-align: center;
    padding: 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.api-list-box {
    padding: 5px;
}
.api-item{
    display: grid;
    grid-template-columns: 1fr 1fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
</style>