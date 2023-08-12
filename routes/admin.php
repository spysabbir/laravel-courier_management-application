<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\CostController;
use App\Http\Controllers\Admin\DeliveryCourierController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SendCourierController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UnitController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
    });

    Route::middleware('auth')->group(function () {
        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'profileUpdate'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'passwordUpdate'])->name('password.update');

        // Super Admin
        Route::middleware('role:Super Admin')->group(function () {
            Route::get('/default-setting', [SettingController::class, 'defaultSetting'])->name('default.setting');
            Route::post('/default/setting/update/{id}', [SettingController::class, 'defaultSettingUpdate'])->name('default.setting.update');

            Route::get('/mail-setting', [SettingController::class, 'mailSetting'])->name('mail.setting');
            Route::post('/mail/setting/update/{id}', [SettingController::class, 'mailSettingUpdate'])->name('mail.setting.update');

            Route::get('/sms-setting', [SettingController::class, 'smsSetting'])->name('sms.setting');
            Route::post('/sms/setting/update/{id}', [SettingController::class, 'smsSettingUpdate'])->name('sms.setting.update');

            Route::get('/about-us-page', [PageController::class, 'aboutUsPage'])->name('about.us.page');
            Route::post('about/us/page/update/{id}', [PageController::class, 'aboutUsPageUpdate'])->name('about.us.page.update');

            Route::get('/privacy-policy-page', [PageController::class, 'privacyPolicyPage'])->name('privacy.policy.page');
            Route::post('privacy/policy/page/update/{id}', [PageController::class, 'privacyPolicyPageUpdate'])->name('privacy.policy.page.update');

            Route::get('/terms-of-service-page', [PageController::class, 'termsOfServicePage'])->name('terms.of.service.page');
            Route::post('terms/of/service/page/update/{id}', [PageController::class, 'termsOfServicePageUpdate'])->name('terms.of.service.page.update');

            Route::get('/report-courier', [ReportController::class, 'reportCourier'])->name('report.courier');
            Route::get('/report-courier-print', [ReportController::class, 'reportCourierPrint'])->name('report.courier.print');
            Route::post('/report-courier-export', [ReportController::class, 'reportCourierExport'])->name('report.courier.export');

            Route::get('/report-income', [ReportController::class, 'reportIncome'])->name('report.income');
            Route::get('/report-income-print', [ReportController::class, 'reportIncomePrint'])->name('report.income.print');
            Route::post('/report-income-export', [ReportController::class, 'reportIncomeExport'])->name('report.income.export');
        });

        // Admin
        Route::middleware(['role:Super Admin,Admin'])->group(function () {
            Route::resource('branch', BranchController::class);
            Route::get('/branch-recycle', [BranchController::class, 'recycle'])->name('branch.recycle');
            Route::get('/branch/status/{id}', [BranchController::class, 'status'])->name('branch.status');
            Route::get('/branch/restore/{id}', [BranchController::class, 'restore'])->name('branch.restore');
            Route::get('/branch/force/delete/{id}', [BranchController::class, 'forceDelete'])->name('branch.force.delete');

            Route::resource('service', ServiceController::class);
            Route::get('/service-recycle', [ServiceController::class, 'recycle'])->name('service.recycle');
            Route::get('/service/status/{id}', [ServiceController::class, 'status'])->name('service.status');
            Route::get('/service/restore/{id}', [ServiceController::class, 'restore'])->name('service.restore');
            Route::get('/service/force/delete/{id}', [ServiceController::class, 'forceDelete'])->name('service.force.delete');

            Route::resource('testimonial', TestimonialController::class);
            Route::get('/testimonial-recycle', [TestimonialController::class, 'recycle'])->name('testimonial.recycle');
            Route::get('/testimonial/status/{id}', [TestimonialController::class, 'status'])->name('testimonial.status');
            Route::get('/testimonial/restore/{id}', [TestimonialController::class, 'restore'])->name('testimonial.restore');
            Route::get('/testimonial/force/delete/{id}', [TestimonialController::class, 'forceDelete'])->name('testimonial.force.delete');

            Route::resource('unit', UnitController::class);
            Route::get('/unit-recycle', [UnitController::class, 'recycle'])->name('unit.recycle');
            Route::get('/unit/status/{id}', [UnitController::class, 'status'])->name('unit.status');
            Route::get('/unit/restore/{id}', [UnitController::class, 'restore'])->name('unit.restore');
            Route::get('/unit/force/delete/{id}', [UnitController::class, 'forceDelete'])->name('unit.force.delete');

            Route::resource('cost', CostController::class);
            Route::get('/cost-recycle', [CostController::class, 'recycle'])->name('cost.recycle');
            Route::get('/cost/status/{id}', [CostController::class, 'status'])->name('cost.status');
            Route::get('/cost/restore/{id}', [CostController::class, 'restore'])->name('cost.restore');
            Route::get('/cost/force/delete/{id}', [CostController::class, 'forceDelete'])->name('cost.force.delete');

            Route::resource('company', CompanyController::class);
            Route::get('/company-recycle', [CompanyController::class, 'recycle'])->name('company.recycle');
            Route::get('/company/status/{id}', [CompanyController::class, 'status'])->name('company.status');
            Route::get('/company/restore/{id}', [CompanyController::class, 'restore'])->name('company.restore');
            Route::get('/company/force/delete/{id}', [CompanyController::class, 'forceDelete'])->name('company.force.delete');

            Route::get('/all-manager', [AdminController::class, 'allManager'])->name('all.manager');
            Route::post('/manager/register', [AdminController::class, 'managerRegister'])->name('manager.register');
            Route::get('/manager/edit/{id}', [AdminController::class, 'managerEdit'])->name('manager.edit');
            Route::put('/manager/update/{id}', [AdminController::class, 'managerUpdate'])->name('manager.update');
            Route::get('/manager/status/{id}', [AdminController::class, 'managerStatus'])->name('manager.status');
            Route::get('/manager/view/{id}', [AdminController::class, 'managerView'])->name('manager.view');

            Route::get('/all-contact-message', [ContactMessageController::class, 'index'])->name('contact.message.index');
            Route::get('/contact/message/view/{id}', [ContactMessageController::class, 'view'])->name('contact.message.view');
        });

        // Manager
        Route::middleware('role:Manager')->group(function () {
            Route::get('/all-staff', [ManagerController::class, 'allStaff'])->name('all.staff');
            Route::post('/staff/register', [ManagerController::class, 'staffRegister'])->name('staff.register');
            Route::get('/staff/edit/{id}', [ManagerController::class, 'staffEdit'])->name('staff.edit');
            Route::put('/staff/update/{id}', [ManagerController::class, 'staffUpdate'])->name('staff.update');
            Route::get('/staff/status/{id}', [ManagerController::class, 'staffStatus'])->name('staff.status');
            Route::get('/staff/view/{id}', [ManagerController::class, 'staffView'])->name('staff.view');

            Route::get('/send/courier/list/processing', [SendCourierController::class, 'processingCourierList'])->name('send.courier.list.processing');
            Route::get('/send/courier/list/delivered', [SendCourierController::class, 'deliveredCourierList'])->name('send.courier.list.delivered');
            Route::post('/change/on_the_way/courier/status', [SendCourierController::class, 'changeOnTheWayCourierStatus'])->name('change.on_the_way.courier.status');

            Route::get('/delivery/courier/list/processing', [DeliveryCourierController::class, 'processingCourierList'])->name('delivery.courier.list.processing');
            Route::get('/delivery/courier/list/delivered', [DeliveryCourierController::class, 'deliveredCourierList'])->name('delivery.courier.list.delivered');
            Route::post('/change/shipped/courier/status', [DeliveryCourierController::class, 'changeShippedCourierStatus'])->name('change.shipped.courier.status');
        });

        // Staff
        Route::middleware('role:Staff')->group(function () {
            Route::get('/send/courier', [SendCourierController::class, 'sendCourier'])->name('send.courier');
            Route::post('/get/cost/rate', [SendCourierController::class, 'getCostRate'])->name('get.cost.rate');
            Route::post('/get/sender/info', [SendCourierController::class, 'getSenderInfo'])->name('get.sender.info');
            Route::post('/send/courier/post', [SendCourierController::class, 'sendCourierPost'])->name('send.courier.post');
            Route::get('/send/courier/list', [SendCourierController::class, 'sendCourierList'])->name('send.courier.list');

            Route::get('/delivery/courier', [DeliveryCourierController::class, 'deliveryCourier'])->name('delivery.courier');
            Route::get('/edit/delivery/courier/status/{id}', [DeliveryCourierController::class, 'editDeliveryCourierStatus'])->name('edit.delivery.courier.status');
            Route::get('/resend/otp/{id}', [DeliveryCourierController::class, 'resendOtp'])->name('resend.otp');
            Route::put('/update/delivery/courier/status/{id}', [DeliveryCourierController::class, 'updateDeliveryCourierStatus'])->name('update.delivery.courier.status');
            Route::get('/delivery/courier/list', [DeliveryCourierController::class, 'deliveryCourierList'])->name('delivery.courier.list');
        });

        Route::get('/courier/details/view/{id}', [SendCourierController::class, 'courierDetailsView'])->name('courier.details.view');
        Route::get('/courier/invoice/{id}', [SendCourierController::class, 'courierInvoice'])->name('courier.invoice');
    });
});
