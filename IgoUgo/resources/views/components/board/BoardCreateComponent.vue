<template>
    <div class="form-box">
        <h3 class="form-title">글작성</h3>
        <div class="select-categories">
        <label for="board-category">카테고리</label>
        <select v-model="SelectedBoardCategory" name="board-categories" id="board-categories">
            <option value="1">리뷰게시판</option>
            <option value="2">자유게시판</option>
        </select>
        <select name="sub-categories" id="sub-categories">
            <option value="0" selected>선택없음</option>
            <option value="1">맛집</option>
            <option value="2">액티비티</option>
            <option value="3">힐링</option>
            <option value="4">쇼핑</option>        
        </select>
    </div>
        <input type="text" name="title" placeholder="제목을 적어주세요" maxlength="100">
        <textarea name="content" id="" placeholder="당신의 이야기를 여기에 적어주세요" maxlength="2000"></textarea>
        <input type="file" name="file" accept="imge/*">
        <button class="">작성</button>
        <button class="">취소</button>
    </div>
</template>

<script setup>

</script>

<style>

</style>