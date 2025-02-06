<template>
    <div class="tester-container">
        <div>
            <p class="tester-title">체험단</p>
            <hr class="hr-style">
        </div>
        <div></div>
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
</style>