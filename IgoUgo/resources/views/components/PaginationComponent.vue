<template>      
<div class="pagination">
    <button class="btn bg-clear" @click="() => { prevPage(); scrollReset(); }"><</button>
    <button
        v-for="page in viewPageNumber" :key="page"
        @click="() => { changePage(page); scrollReset(); }"
        :class="{ 'active-page': page == currentPage, 'btn bg-clear': true }"
        >{{ page }}
    </button>
    <button class="btn bg-clear" @click="() => { nextPage(); scrollReset(); }">></button>
</div>
<!-- <h1>{{ currentPage }}</h1>
<h1>{{ lastPage }}</h1> -->
</template>

<script setup>
import { computed, defineProps, reactive, ref } from 'vue';
import { useStore } from 'vuex';

const props = defineProps({
    'actionName': String,
    'searchData': Object,
    'currentPage': Number,
    'lastPage': Number,
    'viewPageNumber': Array,
});
const currentPage = computed(() => props.currentPage);
// const lastPage = computed(() => store.state.pagination.lastPage);
const lastPage = computed(() => props.lastPage);
const viewPageNumber = computed(() => props.viewPageNumber);

const store = useStore();


function prevPage() { 
    if (currentPage.value > 1) {
        requestParam.page = currentPage.value - 1;
        store.dispatch(props.actionName, requestParam);
    }
}

function nextPage() {
    if (currentPage.value < lastPage.value) {
        requestParam.page = currentPage.value + 1;
        store.dispatch(props.actionName, requestParam);
    }
}


const requestParam = reactive(props.searchData);
const changePage = (page) => {
    requestParam.page = page;
    store.dispatch(props.actionName, requestParam);
}

// 스크롤스크롤
function scrollReset() {
    if (window.location.pathname === '/hotels' || window.location.pathname.startsWith('/products')) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

</script>

<style scoped>
/* 페이지네이션 */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    min-width: 340px;
}
.pagination button {
    font-size: 20px;
    border-radius: 50px;
    width: 40px;
    height: 40px;
    text-align: center;
    /* border: 2px solid #01083A; */
}
.pagination button:hover, .pagination button:active {
    color: #fff;
    background: #01083A;
}
.active-page {
    font-weight: 900;
    color: #fff;
    background: #01083A;
}
</style>