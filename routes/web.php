<?php


use  App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GsoController;
use App\Http\Controllers\OrcController;
use App\Http\Controllers\UfmoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GsoLoginController;
use App\Http\Controllers\GsoPagesController;
use App\Http\Controllers\MyEventsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UfmoPagesController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AfterEventController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StartEventController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\GsoCategoryController;
use App\Http\Controllers\UfmoRequestController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\GsoInventoryController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\EventattendedController;
use App\Http\Controllers\EventScheduleController;
use App\Models\Certificate;

//home
Route::get('/home', [PagesController::class, 'home']);


//facility
Route::get('/facility', [PagesController::class, 'facility']);

//announcement
Route::get('/pages/announcement', [PagesController::class, 'announcement']);

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

//events
Route::get('/admin/admin_pages/events', [AdminController::class, 'events']);

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




//update organizations
Route::put('/admin/admin_pages/organizations/{id}', [OrganizationController::class, 'update'])->name('admin.admin_pages.organization.update');







//delete organization
// Route for deleting an organization
Route::delete('/admin/admin_pages/organization/{id}', [OrganizationController::class, 'destroy'])->name('admin.admin_pages.organization.destroy');



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




//displaying the events in the admin
Route::get('/admin/admin_pages/events', [AdminController::class, 'showEvents'])->name('admin.events');

//scan
Route::post('/search-student', [StartEventController::class, 'searchStudent']);



// certificate



Route::get('/certificates/create', [CertificateController::class, 'create'])->name('certificates.create');
Route::post('/certificates/store', [CertificateController::class, 'store'])->name('certificates.store');


Route::get('/certificates/{id}', [CertificateController::class, 'show'])->name('certificates.show');

// dashboard

