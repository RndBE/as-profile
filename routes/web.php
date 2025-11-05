<?php

use Livewire\Volt\Volt;
use Laravel\Fortify\Features;
use App\Livewire\User\HomePage;
use App\Livewire\Admin\SolutionsPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamsController;
use App\Livewire\Admin\SolutionCreatePage;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SolutionsController;
use App\Http\Controllers\TestimonysController;
use App\Http\Controllers\SendContactController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', HomePage::class)->name('user.home');
Route::get('/solutions/{slug}', [SolutionsController::class, 'show'])->name('solutions.show');
Route::get('/projects/{slug}', [ProjectsController::class, 'show'])->name('projects.show');
Route::post('/contact/send', [SendContactController::class, 'send'])->name('contact.send');
Route::get('/login', function () {
    abort(404);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('livewire.auth.login');
    })->name('login'); // tetap pakai name('login') agar Fortify tahu ini route login

    // Endpoint POST login Fortify
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    Route::get('/register', function () {
        return redirect()->route('login');
    });
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::prefix('/admin')->middleware(['auth'])->group(function () {
    Route::resource('/carousels', CarouselController::class);

    Route::get('about/', [AboutUsController::class, 'index'])->name('about.index');
    Route::post('about/', [AboutUsController::class, 'store'])->name('about.store');
    Route::post('about/feature', [AboutUsController::class, 'storeFeature'])->name('about.feature.store');
    Route::delete('about/feature/{id}', [AboutUsController::class, 'destroyFeature'])->name('about.feature.destroy');
    Route::put('about/feature/{id}', [AboutUsController::class, 'updateFeature'])->name('about.feature.update');

    Route::resource('/solutions', SolutionsController::class);
    Route::resource('/clients', ClientsController::class);
    Route::resource('/testimonys', TestimonysController::class);
    Route::resource('/projects', ProjectsController::class);
    Route::delete('/projects/image/{id}', [ProjectsController::class, 'deleteImage'])->name('projects.image.delete');
    Route::resource('/teams', TeamsController::class);
    Route::resource('/contacts', ContactController::class);

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
