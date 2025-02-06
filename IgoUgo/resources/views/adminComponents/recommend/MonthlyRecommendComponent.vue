<template>
    <div class="monthly-container">
        <div>
            <p class="monthly-title">이달의 추천</p>
            <hr class="hr-style">
        </div>
        <div></div>
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
</style>