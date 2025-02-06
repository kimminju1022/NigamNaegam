<template>
    <div class="total-container"> 
        <div>
            <div class="category-name">
                <span class="name-hotel">호텔</span>
            </div>
            <div class="right-small-container select-result-box">
                <h2><span class="font-blue">{{ $store.state.hotel.count }}</span> 개의 결과</h2>
                <div class="select-list font-default-size" :class="{'dis-none':flg}">
                    <div v-for="code in searchData.area_code" :key="code" class="select-list-item">
                        <p>{{ getAreaNameWithAreaCode(code) }}</p>
                        <img src="img_product/img_x.png" @click="closeFilter(code)" class="img-x">
                    </div>
                    <div v-for="type in searchData.hc_code" :key="type" class="select-list-item">
                        <p>{{ getHcNameWithHcType(type) }}</p>
                        <img src="img_product/img_x.png" @click="closeFilter(type)" class="img-x">
                    </div>
                </div>
            </div>
            <div class="order-box font-default-size">
                
                <div class="order-box-first">
                    <div>
                        <span class="font-bold">정렬 순서</span>
                    </div>
                    <p>|</p>
                    <div @click="nearBy()" class="order-list-item">
                        <p :class="{ 'active-font-bold' : isActiveNearBy }">가까운순</p>
                        <img src="img_product/img_star.png" class="img-order">
                    </div>
                    <p>|</p>
                    <div @click="sortData()" class="order-list-item">
                        <p :class="{ 'active-font-bold': isActiveSort }">최신순</p>
                        <span class="order-list-item-update font-bold">NEW</span>
                    </div>
                    <p>|</p>
                    <div @click="highRanking()"class="order-list-item">
                        <p :class="{ 'active-font-bold': isActiveRanking}">별점순</p>
                        <img src="img_product/img_thumb.png" class="img-order">
                    </div>
                </div>
                <div class="order-box-last">
                    <div @click="openmodal" class="order-list-item">
                        <p class >필터</p>
                        <img src="img_product/img_filter.png" class="img-order">
                    </div>
                    <p>|</p>
                    <div @click="openmodalMap" class="order-list-item">
                        <img src="img_product/img_placeholder.png" class="img-map">
                        <p>지도 보기</p>
                    </div>
                </div>
            </div>

            <LoadingComponent v-if="loading" />

            <div v-else>
                <!-- <div v-else-if="error">{{ error }}</div> -->
                <div class="card-list">
                    <div v-for="item in hotels" :key="item" >
                        <router-link :to="route.path + '/' + item.contentid">
                            <div class="card">
                                <img :src="item.firstimage" @error="e => e.target.src='default/board_default.png'" class="img-card">
                                <p class="font-bold card-title">{{ item.title }}</p>
                            </div>
                        </router-link>
                    </div>
                </div>
                <!-- <div v-else>상품 데이터를 불러오는 중...</div> -->

                <!-- 페이지네이션 -->
            <PaginationComponent
                :actionName="actionName"
                :searchData="searchData"
                :currentPage="$store.state.pagination.currentPage"
                :lastPage="$store.state.pagination.lastPage"
                :viewPageNumber="$store.state.pagination.viewPageNumber"
            />
            </div>
        </div>
    </div> 

    <!-- 모달모달 -->
    <div v-if="isVisible" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-x-button">
                <img @click="closemodal" class="modal_x_img" src="/img_product/img_x.png" alt="">
            </div>
            <p class="modal-region-text1 font-bold">지역</p>

            <div class="modal-region">
                <div v-for="item in $store.state.hotel.hotelArea" :key="item">
                    <input 
                        v-model="searchData.area_code" 
                        :value="item.area_code" 
                        @change="updateFilters($event)"
                        class="modal-input" 
                        type="checkbox" 
                        :id="'input-' + item.area_code"
                    >
                    <!-- :checked="selectedArea === item.area_code" -->
                    <label :for="'input-' + item.area_code">{{ item.area_name }}</label>
                </div>
            </div>

            <p class="modal-region-text2 font-bold">편의시설</p>
            <div class="modal-region">
                <div v-for="item in $store.state.hotel.hotelCategory" :key="item">
                    <input
                        v-model="searchData.hc_code" 
                        :value="item.hc_code"
                        @change="updateFilters()" 
                        class="modal-input" 
                        type="checkbox" 
                        :id="'input2-' + item.hc_code"
                    >
                    <label :for="'input2-' + item.hc_code">{{ item.hc_name }}</label>
                </div>
            </div>
        </div>
    </div>

    <!-- 지도 모달 -->
    <div v-if="isVisibleMap" class="modal-overlay">
        <div class="modal-content-map">
            <img @click="closemodalMap" class="modal_x_img modal_x_img_position" src="/img_product/img_x.png" alt="">
            <div id="map"></div>
        </div>
    </div>
