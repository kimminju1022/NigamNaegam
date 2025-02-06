<template>
    <div class="que-container">
        <div>
            <p class="que-title">문의 관리</p>
            <hr class="hr-style">
        </div>
        <div></div>
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
</style>