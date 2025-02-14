<template>
<div class="tester-container">
        <div class="header-flex">
            <div>
                <p class="tester-title">체험단</p>
                <hr class="hr-style">
            </div>
            <div class="header-btn">
                <button class="btn bg-navy btn-list">수정</button>
                <button class="btn bg-navy btn-list">취소</button>
                <button class="btn bg-navy btn-list">삭제</button>
            </div>
        </div>
        <div class="tester-content-box">
            <!-- <div class="tester-list-title"> -->
                <!-- <p>번호</p>
                <p>지역</p>
                <p>가게 이름</p>
                <p>게시글 제목</p>
                <p>댓글 수</p>
                <p>관리자 이름</p>
                <p>작성날짜</p>
                <p>마감날짜</p>
                <p>당첨인원</p>
            </div>
            <div class="tester-list-box">
                <div>

                </div>
            </div> -->
        </div>
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

.header-flex {
    display: flex;
    justify-content: space-between;
}

.header-btn {
    display: flex;
    gap: 10px;
}

.btn-list {
    width: 70px;
    height: 45px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 20px;
}

.btn-list:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
}

.btn-create:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
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

/* 게시판 리스트 */
.tester-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.tester-list-title {
    display: grid;
    grid-template-columns: 0.5fr 0.5fr 1.5fr 1.5fr 0.5fr 0.5fr 1fr 1fr 0.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    border-bottom: 1px solid #01083a;
}
.tester-list-box {
    padding: 5px;
}
.tester-list-box > div {
    margin-bottom: 15px;
}
.tester-item{
    display: grid;
    grid-template-columns: 0.5fr 0.5fr 1.5fr 1.5fr 0.5fr 0.5fr 1fr 1fr 0.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 15px;
}
.tester-item > :nth-child(n + 3):nth-child(-n + 4) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>