</template>
    
<script setup>
import { computed, onBeforeMount, onMounted, reactive, ref} from 'vue';
import { useStore } from 'vuex';
import { useRoute } from 'vue-router';
import PaginationComponent from '../PaginationComponent.vue';
import LoadingComponent from '../LoadingComponent.vue';
import env from '../../../js/env';

const store = useStore();
const route = useRoute();


// 호텔 리스트 관련
const hotels = computed(() => store.state.hotel.hotelList);
const loading = computed(() => store.state.loading.loading);
// const hotelAreaCode = computed(() => store.state.hotelAreaCode);
const actionName = 'hotel/getHotelsPagination';

// 필터 관련
let isActiveSort = ref(false);
let isActiveRanking = ref(false);
let isActiveNearBy = ref(false);

const searchData = reactive({
    page: store.state.pagination.currentPage,
    area_code: store.state.hotel.hotelAreaCode,
    hc_code: store.state.hotel.hotelCategoryCode,
    sort: store.state.hotel.hotelSort,
    category_code: [],
    latitude: null, // 위도
    longitude: null, // 경도 서울시청 으로 잡아두기
});

function sortData() {
    isActiveSort.value = !isActiveSort.value;
    if (isActiveSort.value === true) {
        isActiveRanking.value = false;
        isActiveNearBy.value = false;
    }
    if(isActiveSort.value) {
        searchData.sort = 'modifiedtime';
        store.commit('hotel/setHotelSort', 'modifiedtime');
    } else {
        searchData.sort = 'createdtime';
        store.commit('hotel/setHotelSort', 'createdtime');
    }
    store.dispatch('hotel/getHotelsPagination', searchData);
}

function highRanking() {
    isActiveRanking.value = !isActiveRanking.value
    if (isActiveRanking.value === true) {
        isActiveSort.value = false
        isActiveNearBy.value = false
        store.commit('hotel/setHotelSort', 'rank');
        store.dispatch('hotel/getHotelsRank', searchData);
    } else {
        searchData.sort = 'createdtime';
        store.commit('hotel/setHotelSort', 'createdtime');
        store.dispatch('hotel/getHotelsPagination', searchData);
    }
}

function nearBy() {
    isActiveNearBy.value = !isActiveNearBy.value;
    if (isActiveNearBy.value === true) {
        isActiveSort.value = false
        isActiveRanking.value = false
        store.commit('hotel/setHotelSort', 'nearby');
        store.dispatch('hotel/getHotelsNearBy', searchData);
    } else {
        searchData.sort = 'createdtime';
        store.commit('hotel/setHotelSort', 'createdtime');
        store.dispatch('hotel/getHotelsPagination', searchData);
    }
}

function getCurrentLocation() {
    return new Promise((resolve, reject) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
            (position) => {
                // 위치 정보가 성공적으로 가져오면
                searchData.latitude = position.coords.latitude;
                searchData.longitude = position.coords.longitude;
                // console.log(searchData.latitude);
                // console.log(searchData.longitude);
                resolve();
            },
            (error) => {
                // 위치 정보 가져오기 실패 시
                console.log('위치 정보를 가져오는 데 실패');
                console.error(error);
                reject();
            }
            );
        } else {
            console.log('이 브라우저는 지오로케이션을 지원하지 않음.');
            reject();
        }
    }); 
};

