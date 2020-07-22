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
        if (empty($variables)) {
            return;
        }
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        $pos = $trace['file'] . ':' . $trace['line'];
        foreach ($variables as $variable) {
            $variable = is_scalar($variable) ? $variable : (is_resource($variable) ? 'resource' : var_export($variable, true));
            \BaAGee\DebugTrace\TraceCollector::addLog(\BaAGee\DebugTrace\TraceCollector::TRACE_TYPE_DUMP, $pos . ' dump ' . $variable);
        }
    }
}

if (!function_exists('\\addTrace')) {
    function addTrace(string $msg)
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        $msg = $trace['file'] . ':' . $trace['line'] . ' ' . $msg;
        \BaAGee\DebugTrace\TraceCollector::addLog(\BaAGee\DebugTrace\TraceCollector::TRACE_TYPE_TRACE, $msg);
    }
}
