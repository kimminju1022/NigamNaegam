<template>
    <div class="notice-container" v-if="noticeDetail">
        <div class="header-flex">
            <div>
                <p class="notice-title">공지사항 상세</p>
                <hr class="hr-style">
            </div>
            <div class="header-btn">
                <router-link :to="`/admin/notice/${noticeDetail.board_id}/edit`"><button class="btn bg-navy btn-list">수정</button></router-link>
                <router-link to="/admin/notice"><button class="btn bg-navy btn-list">취소</button></router-link>
                <button @click="deleteNotice(noticeDetail.board_id)" class="btn bg-navy btn-list">삭제</button>
            </div>
        </div>
        <div class="notice-content-box">
            <div class="info-top">
                <div class="info-top-grid">
                    <div class="board-id">
                        <p>번호</p>
                        <p>{{ noticeDetail.board_id }}</p>
                    </div>
                    <div class="admin-name">
                        <p>작성자</p>
                        <p>{{ noticeDetail.user.user_name }}</p>
                    </div>
                </div>
                <div class="title-content-time">
                    <p>최종 수정일자</p>
                    <p>{{ noticeDetail.updated_at_timestamps }}</p>
                </div>
            </div>
            <div class="title-box">
                <p>제목</p>
                <p>{{ noticeDetail.board_title }}</p>
            </div>
            <div class="notice-content">
                <img :src="noticeDetail.board_images[0]?.board_img">
                <textarea ref="textArea" @input="resize" name="board_content" placeholder="내용" readonly>{{ noticeDetail.board_content }}</textarea>
            </div>
        </div>
    </div>
    <!-- 체험단 당첨자 명단은 DB에서만 관리하는건가 -->
</template>
<script setup>
import { computed, onBeforeMount, reactive, ref } from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const route = useRoute();

const noticeDetail = computed(() => store.state.adminNotice.noticeDetail);

const boardInfo = reactive({
    board_id: route.params.id,
});

onBeforeMount(()=>{
    store.dispatch('adminNotice/noticeDetail', boardInfo);
});

const textArea = ref(null);

const resize = () => {
    textArea.value.style.height = "1px";
    textArea.value.style.height = textArea.value.scrollHeight + "px";
};

const deleteNotice = (id) => {
    const check = confirm('해당 글을 삭제 하시겠습니까?');
    if(check) {
        store.dispatch('adminNotice/destroyNotice', id);
    }
}
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

/* 타이틀 */
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

.info-top {
    display: grid;
    grid-template-columns: 2fr 1fr;
    border-bottom: 1px solid #000;
    padding: 10px;
}

.info-top-grid {
    display: grid;
    grid-template-columns: 1fr 3fr;
}

.board-id {
    display: flex;
    gap: 30px;
}

.admin-name {
    display: flex;
    gap: 50px;
}

.title-box, .place-box {
    display: grid;
    border-bottom: 1px solid #000;
    grid-template-columns: 1fr 7fr;
    padding: 10px;
} 

.title-content, .title-content-time, .place-content, .place-conent-time {
    display: flex;
    gap: 30px;
}

.notice-content {
    margin: 10px auto;
    width: 90%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.notice-content img {
    max-width: 300px;
    max-height: 250px;
}

/* 텍스트 */
textarea {
    resize: none;
    width: 100%;
    min-height: 420px;
    padding: 10px;
    font-size: 16px;
}
</style>