Route::get('/admin/admin_pages/admin_index', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

//facility adding
Route::get('/admin/admin_pages/facility', [FacilityController::class, 'index'])->name('admin.admin_pages.facility.index');
Route::put('/admin/admin_pages/facility/{id}', [FacilityController::class, 'update'])->name('admin.admin_pages.facility.update');
Route::post('/admin/admin_pages/facility/store', [FacilityController::class, 'store'])->name('admin.admin_pages.facility.store');
Route::put('/admin/admin_pages/facility/{id}', [FacilityController::class, 'update'])->name('admin.admin_pages.facility.update');
Route::delete('/admin/admin_pages/facility/{id}', [FacilityController::class, 'destroy'])->name('admin.admin_pages.facility.destroy');

//submit
Route::post('/submit-attendance', [AttendanceController::class, 'submitAttendance']);




Route::get('/listings/{listing}/attendance', [AttendanceController::class, 'showAttendance'])->name('attendance.show');


//trry

Route::get('/pages/tryview', [PagesController::class, 'showTryView'])->name('tryview');

//event attended
Route::get('/pages/eventattended', [PagesController::class, 'eventattended'])->name('pages.eventattended');

Route::get('/pages/eventattended', [EventattendedController::class, 'showEventsAttended'])->name('pages.eventattended');

//feedback
Route::post('/feedback', [EventattendedController::class, 'submitFeedback'])->name('feedback.submit');

//portal
Route::get('admin/admin_users/portal', [PortalController::class, 'portal'])->name('admin.admin_users.portal');
Route::get('admin/admin_users/gsologin', [PortalController::class, 'gso'])->name('admin.admin_users.gsologin');
Route::get('admin.admin_users.ufmoLogin', [PortalController::class, 'ufmo'])->name('admin.admin_users.ufmologin');

//gso
Route::get('admin/admin_users/gsouser', [PagesController::class, 'gsouser'])->name('admin.admin_users.gsouser');
Route::get('admin/admin_users/ufmouser', [PagesController::class, 'ufmouser'])->name('admin.admin_users.ufmouser');


    Route::get('/admin/admin_users/gsouser', [GsoController::class, 'index'])->name('admin.admin_users.gsouser');
    Route::post('admin/admin_users/gsouser', [GsoController::class, 'store'])->name('admin.admin_users.gsouser.store');
    Route::put('/admin/admin_users/gsouser/{id}', [GsoController::class, 'update'])->name('admin.admin_users.gsouser.update');
    Route::delete('/admin/admin_users/gsouser/{id}', [GsoController::class, 'destroy'])->name('admin.admin_users.gsouser.destroy');

    Route::get('/admin/admin_users/ufmouser', [UfmoController::class, 'index'])->name('admin.admin_users.ufmouser');
    Route::post('admin/admin_users/ufmouser', [UfmoController::class, 'store'])->name('admin.admin_users.ufmouser.store');
    Route::put('/admin/admin_users/ufmouser/{id}', [UfmoController::class, 'update'])->name('admin.admin_users.ufmouser.update');
    Route::delete('/admin/admin_users/ufmouser/{id}', [UfmoController::class, 'destroy'])->name('admin.admin_users.ufmouser.destroy');

//gso route
Route::get('/gso/gso_pages/gso_dashboard', [GsoPagesController::class, 'gsodashboard'])->name('gso.gso_pages.gso_dashboard');
Route::get('/gso/gso_pages/gso_category', [GsoPagesController::class, 'gsocategory'])->name('gso.gso_pages.gso_category');
Route::get('/gso/gso_pages/gso_inventory', [GsoPagesController::class, 'gsoinventory'])->name('gso.gso_pages.gso_inventory');
Route::get('/gso/gso_pages/gso_borrowed', [GsoPagesController::class, 'gsoborrowed'])->name('gso.gso_pages.gso_borrowed');
Route::get('/gso/gso_pages/gso_pending', [GsoPagesController::class, 'gsopending'])->name('gso.gso_pages.gso_pending');
Route::get('/gso/gso_pages/gso_approved', [GsoPagesController::class, 'gsoapproved'])->name('gso.gso_pages.gso_approved');
Route::get('/gso/gso_pages/gso_cancelled', [GsoPagesController::class, 'gsocancelled'])->name('gso.gso_pages.gso_cancelled');

//ufmo route

Route::get('/ufmo/ufmo_pages/ufmo_dashboard', [UfmoPagesController::class,'ufmodashboard'])->name('ufmo.ufmo_pages.ufmo_dashboard');
Route::get('/ufmo/ufmo_pages/ufmo_pending', [UfmoPagesController::class,'ufmopending'])->name('ufmo.ufmo_pages.ufmo_pending');
Route::get('/ufmo/ufmo_pages/ufmo_approved', [UfmoPagesController::class,'ufmoapproved'])->name('ufmo.ufmo_pages.ufmo_approved');
Route::get('/ufmo/ufmo_pages/ufmo_cancelled', [UfmoPagesController::class,'ufmocancelled'])->name('ufmo.ufmo_pages.ufmo_cancelled');
Route::get('ufmo/ufmo_pages/ufmo_calendar', [UfmoPagesController::class, 'ufmocalendar'])->name('ufmo.ufmo_pages.ufmo_calendar');

//about us age

Route::get('about', [OrganizationController::class, 'showabout'])->name('about');

//after event
Route::get('/pages/afterevent', [PagesController::class, 'afterevent'])->name('pages.afterevent');

Route::get('/pages/calendar', [PagesController::class, 'calendar'])->name('pages.calendar');

//caledar
Route::get('/pages/calendar', [CalendarController::class, 'calendarPage'])->name('pages.calendar');

//gso
Route::get('/gso/gso_pages/gso_category', [GsoCategoryController::class, 'index'])->name('gso.gso_pages.gso_category');
Route::post('/gso.gso_pages.gso_category', [GsoCategoryController::class, 'store'])->name('gso.gso_pages.gso_category.store');
Route::get('/gso/gso_pages/gso_inventory', [GsoCategoryController::class, 'showInventory'])->name('gso.gso_pages.gso_inventory');
Route::get('/gso/gso_pages/gso_inventory', [GsoInventoryController::class, 'index'])->name('gso.gso_pages.gso_inventory');
Route::post('/gso/gso_pages/gso_inventory/add', [GsoInventoryController::class, 'storeInventory'])->name('gso.gso_pages.gso_inventory.add');


Route::get('/pages/afterevent/{id}', [AfterEventController::class, 'showEventAttendees'])->name('pages.afterevent');

//
Route::get('/pages/post_announcement', [AnnouncementController::class, 'create'])->name('pages.post_announcement');
Route::post('/pages/post_announcements/store', [AnnouncementController::class, 'store'])->name('pages.post_announcements.store');


//
Route::get('/listings/getBookedTimes', [CalendarController::class, 'getBookedTimes']);

// ufmo pending approved


Route::patch('/ufmo/ufmo_pages/ufmo_approved/{id}', [UfmoRequestController::class, 'approveEvent'])->name('ufmo.ufmo_pages.ufmo_approved');
Route::patch('/ufmo/ufmo_pages/ufmo_cancelled/{id}', [UfmoRequestController::class, 'rejectEvent'])->name('ufmo.ufmo_pages.ufmo_cancelled');

Route::get('/ufmo/ufmo_components/ufmolayout', [UfmoController:: class, 'ufmolayout'])->name('ufmo.ufmo_components.ufmolayout');

Route::get('/test-ocr', [CertificateController::class, 'extractText']);







































