<?php


use  App\Models\Listing;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GsoController;
use App\Http\Controllers\OrcController;

use App\Http\Controllers\SpmoController;
use App\Http\Controllers\UfmoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\OTPController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GsoLoginController;
use App\Http\Controllers\GsoPagesController;
use App\Http\Controllers\MyEventsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpmoLoginController;
use App\Http\Controllers\SpmoPagesController;
use App\Http\Controllers\UfmoLoginController;
use App\Http\Controllers\UfmoPagesController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AfterEventController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ChecklistsController;
use App\Http\Controllers\DocumentAIController;
use App\Http\Controllers\RequestUscController;
use App\Http\Controllers\SpmoBorrowController;
use App\Http\Controllers\StartEventController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\GsoCategoryController;
use App\Http\Controllers\RequestDeanController;
use App\Http\Controllers\UfmoRequestController;
use App\Http\Controllers\UscApprovalController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\GsoInventoryController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SavedSectionController;
use App\Http\Controllers\SpmoCategoryController;
use App\Http\Controllers\EventattendedController;
use App\Http\Controllers\EventScheduleController;
use App\Http\Controllers\MyCertificateController;
use App\Http\Controllers\PermitToBringController;
use App\Http\Controllers\AdviserRequestController;

use App\Http\Controllers\PermitTransferController;
use App\Http\Controllers\RequestAdviserController;
use App\Http\Controllers\BorrowEquipmentController;
use App\Http\Controllers\OtpVerificationController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\StudentAttendanceController;
use App\Models\UscApproval;

//home

Route::get('home', [PagesController::class, 'home']);


//facility
Route::get('/facility', [PagesController::class, 'facility']);

//announcement
Route::get('/pages/announcement', [PagesController::class, 'announcement']);

//editaccount
Route::get('/editaccount', [PagesController::class, 'editaccount']);
Route::get('/pages/studentsattendance', [PagesController::class, 'studentsattendance']);
Route::get('/pages/students', [PagesController::class, 'students']);
Route::get('/pages/requests', [PagesController::class, 'requests']);
Route::get('/pages/adviserrequests', [PagesController::class, 'adviserrequests']);
Route::get('/pages/announce', [PagesController::class, 'announce']);


//events upcomming
Route::get('/', [ListingController::class, 'index'])->middleware('auth');




//creating events
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//store listing events
Route::post('/listings', [ListingController::class, 'store']);




Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
//show edit 
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])
    ->middleware('auth')
    ->name('listings.edit');

//update submit
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth') ->name('listings.update');

//delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])
    ->middleware('auth')
    ->name('listings.destroy');
    Route::get('/listings/draft', [PagesController::class, 'draft']) ->middleware('auth') ->name('listings.draft');

//Manage listings upcomming
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//Manage listings  today
Route::get('/listings/manage_realtime', [ListingController::class, 'managetoday'])->middleware('auth');

//Manage listings previous
Route::get('/listings/manage_previous', [ListingController::class, 'manageprevious'])->middleware('auth');

//show listing
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::get('/listings/{listing}/previous', [ListingController::class, 'showprevious'])->name('listings.showprevious');




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

Route::get('/get-sections', [UserController::class, 'getSections']);




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
Route::get('/admin_login', [AdminController::class, 'showLoginForm'])->name('admin.admin_users.admin_login');
Route::post('/admin_login', [AdminController::class, 'admin_login']);

Route::middleware(['auth:admin'])->group(function () {
    // Your admin routes here
    Route::get('/admin/admin_pages/admin_index', [AdminController::class, 'admin_index'])->name('admin.admin_pages.admin_index');
});
//Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');

// organization
Route::get('/admin/admin_pages/organization', [AdminController::class, 'organization']);

Route::get('/admin/admin_pages/section', [AdminController::class, 'section']);
 
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
Route::get('/contact', [PagesController::class, 'contactUs']);




//displaying the events in the admin
Route::get('/admin/admin_pages/events', [AdminController::class, 'showEvents'])->name('admin.events');

//scan
Route::post('/search-student', [StartEventController::class, 'searchStudent']);


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
Route::post('/feedback', [EventattendedController::class, 'store'])->name('feedback.store');


Route::get('/pages/eventattended', [EventattendedController::class, 'showEventsAttended'])->name('pages.eventattended');

//feedback
Route::post('/feedback', [EventattendedController::class, 'submitFeedback'])->name('feedback.submit');