// 반응형
const flg = ref(false);
const flgSetup = () => {
    flg.value = window.innerWidth >= 1000 ? false : true;
}
onBeforeMount(async () => {
    await getCurrentLocation();
    store.commit('loading/setLoading', true);
    flgSetup(); // 리사이즈 이벤트
    // const saveAreaCode = store.state.hotel.hotelAreaCode;
    if(searchData.sort === 'createdtime' || searchData.sort === 'modifiedtime') {
        isActiveNearBy.value = false;
        isActiveRanking.value = false;
        store.dispatch(actionName, searchData);
    } else if(searchData.sort === 'rank') {
        isActiveNearBy.value = false;
        isActiveSort.value = false;
        store.dispatch('hotel/getHotelsRank', searchData);
    } else if(searchData.sort === 'nearby') {
        isActiveSort.value = false;
        isActiveRanking.value = false;
        store.dispatch('hotel/getHotelsNearBy', searchData);
    }

    await store.dispatch('hotel/getHotelsArea', searchData);
    await store.dispatch('hotel/getHotelsCategory', searchData);
    await store.dispatch('hotel/getHotelAreaCode', searchData);
    await store.dispatch('hotel/getHotelCategoryCode', searchData);

    store.commit('loading/setLoading', false);
});

window.addEventListener('resize', flgSetup);

    
// 카테카테고리고리
// let selectedArea = null;

function updateFilters(e) {
    if(e && searchData.area_code.length > 1) {
        searchData.area_code = [e.target.value];
    }
    searchData.page = 1;
    
    if (isActiveRanking.value === true) {
        store.dispatch('hotel/getHotelsRank', searchData);
    } else {
        store.dispatch('hotel/getHotelsPagination', searchData);
    }
    store.dispatch('hotel/getHotelsArea', searchData);
    store.dispatch('hotel/getHotelAreaCode', searchData);
    store.dispatch('hotel/getHotelCategoryCode', searchData);
    // console.log([e.target.value]);
}

function closeFilter(value) {
    searchData.area_code = searchData.area_code.filter(
        (item) => item !== value
    );
    searchData.hc_code = searchData.hc_code.filter(
        (item) => item !== value
    )

    if (isActiveRanking.value === true) {
        store.dispatch('hotel/getHotelsRank', searchData);
    } else {
        store.dispatch('hotel/getHotelsPagination', searchData);
    }
    store.dispatch('hotel/getHotelAreaCode', searchData)
    store.dispatch('hotel/getHotelCategoryCode', searchData);
}

// function getAreaNameWithAreaCode(code) {
//     const areaList = store.state.hotel.hotelArea.filter((item) => item.area_code === code);
//     return areaList[0].area_name;
// }

// function getHcNameWithHcType(type) {
//     const HcList = store.state.hotel.hotelCategory.filter((item) => item.hc_code === type);
//     return HcList[0].hc_name;
// }

const areaList = computed(() => store.state.hotel.hotelArea);
const hcList = computed(() => store.state.hotel.hotelCategory);

function getAreaNameWithAreaCode(code) {
    const area = areaList.value.filter(item => item.area_code === code);
    return area.length > 0 ? area[0].area_name : '';  // 기본값 설정
}

function getHcNameWithHcType(type) {
    const hc = hcList.value.filter(item => item.hc_code === type);
    return hc.length > 0 ? hc[0].hc_name : ''; 
}

window.onbeforeunload = function() {
    // localStorage.clear();
};

// 모달모달
const isVisible = ref(false);

function openmodal() {
    isVisible.value = true;
}
    
function closemodal() {
    isVisible.value = false;
}

// 지도모달
const isVisibleMap = ref(false);
const latitude = ref(null);
const longitude = ref(null);
const hotelArea = ref([]);
const hotelCategory = ref([]);
const findHotel = reactive({});
const nearbyHotelList = computed(() => store.state.map.nearbyHotelList);

