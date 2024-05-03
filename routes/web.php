<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\GradeBookController as AdminGradeBookController;
use App\Http\Controllers\Admin\BookChapterController as AdminBookChapterController;
use App\Http\Controllers\Admin\GradeBookChapterController as AdminGradeBookChapterController;
use App\Http\Controllers\Admin\ChapterQuestionController as AdminChapterQuestionController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Collaborator\ApprovalController;
use App\Http\Controllers\Collaborator\DashboardController as CollaboratorDashboardController;
use App\Http\Controllers\Collaborator\PaperController;
use App\Http\Controllers\Collaborator\PaperGradeBookChapterController;
use App\Http\Controllers\Operator\BookChapterController;
use App\Http\Controllers\Operator\ChapterQuestionController;
use App\Http\Controllers\Operator\GradeBookChapterController;
use App\Http\Controllers\Operator\GradeBookController;
use App\Http\Controllers\OnlineQuizzes\SelfTestController;
use App\Http\Controllers\Operator\DashboardController as OperatorDashboardController;
use App\Http\Middleware\CheckSessionExpiry;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(session('role'));
    } else {
        return view('index');
    }
});


Route::view('about', 'about');
Route::view('services', 'services');
Route::view('team', 'team');
Route::view('blogs', 'blogs');
Route::view('login', 'login');

Route::get('login/as', function () {
    $year = date('Y');
    return view('login_as', compact('year'));
});

Route::post('login', [AuthController::class, 'login']);
Route::post('login/as', [AuthController::class, 'loginAs'])->name('login.as');
Route::get('signout', [AuthController::class, 'signout'])->name('signout');

Route::resource('passwords', PasswordController::class);

Route::resource('self-tests', SelfTestController::class);
Route::get('fetchSubTypesByTypeId', [AjaxController::class, 'fetchSubTypesByTypeId']);
Route::get('findSimilarQuestions', [AjaxController::class, 'findSimilarQuestions']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin']], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('users', UserController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('grade.books', AdminGradeBookController::class);
    Route::resource('book.chapters', AdminBookChapterController::class);
    Route::resource('chapter.questions', AdminChapterQuestionController::class);
    Route::resource('grade.book.chapters', AdminGradeBookChapterController::class);
    Route::view('change/password', 'admin.change_password');
    Route::post('change/password', [AuthController::class, 'changePassword'])->name('change.password');
});

Route::group(['prefix' => 'collaborator', 'as' => 'collaborator.', 'middleware' => ['role:collaborator']], function () {
    Route::get('/', [CollaboratorDashboardController::class, 'index']);
    Route::resource('approvals', ApprovalController::class);
    Route::resource('papers', PaperController::class);
    Route::resource('grade.book.chapters', PaperGradeBookChapterController::class);
});
Route::group(['prefix' => 'operator', 'as' => 'operator.', 'middleware' => ['role:operator']], function () {
    Route::get('/', [OperatorDashboardController::class, 'index']);
    Route::resource('grade.books', GradeBookController::class);
    Route::resource('book.chapters', BookChapterController::class);
    Route::resource('grade.book.chapters', GradeBookChapterController::class);
    Route::resource('chapter.questions', ChapterQuestionController::class);
});
