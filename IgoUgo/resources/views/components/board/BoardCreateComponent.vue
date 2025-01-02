<template>
    <div class="container">
        <h1>게시판 작성</h1>
        <div class="header-btn-box"> 
            <router-link :to="'/boards'"><button class="btn bg-navy header-btn">취소</button></router-link>
            <button @click="$store.dispatch('board/storeBoard', boardInfo)" class="btn bg-navy header-btn">완료</button>
        </div>
        <div class="board-box">  
            <div class="board-select-container">
                <div class="select-board-type">
                    <p>게시판</p>
                    <select v-model="boardInfo.bc_type" name="bc_type" class="board-categories">
                        <!-- 초기 옵션값 3차에서 타입값 자동 출력 예정 -->
                        <option disabled hidden selected>--게시판선택--</option>
                        <option value="0">리뷰게시판</option>
                        <option value="1">자유게시판</option>
                    </select>
                </div>
                <div v-show="boardInfo.bc_type === '0'" class="board-review-box">
                    <div class="board-category">
                        <p>유형</p>
                        <select v-model="boardInfo.rc_type" name="rc_type">
                            <option disabled hidden selected>--유형선택--</option>
                            <option value="0">숙박</option>
                            <option value="1">맛집</option>
                            <option value="2">관광</option>
                            <option value="3">문화</option>
                            <option value="4">레포츠</option>
                            <option value="5">쇼핑</option>
                        </select>
                    </div>
                    <div class="board-category">
                        <p>지역</p>
                        <select v-model="boardInfo.area_code" name="area_code">
                            <option disabled hidden selected>--지역선택--</option>
                            <option value="1">서울</option>
                            <option value="2">인천</option>
                            <option value="3">대전</option>
                            <option value="4">대구</option>
                            <option value="5">광주</option>
                            <option value="6">부산</option>
                            <option value="7">울산</option>
                            <option value="8">세종</option>
                            <option value="31">경기</option>
                            <option value="32">강원</option>
                            <option value="33">충북</option>
                            <option value="34">충남</option>
                            <option value="35">경북</option>
                            <option value="36">경남</option>
                            <option value="37">전북</option>
                            <option value="38">전남</option>
                            <option value="39">제주</option>
                        </select>
                    </div>
                    <!--  v-for="searchItem in searchKeyword"  -->
                    <!-- <div id="board-search-tb">
                        <input v-model="keyword" class="board-search" type="text" placeholder="검색어를 입력해 주세요">
                        <button @click="keywordSearch" class="btn bg-navy board-search-btn">검색</button>
                    </div> -->
                    <!-- 별점 -->
                    <div class="board-starGrade board-category">
                        <p>별점</p>
                        <div class="star-grade">
                            <input type="radio" name="rate" id="star-1" class="star" value="1" v-model="boardInfo.rate">
                            <label for="star-1" class="star-label"></label>
            
                            <input type="radio" name="rate" id="star-2" class="star" value="2" v-model="boardInfo.rate">
                            <label for="star-2" class="star-label"></label>
            
                            <input type="radio" name="rate" id="star-3" class="star" value="3" v-model="boardInfo.rate">
                            <label for="star-3" class="star-label"></label>
            
                            <input type="radio" name="rate" id="star-4" class="star" value="4" v-model="boardInfo.rate">
                            <label for="star-4" class="star-label"></label>
            
                            <input type="radio" name="rate" id="star-5" class="star" value="5" v-model="boardInfo.rate">
                            <label for="star-5" class="star-label"></label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="board-title-box">
                <p>제목</p>
                <input v-model="boardInfo.board_title" type="text" name="board_title">
            </div>
            <div class="board-img">
                <p>파일 첨부</p>
                <div class="board-img-content">
                    <input @change="setFile1" type="file" name="board_img1" accept="image/*">
                    <input @change="setFile2" type="file" name="board_img2" accept="image/*">
                    <div class="img-preview">
                        <img :src="preview1">
                        <button @click="clearFile1" v-show="preview1" class="btn bg-clear">X</button>
                    </div>
                    <div class="img-preview">
                        <img :src="preview2">
                        <button @click="clearFile2" v-show="preview2" class="btn bg-clear">X</button>
                    </div>
                </div>
            </div>
            <div class="board-content">
                <p>내용</p>
                <textarea v-model="boardInfo.board_content" name="board_content"></textarea>
            </div>
        </div>
    </div>



    <!-- <h2>{{ boardTitle }}</h2> -->
    <!-- <div class="board-create-head">
        <h1>게시판 작성</h1>
        <div class="form-box">
            <router-link to="/boards"><button class="btn bg-clear board-create-btn">취소</button></router-link>
            <button class="btn bg-navy board-create-btn" @click="$store.dispatch('board/storeBoard', boardInfo)">완료</button>
        </div>
    </div>
    <hr> -->
    <!-- 선택박스 -->
    <!-- <div class="board-selectContainer">
        <div class="select-boardType">
            <h3></h3>
            <select v-model="boardInfo.bc_type" name="bc_type" class="board-categories"> -->
                <!-- 초기 옵션값 3차에서 타입값 자동 출력 예정 -->
                <!-- <option disabled hidden selected>--게시판선택--</option>
                <option value="0">리뷰게시판</option>
                <option value="1">자유게시판</option>
            </select>
        </div>
        <hr>
        <div v-show="boardInfo.bc_type === '0'" class="board-selectType">
            <h3 class="board-category">유형
                <select v-model="boardInfo.rc_type" name="rc_type" class="board-categories">
                    <option disabled hidden selected>--유형선택--</option>
                    <option value="0">숙박</option>
                    <option value="1">맛집</option>
                    <option value="2">관광</option>
                    <option value="3">문화</option>
                    <option value="4">레포츠</option>
                    <option value="5">쇼핑</option>
                </select>
            </h3>
            <h3 class="board-category">지역
                <select v-model="boardInfo.area_code" name="area_code" class="board-categories">
                    <option disabled hidden selected>--지역선택--</option>
                    <option value="1">서울</option>
                    <option value="2">인천</option>
                    <option value="3">대전</option>
                    <option value="4">대구</option>
                    <option value="5">광주</option>
                    <option value="6">부산</option>
                    <option value="7">울산</option>
                    <option value="8">세종</option>
                    <option value="31">경기</option>
                    <option value="32">강원</option>
                    <option value="33">충북</option>
                    <option value="34">충남</option>
                    <option value="35">경북</option>
                    <option value="36">경남</option>
                    <option value="37">전북</option>
                    <option value="38">전남</option>
                    <option value="39">제주</option>
                </select>
            </h3> -->
            <!--  v-for="searchItem in searchKeyword"  -->
            <!-- <div id="board-search-tb">
                <input v-model="keyword" class="board-search" type="text" placeholder="검색어를 입력해 주세요">
                <button @click="keywordSearch" class="btn bg-navy board-search-btn">검색</button>
            </div> -->
            <!-- 별점 -->
            <!-- <div class="board-starGrade">
                <h3>별점</h3>
                <div class="star-grade">
                    <input type="radio" name="rate" id="star-1" class="star" value="1" v-model="boardInfo.rate">
                    <label for="star-1" class="star-label"></label>
    
                    <input type="radio" name="rate" id="star-2" class="star" value="2" v-model="boardInfo.rate">
                    <label for="star-2" class="star-label"></label>
    
                    <input type="radio" name="rate" id="star-3" class="star" value="3" v-model="boardInfo.rate">
                    <label for="star-3" class="star-label"></label>
    
                    <input type="radio" name="rate" id="star-4" class="star" value="4" v-model="boardInfo.rate">
                    <label for="star-4" class="star-label"></label>
    
                    <input type="radio" name="rate" id="star-5" class="star" value="5" v-model="boardInfo.rate">
                    <label for="star-5" class="star-label"></label>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="board-create-container">
        <div class="board-create-title">
            <h3 style="margin-left: 10px;">제목</h3>
            <input v-model="boardInfo.board_title" type="text" name="board_title" placeholder="제목을 적어주세요" maxlength="100">
        </div>
        <hr>
        <div class="board-create-file">
            <h3 class="board-create-fileChoice">파일첨부</h3>
            <input @change="setFile1" type="file" name="board_img1" accept="imge/*">
            <input @change="setFile2" type="file" name="board_img2" accept="imge/*">
        </div>             -->
        <!--미리보기 삭제기능추가 -->
        <!-- <div class="board-imgPreview"> -->
            <!-- <img :src="previewImage.img">
            <button @click="deleteImg" class="btn btn-navy btn-imgBtn">✖</button> -->
            <!-- <input @change="setFile1" type="file" name="board_img1" accept="image/*">
            <input @change="setFile2" type="file" name="board_img2" accept="image/*"> -->
            <!-- <div class="img-preview">
                <img :src="preview1">
                <button @click="clearFile1" v-show="preview1" class="btn bg-clear">X</button>
            </div>
            <div class="img-preview">
                <img :src="preview2">
                <button @click="clearFile2" v-show="preview2" class="btn bg-clear">X</button>
            </div>
        </div> -->
        <!-- <img src="" alt=""> -->
        <!-- <hr>
        <textarea v-model="boardInfo.board_content" name="board_content" placeholder="당신의 이야기를 여기에 적어주세요" maxlength="2000"></textarea>
        <hr>
    </div> -->
    <!-- 내용 -->

