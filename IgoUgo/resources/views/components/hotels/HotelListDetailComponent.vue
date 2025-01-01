<template>
    <div class="container">
        <div v-if="1 === 0">
            <div class="detail-title">
                <p>한국관광공사에 의해 삭제된 데이터 입니다.</p>
            </div>
            <button @click="$router.go(-1)" class="btn bg-navy btn-go-back"><- 리스트 페이지로 돌아가기</button>
        </div>
        <div v-else>
            <button @click="$router.go(-1)" class="btn bg-clear btn-go-back"><- 리스트 페이지로 돌아가기</button>
            <div class="detail-title">
                <p>{{ hotelDetail.title }}</p>
                <!-- <p>3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p> -->
            </div>
            <div>
                <div class="link-group">
                    <p class="detail-button-style">🚩{{ hotelDetail.addr1 + ' ' + hotelDetail.addr2 }}</p>
                    <a v-if="hotelDetail.homepage" :href="hotelDetail.homepage" class="detail-button-style" target="_blank">-> 홈페이지로 이동</a>
                     <!-- {{ hotelDetail.homepage }} -->
                </div>
                
                <div class="detail-img-map">
                    <div class="div-hell">
                        <div class="detail-img">
                            <img class="img-big" :src="hotelDetail.firstimage" alt="">
                            <div class="detail_img-right">
                                <img class="img-middle" :src="hotelImg[0] === undefined ? '/default/board_default.png' : hotelImg[0]" :class="{'img-contain':hotelImg[0] === undefined}" alt="">
                                <img class="img-middle" :src="hotelImg[1] === undefined ? '/default/board_default.png' : hotelImg[1]" :class="{'img-contain':hotelImg[1] === undefined}" alt="">
                            </div>
                        </div>
                        <div class="detail-five">
                            <img class="img-small" :src="hotelImg[2] === undefined ? '/default/board_default.png' : hotelImg[2]" :class="{'img-contain':hotelImg[2] === undefined}" alt="">
                            <img class="img-small" :src="hotelImg[3] === undefined ? '/default/board_default.png' : hotelImg[3]" :class="{'img-contain':hotelImg[3] === undefined}" alt="">
                            <img class="img-small" :src="hotelImg[4] === undefined ? '/default/board_default.png' : hotelImg[4]" :class="{'img-contain':hotelImg[4] === undefined}" alt="">
                            <img class="img-small" :src="hotelImg[5] === undefined ? '/default/board_default.png' : hotelImg[5]" :class="{'img-contain':hotelImg[5] === undefined}" alt="">
                        </div>
                    </div>
                    <div>
                        <div id="map"></div>
                    </div>
                </div>
                
                <div class="detail-content">
                    <p class="detail-content-content">{{ hotelDetail.overview }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onBeforeMount, onMounted, reactive, ref, watch } from 'vue';
import env from '../../../js/env';
import { useStore } from 'vuex'; 
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();

// 호텔 상세및 이미지
const hotelDetail = computed(() => store.state.hotel.hotelDetail);
const hotelImg = computed(() => store.state.hotel.hotelDetailImg);

// // 상품 위도, 경도
// const productLat = ref(null);
// const productLng = ref(null);

// 호텔 컨텐츠id
const findData = reactive({
    contentid: route.params.contentid,
});

onBeforeMount(async () => {
    await store.dispatch('hotel/getHotelsDetail', findData);
    // productLat.value = productDetail.value.mapx;
    // productLng.value = productDetail.value.mapy;
    // console.log(route.params.contentid);
});

// // let map = reactive(null);
// const isMapReady = ref(false); // 지도 로딩 여부 상태
// var map = ref(null); // 지도 객체를 저장

// onMounted(() => {
//     if (window.kakao && window.kakao.maps) {
//         if (productLat.value && productLng.value) {
//             loadKakaoMap();
//         }
//     } else {
//         loadKakaoMapScript();
//     }
// });

