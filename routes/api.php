<?php

use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Question\QuestionCollection;
use App\Http\Resources\SubjectWithChapters\SubjectCollection;
use App\Model\Category;
use App\Model\Content;
use App\Model\Question;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'admin',
    'as' => 'api.'
], function() {
    Route::post('store/question', 'QuestionController@store');
});


Route::group([
    'namespace' => 'API',
    'as' => 'api.',

], function() {

//    Route::get('user', 'UserController@index');
    Route::post('register', 'RegisterController@store');
    Route::post('login', 'RegisterController@login');
    Route::post('validateotp', 'RegisterController@validateOTP');
    Route::post('savepassword', 'RegisterController@savePassword');

    //classes for navbar dropdown
    Route::get('nav/classes', 'ClassController@getClasses');

    //front page syllabus
    Route::get('overview/{class_slug}','SyllabusController@overview');
    Route::get('front/syllabus/{subject_slug}','SyllabusController@get');


    Route::group([
            'middleware' => 'jwt-auth'
    ], function (){



        Route::post('logout', 'RegisterController@logout');
        Route::post('changepassword', 'RegisterController@changePassword');
        //    user information

        Route::get('/user/{id}', 'UserController@getData');
        Route::post('/user/update', 'UserController@storeData');






        //    class api get request
        Route::get('classes', 'ClassController@getClasses');
        //    class api post request
        Route::post('store/class', 'ClassController@storeClass');
        Route::get('subjects/{class_id}', 'ClassController@getSubjects');
        Route::get('chapters/{subject_slug}', 'ClassController@getChpters');


        //    Note  Jsondata by chapter id

        Route::get('notes/{user_id}/{subject_slug}', 'NoteController@index');
        Route::get('note/{id}', 'NoteController@show');


        Route::get('flashcards/{subject_slug}', 'FlashCardController@index');
        Route::get('flashcard/{id}', 'FlashCardController@show');


        Route::get('questionsets/{subject_slug}', 'QuestionSetController@index');
        Route::get('questionset/{id}', 'QuestionSetController@show');


        Route::post('bookmark/store', 'BookmarkController@store');
        Route::get('/bookmarks/note/{user_id}/','BookmarkController@note_bookmarks');

        //    get practice question by chapter id

        //    Route::get('practise/{chapter_slug}', 'PractiseController@index');
        //    Route::post('practise/store', 'PractiseController@storeData');
        //    Route::get('practise', 'PractiseController@getData');

        Route::group([
            'middleware' => 'practise-quota'
        ], function () {
            Route::get('practise_by_chapter/{chapter_slug}', 'PractiseController@practice_by_chapter');
        });
        Route::post('practise/store', 'PractiseController@storeData');
        // get test question by subject_slug
        Route::get('test/{subject_slug}/{user_id}','QuizLogController@test_by_subject');
        Route::post('test/store','QuizLogController@save_test_log');
        Route::post('test/user_quit/','QuizLogController@user_quit');

        //    Preparation api

        //syllabus api
        Route::get('syllabus/{class_id}','SyllabusController@dashboard_syllabus');
        Route::get('syllabus/detail/{subject_slug}','SyllabusController@get');


        //Notifications API
        Route::get('notifications','NotificationController@getNotifications');
        Route::post('notifications/seen','NotificationController@markSeenNotifications');
        Route::get('notifications/unseen/count','NotificationController@getUnseenNotificationCount');


        Route::post('test', function ( Request $request ){
            return $request;
        });


    });

});



Route::middleware('cors')->get('/navs', function (){
    $categories = Category::where('slug','class')->orWhere('slug','preparation')->get();

    return new CategoryCollection($categories);
});


Route::middleware('cors')->get('/ques', function (){
    $questions = Question::all();
    return new QuestionCollection($questions);
});

Route::middleware('cors')->get('/store/question',function (){
    $questions = Question::all();
    return new QuestionCollection($questions);
});

Route::get('/subjects', function () {
    $type = Category::where('slug', 'subject')->first();
    $subs = Content::where('type', $type->id)->get();
    $subjects = new SubjectCollection($subs);
    return $subjects;
});

//Route::post('/post_question_add','API\IndexController@add_question');

Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    'namespace'=>'API'
], function () {

    Route::group(['prefix' => '/questions'], function () {
        Route::post('/post_question_add','QuestionController@add_question');
        Route::get('/edit/{id}', 'QuestionController@edit');
    });


    Route::group(['prefix' => '/quiz'], function () {
        Route::get('/get_subjects/{quiz_id}', 'QuizQuestionController@get_subjects');
        Route::get('/get_questions/{quiz_id}/{chapter_id}','QuizQuestionController@get_questions');
        Route::post('/add_remove_ques/{quiz_id}/{question_id}','QuizQuestionController@attach_detach');
    });

});


Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});
