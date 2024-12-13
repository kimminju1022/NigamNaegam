<template>
<div>

  <div class="option-select">
    
  </div>
  <!-- 지도 div -->
  <div id="map">

  </div>

</div>
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


#map {
    width: 100%;
    height: 800px;
    z-index: 1;  /* 헤더가 맵 위에 올 수 있도록 설정 */
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