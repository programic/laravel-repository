<?php

namespace Programic\Repository;

use Illuminate\Contracts\Foundation\Application;

class Repository
{
    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
