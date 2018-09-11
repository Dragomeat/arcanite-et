<?php
/**
 * This file is part of the arcanite-et package.
 *
 *  (c) Artem Prosvetov <dragomeat@dragomeat.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('start-page');
})->name('start-page');

Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('issue', 'Auth\IssueController@showIssueForm')
            ->name('auth.issue');

        Route::post('issue', 'Auth\IssueController@issue');

        Route::get('confirm', 'Auth\ConfirmController@showConfirmForm')
            ->middleware('signed')
            ->name('auth.confirm');

        Route::post('confirm', 'Auth\ConfirmController@confirm')
            ->middleware('signed');
    });

    Route::post('logout', 'Auth\LogoutController')
        ->middleware('auth')
        ->name('auth.logout');
});

Route::resource('users', 'UserController')
    ->only(['show', 'update']);
