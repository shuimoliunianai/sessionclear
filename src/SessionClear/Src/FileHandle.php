<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/3/17
 * Time: PM5:25
 */

namespace SessionClear\Src;

use Illuminate\Filesystem\Filesystem;
class FileHandle extends SessionClearHandle
{
    /**
     * the filesystem instance
     */
    protected $file;
    /**
     * the session file path
     */
    protected $path;
    /**
     * the session file statue
     */
    protected $statue;
    /**
     * @param Filesystem $file
     * @param $path
     */
    public function __construct(Filesystem $file ,$path)
    {
        $this->file = $file;
        $this->path = $path;
    }
    /**
     * read the session file
     *             -- Auth by Daozi. on 2016.3.17
     */
    public function read()
    {
        if ($this->file->allFiles($this->path))
        {
            $this->statue = true;
        }
    }
    /**
     * destroy session file
     *            -- Auth by Daozi. on 2016.3.17
     */
    public function destroy()
    {
        if ($this->statue = true)
        {
            $this->file->cleanDirectory($this->path);
        }
    }

    /**
     * @param mixed $file
     * @return FileHandle
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @param mixed $path
     * @return FileHandle
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }
}