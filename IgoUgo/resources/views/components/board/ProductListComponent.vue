<template>
<div class="total-container">
    <div>
        <div class="left-small-container map-box">
            <h2 class="map-box-title" :class="{'test':false}">지도로 보기</h2>
        </div>
        <div class="left-small-container">
            <h2 class="cat-box-title">카테고리</h2>
            <div class="cat-list">
                <div class="list-item">
                    <input type="checkbox" name="category" id="food">
                    <label for="food">맛집</label>
                </div>
                <div class="list-item">
                    <input type="checkbox" name="category" id="activity">
                    <label for="activity">액티비티</label>
                </div>
                <div class="list-item">
                    <input type="checkbox" name="category" id="shopping">
                    <label for="shopping">쇼핑</label>
                </div>
                <div class="list-item">
                    <input type="checkbox" name="category" id="healing">
                    <label for="healing">힐링</label>
                </div>
            </div>
        </div>
        <div class="left-small-container">
            <h2 class="pri-box-title">가격</h2>
            <div class="pri-list">
                <div class="list-item">
                    <input type="checkbox" name="price" id="price1">
                    <label for="price1">2만원 이하</label>
                </div>
                <div class="list-item">
                    <input type="checkbox" name="price" id="price2">
                    <label for="price2">2만원 ~ 4만원</label>
                </div>
                <div class="list-item">
                    <input type="checkbox" name="price" id="price3">
                    <label for="price3">4만원 ~ 6만원</label>
                </div>
                <div class="list-item">
                    <input type="checkbox" name="price" id="price4">
                    <label for="price4">6만원 ~ 8만원</label>
                </div>
                <div class="list-item">
                    <input type="checkbox" name="price" id="price5">
                    <label for="price5">8만원 이상</label>
                </div>
            </div>
        </div>
        <div class="button-position">
            <button class="btn bg-navy button-wide">적용</button>
        </div>
    </div>

    <div>
        <div class="right-small-container select-result-box">
            <h2><span class="font-blue">200</span> 개의 결과</h2>
            <div class="select-list font-default-size">
                <div class="select-list-item">
                    선택사항1
                    <img src="img_product/img_x.png" class="img-x">
                </div>
                <div class="select-list-item">
                    선택사항2
                    <img src="img_product/img_x.png" class="img-x">
                </div>
                <div class="select-list-item">
                    선택사항3
                    <img src="img_product/img_x.png" class="img-x">
                </div>
                <div class="select-list-item">
                    전체 해제
                    <img src="img_product/img_x.png" class="img-x">
                </div>
            </div>
        </div>
        <div class="right-small-container order-box font-default-size">
            <div>
                <span class="font-bold">정렬 순서 :</span>
            </div>
            <div class="order-list">
                <div class="order-list-item">
                    뽀빠이 추천
                    <img src="img_product/img_star.png" class="img-order">
                </div>
                <p>|</p>
                <div class="order-list-item">
                    최신순
                    <img src="img_product/img_update.png" class="img-order">
                </div>
                <p>|</p>
                <div class="order-list-item">
                    베스트셀러
                    <img src="img_product/img_thumb.png" class="img-order">
                </div>
                <p>|</p>
                <div class="order-list-item">
                    낮은 가격
                    <img src="img_product/img_won.png" class="img-order">
                </div>
            </div>
        </div>
        <div class="right-small-container">
            <div class="card-list">
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
                <div class="card">
                    <img src="default/board_default.png" class="img-card">
                    <p class="font-bold font-mar">3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
                    <p>₩ 30,000</p>
                </div>
            </div>
            <div class="pagination">
                <a href="#"><button class="btn bg-clear"><</button></a>
                <a href="#"><button class="btn bg-clear">1</button></a>
                <a href="#"><button class="btn bg-clear">2</button></a>
                <a href="#"><button class="btn bg-clear">3</button></a>
                <a href="#"><button class="btn bg-clear">4</button></a>
                <a href="#"><button class="btn bg-clear">5</button></a>
                <a href="#"><button class="btn bg-clear">></button></a>
            </div>
        </div>
    </div>
</div>
</template>

<script setup>
</script>

<style scoped>
/* 전체를 감싸는 제일 큰 틀 */
.total-container {
    display: grid;
    grid-template-columns: 1fr 5fr;
    gap: 1rem;
    padding: 0 50px;
}

/* 작은 틀 */
.left-small-container {
    border: 1px solid #01083A;
    border-radius: 10px;
    margin: 1rem 0;
    padding: 20px;
}
.right-small-container {
    /* border: 1px solid #01083A; */
    border-radius: 10px;
    margin: 1rem 0;
}

/* 리스트 아이템 */
.list-item {
    display: flex;
    gap: 10px;
    font-size: 20px;
}

/* 지도 관련 */
.map-box {
    /* height: 200px; */
    background-image: url('/default/map_example.png');
    background-position: center;
}
.map-box-title {
    margin-top: 146px;
    background-color: rgba(255, 255, 255, .7);
    text-align: center;
    /* border-radius: 10px; */
}

/* 카테고리 관련 */
.cat-box-title {
    text-align: center;
}
.cat-list {
    display: flex;
    flex-direction: column;
    /* justify-content: space-around; */
    gap: 20px;
    margin-top: 10px;
}

/* 가격 관련 */
.pri-box-title {
    text-align: center;
}
.pri-list {
    /* height: 250px; */
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 10px;
}

/* 버튼 */
.button-position {
    text-align: center;
}
.button-wide {
    min-width: 150px;
    font-size: 1.5rem;
    border-radius: 10px;
}

/* 선택 결과 관련 */
.select-result-box {
    height: 160px;
    padding-top: 20px;
}
.select-list {
    padding: 20px;
    display: flex;
    gap: 20px;
}
.select-list-item {
    border: 1px solid #01083A;
    border-radius: 20px;
    padding: 10px;
}

/* 정렬 순서 관련 */
.order-box {
    display: flex;
    gap: 20px;
}
.order-list {
    display: flex;
    gap: 20px;
}
.order-list-item {
    display: flex;
    align-items: center;
}

/* 카드 관련 */
.card-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 50px;
}
.card {
    min-width: 200px;
    height: 300px;
    border: 1px solid #01083A;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.img-card {
    width: 190px;
    height: 190px;
}

/* 페이지네이션 */
.pagination {
    /* margin: 0 auto; */
    /* text-align: center; */
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-top: 20px;
}
.pagination button {
    font-size: 20px;
    border-radius: 50px;
    width: 40px;
    height: 40px;
    text-align: center;
}
.pagination button:hover, .pagination button:active {
    color: #fff;
    background: #01083a;
}

/* 폰트 관련 */
.font-default-size {
    font-size: 18px;
}
.font-blue {
    color: #0000ff;
}
.font-bold {
    font-weight: 900;
}
.font-mar {
    margin: 10px 0;
}

/* 기타 등등 */
.img-x { 
    width: 12px;
    height: 12px;
    margin-left: 10px;
}
.img-order { 
    width: 20px;
    height: 20px;
    margin-left: 5px;
}
/* 일단 얘는 나중에 글자 크기 조절 */
.test {
    font-size: 5px;
}
</style>