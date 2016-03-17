<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/3/16
 * Time: PM5:47
 */

namespace SessionClear\Providers;


use Illuminate\Support\ServiceProvider;
use SessionClear\Console\SessionClearCommand;
use SessionClear\Src\SessionClearManager;

class SessionClearCommandServiceProvider extends ServiceProvider
{
    /**
     * register provider
     *             -- Auth by Daozi. on 2016.3.16
     */
    public function register()
    {
        $this->registerBaseProvider();
        $this->registerCommandProvider();
    }
    /**
     * register provider
     *          -- Auth by Daozi. on 2016.3.16
     */
    public function registerBaseProvider()
    {
        $this->app->singleton("SessionClearManager",function($app)
        {
            return new SessionClearManager($app);
        });
    }
    /**
     * register command provider
     *          -- Auth by Daozi. on 2016.3.16
     */
    public function registerCommandProvider()
    {
        $this->app->singleton('command.session.clear', function ($app) {
            return new SessionClearCommand($app['composer']);
        });
        $this->commands('command.session.clear');
    }
}