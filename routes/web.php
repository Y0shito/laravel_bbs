<?php

declare(strict_types=1);

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ArticleCreateController;
use App\Http\Controllers\ArticleEditController;
use App\Http\Controllers\ArticleEditPreviewController;
use App\Http\Controllers\ArticlePreviewController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('index', [IndexController::class, 'showIndex'])->name('index');

// Twitterログイン
Route::get('twitter-login', [UserController::class, 'login'])->name('twitter-login');
Route::get('callback', [UserController::class, 'callback']);
Route::get('twitter-logout', [UserController::class, 'logout'])->name('twitter-logout');

Route::get('articles/{id}', [ArticlesController::class, 'showArticles'])->name('articles');

Route::group(['prefix' => 'article', 'middleware' => 'auth'], function () {
    //新規作成周り
    route::get('create', [ArticleCreateController::class, 'showArticleCreate'])->name('create');
    route::get('preview', [ArticlePreviewController::class, 'showArticlePreview']);
    route::post('preview', [ArticleCreateController::class, 'previewFromCreate'])->name('preview');
    route::post('draft', [ArticlePreviewController::class, 'draft'])->name('draft');
    route::post('completion', [ArticlePreviewController::class, 'completion'])->name('completion');

    //記事編集周り
    route::get('edit', [ArticleEditController::class, 'showArticleEdit']); //バリデート失敗時必要
    route::post('edit', [ArticleEditController::class, 'showArticleEdit'])->name('edit');
    route::get('edit-preview', [ArticleEditPreviewController::class, 'showEditPreview'])->name('editPreview');
    route::post('edit-preview', [ArticleEditController::class, 'previewFromEdit']);
    route::post('edit-draft', [ArticleEditPreviewController::class, 'editedArticleDraft'])->name('editDraft');
    route::post('update', [ArticleEditPreviewController::class, 'articleUpdate'])->name('update');
});

Route::group(['prefix' => 'mypage', 'middleware' => 'auth'], function () {
    route::get('/', [MypageController::class, 'showMypage'])->name('mypage');

    route::post('status-open', [MypageController::class, 'statusOpen'])->name('articleOpen');
    route::post('status-close', [MypageController::class, 'statusClose'])->name('articleClose');
    route::post('article-edit', [MypageController::class, ''])->name('articleEdit');
    route::post('article-delete', [MypageController::class, 'articleDelete'])->name('articleDelete');
});
