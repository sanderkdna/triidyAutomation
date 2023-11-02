<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Http\Controllers\FlowsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\FlowMessagesController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EndpointsController;
use App\Http\Controllers\EndpointParametersController;

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

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
});

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(PageController::class)->group(function() {
        Route::get('/', [UsersController::class, 'dashboard'])->name('dashboard-overview-1');
        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('dashboard-overview-3-page', 'dashboardOverview3')->name('dashboard-overview-3');
        Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
        Route::get('categories-page', 'categories')->name('categories');
        Route::get('add-product-page', 'addProduct')->name('add-product');
        Route::get('product-list-page', 'productList')->name('product-list');
        Route::get('product-grid-page', 'productGrid')->name('product-grid');
        Route::get('transaction-list-page', 'transactionList')->name('transaction-list');
        Route::get('transaction-detail-page', 'transactionDetail')->name('transaction-detail');
        Route::get('seller-list-page', 'sellerList')->name('seller-list');
        Route::get('seller-detail-page', 'sellerDetail')->name('seller-detail');
        Route::get('reviews-page', 'reviews')->name('reviews');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('login-page', 'login')->name('login');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('change-password-page', 'changePassword')->name('change-password');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });
});

Route::group([
    'prefix' => 'flows',
], function () {
    Route::get('/', [FlowsController::class, 'index'])
         ->name('flows.flow.index');
    Route::get('/create', [FlowsController::class, 'create'])
         ->name('flows.flow.create');
    Route::get('/show/{flow}',[FlowsController::class, 'show'])
         ->name('flows.flow.show')->where('id', '[0-9]+');
    Route::get('/{flow}/edit',[FlowsController::class, 'edit'])
         ->name('flows.flow.edit')->where('id', '[0-9]+');
    Route::post('/', [FlowsController::class, 'store'])
         ->name('flows.flow.store');
    Route::put('flow/{flow}', [FlowsController::class, 'update'])
         ->name('flows.flow.update')->where('id', '[0-9]+');
    Route::delete('/flow/{flow}',[FlowsController::class, 'destroy'])
         ->name('flows.flow.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'tickets',
], function () {
    Route::get('/', [TicketsController::class, 'index'])
         ->name('tickets.ticket.index');
    Route::get('/create', [TicketsController::class, 'create'])
         ->name('tickets.ticket.create');
    Route::get('/show/{ticket}',[TicketsController::class, 'show'])
         ->name('tickets.ticket.show')->where('id', '[0-9]+');
    Route::get('/{ticket}/edit',[TicketsController::class, 'edit'])
         ->name('tickets.ticket.edit')->where('id', '[0-9]+');
    Route::post('/', [TicketsController::class, 'store'])
         ->name('tickets.ticket.store');
    Route::put('ticket/{ticket}', [TicketsController::class, 'update'])
         ->name('tickets.ticket.update')->where('id', '[0-9]+');
    Route::delete('/ticket/{ticket}',[TicketsController::class, 'destroy'])
         ->name('tickets.ticket.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'flow_messages',
], function () {
    Route::get('/', [FlowMessagesController::class, 'index'])
         ->name('flow_messages.flow_messages.index');
    Route::get('/create', [FlowMessagesController::class, 'create'])
         ->name('flow_messages.flow_messages.create');
    Route::get('/show/{flowMessages}',[FlowMessagesController::class, 'show'])
         ->name('flow_messages.flow_messages.show')->where('id', '[0-9]+');

    Route::post('/edit',[FlowMessagesController::class, 'edit'])
         ->name('flow_messages.flow_messages.edit')->where('id', '[0-9]+');

    Route::post('/', [FlowMessagesController::class, 'store'])
         ->name('flow_messages.flow_messages.store');

    Route::post('flow_messages/{flowMessages}', [FlowMessagesController::class, 'update'])
         ->name('flow_messages.flow_messages.update')->where('id', '[0-9]+');

    Route::delete('/flow_messages/{flowMessages}',[FlowMessagesController::class, 'destroy'])
         ->name('flow_messages.flow_messages.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'messages',
], function () {
    Route::get('/', [MessagesController::class, 'index'])
         ->name('messages.messages.index');
    Route::get('/create', [MessagesController::class, 'create'])
         ->name('messages.messages.create');
    Route::get('/show/{messages}',[MessagesController::class, 'show'])
         ->name('messages.messages.show')->where('id', '[0-9]+');
    Route::get('/{messages}/edit',[MessagesController::class, 'edit'])
         ->name('messages.messages.edit')->where('id', '[0-9]+');
    Route::post('/', [MessagesController::class, 'store'])
         ->name('messages.messages.store');
    Route::put('messages/{messages}', [MessagesController::class, 'update'])
         ->name('messages.messages.update')->where('id', '[0-9]+');
    Route::delete('/messages/{messages}',[MessagesController::class, 'destroy'])
         ->name('messages.messages.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'users',
], function () {
    Route::get('/', [UsersController::class, 'index'])
         ->name('users.user.index');
    Route::get('/create', [UsersController::class, 'create'])
         ->name('users.user.create');
    Route::get('/show/{user}',[UsersController::class, 'show'])
         ->name('users.user.show');
    Route::get('/{user}/edit',[UsersController::class, 'edit'])
         ->name('users.user.edit');
    Route::post('/', [UsersController::class, 'store'])
         ->name('users.user.store');
    Route::put('user/{user}', [UsersController::class, 'update'])
         ->name('users.user.update');
    Route::delete('/user/{user}',[UsersController::class, 'destroy'])
         ->name('users.user.destroy');


     Route::post('/getProductos', [UsersController::class, 'getProductos'])->name('user.getProductos');
     Route::post('/getProductoSimple', [UsersController::class, 'getProductoSimple'])->name('user.getProductoSimple');
     Route::post('/getPedidos', [UsersController::class, 'getPedidos'])->name('user.getPedidos');
     Route::post('/getPedidoSimple', [UsersController::class, 'getPedidoSimple'])->name('user.getPedidoSimple');
});

Route::group([
    'prefix' => 'endpoints',
], function () {
    Route::get('/', [EndpointsController::class, 'index'])
         ->name('endpoints.endpoint.index');
    Route::get('/create', [EndpointsController::class, 'create'])
         ->name('endpoints.endpoint.create');
    Route::get('/show/{endpoint}',[EndpointsController::class, 'show'])
         ->name('endpoints.endpoint.show');
    Route::get('/{endpoint}/edit',[EndpointsController::class, 'edit'])
         ->name('endpoints.endpoint.edit');
    Route::post('/', [EndpointsController::class, 'store'])
         ->name('endpoints.endpoint.store');
    Route::put('endpoint/{endpoint}', [EndpointsController::class, 'update'])
         ->name('endpoints.endpoint.update');
    Route::delete('/endpoint/{endpoint}',[EndpointsController::class, 'destroy'])
         ->name('endpoints.endpoint.destroy');
});

Route::group([
    'prefix' => 'endpoint_parameters',
], function () {
    Route::get('/', [EndpointParametersController::class, 'index'])
         ->name('endpoint_parameters.endpoint_parameter.index');
    Route::get('/create', [EndpointParametersController::class, 'create'])
         ->name('endpoint_parameters.endpoint_parameter.create');
    Route::get('/show/{endpointParameter}',[EndpointParametersController::class, 'show'])
         ->name('endpoint_parameters.endpoint_parameter.show');
    Route::get('/{endpointParameter}/edit',[EndpointParametersController::class, 'edit'])
         ->name('endpoint_parameters.endpoint_parameter.edit');
    Route::post('/', [EndpointParametersController::class, 'store'])
         ->name('endpoint_parameters.endpoint_parameter.store');
    Route::put('endpoint_parameter/{endpointParameter}', [EndpointParametersController::class, 'update'])
         ->name('endpoint_parameters.endpoint_parameter.update');
    Route::delete('/endpoint_parameter/{endpointParameter}',[EndpointParametersController::class, 'destroy'])
         ->name('endpoint_parameters.endpoint_parameter.destroy');
});
