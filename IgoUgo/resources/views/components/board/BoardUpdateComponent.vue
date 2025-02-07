<template>
    <div class="container">
        <h1>게시판 수정</h1>
        <div class="board-box">  
            <div class="board-select-container">
                <div class="select-board-type">
                    <p>게시판</p>
                    <!-- <select v-model="boardInfo.boardDetail.bc_type" name="bc_type" class="board-categories"> -->
                    <select v-model="boardInfo.bc_code" name="bc_code" class="board-categories" disabled>
                        <option disabled hidden :value="boardInfo.bc_code">{{ boardInfo.bc_code === '0' ? '리뷰게시판' : '자유게시판' }}</option>

                        <!-- 2nd del_250205 -->
                        <!-- <option disabled hidden selected>--게시판선택--</option> 
                        <option value="0">리뷰게시판</option>
                        <option value="1">자유게시판</option> -->
                    </select>
                </div>
                <div v-show="boardInfo.bc_code === '0'" class="board-review-box">
                <!-- 2nd del_250205 -->
                <!-- <div v-show="boardInfo.boardDetail.bc_type === '0'" class="board-review-box"> -->
                    <p>리뷰</p>
                    <div class="board-category">
                        <!-- 검색 모달 -->
                        <!-- <input v-if="$store.state.board." class="search-bar" type="text" placeholder="검색 버튼으로 리뷰할 곳을 검색해 주세요">
                        <button @click="searchProducts" class="btn bg-clear search_btn">검색</button> -->
                        
                        <!-- 2nd Code del_250205 -->
                        <!-- <p>유형</p>
                        <select v-model="boardInfo.boardDetail.rc_type" name="rc_type">
                            <option disabled hidden selected>--유형선택--</option>
                            <option value="0">숙박</option>
                            <option value="1">맛집</option>
                            <option value="2">관광</option>
                            <option value="3">문화</option>
                            <option value="4">레포츠</option>
                            <option value="5">쇼핑</option>
                        </select> -->
                    <!-- </div>
                    <div class="board-category">
                        <p>지역</p>
                        <select v-model="boardInfo.boardDetail.area_code" name="area_code">
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
                    </div>-->
                    <!--  v-for="searchItem in searchKeyword"  -->
                    <!-- <div id="board-search-tb">
                        <input v-model="keyword" class="board-search" type="text" placeholder="검색어를 입력해 주세요">
                        <button @click="keywordSearch" class="btn bg-navy board-search-btn">검색</button>
                    </div> -->
                    <!-- 별점 -->
                        <div class="board-starGrade">
                            <p>별점</p>
                            <div class="star-grade">
                                <input type="radio" name="rate" id="star-1" class="star" value="5" v-model="boardInfo.boardDetail.rate">
                                <label for="star-1" class="star-label"></label>
                                
                                <input type="radio" name="rate" id="star-2" class="star" value="4" v-model="boardInfo.boardDetail.rate">
                                <label for="star-2" class="star-label"></label>
                                
                                <input type="radio" name="rate" id="star-3" class="star" value="3" v-model="boardInfo.boardDetail.rate">
                                <label for="star-3" class="star-label"></label>
                                
                                <input type="radio" name="rate" id="star-4" class="star" value="2" v-model="boardInfo.boardDetail.rate">
                                <label for="star-4" class="star-label"></label>
                                
                                <input type="radio" name="rate" id="star-5" class="star" value="1" v-model="boardInfo.boardDetail.rate">
                                <label for="star-5" class="star-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="board-title-box">
                    <p>제목</p>
                    <input v-model="boardInfo.boardDetail.board_title" type="text" name="board_title">
                </div>
                <div class="board-img">
                    <p>파일 첨부</p>
                    <div>
                        <div class="board-img-content">
                            <input class="file-btn" @change="setFile" type="file" multiple accept="image/*" name="uploadFile">
                            <!-- <input @change="setFile" type="file" name="board_images[]" multiple accept="image/*"> -->
                            <div class="img-preview":class="gridDetail" v-for="(previewImage, index) in previews" :key="index">
                                <img :src="previewImage" alt="Uploaded Image"> 
                                <button @click="clearFile(index)" class="btn bg-clear">X</button> 
                            </div>
                            <!-- <div class="board-img-content">
                                <input @change="setFile" type="file" name="board_img1" accept="image/*">
                                // <input @change="setFile2" type="file" name="board_img2" accept="image/*">
                                <div class="img-preview">
                                    <img :src="preview|| boardInfo.boardDetail.board_img">
                                    <button @click="clearFile" v-show="preview" class="btn bg-clear">X</button>
                                </div> -->
                            <!-- <div class="img-preview">
                                <img :src="preview2 || boardInfo.boardDetail.board_img2">
                                <button @click="clearFile2" v-show="preview2" class="btn bg-clear">X</button>
                            </div> -->
                            </div>
                    </div>
                    </div>
                <div class="board-content">
                    <p>내용</p>
                    <textarea v-model="boardInfo.boardDetail.board_content" name="board_content"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="header-btn-box"> 
        <router-link :to="`/boards/${$route.params.id}`"><button class="btn bg-clear header-btn">취소</button></router-link>
        <button @click="$store.dispatch('board/boardUpdate', boardInfo)" class="btn bg-navy header-btn">완료</button>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const route = useRoute();

