import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        searchData: '',
        searchHotelList: [],
        searchProductList: [],
        searchBoardList: [],
        searchTesterList: [],
    }),
    mutations: {
        setSearchData(state, searchData) {
            state.searchData = searchData;
        },
        setSearchHotelList(state, data) {
            state.searchHotelList = data;
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

            console.log('searchHotel :',data);
            console.log('url.js :',url);
            
            axios.get(url)
            .then(response => {
                // console.log('setSearchHotelList',response.data);
                context.commit('setSearchHotelList', response.data.hotel.data);
                // context.commit('pagination/setPagination', response.data.data, {root: true});

                router.push('/search');
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        searchProduct(context, data) {
            const url = `/api/search/product?search=${data.search}&page=${data.page}`;

            console.log('searchProduct :',data);
            console.log('url.js :',url);

            axios.get(url)
            .then(response => {
                // console.log('setSearchProductList',response.data);
                context.commit('setSearchProductList', response.data.product.data);
                // context.commit('pagination/setPagination', response.data.data, {root: true});

                // router.push('/search');
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        searchBoard(context, data) {
            const url = `/api/search/board?search=${data.search}&page=${data.page}`;
            
            console.log('searchBoard :',data);
            console.log('url.js :',url);

            axios.get(url)
            .then(response => {
                // console.log('setSearchBoardList',response.data);
                context.commit('setSearchBoardList', response.data.board.data);
                // context.commit('pagination/setPagination', response.data.data, {root: true});

                // router.push('/search');
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        searchTester(context, data) {
            const url = `/api/search/board/tester?search=${data.search}&page=${data.page}`;
            
            console.log('searchTester :',data);
            console.log('url.js :',url);

            axios.get(url)
            .then(response => {
                // console.log('setSearchTesterList',response.data);
                context.commit('setSearchTesterList', response.data.tester.data);
                // context.commit('pagination/setPagination', response.data.data, {root: true});

                router.push('/search');
            }) 
            .catch(error => {
                console.error(error);
            });
        },

    },
    getters: {
    },
}