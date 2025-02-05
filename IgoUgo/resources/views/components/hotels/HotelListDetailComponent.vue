<template>
    <div class="container">
        <div v-if="1 === 0">
            <div class="detail-title">
                <p>한국관광공사에 의해 삭제된 데이터 입니다.</p>
            </div>
            <button @click="$router.go(-1)" class="btn bg-navy btn-go-back"><- 리스트 페이지로 돌아가기</button>
        </div>
        <div v-else>
            <div class="detail-title">
                <p>{{ hotelDetail.title }}</p>
                <button @click="$router.go(-1)" class="btn bg-clear btn-go-back"><- 리스트 페이지로 돌아가기</button>
                <!-- <p>3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p> -->
            </div>
            <div>
                <div class="link-group">
                    <p class="detail-button-style">🚩{{ hotelDetail.addr1 + ' ' + hotelDetail.addr2 }}</p>
                    <a v-if="hotelDetail.homepage" :href="filterHomepage(hotelDetail.homepage)" class="detail-button-style" target="_blank">-> 홈페이지로 이동</a>
                     <!-- {{ hotelDetail.homepage }} -->
                </div>
                
                <div class="detail-img-map">
                    <!-- <div class="div-hell">
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
                    </div> -->

                    <div v-if="hotelImgCnt >= 4">
                        <div class="div-hell">
                            <div class="detail-img">
                                <img class="img-big" :src="hotelDetail.firstimage" alt="">
                                <div class="detail_img-right">
                                    <!-- <img class="img-middle" :src="hotelImg[0] === undefined ? '/default/board_default.png' : hotelImg[0]" :class="{'img-contain':hotelImg[0] === undefined}" alt="">
                                    <img class="img-middle" :src="hotelImg[1] === undefined ? '/default/board_default.png' : hotelImg[1]" :class="{'img-contain':hotelImg[1] === undefined}" alt=""> -->
                                    <img class="img-middle" :src="hotelImg[0]" alt="">
                                    <img class="img-middle" :src="hotelImg[1]" alt="">
                                </div>
                            </div>
                            <div class="detail-five">
                                <!-- <img class="img-small" :src="hotelImg[2] === undefined ? '/default/board_default.png' : hotelImg[2]" :class="{'img-contain':hotelImg[2] === undefined}" alt="">
                                <img class="img-small" :src="hotelImg[3] === undefined ? '/default/board_default.png' : hotelImg[3]" :class="{'img-contain':hotelImg[3] === undefined}" alt="">
                                <img class="img-small" :src="hotelImg[4] === undefined ? '/default/board_default.png' : hotelImg[4]" :class="{'img-contain':hotelImg[4] === undefined}" alt="">
                                <img class="img-small" :src="hotelImg[5] === undefined ? '/default/board_default.png' : hotelImg[5]" :class="{'img-contain':hotelImg[5] === undefined}" alt=""> -->
                                <img class="img-small" :src="hotelImg[2]" alt="">
                                <img class="img-small" :src="hotelImg[3]" alt="">
                            </div>
                        </div>
                    </div>
                    <div v-else-if="hotelImgCnt >= 2">
                        <div class="div-hell">
                            <div class="detail-img">
                                <img class="img-big img-three" :src="hotelDetail.firstimage" alt="">
                                <div class="detail_img-right img-three-right">
                                    <img class="img-middle" :src="hotelImg[0]" alt="">
                                    <img class="img-middle" :src="hotelImg[1]" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <!-- <div class="div-hell">
                            <div class="detail-img"> -->
                                <img class="img-one" :src="hotelDetail.firstimage" alt="">
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>

                    <div>
                        <div id="map"></div>
                    </div>
                </div>
                
                <div class="detail-content">
                    <div class="hotel-category-area">
                        <div v-for="item in hotelCategoryIncluded">
                            <div v-if="item.hc_code === '0'">
                                <div class="category-box"><img class="filter-icon" src="/img_product/swimmingpool.png">수영장</div>
                            </div>
                            <div v-else-if="item.hc_code === '1'">
                                <div class="category-box"><img class="filter-icon" src="/img_product/barbecue.png">바베큐장</div>
                            </div>
                            <div v-else-if="item.hc_code === '2'">
                                <div class="category-box"><img class="filter-icon" src="/img_product/campfire.png">캠프파이어</div>
                            </div>
                            <div v-else-if="item.hc_code === '3'">
                                <div class="category-box"><img class="filter-icon" src="/img_product/beauty.png">뷰티시설</div>
                            </div>
                            <div v-else-if="item.hc_code === '4'">
                                <div class="category-box"><img class="filter-icon" src="/img_product/fitness.png">피트니스센터</div>
                            </div>
                            <div v-else-if="item.hc_code === '5'">
                                <div class="category-box"><img class="filter-icon" src="/img_product/pickup.png">픽업서비스</div>
                            </div>
                        </div>
                    </div>
                    <p class="detail-content-content">{{ hotelDetail.overview }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, nextTick, onBeforeMount, onMounted, reactive, ref, watch } from 'vue';
import env from '../../../js/env';
import { useStore } from 'vuex'; 
import { useRoute } from 'vue-router';

const store = useStore();
const route = useRoute();

// 호텔 상세및 이미지
const hotelDetail = computed(() => store.state.hotel.hotelDetail);
const hotelImg = computed(() => store.state.hotel.hotelDetailImg);
const hotelImgCnt = computed(() => store.state.hotel.hotelDetailImgCount);
const hotelCategoryIncluded = computed(() => store.state.hotel.hotelCategoryIncluded);

// 상품 위도, 경도
const productLat = computed(() => store.state.hotel.hotelDetail.mapy)
const productLng = computed(() => store.state.hotel.hotelDetail.mapx)