// // 카카오맵 스크립트 다운로드
// const loadKakaoMapScript = () => {
//     const script = document.createElement('script');
//     script.src = `//dapi.kakao.com/v2/maps/sdk.js?appkey=${env.kakaoMapAppKey}&autoload=false&libraries=services`; // &autoload=false api를 로드한 후 맵을 그리는 함수가 실행되도록 구현
//     // script.onload = () => window.kakao.maps.load(loadKakaoMap); // 스크립트 로드가 끝나면 지도를 실행될 준비가 되어 있다면 지도가 실행되도록 구현
//     script.onload = () => window.kakao.maps.load(() => {
//         if(productLat.value && productLng.value) {
//             loadKakaoMap();
//         }
//     });

//     document.head.appendChild(script); // html>head 안에 스크립트 소스를 추가
// }

// // 카카오맵 화면에 로드
// const loadKakaoMap = () => {
//     var container = document.getElementById("map");
//     console.log("Lat:", productLat.value, "Lng:", productLng.value);    
//     // #map 요소가 존재할 때만 지도를 초기화
//     if(container && productLat.value && productLng.value) {
//         var options = {
//             center: new window.kakao.maps.LatLng(productLat.value, productLng.value), 
//             // center: new window.kakao.maps.LatLng(35.879388797, 128.628366313), 
//             // draggable: false,
//             level: 5
//         };
//         map.value = new window.kakao.maps.Map(container, options);
//         isMapReady.value = true; // 지도 로드 완료
//         // loadMaker();
//     } else {
//         console.log("지도 데이터를 로드할 수 없습니다. productLat 또는 productLng가 null입니다.");
//     }
// };

// // 값 변경 감지
// watch([productLat, productLng], ([newLat, newLng]) => {
//     if (newLat && newLng) {
//         loadKakaoMap();
//     }
// });

// 카카오맵 마커 생성
// const loadMaker = () => {
//     if(map.value) {
//         const marker = {
//             position: new kakao.maps.LatLng(productLat, productLng),
//             text: productDetail.title
//         };

//         const mapOption = {
//             center: new kakao.maps.LatLng(productLat, productLng),
//             level: 3,
//             marker: marker
//         };

//         map.value = new kakao.maps.StaticMap(map, mapOption);


//         // // 주소-좌표 변환 객체를 생성합니다
//         // const geocoder = new window.kakao.maps.services.Geocoder();

//         // // 주소로 좌표를 검색합니다
//         // geocoder.addressSearch('대구 중구 동성로1길 15', function(result, status) {

//         //     // console.log(result) // 주소 위도경도 콘솔로그
//         //     // 정상적으로 검색이 완료됐으면 
//         //     if (status === window.kakao.maps.services.Status.OK) {

//         //         const coords = new window.kakao.maps.LatLng(result[0].y, result[0].x);

//         //         // 결과값으로 받은 위치를 마커로 표시합니다
//         //         const marker = new window.kakao.maps.Marker({
//         //             map: map.value,
//         //             position: coords
//         //         });

//         //         // 인포윈도우로 장소에 대한 설명을 표시합니다
//         //         const infowindow = new window.kakao.maps.InfoWindow({
//         //             content: '<div style="width:150px;text-align:center;padding:6px 0;">토요코인호텔 동성로점</div>'
//         //         });
//         //         infowindow.open(map.value, marker);

//         //         // 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
//         //         map.value.setCenter(coords);
//         //     } 
//         // });   
//     }
// }
// // 버튼 클릭에 따라 지도 이동 기능을 막거나 풀고 싶은 경우에는 map.setDraggable 함수를 사용합니다
// function setDraggable(draggable) {
//     // 마우스 드래그로 지도 이동 가능여부를 설정합니다
//     map.setDraggable(draggable);    
// }
</script>

<style scoped>
/* 데이터가 없을 때 나오는 버튼 */
.btn-go-back {
    padding: 10px;
    border-radius: 20px;
    margin: 50px 0;
}

/* 타이틀 */
.detail-title {
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