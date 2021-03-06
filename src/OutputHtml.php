<?php
/**
 * Desc:
 * User: baagee
 * Date: 2020/7/21
 * Time: 下午4:06
 */

namespace BaAGee\DebugTrace;
/**
 * Class OutputHtml
 * @package BaAGee\DebugTrace
 */
class OutputHtml implements OutputInterface
{
    /**
     * @param $trace
     * @return string
     */
    public function output($trace)
    {
        ob_start();
        include __DIR__ . '/tpl/DebugTraceTemplate.php';
        return ob_get_clean();
    }
}
