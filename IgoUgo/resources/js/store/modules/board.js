import { reactive } from "vue";
import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardTitle: '',
        boardList: [],
        bcType: localStorage.getItem('boardBcType') ? localStorage.getItem('boardBcType') : '0',
    }),
    mutations: {
        // 스테이트의 변수를 변경하기 위한 함수를 정의하는 영역
        setBoardTitle(state, boardTitle) {
            state.boardTitle = boardTitle;
        },
        
        setBoardList(state,boardList){
            state.boardList = boardList;
        },
        setBcType(state, bcType) {
            state.bcType = bcType;
            localStorage.setItem('boardBcType', bcType);
        },
    },
    actions: {
        /** 게시글획득
         *  @param{*} context
        */
        getBoardListPagination(context, searchData) {
            return new Promise((resolve, reject) => {
                const url = '/api/boards';
                const config = {
                    params: searchData
                };
                
                axios.get(url, config)
                .then(response =>{
                    console.log(response);
                    context.commit('setBoardTitle', response.data.boardTitle);
                    context.commit('setBoardList', response.data.boardList.data);
                    context.commit('pagination/setPagination', response.data.boardList, {root: true});
                    return resolve();
                })
                .catch(error => {
                    console.error(error);
                    return reject();
                });
            });
        },
        
        /** 게시글 작성
         * 
         */
        storeBoard(context, data){
            const url = '/api/boards';
            const config = {
                header: {
                    'Content-Type':'multipart/from-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            };
            const FormData = new FormData();
            formData.append('content', data.content);
            formData.append('file', data.file);

            axios.post(url,formData, config)
            .then()
            .catch();
    },
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
    },
}