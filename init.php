<?php

use Bolt\Extension\Ctors\GoogleTagManager\Extension;
use Bolt\Extension\Ctors\GoogleTagManager\GoogleDataLayer;
// Declare Google Datalayer Service and share it,
// so we can use it in the whole app
$app['GoogleDataLayer'] = $app->share(function () {
    return new \Bolt\Extension\Ctors\GoogleTagManager\GoogleDataLayer();
});

$app['extensions']->register(new Extension($app));


dump(class_exists('GoogleDataLayer'));