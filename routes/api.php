<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function PHPSTORM_META\map;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/admin', [\App\Http\Controllers\Admin\AuthAdminController::class, 'login']);

Route::prefix('general')->group(function () {
    Route::post('/login', [\App\Http\Controllers\General\LoginController::class, 'login']);
    Route::get('/allSeed', [\App\Http\Controllers\General\GetAllSeedController::class, 'getAllSeed']);
});

Route::prefix('AcademicYear')->group(function () {
    Route::get('all', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'index']);
    Route::post('add', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'store']);
    Route::put('update/{yearId}', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'update']);
    Route::delete('delete/{yearId}', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'destroy']);
});

Route::prefix('student')->group(function () {
    Route::get('all', [\App\Http\Controllers\Student\AddStudentController::class, 'index']);
    Route::post('add', [\App\Http\Controllers\Student\AddStudentController::class, 'store']);
    Route::put('edit/{student}', [\App\Http\Controllers\Student\AddStudentController::class, 'update']);
    Route::get('show/{student}', [\App\Http\Controllers\Student\AddStudentController::class, 'show']);
    Route::delete('delete/{student}', [\App\Http\Controllers\Student\AddStudentController::class, 'destroy']);
});

Route::prefix('parent')->group(function () {
    Route::put('edit/{parent}', [\App\Http\Controllers\Parent\ParentController::class, 'update']);
    Route::delete('delete/{parent}', [\App\Http\Controllers\Parent\ParentController::class, 'destroy']);
});

Route::prefix('mentor')->group(function () {
    Route::get('all', [\App\Http\Controllers\Mentor\MentorController::class, 'index']);
    Route::post('add', [\App\Http\Controllers\Mentor\MentorController::class, 'store']);
    Route::put('edit/{mentor}', [\App\Http\Controllers\Mentor\MentorController::class, 'update']);
    Route::get('show/{mentor}', [\App\Http\Controllers\Mentor\MentorController::class, 'show']);
    Route::delete('delete/{mentor}', [\App\Http\Controllers\Mentor\MentorController::class, 'destroy']);
});

Route::prefix('quiz')->group(function () {
    Route::get('all', [\App\Http\Controllers\Quiz\QuizController::class, 'index']);
    Route::get('mark-ladder/{quiz}', [\App\Http\Controllers\Quiz\QuizController::class, 'markLadder']);
    Route::post('add', [\App\Http\Controllers\Quiz\QuizController::class, 'store']);
    Route::post('checkAnswer', [\App\Http\Controllers\Quiz\QuizController::class, 'checkAnswer']);
    Route::put('edit/{quiz}', [\App\Http\Controllers\Quiz\QuizController::class, 'update']);
    Route::get('show/{quiz}', [\App\Http\Controllers\Quiz\QuizController::class, 'show']);
    Route::delete('delete/{quiz}', [\App\Http\Controllers\Quiz\QuizController::class, 'destroy']);
});

Route::prefix('exam')->group(function () {
    Route::get('all', [\App\Http\Controllers\Exam\ExamController::class, 'index']);
    Route::post('add', [\App\Http\Controllers\Exam\ExamController::class, 'store']);
    Route::put('edit/{exam}', [\App\Http\Controllers\Exam\ExamController::class, 'update']);
    Route::get('show/{exam}', [\App\Http\Controllers\Exam\ExamController::class, 'show']);
    Route::delete('delete/{exam}', [\App\Http\Controllers\Exam\ExamController::class, 'destroy']);
    Route::post('mark/{exam}/{student}', [\App\Http\Controllers\Exam\ExamController::class, 'studentMark']);

});

Route::prefix('question')->group(function () {
    Route::get('all', [\App\Http\Controllers\Exam\QuestionController::class, 'index']);
    Route::post('add', [\App\Http\Controllers\Exam\QuestionController::class, 'store']);
    Route::put('edit/{question}', [\App\Http\Controllers\Exam\QuestionController::class, 'update']);
    // Route::get('show/{question}', [\App\Http\Controllers\Exam\ExamController::class, 'show']);
    Route::delete('delete/{question}', [\App\Http\Controllers\Exam\QuestionController::class, 'destroy']);
});

Route::prefix('choice')->group(function () {
    Route::get('all', [\App\Http\Controllers\Exam\ChoiseController::class, 'index']);
    Route::post('add/{question}', [\App\Http\Controllers\Exam\ChoiseController::class, 'store']);
    Route::put('edit/{choice}', [\App\Http\Controllers\Exam\ChoiseController::class, 'update']);
    // Route::get('show/{question}', [\App\Http\Controllers\Exam\ExamController::class, 'show']);
    Route::delete('delete/{choice}', [\App\Http\Controllers\Exam\ChoiseController::class, 'destroy']);
});

