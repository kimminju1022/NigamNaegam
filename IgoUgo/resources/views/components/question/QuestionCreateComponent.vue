<template>
    <div class="container">
        <h1>문의게시판</h1>
        <!-- <div class="header-btn-box"> 
            <button @click="$store.dispatch('question/storeQuestion', question)" class="btn bg-navy header-btn">완료</button>
            <router-link :to="'/questions'"><button @click="" class="btn bg-navy header-btn">취소</button></router-link>
        </div> -->
        <div class="board-box">  
            <div class="board-box-flex">
                <div class="board-title-box board-title">
                    <p>제목</p>
                    <input v-model="question.board_title" type="text" name="board_title" required>
                </div>
                <div class="board-title-box board-title-category">
                    <p>카테고리 선택</p>
                    <select v-model="question.qc_code" name="category" id="category" class="question_category" required>
                        <option value="0">로그인</option>
                        <option value="1">회원가입</option>
                        <option value="2">게시판</option>
                        <option value="3">호텔</option>
                        <option value="4">관광지</option>
                        <option value="5">문화시설</option>
                        <option value="6">레포츠</option>
                        <option value="7">쇼핑</option>
                        <option value="8">음식점</option>
                        <option value="9">기타</option>
                    </select>
                </div>
            </div>
            <div class="board-img">
                <p>파일 첨부</p>
                <div class="board-img-content">
                    <input @change="setFile" type="file" multiple name="board_img" accept="image/*">
                    <div class="img-grid">
                        <div class="img-preview" v-for="(preview, index) in previews" :key="index">
                            <img :src="preview">
                            <button @click="clearFile(index)" class="btn bg-clear">X</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="board-content">
                <p>내용</p>
                <textarea v-model="question.board_content" name="board_content" required></textarea>
            </div>
        </div>
        <div class="header-btn-box"> 
            <button @click="$store.dispatch('question/storeQuestion', question)" class="btn bg-navy header-btn">완료</button>
            <router-link :to="'/questions'"><button @click="" class="btn bg-navy header-btn">취소</button></router-link>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref, watch } from 'vue';

const question = reactive({
    board_title: ''
    ,board_content: ''
    ,board_img: []
    ,qc_code: ''
    ,qc_name: ''
});

watch(() => question.qc_code, (newQcCode) => {
    const categories = {
        0: '로그인', 
        1: '회원가입',
        2: '게시판',
        3: '호텔',
        4: '관광지',
        5: '문화시설',
        6: '레포츠',
        7: '쇼핑',
        8: '음식점',
        9: '기타',
    };
    question.qc_name = categories[newQcCode] || '';
});

// const preview = ref('');

const previews = ref([]);
const maxFiles = 5;

const setFile = (e) => {
    // question.board_img = e.target.files[0];
    // preview.value = URL.createObjectURL(question.board_img);

    const arrayFiles = Array.from(e.target.files);
    const emptyFilesSpace = maxFiles - question.board_img.length - arrayFiles.length;

    // 5MB 이하 파일만 허용
    if(!arrayFiles.every(file => file.size <= 5 * 1024 * 1024)) {
        alert(`파일 크기 5MB이하만 추가할 수 있습니다.`);
    } else if (emptyFilesSpace < 0) {
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
    // question.board_img = null;
    // preview.value = null;

    URL.revokeObjectURL(previews.value[index]); // 메모리 해제
    question.board_img.splice(index, 1); // 파일 제거
    previews.value.splice(index, 1); // 미리보기 제거
}

</script>

<style scoped>
.container{
    align-items: center;
}

.container > h1 {
    font-size: 2rem;
    margin: 25px 0;
}

select {
    border: none;
}

.header-btn-box {
    display: flex;
    justify-content: flex-end;
    margin-top: 50px;
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
    font-size: 20px;
    text-align: center;
    font-weight: 600;
}

.board-box p, .board-title-box > input ,.board-content > textarea {
    padding: 10px;
    font-size: 17px;
}

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
</style>