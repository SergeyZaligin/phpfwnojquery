<?php
use engine\Router;

// admin
//Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin$', ['controller' => 'User', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', 
        [
            'controller' => 'Main', 
            'action' => 'index',
            'prefix' => 'admin'
        ]);

// default
Router::add('^product/(?P<id>[0-9]+)$', ['controller' => 'Product', 'action' => 'index']);
Router::add('^category/(?P<id>[0-9]+)$', ['controller' => 'Category', 'action' => 'index']);

Router::add('^$', ['controller' => 'Category', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
