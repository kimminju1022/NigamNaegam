<template>
<div class="tester-container">
        <div class="header-flex">
            <div>
                <p class="tester-title">체험단 게시글 작성</p>
                <hr class="hr-style">
            </div>
            <div class="header-btn">
                <button @click="$store.dispatch('adminTester/storeTester', tester)" class="btn bg-navy btn-list">완료</button>
                <router-link to="/admin/tester"><button class="btn bg-navy btn-list">취소</button></router-link>
            </div>
        </div>
        <div class="tester-content-box">
            <div class="info-top">
                <div class="tester-info">
                    <p>지역</p>
                    <input v-model="tester.tester_area" type="text" name="tester_area">
                </div>
                <div class="tester-info">
                    <p>카테고리</p>
                    <select v-model="tester.tester_code" name="tester_code" id="tester_code" class="tester_code">
                        <option value="0">호텔</option>
                        <option value="1">관광지</option>
                        <option value="2">문화시설</option>
                        <option value="3">레포츠</option>
                        <option value="4">쇼핑</option>
                        <option value="5">음식점</option>
                    </select>
                </div>
            </div>
            <div class="title-box">
                <div class="title-content">
                    <p>제목</p>
                    <input v-model="tester.board_title" type="text" name="board_title">
                </div>
            </div>
            <div class="place-box">
                <div class="place-content">
                    <p>장소</p>
                    <input v-model="tester.tester_place" type="text" name="tester_place">
                </div>
                <div class="place-conent-time">
                    <p>모집 기한</p>
                    <!-- <input type="datetime-local" name="due_date"> -->
                    <input v-model="tester.due_date" type="date" name="due_date">
                </div>
            </div>
            <div class="tester-content">
                <!-- <img src="/logo_gam.png" alt="board_img1 무조건 가게정보사진"> -->
                <div class="board-img-content">
                    <input @change="setFile" type="file" multiple name="board_img" accept="image/*">
                    <div class="img-grid">
                        <div class="img-preview" v-for="(preview, index) in previews" :key="index">
                            <img :src="preview">
                            <button @click="clearFile(index)" class="btn bg-clear">X</button>
                        </div>
                    </div>
                </div>
                <textarea v-model="tester.board_content" ref="textArea" @input="resize" name="board_content" placeholder="내용"></textarea>
            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, ref, watch } from 'vue';

const tester = reactive({
    board_title: ''
    ,board_content: ''
    ,board_img: []
    ,tester_place: ''
    ,tester_area: ''
    ,tester_code: ''
    ,tester_name: ''
    ,due_date: null
});

watch(() => tester.tester_code, (newTesterCode) => {
    const categories = {
        0: '호텔', 
        1: '관광지',
        2: '문화시설',
        3: '레포츠',
        4: '쇼핑',
        5: '음식점',
    };
    tester.tester_name = categories[newTesterCode] || '';
    // console.log('tt', newTesterCode);
});

// watch(() => tester.due_date, (newDueDate) => {
//     console.log(tester.due_date);
// });

const previews = ref([]);
const maxFiles = 1;

const setFile = (e) => {
    const arrayFiles = Array.from(e.target.files);
    const emptyFilesSpace = maxFiles - tester.board_img.length - arrayFiles.length;

    // 5MB 이하 파일만 허용
    if(!arrayFiles.every(file => file.size <= 5 * 1024 * 1024)) {
        alert(`파일 크기 5MB이하만 추가할 수 있습니다.`);
    } else if (emptyFilesSpace < 0) {
        alert(`최대 ${maxFiles}개까지만 추가할 수 있습니다.`);
    } else {
        // 기존 파일과 새로운 파일 병합
        tester.board_img = [...tester.board_img, ...arrayFiles];
    
        // 미리보기 URL 생성
        previews.value = tester.board_img.map(file => URL.createObjectURL(file));
    }

    // <input> 초기화하여 동일한 파일 다시 선택 가능
    e.target.value = '';
}

const clearFile = (index) => {
    URL.revokeObjectURL(previews.value[index]);
    tester.board_img.splice(index, 1);
    previews.value.splice(index, 1);
}

const textArea = ref(null);

const resize = () => {
    textArea.value.style.height = "1px";
    textArea.value.style.height = textArea.value.scrollHeight + "px";
};
</script>
<style scoped>
/* 체험단 큰 틀 */
.tester-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

.header-flex {
    display: flex;
    justify-content: space-between;
}

.header-btn {
    display: flex;
    gap: 10px;
}

.btn-list {
    width: 70px;
    height: 45px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 20px;
}

.btn-list:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
}

.btn-create:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
}

/* 체험단 타이틀 */
.tester-title {
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
.tester-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}

.info-top {
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-bottom: 1px solid #000;
    padding: 10px;
}

.tester-info {
    display: flex;
    gap: 30px;
    align-items: center;
}

.tester-info > input {
    width: 40%;
    background: #ebebeb;
    border-radius: 10px;
    height: 30px;
    padding: 0 10px;
}

.tester_code {
    outline: none;
    font-size: 16px;
    width: 40%;
}

.title-content > input, .place-content > input {
    width: 80%;
    background: #ebebeb;
    border-radius: 10px;
    height: 30px;
    padding: 0 10px;
}

.title-box, .place-box {
    display: grid;
    border-bottom: 1px solid #000;
    grid-template-columns: 2fr 1fr;
    padding: 10px;
} 

.title-content, .title-content-time, .place-content, .place-conent-time {
    display: flex;
    gap: 30px;
}

.tester-content {
    margin: 10px auto;
    width: 95%;
}

/* 이미지 */
.board-img-content {
    padding: 10px;
    display: grid;
    grid-template-rows: 40px 1fr;
}

.board-img-content :nth-child(-n + 2) {
    margin-bottom: 10px;
} 

.img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
}

.board-img-content img {
    max-width: 200px;
    max-height: 200px;
}

.img-preview {
    display: flex;
}

.img-preview > button {
    width: 20px;
    height: 20px;
}

/* 텍스트 */
textarea {
    resize: none;
    width: 100%;
    min-height: 300px;
    background: #ebebeb;
    border-radius: 10px;
    padding: 10px;
    font-size: 16px;
}
</style>