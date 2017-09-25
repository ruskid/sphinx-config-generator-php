<?php

/**
 * @link https://github.com/ruskid/sphinx-config-generator-php
 * @copyright Copyright (c) 2014 Victor Demin
 * @license https://raw.githubusercontent.com/ruskid/sphinx-config-generator-php/master/LICENSE
 */

namespace ruskid\sphinx;

/**
 * @author Victor Demin <demmbox@gmail.com>
 */
abstract class Object {

    /**
     * @param array $config
     */
    public function __construct($config) {
        foreach ($config as $name => $value) {
            $this->$name = $value;
        }
    }

    /**
     * @return string
     */
    abstract public function getContent();
}
