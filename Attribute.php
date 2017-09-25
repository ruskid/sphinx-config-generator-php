<?php

/**
 * @link https://github.com/ruskid/sphinx-config-generator-php
 * @copyright Copyright (c) 2014 Victor Demin
 * @license https://raw.githubusercontent.com/ruskid/sphinx-config-generator-php/master/LICENSE
 */

namespace ruskid\sphinx;

/**
 * Sphinx config attribute
 * 
 * @author Victor Demin <demmbox@gmail.com>
 */
class Attribute extends Object {

    /**
     * @var string
     */
    public $name;

    /**
     * @var mixed
     */
    public $value;

    /**
     * @param array $config
     */
    public function __construct($config) {
        parent::__construct($config);

        if (!$this->name && $this->value === null) {
            throw new \Exception("Name and value is required for Attribute");
        }
    }

    /**
     * @param string $value
     * @return string
     */
    protected function handleSingleValue($value) {
        return "\t{$this->name}={$value}\n";
    }

    /**
     * @return string
     */
    public function getContent() {
        if (!is_array($this->value)) {
            return $this->handleSingleValue($this->value);
        }

        $content = '';
        foreach ($this->value as $value) {
            $content .= $this->handleSingleValue($value);
        }
        return $content;
    }

}
