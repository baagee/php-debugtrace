<div id="_debug_trace_page_trace"
     style='position: fixed;bottom:0;right:0;font-size:14px;width:100%;z-index: 2147483646;color: #000;text-align:left;font-family: "Segoe UI","Lucida Grande",Helvetica,Arial,"Microsoft YaHei",FreeSans,Arimo,"Droid Sans","wenquanyi micro hei","Hiragino Sans GB","Hiragino Sans GB W3",FontAwesome,sans-serif;'>
    <style>
        #_debug_trace_page_trace_tab_cont > div > ol > li:hover {
            background-color: #e7f4ff;
        }

        #_debug_trace_page_trace_open > img:hover {
            height: 35px;
        }

        #_debug_trace_page_trace_tab_tit {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
    <div id="_debug_trace_page_trace_tab" style="display: none;background:white;margin:0;height: 285px;">
        <div id="_debug_trace_page_trace_tab_tit"
             style="height:30px;padding: 0;background-color:#ddecf9;font-size:16px;border-top:1px solid #ececec;cursor: row-resize">
            <?php foreach ($trace as $key => $value) { ?>
                <span class="tab_56GY67tghyt"
                      style="color:#000;padding:0 10px;height:29px;line-height:29px;display:inline-block;cursor:pointer;font-weight:700"><?php echo $key ?></span>
            <?php } ?>
        </div>
        <div id="_debug_trace_page_trace_tab_cont"
             style="overflow:auto;height:250px;padding:0;line-height: 24px;">
            <?php foreach ($trace as $info) { ?>
                <div style="display:none;">
                    <ol style="padding: 0; margin:0">
                        <?php
                        if (is_array($info)) {
                            foreach ($info as $k => $val) {
                                if (stripos($k, 'variable dump') !== false) {
                                    foreach ($val as $idx => $v) {
                                        $v = is_scalar($v) ? $v : (is_resource($v) ? 'resource' : var_export($v, true));
                                        echo '<li style="word-break:break-all;border-bottom:1px solid #EEE;font-size:14px;padding:0 10px;list-style: none">' . (is_numeric($k) ? '' : $k . ' : ') . trim(htmlentities($v, ENT_COMPAT, 'utf-8'), "\r\n\t'\"") . '</li>';
                                    }
                                } else {
                                    $v = is_scalar($val) ? $val : (is_resource($val) ? 'resource' : var_export($val, true));
                                    echo '<li style="word-break:break-all;border-bottom:1px solid #EEE;font-size:14px;padding:0 10px;list-style: none">' . (is_numeric($k) ? '' : $k . ' : ') . trim(htmlentities($v, ENT_COMPAT, 'utf-8'), "\r\n\t'\"") . '</li>';
                                }
                            }
                        }
                        ?>
                    </ol>
                </div>
            <?php } ?>
        </div>
    </div>
    <div id="_debug_trace_page_trace_close"
         style="display:none;text-align:right;height:30px;position:absolute;top:5px;right:5px;cursor:pointer;">
        <span style="font-weight: bold">
            <img style="vertical-align:top;"
                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAHVSURBVGhD7Zq7SgNBFECDiooKPsDCTrFQsRFrK1GxSKGlpaC1gp9iZWEnlv6Bjb12gr+ghbUiPs4NXhiWMezszqw7cA8cwhLInZMdZoukYxiGYRiGYRj/zzAu41zvKj0jKPPGe1cNc4qv+P3rHS5iCibwAt9QZsnrOcoX0AgnqKGuz7iKMZnGe/TNu8LkDKJ7Z4vGjO4Xq65gUmSAb7BrjOgyseIBJmUWv9A33LVOdNlYsYvJuUXf8KJVokNi5fNHMTnzKMN8iygaEh0S+4472BgSETM6NHYfGydWdBaxSt3orGKVqtFZxiqh0RuYbawSEl3W1sYqMaNbH6vEiM4mVqkTnV2sUiU621hFTmNf2F+eYbaEPGdV2RGyM7KjSqyaXXSdWDWb6BixauujY8aqrY0OiZVHj5zGEuN7v2jrokNj9TkrEdlFV41VsoquG6tkER0rVml19CTGjFVCo5ewEa7Rt4iiIbFKSPQTDmFSZvATfQtwrRKrhERvYVLW0DfYtU6sUjb6CJMyhR/oGy7GiFXKRG9ici7RNzxmrNIv+gEHMDljeIPu8BfcxRTIafyI7jyJXcBGWcdD3MPU/7uQH+K38RhlGzdyZw3DMAzDMAzDUDqdH42NivnoTgEEAAAAAElFTkSuQmCC"
                 height="20px"/>
        </span>
    </div>
