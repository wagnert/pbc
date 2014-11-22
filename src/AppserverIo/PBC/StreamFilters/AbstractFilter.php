<?php

/**
 * AppserverIo\PBC\StreamFilters\AbstractFilter
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
 * @subpackage StreamFilters
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */

namespace AppserverIo\PBC\StreamFilters;

use AppserverIo\PBC\Interfaces\StreamFilterInterface;

/**
 * This abstract class provides a clean parent class for custom stream filters.
 *
 * @category   Library
 * @package    PBC
 * @subpackage StreamFilters
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */
abstract class AbstractFilter extends \php_user_filter implements StreamFilterInterface
{
    /**
     * Other filters on which we depend
     *
     * @var array $dependencies
     */
    protected $dependencies = array();

    /**
     * Name of the filter (done as seen in \php_user_filter class)
     *
     * @var string $filtername
     *
     * @link http://www.php.net/manual/en/class.php-user-filter.php
     */
    public $filtername = __CLASS__;

    /**
     * The parameter(s) we get passed when appending the filter to a stream
     *
     * @var mixed $params
     *
     * @link http://www.php.net/manual/en/class.php-user-filter.php
     */
    public $params;

    /**
     * Not implemented yet
     *
     * @throws \Exception
     *
     * @return void
     */
    public function dependenciesMet()
    {
        throw new \Exception();
    }

    /**
     * Will return the dependency array
     *
     * @return array
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * Will return the order number the concrete filter has been constantly assigned
     *
     * @return integer
     */
    public function getFilterOrder()
    {
        return self::FILTER_ORDER;
    }
}
