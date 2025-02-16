<template>
<div class="notice-container">
        <div class="header-flex">
            <div>
                <p class="notice-title">공지사항 작성</p>
                <hr class="hr-style">
            </div>
            <div class="header-btn">
                <button @click="$store.dispatch('adminNotice/storeNotice', notice)" class="btn bg-navy btn-list">완료</button>
                <router-link to="/admin/notice"><button class="btn bg-navy btn-list">취소</button></router-link>
            </div>
        </div>
        <div class="notice-content-box">
            <div class="title-box">
                <div class="title-content">
                    <p>제목</p>
                    <input v-model="notice.board_title" type="text" name="board_title">
                </div>
            </div>
            <div class="notice-content">
                <div class="board-img-content">
                    <input @change="setFile" type="file" multiple name="board_img" accept="image/*">
                    <div class="img-grid">
                        <div class="img-preview" v-for="(preview, index) in previews" :key="index">
                            <img :src="preview">
                            <button @click="clearFile(index)" class="btn bg-clear">X</button>
                        </div>
                    </div>
                </div>
                <textarea v-model="notice.board_content" ref="textArea" @input="resize" name="board_content" placeholder="내용"></textarea>
            </div>
        </div>
    </div>
</template>
<script setup>
import { reactive, ref, watch } from 'vue';

const notice = reactive({
    board_title: ''
    ,board_content: ''
    ,board_img: []
});

const previews = ref([]);
const maxFiles = 5;

const setFile = (e) => {
    const arrayFiles = Array.from(e.target.files);
    const emptyFilesSpace = maxFiles - notice.board_img.length - arrayFiles.length;

    // 5MB 이하 파일만 허용
    if(!arrayFiles.every(file => file.size <= 5 * 1024 * 1024)) {
        alert(`파일 크기 5MB이하만 추가할 수 있습니다.`);
    } else if (emptyFilesSpace < 0) {
        alert(`최대 ${maxFiles}개까지만 추가할 수 있습니다.`);
    } else {
        // 기존 파일과 새로운 파일 병합
        notice.board_img = [...notice.board_img, ...arrayFiles];
    
        // 미리보기 URL 생성
        previews.value = notice.board_img.map(file => URL.createObjectURL(file));
    }

    // <input> 초기화하여 동일한 파일 다시 선택 가능
    e.target.value = '';
}

const clearFile = (index) => {
    URL.revokeObjectURL(previews.value[index]);
    notice.board_img.splice(index, 1);
    previews.value.splice(index, 1);
}

const textArea = ref(null);

const resize = () => {
    textArea.value.style.height = "1px";
    textArea.value.style.height = textArea.value.scrollHeight + "px";
};
</script>
<style scoped>
/* 큰 틀 */
.notice-container {
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
.notice-title {
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
.notice-content-box {
    padding: 20px 10px;
    min-height: 100px;
    background-color: #fff;
}

.title-content > input {
    width: 80%;
    background: #ebebeb;
    border-radius: 10px;
    height: 40px;
    padding: 0 10px;
}

.title-box {
    display: grid;
    border-bottom: 1px solid #000;
    grid-template-columns: 2fr 1fr;
    padding: 10px;
} 

.title-content {
    display: flex;
    gap: 30px;
}

.notice-content {
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
    min-height: 400px;
    background: #ebebeb;
    border-radius: 10px;
    padding: 10px;
}
</style>