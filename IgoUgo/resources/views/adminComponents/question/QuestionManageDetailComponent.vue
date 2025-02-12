<template>
<div class="que-container">
        <div>
            <p class="que-title">문의 상세</p>
            <hr class="hr-style">
        </div>
        <div class="que-content-container">
            <div class="que-content-box">
                <h3>유저 문의</h3>
                <div class="que-content-head">
                    <div class="que-content que-content-number">
                        <p>글번호</p>
                        <p>30</p>
                    </div>
                    <div class="que-content que-content-title">
                        <p>제목</p>
                        <input placeholder="내용" readonly>
                    </div>
                    <div class="que-content que-content-user">
                        <p>닉네임</p>
                        <p>2025-02-12 00:00:00</p>
                    </div>
                </div>
                    <textarea readonly>내용</textarea>
                </div>
            <div class="que-content-box">
                <h3>관리자 답변</h3>
                <div>
                    <textarea name="" id="">여기는 관리자 답변</textarea>
                </div>
                <div class="que-content-user">
                    <p>관리자 이름</p>
                    <p>답변 시간</p>
                </div>
            </div>
        </div>
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

/* 문의 내역 리스트 관련 */
.que-content-container {
    display: grid;
    grid-template-rows: 1fr 1fr;
    gap: 20px;
}
.que-content-box {
    padding: 10px;
    background-color: #fff;
}

.que-content-head {
    display: grid;
    gap: 20px;
    border-bottom: 1px solid #000;
    grid-template-columns: 1.5fr 7fr 3fr;
    margin-top: 5px;
}

.que-content {
    display: flex;
    font-size: 18px;
    gap: 10px;
}

/* .que-content:not(:last-child), .que-content > :first-child {
    border-right: 1px solid #000;
} */

.que-content-number {
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.que-content-title {
    display: grid;
    grid-template-columns: 1fr 7fr;
}

.que-content-user {
    display: grid;
    grid-template-columns: 1fr 2fr;
}

textarea {
    resize: none;
    width: 100%;
    height: 80%;
    margin-top: 10px;
    font-size: 17px;
    background: #000;
    color: #fff;
}



.que-list-title {
    display: grid;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.title-first {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr;
}
.title-second {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr 1fr 1.5fr;
}
.que-list-box {
    padding: 5px;
}
.que-item {
    display: grid;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.item-first {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr;
}
.item-second {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr 1fr 1.5fr;
}
.item-first > a, .item-second > a {
    width: 90%;
    margin: 0 auto;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.que-item > p:nth-child(3) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>