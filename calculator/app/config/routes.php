<?php
/**
 * Example routing schema,
 * $config['path/{pattern}'] = 'controller/method';
 * Pattern Shortcuts;
 * {url}, {id}, {all}
 */
$config['/calculate'] = 'Home/calculateRenderer';
$config['/'] = 'Home/homeRenderer';