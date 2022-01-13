<?php
/**
 * Example routing schema,
 * $config['path/{pattern}'] = 'controller/method';
 * Pattern Shortcuts;
 * {url}, {id}, {all}
 * or
 * $config['path/{pattern}'] = ['controller/method', 'request_type'];
 * request_type = User request type. such as post, get and delete.
 */
$config['/add_post'] = 'home/addPostView';
$config['/edit_post/{id}'] = 'home/editPostView';
$config['/submit_post'] = ['home/handlePost', 'post'];
$config['/post/{id}'] = 'home/postView';
$config['/'] = 'home/index';
