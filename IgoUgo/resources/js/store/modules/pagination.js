export default {
    namespaced: true,
    state: () => ({
        viewPageCnt: 5,
        path: localStorage.getItem('paginationPath') ? localStorage.getItem('paginationPath'): '',
        currentPage: localStorage.getItem('currentPage') ? Number(localStorage.getItem('currentPage')): 1, // 현재 페이지
        lastPage: localStorage.getItem('lastPage') ? Number(localStorage.getItem('lastPage')): 1, // 마지막 페이지
        viewPageNumber: localStorage.getItem('viewPageNumber') ? JSON.parse(localStorage.getItem('viewPageNumber')) : [],

        // 여러 개의 페이지네이션
        // 검색
        hotelCurrentPage: localStorage.getItem('hotelCurrentPage') ? Number(localStorage.getItem('hotelCurrentPage')): 1, // hotel_현재 페이지
        hotelLastPage: localStorage.getItem('hotelLastPage') ? Number(localStorage.getItem('hotelLastPage')): 1, // hotel_마지막 페이지
        hotelViewPageNumber: localStorage.getItem('hotelViewPageNumber') ? JSON.parse(localStorage.getItem('hotelViewPageNumber')) : [],
        productCurrentPage: localStorage.getItem('productCurrentPage') ? Number(localStorage.getItem('productCurrentPage')): 1, // product_현재 페이지
        productLastPage: localStorage.getItem('productLastPage') ? Number(localStorage.getItem('productLastPage')): 1, // product_마지막 페이지
        productViewPageNumber: localStorage.getItem('productViewPageNumber') ? JSON.parse(localStorage.getItem('productViewPageNumber')) : [],
        boardCurrentPage: localStorage.getItem('boardCurrentPage') ? Number(localStorage.getItem('boardCurrentPage')): 1, // board_현재 페이지
        boardLastPage: localStorage.getItem('boardLastPage') ? Number(localStorage.getItem('boardLastPage')): 1, // board_마지막 페이지
        boardViewPageNumber: localStorage.getItem('boardViewPageNumber') ? JSON.parse(localStorage.getItem('boardViewPageNumber')) : [],
        testerCurrentPage: localStorage.getItem('testerCurrentPage') ? Number(localStorage.getItem('testerCurrentPage')): 1, // tester_현재 페이지
        testerLastPage: localStorage.getItem('testerLastPage') ? Number(localStorage.getItem('testerLastPage')): 1, // tester_마지막 페이지
        testerViewPageNumber: localStorage.getItem('testerViewPageNumber') ? JSON.parse(localStorage.getItem('testerViewPageNumber')) : [],
        // 마이페이지
        userBoardCurrentPage: localStorage.getItem('userBoardCurrentPage') ? Number(localStorage.getItem('userBoardCurrentPage')): 1, // userBoard_현재 페이지
        userBoardLastPage: localStorage.getItem('userBoardLastPage') ? Number(localStorage.getItem('userBoardLastPage')): 1, // userBoard_마지막 페이지
        userBoardViewPageNumber: localStorage.getItem('userBoardViewPageNumber') ? JSON.parse(localStorage.getItem('userBoardViewPageNumber')) : [],
        userQuestionCurrentPage: localStorage.getItem('userQuestionCurrentPage') ? Number(localStorage.getItem('userQuestionCurrentPage')): 1, // userQuestion_현재 페이지
        userQuestionLastPage: localStorage.getItem('userQuestionLastPage') ? Number(localStorage.getItem('userQuestionLastPage')): 1, // userQuestion_마지막 페이지
        userQuestionViewPageNumber: localStorage.getItem('userQuestionViewPageNumber') ? JSON.parse(localStorage.getItem('userQuestionViewPageNumber')) : [],
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

            // 여러 개의 페이지네이션
            // 검색
            state.hotelCurrentPage = 1;
            state.hotelLastPage = 1;
            state.hotelViewPageNumber = [];
            localStorage.setItem('hotelCurrentPage', 1);
            localStorage.setItem('hotelLastPage', 1);
            localStorage.setItem('hotelViewPageNumber', JSON.stringify([]));
            state.productCurrentPage = 1;
            state.productLastPage = 1;
            state.productViewPageNumber = [];
            localStorage.setItem('productCurrentPage', 1);
            localStorage.setItem('productLastPage', 1);
            localStorage.setItem('productViewPageNumber', JSON.stringify([]));
            state.boardCurrentPage = 1;
            state.boardLastPage = 1;
            state.boardViewPageNumber = [];
            localStorage.setItem('boardCurrentPage', 1);
            localStorage.setItem('boardLastPage', 1);
            localStorage.setItem('boardViewPageNumber', JSON.stringify([]));
            state.testerCurrentPage = 1;
            state.testerLastPage = 1;
            state.testerViewPageNumber = [];
            localStorage.setItem('testerCurrentPage', 1);
            localStorage.setItem('testerLastPage', 1);
            localStorage.setItem('testerViewPageNumber', JSON.stringify([]));
            // 마이페이지
            state.userBoardCurrentPage = 1;
            state.userBoardLastPage = 1;
            state.userBoardViewPageNumber = [];
            localStorage.setItem('userBoardCurrentPage', 1);
            localStorage.setItem('userBoardLastPage', 1);
            localStorage.setItem('userBoardViewPageNumber', JSON.stringify([]));
            state.userQuestionCurrentPage = 1;
            state.userQuestionLastPage = 1;
            state.userQuestionViewPageNumber = [];
            localStorage.setItem('userQuestionCurrentPage', 1);
            localStorage.setItem('userQuestionLastPage', 1);
            localStorage.setItem('userQuestionViewPageNumber', JSON.stringify([]));
            
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
        setPaginationRegulation(state, lastPage) {
            state.lastPage = lastPage;
            localStorage.setItem('lastPage', lastPage);
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

        // =========================================================================================
        // 페이지네이션 멀티

        // 검색 호텔
        setHotelPagination(state, paginationData) {
            state.hotelCurrentPage = paginationData.current_page;
            state.hotelLastPage = paginationData.last_page;
            state.path = paginationData.path;
            localStorage.setItem('hotelCurrentPage', paginationData.current_page);
            localStorage.setItem('hotelLastPage', paginationData.last_page);
            localStorage.setItem('paginationPath', paginationData.path);
            // 페이지 번호 출력 연산
            let offSet = Math.floor(state.viewPageCnt / 2); // 오프셋
            let startPageNumber = (state.hotelCurrentPage - offSet) < 1 ? 1 : state.hotelCurrentPage - offSet; // 시작 페이지 번호 초기화
            let endPageNumber = startPageNumber + (state.viewPageCnt - 1); // 마지막 페이지 번호 초기화
            // 엔드페이지 조절 (토탈 페이지보다 클 경우)
            if(endPageNumber > state.hotelLastPage) {
                endPageNumber = state.hotelLastPage;
            }
            // 스타트 페이지 조절(음수 안나오게 조절)
            if((endPageNumber - (state.viewPageCnt - 1)) > 1 && (startPageNumber > endPageNumber - (state.viewPageCnt - 1))) {
                startPageNumber = endPageNumber - (state.viewPageCnt - 1);
            }
            // 페이지 번호 배열 생성
            state.hotelViewPageNumber = Array.from({ length: endPageNumber - startPageNumber + 1 }, (_, idx) => idx + startPageNumber);
            localStorage.setItem('hotelViewPageNumber', JSON.stringify(state.hotelViewPageNumber));
        },

        // 검색 즐길거리
        setProductPagination(state, paginationData) {
            state.productCurrentPage = paginationData.current_page;
            state.productLastPage = paginationData.last_page;
            state.path = paginationData.path;
            localStorage.setItem('productCurrentPage', paginationData.current_page);
            localStorage.setItem('productLastPage', paginationData.last_page);
            localStorage.setItem('paginationPath', paginationData.path);
            // 페이지 번호 출력 연산
            let offSet = Math.floor(state.viewPageCnt / 2); // 오프셋
            let startPageNumber = (state.productCurrentPage - offSet) < 1 ? 1 : state.productCurrentPage - offSet; // 시작 페이지 번호 초기화
            let endPageNumber = startPageNumber + (state.viewPageCnt - 1); // 마지막 페이지 번호 초기화
            // 엔드페이지 조절 (토탈 페이지보다 클 경우)
            if(endPageNumber > state.productLastPage) {
                endPageNumber = state.productLastPage;
            }
            // 스타트 페이지 조절(음수 안나오게 조절)
            if((endPageNumber - (state.viewPageCnt - 1)) > 1 && (startPageNumber > endPageNumber - (state.viewPageCnt - 1))) {
                startPageNumber = endPageNumber - (state.viewPageCnt - 1);
            }
            // 페이지 번호 배열 생성
            state.productViewPageNumber = Array.from({ length: endPageNumber - startPageNumber + 1 }, (_, idx) => idx + startPageNumber);
            localStorage.setItem('productViewPageNumber', JSON.stringify(state.productViewPageNumber));
        },

        // 검색 게시판
        setBoardPagination(state, paginationData) {
            state.boardCurrentPage = paginationData.current_page;
            state.boardLastPage = paginationData.last_page;
            state.path = paginationData.path;
            localStorage.setItem('boardCurrentPage', paginationData.current_page);
            localStorage.setItem('boardLastPage', paginationData.last_page);
            localStorage.setItem('paginationPath', paginationData.path);
            // 페이지 번호 출력 연산
            let offSet = Math.floor(state.viewPageCnt / 2); // 오프셋
            let startPageNumber = (state.boardCurrentPage - offSet) < 1 ? 1 : state.boardCurrentPage - offSet; // 시작 페이지 번호 초기화
            let endPageNumber = startPageNumber + (state.viewPageCnt - 1); // 마지막 페이지 번호 초기화
            // 엔드페이지 조절 (토탈 페이지보다 클 경우)
            if(endPageNumber > state.boardLastPage) {
                endPageNumber = state.boardLastPage;
            }
            // 스타트 페이지 조절(음수 안나오게 조절)
            if((endPageNumber - (state.viewPageCnt - 1)) > 1 && (startPageNumber > endPageNumber - (state.viewPageCnt - 1))) {
                startPageNumber = endPageNumber - (state.viewPageCnt - 1);
            }
            // 페이지 번호 배열 생성
            state.boardViewPageNumber = Array.from({ length: endPageNumber - startPageNumber + 1 }, (_, idx) => idx + startPageNumber);
            localStorage.setItem('boardViewPageNumber', JSON.stringify(state.boardViewPageNumber));
        },

        // 검색 체험단
        setTesterPagination(state, paginationData) {
            state.testerCurrentPage = paginationData.current_page;
            state.testerLastPage = paginationData.last_page;
            state.path = paginationData.path;
            localStorage.setItem('testerCurrentPage', paginationData.current_page);
            localStorage.setItem('testerLastPage', paginationData.last_page);
            localStorage.setItem('paginationPath', paginationData.path);
            // 페이지 번호 출력 연산
            let offSet = Math.floor(state.viewPageCnt / 2); // 오프셋
            let startPageNumber = (state.testerCurrentPage - offSet) < 1 ? 1 : state.testerCurrentPage - offSet; // 시작 페이지 번호 초기화
            let endPageNumber = startPageNumber + (state.viewPageCnt - 1); // 마지막 페이지 번호 초기화
            // 엔드페이지 조절 (토탈 페이지보다 클 경우)
            if(endPageNumber > state.testerLastPage) {
                endPageNumber = state.testerLastPage;
            }
            // 스타트 페이지 조절(음수 안나오게 조절)
            if((endPageNumber - (state.viewPageCnt - 1)) > 1 && (startPageNumber > endPageNumber - (state.viewPageCnt - 1))) {
                startPageNumber = endPageNumber - (state.viewPageCnt - 1);
            }
            // 페이지 번호 배열 생성
            state.testerViewPageNumber = Array.from({ length: endPageNumber - startPageNumber + 1 }, (_, idx) => idx + startPageNumber);
            localStorage.setItem('testerViewPageNumber', JSON.stringify(state.testerViewPageNumber));
        },

        // 마이페이지 게시글
        setMyPageBoardPagination(state, paginationData) {
            state.userBoardCurrentPage = paginationData.current_page;
            state.userBoardLastPage = paginationData.last_page;
            state.path = paginationData.path;
            localStorage.setItem('userBoardCurrentPage', paginationData.current_page);
            localStorage.setItem('userBoardLastPage', paginationData.last_page);
            localStorage.setItem('paginationPath', paginationData.path);
            // 페이지 번호 출력 연산
            let offSet = Math.floor(state.viewPageCnt / 2); // 오프셋
            let startPageNumber = (state.userBoardCurrentPage - offSet) < 1 ? 1 : state.userBoardCurrentPage - offSet; // 시작 페이지 번호 초기화
            let endPageNumber = startPageNumber + (state.viewPageCnt - 1); // 마지막 페이지 번호 초기화
            // 엔드페이지 조절 (토탈 페이지보다 클 경우)
            if(endPageNumber > state.userBoardLastPage) {
                endPageNumber = state.userBoardLastPage;
            }
            // 스타트 페이지 조절(음수 안나오게 조절)
            if((endPageNumber - (state.viewPageCnt - 1)) > 1 && (startPageNumber > endPageNumber - (state.viewPageCnt - 1))) {
                startPageNumber = endPageNumber - (state.viewPageCnt - 1);
            }
            // 페이지 번호 배열 생성
            state.userBoardViewPageNumber = Array.from({ length: endPageNumber - startPageNumber + 1 }, (_, idx) => idx + startPageNumber);
            localStorage.setItem('userBoardViewPageNumber', JSON.stringify(state.userBoardViewPageNumber));
        },

        // 마이페이지 문의게시글
        setMyPageQuestionPagination(state, paginationData) {
            state.userQuestionCurrentPage = paginationData.current_page;
            state.userQuestionLastPage = paginationData.last_page;
            state.path = paginationData.path;
            localStorage.setItem('userQuestionCurrentPage', paginationData.current_page);
            localStorage.setItem('userQuestionLastPage', paginationData.last_page);
            localStorage.setItem('paginationPath', paginationData.path);
            // 페이지 번호 출력 연산
            let offSet = Math.floor(state.viewPageCnt / 2); // 오프셋
            let startPageNumber = (state.userQuestionCurrentPage - offSet) < 1 ? 1 : state.userQuestionCurrentPage - offSet; // 시작 페이지 번호 초기화
            let endPageNumber = startPageNumber + (state.viewPageCnt - 1); // 마지막 페이지 번호 초기화
            // 엔드페이지 조절 (토탈 페이지보다 클 경우)
            if(endPageNumber > state.userQuestionLastPage) {
                endPageNumber = state.userQuestionLastPage;
            }
            // 스타트 페이지 조절(음수 안나오게 조절)
            if((endPageNumber - (state.viewPageCnt - 1)) > 1 && (startPageNumber > endPageNumber - (state.viewPageCnt - 1))) {
                startPageNumber = endPageNumber - (state.viewPageCnt - 1);
            }
            // 페이지 번호 배열 생성
            state.userQuestionViewPageNumber = Array.from({ length: endPageNumber - startPageNumber + 1 }, (_, idx) => idx + startPageNumber);
            localStorage.setItem('userQuestionViewPageNumber', JSON.stringify(state.userQuestionViewPageNumber));
        },
    },
    actions: {
    },
    getters: {
        getPlusOneLastPage(state) {
            return state.lastPage + 1;
        },
    },
}