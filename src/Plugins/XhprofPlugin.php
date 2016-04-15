<?php

namespace Waf\Plugins;

use Waf\Plugins\Plugin;

class XhprofPlugin extends Plugin
{

    public function routerStartup(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        xhprof_enable();
    }

    public function dispatchLoopShutdown(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
    {
        // stop profiler
        $xhprof_data = xhprof_disable();

        include_once PROJECT_PATH . "/public/xhprof_lib/utils/xhprof_lib.php";
        include_once PROJECT_PATH . "/public/xhprof_lib/utils/xhprof_runs.php";

        // save raw data for this profiler run using default
        // implementation of iXHProfRuns.
        $xhprof_runs = new \XHProfRuns_Default();

        // save the run under a namespace "xhprof_foo"
        $run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");

        echo "<p><a href=\"http://test.waf.loc/xhprof_html/Index.php?run={$run_id}&source=xhprof_foo\" target=\"_blank\">Xhprof</a></p>";
    }

}
