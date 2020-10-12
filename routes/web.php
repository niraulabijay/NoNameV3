<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/create-super/{email}','authentication\RegistrationController@createAdmin');

Route::get('/', function () {
    return view('frontPage');
});

Route::group([
    'middleware' => 'visitor'
], function () {
    Route::get('/register', 'authentication\RegistrationController@register')->name('register');
//    Route::get('/admin/login','front\FrontController@admin_login')->name('admin_login');
    Route::get('/admin/login', 'authentication\LogController@login')->name('admin_login');
    Route::get('/login', 'authentication\LogController@login')->name('login');
    Route::get('/forgot_password','authentication\ForgotPasswordController@forgot_password')->name('forgot_password');
    Route::POST('/post_forgot_password','authentication\ForgotPasswordController@post_forgot_password')->name('post_forgot_password');

    //activation
    Route::get('/activate/{email}/{activationCode}','authentication\ActivationController@activate');

    Route::post('/store', 'authentication\RegistrationController@store')->name('register_user');

    //forgot_password
    Route::get('/reset_password/{email}/{code}','authentication\ForgotPasswordController@reset');
    Route::post('/reset_password/{email}/{code}','authentication\ForgotPasswordController@post_reset')->name('post_password_reset');

});
//Authentication
Route::post('/logout', 'authentication\LogController@logout')->name('logout');
Route::post('/login/check', 'authentication\LogController@check')->name('login_check');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//
//Route::get('/', function (){
//    \Artisan::call('cache:clear');
//    return view('admin.index');
//});

Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    'namespace'=>'admin'
], function (){

    Route::get('/quiz','QuizController@index')->name('quiz');

    Route::post('/store/quiz', 'QuizController@store')->name('store.quiz');

    Route::get('/json/quiz', 'QuizController@getJson')->name('json.quiz');
    Route::get('/edit/quiz/{id}', 'QuizController@edit')->name('edit.quiz');
    Route::post('/update/quiz', 'QuizController@update')->name('update.quiz');
    Route::get('/delete/quiz/{id}', 'QuizController@destroy')->name('delete.quiz');
    Route::get('/changestatus/quiz/{id}', 'QuizController@changeStatus')->name('changestatus.quiz');

    Route::get('/user', 'UserController@index')->name('user');
    Route::post('/store/user', 'UserController@store')->name('store.user');
    Route::get('/json/user', 'UserController@getJson')->name('json.user');
    Route::get('/edit/user/{id}', 'UserController@edit')->name('edit.user');
    Route::get('/changestatus/user/{id}', 'UserController@changeStatus')->name('changestatus.user');
    Route::get('/add/userinfo/{id}', 'UserController@addUserInfo')->name('add.userinfo');
    Route::post('/store/userinfo', 'UserController@storeUserInfo')->name('store.userinfo');
    Route::post('/update/user', 'UserController@update')->name('update.user');
    Route::get('/delete/user/{id}', 'UserController@destroy')->name('delete.user');


//    user view route
    Route::get('/view/user/{id}', 'UserController@viewUser')->name('view.user');


    Route::get('/note', 'NoteController@index')->name('note');
    Route::post('/store/note', 'NoteController@store')->name('store.note');
    Route::get('/json/note', 'NoteController@getJson')->name('json.note');
    Route::get('/edit/note/{id}', 'NoteController@edit')->name('edit.note');
    Route::get('/changestatus/note/{id}', 'NoteController@changeStatus')->name('changestatus.note');
    Route::post('/update/note', 'NoteController@update')->name('update.note');
    Route::get('/delete/note/{id}', 'NoteController@destroy')->name('delete.note');


    Route::get('/flashcard', 'FlashCardController@index')->name('flashcard');
    Route::post('/store/flashcard', 'FlashCardController@store')->name('store.flashcard');
    Route::get('/json/flashcard', 'FlashCardController@getJson')->name('json.flashcard');
    Route::get('/edit/flashcard/{id}', 'FlashCardController@edit')->name('edit.flashcard');
    Route::get('/changestatus/flashcard/{id}', 'FlashCardController@changeStatus')->name('changestatus.flashcard');
    Route::post('/update/flashcard', 'FlashCardController@update')->name('update.flashcard');
    Route::get('/delete/flashcard/{id}', 'FlashCardController@destroy')->name('delete.flashcard');


    Route::get('/questionset', 'QuestionSetController@index')->name('questionset');
    Route::post('/store/questionset', 'QuestionSetController@store')->name('store.questionset');
    Route::get('/json/questionset', 'QuestionSetController@getJson')->name('json.questionset');
    Route::get('/edit/questionset/{id}', 'QuestionSetController@edit')->name('edit.questionset');
    Route::get('/changestatus/questionset/{id}', 'QuestionSetController@changeStatus')->name('changestatus.questionset');
    Route::post('/update/questionset', 'QuestionSetController@update')->name('update.questionset');
    Route::get('/delete/questionset/{id}', 'QuestionSetController@destroy')->name('delete.questionset');



//    select class,chapter,subject, in gobal controller

    Route::get('/change/notecontent/', 'GobalController@changeNoteContent')->name('change.notecontent');
    Route::get('/change/flashcardcontent/', 'GobalController@changeFlashCardContent')->name('change.flashcardcontent');
    Route::get('/change/questionsetcontent/', 'GobalController@changeFlashCardContent')->name('change.questionsetcontent');
    Route::get('/change/syllabuscontent/', 'GobalController@changeSyllabusContent')->name('change.syllabuscontent');
    Route::get('/change/questioncontent/', 'GobalController@changeQuestionContent')->name('change.questioncontent');

//push notification

    Route::get('/notification/', 'NotificationController@index')->name('notification');
    Route::post('/store/notification', 'NotificationController@store')->name('store.notification');
    Route::get('/json/notification', 'NotificationController@getJson')->name('json.notification');
    Route::get('/edit/notification/{id}', 'NotificationController@edit')->name('edit.notification');
    Route::post('/update/notification', 'NotificationController@update')->name('update.notification');
    Route::get('/delete/notification/{id}', 'NotificationController@destroy')->name('delete.notification');




    Route::get('/dashboard','DashboardController@index')->name('dashboard');

    Route::group(['prefix' => '/categories'], function (){
        Route::get('/','CategoryController@index')->name('categories');
        Route::post('/store','CategoryController@store')->name('store_categories');
        Route::post('/edit/{id}','CategoryController@update')->name('update_categories');
    });

    Route::group(['prefix' => '/courses'], function (){
        Route::get('/','CourseController@index')->name('courses');
        Route::post('/store_class','CourseController@store_class')->name('store_class');
        Route::post('/store_prep','CourseController@store_preparation')->name('store_preparation');
        Route::post('/destroy','CourseController@destroy')->name('destroy_course');
        Route::post('/edit_class/{id}','CourseController@update_class')->name('update_class');
        Route::post('/edit_prep/{id}','CourseController@update_preparation')->name('update_preparation');
    });

    Route::group(['prefix' => '/subjects'], function (){
        Route::get('/','SubjectController@index')->name('subjects');
        Route::post('/store','SubjectController@store')->name('store_subject');
        Route::post('/destroy','SubjectController@destroy')->name('destroy_subject');
        Route::post('/edit/{id}','SubjectController@update')->name('update_subject');
        Route::get('/change_boolean/{subject_id}/{type}','SubjectController@change_boolean')->name('change_subject_boolean');
    });

    Route::group(['prefix' => '/chapters'], function (){
        Route::get('/','ChapterController@index')->name('chapters');
        Route::post('/store','ChapterController@store')->name('store_chapter');
        Route::post('/destroy','ChapterController@destroy')->name('destroy_chapters');
        Route::post('/edit/{id}','ChapterController@update')->name('update_chapter');

        //new added
        Route::get('/assign_marks/{id}','ChapterController@assign')->name('assign_marks');
        Route::post('/assign_marks/{id}','ChapterController@assign_weightage')->name('post_assign_marks');
    });

    Route::group(['prefix' => '/questions'], function () {
        Route::get('/','QuestionController@index')->name('questions');
        Route::get('/add','QuestionController@add')->name('add_question');
        Route::post('/store','QuestionController@store')->name('store_question');
        Route::get('/edit/{id}','QuestionController@edit')->name('edit_question');
        Route::post('/update/{id}','QuestionController@update')->name('update_question');
        Route::post('/delete/','QuestionController@delete')->name('question_delete');
    });

    Route::group(['prefix' => '/syllabus'], function (){
        Route::get('/','SyllabusController@index')->name('syllabi');
        Route::post('/store/syllabus', 'SyllabusController@store')->name('store.syllabus');
        Route::get('/json/syllabus', 'SyllabusController@getJson')->name('json.syllabus');
        Route::get('/edit/syllabus/{id}', 'SyllabusController@edit')->name('edit.syllabus');
        Route::get('/changestatus/syllabus/{id}', 'SyllabusController@changeStatus')->name('changestatus.syllabus');
        Route::post('/update/syllabus', 'SyllabusController@update')->name('update.syllabus');
        Route::get('/delete/syllabus/{id}', 'SyllabusController@destroy')->name('delete.syllabus');
    });

    Route::get('/quiz/assign_questions/{id}','QuizQuestionController@assign')->name('question_assign');

    Route::group(['prefix' => '/examiner'], function (){
        Route::get('/','ExaminerController@index')->name('examiner');
        Route::get('/changeStatus/{user_id}','ExaminerController@changeStatus')->name('examinerStatus');
    });

});

