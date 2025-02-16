import axios from "../../axios";

export default {
    namespaced: true,
    state: () => ({
        noticeList: [],
        noticeTopList: [],
        noticeDetail: null,
    }),
    mutations: {
        setNoticeList(state, noticeList) {
            state.noticeList = noticeList;
        },
        setNoticeTopList(state, noticeTopList) {
            state.noticeTopList = noticeTopList;
        },
        setNoticeDetail(state, noticeDetail) {
            state.noticeDetail = noticeDetail;
        },
    },
    actions: {
        // 공지사항 리스트
        noticeList(context, searchData) {
            const url = '/api/notices';
            const config = {
                params: searchData,
            }

            axios.get(url, config)
            .then(response => {
                // console.log('noticeList',response.data);
                context.commit('setNoticeList', response.data.data.data);
                context.commit('pagination/setPagination', response.data.data, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },
        
        // 공지사항 top 리스트
        noticeTopList(context, data) {
            const url = '/api/notices/top';

            axios.get(url)
            .then(response => {
                // console.log('noticeList',response.data);
                context.commit('setNoticeTopList', response.data.data.data);
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        // 게시글 상세
        noticeDetail(context, data) {
            const url = `/api/notices/${data.board_id}`;
            // const config = {
            //     params: data,
            // }

            axios.get(url)
            .then(response => {
                // console.log(response.data);
                context.commit('setNoticeDetail', response.data.data);
            })
            .catch(error => {
                console.error(error);
            });
        },
    },
    getters: {
    },
}