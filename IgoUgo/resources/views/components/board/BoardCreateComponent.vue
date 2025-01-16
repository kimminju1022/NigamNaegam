<template>
    <div class="container">
        <h1>게시판 작성</h1>
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
                <div class="board-img-content":class="gridDetail">
                    <!-- <input @change="setFile" type="file" name="board_images[]" multiple accept="image/*"> -->
                    <input class="file-btn" @change="setFile" type="file" multiple accept="image/*" name="board_img">
                    <div class="img-preview" v-for="(previewImage, index) in previews" :key="index">
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
    ,bc_type: ''
    ,area_code: ''
    ,rc_type: ''
    ,rate: ''
});

// img관련 ----------------------start *****
const previews = ref([]);
const selectedFiles = ref([]);
const maxFiles = 5; // 최대 파일 개수

const gridDetail = computed(() => {
    return previews.value.length >= 5
        ? 'grid-5'
        : previews.value.length === 4
        ? 'grid-4'
        : 'grid-3';
});

        // : previews.length === 4 ? 'grid-4' : 'grid-3';
        // : previews.length === 2 ? 'grid-2' :'grid-1';
// });
/*
const setFile = (e) => {
    e.preventDefault(); // 기본 이벤트 막기 (새로고침 방지)

    const newFiles = Array.from(e.target.files).filter(
        (file) => file.size <= 5 * 1024 * 1024 // 5MB 이하 파일만 허용
    );
    const uniqueFiles = newFiles.filter(newFile => 
        !selectedFiles.value.some(existingFile => existingFile.name === newFile.name && existingFile.size === newFile.size)
    );
    const currentFileCount = selectedFiles.value.length; // 현재 등록된 파일 수
    const availableSlots = maxFiles - currentFileCount; // 남은 파일 등록 가능 수

    if (availableSlots <= 0) {
        alert(`이미 ${maxFiles}개의 파일이 등록되어 있습니다.`);
        e.target.value = ''; // 파일 입력 초기화
        return;
    }

    const filesToAdd = newFiles.slice(0, availableSlots); // 남은 슬롯만큼만 추가
    if (newFiles.length !== uniqueFiles.length) {
        alert("중복된 파일이 있습니다. 다른 파일을 선택해주세요.");
    }

    // 남은 슬롯보다 추가하려는 파일이 많을 경우 경고
    if (filesToAdd.length < newFiles.length) {
        alert(`최대 ${availableSlots}개까지만 추가할 수 있습니다.`);
    }
    // 선택한 파일과 미리보기 업데이트
    selectedFiles.value = [...selectedFiles.value, ...filesToAdd];
    previews.value = selectedFiles.value.map((file) => URL.createObjectURL(file));

    e.target.value = ''; // 파일 입력 초기화
};

const clearFile = (index) => {
    // 미리보기 URL 해제 및 파일 제거
    URL.revokeObjectURL(previews.value[index]); // 메모리 해제
    selectedFiles.value.splice(index, 1); // 파일 제거
    previews.value.splice(index, 1); // 미리보기 제거
};
*/

    const setFile = (e) => {
    const newFiles = Array.from(e.target.files)
    .filter(file => file.size <= 5 * 1024 * 1024)  // 5MB 이하 파일만 허용
    
    const currentFileCount = selectedFiles.value.length; // 현재 등록된 파일 수
    const availableSlots = maxFiles - selectedFiles.value.length; // 잔여 슬롯 수 계산
    const filesToAdd = newFiles.slice(0, availableSlots);  // 남은 슬롯만큼만 추가

    if (filesToAdd.length !== newFiles.length) {
        alert(`최대 ${availableSlots}개까지만 추가할 수 있습니다.`);

    
    // if (selectedFiles.value.length + newFiles.length > maxFiles) {
    // alert("최대 5개까지 파일을 등록할 수 있습니다.");
    // return;
    }

    // 남은 슬롯보다 추가하려는 파일이 많을 경우
    if (newFiles.length > availableSlots) {
        alert(
            availableSlots > 0
                ? `최대 ${availableSlots}개까지만 추가할 수 있습니다.`
                : `이미 ${maxFiles}개가 등록되어 있습니다.`
        );
        return;
    }

    // 기존 파일과 새로운 파일 병합
    selectedFiles.value = [...selectedFiles.value, ...filesToAdd];

    // 미리보기 URL 생성
    previews.value = selectedFiles.value.map(file => URL.createObjectURL(file));

    // <input> 초기화하여 동일한 파일 다시 선택 가능
    e.target.value = '';
};

