<template>
<!-- **************************  1  ************************************ -->
<!-- <div class="card-body">
    <div class="tab-content p-0">
        <div class="chart tab-pane">
            <Line :data="data" :options="option" />
        </div>
        <div class="chart tab-pane">
            <Bar :data="data" :options="option" />
        </div>
    </div>
</div> -->

<!-- **************************  2  ************************************ -->
<!-- <div style="width: 800px;"><canvas id="acquisitions"></canvas></div> -->

<!-- **************************  3  ************************************ -->
<Bar ref="myChart" :data="chartData" :options="chartOptions" />

<button @click="test">ttttt</button>
</template>

<script setup>
// DataPage.vue
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

// Chart.js 설정 등록
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

// chartData와 chartOptions를 reactive하게 설정
import { computed, reactive, ref } from 'vue'
const myChart = ref(null)

const chartData = reactive({
    labels: ['Label 1', 'Label 2', 'Label 3', 'Label 4'], // 각 바의 레이블
    datasets: [
        {
            label: 'My Dataset',
            data: [10,20,30,40], // 각 바의 값
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // 바의 배경 색상
            borderColor: 'rgba(75, 192, 192, 1)', // 바의 테두리 색상
            borderWidth: 1 // 테두리 두께
        }
    ]
});

const chartOptions = computed(() => {
    return {
        responsive: true
    };
});

const test = async () => {
    const test = await [90,80,70,60];
    const test1 = ['a', 'b', 'c', 'd'];
    chartData.datasets[0].data.forEach((value, key) => {
        console.log(key);
        chartData.datasets[0].data[key] = test.users.data[key];
    });
    chartData.labels.forEach((value, key) => {
        console.log(key);
        chartData.labels[key] = test1.users.lavels[key];
    });
    myChart.value.chart.update();
};
// **************************  1  ************************************
// import { Line, Bar } from 'vue-chartjs';
// import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement, LineElement, PointElement, CategoryScale, LinearScale, BarElement } from 'chart.js';
// import { computed, ref } from 'vue';

// ChartJS.register(Title, Tooltip, Legend, ArcElement, LineElement, PointElement, CategoryScale, LinearScale, BarElement);

// const xData = ref([]);
// const yData = ref([]);

// const getData = function () {
// 	const xArr = [];
// 	const yArr = [];

// 	axios.get('your request URL')
// 	.then(function (response) {
//         if (response !== undefined) {
// 			for (let i = 0; i < response.data.length; i++) {
// 				const obj = response.data[i];
// 				xArr.push(obj.x);
// 				yArr.push(obj.y);
// 			}
// 			xData.value = xArr;
// 			yData.value = yArr;
// 		}
// 	})
// 	.catch(function (error) {
// 		console.log(error);
// 	});
// };

// const data = computed(function () { 
// 	return {
// 		labels: xData.value,
// 		datasets: [
// 			{
// 				label: 'labal data',
// 				borderWidth: 1,
// 				borderColor: 'your favorite color',
// 				backgroundColor: 'your favorite color',
// 				data: yData.value
// 			}
// 		]
// 	}
// });
// const option = {
// 	responsive: true,
// 	maintainAspectRatio: false,
// };


// **************************  2  ************************************

// import Chart from 'chart.js/auto'

// (async function() {
//     const data = [
//         { year: 2010, count: 10 },
//         { year: 2011, count: 20 },
//         { year: 2012, count: 15 },
//         { year: 2013, count: 25 },
//         { year: 2014, count: 22 },
//         { year: 2015, count: 30 },
//         { year: 2016, count: 28 },
//     ];

//     // const now = new Date();

//     // const date = String(now.getDate() + 1).padStart(2, '0');

//     // const data = [
//     //     { day: date, count: 10 },
//     //     { day: date, count: 20 },
//     //     { day: date, count: 15 },
//     //     { day: date, count: 25 },
//     //     { day: date, count: 22 },
//     //     { day: date, count: 30 },
//     //     { day: date, count: 28 },
//     // ];

//     new Chart(
//         document.getElementById('acquisitions').getContext('2d'),
//         {
//         type: 'line',
//         data: {
//             labels: data.map(row => row.year),
//             datasets: [
//             {
//                 label: 'Acquisitions by year',
//                 data: data.map(row => row.count)
//             }
//             ]
//         }
//         }
//     );
// })();
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