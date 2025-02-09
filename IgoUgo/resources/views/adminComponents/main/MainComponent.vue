<template>
    <div class="mainpage-container">
        <div>
            <p class="main-title">메인 페이지</p>
            <!-- <hr class="hr-style"> -->
        </div>
        <div class="main-content-container">
            <div>
                <p class="main-stat-title">가입 현황</p>
                <div style="width: 300px; height: 300px;"><canvas id="myChart"></canvas></div>
            </div>
            <div>
                <p class="main-stat-title">탈퇴 현황</p>
                <div class="main-stat-box"></div>
            </div>
            <div>
                <p class="main-stat-title">리뷰 게시판</p>
                <div class="main-stat-box"></div>
            </div>
            <div>
                <p class="main-stat-title">자유 게시판</p>
                <div class="main-stat-box"></div>
            </div>
            <div>
                <p class="main-stat-title">문의 게시판 - 답변 대기</p>
                <div class="main-stat-box"></div>
            </div>
            <div>
                <p class="main-stat-title">문의 게시판 - 답변 완료</p>
                <div class="main-stat-box"></div>
            </div>
        </div>
    </div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" defer></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script> -->
</template>

<script setup>
// const chartLoad = () => {
//     console.log('chartLoad 함수 실행');
//     if(!document.getElementById('myChart')) {
//         const script = document.createElement('script');
//         script.id = 'chart';
//         script.src = `/https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js`;
//         script.onload = () => {
//             console.log("chart 로드 성공");
//             // window.kakao.maps.load(() => {
//             //     myChart(); // 스크립트가 로드된 후 `loadKakaoMap` 실행
//             // });
//         };
//         document.head.appendChild(script);

//         myChart();
//     }
// };

async() => {
    const ctx = document.getElementById('myChart');
    const data = [
        { year: 2010, count: 10 },
        { year: 2011, count: 20 },
        { year: 2012, count: 15 },
        { year: 2013, count: 25 },
        { year: 2014, count: 22 },
        { year: 2015, count: 30 },
        { year: 2016, count: 28 },
    ];


    // Chart.js로 차트 생성
    new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
        }]
    },
    options: {
        scales: {
        y: {
            beginAtZero: true
        }
        }
    }
    });
};


// document.addEventListener("DOMContentLoaded", function() {
//     const ctx = document.getElementById('myChart');

//     // Chart.js로 차트 생성
//     new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//         datasets: [{
//         label: '# of Votes',
//         data: [12, 19, 3, 5, 2, 3],
//         borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//         y: {
//             beginAtZero: true
//         }
//         }
//     }
//     });
// });
</script>

<style scoped>
/* 메인페이지 큰 틀 */
.mainpage-container {
    height: 100%;
    display: grid;
    grid-template-rows: 50px 1fr;
    gap: 30px;
}

/* 메인 페이지 타이틀 */
.main-title {
    font-weight: 600;
    font-size: 30px;
    margin-left: 10px;
}

/* hr 스타일 */
.hr-style {
    width: 500px;
    margin-top: 5px;
}

/* 내용 컨테이너 */
.main-content-container {
    display: grid;
    grid-template-columns: repeat(3, minmax(300px, 1fr));
    gap: 30px;
}

/* 각 통계의 타이틀 */
.main-stat-title {
    font-size: 20px;
    margin-bottom: 10px;
}

/* 통계 넣을 박스 */
.main-stat-box {
    min-width: 300px;
    height: 350px;
    background-color: white;
}
</style>