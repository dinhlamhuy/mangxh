<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MessageGroupController;


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

Auth::routes();
Route::get('/changePassword',[App\Http\Controllers\HomeController::class, 'showChangePasswordForm'])->name('showChangePasswordForm');
Route::post('/doimkusr',[App\Http\Controllers\HomeController::class, 'doimkusr']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/saved', [App\Http\Controllers\HomeController::class, 'saved'])->name('saved');
Route::post('/savedpost', [App\Http\Controllers\HomeController::class, 'savedpost']);
Route::post('/cancelpost', [App\Http\Controllers\HomeController::class, 'cancelpost']);
Route::get('/searchfriend', [App\Http\Controllers\HomeController::class, 'searchfriend'])->name('searchfriend');
Route::post('/release_emotions', [App\Http\Controllers\HomeController::class, 'release_emotions']);
Route::get('/posts/{id}', [App\Http\Controllers\HomeController::class, 'posts'])->name('posts');
Route::post('/editpost', [App\Http\Controllers\UploadPostController::class, 'editpost']);
Route::post('/upload', [App\Http\Controllers\UploadPostController::class, 'store'])->name('upload');
Route::post('/comment', [App\Http\Controllers\UploadPostController::class, 'comment']);
Route::get('/friends', [App\Http\Controllers\FriendController::class, 'index'])->name('friends');
Route::get('/friends_around', [App\Http\Controllers\FriendController::class, 'timquanhday'])->name('friends_around');
Route::post('/nearby_friends', [App\Http\Controllers\FriendController::class, 'nearby_friends']);
Route::post('/load_friend', [App\Http\Controllers\FriendController::class, 'load_friend']);
Route::post('/invitations', [App\Http\Controllers\FriendController::class, 'invitations']);
Route::post('/send_invitations', [App\Http\Controllers\FriendController::class, 'send_invitations']);
Route::post('/huykb', [App\Http\Controllers\FriendController::class, 'huykb']);
Route::post('/uploadavatar', [App\Http\Controllers\PersonalPageController::class, 'uploadavatar'])->name('uploadavatar');
Route::get('/watch', [App\Http\Controllers\VideoPostController::class, 'index'])->name('watch');
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat');
Route::get('/conversation/{userID}', [App\Http\Controllers\MessageController::class, 'conversation'])->name('message.conversation');

// TRANG CÁ NHÂN
Route::get('/profile/{id}', [App\Http\Controllers\PersonalPageController::class, 'index'])->name('profile');
Route::post('/profile/edit', [App\Http\Controllers\PersonalPageController::class, 'editprofile']);
Route::get('/profile/{id}/about', [App\Http\Controllers\PersonalPageController::class, 'profile']);
Route::get('/profile/{id}/friend', [App\Http\Controllers\PersonalPageController::class, 'profile_friend']);

//CHAT
Route::post('search-chat',[App\Http\Controllers\ChatController::class,'search_chat'])->name('search-chat');
Route::post('send-message',[App\Http\Controllers\MessageController::class,'sendMessage'])->name('message.send-message');
Route::post('send-group-message',[App\Http\Controllers\MessageController::class,'sendGroupMessage'])->name('message.send-group-message');
Route::resource('message-group', MessageGroupController::class);

//GROUP
Route::get('/groups/create', [App\Http\Controllers\GroupController::class, 'group'])->name('group');
Route::get('/groups/feed', [App\Http\Controllers\GroupController::class, 'feed_group'])->name('feed_group');
Route::get('/groups/loimoigroup', [App\Http\Controllers\GroupController::class, 'loimoigroup'])->name('loimoigroup');
Route::get('/groups/{id}', [App\Http\Controllers\GroupController::class, 'page_group'])->name('page_group');
Route::get('/groups/{id}/about', [App\Http\Controllers\GroupController::class, 'about_group'])->name('about_group');
Route::get('/groups/{id}/gmember', [App\Http\Controllers\GroupController::class, 'gmember'])->name('gmember');
Route::post('/groups/create-group', [App\Http\Controllers\GroupController::class, 'create_group']);
Route::post('/groups/adduser_group', [App\Http\Controllers\GroupController::class, 'adduser_group']);
Route::post('/groups/roinhom', [App\Http\Controllers\GroupController::class, 'roinhom']);
Route::get('/groups/{id}/dskiemduyet', [App\Http\Controllers\GroupController::class, 'dskiemduyet']);

Route::post('/groups/uploadimggroup', [App\Http\Controllers\GroupController::class, 'uploadimggroup']);
Route::post('/groups/duyettv', [App\Http\Controllers\GroupController::class, 'duyettv']);
Route::post('/groups/moivaogroup', [App\Http\Controllers\GroupController::class, 'moivaogroup']);
Route::post('/groups/nhanloimoi', [App\Http\Controllers\GroupController::class, 'nhanloimoi']);
Route::post('/groups/huyloimoi', [App\Http\Controllers\GroupController::class, 'huyloimoi']);

// CÔNG VIỆC
Route::get('/groups/{group_id}/work/{gw_id}', [App\Http\Controllers\GroupWorkController::class, 'detail_group_work'])->name('detail_group_work');
Route::get('/groups/{id}/work', [App\Http\Controllers\GroupWorkController::class, 'group_work'])->name('group_work');
Route::post('/groups/add_work', [App\Http\Controllers\GroupWorkController::class, 'add_work']);
Route::post('/groups/chamdiem', [App\Http\Controllers\GroupWorkController::class, 'chamdiem']);
Route::post('/groups/edit_work', [App\Http\Controllers\GroupWorkController::class, 'edit_work']);
Route::post('/groups/delete_work', [App\Http\Controllers\GroupWorkController::class, 'delete_work']);
Route::post('/groups/upload_submissions', [App\Http\Controllers\GroupWorkController::class, 'upload_submissions']);
Route::post('/groups/edit_submissions', [App\Http\Controllers\GroupWorkController::class, 'edit_submissions']);
Route::post('/groups/delete_submissions', [App\Http\Controllers\GroupWorkController::class, 'delete_submissions']);

//FANPAGES
Route::get('/fanpage/{id}', [App\Http\Controllers\FanpagesController::class, 'fanpages'])->name('fanpages');
Route::get('/fanpages', [App\Http\Controllers\FanpagesController::class, 'feed'])->name('feed');
Route::get('/fanpages/create', [App\Http\Controllers\FanpagesController::class, 'create'])->name('create');
Route::get('/fanpages/loimoi', [App\Http\Controllers\FanpagesController::class, 'loimoi'])->name('loimoi');
Route::get('/fanpage/{school_id}/postchoduyet', [App\Http\Controllers\FanpagesController::class, 'postchoduyet'])->name('postchoduyet');
Route::get('/fanpage/{school_id}/about', [App\Http\Controllers\FanpagesController::class, 'school_about'])->name('school_about');
Route::get('/fanpage/{school_id}/follower', [App\Http\Controllers\FanpagesController::class, 'nguoitheodoi'])->name('nguoitheodoi');
Route::post('/fanpages/follow', [App\Http\Controllers\FanpagesController::class, 'follow']);
Route::post('/fanpages/updateinfo', [App\Http\Controllers\FanpagesController::class, 'updateinfo']);
Route::post('/fanpages/moitheodoitrang', [App\Http\Controllers\FanpagesController::class, 'moibbfollow']);
Route::post('/fanpages/create_fanpages', [App\Http\Controllers\FanpagesController::class, 'create_fanpages'])->name('create_fanpages');
Route::post('fanpages/duyetbai', [App\Http\Controllers\FanpagesController::class, 'duyetbai']);
Route::post('/fanpages/nhanloimoi', [App\Http\Controllers\FanpagesController::class, 'nhanloimoi']);
Route::post('/fanpages/huyloimoi', [App\Http\Controllers\FanpagesController::class, 'huyloimoi']);


//BÁN HÀNG
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('index');
Route::get('/myshop', [App\Http\Controllers\ShopController::class, 'myproduct'])->name('myproduct');
Route::get('/pageshop/{user_id}', [App\Http\Controllers\ShopController::class, 'pageproduct'])->name('pageproduct');
Route::get('/shop/{tag}', [App\Http\Controllers\ShopController::class, 'search'])->name('search');
Route::get('/shop/{tag}/{sp_id}', [App\Http\Controllers\ShopController::class, 'detail'])->name('detail');
Route::post('/shop/add_product', [App\Http\Controllers\ShopController::class, 'add_product']);
Route::post('/shop/edit_product', [App\Http\Controllers\ShopController::class, 'edit_product']);
Route::post('/shop/delete_product', [App\Http\Controllers\ShopController::class, 'delete_product']);


//ADMIN
Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'index']);
Route::get('/admin/adminlogout', [App\Http\Controllers\AdminController::class, 'logout']);
Route::get('/admin/admindoimk', [App\Http\Controllers\AdminController::class, 'admindoimk']);
Route::post('/admin/dangnhapadmin', [App\Http\Controllers\AdminController::class, 'dangnhapadmin']);
Route::post('/admin/doimk', [App\Http\Controllers\AdminController::class, 'doimk']);

Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');

