<?php

/*
 * Copyright © 2018 CrazyCat, Inc. All rights reserved.
 * See COPYRIGHT.txt for license details.
 */

namespace CrazyCat\Cms\Controller\Cli\Test;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @category CrazyCat
 * @package CrazyCat\Framework
 * @author Bruce Z <152416319@qq.com>
 * @link http://crazy-cat.co
 */
class Index extends \CrazyCat\Framework\App\Module\Controller\Cli\AbstractAction {

    /**
     * @param \Symfony\Component\Console\Command\Command $command
     */
    public function configure( $command )
    {
        $command->setName( 'cms:test' );
        $command->setDescription( 'This is a test.' );
        $command->setHelp( 'How to use the command.' );
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function run( InputInterface $input, OutputInterface $output )
    {
        $output->writeln( 'Hello world' );
    }

}
