export default {
    namespaced: true,
    state: () => ({
        viewPageCnt: 5,
        path: localStorage.getItem('paginationPath') ? localStorage.getItem('paginationPath'): '',
        currentPage: localStorage.getItem('currentPage') ? localStorage.getItem('currentPage'): 1, // 현재 페이지
        lastPage: localStorage.getItem('lastPage') ? localStorage.getItem('lastPage'): 1, // 마지막 페이지
        viewPageNumber: localStorage.getItem('viewPageNumber') ? JSON.parse(localStorage.getItem('viewPageNumber')) : [],
    }),
    mutations: {
        setCurrentPage(state, page) {
            state.currentPage = page;
            localStorage.setItem('currentPage', page);
        },
        setPaginationInitialize(state) {
            state.currentPage = 1;
            state.lastPage = 1;
            state.path = '';
            state.viewPageNumber = [];
            localStorage.setItem('currentPage', 1);
            localStorage.setItem('lastPage', 1);
            localStorage.setItem('paginationPath', '');
            localStorage.setItem('viewPageNumber', JSON.stringify([]));
        },
        setPagination(state, paginationData) {
            state.currentPage = paginationData.current_page;
            state.lastPage = paginationData.last_page;
            state.path = paginationData.path;
            localStorage.setItem('currentPage', paginationData.current_page);
            localStorage.setItem('lastPage', paginationData.last_page);
            localStorage.setItem('paginationPath', paginationData.path);
            // 페이지 번호 출력 연산
            let offSet = Math.floor(state.viewPageCnt / 2); // 오프셋
            let startPageNumber = (state.currentPage - offSet) < 1 ? 1 : state.currentPage - offSet; // 시작 페이지 번호 초기화
            let endPageNumber = startPageNumber + (state.viewPageCnt - 1); // 마지막 페이지 번호 초기화
            // 엔드페이지 조절 (토탈 페이지보다 클 경우)
            if(endPageNumber > state.lastPage) {
                endPageNumber = state.lastPage;
            }
            // 스타트 페이지 조절(음수 안나오게 조절)
            if((endPageNumber - (state.viewPageCnt - 1)) > 1 && (startPageNumber > endPageNumber - (state.viewPageCnt - 1))) {
                startPageNumber = endPageNumber - (state.viewPageCnt - 1);
            }
            // 페이지 번호 배열 생성
            state.viewPageNumber = Array.from({ length: endPageNumber - startPageNumber + 1 }, (_, idx) => idx + startPageNumber);
            localStorage.setItem('viewPageNumber', JSON.stringify(state.viewPageNumber));
        },
    },
    actions: {
    },
    getters: {
    },
}