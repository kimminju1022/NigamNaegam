<template>
    <!-- 작동btn  [목록과 취소가 같은것 아닐까?] -->
    <div class="board-create-head">
        <h2>{{ item.bc_type }} ></h2>
        <div class="form-box">
            <router-link to="/boards"><button class="btn bg-clear board-create-btn">목록</button></router-link>
            <button class="btn bg-clear board-create-btn" @click="cancelConfirm">취소</button>
            <button class="btn bg-navy board-create-btn" @click="doneConfirm">완료</button>
        </div>
    </div>
    <hr>
    <!-- 선택박스 -->
    <div class="board-selectContainer">
        <div class="select-boardType">
            <h3></h3>
            <select name="board-categories" id="board-categories">
                <!-- v-model="SelectedBoardCategory"  -->
                <option value="1">리뷰게시판</option>
                <option value="2">자유게시판</option>
            </select>
        </div>
        <hr>
        <div class="board-selectType">
            <h3 class="board-category">유형
                <select name="sub-categories" id="board-categories">
                    <option disabled hidden selected>--유형선택--</option>
                    <option value="0">맛집</option>
                    <option value="1">액티비티</option>
                    <option value="2">힐링</option>
                    <option value="3">쇼핑</option>
                </select>
            </h3>
            <h3 class="board-category">지역
                <select name="sub-categories" id="board-categories">
                    <option disabled hidden selected>--지역선택--</option>
                    <option value="0">서울</option>
                    <option value="1">인천</option>
                    <option value="2">대전</option>
                    <option value="3">세종</option>
                    <option value="4">대구</option>
                    <option value="5">광주</option>
                    <option value="6">부산</option>
                    <option value="7">울산</option>
                    <option value="8">경기</option>
                    <option value="9">강원</option>
                    <option value="10">충북</option>
                    <option value="11">충남</option>
                    <option value="12">경북</option>
                    <option value="13">경남</option>
                    <option value="14">전북</option>
                    <option value="15">전남</option>
                    <option value="16">제주</option>
                </select>
            </h3>
            <div v-for="searchItem in searchKeyword" id="board-search-tb">
                <input v-model="keyword" class="board-search" type="text" placeholder="검색어를 입력해 주세요">
                <button @click="keywordSearch" class="btn bg-navy board-search-btn">검색</button>
            </div>
            <!-- 별점 -->
            <div class="board-starGrade">
                <h3>별점</h3>
                <div class="star-grade">
                    <input type="radio" name="rating" id="star-1" class="star" value="1">
                    <label for="star-1" class="star-label"></label>
    
                    <input type="radio" name="rating" id="star-2" class="star" value="2">
                    <label for="star-2" class="star-label"></label>
    
                    <input type="radio" name="rating" id="star-3" class="star" value="3">
                    <label for="star-3" class="star-label"></label>
    
                    <input type="radio" name="rating" id="star-4" class="star" value="4">
                    <label for="star-4" class="star-label"></label>
    
                    <input type="radio" name="rating" id="star-5" class="star" value="5">
                    <label for="star-5" class="star-label"></label>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="board-create-container">
        <div class="board-create-title">
            <h3 style="margin-left: 10px;">제목</h3>
            <input type="text" name="title" placeholder="제목을 적어주세요" maxlength="100">
        </div>
        <hr>
        <div class="board-create-file">
            <h3 class="board-create-fileChoice">파일첨부</h3>
            <input type="file" name="file" accept="imge/*" @change="changeImage">
        </div>            
        <!--미리보기 삭제기능추가 -->
        <div class="board-imgPreview">
            <img :src="previewImage.img">
            <button @click="deleteImg" class="btn btn-navy btn-imgBtn">✖</button>
        </div>
        <img src={{}} alt="">
        <hr>
        <textarea name="content" placeholder="당신의 이야기를 여기에 적어주세요" maxlength="2000"></textarea>
        <hr>
    </div>
    <!-- 내용 -->

</template>

