<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('members/get-json', 'MemberController@jsonMembers');
    Route::resource('members', 'MemberController');

    Route::get('deposits/get-json', 'DepositController@jsonDeposits');
    Route::resource('deposits', 'DepositController')->only([
        'index', 'create', 'store', 'show'
    ]);

    Route::get('withdrawals/get-json', 'WithdrawalController@jsonWithdrawals');
    Route::resource('withdrawals', 'WithdrawalController')->only([
        'index', 'create', 'store', 'show'
    ]);
});
