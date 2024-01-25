<?php

namespace App\Providers;

use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Illuminate\Filesystem\FilesystemAdapter;
use App\Adapters\AutoRefreshingDropBoxTokenService;


class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Storage::extend('dropbox', function ($app, $config) {
            //$token = new AutoRefreshingDropBoxTokenService;
            //$authorizationToken = $token->getToken($config['app_key'], $config['app_secret'], $config['refresh_token']);

            $adapter = new DropboxAdapter(new DropboxClient(
                //$authorizationToken
                $config['authorization_token']
            ));


            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }
}