function openmodalMap() {
    isVisibleMap.value = true;
    hotelArea.value = JSON.parse(sessionStorage.getItem('hotelAreaCode')); // 지역 필터 localstorage에서 가져와서 배열에 저장
    hotelCategory.value = JSON.parse(sessionStorage.getItem('hotelCategoryCode')); // 카테고리 필터 localstorage에서 가져와서 배열에 저장
    findHotel.hc_code = hotelCategory.value; // 카테고리 필터 적용
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
        // 위치 권한 설정을 허용했을 때
        async (position) => {
            latitude.value = position.coords.latitude.toString(); // 위도
            longitude.value = position.coords.longitude.toString(); // 경도

            // 지역 필터 여부
            if(hotelArea.value.length === 0) {
                findHotel.area_code = null;
                // console.log('지역 필터 해제 시 초기화:', findHotel);

                // 지역 필터가 적용되지 않았을 때 -> 중심좌표 : 현재 위치
                findHotel.latitude = latitude.value;
                findHotel.longitude = longitude.value;
                // console.log(findHotel);
    
                // 현재 위치 전달
                await store.dispatch('map/takeNearbyHotels', findHotel);
    
                if (window.kakao && window.kakao.maps) {
                    // 스크립트가 이미 로드된 경우
                    await loadKakaoMap(findHotel.latitude, findHotel.longitude);
                } else {
                    // 스크립트를 로드한 후 지도를 로드
                    await loadKakaoMapScript();
                    await loadKakaoMap(findHotel.latitude, findHotel.longitude);
                }
            } else {
                // 지역 필터가 적용되었을 때 -> 중심좌표 : 해당 지역의 시청
                findHotel.area_code = hotelArea.value; // 지역 필터 적용
                // console.log('지역필터 적용:', findHotel);

                if (window.kakao && window.kakao.maps) {
                    // 스크립트가 이미 로드된 경우
                    const location = await keywordLocation(findHotel.area_code);
                    // console.log(location);

                    // 가져온 값으로 위도, 경도 재설정
                    findHotel.latitude = location.latitude;
                    findHotel.longitude = location.longitude;
                    
                    await store.dispatch('map/takeNearbyHotels', findHotel);
                    await loadKakaoMap(findHotel.latitude, findHotel.longitude);
                } else {
                    // 스크립트를 로드한 후 지도를 로드
                    await loadKakaoMapScript();
                    const location = await keywordLocation(findHotel.area_code);
                    // console.log('시청 주소 : ', location);

                    // 가져온 값으로 위도, 경도 재설정
                    findHotel.latitude = location.latitude;
                    findHotel.longitude = location.longitude;
                    
                    await store.dispatch('map/takeNearbyHotels', findHotel);
                    await loadKakaoMap(findHotel.latitude, findHotel.longitude);
                }
            }
        },

        // 위치 권한 설정을 허용하지 않았을 때(기본좌표는 서울특별시청)
        async () => {
            // alert('위치 권한을 허용하지 않았습니다. 기본 위치(서울특별시청)로 설정합니다.');
            
            // 기본 좌표: 서울특별시청
            latitude.value = 37.5665;
            longitude.value = 126.9780;
            // hotelArea.value = JSON.parse(localStorage.getItem('hotelAreaCode')); // 지역 필터 localstorage에서 가져와서 배열에 저장
            // hotelCategory.value = JSON.parse(localStorage.getItem('hotelCategoryCode')); // 카테고리 필터 localstorage에서 가져와서 배열에 저장

            // 지역 필터 여부
            if(hotelArea.value.length === 0) {
                findHotel.area_code = null;

                // 지역 필터가 적용되지 않았을 때 -> 중심좌표 : 서울특별시청
                findHotel.latitude = latitude.value;
                findHotel.longitude = longitude.value;
    
                // 현재 위치 전달
                await store.dispatch('map/takeNearbyHotels', findHotel);
    
                if (window.kakao && window.kakao.maps) {
                    // 스크립트가 이미 로드된 경우
                    await loadKakaoMap(findHotel.latitude, findHotel.longitude);
                } else {
                    // 스크립트를 로드한 후 지도를 로드
                    await loadKakaoMapScript();
                    await loadKakaoMap(findHotel.latitude, findHotel.longitude);
                }
            } else {
                // 지역 필터가 적용되었을 때 -> 중심좌표 : 해당 지역의 시청
                findHotel.area_code = hotelArea.value; // 지역 필터 적용
                // console.log('지역필터 적용:', findHotel);

                if (window.kakao && window.kakao.maps) {
                    // 스크립트가 이미 로드된 경우
                    const location = await keywordLocation(findHotel.area_code);
                    // console.log(location);

                    // 가져온 값으로 위도, 경도 재설정
                    findHotel.latitude = location.latitude;
                    findHotel.longitude = location.longitude;
                    
                    await store.dispatch('map/takeNearbyHotels', findHotel);
                    await loadKakaoMap(findHotel.latitude, findHotel.longitude);
                } else {
                    // 스크립트를 로드한 후 지도를 로드
                    await loadKakaoMapScript();
                    const location = await keywordLocation(findHotel.area_code);
                    // console.log('시청 주소 : ', location);

                    // 가져온 값으로 위도, 경도 재설정
                    findHotel.latitude = location.latitude;
                    findHotel.longitude = location.longitude;
                    
                    await store.dispatch('map/takeNearbyHotels', findHotel);
                    await loadKakaoMap(findHotel.latitude, findHotel.longitude);
                }
            }
        });
    } else {
        alert('Geolocation을 지원하지 않는 브라우저입니다.');
    }
}

