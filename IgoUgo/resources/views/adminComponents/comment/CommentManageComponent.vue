<template>
    <div class="comment-container">
        <div>
            <p class="comment-title">댓글 관리</p>
            <hr class="hr-style">
        </div>
        <div class="comment-content-box">
            <div class="comment-list-title">
                <p>신고</p>
                <p>글 번호</p>
                <p>댓글 내용</p>
                <p>닉네임</p>
                <p>이름</p>
                <p>작성일자</p>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>
/* 댓글 관리 큰 틀 */
.comment-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 댓글 관리 타이틀 */
.comment-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    width: 500px;
    margin-top: 5px;
}

/* 댓글 리스트 */
.comment-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}
.comment-list-title {
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1fr 1fr 1.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
</style>