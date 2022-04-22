<?php

declare(strict_types=1);

use App\Http\Controllers\ArticleCreateController;
use App\Http\Controllers\ArticleEditController;
use App\Http\Controllers\ArticleEditPreviewController;
use App\Http\Controllers\ArticlePreviewController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserBookmarksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFollowerController;
use App\Http\Controllers\UserFollowingController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\UserSettingController;
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

Route::get('search', [SearchController::class, 'showSearch'])->name('search');

Route::group(['prefix' => 'article', 'middleware' => 'auth'], function () {
    //新規作成周り
    route::get('create', [ArticleCreateController::class, 'showArticleCreate'])->name('create');
    route::post('toPreview', [ArticleCreateController::class, 'previewFromCreate'])->name('toPreview');
    route::get('preview', [ArticlePreviewController::class, 'showPreviewPage'])->name('preview');
    route::post('draft', [ArticlePreviewController::class, 'draft'])->name('draft');
    route::post('completion', [ArticlePreviewController::class, 'completion'])->name('completion');

    //記事編集周り
    route::get('edit', [ArticleEditController::class, 'showArticleEdit']); //バリデート失敗時必要
    route::post('edit', [ArticleEditController::class, 'showArticleEdit'])->name('edit');
    route::post('edit-preview', [ArticleEditController::class, 'previewFromEdit'])->name('editPreview');
    route::post('edit-draft', [ArticleEditPreviewController::class, 'editedArticleDraft'])->name('editDraft');
    route::post('update', [ArticleEditPreviewController::class, 'articleUpdate'])->name('update');
});

Route::prefix('bookmark')->group(function () {
    route::post('add', [BookmarkController::class, 'add'])->name('bookmarkAdd');
    route::post('remove', [BookmarkController::class, 'remove'])->name('bookmarkRemove');
});

route::get('user/{id}', [UserPageController::class, 'showUserpage'])->name('userpage');
route::get('user/{id}/bookmarks', [UserBookmarksController::class, 'showUserBookmarks'])->name('userBookmarks');
route::get('user/{id}/followings', [UserFollowingController::class, 'showFollowingPage'])->name('userFollowing');
route::get('user/{id}/followers', [UserFollowerController::class, 'showFollowersPage'])->name('userFollowers');
route::get('user/{id}/settings', [UserSettingController::class, 'showSettings'])->middleware('auth')->name('userSettings');
route::post('user/{id}/settings', [UserSettingController::class, 'updateSettings'])->middleware('auth')->name('updateSettings');

route::post('status-open', [UserPageController::class, 'statusOpen'])->name('articleOpen');
route::post('status-close', [UserPageController::class, 'statusClose'])->name('articleClose');
route::post('article-delete', [UserPageController::class, 'articleDelete'])->name('articleDelete');

route::post('follow', [FollowController::class, 'follow'])->middleware('auth')->name('follow');
route::post('unfollow', [FollowController::class, 'unfollow'])->middleware('auth')->name('unfollow');
