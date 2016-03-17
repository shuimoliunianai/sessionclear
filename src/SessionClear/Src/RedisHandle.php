<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/3/17
 * Time: PM4:36
 */

namespace SessionClear\Src;

use Predis\ClientInterface;

class RedisHandle extends SessionClearHandle
{
    /**
     * instance of redis
     */
    protected $redis;
    /**
     * the session redis statue
     */
    protected $statue;

    /**
     * __construct()
     * @param $connect
     */
    public function __construct(ClientInterface $connect)
    {
        $this->redis = $connect;
    }
    /**
     * read session redis record
     *               -- Auth by Daozi. on 2016.3.17
     */
    public function read()
    {
        if (!empty($this->redis->keys("*")))
        {
            $this->statue = true;
        }
    }
    /**
     * destroy all session record
     *               -- Auth by Daozi. on 2016.3.17
     */
    public function destroy()
    {
       $this->redis->flushdb();
    }

    /**
     * @param mixed $redis
     * @return RedisHandle
     */
    public function setRedis($redis)
    {
        $this->redis = $redis;
        return $this;
    }

}