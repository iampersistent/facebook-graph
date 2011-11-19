<?php
/*
 * This file bootstraps the test environment.
 */
namespace Doctrine\Tests;

error_reporting(E_ALL | E_STRICT);

require_once __DIR__ . '/../../../src/vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php';

if (isset($GLOBALS['DOCTRINE_COMMON_PATH'])) {
    $classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Common', $GLOBALS['DOCTRINE_COMMON_PATH']);
} else {
    $classLoader = new \Doctrine\Common\ClassLoader('Doctrine\Common', __DIR__ . '/../../../src/vendor/doctrine-common/lib');
}
$classLoader->register();

$classLoader = new \Doctrine\Common\ClassLoader('Facebook\Graph', __DIR__ . '/../../../src');
$classLoader->register();

$classLoader = new \Doctrine\Common\ClassLoader('Facebook\Tests', __DIR__ . '/../..');
$classLoader->register();
