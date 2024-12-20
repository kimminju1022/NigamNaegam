import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page: 0,  // 현재페이지로 넘겨주기 위함
        bcType: 0
    }),
    mutations: {
        // 스테이트의 변수를 변경하기 위한 함수를 정의하는 영역
        setBoardList(state,boardList){
            state.boardList = boardList;
        },
        setPage(state,page){
            state.page = page;
        },
        setBcType(state, bcType) {
            state.bcType = bcType;
        },
    },
    actions: {
        /** 게시글획득
         *  @param{*} context
        */
        getBoardListPagination(context){
            const url = '/api/boards?bc_type='+ context.state.bcType +'&page=' + context.getters['getNextPage'];
            console.log(url); // TODO : 추후삭제
            
            axios.get(url)
            .then(response =>{
                // console.log(response)
                context.commit('setBoardList', response.data.boardList.date);
                context.commit('setPage', response.data.boardList.current_page);
            })
            .catch(error => {
                console.error(error);
            });
        },
        /** 게시글 작성
         * 
         */
        postBoardCreate(context){
            const url = '/api/boards/create';
            const config = {
                header: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then()
            .catch();
        },
        /** 게시글 수정
         * 
         */
        postBoardUpdate(context){
            const url = '/api/boards/update';
            const config = {
                header: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then()
            .catch();
        },
        /** 게시글 삭제
         * 
         */
        postBoardDelete(context){
            const url = '/api/boards/detail';
            const config = {
                header: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url)
            .then()
            .catch();
        },

        /**게시글 신고 */
        postBoardNotify(context) {
            const url = '/api/board';
            const config = {
                header:{
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),

                }
            }
            axios.get(url)
            .then()
            .catch();
        },
    },
    getters: {
        getNextPage(state){
            return state.page + 1;
        }
    },
}