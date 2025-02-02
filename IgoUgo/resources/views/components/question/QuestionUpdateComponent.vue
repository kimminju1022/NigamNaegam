-<template>
    <div class="container">
        <h1>문의게시판</h1>
        <div class="header-btn-box"> 
            <button @click="$store.dispatch('question/updateQuestion', question)" class="btn bg-navy header-btn">완료</button>
            <router-link :to="'/questions'"><button @click="" class="btn bg-navy header-btn">취소</button></router-link>
        </div>
        <div class="board-box">  
            <div class="board-box-flex">
                <div class="board-title-box board-title">
                    <p>제목</p>
                    <input v-model="question.questionDetail.board_title" type="text" name="board_title">
                </div>
                <div class="board-title-box board-title-category">
                    <p>카테고리 선택</p>
                    <select v-model="question.questionDetail.question_category.qc_code" name="category" id="category" class="question_category">
                        <option value="0">로그인</option>
                        <option value="1">회원가입</option>
                        <option value="2">게시판</option>
                        <option value="3">호텔</option>
                        <option value="4">관광지</option>
                        <option value="5">문화시설</option>
                        <option value="6">레포츠</option>
                        <option value="7">쇼핑</option>
                        <option value="8">음식점</option>
                    </select>
                    <!-- <p>{{ question.questionDetail.question_category.qc_code }}</p> -->
                </div>
            </div>
            <div class="board-img">
                <p>파일 첨부</p>
                <!-- <div class="board-img-content">
                    <input @change="setFile1" type="file" name="board_img1" accept="image/*">
                    <input @change="setFile2" type="file" name="board_img2" accept="image/*">
                    <div class="img-preview">
                        <img :src="preview1 || question.questionDetail.board_img1"> 
                        <button @click="clearFile1" v-show="preview1" class="btn bg-clear">X</button>
                    </div>
                    <div class="img-preview">
                        <img :src="preview2 || question.questionDetail.board_img2"> 
                        <button @click="clearFile2" v-show="preview2" class="btn bg-clear">X</button>
                    </div>
                </div> -->
                <div class="board-img-content">
                    <input @change="setFile" type="file" multiple name="board_img" accept="image/*">
                    <div class="img-grid">
                        <div class="img-preview" v-for="(preview, index) in previews" :key="index">
                            <img :src="preview">
                            <button @click="clearFile(index)" class="btn bg-clear">X</button>
                        </div>
                    </div>
                    <div class="img-grid">
                        <div class="img-preview" v-for="(image, item) in question.questionDetail.board_images" :key="item">
                            <img :src="image.board_img">
                            <button @click="removeFile(item)" class="btn bg-clear">X</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="board-content">
                <p>내용</p>
                <textarea maxlength="2000" v-model="question.questionDetail.board_content" name="board_content"></textarea>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref, watch } from 'vue';
import { useStore } from 'vuex';
// import router from '../../../js/router';

const store =  useStore();

const question = reactive({
    questionDetail: store.state.question.questionDetail
    ,board_img :[]
});

// console.log('question : ',question);
// console.log('questionDetail : ',question.questionDetail);

watch(() => question.questionDetail.question_category.qc_code, (newQcCode) => {
    const categories = {
        0: '로그인', 
        1: '회원가입',
        2: '게시판',
        3: '호텔',
        4: '관광지',
        5: '문화시설',
        6: '레포츠',
        7: '쇼핑',
        8: '음식점'
    };
    question.questionDetail.question_category.qc_name = categories[newQcCode] || '';
    // console.log(question.questionDetail.question_category.qc_name);
});

// const preview1 = ref('');
// const preview2 = ref('');

// const setFile1 = (e) => {
//     question.board_img1 = e.target.files[0];
//     preview1.value = URL.createObjectURL(question.board_img1);
// }

// const setFile2 = (e) => {
//     question.board_img2 = e.target.files[0];
//     preview2.value = URL.createObjectURL(question.board_img2);
// }

// const clearFile1 = () => {
//     question.board_img1 = null;
//     preview1.value = null;
// }

// const clearFile2 = () => {
//     question.board_img2 = null;
//     preview2.value = null;
// }

const previews = ref([]);
const maxFiles = 5;

const setFile = (e) => {
    const arrayFiles = Array.from(e.target.files);
    // const emptyFilesSpace = maxFiles - imageCount - arrayFiles.length;
    const totalFiles = question.board_img.length + arrayFiles.length + question.questionDetail.board_images.length;

    // 5MB 이하 파일만 허용
    if(!arrayFiles.every(file => file.size <= 5 * 1024 * 1024)) {
        alert(`파일 크기 5MB이하만 추가할 수 있습니다.`);
    // } else if (emptyFilesSpace < 0) {
    } else if (totalFiles > maxFiles) {
        alert(`최대 ${maxFiles}개까지만 추가할 수 있습니다.`);
    } else {
        // 기존 파일과 새로운 파일 병합
        question.board_img = [...question.board_img, ...arrayFiles];
    
        // 미리보기 URL 생성
        previews.value = question.board_img.map(file => URL.createObjectURL(file));
    }

    // <input> 초기화하여 동일한 파일 다시 선택 가능
    e.target.value = '';
}

const clearFile = (index) => {
    URL.revokeObjectURL(previews.value[index]); // 메모리 해제
    question.board_img.splice(index, 1); // 파일 제거
    previews.value.splice(index, 1); // 미리보기 제거
}

const removeFile = (item) => {
    URL.revokeObjectURL(previews.value[item]); // 메모리 해제
    question.questionDetail.board_images.splice(item, 1); // 파일 제거
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

select {
    border: none;
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

.board-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    margin-top: 50px;
}

.board-box > div:not(:first-child) {
    display: grid;
    grid-template-columns: 1fr 5fr;
    border-bottom: 1px solid #01083a;
}

.board-box > div > :first-child, .board-title-box > p{
    border-right: 1px solid #01083a;
}

.board-box-flex {
    display: grid;
    grid-template-columns: 2fr 1fr;
}

.board-title {
    display: grid;
    grid-template-columns: 1fr 2.99fr;
    border-bottom: 1px solid #01083a;
}

.board-title-category {
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-bottom: 1px solid #01083a;
}

.board-title-box > p:first-child
,.board-img > p:first-child
, .board-content> p:first-child {
    font-size: 18px;
    text-align: center;
    font-weight: 600;
}

.board-box p, .board-title-box > input ,.board-content > textarea {
    padding: 10px;
    font-size: 17px;
}

/* .board-title-box {
    display: grid;
    grid-template-columns: 1fr 4fr 1fr;
    border-bottom: 1px solid #01083a;
} */

/* .board-num {
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-left: 1px solid #01083a;
} */

/* .board-num :first-child {
    border-right: 1px solid #01083a;
    font-weight: 600;
    font-size: 18px;
    text-align: center;
} */

.board-content > textarea {
    resize: none;
    height: 300px;
    margin: 10px;
}

.board-img-content {
    padding: 10px;
    display: grid;
    grid-template-rows: 40px 1fr;
}

.board-img-content :nth-child(-n + 2) {
    margin-bottom: 10px;
} 

.question_category {
    outline: none;
    font-size: 16px;
    margin: 0  auto;
    width: 80%;
}

.img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
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
</style>