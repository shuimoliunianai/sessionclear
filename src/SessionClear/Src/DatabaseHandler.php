<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/3/17
 * Time: PM6:01
 */

namespace SessionClear\Src;


use Illuminate\Database\ConnectionInterface;

class DatabaseHandler extends SessionClearHandle
{
    /**
     * the instance of session db
     */
    protected $database;
    /**
     * the session table
     */
    protected $table;
    /**
     * the session record exit statue
     */
    protected $exit;

    /**
     * @param ConnectionInterface $connect
     * @param $table
     */
    public function __construct(ConnectionInterface $connect , $table)
    {
        $this->database = $connect;
        $this->table    = $table;
    }
    /**
     * {@inheritdoc}
     */
    public function read()
    {
        $sessionRecordNum = $this->getQuery()->sum("id");
        if ($sessionRecordNum > 0)
        {
            $this->exit = true;
        }
    }
    /**
     *  {@inheritdoc}
     */
    public function destroy()
    {
        $this->getQuery()->truncate();
    }

    /**
     * get a databases query
     *               -- Auth by Daozi. on 2016.3.17
     */
    public function getQuery()
    {
        return $this->database->table($this->table);
    }

    /**
     * @param mixed $database
     * @return DatabaseHandler
     */
    public function setDatabase($database)
    {
        $this->database = $database;
        return $this;
    }

    /**
     * @param mixed $table
     * @return DatabaseHandler
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }
}