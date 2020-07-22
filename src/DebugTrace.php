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
     * @var string
     */
    protected static $outputClass = OutputHtml::class;

    /**
     * 初始化设置输出类型
     * @param string $outputClass
     */
    public static function init($outputClass = OutputHtml::class)
    {
        if (class_exists($outputClass) && in_array(\BaAGee\DebugTrace\OutputInterface::class, class_implements($outputClass))) {
            self::$outputClass = $outputClass;
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
        return (new self::$outputClass())->output($data);
    }
}
