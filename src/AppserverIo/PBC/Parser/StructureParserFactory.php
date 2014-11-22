<?php

/**
 * AppserverIo\PBC\Parser\StructureParserFactory
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
 * @subpackage Parser
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */

namespace AppserverIo\PBC\Parser;

use AppserverIo\PBC\Config;
use AppserverIo\PBC\StructureMap;
use AppserverIo\PBC\Entities\Definitions\StructureDefinitionHierarchy;
use AppserverIo\PBC\Exceptions\ParserException;

/**
 * This class helps us getting the right parser for different structures.
 *
 * @category   Library
 * @package    PBC
 * @subpackage Parser
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io/pbc
 * @link       http://www.appserver.io
 */
class StructureParserFactory
{
    /**
     * Will return the name of the parser class for the needed structure type
     *
     * @param string $type The type of exception we need
     *
     * @return string
     */
    public function getClassName($type)
    {
        return $this->getName($type);
    }

    /**
     * Will return an instance of the parser fitting the structure type we specified
     *
     * @param string                                                             $type                         The
     *      structure type we need a parser for
     * @param string                                                             $file                         The
     *      file we want to parse
     * @param \AppserverIo\PBC\Config                                            $config                       Config
     * @param \AppserverIo\PBC\StructureMap                                      $structureMap                 Struct-
     *      ure map to pass to the parser
     * @param \AppserverIo\PBC\Entities\Definitions\StructureDefinitionHierarchy $structureDefinitionHierarchy The
     *      list of already parsed definitions from the structure's hierarchy
     *
     * @return mixed
     */
    public function getInstance(
        $type,
        $file,
        Config $config,
        StructureMap $structureMap,
        StructureDefinitionHierarchy & $structureDefinitionHierarchy
    ) {
        $name = $this->getName($type);

        return new $name($file, $config, $structureDefinitionHierarchy, $structureMap);
    }

    /**
     * Find the name of the parser class we need
     *
     * @param string $type The structure type we need a parser for
     *
     * @throws \AppserverIo\PBC\Exceptions\ParserException
     *
     * @return string
     */
    private function getName($type)
    {
        // What kind of exception do we need?
        switch ($type) {

            case 'class':

                $name = 'ClassParser';
                break;

            case 'interface':

                $name = 'InterfaceParser';
                break;

            default:

                throw new ParserException('Unknown parser type ' . $type);
                break;
        }

        if (class_exists(__NAMESPACE__ . '\\' . $name)) {

            return __NAMESPACE__ . '\\' . $name;
        }
    }
}