const clearFile = (index) => {
    // 삭제할 파일과 미리보기 URL 제거
    const fileToRemove = selectedFiles.value[index];
    URL.revokeObjectURL(previews.value[index]); // 메모리 해제
    selectedFiles.value.splice(index, 1); // 파일 제거
    previews.value.splice(index, 1); // 미리보기 제거
};


/*
const setFile = (e) => {
    const maxFiles = 5; // 최대 파일 개수
    const currentFileCount = selectedFiles.value.length; // 현재 등록된 파일 개수
    const newFiles = Array.from(e.target.files).filter(file => file.size <= 5 * 1024 * 1024); // 5MB 이하 파일 필터링
    const totalFiles = currentFileCount + newFiles.length; // 현재 등록된 파일과 새로 추가된 파일의 총 개수를 계산


    // 현재 슬롯이 없으면 경고 후 종료
    if (totalFiles > maxFiles) {
        const availableSlots = maxFiles - currentFileCount; // 남은 슬롯 계산
        alert(
            availableSlots > 0
                ? `최대 ${availableSlots}개까지만 추가할 수 있습니다.`
                : `이미 ${maxFiles}개가 등록되어 있습니다.`
        );
        return;
    }


    // 기존 파일과 새로운 파일 병합
    selectedFiles.value = [...selectedFiles.value, ...newFiles];

    // 미리보기 URL 생성
    previews.value = selectedFiles.value.map(file => URL.createObjectURL(file));
};

const clearFile = (index) => {
    // 삭제할 파일 URL 해제
    const fileToRemove = selectedFiles.value[index];
    URL.revokeObjectURL(previews.value[index]);

    // 해당 파일과 미리보기 URL 배열에서 삭제
    selectedFiles.value.splice(index, 1);
    previews.value.splice(index, 1);
};
*/
/*
const setFile = (e) => {
    // 최대 5개까지만 선택 가능
    const newFiles = Array.from(e.target.files).filter(file => file.size <= 5 * 1024 * 1024);  // 5MB 이하 파일만

    // 이미 추가된 파일 수와 새로운 파일 수가 합쳐서 5개를 초과하면 경고
    const maxFiles = 5;
    const availableSlots = maxFiles - selectedFiles.value.length;  // 이미 등록된 파일 수에 따른 추가 가능한 파일 수 계산산

    // 계산값에 따른 안내문
    if (newFiles.length > availableSlots) {
        alert(`최대 ${availableSlots}개까지만 선택할 수 있습니다.`);
        if(0 === availableSlots){
            alert(`이미 ${maxFiles}개가 등록되어 있습니다.`); 
        }
        return;
    }

    // 기존 파일에 새로 선택한 파일만 추가
    selectedFiles.value = [...selectedFiles.value, ...newFiles];
    // 미리보기 URL 생성
    previews.value = selectedFiles.value.map(file => URL.createObjectURL(file));
};

const clearFile = (index) => {
    // 해당 파일을 삭제
    const fileToRemove = selectedFiles.value[index];
    selectedFiles.value.splice(index, 1);
    previews.value.splice(index, 1);

    // URL 객체 해제 (메모리 누수 방지)
    URL.revokeObjectURL(fileToRemove);
};
*/
/*
const setFile = (e) => {
    // 최대 5개까지만, 5MB 이하의 파일만 추가
    const newFiles = Array.from(e.target.files).filter(file => file.size <= 5 * 1024 * 1024);

    // 선택된 파일이 5개를 초과하면 경고 메시지 표시
    if (selectedFiles.value.length + newFiles.length > 5) {
        alert("최대 5개까지만 선택할 수 있습니다.");
        return;
    }

    // 새로운 파일을 기존 파일 목록에 추가
    selectedFiles.value = [...selectedFiles.value, ...newFiles];

    // 미리보기 URL 생성
    previews.value = selectedFiles.value.map(file => URL.createObjectURL(file));

    // input 값 초기화 하지 않음. 기존 파일을 유지하면서 새 파일만 추가됨.
};

const clearFile = (index) => {
    // 해당 파일을 삭제
    const fileToRemove = selectedFiles.value[index];
    selectedFiles.value.splice(index, 1);

    // 미리보기에서 해당 파일 제거
    previews.value.splice(index, 1);

    // URL 객체 해제 (메모리 누수 방지)
    URL.revokeObjectURL(fileToRemove);
};
*/

