<?php

/**
 * AppserverIo\PBC\Entities\Definitions\AttributeDefinition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category   Library
 * @package    PBC
 * @subpackage Entities
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */

namespace AppserverIo\PBC\Entities\Definitions;

use AppserverIo\PBC\Interfaces\DefinitionInterface;

/**
 * AppserverIo\PBC\Entities\Definitions\AttributeDefinition
 *
 * Provides a definition of class and trait attributes
 *
 * @category   Php-by-contract
 * @package    AppserverIo\PBC
 * @subpackage Entities
 * @author     Bernhard Wick <b.wick@techdivision.com>
 * @copyright  2014 TechDivision GmbH - <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.techdivision.com/
 */
class AttributeDefinition implements DefinitionInterface
{
    /**
     * @var string $visibility Visibility of the attribute
     */
    public $visibility;

    /**
     * @var boolean $isStatic Is this attribute static?
     */
    public $isStatic;

    /**
     * @var string $name Name of the class attribute
     */
    public $name;

    /**
     * @var mixed $defaultValue Default value (if any)
     */
    public $defaultValue;

    /**
     * @var bool $inInvariant Is this attribute part of the invariant?
     */
    public $inInvariant;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->visibility = 'public';
        $this->isStatic = false;
        $this->name = '';
        $this->defaultValue = null;
        $this->inInvariant = false;
    }

    /**
     * Will return a string representation of this assertion
     *
     * @return string
     */
    public function getString()
    {
        $stringParts = array();

        // Set the visibility
        $stringParts[] = $this->visibility;

        // If we are static, we have to tell so
        if ($this->isStatic === true) {

            $stringParts[] = 'static';
        }

        // Add the name
        $stringParts[] = $this->name;

        // Add any default value we might get
        if ($this->defaultValue !== null) {

            $stringParts[] = '= ' . $this->defaultValue;
        }

        // And don't forget the trailing semicolon
        return implode(' ', $stringParts) . ';';
    }
}
