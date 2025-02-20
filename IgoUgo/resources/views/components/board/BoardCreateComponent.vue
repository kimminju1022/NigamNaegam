<template>
    <div class="container">
        <h1>게시판 작성</h1>
        <div class="board-box">  
            <div class="board-select-container">
                <div class="select-board-type">
                    <p>게시판</p>
                    <select v-model="boardInfo.bc_code" name="bc_code" class="board-categories" disabled>
                        <!-- <p>{{ bcCode }}</p> -->
                        <!-- 초기 옵션값 3차에서 타입값 자동 출력 예정 -->
                        <option disabled hidden :value="boardInfo.bc_code">{{ boardInfo.bc_code === '0' ? '리뷰게시판' : '자유게시판' }}</option>
                        <!-- <option v-if="bcCode === '1'">자유게시판</option> -->
                    </select>
                </div>
                <div v-show="boardInfo.bc_code === '0'" class="board-review-box">
                    <p>리뷰</p>
                    <div class="board_category">
                        <!-- ------------- meerkat edit Start -->
                        <div class="search-box">
                            <p>{{ $store.state.productSearch.selectedProduct.title }}</p>
                            <button @click="modalOpen" class="btn bg-navy header-bg-btn">검색</button>
                        </div>
                        <!-- ------------- meerkat edit End -->
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
            </div>
            <div class="board-title-box">
                <p>제목</p>
                <input v-model="boardInfo.board_title" type="text" name="board_title">
            </div>
            <div class="board-img">
                <p>파일 첨부</p>
                <div class="board-img-content">
                    <input class="file-btn" @change="setFile" type="file" multiple accept="image/*" name="uploadFile">
                    <div :class="gridDetail"> 
                        <div class="img-preview" v-for="(previewImage, index) in previews" :key="index">
                            <!-- <p>{{ gridDetail }}</p> -->
                            <img :src="previewImage" alt="Uploaded Image"> 
                            <button @click="clearFile(index)" class="btn bg-clear">X</button> 
                        </div>
                    </div>  
                </div>
            </div>
            <div class="board-content">
                <p>내용</p>
                <textarea v-model="boardInfo.board_content" name="board_content" placeholder="당신의 이야기를 남겨주세요 &#10;&#10;어떤 일들이 당신을 즐겁게 했는지 공유해 주시면 더 많은 트래블러에게 도움이 된답니다(´▽`ʃ♡ƪ)"></textarea>
            </div>
        </div>
        <div class="success-btn-box"> 
            <router-link :to="'/boards'"><button class="btn bg-navy success-btn">취소</button></router-link>
            <button @click="$store.dispatch('board/storeBoard', boardInfo)" class="btn bg-navy success-btn">완료</button>
        </div>
    </div>
    
    <!-- ------------------------ meerkat Start ------------------------ -->
    <!-- ⭐ 검색 모달 -->
    <div class="bc-modal-search" v-if="modalSearchFlg">
        <div class="bc-modal-container">
            <button class="bc-modal-btn-close" @click="modalClose">X</button>
            <div class="bc-modal-header">
                <input v-model="requestData.search" class="bc-modal-input-search" type="text" placeholder="어디를 다녀 오셨나요?">
                <button @click="searchProducts" class="bc-modal-btn-search">검색</button>
            </div>
            <div class="bc-modal-content-list">
                <div class="bc-modal-content-item" v-for="(item, key) in $store.state.productSearch.searchProductList" :key="key">
                    <span @click="selectProduct(item.product_id)">{{ item.title }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------------------ meerkat End ------------------------ -->
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
    ,rc_code: ''
    ,rate: ''
    ,product_id: 0
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

// --------------------- meerkat Start ---------------------
//검색 관련
const modalSearchFlg = ref(false);
const requestData = reactive({
    search: ''
    ,mode: 'all'
});

// 검색 모달 열기
const modalOpen = () => {
    store.commit('productSearch/setSearchProductList', {}); // 검색 리스트 초기화
    requestData.search = ''; // 검색어 초기화
    modalSearchFlg.value = true; // 모달 오픈
};

// 검색 모달 닫기
const modalClose = () => {
    modalSearchFlg.value = false; // 모달 클로즈
};

// 검색 리스트 획득
const searchProducts = () => {
    store.dispatch('productSearch/searchProductList', requestData);
};

const selectProduct = (productId) => {
    const product = store.getters['productSearch/getSelectProduct'](productId); // product List에서 선택한 product만 획득
    store.commit('productSearch/setSelectedProduct', product); // 선택한 product 정보 저장
    boardInfo.product_id = product.product_id; // 작성 데이터에 선택한 product_id 셋팅
    modalClose(); // 모달 닫기
};

// --------------------- meerkat End ---------------------

</script>

<style scoped>
/* btn 모음집 */


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

.search_btn:hover{
    font-weight: 700;
    color: #fff;
    background-color: #01083a;
}
/* -------------btn end */
.container{
    align-items: center;
}

.container > h1 {
    font-size: 3rem;
    margin: 50px 0;
}


.board-search{
    border-bottom: 2px solid #01083a;
    text-align: center;
    justify-content: center;
    color: #01083a;
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

.board-box > div:not(:first-child) > :first-child, .select-board-type > p:first-child, .board-review-box > p {
    border-right: 1px solid #01083a;
}

.select-board-type > p:first-child
,.board-title-box > p:first-child
,.board-img > p:first-child
,.board-content> p:first-child
,.board-category > p:first-child
,.board-review-box > p:first-child {
    font-size: 20px;
    text-align: center;
    font-weight: 600;
}

.board-box p, .board-title-box > input ,.board-content > textarea {
    padding: 10px;
    font-size: 17px;
}

.board-title-box > input{
    margin-left: 10px;
}

/* .board-select-container {
    display: grid; */
    /* grid-template-rows: 1fr 1fr; */
/* } */
.board-categories{
    text-align: left;
    padding-left: 20px;
    font-size: 1rem;
    font-weight: 500;
    color: black;

}
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
    grid-template-columns: 1fr 5fr;
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
    margin: 10px 20px;
    color: #01083a;
    font-weight: 500;
}

.board-img-content img {
    max-width: 150px;
    max-height: 150px;
}

.img-preview {
    margin: 10px;
    padding: 20px;
    border-radius: 20px auto 20px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 200px;
    width: 200px;
}

.img-preview > button {
    width: 20px;
    height: 20px;
    margin: 10px;
}
.grid-3{
    display: grid;
    place-items: center;
    grid-template-columns: repeat(3,1fr);
    gap: 10px 20px;
    text-align: center;
    background-repeat: no-repeat;
}

.grid-4{
    display: grid;
    place-items: center;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);;
    gap: 10px 20px;
    text-align: center;
    background-repeat: no-repeat;
}

