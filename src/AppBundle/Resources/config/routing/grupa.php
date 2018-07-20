<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('grupa_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Grupa:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('grupa_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Grupa:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('grupa_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Grupa:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('grupa_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Grupa:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('grupa_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Grupa:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
