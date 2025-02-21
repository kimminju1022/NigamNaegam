<template>
    <div class="que-container" v-if="questionDetail">
        <div class="header-flex">
            <div>
                <p class="que-title">문의 상세</p>
                <hr class="hr-style">
            </div>
            <div class="header-btn">
                <button @click="$store.dispatch('adminQuestion/questionStore', adminQuestion)" class="btn bg-navy btn-header">완료</button>
                <router-link :to="'/admin/question'"><button class="btn bg-navy btn-header">취소</button></router-link>
                <!-- <button @click="deleteQuestion(questionDetail.board_id)" class="btn bg-navy btn-header">삭제</button> -->
            </div>
        </div>
        <div class="que-content-container">
            <div class="que-content-box">
                <h3>유저 문의</h3>
                <div class="que-content-head">
                    <div class="que-content que-content-number">
                        <!-- <p>글번호</p> -->
                        <p>글번호 : {{ questionDetail.board_id }}</p>
                        <p>{{ questionDetail.question_category?.qc_name }}</p>
                    </div>
                    <div class="que-content que-content-title">
                        <p>제목 :</p>
                        <textarea name="" id="" class="textarea-title" readonly>{{ questionDetail.board_title }}</textarea>
                    </div>
                    <div class="que-content que-content-user">
                        <p>{{ questionDetail.user?.user_nickname}}</p>
                        <p>{{ questionDetail.created_at_timestamps }}</p>
                    </div>
                </div>
                <div class="que-content-text">
                    <textarea class="textarea-content" readonly>{{ questionDetail.board_content }}</textarea>
                    <div class="img-grid">
                        <img v-for="(image, index) in questionDetail.board_images" :key="index" :src="image.board_img">
                    </div>
                    <!-- <p>{{ questionDetail.board_images }}</p> -->
                    <!-- <img src="../../../../public/logo_gam.png" alt=""> -->
                </div>
            </div>
            <div class="que-content-box">
                <h3>관리자 답변</h3>
                <div class="que-content-admin">
                    <p v-if="questionDetail?.question?.que_status === '1'">{{ questionDetail?.question?.user?.user_name }}</p>
                    <p v-else>미답변</p>
                    <p v-if="questionDetail?.question?.que_status === '1'">{{ questionDetail?.question?.updated_at_timestamps }}</p>
                    <p v-else>미답변 상태</p>
                </div>
                
                <!-- <textarea class="textarea-admin-content" name="que_content" maxlength="2000"></textarea> -->
                <textarea v-model="adminQuestion.que_content" class="textarea-admin-content" name="que_content" maxlength="2000"></textarea>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();

const questionDetail = computed(() => store.state.adminQuestion.questionDetail);
// console.log(questionDetail);

const managerInfo = computed(() => store.state.auth.managerInfo);

const adminQuestion = reactive({
    // que_content: '이건 프론트에서 보내는 중',
    que_content: '',
    board_id: route.params.id,
    user_id: managerInfo.value.user_id,
});

onBeforeMount(()=>{
    store.dispatch('adminQuestion/questionDetail', adminQuestion)
    .then(() => {
        adminQuestion.que_content = questionDetail.value.question.que_content;
    })
    .catch(error => {
        console.error(error);
    });
    // console.log('비포마운트 안', questionDetail.value);
});

const deleteQuestion = (id) => {
    const check = confirm('해당 글을 삭제 하시겠습니까?\n삭제 시 게시글을 되돌릴 수 없습니다');
    if(check) {
        store.dispatch('adminQuestion/destroyQuestion', id);
    }
}
</script>

<style scoped>
/* 문의 관리 큰 틀 */
.que-container {
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
    display:grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.btn-header {
    border-radius: 50px;
    width: 60px;
    height: 40px;
    font-size: 20px;
}

.btn-header:hover {
    color: #01083a;
    background-color: #fff;
    box-shadow: 0 0 0 2px #01083a inset;
}

/* 문의 관리 타이틀 */
.que-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    width: 500px;
    margin-top: 5px;
}

/* 문의 내역 리스트 관련 */
.que-content-container {
    display: grid;
    grid-template-rows: 1fr 1fr;
    gap: 20px;
}
.que-content-box {
    padding: 10px;
    background-color: #fff;
}

.que-content-head {
    display: grid;
    gap: 20px;
    border-bottom: 1px solid #000;
    grid-template-columns: 2fr 7fr 4fr;
    margin-top: 5px;
    padding: 0 10px;
}

.que-content {
    display: grid;
    grid-template-columns: 2fr 1fr 2fr;
    font-size: 18px;
    gap: 10px;
}

.que-content-number {
    display: grid;
    grid-template-columns: 2fr 1fr;
    /* place-items: center; */
}

.que-content-title {
    display: grid;
    grid-template-columns: 1fr 10fr;
    /* align-items: center; */
}

.que-content-user {
    display: grid;
    grid-template-columns: 1.5fr 2fr;
    /* place-items: center; */
}

.que-content-admin {
    display: grid;
    grid-template-columns: 4fr 1fr;
    justify-items: flex-end;
    gap: 40px;
    margin-top: 5px;
    font-size: 18px;
    border-bottom: 1px solid #000;
}

.que-content-admin p:last-child {
    margin: 0 auto;
}

textarea {
    resize: none;
    margin-top: 10px;
    font-size: 17px;
}

.textarea-title {
    margin-top: 0;
    height: 100%;
}

.textarea-content {
    height: 250px;
    padding: 0 20px;
}

.textarea-admin-content {
    width: 100%;
    height: 75%;
    padding: 0 20px;
}

.que-content-text {
    display: grid;
    grid-template-columns: 1fr 1fr; 
}

.img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    place-items: center;
    /* margin: 0 auto; */
}

.img-grid > img {
    max-width: 200px;
    max-height: 100px;
}

</style>