<?php
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegExpController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClickCounterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use Illuminate\Support\Facades\Mail;
use App\emails\CustomEmail;
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
Route::get('locale/{locale}',[LangController::class, 'changeLocale'])->name('locale');

Route::post('/track-external-link', [ClickCountersController::class, 'trackExternalLink']);

route::get('/admin',[\App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['set_locale'])->group(function (){
    Route::get('/', function () {
        return view('main');
    });


    Route::get('/about', function () {
        return view('about',['processedText' => '']);
    });

    Route::get('/main', function () {
        return view('main');
    })->name('main');

    Route::resource('recipes', RecipeController::class);

    Route::get('/recipes',  [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('/recipes/create',  [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes',  [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit',  [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}',  [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}',  [RecipeController::class, 'destroy'])->name('recipes.destroy');
    Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');

    Route::get('/recipes/sort', [RecipeController::class, 'index'])->name('recipes.sort');
    Route::get('/calendar', function () {
        return view('calendar');
    });


    Route::post('/process-text', [RegExpController::class,'process'])->name('process.text');



    Route::get('/visited_pages',[ProfileController::class, 'showVisitedPages']);
    Route::get('/send-email', function () {
        $users = App\Models\User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new CustomEmail());
        }

        return 'Emails sent successfully!';
    });


    Route::get('/admin/send-message', [HomeController::class, 'showSendMessageForm'])->name('admin.sendMessageForm');
    Route::post('/admin/send-message', [HomeController::class, 'sendMessage'])->name('admin.sendMessage');


    Route::get('/link/{id}', 'App\Http\Controllers\LinkController@click');
});
