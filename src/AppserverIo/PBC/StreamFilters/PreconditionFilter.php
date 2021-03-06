<?php

/**
 * AppserverIo\PBC\StreamFilters\PreconditionFilter
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

use AppserverIo\PBC\Entities\Definitions\FunctionDefinition;
use AppserverIo\PBC\Entities\Lists\TypedListList;

/**
 * This filter will buffer the input stream and add all precondition related information at prepared locations
 * (see $dependencies).
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
class PreconditionFilter extends AbstractFilter
{

    /**
     * @const integer FILTER_ORDER Order number if filters are used as a stack, higher means below others
     */
    const FILTER_ORDER = 1;

    /**
     * @var array $dependencies Other filters on which we depend
     */
    protected $dependencies = array('SkeletonFilter');

    /**
     * The main filter method.
     * Implemented according to \php_user_filter class. Will loop over all stream buckets, buffer them and perform
     * the needed actions.
     *
     * @param resource $in       Incoming bucket brigade we need to filter
     * @param resource $out      Outgoing bucket brigade with already filtered content
     * @param integer  $consumed The count of altered characters as buckets pass the filter
     * @param boolean  $closing  Is the stream about to close?
     *
     * @throws \AppserverIo\PBC\Exceptions\GeneratorException
     *
     * @return integer
     *
     * @link http://www.php.net/manual/en/php-user-filter.filter.php
     */
    public function filter($in, $out, &$consumed, $closing)
    {
        // Get our buckets from the stream
        while ($bucket = stream_bucket_make_writeable($in)) {

            // Get the tokens
            $tokens = token_get_all($bucket->data);

            // Go through the tokens and check what we found
            $tokensCount = count($tokens);
            for ($i = 0; $i < $tokensCount; $i++) {

                // Did we find a function? If so check if we know that thing and insert the code of its preconditions.
                if (is_array($tokens[$i]) && $tokens[$i][0] === T_FUNCTION && is_array($tokens[$i + 2])) {

                    // Get the name of the function
                    $functionName = $tokens[$i + 2][1];

                    // Check if we got the function in our list, if not continue
                    $functionDefinition = $this->params->get($functionName);

                    if (!$functionDefinition instanceof FunctionDefinition) {

                        continue;

                    } else {

                        // Get the code for the assertions
                        $code = $this->generateCode($functionDefinition->getAllPreconditions());


                        // Insert the code
                        $bucket->data = str_replace(
                            PBC_PRECONDITION_PLACEHOLDER . $functionDefinition->getName() .
                            PBC_PLACEHOLDER_CLOSE,
                            $code,
                            $bucket->data
                        );

                        // "Destroy" code and function definition
                        $code = null;
                        $functionDefinition = null;
                    }
                }
            }

            // Tell them how much we already processed, and stuff it back into the output
            $consumed += $bucket->datalen;
            stream_bucket_append($out, $bucket);
        }

        return PSFS_PASS_ON;
    }

    /**
     * Will generate the code needed to enforce made precondition assertions
     *
     * @param \AppserverIo\PBC\Entities\Lists\TypedListList $assertionLists List of assertion lists
     *
     * @return string
     */
    private function generateCode(TypedListList $assertionLists)
    {
        // We only use contracting if we're not inside another contract already
        $code = '/* BEGIN OF PRECONDITION ENFORCEMENT */
        if (' . PBC_CONTRACT_CONTEXT . ') {
            $passedOne = false;' .
            PBC_FAILURE_VARIABLE . ' = array();';

        // We need a counter to check how much conditions we got
        $conditionCounter = 0;
        $listIterator = $assertionLists->getIterator();
        for ($i = 0; $i < $listIterator->count(); $i++) {

            // Create the inner loop for the different assertions
            $assertionIterator = $listIterator->current()->getIterator();

            // Only act if we got actual entries
            if ($assertionIterator->count() === 0) {

                // increment the outer loop
                $listIterator->next();
                continue;
            }

            $codeFragment = array();
            for ($j = 0; $j < $assertionIterator->count(); $j++) {

                $codeFragment[] = $assertionIterator->current()->getString();

                $assertionIterator->next();
            }

            // Preconditions need or-ed conditions so we make sure only one conditionlist gets checked
            $conditionCounter++;

            // Code to catch failed assertions
            $code .= 'if ($passedOne === false && !((' .
                implode(') && (', $codeFragment) . '))){' .
                PBC_FAILURE_VARIABLE . '[] = \'(' . str_replace('\'', '"', implode(') && (', $codeFragment)) . ')\';
                } else {$passedOne = true;}';

            // increment the outer loop
            $listIterator->next();
        }

        // Preconditions need or-ed conditions so we make sure only one conditionlist gets checked
        $code .= 'if ($passedOne === false){' .
            PBC_FAILURE_VARIABLE . ' = implode(" and ", ' . PBC_FAILURE_VARIABLE . ');' .
            PBC_PROCESSING_PLACEHOLDER . 'precondition' . PBC_PLACEHOLDER_CLOSE . '
            }';

        // Closing bracket for contract depth check
        $code .= '}
            /* END OF PRECONDITION ENFORCEMENT */';

        // If there were no assertions we will just return a comment
        if ($conditionCounter === 0) {

            return '/* No preconditions for this function/method */';
        }

        return $code;
    }
}
