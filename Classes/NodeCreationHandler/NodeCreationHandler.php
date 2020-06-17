<?php
namespace Hb180\Voice\NodeCreationHandler;

use Neos\ContentRepository\Domain\Model\NodeInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Neos\Ui\NodeCreationHandler\NodeCreationHandlerInterface;

class NodeCreationHandler implements NodeCreationHandlerInterface
{

    /**
     * Set the node title for the newly created Document node
     *
     * @param NodeInterface $node The newly created node
     * @param array $data incoming data from the creationDialog
     * @return void
     */
    public function handle(NodeInterface $node, array $data)
    {
        foreach( $data as $property=>$value ){
            $node->setProperty($property, $value);
        }
    }
}
