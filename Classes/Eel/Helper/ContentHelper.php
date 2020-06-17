<?php
namespace Hb180\Voice\Eel\Helper;

/*
 * This file is part of the Neos.Eel package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Eel\CompilingEvaluator;
use Neos\Flow\Annotations as Flow;
use Neos\Eel\ProtectedContextAwareInterface;
use Neos\Utility\Arrays;

class ContentHelper implements ProtectedContextAwareInterface
 {

     /**
      * @param array<NodeInterface> $nodes
      * @return array
      * @throws \Neos\ContentRepository\Exception\NodeException
      */
     public function getItems( $nodes ){

         if( !$nodes ){
             return [];
         }
         $items = [];
         /** @var NodeInterface $node */
         foreach( $nodes as $node ){
             if( $node->getNodeType()->isOfType('Neos.Neos:ContentCollection') ){
                 /** @var NodeInterface $node */
                 foreach( $node->getChildNodes() as $n ){
                     $items[] = $n;
                 }
             }else{
                 $items[] = $node;
             }
         }

         return $items;
     }

     public function br2nl($string){
        return preg_replace('/<br\s*?\/?>/', PHP_EOL, (string)$string);
    }

     /**
      * @param string $methodName
      * @return boolean
      */
     public function allowsCallOfMethod($methodName)
     {
         return true;
     }

 }
