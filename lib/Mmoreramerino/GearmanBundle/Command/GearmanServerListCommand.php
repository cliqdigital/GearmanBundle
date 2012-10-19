<?php

namespace Mmoreramerino\GearmanBundle\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Mmoreramerino\GearmanBundle\Service\GearmanService;

/**
 * Gearman Server List Command class
 *
 * @author Jeroen Derks <jeroen@derks.it>
 */
class GearmanServerListCommand extends ContainerAwareCommand
{
    /**
     * Console Command configuration
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('gearman:server:list')
             ->setDescription('List all Gearman Servers');
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return integer 0 if everything went fine, or an error code
     *
     * @throws \LogicException When this abstract class is not implemented
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var WorkerClass[] $workers  */
        $settings = $this->getContainer()->get('gearman')->getSettings();
        $set = false;
        $it = 1;
        if (isset($settings['defaults']['servers']) && null !== $settings['defaults']['servers']) {
            if (is_array($settings['defaults']['servers'])) {
                foreach ($settings['defaults']['servers'] as $name => $server) {
                    $output->writeln('<comment>' . $server['hostname'] . ':' . (int) $server['port'] . '</comment>');
                    $set = true;
                }
            }
        }
        if (!$set) {
            $output->writeln('<comment>127.0.0.1:4730 *</comment>');
            $output->writeln();
            $output->writeln('<comment>*: default value</comment>');
        }
    }
}