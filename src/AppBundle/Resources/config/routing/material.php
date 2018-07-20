<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('material_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Material:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('material_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Material:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('material_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Material:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('material_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Material:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('material_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Material:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
