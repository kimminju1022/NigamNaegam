<template>
    <!-- <div class="tester-container" v-if="tester?.testerDetail"> -->
    <div class="tester-container">
        <div class="header-flex">
            <div>
                <p class="tester-title">체험단 게시글 수정</p>
                <hr class="hr-style">
            </div>
            <div class="header-btn">
                <button @click="$store.dispatch('adminTester/updateTester', tester)" class="btn bg-navy btn-list">완료</button>
                <router-link to="/admin/tester"><button class="btn bg-navy btn-list">취소</button></router-link>
            </div>
        </div>
        <div class="tester-content-box">
            <div class="info-top">
                <div class="tester-info">
                    <p>지역</p>
                    <input v-model="tester.testerDetail.tester_management.tester_area" type="text" name="tester_area">
                </div>
                <div class="tester-info">
                    <p>카테고리</p>
                    <select v-model="tester.testerDetail.tester_management.tester_code" name="tester_code" id="tester_code" class="tester_code">
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
                    <input v-model="tester.testerDetail.board_title" type="text" name="board_title">
                </div>
            </div>
            <div class="place-box">
                <div class="place-content">
                    <p>장소</p>
                    <input v-model="tester.testerDetail.tester_management.tester_place" type="text" name="tester_place">
                </div>
                <div class="place-conent-time">
                    <p>모집 기한</p>
                    <input v-model="tester.testerDetail.tester_management.due_date" type="date" name="due_date">
                    <!-- <input v-model="formattedDueDate" type="date" name="due_date"> -->
                </div>
            </div>
            <div class="tester-content">
                <div class="board-img-content">
                    <input @change="setFile" type="file" multiple name="board_img" accept="image/*">
                    <div class="img-grid">
                        <div class="img-preview" v-for="(preview, index) in previews" :key="index">
                            <img :src="preview">
                            <button @click="clearFile(index)" class="btn bg-clear">X</button>
                        </div>
                    </div>
                    <div class="img-grid">
                        <div class="img-preview" v-for="(image, item) in tester.testerDetail.board_images" :key="item">
                            <img :src="image.board_img">
                            <button @click="removeFile(item)" class="btn bg-clear">X</button>
                        </div>
                    </div>
                </div>
                <textarea v-model="tester.testerDetail.board_content" ref="textArea" @input="resize" name="board_content" placeholder="내용"></textarea>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted, reactive, ref, watch } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';

const store =  useStore();
const route = useRoute();

const tester = reactive({
    testerDetail: store.state.adminTester.boardDetail
    ,board_img: []
    ,user_id: store.state.auth.managerInfo.user_id
    ,board_id: route.params.id
});

// const formattedDueDate = computed(() => {
//     const dueDateString = tester.testerDetail?.tester_management?.due_date;
    
//     if (dueDateString) {
//         const date = new Date(dueDateString);  // "2025-02-19 23:59:59"를 Date 객체로 변환
//         const year = date.getFullYear();
//         const month = String(date.getMonth() + 1).padStart(2, '0'); // 월은 0부터 시작하므로 +1
//         const day = String(date.getDate()).padStart(2, '0');
//         return `${year}-${month}-${day}`;  // yyyy-mm-dd 형식으로 반환
//     }
//   return '';  // 값이 없으면 빈 문자열 반환
// });

watch(() => tester.testerDetail.tester_management.tester_code, (newTesterCode) => {
    const categories = {
        0: '호텔', 
        1: '관광지',
        2: '문화시설',
        3: '레포츠',
        4: '쇼핑',
        5: '음식점',
    };
    tester.testerDetail.tester_management.tester_name = categories[newTesterCode] || '';
    // console.log('tt', newTesterCode);
});

// watch(() => tester.testerDetail.tester_management.due_date, (newDueDate) => {
//     console.log(tester.testerDetail.tester_management.due_date);
// });


// 날짜 받기
const formattedDueDate = ref('');

// 컴포넌트가 마운트될 때 초기값을 설정
onMounted(() => {
    const dueDateString = tester.testerDetail?.tester_management?.due_date;
    if (dueDateString) {
        const date = new Date(dueDateString);
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        formattedDueDate.value = `${year}-${month}-${day}`;
    }
});

watch(() => formattedDueDate, (newDate) => {
    if (newDate) {
        const dateParts = newDate.split('-');  // yyyy-mm-dd 형식으로 날짜를 분리
        const date = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
        const formattedDateString = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')} 23:59:59`;  // 원하는 형식으로 변경
        tester.testerDetail.tester_management.due_date = formattedDateString;   
        console.log('Updated due_date', formattedDateString);
    }
});

watch(() => store.state.adminTester.boardDetail, (newBoardDetail) => {
    if (newBoardDetail) {
        tester.testerDetail = newBoardDetail;
    }
});

const previews = ref([]);
const maxFiles = 5;

const setFile = (e) => {
    const arrayFiles = Array.from(e.target.files);
    const totalFiles = tester.board_img.length + arrayFiles.length + tester.testerDetail.board_images.length;

    // 5MB 이하 파일만 허용
    if(!arrayFiles.every(file => file.size <= 5 * 1024 * 1024)) {
        alert(`파일 크기 5MB이하만 추가할 수 있습니다.`);
    // } else if (emptyFilesSpace < 0) {
    } else if (totalFiles > maxFiles) {
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
    URL.revokeObjectURL(previews.value[index]); // 메모리 해제
    tester.board_img.splice(index, 1); // 파일 제거
    previews.value.splice(index, 1); // 미리보기 제거
}

const removeFile = (item) => {
    URL.revokeObjectURL(previews.value[item]); // 메모리 해제
    tester.testerDetail.board_images.splice(item, 1); // 파일 제거
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
}



/* --------------------------------------------------------- */
/* .tester-list-title {
    display: grid;
    grid-template-columns: 0.5fr 0.5fr 1.5fr 1.5fr 0.5fr 0.5fr 1fr 1fr 0.5fr;
    text-align: center;
    padding: 0 5px 10px 5px;
    border-bottom: 1px solid #01083a;
}
.tester-list-box {
    padding: 5px;
}
.tester-list-box > div {
    margin-bottom: 15px;
}
.tester-item{
    display: grid;
    grid-template-columns: 0.5fr 0.5fr 1.5fr 1.5fr 0.5fr 0.5fr 1fr 1fr 0.5fr;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
    font-size: 15px;
}
.tester-item > :nth-child(n + 3):nth-child(-n + 4) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
} */
</style>