<template>
  <div class="filter-price">
        <div>
            <p class="text-box">필터링</p>
            <div class="filter-group">
                <div>
                    <input class="input-box" id="nosmoke" type="checkbox">
                    <label for="nosmoke">금연</label>
                </div>
                <div>
                    <input class="input-box" id="wifi" type="checkbox">
                    <label for="wifi">무료 Wi-fi</label>
                </div>
                <div>
                    <input class="input-box" id="morning" type="checkbox">
                    <label for="morning">조식</label>
                </div>
                <div>
                    <input class="input-box" id="parking" type="checkbox">
                    <label for="parking">주차</label>
                </div>
            </div>
        </div>
        <div>
            <p class="text-box">가격</p>
            <div class="filter-group">
                <input class="number-input" type="number" max="30000000"> 
                <span class="span-span">~</span>
                <input class="number-input" type="number" max="30000000">
                <button class="btn-margin btn bg-navy header-bg-btn">검색</button>
            </div>
        </div>
  </div>

  <!-- 지도 div -->
  <div id="map"></div>
</template>

<script setup>
import { onMounted, reactive } from 'vue';
import env from '../../../js/env';

let map = reactive(null);

onMounted(() => {
    if (window.kakao && window.kakao.maps) {
        loadKakaoMap();
    } else {
        loadKakaoMapScript();
    }
});

// 카카오맵 스크립트 다운로드
const loadKakaoMapScript = () => {
    const script = document.createElement('script');
    script.src = `//dapi.kakao.com/v2/maps/sdk.js?appkey=${env.kakaoMapAppKey}&autoload=false&libraries=services`; // &autoload=false api를 로드한 후 맵을 그리는 함수가 실행되도록 구현
    script.onload = () => window.kakao.maps.load(loadKakaoMap); // 스크립트 로드가 끝나면 지도를 실행될 준비가 되어 있다면 지도가 실행되도록 구현

    document.head.appendChild(script); // html>head 안에 스크립트 소스를 추가
}

// 카카오맵 화면에 로드
const loadKakaoMap = () => {
    const container = document.getElementById("map"); 
    const options = {
        center: new window.kakao.maps.LatLng(35.879388797, 128.628366313), 
        level: 3
    };

    map = new window.kakao.maps.Map(container, options);
    console.log(map);
    // loadMaker();
}

// 카카오맵 마커 생성
const loadMaker = () => {
    // 주소-좌표 변환 객체를 생성합니다
    var geocoder = new window.kakao.maps.services.Geocoder();

    // 주소로 좌표를 검색합니다
    geocoder.addressSearch('대구 중구 동성로1길 15', function(result, status) {

        // console.log(result) // 주소 위도경도 콘솔로그
        // 정상적으로 검색이 완료됐으면 
        if (status === window.kakao.maps.services.Status.OK) {

            var coords = new window.kakao.maps.LatLng(result[0].y, result[0].x);

            // 결과값으로 받은 위치를 마커로 표시합니다
            var marker = new window.kakao.maps.Marker({
                map: map,
                position: coords
            });

            // 인포윈도우로 장소에 대한 설명을 표시합니다
            var infowindow = new window.kakao.maps.InfoWindow({
                content: '<div style="width:150px;text-align:center;padding:6px 0;">토요코인호텔 동성로점</div>'
            });
            infowindow.open(map, marker);

            // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
            map.setCenter(coords);
        } 
    });    
}
</script>

<style scoped>
.filter-price {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
    align-items: center;
    width: 100%;
    max-width: 1000px;
    height: auto;
    border: 2px solid #000000;
    border-radius: 20px;
    margin: 25px auto;
    padding: 10px;
    font-size: 20px;
}
.text-box {
    width: 80px;
    height: 30px;
    background-color: #01083a;
    text-align: center;
    color: #fff;
    border-radius: 10px;
    align-content: center;
    margin: 10px 0;
}

.filter-group {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.filter-group div {
    display: flex;
    align-items: center;
}

.input-box {
    margin: 0;
    width: 25px;
    height: 25px;
    border: 1px solid #000000;
    border-radius: 12.5px;
    appearance: none;
    vertical-align: middle;
}
.input-box:checked {
    background-color: #01083a;
}

label {
    margin-left: 10px;
    font-size: 18px;
    line-height: 25px; /* 라벨과 체크박스의 높이를 맞추기 위해 설정 */
}

#map {
    width: 100%;
    height: 800px;
    z-index: 1;  /* 헤더가 맵 위에 올 수 있도록 설정 */
}

/* 인풋박스 버튼 없애기 */
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
}
input::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.number-input {
    border: solid 1px #01083a;
    border-radius: 10px;
    padding: 5px 5px;
    width: 30%;
}
.span-span {
    margin: 0 5px;
}
.btn-margin {
    margin-left: 10px;
}

@media (max-width: 1000px) {
    #map {
        width: 80%;
        height: 400px;
        z-index: 1;  /* 헤더가 맵 위에 올 수 있도록 설정 */
        justify-self: center;
    }
}
</style>