//portal
Route::get('admin/admin_users/portal', [PortalController::class, 'portal'])->name('admin.admin_users.portal');
Route::get('gsologin', [PortalController::class, 'gso'])->name('admin.admin_users.gsologin');


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

Route::get('/ufmo/ufmo_pages/ufmo_rejected', [UfmoPagesController::class,'ufmoreject'])->name('ufmo.ufmo_pages.ufmo_rejected');

    Route::get('/ufmo/ufmo_pages/ufmo_approved', [UfmoPagesController::class, 'ufmoapproved'])
    ->name('ufmo.ufmo_pages.ufmo_approved');



Route::get('/ufmo/ufmo_pages/ufmo_cancelled', [UfmoPagesController::class,'ufmocancelled'])->name('ufmo.ufmo_pages.ufmo_cancelled');
Route::get('ufmo/ufmo_pages/ufmo_calendar', [UfmoPagesController::class, 'ufmocalendar'])->name('ufmo.ufmo_pages.ufmo_calendar');

//about us age

Route::get('about', [OrganizationController::class, 'showabout'])->name('about');

//after event
Route::get('/pages/afterevent', [PagesController::class, 'afterevent'])->name('pages.afterevent');
Route::get('/pages/afterevent/{id}', [AfterEventController::class, 'showEventAttendees'])->name('pages.afterevent');

Route::get('/pages/calendar', [PagesController::class, 'calendar'])->name('pages.calendar');

//caledar
Route::get('/pages/calendar', [CalendarController::class, 'calendarPage'])->name('pages.calendar');

//gso
Route::get('/gso/gso_pages/gso_category', [GsoCategoryController::class, 'index'])->name('gso.gso_pages.gso_category');
Route::post('/gso.gso_pages.gso_category', [GsoCategoryController::class, 'store'])->name('gso.gso_pages.gso_category.store');
Route::get('/gso/gso_pages/gso_inventory', [GsoCategoryController::class, 'showInventory'])->name('gso.gso_pages.gso_inventory');
Route::get('/gso/gso_pages/gso_inventory', [GsoInventoryController::class, 'index'])->name('gso.gso_pages.gso_inventory');
Route::post('/gso/gso_pages/gso_inventory/add', [GsoInventoryController::class, 'storeInventory'])->name('gso.gso_pages.gso_inventory.add');




//
Route::get('/pages/post_announcement', [AnnouncementController::class, 'create'])->name('pages.post_announcement');
Route::post('/pages/post_announcements/store', [AnnouncementController::class, 'store'])->name('pages.post_announcements.store');


//
Route::get('/listings/getBookedTimes', [CalendarController::class, 'getBookedTimes']);

// ufmo pending approved


Route::patch('ufmo/approved/{id}', [UfmoRequestController::class, 'approveEvent'])->name('ufmo_approved');

Route::patch('/ufmo/requests/rejected/{id}', [UfmoRequestController::class, 'reject'])
    ->name('ufmo.requests.rejected');



Route::get('/ufmo/ufmo_components/ufmolayout', [UfmoController:: class, 'ufmolayout'])->name('ufmo.ufmo_components.ufmolayout');





Route::get('/listings/{id}/register', [EventRegistrationController::class, 'create'])->name('event.register');
Route::post('/listings/{id}/register', [EventRegistrationController::class, 'store'])->name('event.store');

//gso login

Route::get('/gsologin', function () {
    return view('gso.gso_pages.gsologin'); 
})->name('gso.gsologin');

Route::post('/gso/login', [GsoLoginController::class, 'login'])->name('gso.login');
Route::post('/gso/logout', [GsoLoginController::class, 'logout'])->name('gso.logout');

//gso borrow

Route::get('/pages/borrow/{listing_id}', [BorrowEquipmentController::class, 'borrow'])
    ->name('pages.borrow');

    Route::post('/borrow/store', [BorrowEquipmentController::class, 'store'])
    ->middleware('auth')
    ->name('borrow.store');



 Route::get('/gso/gso_pages/gso_pending', [BorrowEquipmentController::class, 'pendingRequests'])->name('gso.gso_pages.gso_pending');
 
 Route::patch('/borrow/reject/{id}', [BorrowEquipmentController::class, 'reject'])->name('borrow.reject');
 
 Route::patch('gso_approved/{id}', [BorrowEquipmentController::class, 'approve'])
    ->name('gso_approved');

 Route::get('/gso/gso_pages/gso_approved', [BorrowEquipmentController::class, 'approvedRequests'])->name('gso.gso_pages.gso_approved');
 
 Route::get('/pages/requestview/{id}', [BorrowEquipmentController::class, 'requestView'])->name('pages.requestview');
 Route::delete('/pages/requestview/{id}', [BorrowEquipmentController::class, 'cancelRequest'])->name('pages.requestview.cancel');

