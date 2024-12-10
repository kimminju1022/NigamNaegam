<template>
    <div class="my-page">
        <div class="my-profile-box">
            <div class="my-profile-img">
                <img src="/logo_gam.png" alt="">
            </div>
            <div class="my-profile-content">
                <div class="profile-item">
                    <p class="bg-navy">이메일</p>
                    <p>admin@admin.com</p>
                </div>
                <div class="profile-item">
                    <p class="bg-navy">이름</p>
                    <p>그린컴퓨터</p>
                </div>
                <div class="profile-item">
                    <p class="bg-navy">닉네임</p>
                    <p>그린</p>
                </div>
                <div class="profile-item">
                    <p class="bg-navy">전화번호</p>
                    <p>01023456789</p>
                </div>
            </div>
        </div>
        <div>
            <div class="question-box">
                <h3>나의 문의 내역</h3>
                <div class="question-content-box">
                    <div class="question-title">
                        <p>번호</p>
                        <p>답변상태</p>
                        <p>제목</p>
                        <p>닉네임</p>
                        <p>작성일자</p>
                    </div>
                    <hr>
                    <div class="question-content">
                        <p>5</p>
                        <p>답변대기</p>
                        <p>대표가 정말 뽀빠이인가요?</p>
                        <p>올리브</p>
                        <p>2024-12-05</p>
                    </div>
                    <div class="question-content">
                        <p>4</p>
                        <p>답변대기</p>
                        <p>깁스는 언제 풀 수 있을까요?</p>
                        <p>올리브</p>
                        <p>2024-12-05</p>
                    </div>
                    <div class="question-content">
                        <p>3</p>
                        <p>답변완료</p>
                        <p>충격파 치료가 그렇게 아픈가요?</p>
                        <p>올리브</p>
                        <p>2024-12-05</p>
                    </div>
                    <div class="question-content">
                        <p>2</p>
                        <p>답변완료</p>
                        <p>여백의 미가 진정한 미인가요?</p>
                        <p>올리브</p>
                        <p>2024-12-05</p>
                    </div>
                    <div class="question-content">
                        <p>1</p>
                        <p>답변완료</p>
                        <p>세븐밸리 살려내라</p>
                        <p>올리브</p>
                        <p>2024-12-05</p>
                    </div>
                </div>
            </div>
            <div class="pagination">
                <a href="#"><button class="btn bg-clear"><</button></a>
                <a href="#"><button class="btn bg-clear">1</button></a>
                <a href="#"><button class="btn bg-clear">2</button></a>
                <a href="#"><button class="btn bg-clear">3</button></a>
                <a href="#"><button class="btn bg-clear">4</button></a>
                <a href="#"><button class="btn bg-clear">5</button></a>
                <a href="#"><button class="btn bg-clear">></button></a>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
.my-page {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 400px 1fr;
    place-items: center;
    align-items: center;
    gap: 70px;
}

.my-profile-box {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 150px;
    width: 100vw;
    height: 300px;
    background: rgba(133, 177, 218, 0.2);
}

.my-profile-img > img {
    width: 200px;
    height: 200px;
}

.my-profile-content {
    padding: 10px;
}

.profile-item {
    display: flex;
    gap: 20px;
    margin-bottom: 10px;
}

.profile-item :nth-child(1) {
    width: 130px;
    /* height: 25px; */
    /* line-height: 30px; */
    padding: 10px 15px 10px 15px;
    font-weight: 600;
    text-align: center;
    border-radius: 15px;
    font-size: 20px;
}

.profile-item :nth-child(2) {
    width: 200px;
    /* height: 25px; */
    /* line-height: 30px; */
    padding: 10px 15px 10px 15px;
    font-weight: 500;
    text-align: center;
    font-size: 20px;
}

.question-box h3{
    margin-bottom: 20px;
    font-size: 30px;
    color: #01083a;
}

.question-content-box {
    border-top: 1px solid #01083a;
    border-bottom: 1px solid #01083a;
    width: 80vw;
    margin-bottom: 30px;
}

.question-title {
    display: grid;
    grid-template-columns: 1fr 1fr 10fr 1.5fr 2fr;
    text-align: center;
    padding: 10px;
}

.question-content-box > hr{
    color: #4c4c4c;
}

.question-content {
    display: grid;
    grid-template-columns: 1fr 1fr 10fr 1.5fr 2fr;
    text-align: center;
    padding: 10px;
}

.pagination {
    /* margin: 0 auto; */
    /* text-align: center; */
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

.pagination button {
    font-size: 20px;
    border-radius: 50px;
    width: 40px;
    height: 40px;
    /*  */
    border: 2px solid #01083a;
    text-align: center;
}

.pagination button:hover, .pagination button:active {
    color: #fff;
    background: #01083a;
}

</style>