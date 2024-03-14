<?php

use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Auth;
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

    Route::get("/send-notification", [\App\Http\Controllers\TaskController::class, 'sendNotification'])->name('sendNotification');

    Route::get("/locale/{lange}", [\App\Http\Controllers\LocalizationController::class, 'setLang'])->name('setLang');
    Route::get("/currentLanguage", [\App\Http\Controllers\LocalizationController::class, 'getCurrentLanguage'])->name('getCurrentLanguage');


    Route::get('/calendar/{user}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/makeOrder', [App\Http\Controllers\PurchaseController::class, 'makeOrder'])->name('makeOrder');
    Route::get('/calendar/slots/{user}', [App\Http\Controllers\HomeController::class, 'slots'])->name('slots');

    Route::get('/calendar/emails/edit', [\App\Http\Controllers\EmailsController::class, 'edit'])->name('emails.edit');
    Route::get('/calendar/sms/edit', [\App\Http\Controllers\EmailsController::class, 'editSms'])->name('sms.edit');
    Route::post('/calendar/emails/update', [\App\Http\Controllers\EmailsController::class, 'update'])->name('emails.update');
    Route::post('/calendar/sms/update', [\App\Http\Controllers\EmailsController::class, 'updateSms'])->name('sms.update');

    Route::get('/calendar/translations/edit', [\App\Http\Controllers\TranslationsController::class, 'edit'])->name('translations.edit');
    Route::put('/calendar/translations/update', [\App\Http\Controllers\TranslationsController::class, 'update'])->name('translations.update');

    Route::get('/calendar/settings/edit', [App\Http\Controllers\CalendarSettingsController::class, 'edit'])->name('calendarSettings.edit');
    Route::put('/calendar/settings/update', [App\Http\Controllers\CalendarSettingsController::class, 'update'])->name('calendarSettings.update');

    Route::get('/brunches', [\App\Http\Controllers\PurchaseController::class, 'loadBrunches'])->name('loadBrunches');
    Route::get('/checkprice', [\App\Http\Controllers\PurchaseController::class, 'checkprice'])->name('checkprice');
    Route::get('/checkPriceForOneProduct', [\App\Http\Controllers\PurchaseController::class, 'checkPriceForOneProduct'])->name('checkPriceForOneProduct');
    Route::get('/purchase', [\App\Http\Controllers\PurchaseController::class, 'index'])->name('purchase');
    Route::post('/makeSlot', [\App\Http\Controllers\PurchaseController::class, 'makeSlot'])->name('makeSlot');
    Route::post('/storeOrder', [\App\Http\Controllers\PurchaseController::class, 'storeOrder'])->name('storeOrder');
    Route::get('/makeOrder', [App\Http\Controllers\PurchaseController::class, 'makeOrder'])->name('makeOrder');

    Route::get('/checkPromocode', [\App\Http\Controllers\PromocodeController::class, 'checkPromocode'])->name('checkPromocode');
    Route::get('/payment/{booking}', [\App\Http\Controllers\PaymentController::class, 'index']);
    Route::post('/payment/update-intent', [\App\Http\Controllers\PaymentController::class, 'updateIntent']);
    Route::post('/stripe/hook', [\App\Http\Controllers\PaymentController::class, 'hook']);
    Route::get('/payment-success', [\App\Http\Controllers\PaymentController::class, 'successPage']);

    Route::get('/actions/cron', [\App\Http\Controllers\PaymentController::class, 'cron']);

    Route::group(['middleware' => 'auth'], function (){
        Route::group(['prefix' => 'user', 'middleware' => 'admin'], function () {
            Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.user.index');
            Route::get('create', [\App\Http\Controllers\UserController::class, 'create'])->name('admin.user.create');
            Route::post('store', [\App\Http\Controllers\UserController::class, 'store'])->name('admin.user.store');
            Route::get('show/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('admin.user.show');
            Route::get('edit/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->name('admin.user.edit');
            Route::put('update', [\App\Http\Controllers\UserController::class, 'update'])->name('admin.user.update');
            Route::delete('delete/{user}', [\App\Http\Controllers\UserController::class, 'delete'])->name('admin.user.delete');
        });

        Route::group(['prefix' => 'country', 'middleware' => 'admin'], function () {
            Route::get('/', [\App\Http\Controllers\CountryController::class, 'index'])->name('admin.country.index');
            Route::get('create', [\App\Http\Controllers\CountryController::class, 'create'])->name('admin.country.create');
            Route::post('store', [\App\Http\Controllers\CountryController::class, 'store'])->name('admin.country.store');
            Route::get('edit/{country}', [\App\Http\Controllers\CountryController::class, 'edit'])->name('admin.country.edit');
            Route::put('update', [\App\Http\Controllers\CountryController::class, 'update'])->name('admin.country.update');
            Route::delete('delete/{country}', [\App\Http\Controllers\CountryController::class, 'delete'])->name('admin.country.delete');
        });

        Route::group(['middleware' => 'customer'], function () {


            Route::get('/getCalendarCountries', [\App\Http\Controllers\CalendarCountryController::class, 'index'])->name('customer.calendarCountry.index');
            Route::put('/setCalendarCountry', [\App\Http\Controllers\CalendarCountryController::class, 'setCountry'])->name('customer.calendarCountry.set');
            Route::put('/countries/changePriority', [\App\Http\Controllers\CalendarCountryController::class, 'changePriority']);

            Route::get('/getStyles', [\App\Http\Controllers\CalendarSettingsController::class, 'getStyles'])->name('styles.index');
            Route::post('/setStyles', [\App\Http\Controllers\CalendarSettingsController::class, 'setStyles'])->name('styles.store');



            Route::get('/getPrivacy', [\App\Http\Controllers\CalendarSettingsController::class, 'getPrivacy'])->name('privacy.index');
            Route::post('/setPrivacy', [\App\Http\Controllers\CalendarSettingsController::class, 'setPrivacy'])->name('privacy.store');



            Route::get('/getFormsSettings', [\App\Http\Controllers\CalendarSettingsController::class, 'getFormsSettings'])->name('getFormsSettings');
            Route::put('/changeFormSettings', [\App\Http\Controllers\CalendarSettingsController::class, 'changeFormSettings'])->name('changeFormSettings');

            Route::delete('/deleteCountry', [\App\Http\Controllers\CalendarSettingsController::class,'deleteCountry']);
            Route::post('/store/country', [\App\Http\Controllers\CalendarSettingsController::class,'storeCountry'])->name('store.country');
            Route::get('/create/country', [\App\Http\Controllers\CalendarSettingsController::class,'createCountry'])->name('create.country');

            Route::post('changeStatus', [\App\Http\Controllers\PurchaseController::class, 'changeStatus']);
            Route::get('purchase/all', [\App\Http\Controllers\PurchaseController::class, 'getAllPurchases'])->name('purchase.index');
            Route::get('purchase/show/{id}', [\App\Http\Controllers\PurchaseController::class, 'getPurchase'])->name('purchase.show');
            Route::delete('purchase/comment/{id}', [\App\Http\Controllers\PurchaseController::class, 'removeComment'])->name('purchase.removeComment');
            Route::post('purchase/comment', [\App\Http\Controllers\PurchaseController::class, 'makeComment'])->name('purchase.makeComment');

            Route::get('/languages', [\App\Http\Controllers\HomeController::class, 'languages']);
            Route::group(['prefix' => 'slots'], function () {

                Route::get('', [\App\Http\Controllers\SlotController::class, 'view'])->name('customer.slot.view');
                Route::post('/createOrUpdate', [\App\Http\Controllers\SlotController::class, 'createOrUpdate'])->name('customer.slot.createOrUpdate');
                Route::get('/allCustomSlots', [\App\Http\Controllers\SlotController::class, 'allCustomSlots'])->name('customer.slot.allCustomSlots');

                Route::get('show/{id}', [\App\Http\Controllers\SlotController::class, 'show'])->name('customer.slot.show');
                Route::get('create', [\App\Http\Controllers\SlotController::class, 'create'])->name('customer.slot.create');
                Route::get('edit/{id}', [\App\Http\Controllers\SlotController::class, 'edit'])->name('customer.slot.edit');
                Route::post('store', [\App\Http\Controllers\SlotController::class, 'store'])->name('customer.slot.store');
                Route::put('update', [\App\Http\Controllers\SlotController::class, 'update'])->name('customer.slot.update');
                Route::delete('delete/{id}', [\App\Http\Controllers\SlotController::class, 'delete'])->name('customer.slot.delete');

            });

            Route::group(['prefix' => 'product'],function () {
                Route::put('/changePriority', [\App\Http\Controllers\ProductController::class, 'changePriority']);
                Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('customer.product.index');
                Route::get('/getMyProducts', [\App\Http\Controllers\ProductController::class, 'getMyProducts'])->name('customer.product.getMyProducts');
                Route::get('show/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('customer.product.show');
                Route::get('create', [\App\Http\Controllers\ProductController::class, 'create'])->name('customer.product.create');
                Route::get('edit/{id}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('customer.product.edit');
                Route::post('store', [\App\Http\Controllers\ProductController::class, 'store'])->name('customer.product.store');
                Route::put('update', [\App\Http\Controllers\ProductController::class, 'update'])->name('customer.product.update');
                Route::delete('delete/{id}', [\App\Http\Controllers\ProductController::class, 'delete'])->name('customer.product.delete');
            });

            Route::group(['prefix' => 'promocode'], function () {
                Route::get('/', [\App\Http\Controllers\PromocodeController::class, 'index'])->name('customer.promocode.index');
                Route::get('show/{id}', [\App\Http\Controllers\PromocodeController::class, 'show'])->name('customer.promocode.show');
                Route::get('create', [\App\Http\Controllers\PromocodeController::class, 'create'])->name('customer.promocode.create');
                Route::get('edit/{id}', [\App\Http\Controllers\PromocodeController::class, 'edit'])->name('customer.promocode.edit');
                Route::post('store', [\App\Http\Controllers\PromocodeController::class, 'store'])->name('customer.promocode.store');
                Route::put('update', [\App\Http\Controllers\PromocodeController::class, 'update'])->name('customer.promocode.update');
                Route::delete('delete/{id}', [\App\Http\Controllers\PromocodeController::class, 'delete'])->name('customer.promocode.delete');
            });

            Route::group(['prefix' => 'brunch'], function () {
                Route::get('/', [\App\Http\Controllers\BrunchController::class, 'index'])->name('customer.brunch.index');
                Route::get('create', [\App\Http\Controllers\BrunchController::class, 'create'])->name('customer.brunch.create');
                Route::get('edit/{brunch}', [\App\Http\Controllers\BrunchController::class, 'edit'])->name('customer.brunch.edit');
                Route::post('store', [\App\Http\Controllers\BrunchController::class, 'store'])->name('customer.brunch.store');
                Route::put('update', [\App\Http\Controllers\BrunchController::class, 'update'])->name('customer.brunch.update');
                Route::delete('delete/{id}', [\App\Http\Controllers\BrunchController::class, 'delete'])->name('customer.brunch.delete');
            });

            Route::group(['prefix' => 'team'], function () {
                Route::get('/', [\App\Http\Controllers\TeamController::class, 'index'])->name('customer.team.index');
                Route::get('create', [\App\Http\Controllers\TeamController::class, 'create'])->name('customer.team.create');
                Route::get('edit/{user}', [\App\Http\Controllers\TeamController::class, 'edit'])->name('customer.team.edit');
                Route::post('store', [\App\Http\Controllers\TeamController::class, 'store'])->name('customer.team.store');
                Route::put('update', [\App\Http\Controllers\TeamController::class, 'update'])->name('customer.team.update');
                Route::delete('delete/{id}', [\App\Http\Controllers\TeamController::class, 'delete'])->name('customer.team.delete');
            });

            Route::group(['prefix' => 'price'], function () {
                Route::get('/', [\App\Http\Controllers\PricesController::class, 'index'])->name('customer.price.index');
                Route::get('/view', [\App\Http\Controllers\PricesController::class, 'view'])->name('customer.price.view');
                Route::get('/allCustomPrice', [\App\Http\Controllers\PricesController::class, 'allCustomPrice'])->name('customer.price.allCustomPrice');
                Route::get('create', [\App\Http\Controllers\PricesController::class, 'create'])->name('customer.price.create');
                Route::get('edit/{id}', [\App\Http\Controllers\PricesController::class, 'edit'])->name('customer.price.edit');
                Route::post('store', [\App\Http\Controllers\PricesController::class, 'store'])->name('customer.price.store');
                Route::post('createOrUpdate', [\App\Http\Controllers\PricesController::class, 'createOrUpdate'])->name('customer.price.createOrUpdate');
                Route::put('update', [\App\Http\Controllers\PricesController::class, 'update'])->name('customer.price.update');
                Route::delete('delete/{id}', [\App\Http\Controllers\PricesController::class, 'delete'])->name('customer.price.delete');
            });

            Route::group(['prefix' => 'embedded'], function () {
                Route::get('/', [\App\Http\Controllers\CalendarSettingsController::class, 'embedded'])->name('customer.embedded.index');
            });
        });
    });

    Auth::routes();

    Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