<script setup>
import router from '../../../js/router';


const cancelConfirm = () =>{
    const userResponse = confirm('작성 페이지에서 벗어납니다. 작성을 취소하시겠습니까?');
    if (userResponse) {
        router.push('/boards');
    }
}
const doneConfirm = () =>{
    const userResponse = confirm('작성을 완료하시겠습니까?');
    if (userResponse) {
        router.push('/boards/detail');
        // 이때, post로 정보 전달해줘야함...어떻게?
    }
}
// 사진 업로드 미리보기
const previewImage = ref<String>('')

const changeImage = (event) => {
    const files = event.target?.files
    if(files.length>0){
        const file = files[0]
        // FileReader:데이터 읽고 저장하는 기능
        const reader = new FileReader
        // 로딩완료되면 실행하는 기능
        reader.onload = (e) => {
            // previewImage값 변경하는 기능
            previewImage.value = e.target.result
        }
        reader.readAsDataURL(file)
    }
}
// 검색관련
const searchItem= ref<String>('')

const searchKeyword = (event) => {

}

// 모달 시러시러 예쁜모달 만들고 싶다...별점똥 좋아요똥똥
// export default {
//     name:'modal',
//     data(){
//         return{
//             modalopen : false,

            
//         }
//     }
// }

// 별점
// export default {
//     data() {
//         return {
//         rating: 0, // 실제 별점 값
//         hoverRating: 0, // 마우스 오버 시 임시 별점 값
//         stars: [1, 2, 3, 4, 5], // 별의 개수
//         };
//     },
//     computed: {
//   reversedStars() {
//           return [...this.stars].reverse(); // 배열 원본을 유지하면서 뒤집음
//         },
//     },
//     methods: {
//         setRating(star) {
//         this.rating = star; // 클릭한 별점 설정
//         this.submitRating(); // 서버에 전달
//         },
//         hoverRating(star) {
//         this.hoverRating = star; // 마우스 오버 시 임시 별점 표시
//         },
//         resetHover() {
//         this.hoverRating = 0; // 마우스가 떠나면 초기화
//         },
//         submitRating() {
//         // Laravel로 점수 전송
//         fetch("/api/rating", {
//             method: "POST",
//             headers: {
//             "Content-Type": "application/json",
//             },
//             body: JSON.stringify({ rating: this.rating }),
//         })
//         .then((response) => response.json())
//         .then((data) => {
//           console.log("별점 저장 성공:", data);
//         })
//         .catch((error) => {
//           console.error("별점 저장 실패:", error);
//         });
//     },
//   },
// };
// export default {
//   name: "Star-3",
//   data() {
//     return {
//       score: 0,
//     };
//   },
//   methods: {
//     check(index) {
//       this.score = index + 1;
//     },
//   },
// };
</script>

<style scoped>

.board-create-head{
    display: grid;
    grid-template-columns: 1fr 1fr;
    justify-content: center;
    column-gap: 10px;
    margin-bottom: 20px;
    letter-spacing: 5px;    
}
.board-create-head>h2{
    font-size: 2rem;
}
.board-create-head>h3{
    margin: 30px 0;
    font-size: 3rem;}
.form-box, .board-create-file{
    /* display: grid;
    grid-template-columns: repeat(3,1fr);
    margin-top: 20px;
    margin-bottom: 30px;
    text-align: center;
    justify-content: left; */
    align-items: flex-end;
    gap: 20px;    
}
/* .form-box>button{
    border-radius: 20px;
    width: 60px;
    height: 30px;
    font-size: large;
} */
.board-create-file{
    display: grid;
    grid-template-columns: 1fr;
}
.board-create-file>img{
    height: 200px;
}
#board-search-tb{
    display: inline-flex;
    justify-content:end;
    margin: 10px 20px;
    align-items: flex-end;
}
.board-search {
    margin-left: 20px; 
    background-color: #e9e8e8;
    border-radius: 20px;
    width: 250px;
    height: 31px;
    text-indent: 20px; 
}

