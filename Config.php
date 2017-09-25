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
class Config extends Object {

    /**
     * @var string Source name
     */
    public $name;

    /**
     * @var array|Attribute[]
     */
    public $attributes = [];

    /**
     * @var Attribute[]
     */
    private $_attributes = [];

    /**
     * @param array $config
     */
    public function __construct($config) {
        parent::__construct($config);

        if (!$this->name) {
            throw new \Exception("Name is required for Config");
        }

        foreach ($this->attributes as $name => $value) {
            if ($value instanceof Attribute) {
                $this->_attributes[] = $value;
            } else {
                $this->_attributes[] = new Attribute([
                    'name' => $name, 'value' => $value
                ]);
            }
        }
    }

    /**
     * @return string
     */
    public function getContent() {
        $content = "$this->name { \n";

        foreach ($this->_attributes as $attribute) {
            $content .= $attribute->getContent();
        }

        $content .= "} \n";
        return $content;
    }

    /**
     * @return Attribute[]
     */
    public function getAttributes() {
        return $this->_attributes;
    }

}
