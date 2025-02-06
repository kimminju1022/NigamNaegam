<template>
    <div class="user-container">
        <div>
            <p class="user-title">유저 관리</p>
            <hr class="hr-style">
        </div>
        <div class="user-content-container">
            <div class="user-content-box">
                <div class="user-current-title">
                    <p>오늘의 유저 현황</p>
                </div>
                <div class="user-current-list">
                    <div class="user-current-item">
                        <p>신규 가입</p>
                        <p class="user-current-cnt">2</p>
                    </div>
                    <div class="user-current-item">
                        <p>탈퇴 회원</p>
                        <p class="user-current-cnt">5</p>
                    </div>
                    <div class="user-current-item">
                        <p>강제 탈퇴 회원</p>
                        <p class="user-current-cnt">10</p>
                    </div>
                    <div class="user-current-item">
                        <p>신고 누적 회원</p>
                        <p class="user-current-cnt">2</p>
                    </div>
                </div>
            </div>

            <div class="user-content-box">
                <div class="user-list-title">
                    <p>번호</p>
                    <p>닉네임</p>
                    <p>이름</p>
                    <p>가입일</p>
                    <p>게시글 수</p>
                    <p>댓글 수</p>
                </div>
                <div class="user-list-box" >
                    <div class="user-item">
                        <p>3</p>
                        <p>나다</p>
                        <p>이 새꺄</p>
                        <p>2025-02-06 00:00:00</p>
                        <p>100</p>
                        <p>50</p>
                    </div>
                    <div class="user-item">
                        <p>2</p>
                        <p>그렇게</p>
                        <p>다 가져가야만</p>
                        <p>2025-02-06 00:00:00</p>
                        <p>100</p>
                        <p>50</p>
                    </div>
                    <div class="user-item">
                        <p>1</p>
                        <p>속이</p>
                        <p>후련했냐!!</p>
                        <p>2025-02-06 00:00:00</p>
                        <p>100</p>
                        <p>50</p>
                    </div>
                    <div style="text-align: center;">여기에도 페이지네이션 넣어야함</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* 유저 관리 큰 틀 */
.user-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 유저 관리 타이틀 */
.user-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    /* width: 500px; */
    margin-top: 5px;
}

/* 내용 감싸는 틀 */
.user-content-container {
    display: grid;
    grid-template-rows: 1fr 5fr;
    gap: 20px;
}

/* 각각의 상자 */
.user-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}

/* 오늘의 유저 현황 관련 */
.user-current-list {
    display: flex;
    gap: 50px;
    margin: 30px 0 0 30px;
}
.user-current-item {
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    gap: 10px;
}
.user-current-title {
    font-size: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #01083a;
}
.user-current-title p {
    margin-left: 10px;
}
.user-current-cnt {
    color: #ff0000;
}

/* 유저 리스트 영역 관련 */
.user-list-title {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 2fr 1fr 1fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.user-list-box {
    padding: 5px;
}
.user-item{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 2fr 1fr 1fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
</style>