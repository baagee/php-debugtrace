<?php
/**
 * Desc:
 * User: baagee
 * Date: 2020/7/21
 * Time: 下午3:37
 */

namespace BaAGee\DebugTrace;
/**
 * Class DebugTrace
 * @package BaAGee\DebugTrace
 */
final class DebugTrace
{
    /**
     *
     */
    const TYPE_CONSOLE = 'console';
    /**
     *
     */
    const TYPE_HTML = 'html';

    /**
     * @var string
     */
    protected static $showType = 'html';

    /**
     * 初始化设置输出类型
     * @param string $type html or console
     */
    public static function init($type)
    {
        if (in_array($type, [self::TYPE_CONSOLE, self::TYPE_HTML])) {
            self::$showType = $type;
        }
        TraceCollector::setBeginTime(intval(microtime(true) * 1000));
        TraceCollector::setBeginMemory(memory_get_usage());
    }

    /**
     * 结束
     */
    public static function end()
    {
        TraceCollector::setIncludedFiles();
        TraceCollector::setEndMemory(memory_get_usage());
        TraceCollector::setEndTime(intval(microtime(true) * 1000));
    }

    /**
     * 获取输出内容
     * @return string
     */
    public static function output()
    {
        self::end();
        $serverInfo = TraceCollector::getServerInfo();
        $runtime = TraceCollector::getCostTime();
        $reqs = $runtime > 0 ? number_format(1 / ($runtime / 1000), 2) : '∞';
        $data = [
            '基本信息' => [
                '请求信息' => date('Y-m-d H:i:s', $serverInfo['REQUEST_TIME']) . ' ' . $serverInfo['REQUEST_METHOD'] . ' ' . ($serverInfo['PATH_INFO'] ?? '/'),
                '运行时间' => $runtime . 'ms' . ' [吞吐率：' . $reqs . 'req/s]',
                '内存占用' => TraceCollector::getMemoryUsage() . 'kb',
            ],
        ];
        $allLogs = TraceCollector::getLogs();
        $data['SQL'] = $allLogs['SQL'] ?? [];
        unset($allLogs['SQL']);
        $data['调试信息'] = $allLogs;
        $data['请求信息'] = TraceCollector::getRequestInfo();
        $data['Env'] = TraceCollector::getEnvInfo();
        $data['$_SERVER'] = $serverInfo;
        $files = TraceCollector::getIncludedFiles();
        $data['加载文件'] = $files;
        if (self::$showType == self::TYPE_CONSOLE) {
            return (new OutputConsole())->output($data);
        }
        if (self::$showType == self::TYPE_HTML) {
            $data['runtime'] = $runtime;
            return (new OutputHtml())->output($data);
        }
        return '';
    }
}
