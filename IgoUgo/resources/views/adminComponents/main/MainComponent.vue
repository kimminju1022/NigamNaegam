<template>
    <div class="mainpage-container">
        <div>
            <p class="main-title">메인 페이지</p>
        </div>
        <div class="main-content-container">
            <div>
                <p class="main-stat-title">가입 현황</p>
                <div class="main-stat-box">
                    <Bar ref="signInfoChart" :data="chartDataSignInfo" :options="chartOptions" />
                </div>
            </div>
            <div>
                <p class="main-stat-title">탈퇴 현황</p>
                <div class="main-stat-box">
                    <Bar ref="withdrawInfoChart" :data="chartDataWithdrawInfo" :options="chartOptions" />
                </div>
            </div>
            <div>
                <p class="main-stat-title">리뷰 게시판</p>
                <div class="main-stat-box">
                    <Bar ref="reviewInfoChart" :data="chartDataReviewInfo" :options="chartOptions" />
                </div>
            </div>
            <div>
                <p class="main-stat-title">자유 게시판</p>
                <div class="main-stat-box">
                    <Bar ref="freeInfoChart" :data="chartDataFreeInfo" :options="chartOptions" />
                </div>
            </div>
            <div>
                <p class="main-stat-title">문의 게시판 - 답변 대기</p>
                <div class="main-stat-box">
                    <Bar ref="questionYetInfoChart" :data="chartDataQuestionYetInfo" :options="chartOptions" />
                </div>
            </div>
            <div>
                <p class="main-stat-title">문의 게시판 - 답변 완료</p>
                <div class="main-stat-box">
                    <Bar ref="questionDoneInfoChart" :data="chartDataQuestionDoneInfo" :options="chartOptions" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { computed, onBeforeMount, reactive, ref } from 'vue'
import { useStore } from 'vuex';

const store = useStore();

const signInfoChart = ref(null)
const withdrawInfoChart = ref(null)
const reviewInfoChart = ref(null)
const freeInfoChart = ref(null)
const questionYetInfoChart = ref(null)
const questionDoneInfoChart = ref(null)

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const chartDataSignInfo = reactive({
    labels: ['', '', '', '', ''],
    datasets: [
        {
            label: '일일 가입자',
            data: [0, 0, 0, 0, 0],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }
    ]
});

const chartDataWithdrawInfo = reactive({
    labels: ['', '', '', '', ''],
    datasets: [
        {
            label: '일일 탈퇴자',
            data: [0, 0, 0, 0, 0],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }
    ]
});

const chartDataReviewInfo = reactive({
    labels: ['', '', '', '', ''],
    datasets: [
        {
            label: '일일 리뷰게시글',
            data: [0, 0, 0, 0, 0],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }
    ]
});

const chartDataFreeInfo = reactive({
    labels: ['', '', '', '', ''],
    datasets: [
        {
            label: '일일 자유게시글',
            data: [0, 0, 0, 0, 0],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }
    ]
});

const chartDataQuestionYetInfo = reactive({
    labels: ['', '', '', '', ''],
    datasets: [
        {
            label: '일일 문의 답변 대기',
            data: [0, 0, 0, 0, 0],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }
    ]
});

const chartDataQuestionDoneInfo = reactive({
    labels: ['', '', '', '', ''],
    datasets: [
        {
            label: '일일 문의 답변 완료',
            data: [0, 0, 0, 0, 0],
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }
    ]
});

const chartOptions = computed(() => {
    return {
        responsive: true,
        maintainAspectRatio :false,
    };
});

onBeforeMount(() => {
    // console.log('비포마운트');
    Promise.all([
        store.dispatch('chart/dailyUser'),
        store.dispatch('chart/dailyDeleteUser'),
        store.dispatch('chart/dailyReview'),
        store.dispatch('chart/dailyFree'),
        store.dispatch('chart/dailyQuestionYet'),
        store.dispatch('chart/dailyQuestionDone'),
    ])
    .then(() => {
        // console.log('store.disaptch 성공');
        dailyUser();
        dailyDeleteUser();
        dailyReview();
        dailyFree();
        dailyQuestionYet();
        dailyQuestionDone();
    })
    .catch(() => {
        alert('에러가 발생했습니다.');
    });
});

const dailyUser = async() => {
    chartDataSignInfo.datasets[0].data.forEach((value, key) => {
        chartDataSignInfo.datasets[0].data[key] = store.state.chart.dailyUser[key].cnt;
    });
    chartDataSignInfo.labels.forEach((value, key) => {
        chartDataSignInfo.labels[key] = store.state.chart.dailyUser[key].day;
    });
    signInfoChart.value.chart.update();
};

const dailyDeleteUser = async() => {
    chartDataWithdrawInfo.datasets[0].data.forEach((value, key) => {
        chartDataWithdrawInfo.datasets[0].data[key] = store.state.chart.dailyDeleteUser[key].cnt;
    });
    chartDataWithdrawInfo.labels.forEach((value, key) => {
        chartDataWithdrawInfo.labels[key] = store.state.chart.dailyDeleteUser[key].day;
    });
    withdrawInfoChart.value.chart.update();
};

const dailyReview = async() => {
    chartDataReviewInfo.datasets[0].data.forEach((value, key) => {
        chartDataReviewInfo.datasets[0].data[key] = store.state.chart.dailyReview[key].cnt;
    });
    chartDataReviewInfo.labels.forEach((value, key) => {
        chartDataReviewInfo.labels[key] = store.state.chart.dailyReview[key].day;
    });
    reviewInfoChart.value.chart.update();
};

const dailyFree = async() => {
    chartDataFreeInfo.datasets[0].data.forEach((value, key) => {
        chartDataFreeInfo.datasets[0].data[key] = store.state.chart.dailyFree[key].cnt;
    });
    chartDataFreeInfo.labels.forEach((value, key) => {
        chartDataFreeInfo.labels[key] = store.state.chart.dailyFree[key].day;
    });
    freeInfoChart.value.chart.update();
};

const dailyQuestionYet = async() => {
    chartDataQuestionYetInfo.datasets[0].data.forEach((value, key) => {
        chartDataQuestionYetInfo.datasets[0].data[key] = store.state.chart.dailyQuestionYet[key].cnt;
    });
    chartDataQuestionYetInfo.labels.forEach((value, key) => {
        chartDataQuestionYetInfo.labels[key] = store.state.chart.dailyQuestionYet[key].day;
    });
    questionYetInfoChart.value.chart.update();
};

const dailyQuestionDone = async() => {
    chartDataQuestionDoneInfo.datasets[0].data.forEach((value, key) => {
        chartDataQuestionDoneInfo.datasets[0].data[key] = store.state.chart.dailyQuestionDone[key].cnt;
    });
    chartDataQuestionDoneInfo.labels.forEach((value, key) => {
        chartDataQuestionDoneInfo.labels[key] = store.state.chart.dailyQuestionDone[key].day;
    });
    questionDoneInfoChart.value.chart.update();
};
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
    width: 420px;
    height: 350px;
    background-color: white;
    padding: 10px;
}

</style>