<template>      
<div class="pagination">
    <button class="btn bg-clear" @click="prevPage"><</button>
    <button
        v-for="page in $store.state.pagination.viewPageNumber" :key="page"
        @click="changePage(page)" 
        :class="{ 'active-page': page == $store.state.pagination.currentPage, 'btn bg-clear': true }"
        >{{ page }}
    </button>
    <button class="btn bg-clear" @click="nextPage">></button>
</div>
</template>

<script setup>
import { computed, defineProps, reactive } from 'vue';
import { useStore } from 'vuex';

const currentPage = computed(() => store.state.pagination.currentPage);
const lastPage = computed(() => store.state.pagination.lastPage);

const store = useStore();

const props = defineProps({
    'actionName': String,
    'searchData': Object,
});

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