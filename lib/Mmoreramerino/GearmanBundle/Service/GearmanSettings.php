<?php

namespace Mmoreramerino\GearmanBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Parser;
use Mmoreramerino\GearmanBundle\Exceptions\NoSettingsFileExistsException;

/**
 * Class GearmanSettings
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */
class GearmanSettings extends ContainerAware
{
    /**
     * Settings defined into settings file
     *
     * @var Array
     */
    private $settings = null;


    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->setSettings($container->getParameter('gearman_settings'));
    }

    /**
     * Return Gearman settings, previously loaded by method load()
     *
     * @return array Settings getted from file
     */
    public function getSettings()
    {

        return $this->settings;
    }

    /**
     * @param Array $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }
}
