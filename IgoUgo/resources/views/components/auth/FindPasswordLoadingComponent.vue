<template>
    <div>
        <h1>비밀번호 변경 인증 중</h1>
    </div>
</template>
<script setup>
import { onMounted, reactive } from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const route = useRoute();

const verifiedInfo = reactive({
    id: route.params.id,
    hash: route.params.hash,
});

onMounted(()=>{
    console.log(verifiedInfo);
    store.dispatch('auth/verifiedChk', verifiedInfo);
});
</script>
<style>
    
</style>