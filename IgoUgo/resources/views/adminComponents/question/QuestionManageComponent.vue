<template>
    <div class="que-container">
        <div>
            <p class="que-title">문의 관리</p>
            <hr class="hr-style">
        </div>
        <div class="que-content-container">
            <div class="que-content-box">
                <p class="que-content-title">문의 대기</p>
                <div>
                    <div class="que-list-title title-first">
                        <p>번호</p>
                        <p>카테고리</p>
                        <p>제목</p>
                        <p>작성자</p>
                        <p>작성일자</p>
                    </div>
                    <div class="que-list-box">
                        <div v-for="(item, index) in questionYet" class="que-item item-first">
                            <!-- <p>{{ index + 1 }}</p> -->
                            <p>{{ item.board_id }}</p>
                            <p>{{ item?.question_category?.qc_name }}</p>
                            <router-link :to="`/admin/question/${item.board_id}`">{{ item.board_title }}</router-link>
                            <p>{{ item?.user?.user_nickname }}</p>
                            <p>{{ item.created_at_timestamps }}</p>
                        </div>
                    </div>
                </div>
                <!-- 페이지네이션 -->
                <PaginationComponent
                    :actionName="actionNameQuestionYet"
                    :searchData="searchDataQuestionYet"
                    :currentPage="$store.state.pagination.adminQuestionYetCurrentPage"
                    :lastPage="$store.state.pagination.adminQuestionYetLastPage"
                    :viewPageNumber="$store.state.pagination.adminQuestionYetViewPageNumber"
                />
            </div>
            <div class="que-content-box">
                <p class="que-content-title">문의 완료</p>
                <div>
                    <div class="que-list-title title-second">
                        <p>번호</p>
                        <p>카테고리</p>
                        <p>제목</p>
                        <p>작성자</p>
                        <p>작성일자</p>
                        <p>관리자</p>
                        <p>답변일자</p>
                    </div>
                    <div class="que-list-box">
                        <div v-for="(item, index) in questionDone" class="que-item item-second">
                            <!-- <p>{{ index + 1 }}</p> -->
                            <p>{{ item.board_id }}</p>
                            <p>{{ item?.question_category?.qc_name }}</p>
                            <router-link :to="`/admin/question/${item.board_id}`">{{ item.board_title }}</router-link>
                            <p>{{ item?.user?.user_nickname }}</p>
                            <p>{{ item.created_at_timestamps }}</p>
                            <p>{{ item?.question?.user?.user_name }}</p>
                            <p>{{ item?.question?.updated_at_timestamps }}</p>
                            <!-- <p>관리자</p>
                            <p>2025-02-10 00:00:00</p> -->
                        </div>
                    </div>
                </div>
                <!-- 페이지네이션 -->
                <PaginationComponent
                    :actionName="actionNameQuestionDone"
                    :searchData="searchDataQuestionDone"
                    :currentPage="$store.state.pagination.adminQuestionDoneCurrentPage"
                    :lastPage="$store.state.pagination.adminQuestionDoneLastPage"
                    :viewPageNumber="$store.state.pagination.adminQuestionDoneViewPageNumber"
                />
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, reactive } from 'vue';
import { useStore } from 'vuex';
import PaginationComponent from '../../components/PaginationComponent.vue';

const store = useStore();

const questionYet = computed(() => store.state.adminQuestion.questionYet);
const questionDone = computed(() => store.state.adminQuestion.questionDone);

const actionNameQuestionYet = 'adminQuestion/questionYet';
const actionNameQuestionDone = 'adminQuestion/questionDone';

const searchDataQuestionYet = reactive({
    page: store.state.pagination.adminQuestionYetCurrentPage,
});

const searchDataQuestionDone = reactive({
    page: store.state.pagination.adminQuestionDoneCurrentPage,
});


onBeforeMount(() => {
    store.dispatch(actionNameQuestionYet, searchDataQuestionYet);
    store.dispatch(actionNameQuestionDone, searchDataQuestionDone);
});
</script>

<style scoped>
/* 문의 관리 큰 틀 */
.que-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
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
    padding: 20px 10px;
    background-color: #fff;
    display: grid;
    grid-template-rows: 30px 1fr;
    gap: 10px;
}
.que-content-title {
    font-size: 20px;
    margin-left: 10px;
}
.que-list-title {
    display: grid;
    text-align: center;
    padding: 0 5px 10px 5px;
    font-size: 18px;
    border-bottom: 1px solid #01083a;
}
.title-first {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr;
}
.title-second {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr 1fr 1.5fr;
}
.que-list-box {
    padding: 5px;
}
.que-item {
    display: grid;
    text-align: center;
    width: 100%;
    height: 30px;
    margin-top: 10px;
}
.item-first {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr;
}
.item-second {
    grid-template-columns: 1fr 1fr 5fr 1fr 1.5fr 1fr 1.5fr;
}
.item-first > a, .item-second > a {
    width: 90%;
    margin: 0 auto;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.que-item > p:nth-child(3) {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    padding: 0 10px;
}
</style>