</div>
<div id="_debug_trace_page_trace_open" title="点🕷️查看运行信息"
     style="height:35px;float:right;border-radius:5px 0 0 0;text-align:right;overflow:hidden;position:fixed;bottom:0;right:0;color:#000;line-height:35px;cursor:pointer;z-index: 2147483647">
    <img src="data:image/png;base64,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"
         height="30px">
</div>

<script type="text/javascript">
    (function () {
        var b = document.getElementById("_debug_trace_page_trace_tab_tit").getElementsByTagName("span");
        var a = document.getElementById("_debug_trace_page_trace_tab_cont").getElementsByTagName("div");
        var c = document.getElementById("_debug_trace_page_trace_open");
        var h = document.getElementById("_debug_trace_page_trace_close").children[0];
        var f = document.getElementById("_debug_trace_page_trace_tab");
        var e = document.cookie.match(/_debug_trace_show_page_trace=(\d\|\d)/);
        var g = (e && typeof e[1] != "undefined" && e[1].split("|")) || [0, 0];
        c.onclick = function () {
            f.style.display = "block";
            this.style.display = "none";
            h.parentNode.style.display = "block";
            g[0] = 1;
            document.cookie = "_debug_trace_show_page_trace=" + g.join("|")
        };
        h.onclick = function () {
            f.style.display = "none";
            this.parentNode.style.display = "none";
            c.style.display = "block";
            g[0] = 0;
            document.cookie = "_debug_trace_show_page_trace=" + g.join("|")
        };
        for (var d = 0; d < b.length; d++) {
            b[d].onclick = (function (j) {
                return function () {
                    for (var i = 0; i < a.length; i++) {
                        a[i].style.display = "none";
                        b[i].style.color = "#999";
                        b[i].style.backgroundColor = "#ddecf9";
                    }
                    a[j].style.display = "block";
                    b[j].style.color = "#000";
                    b[j].style.backgroundColor = "white";
                    g[1] = j;
                    document.cookie = "_debug_trace_show_page_trace=" + g.join("|")
                }
            })(d)
        }
        parseInt(g[0]) && c.click();
        b[g[1]].click()
    })();
    (function () {
        var oPanel = document.getElementById('_debug_trace_page_trace_tab');
        var oDivList = document.getElementById('_debug_trace_page_trace_tab_cont');
        var oDragIcon = document.getElementById('_debug_trace_page_trace_tab_tit');
        var disY = 0;
        var disH = 0;
        oDragIcon.onmousedown = function (ev) {
            var ev = ev || window.event;
            disY = ev.clientY;
            disH = oPanel.offsetHeight;
            document.onmousemove = function (ev) {
                var ev = ev || window.event;
                //拖拽时为了对宽和高 限制一下范围
                var H = disY - ev.clientY + disH;
                // console.log(document.body.clientHeight)
                // TODO 真实高度
                if (H > document.body.clientHeight) {
                    return
                }
                H = H < 31 ? 31 : H;
                oPanel.style.height = H + 'px';
                oDivList.style.height = (H - 35) + 'px';
            }
            document.onmouseup = function () {
                document.onmousemove = null;
                document.onmouseup = null;
            }
        }
    })()
</script>