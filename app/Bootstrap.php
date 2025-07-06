<?php

declare(strict_types=1);

namespace App;

use Nette;
use Nette\Bootstrap\Configurator;

class Bootstrap
{
    private Configurator $configurator;
    private string $rootDir;

    public function __construct()
    {
        $this->rootDir = dirname(__DIR__);
        $this->configurator = new Configurator();
        $this->configurator->setTempDirectory($this->rootDir . '/temp');
    }

    public function bootWebApplication(): Nette\DI\Container
    {
        $this->initializeEnvironment();
        $this->setupContainer();
        return $this->configurator->createContainer();
    }

    public function initializeEnvironment(): void
    {
        //$this->configurator->setDebugMode('secret@23.75.345.200'); // enable for your remote IP
        $this->configurator->setDebugMode(getenv('NETTE_DEBUG') === 'true'); // enable for local development
        $this->configurator->enableTracy($this->rootDir . '/log');

        $this->configurator->createRobotLoader()
            ->addDirectory(__DIR__)
            ->register();
    }

    private function setupContainer(): void
    {
        $configDir = $this->rootDir . '/config';
        if (getenv('NETTE_DEBUG') === 'true') {
            $this->configurator->addConfig($configDir . '/local.neon');
        }
        $this->configurator->addConfig($configDir . '/common.neon');
        $this->configurator->addConfig($configDir . '/services.neon');
    }
}
