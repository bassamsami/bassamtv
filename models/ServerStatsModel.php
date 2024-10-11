<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ServerStatsModel extends CI_Model{
    function __construct()
	{
		parent::__construct();
	}

    function formatSize($size) {
        $units = explode(' ', 'B KB MB GB TB PB');
        $mod = 1024;
        for ($i = 0;$size > $mod;$i++) {
            $size /= $mod;
        }
        $endIndex = strpos($size, ".") + 3;
        return substr($size, 0, $endIndex) . ' ' . $units[$i];
    }

	function _getServerLoadLinuxData()
    {
        if (is_readable("/proc/stat"))
        {
            $stats = @file_get_contents("/proc/stat");

            if ($stats !== false)
            {
                // Remove double spaces to make it easier to extract values with explode()
                $stats = preg_replace("/[[:blank:]]+/", " ", $stats);

                // Separate lines
                $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                $stats = explode("\n", $stats);

                // Separate values and find line for main CPU load
                foreach ($stats as $statLine)
                {
                    $statLineData = explode(" ", trim($statLine));

                    // Found!
                    if
                    (
                        (count($statLineData) >= 5) &&
                        ($statLineData[0] == "cpu")
                    )
                    {
                        return array(
                            $statLineData[1],
                            $statLineData[2],
                            $statLineData[3],
                            $statLineData[4],
                        );
                    }
                }
            }
        }

        return null;
    }

    // Returns server load in percent (just number, without percent sign)
    function getServerLoad()
    {
        $load = null;

        if (stristr(PHP_OS, "win"))
        {
            $cmd = "wmic cpu get loadpercentage /all";
            @exec($cmd, $output);

            if ($output)
            {
                foreach ($output as $line)
                {
                    if ($line && preg_match("/^[0-9]+\$/", $line))
                    {
                        $load = $line;
                        break;
                    }
                }
            }
        }
        else
        {
            if (is_readable("/proc/stat"))
            {
                // Collect 2 samples - each with 1 second period
                // See: https://de.wikipedia.org/wiki/Load#Der_Load_Average_auf_Unix-Systemen
                $statData1 = $this->_getServerLoadLinuxData();
                sleep(1);
                $statData2 =  $this->_getServerLoadLinuxData();

                if
                (
                    (!is_null($statData1)) &&
                    (!is_null($statData2))
                )
                {
                    // Get difference
                    $statData2[0] -= $statData1[0];
                    $statData2[1] -= $statData1[1];
                    $statData2[2] -= $statData1[2];
                    $statData2[3] -= $statData1[3];

                    // Sum up the 4 values for User, Nice, System and Idle and calculate
                    // the percentage of idle time (which is part of the 4 values!)
                    $cpuTime = $statData2[0] + $statData2[1] + $statData2[2] + $statData2[3];

                    // Invert percentage to get CPU time, not idle time
                    $load = 100 - ($statData2[3] * 100 / $cpuTime);
                }
            }
        }

        return $load;
    }

	function GetDirectorySize($path) {
        $bytestotal = 0;
        $path = realpath($path);
        if ($path !== false && $path != '' && file_exists($path)) {
            foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
                $bytestotal += $object->getSize();
            }
        }
        return $bytestotal;
    }

	function getCpuStatus($load) {
		if($load<50) {
			return "Running smoothly";
		} else if($load>50 && $load<90) {
			return "Running normally";
		} else if($load>90) {
			return "Running blocked";
		}
	}

	function getServerMemoryUsage()
    {
        $memoryTotal = null;
        $memoryFree = null;

        if (stristr(PHP_OS, "win")) {
            // Get total physical memory (this is in bytes)
            $cmd = "wmic ComputerSystem get TotalPhysicalMemory";
            @exec($cmd, $outputTotalPhysicalMemory);

            // Get free physical memory (this is in kibibytes!)
            $cmd = "wmic OS get FreePhysicalMemory";
            @exec($cmd, $outputFreePhysicalMemory);

            if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
                // Find total value
                foreach ($outputTotalPhysicalMemory as $line) {
                    if ($line && preg_match("/^[0-9]+\$/", $line)) {
                        $memoryTotal = $line;
                        break;
                    }
                }

                // Find free value
                foreach ($outputFreePhysicalMemory as $line) {
                    if ($line && preg_match("/^[0-9]+\$/", $line)) {
                        $memoryFree = $line;
                        $memoryFree *= 1024;  // convert from kibibytes to bytes
                        break;
                    }
                }
            }
        }
        else
        {
            if (is_readable("/proc/meminfo"))
            {
                $stats = @file_get_contents("/proc/meminfo");

                if ($stats !== false) {
                    // Separate lines
                    $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
                    $stats = explode("\n", $stats);

                    // Separate values and find correct lines for total and free mem
                    foreach ($stats as $statLine) {
                        $statLineData = explode(":", trim($statLine));

                        //
                        // Extract size (TODO: It seems that (at least) the two values for total and free memory have the unit "kB" always. Is this correct?
                        //

                        // Total memory
                        if (count($statLineData) == 2 && trim($statLineData[0]) == "MemTotal") {
                            $memoryTotal = trim($statLineData[1]);
                            $memoryTotal = explode(" ", $memoryTotal);
                            $memoryTotal = $memoryTotal[0];
                            $memoryTotal *= 1024;  // convert from kibibytes to bytes
                        }

                        // Free memory
                        if (count($statLineData) == 2 && trim($statLineData[0]) == "MemFree") {
                            $memoryFree = trim($statLineData[1]);
                            $memoryFree = explode(" ", $memoryFree);
                            $memoryFree = $memoryFree[0];
                            $memoryFree *= 1024;  // convert from kibibytes to bytes
                        }
                    }
                }
            }
        }

        if (is_null($memoryTotal) || is_null($memoryFree)) {
            return null;
        } else {
			return array(
				"total" => $this->formatSize($memoryTotal),
				"free" => $this->formatSize($memoryFree),
				"percentage" => (100 - ($memoryFree * 100 / $memoryTotal)),
			);
        }
    }

	function get_processor_cores_number() {
		if (PHP_OS_FAMILY == 'Windows') {
			$cores = @shell_exec('echo %NUMBER_OF_PROCESSORS%');
		} else {
			$cores = @shell_exec('nproc');
		}
	
		return (int) $cores;
	}

    function getServerStatus() {
		$cpuLoad = number_format($this->getServerLoad());

		$memUsage = $this->getServerMemoryUsage();
		$freememUsage = $memUsage["free"];
		$totalmemUsage = $memUsage["total"];
		$percentagememUsage = number_format($memUsage["percentage"]);

		$disk_free_space = $this->formatSize(disk_free_space("/"));
		$disk_total_space = $this->formatSize(disk_total_space("/"));
		$disk_percentage = number_format((100 - (disk_free_space("/") * 100 / disk_total_space("/"))));

		$cpu_cores = $this->get_processor_cores_number();

		$serverload = number_format(($cpuLoad+$percentagememUsage+$disk_percentage)/3);
		$serverstatus = $this->getCpuStatus($cpuLoad);

		return array(
			"storage" =>  array("free" => "$disk_free_space", "total" => "$disk_total_space", "percentage" => "$disk_percentage"),
			"server" => array("load" => "$serverload", "status" => "$serverstatus"),
			"memory" => array("free" => "$freememUsage", "total" => "$totalmemUsage", "percentage" => "$percentagememUsage"),
			"cpu" => array("cores" => "$cpu_cores", "load" => "$cpuLoad"),
		);
	}

}