<template>
    <main>
        <h2>문의게시판</h2>
        <div class="board-head">
            <div id="board-search-tb">
                <input v-model="search" class="board-search" type="text" placeholder="검색어를 입력해 주세요">
                <button class="btn bg-navy board-search-btn">검색</button>
            </div>
        </div>
        
    <!-- 리스트항목 -->
        <div class="board-list">
            <!-- 리스트 헤드 -->
            <div class="board-Qli-title">
                <span>번호</span>
                <span>답변상태</span>
                <span>제목</span>
                <span>닉네임</span>
                <span>작성일자</span>
            </div>
            <!-- 리스트 목록 -->
            <div class="board-Qli-items">
                <div id="board-Qli-notice" >
                    <div id="board-Qli-item">
                        <p>5</p>
                        <p>공지</p>
                        <p>파일업로드 오류 시 간단해결방법</p>
                        <p>라라핑</p>
                        <p>2024.12.11</p>
                    </div>
                    <div id="board-Qli-item">
                        <p>4</p>
                        <p>공지</p>
                        <p>로그인 에러 시 문의방법</p>
                        <p>차나핑</p>
                        <p>2024.11.11</p>
                    </div>
                    <div id="board-Qli-item">
                        <p>3</p>
                        <p>공지</p>
                        <p>게시글 수정 오류 해결방법</p>
                        <p>라라핑</p>
                        <p>2024.11.11</p>
                    </div>
                    <div id="board-Qli-item">
                        <p>2</p>
                        <p>공지</p>
                        <p>자주 질문하는 오류 해결방법</p>
                        <p>믿어핑</p>
                        <p>2024.11.01</p>
                    </div>
                    <div id="board-Qli-item">
                        <p>1</p>
                        <p>공지</p>
                        <p>민원 해결 절차 안내</p>
                        <p>차캐핑</p>
                        <p>2024.12.11</p>
                    </div>
                </div>
                <div id="board-Qli-item">
                    <p>22</p>
                    <p>답변완료</p>
                    <p>게시글 오류</p>
                    <p>햅삐햅삐햅삐</p>
                    <p>2024.12.11</p>
                </div>
                <div id="board-Qli-item">
                    <p>21</p>
                    <p>답변완료</p>
                    <p>비밀번호 오류</p>
                    <p>오징어</p>
                    <p>2024.12.08</p>
                </div>
                <div id="board-Qli-item">
                    <p>20</p>
                    <p>답변대기</p>
                    <p>신고글 재게시</p>
                    <p>과메기</p>
                    <p>2024.12.02</p>
                </div>
                <div id="board-Qli-item">
                    <p>19</p>
                    <p>답변완료</p>
                    <p>메인에 보이는 여행지 사진 포토스팟 문의</p>
                    <p>루팡</p>
                    <p>2024.12.02</p>
                </div>
                <div id="board-Qli-item">
                    <p>18</p>
                    <p>답변대기</p>
                    <p>너네 일 너무 잘 하는거 아니야 이렇게 잘 하면</p>
                    <p>햅삐햅삐햅삐</p>
                    <p>2024.11.28</p>
                </div>
                <div id="board-Qli-item">
                    <p>5</p>
                    <p>답변완료</p>
                    <p>답변을 확인할 수 없어요</p>
                    <p>라라핑</p>
                    <p>2024.12.11</p>
                </div>
                <div id="board-Qli-item">
                    <p>4</p>
                    <p>답변완료</p>
                    <p>마이페이지 프로필 수정 문의</p>
                    <p>차나핑</p>
                    <p>2024.11.11</p>
                </div>
            </div>
        </div>
    </main>
<!-- 페이지네이션 -->
    <footer>
        <div class="pagination">
            <a href="#"><button class="btn bg-clear"><</button></a>
            <a href="#"><button class="btn bg-clear">1</button></a>
            <a href="#"><button class="btn bg-clear">2</button></a>
            <a href="#"><button class="btn bg-clear">3</button></a>
            <a href="#"><button class="btn bg-clear">4</button></a>
            <a href="#"><button class="btn bg-clear">5</button></a>
            <a href="#"><button class="btn bg-clear">></button></a>
        </div>
        <router-link to="/boards/create"><button class="btn bg-navy board-create-btn">작성</button></router-link>
    </footer>
