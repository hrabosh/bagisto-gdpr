<?php

namespace Webkul\GDPR\Repositories;

use Illuminate\Container\Container;
use Webkul\Core\Eloquent\Repository;
use Webkul\GDPR\Contracts\GDPR;

class GDPRRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return GDPR::class;
    }

    public function __construct(
        Container $container
    ) {
        parent::__construct($container);
    }
}
