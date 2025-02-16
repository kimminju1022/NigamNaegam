<template>
    <div class="container" v-if="noticeDetail">
        <!-- <h1>공지사항</h1> -->
        <div class="header-btn-box">
            <router-link :to="`/questions`"><button class="btn bg-navy header-btn">목록</button></router-link>
        </div>
        <div class="board-box">
            <div class="board-box-flex">
                <p>공지</p>
                <p>{{ noticeDetail.board_title }}</p>
                <p>{{ noticeDetail.created_at }}</p>
            </div>
            <div class="board-content-box">
                <div class="board-content">
                    <div class="board-content-img">
                        <!-- <div class="img-grid">
                            <img v-for="(image, index) in noticeDetail.board_images" :key="index" :src="image.board_img">
                        </div> -->
                        <img :src="noticeDetail.board_images[0]?.board_img" alt="board_img1 무조건 가게정보사진">
                    </div>
                    <div class="content-textarea">
                        <textarea ref="textArea" @keup="resize" readonly>{{ noticeDetail.board_content }}</textarea>
                        <!-- <p>{{ noticeDetail.board_content }}</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, onBeforeMount, reactive, ref } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();

const noticeDetail = computed(() => store.state.notice.noticeDetail);
// console.log(noticeDetail);

const boardInfo = reactive({
    board_id: route.params.id,
});

onBeforeMount(()=>{
    store.dispatch('notice/noticeDetail', boardInfo);
});

// const textArea = ref(null);

// const resize = () => {
//     textArea.value.style.height = "1px";
//     textArea.value.style.height = textArea.value.scrollHeight + "px";
// };
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

.board-box, .admin-content-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    margin-top: 50px;
}

.board-box p {
    padding: 10px;
    font-size: 17px;
}

.board-title-box > p:first-child
, .board-content-box > p:first-child
, .admin-content-box > p:first-child {
    font-size: 18px;
    text-align: center;
    font-weight: 600;
}

/* .board-content > div:not(:last-child){
    width: 90%;
    margin: 20px auto;
} */

.board-box p, .board-content textarea {
    font-size: 17px;
}

.board-title-box textarea {
    font-size: 17px;
    resize: none;
    margin: 5px;
}

.board-box-flex {
    display: grid;
    grid-template-columns: 1fr 7fr 1.5fr;
    place-items: center;
    margin: 10px 0;
}

.board-content-box {
    border-top: 1px solid #01083a;
}

.board-content {
    width: 70%;
    margin: 50px auto;
}

.board-content-img {
    margin: 20px auto;
}

.board-content-img > img {
    margin: 0 auto;
    max-width: 500px;
    max-height: 500px;
}

.content-textarea {
    vertical-align: middle;
}

.content-textarea > textarea {
    resize: none;
    width: 100%;
    min-height: 300px;
}

.img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    place-items: center;
    /* margin: 0 auto; */
}

.img-grid > img {
    max-width: 185px;
    max-height: 185px;
}

</style>