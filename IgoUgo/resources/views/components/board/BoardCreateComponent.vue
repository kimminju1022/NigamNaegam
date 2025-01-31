<template>
    <div class="container">
        <h1>게시판 작성</h1>
        <div class="board-box">  
            <div class="board-select-container">
                <div class="select-board-type">
                    <p>게시판</p>
                    <select v-model="boardInfo.bc_code" name="bc_code" class="board-categories" readonly>
                        <!-- 초기 옵션값 3차에서 타입값 자동 출력 예정 -->
                        <!-- <option disabled hidden selected>--게시판선택--</option> -->
                        <option value="0">리뷰게시판</option>
                        <option value="1">자유게시판</option>
                    </select>
                </div>
                <div v-show="boardInfo.bc_code === '0'" class="board-review-box">
                    <div class="board-category">
                        <p>유형</p>
                        <select v-model="boardInfo.bc_code" name="bc_code">
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
                            <input type="radio" name="rate" id="star-1" class="star" value="5" v-model="boardInfo.rate">
                            <label for="star-1" class="star-label"></label>
            
                            <input type="radio" name="rate" id="star-2" class="star" value="4" v-model="boardInfo.rate">
                            <label for="star-2" class="star-label"></label>
            
                            <input type="radio" name="rate" id="star-3" class="star" value="3" v-model="boardInfo.rate">
                            <label for="star-3" class="star-label"></label>
            
                            <input type="radio" name="rate" id="star-4" class="star" value="2" v-model="boardInfo.rate">
                            <label for="star-4" class="star-label"></label>
            
                            <input type="radio" name="rate" id="star-5" class="star" value="1" v-model="boardInfo.rate">
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
                <input class="file-btn" @change="setFile" type="file" multiple accept="image/*" name="uploadFile">
                <div class="board-img-content">
                    <!-- <input @change="setFile" type="file" name="board_images[]" multiple accept="image/*"> -->
                    <div class="img-preview":class="gridDetail" v-for="(previewImage, index) in previews" :key="index">
                        <img :src="previewImage" alt="Uploaded Image"> 
                        <button @click="clearFile(index)" class="btn bg-clear">X</button> 
                    </div>
                    <!-- <input @change="setFile2" type="file" name="board_img2" accept="image/*"> -->
                    <!-- <div class="img-preview">
                        <img :src="preview2">
                        <button @click="clearFile2" v-show="preview2" class="btn bg-clear">X</button>
                    </div> -->
                </div>
            </div>
            <div class="board-content">
                <p>내용</p>
                <textarea v-model="boardInfo.board_content" name="board_content" placeholder="당신의 이야기를 남겨주세요\n ο"></textarea>
            </div>
        </div>
        <div class="success-btn-box"> 
            <router-link :to="'/boards'"><button class="btn bg-navy success-btn">취소</button></router-link>
            <button @click="$store.dispatch('board/storeBoard', boardInfo)" class="btn bg-navy success-btn">완료</button>
        </div>
    </div>


</template>

<script setup>
import { reactive, ref, computed} from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const boardInfo = reactive({
    board_title: ''
    ,board_content: ''
    ,board_img: []
    ,bc_code: store.state.board.bcCode
    ,area_code: ''
    ,bc_code: ''
    ,rate: ''
});

// img관련 ----------------------start *****
const previews = ref([]);
const maxFiles = 5; // 최대 파일 개수

const gridDetail = computed(() => {
    return previews.value.length >= 5
        ? 'grid-5'
        : previews.value.length === 4
        ? 'grid-4'
        : 'grid-3';
});

const setFile = (e) => {
    const arrayFiles = Array.from(e.target.files);
    const emptyFilesSpace = maxFiles - boardInfo.board_img.length - arrayFiles.length;

    // 5MB 이하 파일만 허용
    if(!arrayFiles.every(file => file.size <= 5 * 1024 * 1024)) {
        alert(`파일 크기가 5MB이하만 추가할 수 있습니다.`);
    } else if (emptyFilesSpace < 0) {
        alert(`최대 ${maxFiles}개까지만 추가할 수 있습니다.`);
    } else {
        // 기존 파일과 새로운 파일 병합
        boardInfo.board_img = [...boardInfo.board_img, ...arrayFiles];
    
        // 미리보기 URL 생성
        previews.value = boardInfo.board_img.map(file => URL.createObjectURL(file));
    }

    // <input> 초기화하여 동일한 파일 다시 선택 가능
    e.target.value = '';
};
const clearFile = (index) => {
    // 삭제할 파일과 미리보기 URL 제거
    URL.revokeObjectURL(previews.value[index]); // 메모리 해제
    boardInfo.board_img.splice(index, 1); // 파일 제거
    previews.value.splice(index, 1); // 미리보기 제거
};

</script>

<style scoped>
.container{
    align-items: center;
}

.container > h1 {
    font-size: 3rem;
    margin: 50px 0;
}

.success-btn-box {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
}

.success-btn{
    font-size: 18px;       
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-right: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.success-btn:hover{
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
.select-board-type > select {
    -webkit-appearance:none; /* 크롬 화살표 없애기 */
    -moz-appearance:none; /* 파이어폭스 화살표 없애기 */
    appearance:none /* 화살표 없애기 */
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
/* -------------------contents */

/* 이미지 파일 등록 관련련 */

/* .board-img-content {
    padding: 10px;
    display: grid;
    grid-template-columns: 1fr 1fr;
} */

/* .board-img-content :nth-child(-n + 2) {
    margin-bottom: 10px;
}  */
.file-btn{
    margin: 5px;
    color: #01083a;
    font-weight: 500;
}
.board-img-content img {
    max-width: 150px;
    max-height: 150px;
}

.img-preview {
    background-color: #01083a52;
    margin: 10px;
    padding: 20px;
    border-radius: 20px auto 20px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
}

.img-preview > button {
    width: 20px;
    height: 20px;
    margin: 10px;
}
.grid-3{
    display: grid;
    align-items: stretch;
    grid-template-columns: repeat(3,1fr);
    gap: 10px 20px;
    text-align: center;
    background-repeat: no-repeat;
}

.grid-4{
    display: grid;
    align-items: stretch;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);;
    gap: 10px 20px;
    text-align: center;
    background-repeat: no-repeat;
}

.grid-5{
    display: grid;
    align-items: stretch;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);;
    gap: 10px 20px;
    text-align: center;
    background-repeat: no-repeat;
} 


/* -------------------img */

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
/* -------------------star */

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

select[readonly] {
    pointer-events: none;
}

/* -------------------modal */

@media screen and (max-width: 1000px) {
    .container{
        margin: 10px;
        padding: 5px;
    }

    .board-content{
        display: grid;
    }

    .success-btn-box{
        display: inline;
    }
    
    /* -------------------------기존
    .board-detail-head {
        grid-template-columns: none;
        grid-template-rows: auto;  
        align-items: center;  
        text-align: center;  
    }
    */
}
</style>