</template>
<script setup>

import { onBeforeMount } from 'vue';

// 비포마운트처리
// onBeforeMount(() => {
//     console.log('보드다');
// });
</script>
<style scoped>  
footer{
    height: 30px;
    display: inline;
}                                                                                      
.scroll{
    display: inline-block;
    width: 100px;
    height: 200px;  
    padding: 20px;
    overflow-y: scroll;
    border: 1px solid black;
    box-sizing: border-box;
    color: white;
    font-family: 'Nanum Gothic';
    background-color: #01083a55;
}

/*** Box1 스크롤바 설정 ***/
/* 스크롤바 설정*/
select-category::-webkit-scrollbar{
    width: 10px;
}
.select-category::-webkit-scrollbar:vertical {
    width: 10px;
}
.select-category::-webkit-scrollbar:horizontal {
    height: 10px;
}
/* 스크롤바 막대 설정*/
.select-category::-webkit-scrollbar-thumb{
    background-color: rgba(239, 242, 247, 0.1);
    border-radius: 10px;
    border: 2px solid #1f2845;;
}
/* 스크롤바 뒷 배경 설정*/
.select-category::-webkit-scrollbar-track{
    border-radius: 10px;
    background-color: #1f2845;
}
/*  */
main{
    align-items: center;

}

.board-head{
    display: flex;
    justify-content: space-between;
    /* display: grid; */
    grid-template-columns: 2fr 7fr;
    align-items: center;    
    gap: 30px; 
    margin: 50px auto;
    min-width: 800px;
}

.board-category{
    border-radius: 10px;
    height: 1.2rem;
    display: inline-flex;
    justify-content:end;
    margin: 10px 20px;
    gap: 30px;
}

#board-Qli-notice {
    font-weight: 500;
    font-size: 1.2rem;
    background-color: #eeeeeec0;
    padding: 10px;
}
#board-Qli-item>p:nth-child(3){
    text-align: left;
    overflow: hidden;
}

#board-search-tb{
    display: inline-flex;
    /* float: right; */
    justify-content:end;
    align-items: flex-end;
}
.board-search {
    /* margin-right: -22px;  */
    border: #01083a solid 1px;
    color: #01083a;
    border-radius: 20px;
    width: 300px;
    height: 31px;
    text-indent: 20px; 
    margin-right: 30px;
}

.board-search-btn{
    font-size: large;
    float: right;
    border-radius: 20px;
    width: 70px;
    height: 32px;
}
.board-create-btn{
    float: right;
    font-size: large;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-top: -30px;
}

.board-list{
    height: auto;
    width: 100%;
    /* justify-content: center;
    align-content: center; */
}
.board-Qli-title{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1.5fr 1.5fr;
    text-align: center;
    width: 100%;
    height: 40px;
    font-weight: 600;
    font-size: 1.2rem;
    letter-spacing: 0.3rem;
    border-bottom: double #01083a 5px;
}
.select-category{
    width: 100px;
    height: 30px;
    text-align: center;
    border: solid #01083a 1px;
    border-radius: 20px;
    font-size: 1.2rem;
}
.select-category>option{
    border: none;
}
#board-Qli-item{
    display: grid;
    grid-template-columns: 1fr 1fr 5fr 1.5fr 1.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 30px;
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

@media screen and (max-width: 1000px) {
    /* .board-Qli-title > span:nth-child(2),
    .board-Qli-title > span:nth-child(3),
    .board-Qli-title > span:nth-child(4) { 
        display: block; /* 2, 3, 4번째 요소만 보이게 */ 
    /* } 
    .board-category{
        display: flex;
        text-align: end;
    }
    .board-Qli-title{
        display: grid;
        grid-template-columns: 1fr 5fr 1.5fr;
    }
    .board-Qli-title > span {
        display: none;
    }
    .board-head{
    display: grid;
    grid-template-rows: repeat(2, 1fr);
    align-items: center;    
    gap: 30px; 
    margin: 50px auto;} */

}
</style>