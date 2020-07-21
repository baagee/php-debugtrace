<?php
/**
 * Desc:
 * User: baagee
 * Date: 2020/7/21
 * Time: 下午9:29
 */
include __DIR__ . '/../vendor/autoload.php';

\BaAGee\DebugTrace\DebugTrace::init('console');

$html = <<<HTML
<html>
<header>
<title>test</title>
</header>
<body>

<h1>春晓</h1>

<p>
    春眠不觉晓，
      处处闻啼鸟。
        夜来风雨声，
          花落知多少。
</p>

<p>注意，浏览器忽略了源代码中的排版（省略了多余的空格和换行）。</p>

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
    addTrace('嘿嘿嘿');
    \BaAGee\DebugTrace\TraceCollector::addLog('SQL', 'select * from `scheduling`');
}

test();
$output = \BaAGee\DebugTrace\DebugTrace::output();

echo $output . $html . '</html>';
