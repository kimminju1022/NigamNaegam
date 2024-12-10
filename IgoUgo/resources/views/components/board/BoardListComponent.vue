<template>
    <input v-model="search" class="board-search" type="text" placeholder="검색어를 입력해 주세요">
    <div class="select-categories">
        <label for="board-category">카테고리</label>
        <select v-model="SelectedBoardCategory" name="board-categories" id="board-categories">
            <option value="1">리뷰게시판</option>
            <option value="2">자유게시판</option>
            <option value="3">문의게시판</option>
        </select>
        <select name="sub-categories" id="sub-categories">
            <option value="0" selected>선택없음</option>
            <option value="1">맛집</option>
            <option value="2">액티비티</option>
            <option value="3">힐링</option>
            <option value="4">쇼핑</option>        
        </select>
    </div>

</template>
<script setup>

</script>

<style>
/* .board-search{
    
}
.select-categories{

} */
.board-category #categories{
    border-radius: 10px;
    line-height: 1.2rem;
    height: 1.2rem;
}

</style>