<?php

$route->get('/', 'Controllers\Posts\IndexPostController@getIndex');

$route->get('/post/create', 'Controllers\Posts\CreatePostController@getCreate');
$route->post('/post/create', 'Controllers\Posts\CreatePostController@postCreate');

$route->get('/post/delete/{postId}', 'Controllers\Posts\DeletePostController@getDelete');
$route->post('/post/delete/{postId}', 'Controllers\Posts\DeletePostController@postDelete');

$route->get('/post/{slug}', 'Controllers\Posts\ShowPostController@getShow');

$route->get('/post/edit/{postId}', 'Controllers\Posts\UpdatePostController@getUpdate');
$route->post('/post/edit/{postId}', 'Controllers\Posts\UpdatePostController@postUpdate');