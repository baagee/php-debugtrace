# php-debugtrace

页面或者浏览器控制台输出php调试信息

# 使用
```php
<?php
include __DIR__ . '/../vendor/autoload.php';

// \BaAGee\DebugTrace\DebugTrace::init(\BaAGee\DebugTrace\OutputConsole::class);
\BaAGee\DebugTrace\DebugTrace::init(\BaAGee\DebugTrace\OutputHtml::class);

$html = <<<HTML
<html>
<header>
<title>test</title>
</header>
<body>
aaa
</body>
HTML;

\BaAGee\DebugTrace\TraceCollector::dump(true, false, 'aaa', 241, 33.44,
    new ReflectionClass(\BaAGee\DebugTrace\TraceCollector::class),
    function () {
    }, fopen(__FILE__, 'r'), ['age' => 20, 'name' => '斯托克']);
$a = ['name' => 'name', 'age' => 90];
dump($a, 23542);

function test()
{
    \BaAGee\DebugTrace\TraceCollector::addLog('SQL', 'select * from `students`');
    addTrace('卧槽怎么啦');
    addTrace(str_repeat('嘿嘿嘿', 50));
    \BaAGee\DebugTrace\TraceCollector::addLog('SQL', 'select * from `scheduling`');
}

test();

addTrace('哈哈哈');
\BaAGee\DebugTrace\TraceCollector::addLog('what?', 'select * from `scheduling`');
\BaAGee\DebugTrace\TraceCollector::setEnv([
    'name'=>'fdasa','age'=>2342
]);
$output = \BaAGee\DebugTrace\DebugTrace::output();

echo $output . $html . '</html>';
```