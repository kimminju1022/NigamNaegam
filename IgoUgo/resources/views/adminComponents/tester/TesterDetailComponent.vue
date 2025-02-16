<template>
    <div class="tester-container" v-if="testerDetail">
        <div class="header-flex">
            <div>
                <p class="tester-title">체험단 상세</p>
                <hr class="hr-style">
            </div>
            <div class="header-btn">
                <router-link :to="`/admin/tester/${testerDetail.board_id}/edit`"><button class="btn bg-navy btn-list">수정</button></router-link>
                <router-link to="/admin/tester"><button class="btn bg-navy btn-list">취소</button></router-link>
                <button @click="deleteTester(testerDetail.board_id)" class="btn bg-navy btn-list">삭제</button>
            </div>
        </div>
        <div class="tester-content-box">
            <div class="info-top">
                <div class="info-top-grid">
                    <div class="board-id">
                        <p>번호</p>
                        <p>{{ testerDetail.board_id }}</p>
                    </div>
                    <p>{{ testerDetail.tester_management.tester_area }}</p>
                    <p>호텔</p>
                </div>
                <div class="admin-name">
                    <p>작성자</p>
                    <p>{{ testerDetail.user.user_name }}</p>
                </div>
            </div>
            <div class="title-box">
                <div class="title-content">
                    <p>제목</p>
                    <p>{{ testerDetail.board_title }}</p>
                </div>
                <div class="title-content-time">
                    <p>최종 수정일자</p>
                    <p>{{ testerDetail.tester_management.formatted_updated_at }}</p>
                    <!-- <p>작성일자</p>
                    <p>{{ testerDetail.tester_management.formatted_created_at }}</p> -->
                </div>
            </div>
            <div class="place-box">
                <div class="place-content">
                    <p>장소</p>
                    <p>{{ testerDetail.tester_management.tester_place }}</p>
                </div>
                <div class="place-conent-time">
                    <p>모집 기한</p>
                    <p>{{ testerDetail.tester_management.dd }}</p>
                </div>
            </div>
            <div class="tester-content">
                <img :src="testerDetail.board_images[0]?.board_img" alt="board_img1 무조건 가게정보사진">
                <!-- <p>{{ testerDetail.board_content }}</p> -->
                <textarea ref="textArea" @input="resize" name="board_content" placeholder="내용" readonly>{{ testerDetail.board_content }}</textarea>
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

const testerDetail = computed(() => store.state.adminTester.boardDetail);

const boardInfo = reactive({
    board_id: route.params.id,
});

onBeforeMount(()=>{
    store.dispatch('adminTester/testerDetail', boardInfo);
});

const textArea = ref(null);

const resize = () => {
    textArea.value.style.height = "1px";
    textArea.value.style.height = textArea.value.scrollHeight + "px";
};

const deleteTester = (id) => {
    const check = confirm('해당 글을 삭제 하시겠습니까?');
    if(check) {
        store.dispatch('adminTester/destroyTester', id);
    }
}
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
    grid-template-columns: 2fr 1fr;
    border-bottom: 1px solid #000;
    padding: 10px;
}

.info-top-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
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
    grid-template-columns: 2fr 1fr;
    padding: 10px;
} 

.title-content, .title-content-time, .place-content, .place-conent-time {
    display: flex;
    gap: 30px;
}

.tester-content {
    margin: 10px auto;
    width: 90%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.tester-content img {
    max-width: 300px;
    max-height: 300px;
}

/* 텍스트 */
textarea {
    resize: none;
    width: 100%;
    min-height: 300px;
    padding: 10px;
}

/* --------------------------------------------------------- */
.tester-list-title {
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
}
</style>