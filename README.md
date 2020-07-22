# php-debugtrace

页面或者浏览器控制台输出php调试信息

# 使用
```php
<?php
include __DIR__ . '/../vendor/autoload.php';

// \BaAGee\DebugTrace\DebugTrace::init(\BaAGee\DebugTrace\OutputConsole::class);
\BaAGee\DebugTrace\DebugTrace::init(\BaAGee\DebugTrace\OutputHtml::class);
\BaAGee\DebugTrace\TraceCollector::setEnv(['name' => 'fdasa', 'age' => 2342]);

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

function test($a)
{
    addTrace('卧槽怎么啦');
    addTrace(str_repeat('嘿嘿嘿', 50));
    \BaAGee\DebugTrace\TraceCollector::addLog('SQL', 'select * from `students`');
    \BaAGee\DebugTrace\TraceCollector::addLog('SQL', 'select * from `scheduling`');
    \BaAGee\DebugTrace\TraceCollector::dump(235,$a);
}

$a = [
    'people' => [
        'name' => "dsfsa",
        'age' => 90,
        'home' => [
            'province' => 'asd'
        ]
    ]
];
test($a);
addTrace('哈哈哈');
\BaAGee\DebugTrace\TraceCollector::addLog('what?', $a);
\BaAGee\DebugTrace\TraceCollector::addLog('what?', 'select * from `scheduling`');

dump($a);


$output = \BaAGee\DebugTrace\DebugTrace::output();

echo $output . $html . '</html>';
```