Route::get('/admin/dsbaidang', [App\Http\Controllers\AdminController::class, 'qlbaidang']);
Route::get('/admin/qluser', [App\Http\Controllers\AdminController::class, 'qluser']);
Route::get('/admin/qluserhs', [App\Http\Controllers\AdminController::class, 'qluserhs']);
Route::get('/admin/qlusersv', [App\Http\Controllers\AdminController::class, 'qlusersv']);
Route::get('/admin/qluserkhac', [App\Http\Controllers\AdminController::class, 'qluserkhac']);
Route::get('/admin/school', [App\Http\Controllers\AdminController::class, 'qltrang']);
Route::get('/admin/schoolchoduyet', [App\Http\Controllers\AdminController::class, 'qltrangchoduyet']);
Route::get('/admin/groups', [App\Http\Controllers\AdminController::class, 'dsnhom']);
Route::get('/send-thongbao', [App\Http\Controllers\ThongBaoController::class, 'sendthongbao']);
Route::get('/admin/dsbaidangvipham', [App\Http\Controllers\AdminController::class, 'dsbaidangvipham']);
Route::get('/admin/dsuservipham', [App\Http\Controllers\AdminController::class, 'dsuservipham']);
Route::get('/admin/dsgroupvipham', [App\Http\Controllers\AdminController::class, 'dsgroupvipham']);
Route::get('/admin/dsschoolvipham', [App\Http\Controllers\AdminController::class, 'dsschoolvipham']);

Route::post('/admin/deletepost', [App\Http\Controllers\Admin2Controller::class, 'deletepost']);
Route::post('/admin/deleteuser', [App\Http\Controllers\Admin2Controller::class, 'deleteuser']);
Route::post('/admin/deletegroup', [App\Http\Controllers\Admin2Controller::class, 'deletegroup']);
Route::post('/admin/deleteschool', [App\Http\Controllers\Admin2Controller::class, 'deleteschool']);
Route::post('/admin/duyettrang', [App\Http\Controllers\AdminController::class, 'duyettrang']);
Route::post('/admin/huyduyettrang', [App\Http\Controllers\AdminController::class, 'huyduyettrang']);




// Báo cáo
Route::post('/baocao', [App\Http\Controllers\HomeController::class, 'baocao']);
Route::post('/baocaousr', [App\Http\Controllers\HomeController::class, 'baocaousr']);
Route::post('/baocaogroup', [App\Http\Controllers\HomeController::class, 'baocaogroup']);
Route::post('/baocaoschool', [App\Http\Controllers\HomeController::class, 'baocaoschool']);