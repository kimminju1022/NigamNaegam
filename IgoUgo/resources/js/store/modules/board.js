import { reactive } from "vue";
import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardTitle: '',
        boardList: [],
        boardCategories:'',
        boardArea:'',
        bcType: localStorage.getItem('boardBcType') ? localStorage.getItem('boardBcType') : '0',
        boardImg1:{},
        boardImg2:{},
        boardComment:null,
        boardReview: [],
        boardFree: [],
    }),
    mutations: {
        // 스테이트의 변수를 변경하기 위한 함수를 정의하는 영역
        setBcType(state, bcType) {
            state.bcType = bcType;
            localStorage.setItem('boardBcType', bcType);
        },
        setBoardTitle(state, boardTitle) {
            state.boardTitle = boardTitle;
        },

        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setboardCategories(state, boardCategories) {
            state.boardCategories = boardCategories;
            localStorage.setItem('boarCategoryBctype', bcType);
        },
        setboardCategoryArea(state, boardArea) {
            state.boardArea = boardArea;
            localStorage.setItem('boardCategoryArea', areaName);
        },
        setBoardComment(state, boardComment) {
            state.boardComment = boardComment;
        },
        setBoardReview(state, boardReview) {
            state.boardReview = boardReview;
        },
        setBoardFree(state, boardFree) {
            state.boardFree = boardFree;
        },
    },
    actions: {

        // 댓글가져오기
        showComment(context, id) {
            const url = '/api/boards/'+id;
            const config = {
                headers:{
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.get(url, config)
            .then(response => {
                console.log(response); //추후삭제제
                context.commit('setBoardComment', response.data.boardComment);
            })
            .catch(error => {
                console.error(error);
            });   
        },
        /** 게시글획득
         *  @param{*} context
         * @param{int} id
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
                    // context.commit('setboardCategories', response.data.boardCategoryBctype.data);
                    // context.commit('setboardCategoryArea', response.data.boardCategoryArea.data);

                    return resolve();
                })
                .catch(error => {
                    console.error(error);
                    return reject();
                });
            });
        },
        showBoardDetail(context, id) {
            const url = '/boards/'+id;
            const config = {
                headers:{
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.get(url, config)
            .then()
            .catch();
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
            const formData = new FormData();
            formData.append('bc_type', data.bc_type);
            formData.append('board_title', data.board_title);
            formData.append('board_content', data.board_content);
            if(data.board_img1) {
                formData.append('board_img1', data.board_img1);
            }
            if(data.board_img2) {
                formData.append('board_img2', data.board_img2);
            }
            // 리뷰게시판일 경우
            if(data.area_code) {
                formData.append('area_code', data.area_code);
            }
            if(data.rc_type) {
                formData.append('area_code', data.rc_type);
            }
            if(data.rate) {
                formData.append('area_code', data.rate);
            }

            axios.post(url,formData, config)
            .then(response => {
                console.log(response.data.boards);
                console.log(response.data.reviewa);
                
                context.commit('setQuestionList', response.data.data);
                
                router.replace('/boards');
            })
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

        boardReview(context) {
            const url = '/api/boards/review';

            axios.get(url)
            .then(response => {
                // console.log('boardReview',response.data);
                // console.log('boardReview', response.data.boardReview);
                context.commit('setBoardReview', response.data.boardReview);
            })
            .catch(error => {
                console.log(error.response);
            });
        },

        boardFree(context) {
            const url = '/api/boards/free';

            axios.get(url)
            .then(response => {
                // console.log('boardFree',response.data);
                context.commit('setBoardFree', response.data.boardFree);
            })
            .catch(error => {
                console.log(error.response.data);
            });
        },
    },
    getters: {
    },
}