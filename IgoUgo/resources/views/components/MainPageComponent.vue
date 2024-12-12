<template>
<div class="main-page-container">
    <div>
        <img src="default/main_banner.png" class="main-banner-img">
    </div>
    
    <div class="check-container">
        <h2>함께 감? 같이 감!</h2>
    </div>
    
    <div class="check-container">
        <h2>광고</h2>
    </div>
    
    <div class="check-container">
        <h2>현재 인기글</h2>
        <div>
            <h2>리뷰</h2>
        </div>

        <div>
            <h2>자유</h2>
        </div>
    </div>
    
    <div class="check-container">
        <h2>광고</h2>
    </div>
</div>
</template>

<script setup>
</script>

<style scoped>
/* 크기 체크를 위한 컨테이너 - 나중에 지울것 */
.check-container {
    border: 1px solid #000;
}

/* 전체를 감싸는 컨테이너 */
.main-page-container {
    display: flex;
    flex-direction: column;
    gap: 100px;
}

.main-banner-img {
    width: 100%;
}
</style>