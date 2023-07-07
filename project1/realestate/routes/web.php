<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TestimonialsController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\Testimonials;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//
Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [UserController::class, 'Index']);

                                                // Công dụng của  middleware(['auth', 'verified'])
Route::get('/dashboard', function () {      // => khi đã login mà truy cập đường dẫn /login thì nó sẽ điều hướng về /dashboard
    return view('dashboard');               // và khi chưa login mà truy cập các đường link khác thì nó sẽ chuyển đến trang login
})->middleware(['auth', 'verified'])->name('dashboard');


//User Frontend All Route
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');

    Route::get('/user/schedule/request', [UserController::class, 'UserScheduleRequest'])->name('user.schedule.request');

    //User Live Chat All Route
    Route::get('/live/chat', [UserController::class, 'LiveChat'])->name('live.chat');


    //User Wishlist All Route
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/user/wishlist', 'UserWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-property/', 'GetWishlistProperty');
        Route::get('/wishlist-remove/{id}', 'WishlistRemove');
    });


    //User Compare All Route
    Route::controller(CompareController::class)->group(function () {
        Route::get('/user/compare', 'UserCompare')->name('user.compare');
        Route::get('/get-compare-property/', 'GetCompareProperty');
        Route::get('/compare-remove/{id}', 'CompareRemove');

    });



});


require __DIR__ . '/auth.php';


//Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});//End Group Admin Middleware


//Agent Group Middleware
Route::middleware(['auth', 'roles:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('/agent/logout', [AgentController::class, 'AgentLogout'])->name('agent.logout');
    Route::get('/agent/profile', [AgentController::class, 'AgentProfile'])->name('agent.profile');
    Route::post('/agent/profile/store', [AgentController::class, 'AgentProfileStore'])->name('agent.profile.store');
    Route::get('/agent/change/password', [AgentController::class, 'AgentChangePassword'])->name('agent.change.password');
    Route::post('/agent/update/password', [AgentController::class, 'AgentUpdatePassword'])->name('agent.update.password');
});//End Group Agent Middleware


//RedirectIfAuthenticated: kiểm tra quyền để vào trang thích hợp tránh vào trang không có quyền
Route::get('/agent/login', [AgentController::class, 'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register', [AgentController::class, 'AgentRegister'])->name('agent.register')->middleware(RedirectIfAuthenticated::class);
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);



//Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {

    //Property Type All Route
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'AllType')->name('all.type')->middleware('permission:all.type');
        Route::get('/add/type', 'AddType')->name('add.type')->middleware('permission:add.type');
        Route::post('/store/type', 'StoreType')->name('store.type');
        Route::post('/update/type', 'UpdateType')->name('update.type');
        Route::get('/edit/type/{id}', 'EditType')->name('edit.type')->middleware('permission:edit.type');
        Route::get('/delete/type/{id}', 'DeleteType')->name('delete.type')->middleware('permission:delete.type');
    });


    //Amenities Type All Route
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/amenitie', 'AllAmenitie')->name('all.amenitie');
        Route::get('/add/amenitie', 'AddAmenitie')->name('add.amenitie');
        Route::post('/store/amenitie', 'StoreAmenitie')->name('store.amenitie');
        Route::get('/edit/amenitie/{id}', 'EditAmenitie')->name('edit.amenitie');
        Route::post('/update/amenitie', 'UpdateAmenitie')->name('update.amenitie');
        Route::get('/delete/amenitie/{id}', 'DeleteAmenitie')->name('delete.amenitie');
    });


    //Property  All Route
    Route::controller(PropertyController::class)->group(function () {
        Route::get('/all/property', 'AllProperty')->name('all.property');

        Route::get('/add/property', 'AddProperty')->name('add.property');
        Route::post('/store/property', 'StoreProperty')->name('store.property');

        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');

        Route::post('/update/property/thambnail', 'UpdatePropertyThambnail')->name('update.property.thambnail');
        Route::post('/update/property/multiimage', 'UpdatePropertyMultiimage')->name('update.property.multiimage');
        Route::get('/property/multiimg/delete/{id}', 'PropertyMultiImageDelete')->name('property.multiimg.delete');
        Route::post('/store/new/multiimage', 'StoreNewMultiimage')->name('store.new.multiimage');
        Route::post('/update/property/facilities', 'UpdatePropertyFacility')->name('update.property.facilities');

        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');
        Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');

        Route::post('/inactive/property', 'InActiveProperty')->name('inactive.property');
        Route::post('/active/property', 'ActiveProperty')->name('active.property');


        //xem lịch sử và in file PDF
        Route::get('/admin/package/history', 'AdminPackageHistory')->name('admin.package.history');
        Route::get('/admin/package/invoice/{id}', 'AdminPackageInvoice')->name('admin.package.invoice');

        //message
        Route::get('admin/property/message','AdminPropertyMessage')->name('admin.property.message');


    });


    //Agent All Route From Admin
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/agent', 'AllAgent')->name('all.agent');
        Route::get('/add/agent', 'AddAgent')->name('add.agent');
        Route::post('/store/agent', 'StoreAgent')->name('store.agent');
        Route::get('/edit/agent/{id}', 'EditAgent')->name('edit.agent');
        Route::post('/update/agent', 'UpdateAgent')->name('update.agent');
        Route::get('/delete/agent/{id}', 'DeleteAgent')->name('delete.agent');

        Route::get('/changeStatus', 'changeStatus');
    });

    //State All Route
    Route::controller(StateController::class)->group(function () {
        Route::get('/all/state', 'AllState')->name('all.state')->middleware('permission:all.state');
        Route::get('/add/state', 'AddState')->name('add.state')->middleware('permission:add.state');
        Route::post('/store/state', 'StoreState')->name('store.state');
        Route::post('/update/state', 'UpdateState')->name('update.state');
        Route::get('/edit/state/{id}', 'EditState')->name('edit.state')->middleware('permission:edit.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state')->middleware('permission:delete.state');
    });

    //Testimonials All Route
    Route::controller(TestimonialsController::class)->group(function () {
        Route::get('/all/testimonials', 'AllTestimonials')->name('all.testimonials');
        Route::get('/add/testimonials', 'AddTestimonials')->name('add.testimonials');
        Route::post('/store/testimonials', 'StoreTestimonials')->name('store.testimonials');
        Route::post('/update/testimonials', 'UpdateTestimonials')->name('update.testimonials');
        Route::get('/edit/testimonials/{id}', 'EditTestimonials')->name('edit.testimonials');
        Route::get('/delete/testimonials/{id}', 'DeleteTestimonials')->name('delete.testimonials');
    });


    //Blog Category All Route
    Route::controller(BlogController::class)->group(function () {
        Route::get('/all/blog/category', 'AllBlogCategory')->name('all.blog.category');
        Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
        Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
        Route::get('/blog/category/{id}', 'EditBlogCategory');
        Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
    });


    //Post All Route
    Route::controller(BlogController::class)->group(function () {
        Route::get('/all/post', 'AllPost')->name('all.post');
        Route::get('/add/post', 'AddPost')->name('add.post');
        Route::post('/store/post', 'StorePost')->name('store.post');
        Route::post('/update/post', 'UpdatePost')->name('update.post');
        Route::get('/edit/post/{id}', 'EditPost')->name('edit.post');
        Route::get('/delete/post/{id}', 'DeletePost')->name('delete.post');
    });


    //SMTP Setting All Route
    Route::controller(SettingController::class)->group(function () {
        Route::get('/smtp/setting', 'SmtpSetting')->name('smtp.setting');
        Route::post('/update/smtp/setting', 'UpdateSmtpSetting')->name('update.smtp.setting');
    });

    //Site Setting All Route
    Route::controller(SettingController::class)->group(function () {
        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::post('/update/site/setting', 'UpdateSiteSetting')->name('update.site.setting');
    });


    //permission All Route
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');


        Route::get('/import/permission', 'ImportPermission')->name('import.permission');
        Route::get('/export', 'Export')->name('export');
        Route::post('/import', 'Import')->name('import');
    });

    //Roles All Route
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/roles', 'AllRoles')->name('all.roles');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');


        // Roles In Permission
        Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');
        Route::post('/role/permission/store', 'RolePermissionStore')->name('role.permission.store');
        Route::get('admin/edit/roles/{id}', 'AdminEditRoles')->name('admin.edit.roles');
        Route::post('admin/roles/update/{id}', 'AdminRolesUpdate')->name('admin.roles.update');
        Route::get('admin/delete/roles/{id}', 'AdminDeleteRoles')->name('admin.delete.roles');

    });


    //Admin User All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
        Route::post('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::get('/delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');

    });


});//End Group Admin Middleware



