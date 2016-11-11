<?php

namespace HistoryBundle\History;


use HistoryBundle\Entity\History;

/**
 * Interface HistoryItemInterface
 * @package HistoryBundle\Model
 */
interface HistoryItemInterface
{
    /**
     * @return string
     */
    public function label();

    /**
     * @return bool
     */
    public function rollback();

    /**
     * @return boolean
     */
    public function canRollback();
}
