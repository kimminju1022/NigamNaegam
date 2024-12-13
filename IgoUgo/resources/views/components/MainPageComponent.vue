<template>
<div class="main-page-container">
    <div>
        <img src="default/main_banner.png" class="main-banner-img">
    </div>
    
    <div class="main-together-container">
        <div>
            <h2>같이 할래? 나랑! 너랑?</h2>
            <hr>
        </div>
        <div class="main-together-first">
            <div>
                <img src="default/board_default.png" class="main-together-img-big">
            </div>
            
            <div class="main-together-second">
                <div>재밋는 곳! 같이 감!</div>
                <hr>
                <div class="main-together-third">
                    <div class="main-card">
                        <img src="default/board_default.png" class="main-together-img">
                        <p>같이 체험할</p>
                    </div>
                    <div class="main-card">
                        <img src="default/board_default.png" class="main-together-img">
                        <p>체험상품들을</p>
                    </div>
                    <div class="main-card">
                        <img src="default/board_default.png" class="main-together-img">
                        <p>여기에 등록할것</p>
                    </div>
                    <div class="main-card">
                        <img src="default/board_default.png" class="main-together-img">
                        <p>디자인은 알아서</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <!-- 관광특구와 같은 홍보글 넣을것, 일단 이미지로 넣었음 -->
        <div class="main-ppl-container">
            <img src="default/profile_default.png" class="main-ppl-ex">
            <img src="default/board_default.png" class="main-ppl-ex">
            <img src="default/profile_default.png" class="main-ppl-ex">
        </div>
    </div>
    
    <div class="main-popular-container">
        <div>
            <h2>현재 인기글</h2>
            <hr>
        </div>
        <div>
            <h2>리뷰</h2>
            <div class="main-popular-box">
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
            </div>
        </div>

        <div>
            <h2>자유</h2>
            <div class="main-popular-box">
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
                <div class="main-card">
                    <img src="default/profile_default.png" class="main-together-img">
                    <p>리뷰 제목</p>
                    <p>작성자 닉네임</p>
                </div>
            </div>
        </div>
    </div>
    
    <div>
        <img src="default/gongzi.png">
    </div>
</div>
</template>

<script setup>
</script>

<style scoped>
/* 전체를 감싸는 컨테이너 */
.main-page-container {
    display: flex;
    flex-direction: column;
    gap: 100px;
}

/* 베너 */
.main-banner-img {
    width: 100%;
}

/* 같이할래 부분 */
.main-together-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.main-together-first {
    display: grid;
    grid-template-columns: 1fr 4fr;
    gap: 20px;
}
.main-together-second {
    padding: 50px 0;
}
.main-together-third {
    margin: 20px 0;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 10px;
}
.main-together-img {
    width: 200px;
    height: 200px;
}
.main-together-img-big {
    width: 300px;
    height: 500px;
}

/* 광고 관련 */
.main-ppl-container {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}
/* 광고 예시 이미지만 넣어두었으니 나중에 지울것 */
.main-ppl-ex {
    height: 100px;
}

/* 인기글 관련 */
.main-popular-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.main-popular-box {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

/* 카드 공통 */
.main-card {
    border: 1px solid #01083a;
    border-radius: 10px;
    min-width: 200px;
}
</style>