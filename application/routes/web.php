<?php

/*
* Non-specific Theme Routes
*/
Route::get('/', [
    'as' => 'index',
    'middleware' => 'checkForInstall',
    'uses' => 'Index\IndexController@Index'
]);


/*
 *
 * Admin Panel Routes
 *
 */
Route::group([
    'prefix' => 'dashboard',
    'middleware' => [
        'setTheme:admin',
        'checkForInstall',
        'checkForAdmin'
    ]
], function() {
    Route::get('/', [
        'as' => 'dashboard.index',
        'uses' => 'Dashboard\IndexController@Index'
    ]);

    Route::get('update', [
        'as' => 'dashboard.update',
        'uses' => 'Dashboard\UpdatesController@Index'
    ]);

    Route::post('update/download', [
        'as' => 'dashboard.download',
        'uses' => 'Dashboard\UpdatesController@Update'
    ]);

    Route::post('cache', [
        'as' => 'dashboard.cache',
        'uses' => 'Dashboard\CacheController@Clear'
    ]);

    Route::middleware('auth:web', 'throttle:60,1')->group(function () {
        Route::post('update/checkforupdates', [
            'as' => 'dashboard.checkforupdates',
            'uses' => 'Dashboard\UpdatesController@ForceCheckUpdate'
        ]);
    });

    Route::group(['prefix' => 'features'], function() {
        // Feature Routes
        Route::get('/', [
            'as' => 'dashboard.features',
            'uses' => 'Dashboard\FeaturesController@Index'
        ]);

        Route::post('create', [
            'as' => 'dashboard.features.store',
            'uses' => 'Dashboard\FeaturesController@Store'
        ]);

        Route::get('{feature}/edit', [
            'as' => 'dashboard.features.edit',
            'uses' => 'Dashboard\FeaturesController@Edit'
        ]);

        Route::patch('{feature}/update', [
            'as' => 'dashboard.features.update',
            'uses' => 'Dashboard\FeaturesController@Update'
        ]);

        Route::post('{feature}/delete', [
            'as' => 'dashboard.features.delete',
            'uses' => 'Dashboard\FeaturesController@Destroy'
        ]);

    });


    Route::group(['prefix' => 'links'], function() {
        Route::get('/', [
            'as' => 'dashboard.links',
            'uses' => 'Dashboard\LinkController@Index'
        ]);

        Route::post('create', [
            'as' => 'dashboard.links.store',
            'uses' => 'Dashboard\LinkController@Store'
        ]);

        Route::get('{link}', [
            'as' => 'dashboard.links.edit',
            'uses' => 'Dashboard\LinkController@Edit'
        ]);

        Route::patch('{link}/update', [
            'as' => 'dashboard.links.update',
            'uses' => 'Dashboard\LinkController@Update'
        ]);

        Route::post('{link}/delete', [
            'as' => 'dashboard.links.delete',
            'uses' => 'Dashboard\LinkController@Destroy'
        ]);
    });


    Route::group(['prefix' => 'discord'], function() {
        // Discord Routes
        Route::get('/', [
            'as' => 'dashboard.discord',
            'uses' => 'Dashboard\DiscordController@Index'
        ]);

        Route::patch('edit/{discord}/update', [
            'as' => 'dashboard.discord.update',
            'uses' => 'Dashboard\DiscordController@Update'
        ]);
    });


    Route::group(['prefix' => 'servers'], function() {
        // Server Routes
        Route::get('/', [
            'as' => 'dashboard.servers',
            'uses' => 'Dashboard\ServersController@Index'
        ]);

        Route::post('create', [
            'as' => 'dashboard.servers.store',
            'uses' => 'Dashboard\ServersController@Store'
        ]);

        Route::get('{server}/edit', [
            'as' => 'dashboard.servers.edit',
            'uses' => 'Dashboard\ServersController@Edit'
        ]);

        Route::patch('{server}/update', [
            'as' => 'dashboard.servers.update',
            'uses' => 'Dashboard\ServersController@Update'
        ]);

        Route::post('{server}/delete', [
            'as' => 'dashboard.servers.destroy',
            'uses' => 'Dashboard\ServersController@Destroy'
        ]);
    });


    Route::group(['prefix' => 'steam'], function() {
        Route::group(['prefix' => 'api'], function() {
            // Api Key Routes
            Route::get('/', [
                'as' => 'dashboard.steam.api',
                'uses' => 'Dashboard\SteamApiKeyController@Index'
            ]);

            Route::patch('edit/{steamApi}/update', [
                'as' => 'dashboard.steam.api.update',
                'uses' => 'Dashboard\SteamApiKeyController@Update'
            ]);
        });

        Route::group(['prefix' => 'group'], function() {
            // Group Routes
            Route::get('group', [
                'as' => 'dashboard.steam.group',
                'uses' => 'Dashboard\SteamGroupController@Index'
            ]);

            Route::patch('group/edit/{steamGroup}/update', [
                'as' => 'dashboard.steam.group.update',
                'uses' => 'Dashboard\SteamGroupController@Update'
            ]);
        });
    });


    Route::group(['prefix' => 'team'], function() {
        // Team Routes
        Route::get('/', [
            'as' => 'dashboard.team',
            'uses' => 'Dashboard\TeamController@Index'
        ]);

        Route::post('create', [
            'as' => 'dashboard.team.store',
            'uses' => 'Dashboard\TeamController@Store'
        ]);

        Route::get('{team}', [
            'as' => 'dashboard.team.edit',
            'uses' => 'Dashboard\TeamController@Edit'
        ]);

        Route::patch('{team}/update', [
            'as' => 'dashboard.team.update',
            'uses' => 'Dashboard\TeamController@Update'
        ]);

        Route::post('{team}/delete', [
            'as' => 'dashboard.team.destroy',
            'uses' => 'Dashboard\TeamController@Destroy'
        ]);
    });


    Route::group(['prefix' => 'themes'], function() {
        // Themes Routes
        Route::get('/', [
            'as' => 'dashboard.themes',
            'uses' => 'Dashboard\ThemesController@Index'
        ]);

        Route::patch('edit/{themes}/update', [
            'as' => 'dashboard.themes.update',
            'uses' => 'Dashboard\ThemesController@Update'
        ]);
    });

    Route::group(['prefix' => 'users'], function() {
        // Users Routes
        Route::get('/', [
            'as' => 'dashboard.users',
            'uses' => 'Dashboard\UsersController@Index'
        ]);

        Route::get('{user}', [
            'as' => 'dashboard.users.edit',
            'uses' => 'Dashboard\UsersController@Edit'
        ]);

        Route::patch('{user}/update', [
            'as' => 'dashboard.users.update',
            'uses' => 'Dashboard\UsersController@Update'
        ]);

        Route::patch('{user}/removeTeam', [
            'as' => 'dashboard.users.update.removeteam',
            'uses' => 'Dashboard\UsersController@RemoveTeam'
        ]);

        Route::post('{user}/syncWithSteam', [
            'as' => 'dashboard.users.update.syncwithsteam',
            'uses' => 'Dashboard\UsersController@syncWithSteam'
        ]);

        Route::post('create', [
            'as' => 'dashboard.users.update.create',
            'uses' => 'Dashboard\UsersController@create'
        ]);

    });

    Route::group(['prefix' => 'settings'], function() {
        Route::get('/', [
            'as' => 'dashboard.settings.index',
            'uses' => 'Dashboard\SettingsController@Index'
        ]);

        Route::post('search', [
            'as' => 'dashboard.settings.search',
            'uses' => 'Dashboard\SettingsController@Search'
        ]);

        Route::patch('update/{settings}', [
            'as' => 'dashboard.settings.update',
            'uses' => 'Dashboard\SettingsController@Update'
        ]);
    });
});

// Steam login routes
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('login/steam', 'Auth\SteamLoginController@login')->name('login');
Route::get('auth/steam', 'Auth\SteamLoginController@handle')->name('auth.steam');

