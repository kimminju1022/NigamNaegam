<template>
    <div class="container">
        <div id="map"></div>
    </div>
</template>

<script setup>
import { computed, nextTick, onBeforeMount, onMounted, reactive, ref, watch } from 'vue';
import env from '../../../js/env';
import { useStore } from 'vuex'; 
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();

// const isMapReady = ref(false); // 지도 로딩 여부 상태
// let map = reactive(null);
const map = ref(null); // 지도 객체를 저장
// let map = null;

onMounted(() => {
    // DOM 렌더링 후에 Kakao 지도 로딩
    nextTick(() => {
        if (window.kakao && window.kakao.maps) {
            console.log("Kakao Maps is available.");
            loadKakaoMap();
        } else {
            // console.log("Kakao Maps is not yet available. Loading script...");
            loadKakaoMapScript();
        }
    });
});

// ***************************************
// 카카오 지도 api 사용
const loadKakaoMap = async () => {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude; // 위도
            const lon = position.coords.longitude; // 경도
            console.log(lat);
            console.log(lon);
            const container = document.getElementById("map");
            // console.log("Container:", container); // 확인용 로그
            if (container && lat && lon) {
                const options = {
                    center: new window.kakao.maps.LatLng(lat, lon),
                    level: 5,
                };
                map.value = new window.kakao.maps.Map(container, options);
                console.log("Map loaded successfully.");
                loadMaker();
            } else {
                console.error("Map cannot be loaded. Container is null or Lat/Lng is null.");
            }
        });
    } else {
        alert('Geolocation을 지원하지 않는 브라우저입니다.');
    }
};
// ***************************************

const loadKakaoMapScript = () => {
    if (!document.getElementById('kakao-map-script')) {
        const script = document.createElement('script');
        script.id = 'kakao-map-script';
        script.src = `//dapi.kakao.com/v2/maps/sdk.js?appkey=${env.kakaoMapAppKey}&autoload=false&libraries=services`;
        script.onload = () => {
            console.log("Kakao Map script loaded.");
            window.kakao.maps.load(() => {
                loadKakaoMap(); // 스크립트가 로드된 후 `loadKakaoMap` 실행
            });
        };
        document.head.appendChild(script);
    } else {
        // console.log("Kakao Map script already loaded.");
        window.kakao.maps.load(() => {
            loadKakaoMap();
        });
    }
};

// ***************************************
// 카카오 지도 api함수 사용
const loadMaker = () => {
    // 주소-좌표 변환 객체를 생성합니다
    // var geocoder = new window.kakao.maps.services.Geocoder();

    if(map.value) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude; // 위도
            const lon = position.coords.longitude; // 경도
            const markerPosition = new window.kakao.maps.LatLng(lat, lon);
            const markerTitle = '나 여기있음';
            const content = '<div style="width: 150px"><p style="text-align: center">' + markerTitle + '</p></div>';
    
            const marker = new window.kakao.maps.Marker({
                position: markerPosition
            });
    
            marker.setMap(map.value);
    
            const infowindow = new window.kakao.maps.InfoWindow({
                position: markerPosition,
                content: content
                // content: markerTitle
            });
    
            infowindow.open(map.value, marker);
        });
    } else {
        console.log("no marker");
    }
}
// ***************************************
</script>

<style scoped>
/* 데이터가 없을 때 나오는 버튼 */
.btn-go-back {
    height: 30px;
    padding: 0 10px;
}

/* 타이틀 */
.detail-title {
    /* font-size: 40px; */
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.detail-title p {
    font-size: 40px;
}

/* 링크 영역 */
.link-group {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    margin-bottom: 30px;
}

/* 이미지&지도 영역 */
/* 큰 영역 */
.detail-img-map {
    display: grid;
    grid-template-columns: 820px 330px;
    justify-content: center;
    gap: 50px;
}
/* 이미지 크기기 영역 */
.div-hell {
    display: grid;
    grid-row: 320px 100px;
    gap: 20px;
}
/* 이미지 영역 */
.detail-img {
    display: grid;
    grid-template-columns: 550px 250px;
    gap: 20px;
}
/* 큰 이미지 */
.img-big {
    width: 550px;
    height: 320px;
    background-repeat: no-repeat;
    object-fit: cover;
}
/* 중간 이미지 영역 */
.detail_img-right {
    display: grid;
    grid-template-rows: 150px 150px;
    gap: 20px;
}
/* 중간 이미지 */
.img-middle {
    width: 250px;
    height: 150px;
    background-repeat: no-repeat;
    object-fit: cover;
}
/* 작은 이미지 영역 */
.detail-five {
    display: flex;
    gap: 20px;
}
/* 작은 이미지 */
.img-small {
    width: 190px;
    height: 100px;
    background-repeat: no-repeat;
    object-fit: cover;
}
/* 기본 이미지 설정 */
.img-contain {
    object-fit: contain;
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

a {
    color: #000;
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