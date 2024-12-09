<template>
    <div class="filter-price">
        <p class="text-box">필터링</p>
        <input class="input-box" id="nosmoke" type="checkbox">
        <label for="nosmoke">금연</label>

        <input class="input-box" id="wifi" type="checkbox">
        <label for="wifi">무료 Wi-fi</label>

        <input class="input-box" id="morning" type="checkbox">
        <label for="morning">조식</label>

        <input class="input-box" id="parking" type="checkbox">
        <label for="parking">주차</label>
    </div>
</template>

<script setup>

</script>

<style scoped>
    .filter-price {
        width: 90vw;
        height: 250px;
        border: 2px solid #000000;
        border-radius: 20px;
        margin: 25px auto;
        padding: 20px;
        font-size: 25px;
    }
    .text-box {
        width: 100px;
        height: 50px;
        background-color: #01083a;
        text-align: center;
        align-content: center;
        color: #ffff;
        border-radius: 10px;
    }
    .input-box {
        margin: 20px 5px 20px 50px;
        width: 20px;
        height: 20px;
        border: 1px solid #000000;
        border-radius: 10px;
        appearance: none;

    }
</style>