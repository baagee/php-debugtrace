<?php
/**
 * Desc:
 * User: baagee
 * Date: 2020/7/21
 * Time: 下午10:57
 */

if (!function_exists('\\dump')) {
    function dump(...$variables)
    {
        \BaAGee\DebugTrace\TraceCollector::dump(...$variables);
    }
}

if (!function_exists('\\addTrace')) {
    function addTrace($msg, $type = '')
    {
        if (empty($type)) {
            $type = 'Trace';
        }
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        $msg = $trace['file'] . ':' . $trace['line'] . ' ' . $msg;
        \BaAGee\DebugTrace\TraceCollector::addLog($type, $msg);
    }
}