</template>

<script setup>
import { reactive, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const boardInfo = reactive({
    board_title: ''
    ,board_content: ''
    ,board_img1: null
    ,board_img2: null
    ,bc_type: ''
    ,area_code: ''
    ,rc_type: ''
    ,rate: ''
});

const preview1 = ref('');
const preview2 = ref('');


const setFile1 = (e) => {
    boardInfo.board_img1 = e.target.files[0];
    preview1.value = URL.createObjectURL(boardInfo.board_img1);
}

const setFile2 = (e) => {
    boardInfo.board_img2 = e.target.files[0];
    preview2.value = URL.createObjectURL(boardInfo.board_img2);
}

const clearFile1 = () => {
    boardInfo.board_img1 = null;
    preview1.value = null;
}

const clearFile2 = () => {
    boardInfo.board_img2 = null;
    preview2.value = null;
}

</script>

<style scoped>
.container{
    align-items: center;
}

.container > h1 {
    font-size: 3rem;
    margin: 50px 0;
}

.header-btn-box {
    display: flex;
    justify-content: flex-end;
}

.header-btn{
    font-size: 18px;       
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-right: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header-btn:hover{
    color: #01083a;
    background-color: #fff;
    border: 2px solid #01083a;
}

.board-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    margin-top: 50px;
}

.board-box > div:not(:first-child){
    display: grid;
    grid-template-columns: 1fr 5fr;
    border-bottom: 1px solid #01083a;
}

.board-box > div:not(:first-child) > :first-child, .select-board-type > p:first-child, .board-category :first-child{
    border-right: 1px solid #01083a;
}

.select-board-type > p:first-child
,.board-title-box > p:first-child
,.board-img > p:first-child
,.board-content> p:first-child
,.board-category > p:first-child {
    font-size: 20px;
    text-align: center;
    font-weight: 600;
}

.board-box p, .board-title-box > input ,.board-content > textarea {
    padding: 10px;
    font-size: 17px;
}

/* .board-select-container {
    display: grid; */
    /* grid-template-rows: 1fr 1fr; */
/* } */

.select-board-type {
    display: grid;
    grid-template-columns: 1fr 5fr;
    border-bottom: 1px solid #01083a;
}

select {
    border: none;
    font-size: 17px;
    padding: 10px;
}

.select-board-type select {
    width: 20%;
}

.board-review-box {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    border-bottom: 1px solid #01083a;
}

.board-category {
    display: grid;
    grid-template-columns: 1.07fr 1fr;
}

.board-content > textarea {
    resize: none;
    height: 300px;
    margin: 10px;
}

.board-img-content {
    padding: 10px;
    display: grid;
    grid-template-columns: 1fr 1fr;
}

.board-img-content :nth-child(-n + 2) {
    margin-bottom: 10px;
} 

.board-img-content img {
    max-width: 150px;
    max-height: 150px;
}

.img-preview {
    display: flex;
}

.img-preview > button {
    width: 20px;
    height: 20px;
}

/* 별점 */

.star-grade {
    display: flex;
    flex-direction: row-reverse;    /* 별을 오른쪽에서 왼쪽으로 정렬 */
    justify-content: center;
    gap: 2px;
}
.star {
    display: none; 
}
.star-label {
    font-size: 30px;
    color: rgba(255, 217, 0, 0.5); /* 기본 별 색상 */
    /* cursor: pointer; */ /* 잔재주인데 포인터 할까? */
}

/* 기본 별 스타일 */
.star-label::before {
    content: '☆';
}

/* 체크된 별과 그 앞의 별들 */
.star:checked ~ .star-label::before {
    content: '★';
    color: rgba(255, 217, 0, 1);
}

/* 호버 상태 */
.star-label:hover ~ .star-label::before,
.star-label:hover::before {
    content: '★';
    color: rgba(255, 217, 0, 1);
}

/* 모달 - 검색 */
/* 모달 시 메인 배경 */
.board-create-modal{
    width: 100%;
    height: 100%;
    background-color: rgba(197, 198, 198, 0.374);
    position: fixed;
    padding: 20px;
}
/* 모달 디자인 */
.board-create-modal-content{
    width: 50%;
    background-color: azure;
    border-radius: 10px;
    padding: 20px;
}
.modal-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
}

@media screen and (max-width: 800px) {
    .board-detail-head {
        grid-template-columns: none; /*기존 가로 정렬 해제 */
        grid-template-rows: auto;  /*세로로 요소 쌓기 */
        align-items: center;  /*중앙 정렬 */
        text-align: center;  /*텍스트 중앙정렬 */
    }
}
</style>