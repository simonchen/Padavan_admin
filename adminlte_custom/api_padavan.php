<?php
//copyright by simonchen

if (!isset($api)) {
    exit('Direct call to api_padavan.php is not allowed!');
}

if (isset($_GET['getAllQueries']) && $auth) {
    if (is_numeric($_GET['getAllQueries'])) {
        $return = shell_exec('tail -n '.$_GET['getAllQueries'].' /tmp/syslog.log');
    } else {
        // Get all queries
        $return = shell_exec('tail -n 1000 /tmp/syslog.log');
    }
    $lines = explode("\n", $return);
    echo '{"data":[';
    $first = true;
    if (count($lines) > 0){
        foreach($lines as $line){
            $ret = preg_match('/^(\w+\s+\d+\s+\d+\:\d+\:\d+)\s+([^\:]+)\:(.*)/m', $line, $match);
            if ($ret){
                if (!$first) {
                    echo ',';
                } else {
                    $first = false;
                }

                echo json_encode(array($match[1], $match[2], $match[3]));
            }
            //foreach ($matches as $match){
            //    echo json_encode(array($match[1], $match[2]));
            //}
        }
    }
    echo ']}';
    exit;
}

?>