const boardDetail = computed(() => store.state.board.boardDetail);

const boardInfo = reactive({
    boardDetail: store.state.board.boardDetail
    ,board_title: ''
    ,board_content: ''
    ,board_img: []
    ,bc_code: store.state.board.bcCode
    ,area_code: ''
    ,rc_code: ''
    ,rate: ''
    // 2nd del_250205
    // ,board_img1: null
    // ,board_img2: null
});

const gridDetail = computed(() => {
    return previews.value.length >= 5
        ? 'grid-5'
        : previews.value.length === 4
        ? 'grid-4'
        : 'grid-3';
});

const previews = reactive([]);
// const preview2 = ref('');  //2nd del250205

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
    e.target.value = '';
};
    // boardInfo.board_img= e.target.files;
    // const arrayFiles = Array.from(e.target.files);
    // previews.value = URL.createObjectURL(boardInfo.board_img);
    // const arrayFiles = Array.from(e.target.files);
    // const emptyFilesSpace = maxFiles - boardInfo.board_img.length - arrayFiles.length;
    
    // // 5MB 이하 파일만 허용
    // if(!arrayFiles.every(file => file.size <= 5 * 1024 * 1024)) {
    //     alert(`파일 크기가 5MB이하만 추가할 수 있습니다.`);
    // } else if (emptyFilesSpace < 0) {
    //     alert(`최대 ${maxFiles}개까지만 추가할 수 있습니다.`);
    // } else {
    //     // 기존 파일과 새로운 파일 병합
    //     boardInfo.board_img = [...boardInfo.board_img, ...arrayFiles];
    
    //     // 미리보기 URL 생성
    //     previews.value = boardInfo.board_img.map(file => URL.createObjectURL(file));
    // }

    // <input> 초기화하여 동일한 파일 다시 선택 가능


const clearFile = (index) => {
    // 삭제할 파일과 미리보기 URL 제거
    URL.revokeObjectURL(previews.value[index]); // 메모리 해제
    boardInfo.board_img.splice(index, 1); // 파일 제거
    previews.value.splice(index, 1); // 미리보기 제거
};
// 2nd 사진업로드 수정
// const setFile2 = (e) => {
//     boardInfo.board_img2 = e.target.files[0];
//     preview2.value = URL.createObjectURL(boardInfo.board_img2);
// }
// const clearFile = () => {
//     boardInfo.board_img = null;
//     preview.value = null;
// }
// const clearFile2 = () => {
//     boardInfo.board_img2 = null;
//     preview2.value = null;
// }

// const gridUpdate =  computed(() => {
//     return store.state.board.bcType === '0' ? 'grid-3' : 'grid-2';
// });

onBeforeMount(() => {
    if(!boardInfo.boardDetail.board_id) {
        store.dispatch('board/showBoardDetail', route.params.id);
    }
});

watch(boardDetail, (newVal) => {
    boardInfo.boardDetail = newVal;
});

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
    margin-top: 10px;
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

.board-box > div:not(:first-child) > :first-child, .board-title-box > p:first-child
, .select-board-type > p:first-child,.board-review-box > p:first-child, .board-img > p:first-child, .board-content > p:first-child{
    border-right: 1px solid #01083a;
}

.select-board-type > p:first-child
,.board-review-box > p:first-child
,.board-title-box > p:first-child
,.board-img > p:first-child
,.board-content> p:first-child
,.board-starGrade > p:first-child {
    font-size: 20px;
    text-align: center;
    font-weight: 600;
}

/* .grid-2{
    display: grid;
    grid-template-columns: 9fr 2fr;
    grid-auto-rows: 50px;
    align-items:end;
    line-height: 1.5;
    text-align: right;
}
.grid-3{
    display: grid;
    grid-template-columns: 9fr 4fr 3fr;
    grid-auto-rows: 50px;
    justify-content: space-between;
    align-items:end;
    line-height: 1.5;
} */

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
    grid-template-columns: 1.02fr 5fr;
    gap: 20px;
    border-bottom: 1px solid #01083a;
}

.board-category {
    display: grid;
    grid-template-columns: 3fr 1fr 7fr;
}

.board-starGrade{
    display: grid;
    grid-template-columns: 2fr 7fr;
}

.board-title-box, .board-content{
    display: grid;
    grid-template-columns: 1.02fr 5fr;
    gap: 20px;
    border-bottom: 1px solid #01083a;
}

.board-content > textarea {
    resize: none;
    height: 300px;
    margin: 10px;
}
.board-img{
    display: grid;
    grid-template-columns: 1.02fr 5fr;
    gap: 20px;
    border-bottom: 1px solid #01083a;
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

.board-img-content {
    padding: 10px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    max-width: 150px;
    max-height: 150px;
}

.board-img-content :nth-child(-n + 2) {
    margin: 0 10px;
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