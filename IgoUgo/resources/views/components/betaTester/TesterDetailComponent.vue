<template>
    <div class="container" v-if="testerDetail">
        <h1>체험단 신청</h1>
        <div class="header-btn-box">
            <router-link :to="`/testers`"><button class="btn bg-navy header-btn">목록</button></router-link>
        </div>
        <div class="board-box">
            <div class="board-box-flex">
                <p>카테고리</p>
                <p>{{ testerDetail.board_title }}</p>
                <p>{{ testerDetail.created_at }}</p>
            </div>
            <div class="board-content-box">
                <div class="board-content">
                    <div class="board-content-img">
                        <div class="img-grid">
                            <img v-for="(image, index) in testerDetail.board_images" :key="index" :src="image.board_img">
                        </div> 
                    </div>
                    <div class="content-textarea">
                        <textarea readonly>{{ testerDetail.board_content }}</textarea>
                    </div>
                    <p>모집 기한 : 2025-01-01</p>
                    <p>신청은 댓글로</p>
                </div>
            </div>
            <div>
                <div>

                </div>
                <!-- <PaginationComponent
                    :actionName="actionName"
                    :searchData="searchData"
                    :currentPage="$store.state.pagination.currentPage"
                    :lastPage="$store.state.pagination.lastPage"
                    :viewPageNumber="$store.state.pagination.viewPageNumber"
                /> -->
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
// import PaginationComponent from '../PaginationComponent.vue';

const store = useStore();
const route = useRoute();
// const actionName = 'question/questionList';

const testerDetail = computed(() => store.state.tester.testerDetail);

const boardInfo = reactive({
    board_id: route.params.id,
});
// const searchData = reactive({
//     page: store.state.pagination.currentPage,
// });


onBeforeMount(()=>{
    store.dispatch('tester/testerDetail', boardInfo);
    // store.dispatch(actionName, searchData);
});
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
}

.board-box {
    border-top: 2px solid #01083a;
    border-bottom: 2px solid #01083a;
    margin-top: 50px;
}

.board-box p {
    padding: 10px;
    font-size: 17px;
}

.board-box p, .board-content textarea {
    font-size: 17px;
}

/* .board-box >.board-box-flex > :first-child {
    border-right: 1px solid #01083a;
} */

.board-box-flex {
    display: grid;
    grid-template-columns: 1fr 7fr 1fr;
    place-items: center;
}

.board-content-box {
    border-top: 1px solid #01083a;
}

.board-content {
    width: 70%;
    margin: 50px auto;
}

.board-content textarea {
    resize: none;
    height: 600px;
    width: 100%;
    /* margin: 10px auto; */
}

/* .textarea-center {
    margin: 0 auto;
} */

.board-content-img {
    margin: 20px auto;
}

.img-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    place-items: center;
}

.img-grid > img {
    max-width: 185px;
    max-height: 185px;
}
</style>