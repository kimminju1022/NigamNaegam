<template>      
<div class="pagination">
    <button class="btn bg-clear"><</button>
    <button
        v-for="page in $store.state.pagination.viewPageNumber" :key="page"
        @click="changePage(page)" 
        :class="{ 'active-page': page == $store.state.pagination.currentPage, 'btn bg-clear': true }"
        >{{ page }}
    </button>
    <button class="btn bg-clear">></button>
</div>
</template>

<script setup>
import { defineProps, reactive } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const props = defineProps({
    'actionName': String,
    'serchData': Object,
});

const requestParam = reactive(props.serchData);
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
}
</style>