.grid-5{
    display: grid;
    place-items: center;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 1fr);;
    gap: 10px 20px;
    text-align: center;
    background-repeat: no-repeat;
} 


/* -------------------img */

/* .board_category, .search-box{  edit meerkat */
.board_category{ 
    display: grid;
    margin: 0 10px;
    grid-template-columns: repeat(2, 1fr);
    text-align: center;
    align-items: center;
}

.search-box {
    display: flex;
    /* justify-content: center; */
    align-items: center;
    gap: 10px;
    margin: 0 10px;
    text-align: center;
    align-items: center;
}
/* 별점 */

.star-grade {
    display: flex;
    flex-direction: row-reverse;    /* 별을 오른쪽에서 왼쪽으로 정렬 */
    justify-content: center;
    align-items: center;
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
.bc-modal-search{
    width: 100vw;
    height: 100vh;
    background-color: rgba(197, 198, 198, 0.374);
    position: fixed;
    top: 0;
    right: 0;
    z-index: 9;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}
/* 모달 디자인 */
.bc-modal-container{
    width: 600px;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    display: grid;
    place-items: center;
    gap: 20px;
    grid-template-columns: 30px 1fr 30px;
}
.modal-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 300px;
}
.bc-modal-btn-close {
    border: none;
    border-radius: 5px;
    background-color: #01083a;
    color: #fff;
    grid-column-start: 3;
    grid-column-end: 4;
    width: 30px;
    height: 30px;
    cursor: pointer;
}
.bc-modal-header {
    grid-column-start: 2;
    grid-column-end: 3;
}
.bc-modal-input-search {
    border: 1px solid #01083a;
    border-radius: 5px;
    width: 300px;
    height: 30px;
    margin-right: 30px;
}
.bc-modal-input-search::placeholder {
    text-align: center;
}
.bc-modal-btn-search {
    border: none;
    border-radius: 30px;
    background-color: #01083a;
    color: #fff;
    font-size: 16px;
    width: 50px;
    height: 30px;
    cursor: pointer;
}
.bc-modal-content-list {
    overflow: scroll;
    width: 450px;
    height: 400px;
    margin-top: 30px;
    grid-column-start: 2;
    grid-column-end: 3;
    text-align: center;
}
.bc-modal-content-item {
    font-size: 16px;
    font-weight: 500;
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