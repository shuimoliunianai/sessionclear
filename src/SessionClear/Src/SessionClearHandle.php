<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/3/17
 * Time: PM5:24
 */

namespace SessionClear\Src;


abstract class SessionClearHandle
{
    /**
     * @return mixed
     */
    public abstract function read();

    /**
     * @return mixed
     */
    public abstract function destroy();

    public  function handle(){
        $this->read();
        $this->destroy();
    }
}