function closemodalMap() {
    isVisibleMap.value = false;
}

// 지도
var map = '';
const markers = ref([]); // 마커 배열

// Debounce 함수 정의
const debounce = (func, delay) => {
    let timer;
    return (...args) => {
        if (timer) clearTimeout(timer); // 이전 타이머 취소
        timer = setTimeout(() => {
            func(...args); // 마지막 이벤트 실행
        }, delay);
    };
};

// 카카오맵 스크립트 다운로드
const loadKakaoMapScript = () => {
    return new Promise((resolve, reject) => {
        const existingScript = document.querySelector('script[src*="kakao.com"]');
        if (existingScript) {
            // 이미 로드된 스크립트가 있으면 바로 resolve
            resolve();
            return;
        }
        const script = document.createElement('script');
        script.src = `//dapi.kakao.com/v2/maps/sdk.js?appkey=${env.kakaoMapAppKey}&autoload=false&libraries=services`;
        script.onload = () => {
            window.kakao.maps.load(resolve); // 카카오맵 API 로드 후 resolve
        };
        script.onerror = () => {
            reject(new Error('Kakao map script load failed.'));
        };
        document.head.appendChild(script); // html>head 안에 스크립트 소스를 추가
    });
}

// 키워드 검색을 통해 위도, 경도 값 반환
const keywordLocation = async (areaCode) => {
    const areaNum = areaCode[0];
    // console.log('지역은? : ', areaNum);
    var areaName = '';
    switch(areaNum) {
        case '1': areaName = '서울특별시청'; break;
        case '2': areaName = '인천광역시청'; break;
        case '3': areaName = '대전광역시청'; break;        
        case '4': areaName = '대구광역시청'; break;
        case '5': areaName = '광주광역시청'; break;
        case '6': areaName = '부산광역시청'; break;
        case '7': areaName = '울산광역시청'; break;
        case '8': areaName = '세종특별자치시청'; break;
        case '31': areaName = '경기도청'; break;
        case '32': areaName = '강원특별자치도청'; break;
        case '33': areaName = '충청북도청'; break;
        case '34': areaName = '충청남도청'; break;
        case '35': areaName = '경상북도청'; break;
        case '36': areaName = '경상남도청'; break;
        case '37': areaName = '전북특별자치도청'; break;
        case '38': areaName = '전라남도청'; break;
        case '39': areaName = '제주특별자치도청'; break;
    }
    return new Promise((resolve, reject) => {
        var places = new window.kakao.maps.services.Places(); // 장소 검색 서비스 객체 생성
        places.keywordSearch(areaName, (result, status) => {
            if(status === window.kakao.maps.services.Status.OK) {
                var townHall = {
                    latitude: result[0].y,
                    longitude: result[0].x,
                };
                // console.log('townHall : ', townHall);
    
                resolve(townHall);
            } else {
                reject(new Error("Failed to fetch location")); // 에러 처리
            }
        });
    });
};

