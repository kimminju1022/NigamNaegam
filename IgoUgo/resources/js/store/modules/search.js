import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        searchKeyword: sessionStorage.getItem('searchKeyword') ? sessionStorage.getItem('searchKeyword') : '',
        searchData: '',
        searchHotelCnt: '',
        searchProductCnt: '',
        searchBoardCnt: '',
        searchTesterCnt: '',
        searchBoardContentCnt:'',
        searchHotelList: [],
        searchProductList: [],
        searchBoardList: [],
        searchTesterList: [],
        searchBoardContentList: [],
        
    }),
    mutations: {
        setSearchKeyword(state, keyword) {
            state.searchKeyword = keyword;
            sessionStorage.setItem('searchKeyword', keyword);
        },
        setSearchData(state, searchData) {
            state.searchData = searchData;
        },
        setSearchHotelCnt(state, searchHotelCnt) {
            state.searchHotelCnt = searchHotelCnt;
        },
        setSearchProductCnt(state, searchProductCnt) {
            state.searchProductCnt = searchProductCnt;
        },
        setSearchBoardCnt(state, searchBoardCnt) {
            state.searchBoardCnt = searchBoardCnt;
        },
        setSearchTesterCnt(state, searchTesterCnt) {
            state.searchTesterCnt = searchTesterCnt;
        },
        setSearchBoardContentCnt(state, searchBoardContentCnt){
            state.searchBoardContentCnt = searchBoardContentCnt;
        },
        setSearchHotelList(state, searchHotelList) {
            state.searchHotelList = searchHotelList;
        },
        setSearchProductList(state, searchProductList) {
            state.searchProductList = searchProductList;
        },
        setSearchBoardList(state, searchBoardList) {
            state.searchBoardList = searchBoardList;
        },
        setSearchTesterList(state, searchTesterList) {
            state.searchTesterList = searchTesterList;
        },
        setSearchBoardContentList(state, searchBoardContentList){
            state.searchBoardContentList =searchBoardContentList;
            console.log('검색결과 : ',state.searchBoardContentList);
        }
    },
    actions: {
        searchHotel(context, data) {
            const url = `/api/search/hotel?search=${data.search}&page=${data.page}`;
            // const url = '/api/search/hotel';
            // const config = {
            //     params: {
            //         search: data.search,
            //         page: data.page
            //     },
            // }

            // console.log('searchHotel :',data);
            // console.log('url.js :',url);
            
            axios.get(url)
            .then(response => {
                // console.log('setSearchHotelList',response.data);
                context.commit('setSearchHotelCnt', response.data.hotel.total); // 리스트 총 개수 카운트
                context.commit('setSearchHotelList', response.data.hotel.data);
                context.commit('pagination/setHotelPagination', response.data.hotel, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        searchProduct(context, data) {
            const url = `/api/search/product?search=${data.search}&page=${data.page}`;

            // console.log('searchProduct :',data);
            // console.log('url.js :',url);

            axios.get(url)
            .then(response => {
                // console.log('setSearchProductList',response.data);
                context.commit('setSearchProductCnt', response.data.product.total);
                context.commit('setSearchProductList', response.data.product.data);
                context.commit('pagination/setProductPagination', response.data.product, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        searchBoard(context, data) {
            const url = `/api/search/board?search=${data.search}&page=${data.page}`;
            
            // console.log('searchBoard :',data);
            // console.log('url.js :',url);

            axios.get(url)
            .then(response => {
                // console.log('setSearchBoardList',response.data);
                context.commit('setSearchBoardCnt', response.data.board.total);
                context.commit('setSearchBoardList', response.data.board.data);
                // console.log(response.data.board.data);
                context.commit('pagination/setBoardPagination', response.data.board, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },
        // 상품검색 - 민주250205
        searchBoardContent(context, data){
            const url = `/api/search/board/content/?search=${data.search}&page=${data.page}`;
            axios.get(url)
            // .then(response => {
            //     context.commit('setSearchBoardContent', response.data.product.data)
            //     console.log(response.data.product.data);

            // })
            .then(response => {
                context.commit('setSearchBoardContentCnt', response.data.board.total);
                console.log('상품정보 :',  response.data.board.total);
                context.commit('setSearchBoardContentList', response.data.board.data);
                console.log('상품정보 :', response.data);
                context.commit('pagination/setBoardPagination', response.data.board, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        searchTester(context, data) {
            const url = `/api/search/board/tester?search=${data.search}&page=${data.page}`;
            
            // console.log('searchTester :',data);
            // console.log('url.js :',url);

            axios.get(url)
            .then(response => {
                // console.log('setSearchTesterList',response.data);
                context.commit('setSearchTesterCnt', response.data.tester.total);
                context.commit('setSearchTesterList', response.data.tester.data);
                context.commit('pagination/setTesterPagination', response.data.tester, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },
    },
    getters: {
    },
}