// Route to mark an approved request as "Borrowed"
Route::get('/gso/gso_pages/gso_borrowed/{id}', [BorrowEquipmentController::class, 'markAsBorrowed'])
    ->name('borrow.markAsBorrowed');

// Route to view all borrowed requests
Route::get('/gso/gso_pages/gso_borrowed', [BorrowEquipmentController::class, 'showBorrowedRequests'])
    ->name('gso.gso_borrowed');

Route::get('/gso/gso_pages/gso_returned/{id}', [BorrowEquipmentController::class, 'markAsReturned'])
    ->name('borrow.markAsReturned');

Route::get('/gso/gso_pages/gso_returned', [BorrowEquipmentController::class, 'showReturnedRequests'])
    ->name('gso.returned');





Route::get('/gso/gso_pages/gso_profile', [GsoController::class, 'profile'])->name('gso.profile');
Route::post('/gso/gso_pages/gso_profile/update-password', [GsoController::class, 'updatePassword'])->name('gso.updatePassword');

Route::get('/gso/gso_pages/gso_adduser', [GsoController::class, 'create'])->name('gso.adduser.create');
Route::post('/gso/gso_pages/gso_adduser', [GsoController::class, 'store'])->name('gso.adduser.store');

Route::get('/gso/gso_pages/gso_dashboard', [GsoController::class, 'dashboard'])->name('gso.dashboard');

//ufmo
Route::get('/ufmologin', function () {
    return view('ufmo.ufmo_pages.ufmologin'); 
})->name('ufmo.ufmologin');

Route::post('/ufmo/login', [UfmoLoginController::class, 'login'])->name('ufmo.login');
Route::post('/ufmo/logout', [UfmoLoginController::class, 'logout'])->name('ufmo.logout');

Route::get('/ufmo/ufmo_components/ufmo_layout', [DashboardController::class, 'userlayout'])->name('ufmo.ufmo_components.ufmo_layout');

Route::get('/ufmo/ufmo_pages/ufmo_profile', [UfmoController::class, 'profile'])->name('ufmo.profile');
Route::post('/ufmo/ufmo_pages/ufmo_profile/update-password', [UfmoController::class, 'updatePassword'])->name('ufmo.updatePassword');

Route::get('/ufmo/ufmo_pages/ufmo_adduser', [UfmoController::class, 'create'])->name('ufmo.adduser.create');
Route::post('/ufmo/ufmo_pages/ufmo_adduser', [UfmoController::class, 'store'])->name('ufmo.adduser.store');

//spmo
Route::get('/spmo/spmo_pages/spmo_dashboard', [SpmoPagesController::class, 'spmodashboard'])->name('spmo.spmo_pages.spmo_dashboard');

Route::get('/spmo/spmo_pages/spmo_category', [SpmoPagesController::class, 'spmocategory'])->name('spmo.spmo_pages.spmo_category');
Route::get('/spmo/spmo_pages/spmo_category', [SpmoCategoryController::class, 'index'])->name('spmo.spmo_pages.spmo_category');
Route::post('/spmo.spmo_pages.spmo_category', [SpmoCategoryController::class, 'store'])->name('spmo.spmo_pages.spmo_category.store');
Route::get('/spmo/spmo_pages/spmo_inventory', [SpmoCategoryController::class, 'showInventory'])->name('spmo.spmo_pages.spmo_inventory');


Route::get('/spmo/spmo_pages/spmo_borrowed', [SpmoPagesController::class, 'spmoborrowed'])->name('spmo.spmo_pages.spmo_borrowed');
Route::get('/spmo/spmo_pages/spmo_pending', [SpmoPagesController::class, 'spmopending'])->name('spmo.spmo_pages.spmo_pending');
Route::get('/spmo/spmo_pages/spmo_approved', [SpmoPagesController::class, 'spmoapproved'])->name('spmo.spmo_pages.spmo_approved');
Route::get('/spmo/spmo_pages/spmo_cancelled', [SpmoPagesController::class, 'spmocancelled'])->name('spmo.spmo_pages.spmo_cancelled');

//spmo borrow





//spmo login