// EXCEL file add question routes
Route::get('/importExcel',function(){
    return view('admin.questions.upload_test');
})->name('excel');
Route::post('/importExcel/upload','admin\DashboardController@importExcel')->name('importExcel');

Route::post('/getTableData','admin\DashboardController@getTableData')->name('getTableData');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//Teacher Routes

Route::group([
    'prefix' => '/examiner',
    'as' => 'examiner.',
    'namespace'=>'examiner',
    'middleware' => 'teacher',
], function () {
    Route::get('/','IndexController@dashboard')->name('dashboard');
    Route::get('/profile','IndexController@profile')->name('profile');

    Route::get('/quiz','QuizController@index')->name('quiz');
    Route::get('/json/quiz', 'QuizController@getJson')->name('json.examinerQuiz');
    Route::get('/change/quizContent', 'QuizController@changeQuizContent')->name('change.examinerQuizContent');
    Route::post('/store/quiz', 'QuizController@store')->name('store.quiz');
    Route::get('/edit/quiz/{id}', 'QuizController@edit')->name('edit.quiz');
    Route::post('/update/quiz', 'QuizController@update')->name('update.quiz');
    Route::get('/delete/quiz/{id}', 'QuizController@destroy')->name('delete.quiz');
    Route::get('/changestatus/quiz/{id}', 'QuizController@changeStatus')->name('changestatus.quiz');

    Route::get('/quiz/questionAssign/{id}', 'ExaminerQuestionController@questionAssign')->name('quiz.question_assign');
    Route::get('/quiz/questionAdd/{id}', 'ExaminerQuestionController@addQuestion')->name('quiz.add_question');
    Route::post('/quiz/questionAdd/{id}', 'ExaminerQuestionController@storeQuestion')->name('quiz.store_question');
    Route::get('/json/examiner/quiz/questions/{id}', 'ExaminerQuestionController@getJson')->name('json.ExaminerQuizQuestions');

});
Route::get('/examiner/inactive','examiner\IndexController@inactive')->name('examiner.in_active');
