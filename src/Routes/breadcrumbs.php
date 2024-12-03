<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('shop.customer.profile.gdpr', function (BreadcrumbTrail $trail) {
    $trail->parent('account');
    $trail->push(trans('gdpr::app.shop.customer-gdpr-data-request.heading'), route('gdpr.customers.allgdpr'));
});
