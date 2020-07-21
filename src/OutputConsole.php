<?php
/**
 * Desc:
 * User: baagee
 * Date: 2020/7/21
 * Time: 下午4:06
 */

namespace BaAGee\DebugTrace;
/**
 * Class OutputConsole
 * @package BaAGee\DebugTrace
 */
class OutputConsole implements OutputInterface
{
    /**
     * @param $data
     * @return string
     */
    public function output($data)
    {
        $consoleList = "console.group('{$_SERVER['REQUEST_URI']}');" . PHP_EOL;
        foreach ($data as $title => $lines) {
            $consoleList .= $this->console($title, $lines) . PHP_EOL;
        }
        $consoleList .= "console.groupEnd();";
        $consoleList .= "console.log('" . str_repeat('~', 100) . "');";
        return <<<JS
<script type='text/javascript'>
{$consoleList}
</script>
JS;
        /*console.groupCollapsed('分组2');// 默认关闭的分组
        console.table(
                    [
    {key1: 1, key2: 2,  },
    {key1: 12,key2: 22,},
    {key1: 13,key2: '232323232323232323232323232323232323232323232323232323232323232323232323',}
  ]
);
console.groupEnd('分组2');*/
    }

    /**
     * 控制台输出
     * @param string       $type
     * @param string|array $msgList
     * @return string
     */
    protected function console(string $type, $msgList)
    {
        if (empty($msgList)) {
            return '';
        }
        if (in_array($type, ['调试信息', 'SQL', '基本信息'])) {
            $console[] = "console.group('{$type}');";//展开
        } else {
            $console[] = "console.groupCollapsed('{$type}');";//不展开
        }
        foreach ($msgList as $k => $msg) {
            if (is_array($msg)) {
                $console[] = $this->console($k, $msg);
            } else {
                $msg = str_replace(PHP_EOL, '\n', addslashes($msg));
                if (in_array(strtolower($type), ['sql'])) {
                    $style = 'color:#009bb5;';
                } elseif (in_array(strtolower($type), ['基本信息'])) {
                    $style = 'color:#F4006A;font-size:14px;';
                } else {
                    $style = 'color:#CCFFFF';
                }
                $msg = strval($msg);
                $console[] = "console.log(\"%c{$k}: {$msg}\", \"{$style}\");";
            }
        }
        $console[] = "console.groupEnd();";
        return implode(PHP_EOL, $console);
    }
}
