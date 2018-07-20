<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('jednostka_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Jednostka:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('jednostka_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Jednostka:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('jednostka_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Jednostka:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('jednostka_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Jednostka:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('jednostka_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Jednostka:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
