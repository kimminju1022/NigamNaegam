<template>
    <div>
        <h1>인증중</h1>
    </div>
</template>
<script setup>
const store = useStore();
const userInfo  = computed(() => store.state.verification.verifiedUser);

beforeMount(()=>{
    store.dispatch('verification.verifiedChk', userInfo);
});
</script>
<style>
    
</style>