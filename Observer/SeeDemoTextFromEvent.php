<?php
declare(strict_types=1);

namespace Denal05\Ad0e702ExerciseSeeEventObserverExecViaLog\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

class SeeDemoTextFromEvent implements \Magento\Framework\Event\ObserverInterface
{
    private $logger;

    public function __construct(
        PsrLoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $exitCode = 0;

        try {
            $fetchedDataFromEvent = $observer->getData('denal05_text');
            $this->logger->debug(__METHOD__ . ': ' . $fetchedDataFromEvent['text']);
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
            $exitCode = 1;
        }

        return $exitCode;
    }
}
