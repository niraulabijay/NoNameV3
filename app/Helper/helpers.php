<?php
use App\Model\Category;
use App\Model\Content;
use App\Model\PractiseLog;
use App\Model\Question;
//use JWTAuth;


    function getCategoryChild($data){

//           $category = Category::where('id', $data)->first();
//           $contents = Content::where('id', $category->id)->get();
//
////           foreach ($contents as $content){
////
////
////           }
//           return $contents;

    }


     function selectChild( $id ) {
		$categories = Category::where( 'parent_id', $id )->get(); //rooney

		$categories = addRelation( $categories );

		return $categories;

	}

	 function addRelation( $categories ) {

		$categories->map( function ( $item, $key ) {

			$sub = $this->selectChild( $item->id );

			return $item = array_add( $item, 'subCategory', $sub );

		} );

		return $categories;
	}


	//    subject percentage of pratise by subject
	function getsubjectPercentage($subject_id){
		$subject = Content::where('id', $subject_id)->first();
		$chapterCount = 0;
		$chaptersPercentage = 0;
		foreach ($subject->children as $chapter){
			$chaptersPercentage += getPractiseLog($chapter->id);

			$chapterCount++;
		}
		if($chapterCount == 0){
			$subjectPercentage = 0;
        }else {
            $subjectPercentage = $chaptersPercentage / $chapterCount;
        }
		return (int) round($subjectPercentage);
	}


//	calculate percentage of pratise log by chapter
	function getPractiseLog($chapter_id){

		$user_id = JWTAuth::user()->id;
		$quizLogs = PractiseLog::where('user_id', $user_id)->where('chapter_id',$chapter_id)->get();

		$totalMarks = 0;
		$totalQuestion =0;
		$pratiseQuestionsTotalMarks = 0;
		foreach ($quizLogs as $quizLog){
			$questions = unserialize($quizLog->question_answer);
			$totalPratiseMarks = 0;
			$totalPratiseQuestion =0;
			$questionsTotalMarks = 0;
			foreach ($questions as $question){
				$pratiseQuestion = Question::where('id', $question['question_id'])->first();
				$marks = 0;
				if($question['correct'] == 1){
					$marks += $pratiseQuestion->marks;
				}
				$questionsTotalMarks += $pratiseQuestion->marks;
				$totalPratiseMarks += $marks;
				$totalPratiseQuestion++;
			}

	//            total question pratise by user
			$totalQuestion +=  $totalPratiseQuestion;

	//            total user marks
			$totalMarks += $totalPratiseMarks;

	//            totalMarks by question
			$pratiseQuestionsTotalMarks += $questionsTotalMarks;



		}

		if($pratiseQuestionsTotalMarks !=0 ){

			$userPratiseChapterPercentage = ($totalMarks / $pratiseQuestionsTotalMarks) * 100;
		}else{
			$userPratiseChapterPercentage = 0;
		}

		return (int) round($userPratiseChapterPercentage);


	}


?>
