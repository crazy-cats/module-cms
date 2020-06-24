<?php

/*
 * Copyright © 2020 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Content\Block;

use CrazyCat\Content\Model\Block\Collection;
use CrazyCat\Framework\App\Component\Theme\Block\Context;

/**
 * @category CrazyCat
 * @package  CrazyCat\Content
 * @author   Liwei Zeng <zengliwei@163.com>
 * @link     https://crazy-cat.cn
 */
class Block extends \CrazyCat\Framework\App\Component\Module\Block\AbstractBlock
{
    protected $template = 'CrazyCat\Content::block';

    /**
     * @var \CrazyCat\Content\Model\Block
     */
    protected $blockModel;

    /**
     * @var \CrazyCat\Framework\App\ObjectManager
     */
    protected $objectManager;

    public function __construct(
        \CrazyCat\Framework\App\ObjectManager $objectManager,
        \CrazyCat\Framework\App\Component\Theme\Block\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->objectManager = $objectManager;
    }

    /**
     * @return \CrazyCat\Content\Model\Block|null
     * @throws \ReflectionException
     */
    public function getBlock()
    {
        if ($this->blockModel === null) {
            $this->blockModel = $this->objectManager->create(Collection::class)
                ->addFieldToFilter('identifier', ['eq' => $this->getData('identifier')])
                ->setArticleSize(1)
                ->getFirstItem();
        }
        return $this->blockModel;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function toHtml()
    {
        if ($this->getBlock() === null) {
            return '';
        }
        return parent::toHtml();
    }
}