//Agent Group Middleware
Route::middleware(['auth', 'roles:agent'])->group(function () {

    //Agent All Property
    Route::controller(AgentPropertyController::class)->group(function () {
        Route::get('agent/all/property','AgentAllProperty')->name('agent.all.property');
        Route::get('agent/add/property','AgentAddProperty')->name('agent.add.property');
        Route::post('agent/store/property','AgentStoreProperty')->name('agent.store.property');
        Route::get('agent/edit/property/{id}','AgentEditProperty')->name('agent.edit.property');
        Route::post('agent/update/property','AgentUpdateProperty')->name('agent.update.property');
        Route::post('agent/update/property/thambnail','AgentUpdatePropertyThambnail')->name('agent.update.property.thambnail');
        Route::post('agent/update/property/multiimage','AgentUpdatePropertyMultiimage')->name('agent.update.property.multiimage');
        Route::get('agent/property/multiimg/delete/{id}','AgentPropertyMultiImageDelete')->name('agent.property.multiimg.delete');
        Route::post('agent/store/new/multiimage','AgentStoreNewMultiimage')->name('agent.store.new.multiimage');
        Route::post('agent/update/property/facilities','AgentUpdatePropertyFacility')->name('agent.update.property.facilities');
        Route::get('agent/details/property/{id}','AgentDetailsProperty')->name('agent.details.property');
        Route::get('agent/delete/property/{id}','AgentDeleteProperty')->name('agent.delete.property');


        Route::get('agent/property/message','AgentPropertyMessage')->name('agent.property.message');
        Route::get('agent/message/details/{id}','AgentMessageDetails')->name('agent.message.details');


        //Schedule Request Route
        Route::get('agent/schedule/request','AgentScheduleRequest')->name('agent.schedule.request');
        Route::get('agent/details/schedule/{id}','AgentDetailsSchedule')->name('agent.details.schedule');
        Route::post('agent/update/schedule/','AgentUpdateSchedule')->name('agent.update.schedule');


    });


    //Agent Buy Package
    Route::controller(AgentPropertyController::class)->group(function () {
        Route::get('/buy/package', 'BuyPackage')->name('buy.package');
        Route::get('/buy/business/plan', 'BuyBusinessPlan')->name('buy.business.plan');
        Route::post('/store/business/plan', 'StoreBusinessPlan')->name('store.business.plan');
        Route::get('/buy/professional/plan', 'BuyProfessionalPlan')->name('buy.professional.plan');
        Route::post('/store/professional/plan', 'StoreProfessionalPlan')->name('store.professional.plan');
        Route::get('/package/history', 'PackageHistory')->name('package.history');
        Route::get('/agent/package/invoice/{id}', 'AgentPackageInvoice')->name('agent.package.invoice');

    });

});//End Group Agent Middleware


// Frontend Property Details All Route
Route::get('/property/details/{id}/{slug}', [IndexController::class, 'PropertyDetails']);

// WishList add Route
Route::post('/add-to-wishList/{property_id}', [WishlistController::class, 'AddToWishList']);

// Compare add Route
Route::post('/add-to-compare/{property_id}', [CompareController::class, 'AddToCompare']);

//Send Message from Property Detail
Route::post('/property/message', [IndexController::class, 'PropertyMessage'])->name('property.message');

//Agent Details Page in Frontend
Route::get('/agent/details/{id}', [IndexController::class, 'AgentDetails'])->name('agent.details');

//Send Message from Agent Detail
Route::post('/agent/details/message', [IndexController::class, 'AgentDetailsMessage'])->name('agent.details.message');


//Get rent all property
Route::get('/rent/property', [IndexController::class, 'RentProperty'])->name('rent.property');

//Get buy all property
Route::get('/buy/property', [IndexController::class, 'BuyProperty'])->name('buy.property');

//Get all property type data
Route::get('/property/type/{id}', [IndexController::class, 'PropertyType'])->name('property.type');

//Get state details data
Route::get('/state/details/{id}', [IndexController::class, 'StateDetails'])->name('state.details');

//Home Page Buy Search Option
Route::post('/buy/property/search', [IndexController::class, 'BuyPropertySearch'])->name('buy.property.search');

//Home Page Rent Search Option
Route::post('/rent/property/search', [IndexController::class, 'RentPropertySearch'])->name('rent.property.search');

// Property Search Option
Route::post('/all/property/search', [IndexController::class, 'AllPropertySearch'])->name('all.property.search');


//Blog  Route
Route::get('/blog/details/{slug}', [BlogController::class, 'BlogDetails']);
Route::get('blog/cat/list/{id}', [BlogController::class, 'BlogCatList']);
Route::get('blog/list', [BlogController::class, 'BlogList'])->name('blog.list');

//Comment Route
Route::post('/store/comment', [BlogController::class, 'StoreComment'])->name('store.comment');
Route::get('admin/blog/comment', [BlogController::class, 'AdminBlogComment'])->name('admin.blog.comment');
Route::get('admin/comment/reply/{id}', [BlogController::class, 'AdminCommentReply'])->name('admin.comment.reply');
Route::post('/reply/message', [BlogController::class, 'ReplyMessage'])->name('reply.message');


//Schedule Message All Route
Route::post('/store/schedule', [IndexController::class, 'StoreSchedule'])->name('store.schedule');


//Chat  Request Route
Route::post('/send-message', [ChatController::class, 'SendMsg'])->name('send.msg');
Route::get('/user-all', [ChatController::class, 'GetAllUser']);
Route::get('/user-message/{id}', [ChatController::class, 'UserMessageById']);

Route::get('/agent/live/chat', [ChatController::class, 'AgentLiveChat'])->name('agent.live.chat');