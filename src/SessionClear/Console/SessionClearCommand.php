<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/3/16
 * Time: PM5:58
 */

namespace SessionClear\Console;


use Illuminate\Console\Command;
use Illuminate\Foundation\Composer;

class SessionClearCommand extends Command
{
    /**
     * the command name
     *
     * @var string
     */
    protected $name = 'session:clear';

    /**
     * the command description
     *
     * @var string
     */
    protected $description = 'clear the timeout session';

    /**
     * @var \Illuminate\Foundation\Composer
     */
    protected $composer;

    /**
     * @param Composer $composer
     */
    public function __construct(Composer $composer)
    {
        parent::__construct();
        $this->composer = $composer;
    }

    /**
     * Handle command
     * @return void
     *                -- Auth by Daozi. on 2016.3.17
     */
    public function  handle()
    {
        $this->clearSession();
        $this->info('session clear success!'.date("Y-m-d H:i:s",time()));
        $this->composer->dumpAutoloads();
    }

    /**
     * clear session function
     *
     * @return string
     *                 -- Auth by Daozi. on 2017.3.17
     */
    protected function clearSession()
    {
        $ClearManager = app('SessionClearManager');
        $ClearManager->Handle();
    }
}