// 카카오맵 지도 - 현재위치 기준
const loadKakaoMap = async (Lat, Lon) => {
    // 키워드 검색 - 지역 선택시 해당 지역의 시청으로
    const container = document.getElementById("map");
    if (container && Lat && Lon) {
        const options = {
            center: new window.kakao.maps.LatLng(Lat, Lon),
            level: 6,
        };
        map = new window.kakao.maps.Map(container, options);
        console.log("Map loaded successfully.");

        loadMarker(nearbyHotelList.value);

        // Debounce를 적용한 중심좌표 변경 이벤트 핸들러
        const debouncedCenterChange = debounce(async () => {
            // const level = map.value.getLevel(); // 지도 레벨
            const center = map.getCenter(); // 지도 중심좌표

            findHotel.latitude = center.getLat().toString(); // 중심좌표의 위도
            findHotel.longitude = center.getLng().toString(); // 중심좌표의 경도

            // 새로운 중심좌표 기준으로 서버에 데이터 요청
            await store.dispatch('map/takeNearbyHotels', findHotel);
            
            // 새로운 마커 로드
            loadMarker(nearbyHotelList.value);
        }, 1000); // 1초 간격으로 실행

        // 지도가 이동, 확대, 축소로 인해 중심좌표가 변경되면 마지막 파라미터로 넘어온 함수를 호출하도록 이벤트를 등록
        window.kakao.maps.event.addListener(map, 'center_changed', debouncedCenterChange);
    } else {
        console.error("Map cannot be loaded. Container is null or Lat/Lng is null.");
    }
};

// 카카오맵 마커
const loadMarker = (placeList) => {
    if(!placeList || placeList.length === 0) {
        // console.log("No placeList to load.");
        return;
    }

    // 기존 마커 제거 -> 중심좌표 이동하기 전에
    clearMarkers();

    if(placeList || placeList.length !== 0) {
        // 새로운 마커 추가
        placeList.forEach(place => {
            const markerPosition = new window.kakao.maps.LatLng(place.mapy, place.mapx);
        
            const marker = new window.kakao.maps.Marker({
                map: map, // 마커를 표시할 지도
                position: markerPosition,
            });
            
            // 인포윈도우 생성
            // const infowindow = new window.kakao.maps.InfoWindow({
            //     content: `<div style="width: 150px"><p style="text-align: center">${place.title}</p></div>`,
            // });
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
                    <div style="font-size: 14px;">${place.title}</div>
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
            var infowindow = new window.kakao.maps.CustomOverlay ({
                position: markerPosition,
                content: content,
                xAnchor: 0.5, // 커스텀 오버레이의 x축 위치입니다. 1에 가까울수록 왼쪽에 위치합니다. 기본값은 0.5 입니다
                yAnchor: 2.3 // 커스텀 오버레이의 y축 위치입니다. 1에 가까울수록 위쪽에 위치합니다. 기본값은 0.5 입니다
            });
            // 마커에 마우스 이벤트 등록
            // window.kakao.maps.event.addListener(marker, "mouseover", showInfoWindow(map, marker, infowindow));
            window.kakao.maps.event.addListener(marker, "mouseover", showInfoWindow(map, infowindow));
            window.kakao.maps.event.addListener(marker, "mouseout", hideInfoWindow(infowindow));
            window.kakao.maps.event.addListener(marker, "click", () => window.open(`/hotels/${place.contentid}`));

            // 배열에 저장
            markers.value.push(marker);
        });
    }
}

// 마커 마우스오버 이벤트
const showInfoWindow = (map, infowindow) => {
    return function() {
        // infowindow.open(map, marker); // 인포윈도우를 현재 지도와 마커에 연결하여 열기
        // console.log("Infowindow DOM element:", infowindow); // 확인용
        infowindow.setMap(map); // 지도에 등록
        infowindow.setVisible(true); // 지도에서 보이게
    };
};

// 마커에 마우스아웃 이벤트 등록
const hideInfoWindow = (infowindow) => {
    return function() {
        // infowindow.close(); // 인포윈도우 닫기
        // console.log("Is infowindow open? ", infowindow); // 확인용
        infowindow.setVisible(false); // 지도에서 숨기기
    };
};

