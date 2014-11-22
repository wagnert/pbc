<?php

/**
 * AppserverIo\PBC\Tests\Data\Stack\AbstractStack
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
 * @subpackage Tests
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */

namespace AppserverIo\PBC\Tests\Data\Stack;

/**
 * @category   Library
 * @package    PBC
 * @subpackage Tests
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 *
 * @invariant is_array($this->container)
 */
class AbstractStack
{
    /**
     * @var array
     */
    protected $container = array();

    /**
     * @ensures is_int($pbcResult)
     */
    public function size()
    {
        return count($this->container);
    }

    /**
     * @requires $this->size() >= 1
     * @ensures $this->size() === $pbcOld->size()
     */
    public function peek()
    {
        $tmp = array_pop($this->container);
        array_push($this->container, $tmp);

        return $tmp;
    }

    /**
     * @requires $this->size() >= 1
     * @ensures $this->size() == $pbcOld->size() - 1
     * @ensures $pbcResult == $pbcOld->peek()
     */
    public function pop()
    {
        return array_pop($this->container);
    }

    /**
     * @ensures $this->size() == $pbcOld->size() + 1
     * @ensures $this->peek() == $obj
     */
    public function push($obj)
    {
        return array_push($this->container, $obj);
    }
}
