<template>
    <!-- 작동btn -->
     <div class="board-create-head">
        <h2>board title</h2>
         <div class="form-box">
             <button class="btn board-create-btn">목록</button>
             <button class="btn board-create-btn">취소</button>
             <button class="btn board-create-btn">완료</button>
         </div>
     </div>
    <!-- 선택박스 -->
    <div class="select-categories">
        <label for="board-category">카테고리</label>
        <select v-model="SelectedBoardCategory" name="board-categories" id="board-categories">
            <option value="1">리뷰게시판</option>
            <option value="2">자유게시판</option>
        </select>
        <select name="sub-categories" id="sub-categories">
            <option value="0" selected>선택없음</option>
            <option value="1">맛집</option>
            <option value="2">액티비티</option>
            <option value="3">힐링</option>
            <option value="4">쇼핑</option>        
        </select>
        <div class="board-create-evaluation">
            <input type="radio" class="star" value="1">
            <input type="radio" class="star" value="2">
            <input type="radio" class="star" value="3">
            <input type="radio" class="star" value="4">
            <input type="radio" class="star" value="5">
        </div>
        <hr>
        <!-- <div class="star-rating">
            <span
            v-for="star in reversedStars"
            :key="star"
            :class="{ filled: star <= rating }"
            @click="setRating(star)"
            @mouseover="hoverRating(star)"
            @mouseleave="resetHover"
            >
            ★
            </span>
            <p>현재 별점: {{ rating }}</p>
        </div>
        <hr>
        <div class="star-3rd">
            <div class="star-3rating">
            <div
                class="star-3"
                v-for="index in 5"
                :key="index"
                @click="check(index)"
            >
                <span v-if="index < score">★</span>
                <span v-if="index >= score">☆</span>
            </div>
            </div>
        </div>
        <hr> -->
    </div>
    <div class="board-create-container">
        <h3>제목</h3>
        <input type="text" name="title" placeholder="제목을 적어주세요" maxlength="100">
        <h3>내용</h3>
        <textarea name="content" id="" placeholder="당신의 이야기를 여기에 적어주세요" maxlength="2000"></textarea>
        <div class="board-create-file">
            <h3>파일첨부</h3>
            <input type="file" name="file" accept="imge/*">
        </div>
               
    </div>
     <!-- 내용 -->

 </template>

<script>
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

<style>
.board-create-head{
    
}
.form-box{
    /* display: grid;
    grid-template-columns: 1fr;
    margin-top: 20px;
    margin-bottom: 30px;
    align-items: flex-end;
    justify-content: left; */
    display: inline-flex;

}
.board-create-btn{
    
}
.select-categories{

}
.board-create-evaluation{
      display: flex;
}

/* .star {
    appearance: none;
    padding: 1px;
}

.star::after {
    content: '☆';
    color: hsl(229, 100%, 48%);
    font-size: 20px;
}

.star:hover::after,
.star:has(~ .star:hover)::after,
.star:checked::after,
.star:has(~ .star:checked)::after {
    content: '★';
}

/* .star:hover ~ .star::after {
    content: '☆';
} */
/*.star-rating span {
  font-size: 30px;
  cursor: pointer;
  color: lightgray;
  transition: color 0.2s;
}

.star-rating span.filled {
  color: gold;  채워진 별 
}

.star-rating span:hover,
.star-rating span:hover ~ span {
  color: gold;  마우스 오버 시 별 
}
.star-3{
 color: gold;
}
@media screen and (max-width: 800px) {
    .board-detail-head {
        grid-template-columns: none; 기존 가로 정렬 해제 
        grid-template-rows: auto;  세로로 요소 쌓기 
        align-items: center;  중앙 정렬 
        text-align: center;  텍스트 중앙정렬 
    }
} */


</style>