Route::get('/spmo/spmo_pages/spmologin', function () {
    return view('spmo.spmo_pages.spmologin'); 
})->name('spmo.spmologin');


Route::post('/spmo/login', [SpmoLoginController::class, 'login'])->name('spmo.login');
Route::get('/spmo/logout', [SpmoLoginController::class, 'logout'])->name('spmo.logout');

 
Route::get('/admin/admin_users/spmouser', [SpmoController::class, 'index'])->name('admin.admin_users.spmouser');
Route::post('admin/admin_users/spmouser', [SpmoController::class, 'store'])->name('admin.admin_users.spmouser.store');
Route::put('/admin/admin_users/spmouser/{id}', [SpmoController::class, 'update'])->name('admin.admin_users.spmouser.update');
Route::delete('/admin/admin_users/spmouser/{id}', [SpmoController::class, 'destroy'])->name('admin.admin_users.spmouser.destroy');

//facility
Route::put('/facility/{id}/update-status', [FacilityController::class, 'updateStatus'])->name('facility.updateStatus');
Route::put('/facility/{id}/toggle-status', [FacilityController::class, 'toggleStatus'])->name('facility.toggleStatus');

///////
Route::get('/admin/admin_pages/section', [SectionController::class, 'create'])->name('section.create');
Route::post('/admin/admin_pages/section', [SectionController::class, 'store'])->name('section.store');
Route::get('/sections/filter', [SectionController::class, 'filter'])->name('sections.filter');

Route::get('/sections/filter', [UserController::class, 'filter']);

//students
Route::get('/pages/students', [StudentController::class, 'index']);
Route::get('/pages/students/filter', [StudentController::class, 'filterStudents']);
Route::get('/sections/filter', [StudentController::class, 'filterSections']);
Route::get('/pages/{sectionId}/students', [StudentController::class, 'showStudents'])->name('pages.students');

Route::get('/students', [StudentController::class, 'getStudentsByCriteria']);


//save section
Route::middleware(['auth'])->group(function () {
    Route::get('/saved-sections', [SavedSectionController::class, 'index']);
    
    Route::post('/saved-sections', [SavedSectionController::class, 'store'])->name('saved-sections.store');
    Route::delete('/saved-sections/{id}', [SavedSectionController::class, 'destroy']);
    
    // ✅ Moved this inside the auth group
    Route::get('/saved-sections/students/{section}/{year}/{org}', [SavedSectionController::class, 'getStudents']);
});
//

Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');

Route::post('/send-otp', [OtpController::class, 'sendOtp']);
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verify-otp');

//certificate


Route::get('/certificate', [CertificateController::class, 'showFeedback'])->name('certificate.feedback');
Route::post('/certificate/send', [CertificateController::class, 'storeSentCertificate'])->name('certificate.send');

Route::middleware(['auth'])->group(function () {
    Route::get('/mycertificate', [CertificateController::class, 'myCertificates'])->name('certificate.my');
});

// calendar
Route::get('/calendar', [CalendarController::class, 'calendarPage'])->name('calendar.page');
Route::get('/get-booked-slots', [CalendarController::class, 'getBookedSlots']);


Route::get('/verify-otp', [OtpVerificationController::class, 'showOtpForm'])->name('verify.otp.form');
Route::post('/verify-otp', [OtpVerificationController::class, 'verifyOtp'])->name('verify.otp');



Route::post('/sendOtp', [UserController::class, 'sendOtp'])->name('sendOtp');
Route::post('/verifyOtp', [UserController::class, 'verifyOtp'])->name('verifyOtp');

Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('forgot.password.form');
Route::post('/forgot-password/send-otp', [UserController::class, 'sendOtpfp'])->name('forgot.password.sendOtp');
Route::post('/forgot-password/verify-otp', [UserController::class, 'verifyOtpfp'])->name('forgot.password.verifyOtp');

// ufmo forgot password

// Show OTP modal after form submit
Route::post('/ufmo/send-otp', [UfmoController::class, 'sendOtp'])->name('ufmo.sendotp');

// Verify OTP and finally create the user
Route::post('/ufmo/verify-otp', [UfmoController::class, 'verifyOtp'])->name('ufmo.verifyotp');


Route::get('/ufmo/forgot-password', [UfmoLoginController::class, 'showForgotPasswordForm'])->name('ufmo.forgot.password.form');
Route::post('/ufmo/forgot-password/send-otp', [UfmoLoginController::class, 'sendOtpfp'])->name('ufmo.forgot.password.sendOtp');
Route::post('/ufmo/forgot-password/verify-otp', [UfmoLoginController::class, 'verifyOtpfp'])->name('ufmo.forgot.password.verifyOtp');

