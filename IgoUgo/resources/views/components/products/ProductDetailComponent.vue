<template>
    <div class="container">
        <div class="detail-title">
            <p>3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p>
        </div>
        <div>
            <div class="detail-button">
                <button class="detail-button-style">🚩메이커 하우스 리움</button> 
                <button class="detail-button-style">예약페이지로 이동</button>
            </div>

            <div class="detail-img-map">
                <div class="div-hell">
                    <div class="detail-img">
                        <img class="img-big" src="/test.png" alt="">
                        <div class="detail_img-right">
                            <img class="img-middle" src="/test.png" alt="">
                            <img class="img-middle" src="/test.png" alt="">
                        </div>
                    </div>
                    <div class="detail-five">
                        <img class="img-small" src="/test.png" alt="">
                        <img class="img-small" src="/test.png" alt="">
                        <img class="img-small" src="/test.png" alt="">
                        <img class="img-small" src="/test.png" alt="">
                    </div>
                </div>
                <div>
                    <div id="map"></div>
                </div>
            </div>    

            <!-- <div class="detail-option">
                <p>편의시설</p>
                <div class="detail-option-emoticon"></div>
            </div> -->

            <div class="detail-content">
                <p class="detail-content-content">이 편지는 영국에서 최초로 시작되어 일년에 한바퀴를 돌면서 받는 사람에게 행운을 주었고 지금은 당신에게로 옮겨진 이 편지는 4일 안에 당신 곁을 떠나야 합니다. 이 편지를 포함해서 7통을 행운이 필요한 사람에게 보내 주셔야 합니다. 복사를 해도 좋습니다. 혹 미신이라 하실지 모르지만 사실입니다. 영국에서 HGXWCH이라는 사람은 1930년에 이 편지를 받았습니다. 그는 비서에게 복사해서 보내라고 했습니다. 며칠 뒤에 복권이 당첨되어 20억을 받았습니다. 어떤 이는 이 편지를 받았으나 96시간 이내 자신의 손에서 떠나야 한다는 사실을 잊었습니다. 그는 곧 사직되었습니다. 나중에야 이 사실을 알고 7통의 편지를 보냈는데 다시 좋은 직장을 얻었습니다. 미국의 케네디 대통령은 이 편지를 받았지만 그냥 버렸습니다. 결국 9일 후 그는 암살당했습니다. 기억해 주세요. 이 편지를 보내면 7년의 행운이 있을 것이고 그렇지 않으면 3년의 불행이 있을 것입니다. 그리고 이 편지를 버리거나 낙서를 해서는 절대로 안됩니다. 7통입니다. 이 편지를 받은 사람은 행운이 깃들 것입니다. 힘들겠지만 좋은 게 좋다고 생각하세요. 7년의 행운을 빌면서...</p>
            </div>
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
        // draggable: false,
        level: 5
    };

    map = new window.kakao.maps.Map(container, options);
    console.log(map);
    loadMaker();
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
// // 버튼 클릭에 따라 지도 이동 기능을 막거나 풀고 싶은 경우에는 map.setDraggable 함수를 사용합니다
// function setDraggable(draggable) {
//     // 마우스 드래그로 지도 이동 가능여부를 설정합니다
//     map.setDraggable(draggable);    
// }
</script>

<style scoped>
/* 타이틀 */
.detail-title {
    font-size: 40px;
}
/* 버튼 영역 */
.detail-button {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    margin-bottom: 30px;
}
.detail-button-style {
    border-style: none;
    background-color: transparent;
    font-size: 20px;
}
/* 이미지 영역 */
.detail-img {
    display: grid;
    grid-template-columns: 550px 250px;
    gap: 20px;
}
/* 이미지 크거 영역 */
.div-hell {
    display: grid;
    grid-row: 320px 100px;
    gap: 20px;
}
.detail-img-map {
    display: grid;
    grid-template-columns: 820px 330px;
    justify-content: center;
    gap: 50px;
}
.detail_img-right {
    display: grid;
    grid-template-rows: 150px 150px;
    gap: 20px;
}
.img-big {
    width: 550px;
    height: 320px;
    background-repeat: no-repeat;
    object-fit: cover;
}
.img-middle {
    width: 250px;
    height: 150px;
    background-repeat: no-repeat;
    object-fit: cover;
}
.img-small {
    width: 190px;
    height: 100px;
    background-repeat: no-repeat;
    object-fit: cover;
}
.detail-five {
    display: flex;
    gap: 20px;
}
/* 지도지도 */
#map {
    width: 330px;
    height: 440px;
}
/* 디테일 옵션 영역 */
.detail-option {
    margin-top: 20px;
    font-size: 20px;
}
.detail-option-emoticon {
    border: solid 2px;
    height: 70px;
    width: 100%;
}
/* 컨텐츠 영역 */
.detail-content {
    margin-top: 20px;
    font-size: 18px;
}
.detail-content-content {
    line-height: 30px;
}

@media (max-width: 1000px) {
    .detail-title {
        font-size: 24px;
    }
    .detail-img {
        grid-template-columns: 1fr;
    }

    .img-big {
        width: 100%;
        height: auto;
    }

    .detail_img-right {
        grid-template-rows: repeat(2, 1fr);
        gap: 20px;
    }

    .img-middle {
        width: 100%;
        height: auto;
    }

    .detail-five {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .img-small {
        width: 45%;
        height: auto;
    }

    /* 지도 반응형 */
    .detail-img-map {
        display: block; /* 지도는 사진 밑으로 내려가야 하므로 block 처리 */
    }

    #map {
        width: 100%;
        height: 300px; /* 화면 크기에 맞게 지도 크기 조정 */
        margin-top: 20px;
    }
}
</style>