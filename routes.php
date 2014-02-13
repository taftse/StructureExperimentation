<?php

$route->get('/', 'Controllers\Posts\IndexPostController@getIndex');

$route->get('/post/create', 'Controllers\Posts\CreatePostController@getCreate');
$route->post('/post/create', 'Controllers\Posts\CreatePostController@postCreate');

$route->get('/post/delete/{id}', 'Controllers\Posts\DeletePostController@getDelete');
$route->post('/post/delete/{id}', 'Controllers\Posts\DeletePostController@postDelete');

$route->get('/post/{slug}', 'Controllers\Posts\ShowPostController@getShow');

$route->get('/post/edit/{id}', 'Controllers\Posts\UpdatePostController@getUpdate');
$route->post('/post/edit/{id}', 'Controllers\Posts\UpdatePostController@postUpdate');