// 호텔 컨텐츠id
const findData = reactive({
    contentid: route.params.contentid,
});

onBeforeMount(async () => {
    await store.dispatch('hotel/getHotelsDetail', findData);
    await store.dispatch('hotel/getHotelCategoryIncluded', findData);
});


// const map = ref(null); // 지도 객체를 저장
var map = null;

onMounted(() => {
    // DOM 렌더링 후에 Kakao 지도 로딩
    nextTick(() => {
        if (window.kakao && window.kakao.maps) {
            console.log("Kakao Maps is available.");
            if (productLat.value && productLng.value) {
                loadKakaoMap();
            } else {
                console.log("Lat or Lng is null during onMounted.");
            }
        } else {
            // console.log("Kakao Maps is not yet available. Loading script...");
            loadKakaoMapScript();
        }
    });
});

const loadKakaoMap = async () => {
    const container = document.getElementById("map");
    console.log("Container:", container); // 확인용 로그
    if (container && productLat.value && productLng.value) {
        const options = {
            center: new window.kakao.maps.LatLng(productLat.value, productLng.value),
            level: 5,
        };
        // map.value = new window.kakao.maps.Map(container, options);
        map = new window.kakao.maps.Map(container, options);
        console.log("Map loaded successfully.");
        loadMaker();
    } else {
        // console.error("Map cannot be loaded. Container is null or Lat/Lng is null.");
    }
};

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

// 값 변경 감지
watch([productLat, productLng], ([newLat, newLng]) => {
    if (newLat && newLng) {
        // console.log("Updated Lat:", newLat, "Updated Lng:", newLng);
        loadKakaoMap(); // 값이 변경되면 지도 로드
    } else {
        console.log("Lat or Lng is still null.");
    }
});

// 카카오맵 마커 생성
const loadMaker = () => {
    // 주소-좌표 변환 객체를 생성합니다

    if(map) {
        const markerPosition = new window.kakao.maps.LatLng(productLat.value, productLng.value);
        const markerTitle = hotelDetail.value.title;
        // var content = '<div style="background-color: white; padding: 5px;"><p>' + markerTitle + '</p></div>';
        var content = `
            <div style="
                position: relative;
                background: white;
                border: 1px solid black;
                padding: 10px;
                border-radius: 10px;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
                text-align: center;
                display: inline-block;
            ">
                <p style="font-size: 14px;">${markerTitle}</p>
                <div style="
                    content: '';
                    position: absolute;
                    bottom: -10px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 0;
                    height: 0;
                    border-left: 10px solid transparent;
                    border-right: 10px solid transparent;
                    border-top: 10px solid black;">
                </div>
                <div style="
                    content: '';
                    position: absolute;
                    bottom: -9px;
                    left: 50%;
                    transform: translateX(-50%);
                    width: 0;
                    height: 0;
                    border-left: 9px solid transparent;
                    border-right: 9px solid transparent;
                    border-top: 9px solid white;">
                </div>
            </div>
        `;

        const marker = new window.kakao.maps.Marker({
            position: markerPosition
        });

        marker.setMap(map);

        // const infowindow = new window.kakao.maps.InfoWindow({
        //     position: markerPosition,
        //     content: content
        // });

        // infowindow.open(map.value, marker);

        var mapCustomOverlay = new window.kakao.maps.CustomOverlay ({
            position: markerPosition,
            content: content,
            xAnchor: 0.5, // 커스텀 오버레이의 x축 위치입니다. 1에 가까울수록 왼쪽에 위치합니다. 기본값은 0.5 입니다
            yAnchor: 2.3 // 커스텀 오버레이의 y축 위치입니다. 1에 가까울수록 위쪽에 위치합니다. 기본값은 0.5 입니다
        });

        // 커스텀 오버레이를 지도에 표시
        mapCustomOverlay.setMap(map);
    } else {
        console.log("no marker");
    }
}

// 홈페이지 주소 필터
const filterHomepage = (url) => {
    // const totalUrl = url;
    const words = url.split('"');
    return words[1];
}
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
    /* margin-bottom: 30px; */
    margin-bottom: 50px;
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
/* 이미지 5개개 */
/* 큰 이미지 */
.img-big {
    width: 550px;
    /* height: 320px; */
    height: 290px;
    background-repeat: no-repeat;
    object-fit: cover;
}
/* 중간 이미지 영역 */
.detail_img-right {
    display: grid;
    /* grid-template-rows: 150px 150px; */
    grid-template-rows: 135px 135px;
    gap: 20px;
}
/* 중간 이미지 */
.img-middle {
    width: 250px;
    /* height: 150px; */
    height: 135px;
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
    /* width: 190px;
    height: 100px; */
    width: 400px;
    height: 130px;
    background-repeat: no-repeat;
    object-fit: cover;
}
/* 기본 이미지 설정 */
/* 이제 no image는 없음음 */
/* .img-contain {
    object-fit: contain;
} */
/* 이미지 3개 */
.img-three {
    height: 440px;
}
.img-three-right {
    grid-template-rows: 210px 210px;
}
.img-three-right > .img-middle {
    height: 210px;
}
/* 이미지 한 개 */
.img-one {
    width: 820px;
    height: 440px;
}

/* 지도지도 */
#map {
    width: 330px;
    height: 440px;
}

/* infowinow 디자인 */
.info {
    background-color: black;
}
.info > .info-style {
    display: block;
    background-color: black;
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
    margin-top: 50px;
    font-size: 18px;
}
.hotel-category-area {
    margin: 50px 0;
    display: grid;
    justify-items: center;
    grid-template-columns: repeat(6, 1fr);
}
.category-box {
    border: 1px solid #e7e7e7;
    border-radius: 10px;
    width: 200px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
}
.filter-icon {
    width: 35px;
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