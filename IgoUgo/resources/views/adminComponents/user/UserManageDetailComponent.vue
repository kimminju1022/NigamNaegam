<template>
    <div class="user-detail-container">
        <div>
            <p class="user-detail-title">회원정보</p>
            <hr class="hr-style">
        </div>
        <div class="user-detail-content-container">
            <div class="user-detail-box box1">
                <img class="user-profile" src="/logo_gam.png">
                <div class="user-personal-info">
                    <div class="user-info-list">
                        <p>이메일</p>
                        <p>비밀번호</p>
                        <p>이름</p>
                        <p>닉네임</p>
                        <p>전화번호</p>
                    </div>
                    <div class="user-info-list">
                        <p>tt@test.com</p>
                        <p>tttttt</p>
                        <p>테스트</p>
                        <p>테에스으트으</p>
                        <p>01000000000</p>
                    </div>
                </div>
                <button class="btn bg-navy user-detail-update-btn">수정</button>
            </div>
            <div class="user-detail-box"></div>
            <div class="user-detail-box">
                <div>
                    <div>
                        <p>신고 당한 게시글</p>
                    </div>
                    <div class="user-detail-list-title">
                        <p>신고</p>
                        <p>번호</p>
                        <p>제목</p>
                        <p>닉네임</p>
                        <p>이름</p>
                        <p>작성일자</p>
                    </div>
                    <div class="user-detail-list-box" >
                        <div class="user-detail-item">
                            <p>🚨</p>
                            <p>3</p>
                            <p>아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주</p>
                            <p>내가</p>
                            <p>누구게</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div class="user-detail-item">
                            <p></p>
                            <p>2</p>
                            <p>짧은 제목</p>
                            <p>알아서</p>
                            <p>뭐하게</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div class="user-detail-item">
                            <p>🚨</p>
                            <p>1</p>
                            <p>기이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이임</p>
                            <p>후후후</p>
                            <p>하하하</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div style="text-align: center;">여기에도 페이지네이션 넣어야함</div>
                    </div>
                </div>
                <div>
                    <div>
                        <p>신고 당한 댓글</p>
                    </div>
                    <div class="user-detail-list-title">
                        <p>신고</p>
                        <p>번호</p>
                        <p>제목</p>
                        <p>닉네임</p>
                        <p>이름</p>
                        <p>작성일자</p>
                    </div>
                    <div class="user-detail-list-box" >
                        <div class="user-detail-item">
                            <p>🚨</p>
                            <p>3</p>
                            <p>아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주아주</p>
                            <p>내가</p>
                            <p>누구게</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div class="user-detail-item">
                            <p></p>
                            <p>2</p>
                            <p>짧은 제목</p>
                            <p>알아서</p>
                            <p>뭐하게</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div class="user-detail-item">
                            <p>🚨</p>
                            <p>1</p>
                            <p>기이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이이임</p>
                            <p>후후후</p>
                            <p>하하하</p>
                            <p>2025-02-06 00:00:00</p>
                        </div>
                        <div style="text-align: center;">여기에도 페이지네이션 넣어야함</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* 유저 상세 큰 틀 */
.user-detail-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 유저 상세 타이틀 */
.user-detail-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    /* width: 500px; */
    margin-top: 5px;
}

/* 유저 상세 내용 영역 */
.user-detail-content-container {
    display: grid;
    grid-template-columns: 450px 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 20px;
}
.user-detail-box {
    background-color: #fff;
    padding: 30px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

/* 유저 내용 박스 1 */
.box1 {
    grid-row: 1 / 3;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 30px;
}
.user-profile {
    width: 200px;
    height: 200px;
    border: 1px solid #01083a;
    border-radius: 50%;
}
.user-personal-info {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 2fr;
    font-size: 20px;
}
.user-info-list p {
    margin: 10px 0;
}
.user-detail-update-btn {
    font-size: 20px;
    padding: 10px 20px;
    border-radius: 10px;
}
.user-detail-update-btn:hover {
    background-color: #fff;
    color: #01083a;
    border: 1px solid #01083a;
}
/* 유저 내용 박스 2 */
/* 유저 내용 박스 3 */
.user-detail-list-title {
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1fr 1fr 1.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.user-detail-list-box {
    padding: 5px;
}
.user-detail-item{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1fr 1fr 1.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
</style>