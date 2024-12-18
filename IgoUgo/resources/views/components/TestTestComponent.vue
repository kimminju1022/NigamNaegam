<template>
<div class="divisverysad">
    <div class="announcement">
        <div class="announcement-sidebar">
            <div>
                <p>내감!니감? 의<br>소식을<br>확인해보세요</p>
            </div>
            <div class="announcement-info">
                <p class="announcement-info-qna">문의 게시판 바로가기 →</p>
                <p>내감!니감?에 대한 궁금한 점을<br>물어보세요</p>
            </div>
        </div>
        <div class="announcement-item">
            <div>
                <p>공지사항</p> <button class="announcement-item-btn">바로가기</button>
            </div>
            <hr>
            <div> 
                <span>2024-12-17</span> <span>안녕하세요 반갑습니다.</span>
            </div>
            <hr>
            <div> 
                <span>2024-12-17</span> <span>안녕하세요 반갑습니다.</span> 
            </div>
            <hr>
            <div> 
                <span>2024-12-17</span> <span>안녕하세요 반갑습니다.</span> 
            </div>
            <hr>
            <div> 
                <span>2024-12-17</span> <span>안녕하세요 반갑습니다.</span> 
            </div>
            <hr>
            <div> 
                <span>2024-12-17</span> <span>안녕하세요 반갑습니다.</span> 
            </div>
            <hr>
        </div>
    </div>
</div>
</template>

<script>

</script>

<style scoped>

    .divisverysad {
        justify-self: center;
    }
    /* 내감니감의 소식을 확인해보세요 */
    .announcement {
        display: grid;
        grid-template-columns: 1fr 1fr;
        justify-items: center;
        max-width: 900px
    }
    .announcement-sidebar{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .announcement-sidebar>:nth-child(1) {
        /* align-content: center; */
        font-size: 25px;
    }
    
    /* 문의게시판 바로가기쪽 */
    .announcement-info {
        border: solid 1px #000000;
        padding: 10px;
        border-radius: 10px; 
    }
    .announcement-info-qna {
        font-size: 20px;
        padding: 5px 0;
    }

    /* 공지사항쪽 */
    hr {
        opacity: 50%;
    }
    .announcement-item {
        display: flex;
        flex-direction: column;
        border: solid 1px #000000;
        padding: 20px;
        border-radius: 10px;
        min-width: 600px;
        font-size: 16px;
        gap: 7px;
    }
    .announcement-item>:nth-child(1) {
        display: flex;
        font-size: 22px;
        justify-content: space-between;
        font-weight: 600;
    }
    .announcement-item-btn {
        border-style: none;
        background-color: transparent;
    }
</style>