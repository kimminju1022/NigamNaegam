<template>
    <div class="container">
        <div v-if="productDetail.title === null">
            <div class="detail-title">
                <p>한국관광공사에 의해 삭제된 데이터 입니다.</p>
            </div>
            <button @click="$router.replace('/products/' + productDetail.contenttypeid)" class="btn bg-navy btn-go-back"><- 리스트 페이지로 돌아가기</button>
        </div>
        <div v-else>
            <div class="detail-title">
                <p>{{ productDetail.title }}</p>
                <button @click="$router.replace('/products/' + productDetail.contenttypeid)" class="btn bg-clear btn-go-back">-> 리스트 페이지로 돌아가기</button>
                <!-- <p>3D 프린터 테라리움 원데이 클래스 (DIY 키트 배송 가능)</p> -->
            </div>
            <div>
                <div class="link-group">
                    <p class="detail-button-style">🚩{{ productDetail.addr1 + ' ' + productDetail.addr2 }}</p>
                    <a v-if="productDetail.homepage" :href="filterHomepage(productDetail.homepage)" class="detail-button-style" target="_blank">-> 홈페이지로 이동</a>
                </div>
                
                <div class="detail-img-map">
                    <div v-if="productImgCnt >= 4">
                        <div class="div-hell">
                            <div class="detail-img">
                                <img class="img-big" :src="productDetail.firstimage" alt="">
                                <div class="detail_img-right">
                                    <!-- <img class="img-middle" :src="productImg[0] === undefined ? '/default/board_default.png' : productImg[0]" :class="{'img-contain':productImg[0] === undefined}" alt="">
                                    <img class="img-middle" :src="productImg[1] === undefined ? '/default/board_default.png' : productImg[1]" :class="{'img-contain':productImg[1] === undefined}" alt=""> -->
                                    <img class="img-middle" :src="productImg[0]" alt="">
                                    <img class="img-middle" :src="productImg[1]" alt="">
                                </div>
                            </div>
                            <div class="detail-five">
                                <!-- <img class="img-small" :src="productImg[2] === undefined ? '/default/board_default.png' : productImg[2]" :class="{'img-contain':productImg[2] === undefined}" alt="">
                                <img class="img-small" :src="productImg[3] === undefined ? '/default/board_default.png' : productImg[3]" :class="{'img-contain':productImg[3] === undefined}" alt="">
                                <img class="img-small" :src="productImg[4] === undefined ? '/default/board_default.png' : productImg[4]" :class="{'img-contain':productImg[4] === undefined}" alt="">
                                <img class="img-small" :src="productImg[5] === undefined ? '/default/board_default.png' : productImg[5]" :class="{'img-contain':productImg[5] === undefined}" alt=""> -->
                                <img class="img-small" :src="productImg[2]" alt="">
                                <img class="img-small" :src="productImg[3]" alt="">
                            </div>
                        </div>
                    </div>
                    <div v-else-if="productImgCnt >= 2">
                        <div class="div-hell">
                            <div class="detail-img">
                                <img class="img-big img-three" :src="productDetail.firstimage" alt="">
                                <div class="detail_img-right img-three-right">
                                    <img class="img-middle" :src="productImg[0]" alt="">
                                    <img class="img-middle" :src="productImg[1]" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <!-- <div class="div-hell">
                            <div class="detail-img"> -->
                                <img class="img-one" :src="productDetail.firstimage" alt="">
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                    <div>
                        <div id="map"></div>
                    </div>
                </div>
                
                <div class="detail-content">
                    <p class="detail-content-content">{{ productDetail.overview }}</p>
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

// 상품 상세
const productImg = computed(() => store.state.product.productImg);
const productImgCnt = computed(() => store.state.product.productImgCount);
const productDetail = computed(() => store.state.product.productDetail);
const productLat = computed(() => store.state.product.productLat);
const productLng = computed(() => store.state.product.productLng);

// 상품 컨텐츠타입id랑 컨텐츠id
const findData = reactive({
    contenttypeid: route.params.contenttypeid,
    contentid: route.params.contentid,
});

onBeforeMount(async () => {
    await store.dispatch('product/takeProductDetail', findData);
});

const map = ref(null); // 지도 객체를 저장

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
            loadKakaoMapScript();
        }
    });
});

const loadKakaoMap = async () => {
    const container = document.getElementById("map");
    if (container && productLat.value && productLng.value) {
        const options = {
            center: new window.kakao.maps.LatLng(productLat.value, productLng.value),
            level: 5,
        };
        map.value = new window.kakao.maps.Map(container, options);
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
        window.kakao.maps.load(() => {
            loadKakaoMap();
        });
    }
};

// 값 변경 감지
watch([productLat, productLng], ([newLat, newLng]) => {
    if (newLat && newLng) {
        loadKakaoMap(); // 값이 변경되면 지도 로드
    } else {
        console.log("Lat or Lng is still null.");
    }
});

// 카카오맵 마커 생성
const loadMaker = () => {
    if(map.value) {
        const markerPosition = new window.kakao.maps.LatLng(productLat.value, productLng.value);
        const markerTitle = productDetail.value.title;
        const content = '<div style="width: 150px"><p style="text-align: center">' + markerTitle + '</p></div>';

        const marker = new window.kakao.maps.Marker({
            position: markerPosition
        });

        marker.setMap(map.value);

        const infowindow = new window.kakao.maps.InfoWindow({
            position: markerPosition,
            content: content
        });

        infowindow.open(map.value, marker);
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
    /* height: 30px;
    padding: 0 10px; */
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
/* 이미지 5개 */
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
    /* width: 190px; */
    /* height: 100px; */
    width: 400px;
    height: 130px;
    background-repeat: no-repeat;
    object-fit: cover;
}
/* 기본 이미지 설정
/* 이제 no image는 없음 */
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