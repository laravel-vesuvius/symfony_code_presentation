<?php

namespace HistoryBundle\Services;

use HistoryBundle\Entity\History;
use HistoryBundle\History\HistoryItemInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;

/**
 * Class HistoryManager
 * @package HistoryBundle\Services
 */
class HistoryManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param History $history
     */
    public function add(History $history)
    {
        $this->em->persist($history);
        $this->em->flush();
    }

    /**
     * @param History $history
     * @return HistoryItemInterface
     */
    public function createFromEntity(History $history)
    {
        $itemClassName = $history->getChangeType();

        return new $itemClassName($this->container, $history);
    }
}