// 마커 제거
const clearMarkers = () => {
    // console.log('clearing....');
    markers.value.forEach((marker) => {
        marker.setMap(null); // 마커 지도에서 제거
    });
    markers.value = []; // 배열 초기화
}
</script>
    
<style scoped>
    .name-hotel {
        font-size: 50px;
    }
    .category-name {
        padding-bottom: 10px;
    }
    /* 선택 결과 관련 */
    .select-result-box {
        padding: 20px;
    }
    .select-list {
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
        display: flex;
        gap: 20px;
    }
    .select-list-item {
        display: flex;
        justify-content: space-between;
        max-width: 170px;
        border: 1px solid #01083A;
        border-radius: 20px;
        padding: 10px;
    }
    .active-font-bold {
        font-weight: 900;
    }
    
    /* 정렬 순서 관련 */
    .order-box {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }
    /* .order-list {
        display: flex;
        gap: 20px;
    } */
    .order-box-first {
        display: flex;
        gap: 20px;
    }
    .order-box-last {
        display: flex;
        gap: 20px;
    }
    .order-list-item {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    .order-list-item-update {
        color: #ff0000;
        font-size: 15px;
        margin-left: 5px;
    }
    
    /* 카드 관련 */
    .card-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        column-gap: 15px;
        row-gap: 40px;
        margin-top: 40px;
    }
    .card {
        height: 250px;
        width: 300px;
        border: 1px solid #e9e9e9;
        border-radius: 10px;
        display: grid;
        grid-template-rows: 185px 65px;
        margin: 0 auto;
        justify-items: center;
        /* 호버효과 css */
        position: relative;
        transition: 0.2s ease-in-out;
        /* flex: 1; */
    }
    /* 카드호버 */
    .card:hover {
        transform: translateY(-10px);
        cursor: pointer;
        box-shadow: 1px 1px 20px #ddd;
    }
    .card-title {
        width: 80%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: center;
        align-self: center;
    }
    .img-card {
        width: 100%;
        height: 185px;
        object-fit: cover;
        background-repeat: no-repeat;
        border-radius: 5px 5px 0px 0px;
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
    
    /* 기타 등등 */
    .img-x { 
        width: 12px;
        height: 12px;
        margin-left: 10px;
        align-self: center;
        cursor: pointer;
    }
    .img-order { 
        width: 20px;
        height: 20px;
        margin-left: 5px;
    }
    .img-map {
        width: 20px;
        height: 20px;
        margin-right: 5px;
    }
    /* 일단 얘는 나중에 글자 크기 조절 */
    .test {
        font-size: 5px;
    }
    
    /* --------------------------------- */
    /* 반응형 구현 */
    /* --------------------------------- */
    
    /* 사라짐 */
    .dis-none {
        display: none;
    }
    
    /* 지도 */
    .map-height {
        height: 150px;
    }
    
    /* 카테고리 */
    .cat-list-change {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
    }
    .cat-input-change {
        width: 16px;
        height: 16px;
    }
    .cat-list-item-change {
        font-size: 16px;
    }
    
    /* 가격 */
    .pri-box-change {
        display: flex;
        gap: 5px;
    }

    /* 모달모달 */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2;
    }
    .modal-content {
        width: 340px;
        background-color: white;
        padding: 20px 30px 40px 30px;
        border-radius: 10px;
    }
    .modal-region-text1 {
        font-size: 20px;
        padding-bottom: 30px;
    }
    .modal-region-text2 {
        font-size: 20px;
        padding: 30px 0;
    }
    .modal-region {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        row-gap: 15px;
    }
    .modal-input {
        margin-right: 5px;
    }
    .modal-x-button {
        display: flex;
        justify-content: flex-end;
    }
    .modal_x_img {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    /* 지도 모달모달 */
    .modal-content-map {
        display: grid;
        grid-template-rows: 40px 1fr;
        width: 1100px;
        height: 800px;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
    }
    .modal_x_img_position {
        justify-self: end;
    }
    
    /* 미디어쿼리 */
    @media (max-width: 1000px) {
        .total-container {
            display: flex;
            flex-direction: column;
            padding: 0;
        }
    }
</style>