/*
const setFile = (e) => {
    // 최대 5개까지, 5MB 까지 선택 가능하도록 제한
    const newFiles = Array.from(e.target.files).filter(file => file.size <= 5 * 1024 * 1024);
    if (selectedFiles.value.length + e.target.files.length > 5) {
        alert("최대 5개까지만 선택할 수 있습니다.");
        return;
    }
    // 기존 파일과 새로운 파일 병합
    selectedFiles.value = [...selectedFiles.value, ...newFiles];
    // 미리보기 URL 생성
    previews.value = selectedFiles.value.map(file => URL.createObjectURL(file)); 

    // e.target.value = ''; // <input> 초기화하여 동일한 파일 다시 선택 가능
};

const clearFile = (index) => {
    // 선택한 파일 배열에서 해당 파일 제거
    selectedFiles.value.splice(index, 1);
    // 미리보기 배열에서 해당 파일 제거
    previews.value.splice(index, 1);

    // URL 객체 해제 (메모리 누수 방지)
    URL.revokeObjectURL(previews.value[index]);
};
*/
/* ---------------
const setFile = (e) => {
    const newFiles = Array.from(e.target.files).filter(file => file.size <= 5 * 1024 * 1024);  // 새로 선택한 파일
    selectedFiles.value = [...selectedFiles.value, ...newFiles]; // 기존 파일과 병합
    previews.value = selectedFiles.value.map(file => URL.createObjectURL(file)); // 미리보기 업데이트
};
const clearFile = (fileNum) => {
    const filesArray = Array.from(boardInfo.board_img);
    filesArray.splice(fileNum, 1); // 해당 img파일만 제거
    boardInfo.board_img = filesArray;
    previews.value = filesArray.map(file => URL.createObjectURL(file));
};


const setFile = (e) => {
    // img파일 5MB제한
    const files = Array.from(e.target.files).filter(file => file.size <= 5 * 1024 * 1024); 
    boardInfo.board_img = files;
    previews.value = files.map(file => URL.createObjectURL(file));
};

const setFile = (e) => {
    // boardInfo.board_img = e.target.files[0];
    console.log(e.target.files);
    boardInfo.board_img = e.target.files;
    previews.value = Array.from(boardInfo.board_img).map(file => URL.createObjectURL(file));
}
*/

// img파일 - 전체 삭제
// const clearFile = (fileNum) => {
//     boardInfo.board_img = null;
//     previews.value = null;
// }
// img관련 ----------------------end *****

/**------------(기존) 이미지등록 삭제
 * const preview2 = ref('');

const setFile1 = (e) => {
    boardInfo.board_img1 = e.target.files[0];
    preview1.value = URL.createObjectURL(boardInfo.board_img1);
}
const clearFile1 = () => {
    boardInfo.board_img1 = null;
    preview1.value = null;
}
-------------------------------- */


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