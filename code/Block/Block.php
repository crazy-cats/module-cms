<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Block;

use CrazyCat\Cms\Model\Block\Collection;
use CrazyCat\Framework\App\ObjectManager;
use CrazyCat\Framework\App\Theme\Block\Context;

/**
 * @category CrazyCat
 * @package CrazyCat\Cms
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Block extends \CrazyCat\Framework\App\Module\Block\AbstractBlock {

    protected $template = 'CrazyCat\Cms::block';

    /**
     * @var \CrazyCat\Cms\Model\Block
     */
    protected $blockModel;

    /**
     * @var \CrazyCat\Framework\App\ObjectManager
     */
    protected $objectManager;

    public function __construct( ObjectManager $objectManager, Context $context, array $data = [] )
    {
        parent::__construct( $context, $data );

        $this->objectManager = $objectManager;
    }

    /**
     * @return \CrazyCat\Cms\Model\Block|null
     */
    public function getBlock()
    {
        if ( $this->blockModel === null ) {
            $this->blockModel = $this->objectManager->create( Collection::class )
                    ->addFieldToFilter( 'identifier', [ 'eq' => $this->getData( 'identifier' ) ] )
                    ->setPageSize( 1 )
                    ->getFirstItem();
        }
        return $this->blockModel;
    }

    /**
     * @return string
     */
    public function toHtml()
    {
        if ( $this->getBlock() === null ) {
            return '';
        }
        return parent::toHtml();
    }

}
