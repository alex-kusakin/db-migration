<?php

namespace DbMigration;

use N98\Magento\Command\AbstractMagentoCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends AbstractMagentoCommand
{
    const CONFIG_FILE = 'etc/n98-magerun.yaml';

    protected function configure()
    {
        $this
            ->setName('db-migration')
            ->setDescription('Test command')
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->detectMagento($output);
        if ($this->initMagento()) {
            var_dump($this->getCommandConfig());
            $output->writeln(__DIR__ . ' -> ' . __CLASS__);
        }
    }

    public function setupConfig()
    {
        copy(
            __DIR__ . '/../../' . self::CONFIG_FILE,
            $this->getApplication()->getMagentoRootFolder() . '/app/' . self::CONFIG_FILE
        );
    }

}
