<?php

/**
 * AppserverIo\PBC\Entities\Lists\TypedListList
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

namespace AppserverIo\PBC\Entities\Lists;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'AbstractTypedList.php';

/**
 * A typed list which is able to contain typed lists by itself.
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
class TypedListList extends AbstractTypedList
{
    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->itemType = 'AppserverIo\PBC\Interfaces\TypedListInterface';
    }

    /**
     * Overwritten implementation of count() which is able to determine the count of contained lists
     * as a whole.
     *
     * @param bool $countChildren Should we count the entries of the contained lists?
     *
     * @return int
     */
    public function count($countChildren = false)
    {
        // If we do not want the children to be counted we can use the parent's count() method
        if ($countChildren !== true) {

            return parent::count();
        }

        $counter = 0;
        foreach ($this->container as $item) {

            $counter += $item->count();
        }

        return $counter;
    }
}