// student attendance
Route::get('/student_attendance', [StudentAttendanceController::class, 'index'])->name('pages.student_attendance');
// in routes/web.php
Route::get('/event/{id}/attendees', [StudentAttendanceController::class, 'viewAttendees'])->name('attendees.view');

Route::get('/terms-and-condition', [PagesController::class, 'termsAndCondition'])->name('pages.terms_and_condition');

// In your routes file (web.php)
Route::get('/search-user', [ListingController::class, 'searchUser']);

// checklists
Route::get('/checklists/{id}', [ChecklistsController::class, 'index'])->name('checklists');

//adviser
Route::get('/listings/checklists/{id}', [ChecklistsController::class, 'checkListsBorrow'])->name('listings.checklists');

Route::prefix('listings')->group(function () {
    Route::get('/request-adviser/{id}', [AdviserRequestController::class, 'showForm'])
        ->name('request.adviser');
    Route::post('/search-user', [AdviserRequestController::class, 'searchUser'])->name('searchadviser.user');
    Route::post('/adviser-approval', [AdviserRequestController::class, 'store'])->name('adviser.approval.store');
});


//dean
Route::get('/listings/request-dean/{id}', [RequestDeanController::class, 'showForm'])
    ->name('request.dean');

Route::post('/search-user', [RequestDeanController::class, 'searchUser'])->name('searchdean.user');
Route::post('/dean-approval', [RequestDeanController::class, 'store'])->name('dean.approval.store');

//usc
Route::get('/listings/request-usc/{id}', [RequestUscController::class, 'showForm'])
    ->name('request.usc');


Route::post('/usc-approval', [RequestUscController::class, 'store'])->name('usc.approval.store');

//bringin
Route::get('/listings/bringin/{id}', [PermitToBringController::class, 'showForm'])
    ->name('listings.bringin');

    
Route::post('/request-bringin', [RequestUscController::class, 'store'])->name('bringin.store');

Route::post('/listings/bringin', [PermitToBringController::class, 'store'])
    ->name('listings.bringin.store');

//transfer

Route::get('/listings/permit_transfer/{id}', [PermitTransferController::class, 'showForm'])
    ->name('listings.permit_transfer');

Route::post('/permit-transfer', [PermitTransferController::class, 'store'])->name('permit.transfer.store');

//requests
Route::get('/pages/requests', [RequestController::class, 'index'])->name('pages.requests');
Route::get('/requests/check-email/{email}', [RequestController::class, 'checkEmail'])->name('requests.checkEmail');

Route::patch('listings/approved/{id}', [RequestController::class, 'approveRequest'])->name('dean_approved');
Route::get('/dean/approved-requests', [RequestController::class, 'showApproved'])->name('dean_approve');

Route::patch('/requests/reject/{id}', [RequestController::class, 'rejectRequest'])->name('dean_reject');

Route::get('/dean/rejected-requests', [RequestController::class, 'showRejected'])->name('dean_rejected');

//adviser approval
Route::get('/pages/adviserrequests', [RequestAdviserController::class, 'index'])->name('pages.requestsadviser');
Route::get('/requests/check-email/{email}', [RequestAdviserController::class, 'checkEmail'])->name('requests.checkEmail');

Route::patch('listings/approved/{id}', [RequestAdviserController::class, 'approveRequest'])->name('adviser_approved');
Route::get('/adviser/approved-requests', [RequestAdviserController::class, 'showApproved'])->name('adviser_approve');

Route::patch('/requests/reject/{id}', [RequestAdviserController::class, 'rejectRequest'])->name('adviser_reject');

Route::get('/adviser/rejected-requests', [RequestAdviserController::class, 'showRejected'])->name('adviser_rejected');

// usc approval
Route::get('/admin/eventrequests', [UscApprovalController::class, 'index'])->name('eventrequests.index');

Route::patch('listings/approved/{id}', [UscApprovalController::class, 'approveRequest'])->name('usc_approved');
Route::get('/usc/approved-requests', [UscApprovalController::class, 'showApproved'])->name('dean_approve');

Route::patch('/requests/reject/{id}', [UscApprovalController::class, 'rejectRequest'])->name('usc_reject');

Route::get('/usc/rejected-requests', [UscApprovalController::class, 'showRejected'])->name('dean_rejected');






























