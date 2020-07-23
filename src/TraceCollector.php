<?php
/**
 * Desc:
 * User: baagee
 * Date: 2020/7/21
 * Time: 上午10:47
 */

namespace BaAGee\DebugTrace;
/**
 * Class TraceCollector
 * @package BaAGee\DebugTrace
 */
class TraceCollector
{
    const TRACE_TYPE_SQL   = 'SQL';//SQL信息
    const TRACE_TYPE_DUMP  = 'DUMP';//变量输出
    const TRACE_TYPE_TRACE = 'TRACE';//追踪调试信息
    const TRACE_TYPE_LOG   = 'LOG';//日志信息
    /**
     * @var array
     */
    protected static $logs = [];
    /**
     * @var array
     */
    protected static $env = [];
    /**
     * @var int 毫秒
     */
    protected static $beginTime = 0;

    /**
     * @var int 毫秒
     */
    protected static $endTime = 0;
    /**
     * @var float 初始内存 byte
     */
    protected static $beginMemory = 0.0;
    /**
     * @var float 结束时内存 byte
     */
    protected static $endMemory = 0.0;

    /**
     * @var array
     */
    protected static $includedFiles = [];

    /**
     * @return array
     */
    public static function getLogs(): array
    {
        return self::$logs;
    }

    /**
     * 输出调试变量
     * @param mixed ...$variables
     */
    public static function dump(...$variables)
    {
        if (empty($variables)) {
            return;
        }
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        $pos = $trace['file'] . ':' . $trace['line'];
        foreach ($variables as $variable) {
            $variable = is_scalar($variable) ? $variable : (is_resource($variable) ? 'resource' : var_export($variable, true));
            self::addLog(self::TRACE_TYPE_DUMP, $pos . ' dump ' . $variable);
        }
    }

    /**
     * @param $type
     * @param $log
     */
    public static function addLog($type, $log): void
    {
        self::$logs[$type][] = $log;
    }

    /**
     * @return int
     */
    public static function getBeginTime(): int
    {
        return self::$beginTime;
    }

    /**
     * @param int $beginTime
     */
    public static function setBeginTime(int $beginTime): void
    {
        self::$beginTime = $beginTime;
    }

    /**
     * @return int
     */
    public static function getEndTime(): int
    {
        if (self::$endTime <= 0) {
            self::$endTime = intval(microtime(true) * 1000);
        }
        return self::$endTime;
    }

    /**
     * @param int $endTime
     */
    public static function setEndTime(int $endTime): void
    {
        self::$endTime = $endTime;
    }

    /**
     * @return float
     */
    public static function getBeginMemory(): float
    {
        return self::$beginMemory;
    }

    /**
     * @param float $beginMemory
     */
    public static function setBeginMemory(float $beginMemory): void
    {
        self::$beginMemory = $beginMemory;
    }

    /**
     * @return float
     */
    public static function getEndMemory(): float
    {
        if (self::$endMemory <= 0) {
            self::$endMemory = memory_get_usage();
        }
        return self::$endMemory;
    }

    /**
     * @param float $endMemory
     */
    public static function setEndMemory(float $endMemory): void
    {
        self::$endMemory = $endMemory;
    }

    /**
     * @return array
     */
    public static function getIncludedFiles(): array
    {
        return self::$includedFiles;
    }

    /**
     *
     */
    public static function setIncludedFiles(): void
    {
        $files = get_included_files();
        $info = [];

        foreach ($files as $key => $file) {
            $info[] = $file . ' (' . number_format(filesize($file) / 1024, 2) . ' KB)';
        }
        self::$includedFiles = $info;
    }

    /**
     * @return string
     */
    public static function getCostTime()
    {
        return number_format(self::getEndTime() - self::getBeginTime(), 2, '.', '');
    }

    /**
     * @return string
     */
    public static function getMemoryUsage()
    {
        return number_format((self::getEndMemory() - self::getBeginMemory()) / 1024, 2, '.', '');
    }

    /**
     * @return array
     */
    public static function getServerInfo()
    {
        return $_SERVER;
    }

    /**
     * 添加环境变量
     * @param $envArr
     */
    public static function setEnv($envArr)
    {
        self::$env = array_merge(self::$env, $envArr);
    }

    /**
     * 获取环境变量
     * @return array
     */
    public static function getEnvInfo()
    {
        return array_merge($_ENV, self::$env);
    }

    /**
     * 获取请求信息
     * @return array
     */
    public static function getRequestInfo()
    {
        return [
            'get' => $_GET,
            'post' => $_POST,
            'files' => $_FILES,
            'cookie' => $_COOKIE,
            'session' => $_SESSION ?? array()
        ];
    }
}
