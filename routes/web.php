<?php


use  App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\MyEventsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\StartEventController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\EventScheduleController;


//home
Route::get('/home', [PagesController::class, 'home']);


//facility
Route::get('/facility', [PagesController::class, 'facility']);

//announcement
Route::get('/announcement', [PagesController::class, 'announcement']);

//editaccount
Route::get('/editaccount', [PagesController::class, 'editaccount']);


//events upcomming
Route::get('/', [ListingController::class, 'index'])->middleware('auth');



//creating events
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//store listing events
Route::post('/listings', [ListingController::class, 'store']);




Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
//show edit 
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//update submit
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Manage listings upcomming
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//Manage listings  today
Route::get('/listings/manage_realtime', [ListingController::class, 'managetoday'])->middleware('auth');

//Manage listings previous
Route::get('/listings/manage_previous', [ListingController::class, 'manageprevious'])->middleware('auth');

//show listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//show register
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//create account
Route::post('/users', [UserController::class, 'store']);

//logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);




//////// admin routes//

//index
Route::get('/admin/admin_pages/admin_index', [AdminController::class, 'admin_index']);

//profile
Route::get('/admin/admin_users/admin_profile', [AdminController::class, 'admin_profile']);

//profile
Route::get('/admin/admin_users/admin_signin', [AdminController::class, 'admin_signin']);

//admin registration
Route::get('/admin/admin_users/admin_register', [AdminController::class, 'showRegistrationForm'])->name('admin.admin_users.admin_register');
Route::post('/admin/admin_users/admin_register', [AdminController::class, 'admin_register']);
Route::get('/admin/admin_users/admin_login', [AdminController::class, 'showLoginForm'])->name('admin.admin_users.admin_login');
Route::post('/admin/admin_users/admin_login', [AdminController::class, 'admin_login']);

Route::middleware(['auth:admin'])->group(function () {
    // Your admin routes here
    Route::get('/admin/admin_pages/admin_index', [AdminController::class, 'admin_index'])->name('admin.admin_pages.admin_index');
});
//Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');

// organization
Route::get('/admin/admin_pages/organization', [AdminController::class, 'organization']);

// facility
Route::get('/admin/admin_pages/facility', [AdminController::class, 'facility']);

// adduser
Route::get('/admin/admin_users/admin_adduser', [AdminController::class, 'admin_adduser']);

//adduser logic
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/admin_users/admin_adduser', [AdminController::class, 'admin_adduser'])->name('admin.admin_users.admin_adduser');
    Route::post('/admin/admin_users/admin_adduser/searchUser', [AdminController::class, 'searchUser'])->name('admin.admin_users.admin_adduser.searchUser');
  

    Route::post('/admin/admin_users/admin_adduser/addUser', [AdminController::class, 'addUser'])->name('admin.admin_users.admin_adduser.addUser');
    Route::delete('/admin/admin_users/admin_adduser/{id}', [AdminController::class, 'deleteUser'])->name('admin.admin_users.admin_adduser.deleteUser');
});

///////////Organization///////////////

//store organizationss

Route::get('/admin/admin_pages/organization/', [OrganizationController::class, 'index'])->name('admin.admin_pages.organization.index');
Route::post('/admin/admin_pages/organization/store', [OrganizationController::class, 'store'])->name('admin.admin_pages.organization.store');
Route::post('/admin/admin_pages/organization', [OrganizationController::class, 'store'])->name('admin.admin_pages.organization.store');

//store facility


//update organizations
Route::put('/admin/admin_pages/organizations/{id}', [OrganizationController::class, 'update'])->name('admin.admin_pages.organization.update');

//update facility


Route::prefix('admin')->group(function () {
    Route::resource('facilities', FacilityController::class)->only(['index', 'store', 'update', 'destroy']);
});


//delete organization
// Route for deleting an organization
Route::delete('/admin/admin_pages/organization/{id}', [OrganizationController::class, 'destroy'])->name('admin.admin_pages.organization.destroy');

// Route for deleting facility


///// -----------add user------------------////


Route::post('/search-email', [AddUserController::class, 'searchEmail'])->name('searchEmail');


Route::post('/save-admin-user', [AdminUserController::class, 'save'])->name('saveAdminUser');



// routes/web.php


Route::post('/delete-admin-user', [AdminUserController::class, 'deleteAdminUser'])->name('deleteAdminUser');


// Route for adding admin users
Route::post('/add-admin-user', [AdminUserController::class, 'addAdminUser'])->name('addAdminUser');

// Route for fetching admin users
Route::get('/fetch-admin-users', [AdminUserController::class, 'fetchAdminUsers'])->name('fetchAdminUsers');


Route::post('/delete-admin-user', [AdminUserController::class, 'destroy'])->name('deleteAdminUser');

Route::get('/admin/admin_users/admin_adduser', [AdminUserController::class, 'showAdminPage'])->name('admin.admin_users.admin_adduser');

Route::delete('/admin/admin_users/admin_adduser/{id}', [AdminUserController::class, 'destroy'])->name('admin.admin_users.admin_adduser.destroy');


//////////////--------------- my events Router--------------//////////////
Route::get('/myevents', [MyEventsController::class, 'myevents']);

///ty
Route::get('/manage_all', [ListingController::class, 'manageEvents']);

// org involve
Route::get('/listings/create', [ListingController::class, 'orgInvolve'])->name('listings.create');

//officer controller
Route::get('/officers', [OfficerController::class, 'officer']);

// search officeruser
Route::get('/search-user', [OfficerController::class, 'searchUser']);

//add
Route::post('/add-officer', [OfficerController::class, 'addOfficer']);

//show
Route::get('/officers', [OfficerController::class, 'showOfficers']);

//////////start event
Route::get('/startevent', [StartEventController::class, 'startevent']);

Route::get('/startevent/{id}', [StartEventController::class, 'sEvent'])->name('startevent');

// web.php
Route::post('/event/start', [StartEventController::class, 'start'])->name('event.start');


// routes/web.php
Route::post('/event/save', [StartEventController::class, 'saveEvent']);




Route::get('/listings/{id}/times', [StartEventController::class, 'showTimes'])->name('listings.showTimes');

// aboutus

Route::get('/about', [PagesController::class, 'aboutUs']);




