Route::prefix('teacher')->group(function () {
    Route::get('all', [\App\Http\Controllers\Teacher\TeacherController::class, 'index']);
    Route::post('add', [\App\Http\Controllers\Teacher\TeacherController::class, 'store']);
    Route::put('edit/{teacher}', [\App\Http\Controllers\Teacher\TeacherController::class, 'update']);
    Route::get('show/{teacher}', [\App\Http\Controllers\Teacher\TeacherController::class, 'show']);
    Route::delete('delete/{teacher}', [\App\Http\Controllers\Teacher\TeacherController::class, 'destroy']);
});

Route::prefix('subject')->group(function () {
    Route::get('all', [\App\Http\Controllers\Subject\SubjectController::class, 'index']);
    Route::post('add', [\App\Http\Controllers\Subject\SubjectController::class, 'store']);
    Route::put('edit/{subject}', [\App\Http\Controllers\Subject\SubjectController::class, 'update']);
    Route::delete('delete/{subject}', [\App\Http\Controllers\Subject\SubjectController::class, 'destroy']);
});

Route::prefix('classroom')->group(function () {
    Route::get('all', [\App\Http\Controllers\Classroom\ClassroomController::class, 'index']);
    Route::post('add', [\App\Http\Controllers\Classroom\ClassroomController::class, 'store']);
    Route::put('edit/{classroom}', [\App\Http\Controllers\Classroom\ClassroomController::class, 'update']);
    Route::delete('delete/{classroom}', [\App\Http\Controllers\Classroom\ClassroomController::class, 'destroy']);
});

Route::prefix('syllabi')->group(function () {
    Route::get('all', [\App\Http\Controllers\syllabi\syllabiController::class, 'index']);
    Route::post('add', [\App\Http\Controllers\syllabi\syllabiController::class, 'store']);
    Route::put('edit/{syllabi}', [\App\Http\Controllers\syllabi\syllabiController::class, 'update']);
    Route::delete('delete/{syllabi}', [\App\Http\Controllers\syllabi\syllabiController::class, 'destroy']);
});
Route::prefix('management')->group(function(){
    Route::put('add/lessons/{day}', [\App\Http\Controllers\General\ManagementController::class, 'addLessonsToDays']);
    Route::put('add/ClassroomToClass/{claass}', [\App\Http\Controllers\General\ManagementController::class, 'addClassroomToClass']);
    Route::put('add/classroom/{teacher}', [\App\Http\Controllers\General\ManagementController::class, 'addClassroomToTeacher']);
    Route::post('customizeTeachForClassroom', [\App\Http\Controllers\General\ManagementController::class, 'customizeTeachForClassroom']);
    Route::put('add/subject/{teacher}', [\App\Http\Controllers\General\ManagementController::class, 'addSubjectToTeacher']);
    Route::post('subject/{class}', [\App\Http\Controllers\General\ManagementController::class, 'addSubjectToClass']);

});


Route::prefix('resultant')->group(function () {
    Route::get('/{student}', [\App\Http\Controllers\Resultant\ResultantController::class, 'resultantStudent']);
});



Route::get('all', [\App\Http\Controllers\TimeTableController::class, 'index']);
Route::get('all/{grade}/{day}/{lesson}', [\App\Http\Controllers\TimeTableController::class, 'show']);
Route::get('alissar/{exam}', [\App\Http\Controllers\Exam\ExamController::class, 'mark_ladder']);



Route::prefix('mobile')->group(function () {
    Route::get('teacherWithSubjects/{teacher}', [\App\Http\Controllers\Teacher\TeacherController::class, 'getTeacherWithSubjects']);
});


Route::get('test', [\App\Http\Controllers\General\ManagementController::class, 'test']);

//Route::post('test/{teacher}', [\App\Http\Controllers\General\ManagementController::class, 'addSubjectToTeacher']);

Route::prefix('season')->group(function(){
Route::post('add', [\App\Http\Controllers\SeasonController::class, 'store']);
Route::get('all', [\App\Http\Controllers\SeasonController::class, 'index']);
Route::get('show/{season}', [\App\Http\Controllers\SeasonController::class, 'show']);
Route::put('edit/{season}', [\App\Http\Controllers\SeasonController::class, 'update']);
});


