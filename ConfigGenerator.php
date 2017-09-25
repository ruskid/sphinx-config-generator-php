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
class ConfigGenerator extends Object {

    /**
     * @var string
     */
    public $filepath;

    /**
     * @var Source[]
     */
    private $_sources = [];

    /**
     * @var Index[]
     */
    private $_indexes = [];

    /**
     * @var Config[]
     */
    private $_configs = [];

    /**
     * @param Source $source
     */
    public function addSource(Source $source) {
        $this->_sources[] = $source;
    }

    /**
     * @param Config $config
     */
    public function addConfig(Config $config) {
        $this->_configs[] = $config;
    }

    /**
     * @param Index $index
     */
    public function addIndex(Index $index) {
        $this->_indexes[] = $index;
    }

    /**
     * @return string
     */
    public function getContent() {
        $content = '';

        foreach ($this->_configs as $config) {
            $content .= $config->getContent();
        }

        foreach ($this->_sources as $source) {
            $content .= $source->getContent();
        }

        foreach ($this->_indexes as $index) {
            $content .= $index->getContent();
        }

        return $content;
    }

    /**
     * Save content to filepath
     */
    public function saveConfig() {
        file_put_contents($this->filepath, $this->getContent());
    }

}
