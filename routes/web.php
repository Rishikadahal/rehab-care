<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\HealthRecordsController;
use App\Models\Meet;
use App\Models\Patient;
use App\Models\PatientActivity;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

    // book a meet list
    Route::get('/book-meet', function () {
        return view('user/bookameet');
    })->name('book-meet');

    // book a meet form
    Route::get('/add-book-a-meet', function () {
        return view('user/book-a-meet');
    })->name('add-book-meet');

    // store meet
    Route::post('/add-book-a-meet', function (Request $request) {

        $request->validate([
            'email' => 'nullable|email',
            'patient_id' => 'nullable|exists:patients,id',
        ]);
        // Create a new meet instance
        $meet = new Meet();
        // Assign values from the request to the meet object
        $meet->email = $request->email;
        $meet->patient_id = $request->patient_id;
        $meet->status = 1;
        $meet->user_id = auth()->user()->id;

        // Save the meet
        $meet->save();
        return redirect('/book-meet');
    })->name('store-book-meet');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pre-admit-concern', function () {
        $data = Patient::all()->where("user_id", auth()->user()->id);
        return view('user/preadmitconcern', compact('data'));
    })->name('pre-admit-concern');
    Route::get('/add-pre-admit-concern', function () {
        return view('user/add-preadmit-concern');
    })->name('add-pre-admit-concern');

    Route::post('/add-pre-admit-concern', [DashboardController::class, 'storePreAdmitConcern']);
    Route::get('/patient-activity', function () {
        $data = PatientActivity::all();
        $user = [];
        foreach ($data as $key => $value) {

            $patient = Patient::find($value->patient_id);
            if ($patient->user_id == auth()->user()->id) {
                $value->patient_name = $patient->name;
                array_push($user, $value);
            }
        }
        return view("user.patientactivity", compact('user'));
    });
});
