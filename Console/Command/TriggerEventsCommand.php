<?php

declare(strict_types=1);

namespace Denal05\Ad0e702ExerciseSeeEventObserverExecViaLog\Console\Command;

use Hoa\Event\Event;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Manager as EventManager;
use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Api\Data\StoreConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TriggerEventsCommand extends Command
{
    private $_eventManager;

    const EVENT_NAME = 'denal05_ad0e702_demo_event';
    const EVENT_DATA = 'denal05_ad0e702_demo_text';
    const EVENT_DATA_ARRAY_KEY = 'text';
    const EVENT_DATA_ARRAY_VALUE = 'AD0-E702';


    public function __construct(
        EventManager $eventManager
    ) {
        $this->_eventManager = $eventManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('ad0e702:trigger:events');
        $this->setDescription("This command will trigger execution of events and their observers to demo.");

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $exitCode = 0;

        try {
            $demoTextArray = array(self::EVENT_DATA_ARRAY_KEY => self::EVENT_DATA_ARRAY_VALUE);
            $this->_eventManager->dispatch(self::EVENT_NAME, [self::EVENT_DATA => $demoTextArray]);
            $output->writeln('<info>Event Name: ' . self::EVENT_NAME . '</info>');
            $output->writeln('<info>Event Data: ' . self::EVENT_DATA . '</info>');
            $output->writeln('<info>' . var_dump($demoTextArray) . '</info>');
            $output->writeln('<info>The demo events have been triggerred successfully.</info>');
            $output->writeln('<info>Please inspect var/log/Denal05_Ad0e702ExerciseSeeEventObserverExecViaLog/debug.log</info>');
        } catch (LocalizedException $e) {
            $output->writeln(sprintf(
                '<error>%s</error>',
                $e->getMessage()
            ));
            $exitCode = 1;
        }

        return $exitCode;
    }
}
