<?php

use Illuminate\Support\Facades\Route;
use Seatplus\Api\Http\Controllers\TokenController;
use Seatplus\Web\Http\Middleware\CheckPermissionAffiliation;

Route::prefix('api')
    ->group(function () {

        Route::middleware(['web', 'auth'])
            ->group(function () {
                Route::get('', [TokenController::class, 'index'])->name('api.index');
                Route::post('', [TokenController::class, 'create'])->name('create.api.token');
                Route::delete('/delete/{tokenId}', [TokenController::class, 'delete'])->name('delete.api.token');
            });

        Route::middleware([
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':60,1',
            'auth:sanctum',
        ])
            ->prefix('v1')
            ->group(function () {
                Route::prefix('users')
                    ->middleware('token-ability-check:API: can list and access users')
                    ->group(function () {
                        Route::get('', \Seatplus\Api\Http\Controllers\Api\V1\Users::class);
                        Route::get('/{user_id}', \Seatplus\Api\Http\Controllers\Api\V1\User::class);
                    });

                Route::prefix('characters/{character_id}')
                    ->group(function () {
                        Route::get('skills', \Seatplus\Api\Http\Controllers\Api\V1\Skills::class);
                        Route::get('wallet/journal', \Seatplus\Api\Http\Controllers\Api\V1\WalletJournal::class);
                        // Character Info
                        //Route::get('', null);
                        // Contacts
                        Route::get('corporationhistory', \Seatplus\Api\Http\Controllers\Api\V1\CorporationHistory::class);
                    });

                Route::prefix('wallet/')
                    ->middleware([
                        'token-ability-check:' . config(sprintf('eveapi.permissions.%s', \Seatplus\Eveapi\Models\Wallet\WalletJournal::class)),
                        'api-permission:' . config(sprintf('eveapi.permissions.%s', \Seatplus\Eveapi\Models\Wallet\WalletJournal::class)),
                    ])
                    ->group(function () {
                        Route::prefix('characters/{character_id}/wallet')
                            ->group(function () {
                                Route::get('journal', null);
                            });
                    });
            });
    });



