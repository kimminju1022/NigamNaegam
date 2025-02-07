<template>
    <div class="noti-container">
        <div class="noti-header">
            <div>
                <p class="noti-title">공지사항</p>
                <hr class="hr-style">
            </div>
            <div class="btn-area">
                <button class="btn bg-clear noti-btn">작성</button>
            </div>
        </div>
        <div class="noti-content-box">
            <div class="noti-list-title">
                <p>번호</p>
                <p>제목</p>
                <p>관리자 이름</p>
                <p>작성일자</p>
            </div>
            <div class="noti-list-box" >
                <div class="noti-item">
                    <p>3</p>
                    <p>체험단 주의사항</p>
                    <p>이경진</p>
                    <p>2025-02-06 00:00:00</p>
                </div>
                <div class="noti-item">
                    <p>2</p>
                    <p>체험단 주의사항</p>
                    <p>이경진</p>
                    <p>2025-02-06 00:00:00</p>
                </div>
                <div class="noti-item">
                    <p>1</p>
                    <p>체험단 주의사항</p>
                    <p>이경진</p>
                    <p>2025-02-06 00:00:00</p>
                </div>
                <div style="text-align: center;">여기에도 페이지네이션 넣어야함</div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* 공지사항 큰 틀 */
.noti-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 버튼 */
.btn-area {
    display: flex;
    align-items: center;
}
.noti-btn {
    font-size: 25px;
    font-weight: 600;
    padding: 5px 10px;
}
.noti-btn:hover {
    border-radius: 10px;
    background-color: #01083a;
    color: #fff;
}

/* 공지사항 맨 위에 */
.noti-header {
    display: flex;
    justify-content: space-between;
}

/* 공지사항 타이틀 */
.noti-title {
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
.noti-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.noti-list-title {
    display: grid;
    grid-template-columns: 1fr 4fr 1fr 1fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.noti-list-box {
    padding: 5px;
}
.noti-item{
    display: grid;
    grid-template-columns: 1fr 4fr 1fr 1fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.noti-item > p:nth-child(3) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>