.board-search-btn{
    font-size: large;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-left: -60px;
}
.board-selectType{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    justify-content: center;
    align-items: center;
    margin: auto 10px;
}
.board-selectType>h3{
    margin-left: 20px;
}
.board-create-btn{
    font-size: large;
    border: #01083a solid 1px;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    gap: 50px;
    text-align: center;
}
.select-boardType, .select-categories, .board-create-title,
.board-starGrade, .form-box, .board-create-file{
    display: inline-flex;
    justify-content:flex-end;
    margin: 10px 20px;
    /* font-size: 1.2rem; */
}
.board-create-title>input{
    font-size: 1.2rem;
    margin-left: 85px;
}
.board-create-container>textarea{
    width: 1200px;
    height: 400px;
    font-size: 1.2rem;
    border-radius: 20px;
    margin: 10px;
    padding: 20px;
    resize: none;
    align-items: center;
}
#board-categories{
    width: 200px;
    border: none;
    border-bottom: solid 1px #01083a;
    text-align: center;
    margin-left: 30px;
}
.board-create-evaluation{
    display: flex;
}

/* 모달 */
/* 모달 시 메인 배경 */
.board-create-modal{
    width: 100%;
    height: 100%;
    background-color: rgba(197, 198, 198, 0.374);
    position: fixed;
    padding: 20px;
}
/* 모달 디자인 */
.board-create-modal-content{
    width: 50%;
    background-color: azure;
    border-radius: 10px;
    padding: 20px;
}
.modal-content {


background: white;
padding: 20px;
border-radius: 10px;


box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);


text-align: center;
width: 300px;
}


/* 별점 */
.board-starGrade{
    display: grid;
    grid-template-columns: 1fr 5fr;
    justify-content: center;
    align-items: center;
}
.star-grade {
    display: flex;
    flex-direction: row-reverse;    /* 별을 오른쪽에서 왼쪽으로 정렬 */
    justify-content: flex-end;
    gap: 2px;
}
.star {
    display: none; 
}
.star-label {
    font-size: 30px;
    color: rgba(255, 217, 0, 0.5); /* 기본 별 색상 */
    /* cursor: pointer; */ /* 잔재주인데 포인터 할까? */
}

/* 기본 별 스타일 */
.star-label::before {
    content: '☆';
}

/* 체크된 별과 그 앞의 별들 */
.star:checked ~ .star-label::before {
    content: '★';
    color: rgba(255, 217, 0, 1);
}

/* 호버 상태 */
.star-label:hover ~ .star-label::before,
.star-label:hover::before {
    content: '★';
    color: rgba(255, 217, 0, 1);
}

/* .star-grade {
    display: flex;
}
.star {
    appearance: none;
    padding: 1px;
}

.star::after {
    content: '☆';
    color: rgba(255, 217, 0, 0.685);
    font-size: 20px;
    }

.star:hover::after,
.star:has(~ .star:hover)::after,
.star:checked::after,
.star:has(~ .star:checked)::after {
    content: '★';
    }

.star:hover(~ .star)::after {
    content: '☆';
    }


.star:hover::after,
.star:hover ~ .star:hover::after,
.star:checked::after,
.star:hover ~ .star:checked::after {
    content: '★';
} */


/*.star-rating span {
    font-size: 30px;
    cursor: pointer;
    color: lightgray;
    transition: color 0.2s;
}
.star-rating span.filled {
color: gold; 
}
/* 마우스 호버 */
/*.star-rating span:hover,
.star-rating span:hover ~ span {
color: gold; 
}
.star-3{
color: gold;
}
*/
@media screen and (max-width: 800px) {
    .board-detail-head {
        grid-template-columns: none; /*기존 가로 정렬 해제 */
        grid-template-rows: auto;  /*세로로 요소 쌓기 */
        align-items: center;  /*중앙 정렬 */
        text-align: center;  /*텍스트 중앙정렬 */
    }
}
</style>