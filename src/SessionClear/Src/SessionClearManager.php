<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/3/16
 * Time: PM3:33
 */

namespace SessionClear\Src;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Redis;
use Psy\Exception\ErrorException;

class SessionClearManager
{
    /**
     * Application $app
     */
    protected $app;
    /**
     * session_driver
     */
    protected $driver;
    public function __construct($app)
    {
        $this->app = $app;
    }
    /**
     * clear session Interface
     *            -- Auth by Daozi. on 2016.3.17
     */
    public function Handle()
    {
        $driver = $this->driver();
        $driver->handle();
    }
    /**
     * driver
     */
    public function driver()
    {
        $driver = $this->getSessionDriver();
        $this->driver = $this->createDriver($driver);
        return $this->driver;
    }
    /**
     * create session driver
     *              -- Auth by Daozi. on 2016.3.17
     */
    private function createDriver($driver_name)
    {
        $method = 'create'.ucfirst($driver_name).'Driver';
        if (method_exists($this,$method))
        {
            return $this->$method();
        }
        throw new ErrorException("session driver not found!");
    }
    /**
     * get session driver
     *              -- Auth by Daozi. on 2016.3.17
     */
    private function getSessionDriver()
    {
        return $this->app['config']['session.driver'];
    }
    /**
     * create Redis Handle
     *              -- Auth by Daozi. on 2016.3.17
     */
    private function createRedisDriver()
    {
        $connect = $this->getRedisConnect();
        return new RedisHandle($connect);
    }
    /**
     * create file Handle
     *              -- Auth by Daozi. on 2016.3.17
     */
    private function createFileDriver()
    {
        $path = $this->app['config']['session.files'];

        return new FileHandle($this->app['files'], $path);
    }
    /**
     * Create an instance of the database session driver.
     *
     * @return \Illuminate\Session\Store
     *              -- Auth by Daozi. on 2016.3.17
     */
    protected function createDatabaseDriver()
    {
        $connection = $this->getDatabaseConnection();

        $table = $this->app['config']['session.table'];

        return new DatabaseHandler($connection, $table);
    }
    /**
     * get redis connect
     *              -- Auth by Daozi. on 2016.3.17
     */
    private function getRedisConnect()
    {
        $connection = $this->app['config']['session.connection'];

        return $this->app['redis']->connection($connection);
    }
    /**
     * get database connect
     *              -- Auth by Daozi. on 2016.3.17
     */
    private function getDatabaseConnection()
    {
        $connection = $this->app['config']['session.connection'];
        return $this->app['db']->connection($connection);
    }
}