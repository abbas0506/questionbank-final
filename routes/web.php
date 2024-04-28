<?php

use App\Http\Controllers\Administration\AdminController;
use App\Http\Controllers\Administration\Data\BookController;
use App\Http\Controllers\Administration\Data\ChapterController;
use App\Http\Controllers\Administration\Data\DataManagementController;
use App\Http\Controllers\Administration\Data\GradeController;
use App\Http\Controllers\Administration\Data\QuestionController;
use App\Http\Controllers\Administration\Data\QuestionSearchController;
use App\Http\Controllers\Administration\Data\SubjectController;
use App\Http\Controllers\Administration\Users\UserManagementController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Collaboration\CollaborationController;
use App\Http\Controllers\Collaboration\CollaboratorController;
use App\Http\Controllers\DataEntry\BookChapterController;
use App\Http\Controllers\DataEntry\ChapterQuestionController;
use App\Http\Controllers\DataEntry\DataEntryController;
use App\Http\Controllers\DataEntry\GradeBookChapterController;
use App\Http\Controllers\DataEntry\GradeBookController;
use App\Http\Controllers\OnlineQuizzes\SelfTestController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:admin']], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::resource('users', UserManagementController::class);
    Route::resource('data', DataManagementController::class)->only('index');
    Route::resource('grades', GradeController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('books', BookController::class);
    Route::resource('book.chapters', ChapterController::class);
    Route::resource('question-search', QuestionSearchController::class);
    Route::resource('book.chapter.questions', QuestionController::class);
    Route::resource('questions', QuestionController::class);

    Route::view('change/password', 'admin.change_password');
    Route::post('change/password', [AuthController::class, 'changePassword'])->name('change.password');
});

Route::group(['prefix' => 'collaborator', 'as' => 'collaborator.', 'middleware' => ['role:collaborator']], function () {
    Route::get('/', [CollaboratorController::class, 'index']);
});
Route::group(['prefix' => 'operator', 'as' => 'operator.', 'middleware' => ['role:operator']], function () {
    Route::get('/', [DataEntryController::class, 'index']);
    Route::resource('grade.books', GradeBookController::class);
    Route::resource('book.chapters', BookChapterController::class);
    Route::resource('chapter.questions', ChapterQuestionController::class);
    Route::resource('grade.book.chapters', GradeBookChapterController::class);
    // Route::resource('book.chapter.questions', DataEntryQuestionController::class);

    // Route::resource('grade.book.management', GradeBookController::class);
});
