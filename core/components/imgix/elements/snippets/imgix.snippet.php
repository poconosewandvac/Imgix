<?php
/**
 * Imgix
 *
 * Copyright 2018 by Tony Klapatch <tony@klapatch.net>
 *
 * @package imgix
 * @license See core/components/imgix/docs/license.txt
 */

$input = $modx->getOption('input', $scriptProperties, null);
$options = $modx->getOption('options', $scriptProperties, null);
$urls = $modx->getOption('imgix.urls', null, 'example.imgix.net');
$useHttps = (bool)$modx->getOption('use_https', null, true);
$useCycleSharding = (bool)$modx->getOption('use_cycle_sharding', null, false);

if (!$input) {
    return;
}

// Handle multiple URLs for sharding
if (strpos($urls, '||') === false) {
    $domains = array_map('trim', explode('||', $urls));
}

// Get the path for the image, stripping the domain name
$parsedInput = ltrim(parse_url($input, PHP_URL_PATH), '/');

// Parse the inputted pThumb like image options
parse_str($options, $imgOptions);

// Load the Imgix PHP library
$loader = $modx->getOption('imgix.core_path') ? $modx->getOption('imgix.core_path') . 'vendor/autoload.php' : $modx->getOption('core_path') . 'components/imgix/vendor/autoload.php';
require_once $loader;

$builder = new Imgix\UrlBuilder($domains);
$builder->setUseHttps($useHttps);

return $builder->createURL($parsedInput, $imgOptions);