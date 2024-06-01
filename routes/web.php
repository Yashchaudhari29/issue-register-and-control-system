<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\omController;
use App\Http\Controllers\siController;
use App\Http\Controllers\imController;
use App\Http\Controllers\dashController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\showController;


Route::get('/', [LoginController::class, 'index'])->name('login.index');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['role:om']], function () {
    Route::get('/om', [omController::class, 'om'])->name('om.page');
    Route::get('/om_list', [omController::class, 'om_list'])->name('om.list');
    Route::post('/close-issue/om/{IssueId}', [omController::class, 'closeIssue'])->name('close.om'); 
});

Route::group(['middleware' => ['role:im']], function () {
    Route::get('/im', [imController::class, 'im'])->name('im.page'); 
    Route::get('/im_form', [imController::class, 'im_form'])->name('im.form'); 
    Route::get('/im_list', [imController::class, 'im_list'])->name('im.list'); 
    Route::post('/close-issue/im/{IssueId}', [imController::class, 'closeIssue'])->name('close.im'); 
    Route::post('/im_update', [imController::class,'update'])->name('update.contact');
});

Route::group(['middleware' => ['role:si']], function () {
    Route::get('/si', [siController::class, 'si'])->name('si.dashboard');
    Route::get('/si_list', [siController::class, 'si_list'])->name('si.issue.list');
    Route::get('/si_issues_form', [LoginController::class, 'issuesForm'])->name('user.issues.form');
    Route::post('/close-issue/si/{IssueId}', [siController::class, 'closeIssue'])->name('close.si'); 
    // Route::post('/si_list', [loginController::class, 'submitIssues'])->name('submitIssues');
});

Route::get('/issue_form', [omController::class, 'om_issue_form'])->name('om.list.form');
Route::post('/isuue_form_post',[omController::class,'submit_issue'])->name('issue.submit');


Route::get('/demo/{name}/{id?}', function ($name, $id = null) {
    $data = compact('name', 'id');
    return view('demo')->with($data);
});

Route::get('/issues_details/{IssueId}', [showController::class, 'showDetails'])->name('user.issues.show_details');
Route::get('/allcontacts', [dashController::class, 'dashContactList'])->name('dashContactList');
Route::get('/dash', [dashController::class, 'dash'])->name('dash');
Route::get('/dashlist', [dashController::class, 'dashlist'])->name('dashlist');
Route::get('/dashlist/dashform', [dashController::class, 'dashform'])->name('dashform');