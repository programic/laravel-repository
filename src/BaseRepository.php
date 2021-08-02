<?php

namespace Programic\Repository;

/**
 * Class BaseRepository
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BaseRepository implements RepositoryInterface
{
    /**
     * @var null
     */
    protected $model = null;

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this, $name))
        {
            return $this->$name($arguments);
        }

        return $this->getModel()->query()->$name($arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        $instance = new static();
        if (method_exists($instance, $name)) {
            return $instance->$name($arguments);
        }

        return $instance->getModel()->query()->$name($arguments);
    }

    /**
     * @throws \Exception
     */
    private function getModel()
    {
        if ($this->model !== null) {
            return new $this->model;
        }

        $className = substr(static::class, strrpos(static::class, '\\') + 1);
        $className = str_replace('Repository', '', $className);
        $model = '\App\Models\\' . $className;
        if (class_exists($model)) {
            $this->model = $model;

            return new $this->model;
        }

        throw new \Exception('Model can not be found: ' . $model);
    }
}
