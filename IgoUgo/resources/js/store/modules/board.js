import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardDetail: {},
        boardComments: [],
        commentsTotal: 0,
        bcName:'',
        rcName:'',
        areaName:'',
        mapNames: {},
        boardList: [],
        bcType: localStorage.getItem('boardBcType') ? localStorage.getItem('boardBcType') : '0',
        boardReview: [],
        boardFree: [],
    }),
    mutations: {
        // 스테이트의 변수를 변경하기 위한 함수를 정의하는 영역
        setBoardDetail(state, data){
            state.boardDetail = data;
        },
        setBoardComments(state, data) {
            state.boardComments = data;
        },
        setCommentsTotal(state, data) {
            state.commentsTotal = data;
        },
        setBcType(state, bcType) {
            state.bcType = bcType;
            localStorage.setItem('boardBcType', bcType);
        },
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setBoardReview(state, boardReview) {
            state.boardReview = boardReview;
        },
        setBoardFree(state, boardFree) {
            state.boardFree = boardFree;
        },
        setBcName(state, bcName) {
            state.bcName = bcName;
        },
        setRcName(state, rcName) {
            state.rcName = rcName;
        },
        setAreaName(state, areaName) {
            state.areaName = areaName;
        },
    },
    actions: {
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
                    // console.log(response);
                    context.commit('setBcName', response.data.bcName);
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
            const url = '/api/boards/'+ id;
            
            axios.get(url)
            .then(response => {
                context.commit('setBoardDetail', response.data.board);
                context.commit('setBcName', response.data.bcName);
                context.commit('setRcName', response.data.rcName);
                context.commit('setAreaName', response.data.areaName);
            })
            .catch(error => {
                console.error(error.response.data);
            });
        },
        /**
         *  코멘트 획득
         */
        boardCommentPagination(context, searchData) {
            const url = '/api/comments';
            const config = {
                params: searchData
            };

            axios.get(url, config)
            .then(response =>{
                context.commit('setBoardComments', response.data.comments.data);
                context.commit('setCommentsTotal', response.data.comments.total);
                context.commit('pagination/setPagination', response.data.comments, {root: true});
            })
            .catch(error => {
                console.error(error);
            });
        },

        /** 게시글 작성
         * 
         */
        storeBoard(context, data){
            const url = '/api/boards';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

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
            if(data.area_code) {
                formData.append('area_code', data.area_code);
            }
            if(data.rc_type) {
                formData.append('rc_type', data.rc_type);
            }
            if(data.rate) {
                formData.append('rate', data.rate);
            }

            // console.log(data);

            axios.post(url,formData, config)
            .then(response => {
                // console.log(response.data);
                // console.log(response.data.board);
                // console.log(response.data.review);
                
                context.commit('setBoardList', response.data.data);
                
                router.replace('/boards');
            })
            .catch(error => {
                console.error(error.response.data);
            });
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
        boardUpdate(context){
            const url = `/api/boards/update/${board.boardDetail.boad_id}`;
            const config = {
                header: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    'Content-Type': 'multipart/form-data',
                }
            }
            const formData = new FormData();

            formData.append('board_id', board.boardDetail.board_id);
            formData.append('board_title', board.boardDetail.board_title);
            formData.append('board_content', board.boardDetail.board_content);
            if(question.board_img1) {
                formData.append('board_img1', board.board_img1);
            }
            if(question.board_img2) {
                formData.append('board_img2', board.board_img2);
            }

            // console.log('formData는', formData);

            axios.post(url, formData, config)
            .then(response => {
                context.commit('setBoardList', response.data.data);

                alert('수정 성공');
                router.replace(`/boards/${board.boardDetail.board_id}`);
                }
            )
            .catch(error => {
                alert('수정 실패');
                console.error(error.response.data);
            });
        },
        /** 게시글 삭제
         * 
         */
        BoardDelete(context, id) {
            const url = `/api/boards/${id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.delete(url, config)
            .then(response => {
                alert('삭제 성공');
                router.push('/questions');
            })
            .catch(error => {
                // console.error(error);
                alert('삭제 실패');
            });
        },

        /**게시글 신고 */
        BoardNotify(context) {
            const url = `/api/board/${id}`;
            const config = {
                header:{
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.get(url)
            .then()
            .catch(error => {
                alert('신고가 불가합니다\n관리자에게 직접 문의 바랍니다')
            });
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

        // 댓글 획득
        getBoardReply(context, searchData) {
            return new Promise((resolve, reject) => {
                const url = `/api/boards/${id}`;
                const config = {
                    params: searchData
                };
                
                axios.get(url, config)
                .then(response =>{
                    // console.log(response);
                    context.commit('setBcName', response.data.bcName);
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
    },
        /** 게시글획득
         *  @param{*} context
         * @param{int} id
        */
        // getBoardListPagination(context, searchData) {
        //     return new Promise((resolve, reject) => {
        //         const url = '/api/boards';
        //         const config = {
        //             params: searchData
        //         };
                
        //         axios.get(url, config)
        //         .then(response =>{
        //             console.log(response);
        //             context.commit('setBcName', response.data.bcName);
        //             context.commit('setBoardList', response.data.boardList.data);
        //             context.commit('pagination/setPagination', response.data.boardList, {root: true});
        //             // context.commit('setboardCategories', response.data.boardCategoryBctype.data);
        //             // context.commit('setboardCategoryArea', response.data.boardCategoryArea.data);
        //             // return resolve();
        //         })
        //         .catch(error => {
        //             console.error(error);
        //             // return reject();
        //         });
        //     });
        // },
        
    getters: {
    },
}