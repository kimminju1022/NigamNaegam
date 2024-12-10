<template>
<div class="total-container">
    <div class="left-container">
        <div class="small-container map-box">
            <h2 class="map-box-title">지도로 보기</h2>
        </div>
        <div class="small-container">
            <h2 class="cat-box-title">카테고리</h2>
            <div class="cat-list">
                <div >
                    <input type="checkbox" name="category" id="food">
                    <label for="food">맛집</label>
                </div>
                <div>
                    <input type="checkbox" name="category" id="activity">
                    <label for="activity">액티비티</label>
                </div>
                <div>
                    <input type="checkbox" name="category" id="shopping">
                    <label for="shopping">쇼핑</label>
                </div>
                <div>
                    <input type="checkbox" name="category" id="healing">
                    <label for="healing">힐링</label>
                </div>
            </div>
        </div>
        <div class="small-container">
            <h2 class="pri-box-title">가격</h2>
            <div class="pri-list">
                <div>
                    <input type="checkbox" name="price" id="price1">
                    <label for="price1">2만원 이하</label>
                </div>
                <div>
                    <input type="checkbox" name="price" id="price2">
                    <label for="price2">2만원 ~ 4만원</label>
                </div>
                <div>
                    <input type="checkbox" name="price" id="price3">
                    <label for="price3">4만원 ~ 6만원</label>
                </div>
                <div>
                    <input type="checkbox" name="price" id="price4">
                    <label for="price4">6만원 ~ 8만원</label>
                </div>
                <div>
                    <input type="checkbox" name="price" id="price5">
                    <label for="price5">8만원 이상</label>
                </div>
            </div>
        </div>
        <div class="button-position">
            <button class="btn bg-navy button-wide">적용</button>
        </div>
    </div>

    <div class="right-container">
        <div class="small-container">
            <h2>n개의 결과</h2>
        </div>
        <div class="small-container">
            <h2>정렬 순서</h2>
        </div>
        <div class="small-container">
            <h2>카드 리스트</h2>
        </div>
    </div>
</div>
</template>

<script setup>
</script>

<style scoped>
/* 전체를 감싸는 제일 큰 틀 */
.total-container {
    margin: 50px 100px;
    display: grid;
    grid-template-columns: 1fr 3fr;
    
    gap: 1rem;
}

/* 왼쪽 큰 틀 */
/* .left-container {
    width: 500px;
    border: 2px solid #01083A;
} */

/* 오른쪽 큰 틀 */
/* .right-container {
    width: 500px;
    border: 2px solid #01083A;
} */

/* 작은 틀 */
.small-container {
    border: 1px solid #01083A;
    border-radius: 10px;
    margin: 1rem 0;
    padding: 20px 30px;
}

/* 지도 관련 */
.map-box {
    height: 200px;
    background-image: url('/default/map_example.png');
    background-position: center;
}
.map-box-title {
    margin-top: 146px;
    background-color: #fff;
    text-align: center;
    border-radius: 10px;
}

/* 카테고리 관련 */
.cat-box-title {
    text-align: center;
}
.cat-list {
    height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
}

/* 가격 관련 */
.pri-box-title {
    text-align: center;
}
.pri-list {
    height: 250px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
}

/* 버튼 */
.button-position {
    text-align: center;
}
.button-wide {
    width: 150px;
    font-size: 1.5rem;
    border-radius: 10px;
}
</style>