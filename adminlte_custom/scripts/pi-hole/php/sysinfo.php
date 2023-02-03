<?php

// Return memory usage to show on status block
function getMemUsage()
{
    $data = explode("\n", file_get_contents('/proc/meminfo'));
    $meminfo = array();
    if (count($data) > 0) {
        foreach ($data as $line) {
            $expl = explode(':', $line);
            if (count($expl) == 2) {
                // remove " kB" from the end of the string and make it an integer
                $meminfo[$expl[0]] = intval(trim(substr($expl[1], 0, -3)));
            }
        }
        $memused = $meminfo['MemTotal'] - $meminfo['MemFree'] - $meminfo['Buffers'] - $meminfo['Cached'];
        $memusage = $memused / $meminfo['MemTotal'];
    } else {
        $memusage = -1;
    }

    return $memusage;
}

// Get CPU load
function getCpuLoads() {
  $loaddata = sys_getloadavg();
  foreach ($loaddata as $key => $value) {
    $loaddata[$key] = round($value, 2);
  }
  return $loaddata;
}

// Get number of processing units available to PHP
// (may be less than the number of online processors)
function getCpuInfo() {
  $nproc = shell_exec('nproc');
  $bogo = '';
  $cpuinfo = array();
  //if (!is_numeric($nproc)) {
    $cpuinfo = file_get_contents('/proc/cpuinfo');
    preg_match_all('/^processor/m', $cpuinfo, $matches);
    $nproc = count($matches[0]);
    preg_match('/^(BogoMIPS)\s+?:\s+?([\d\.]+)/m', $cpuinfo, $matches);
    $bogo = $matches[2];
    $cpuinfo = array("cores"=>$nproc, "bogo"=>$bogo);
  //}

  return $cpuinfo;
}

//echo "Memory usage: ".getMemUsage()."<br/>";

//echo "Loads: ".json_encode($loaddata)."<br/>";

//echo "CPU cores: ".$cpuinfo['cores']." | BogoMIPS: ".$cpuinfo['bogo']."<br/>";

//echo json_encode($cpuinfo);

function getSysInfo() {
  $sysinfo = array("memory_usage"=>getMemUsage(), "loads"=>getCpuLoads(), "cpu"=>getCpuInfo());
  return $sysinfo;
}
//echo json_encode($sysinfo);
?>
