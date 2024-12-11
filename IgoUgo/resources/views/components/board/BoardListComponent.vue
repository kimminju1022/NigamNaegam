<template>
<div class="board-head">
    <div class="board-category">
        <select name="select-category" id="select-category">
            <option value="none" selected>카테고리</option>
            <option value="1">맛집</option>
            <option value="2">액티비티</option>
            <option value="3">힐링</option>
            <option value="4">쇼핑</option>        
        </select>
    </div>
    <input v-model="search" class="board-search" type="text" placeholder="검색어를 입력해 주세요">
    <button class="board-search-btn">검색</button>
</div>

<!-- 리스트항목 -->
    <div class="board-list">
        <!-- 리스트 헤드 -->
        <div class="board-li-title">
            <span>번호</span>
            <span>지역</span>
            <span>제목</span>
            <span>닉네임</span>
            <span>작성일자</span>
            <span>좋아요</span>
            <span>조회수</span>
        </div>
        <!-- 리스트 목록 -->
        <div class="board-li-items">
            <div id="board-li-item">
                <p>5</p>
                <p>공지</p>
                <p>12월 여행 주의 사항</p>
                <p>라라핑</p>
                <p>2024.12.11</p>
                <p>2</p>
                <p>50</p>
            </div>
            <div id="board-li-item">
                <p>4</p>
                <p>공지</p>
                <p>11월 단풍놀이 명소 전국 Top 20</p>
                <p>차나핑</p>
                <p>2024.11.11</p>
                <p>20</p>
                <p>50</p>
            </div>
            <div id="board-li-item">
                <p>3</p>
                <p>공지</p>
                <p>11월 여행 주의 사항</p>
                <p>라라핑</p>
                <p>2024.11.11</p>
                <p>2</p>
                <p>30</p>
            </div>
            <div id="board-li-item">
                <p>2</p>
                <p>공지</p>
                <p>전국 여행자랑~ 여행자협회와 함께하는 여행후기 공모전</p>
                <p>믿어핑</p>
                <p>2024.11.01</p>
                <p>2</p>
                <p>50</p>
            </div>
            <div id="board-li-item">
                <p>1</p>
                <p>공지</p>
                <p>10월 여행 주의 사항</p>
                <p>차캐핑</p>
                <p>2024.12.11</p>
                <p>10</p>
                <p>30</p>
            </div>
            <div id="board-li-item">
                <p>22</p>
                <p>서울</p>
                <p>경복궁 야경과 함께하는 겨울 낭만코스</p>
                <p>햅삐햅삐햅삐</p>
                <p>2024.12.11</p>
                <p>5</p>
                <p>8</p>
            </div>
            <div id="board-li-item">
                <p>21</p>
                <p>포항</p>
                <p>루미나리에 반짝이는 겨울 낭만코스</p>
                <p>오징어</p>
                <p>2024.12.08</p>
                <p>15</p>
                <p>58</p>
            </div>
            <div id="board-li-item">
                <p>20</p>
                <p>포항</p>
                <p>과메기 익어가는 마을</p>
                <p>과메기</p>
                <p>2024.12.02</p>
                <p>35</p>
                <p>38</p>
            </div>
            <div id="board-li-item">
                <p>19</p>
                <p>서울</p>
                <p>환상의 나라 에버랜드보다 롯데월드</p>
                <p>루팡</p>
                <p>2024.12.02</p>
                <p>5</p>
                <p>8</p>
            </div>
            <div id="board-li-item">
                <p>18</p>
                <p>서울</p>
                <p>가로수길 가득메운 커피로드</p>
                <p>햅삐햅삐햅삐</p>
                <p>2024.11.28</p>
                <p>25</p>
                <p>80</p>
            </div>
        </div>

    </div>

<!-- 페이지네이션 -->

    <div class="pagination">
        <a href="#"><button class="btn bg-clear"><</button></a>
        <a href="#"><button class="btn bg-clear">1</button></a>
        <a href="#"><button class="btn bg-clear">2</button></a>
        <a href="#"><button class="btn bg-clear">3</button></a>
        <a href="#"><button class="btn bg-clear">4</button></a>
        <a href="#"><button class="btn bg-clear">5</button></a>
        <a href="#"><button class="btn bg-clear">></button></a>
    </div>
</template>
<script setup>

</script>

<style>

/* .board-search{
    
}
.select-categories{

} */
.board-head{
    display: flex;
    /* justify-content: space-between; */
    align-items: center;    
    gap: 30px; 
    margin: 50px auto;
}

.board-category{
    border-radius: 10px;
    line-height: 1.2rem;
    height: 1.2rem;
    margin-right: 20px;
}

.board-search {
    margin-left: 20px; 
    background-color: #e9e8e8;
    border-radius: 20px;
    width: 250px;
    height: 30px;
    text-indent: 20px; 
}
.board-search-btn{
    background-color: #01083a;
    border-radius: 15px;
    padding: 5px;
    margin-left: -65px;
    font-weight: 500;
    color: #fff;
}

.board-list{
    height: 500px;
}
.board-li-title{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1.5fr 1fr 1fr 1fr;
    text-align: center;
    min-width: 750px;
    width: 1150px;
    height: 40px;
    font-weight: 600;
    font-size: 1.2rem;
    letter-spacing: 0.3rem;
    border-bottom: double #01083a 5px;
}

#board-li-item{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1.5fr 1fr 1fr 1fr;
    text-align: center;
    min-width: 750px;
    width: 1150px;
    height: 30px;
    border-bottom: solid #01083a 1px;
    margin-top: 10px;
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
    /* border: 2px solid #01083a; */
    text-align: center;
}

.pagination button:hover, .pagination button:active {
    color: #fff;
    background: #01083a;
}
</style>