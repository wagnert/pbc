<?php

/**
 * AppserverIo\PBC\Entities\Definitions\AbstractStructureDefinition
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

use AppserverIo\PBC\Entities\Lists\FunctionDefinitionList;
use AppserverIo\PBC\Interfaces\StructureDefinitionInterface;

/**
 * AppserverIo\PBC\Entities\Definitions\AbstractStructureDefinition
 *
 * This class acts as a DTO-like (we are not immutable due to protected visibility)
 * entity for describing class definitions
 *
 * @category   Php-by-contract
 * @package    AppserverIo\PBC
 * @subpackage Entities
 * @author     Bernhard Wick <b.wick@techdivision.com>
 * @copyright  2014 TechDivision GmbH - <info@techdivision.com>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.techdivision.com/
 */
abstract class AbstractStructureDefinition extends AbstractDefinition implements StructureDefinitionInterface
{
    /**
     * @var string $path File path to the class definition
     */
    protected $path;

    /**
     * @var string $namespace The namespace the class belongs to
     */
    protected $namespace;

    /**
     * @var array $usedNamespaces All classes which are referenced by the "use" keyword
     */
    protected $usedNamespaces;

    /**
     * @var string $docBlock The initial class docblock header
     */
    protected $docBlock;

    /**
     * @var string $name Name of the class
     */
    protected $name;

    /**
     * @var string $extends Name of the parent class (if any)
     */
    protected $extends;

    /**
     * @var array $constants Class constants
     */
    protected $constants;

    /**
     * @var \AppserverIo\PBC\Entities\Lists\FunctionDefinitionList $functionDefinitions List of methods this class
     *          defines
     */
    protected $functionDefinitions;

    /**
     * Getter method for attribute $constants
     *
     * @return array
     */
    public function getConstants()
    {
        return $this->constants;
    }

    /**
     * Getter method for attribute $docBlock
     *
     * @return string
     */
    public function getDocBlock()
    {
        return $this->docBlock;
    }

    /**
     * Getter method for attribute $extends
     *
     * @return string
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * Getter method for attribute $functionDefinitions
     *
     * @return null|\AppserverIo\PBC\Entities\Lists\FunctionDefinitionList
     */
    public function getFunctionDefinitions()
    {
        return $this->functionDefinitions;
    }

    /**
     * Getter method for attribute $name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter method for attribute $namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Getter method for attribute $path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Getter method for attribute $usedNamespace
     *
     * @return array
     */
    public function getUsedNamespaces()
    {
        return $this->usedNamespaces;
    }

    /**
     * Will return the qualified name of a structure
     *
     * @return string
     */
    public function getQualifiedName()
    {
        if (empty($this->namespace)) {

            return $this->name;

        } else {

            return $this->namespace . '\\' . $this->name;
        }
    }

    /**
     * Does this structure have parent structures.
     * We are talking parents here, not implemented interfaces or used traits
     *
     * @return boolean
     */
    public function hasParents()
    {
        return !empty($this->extends);
    }
}
