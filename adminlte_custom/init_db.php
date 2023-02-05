<?php
/*   Pi-hole: A black hole for Internet advertisements
*    (c) 2017 Pi-hole, LLC (https://pi-hole.net)
*    Network-wide ad blocking via your own hardware.
*
*    This file is copyright under the latest version of the EUPL.
*    Please see LICENSE file for your rights under this license
*/

$api = true;

require 'scripts/pi-hole/php/password.php';

header('Content-Type: text/html; charset=utf-8');
require 'scripts/pi-hole/php/database.php';
require 'scripts/pi-hole/php/auth.php';
require_once 'scripts/pi-hole/php/func.php';
check_cors();

// Set maximum execution time to 10 minutes
ini_set('max_execution_time', '600');

$data = array();

// Needs package php5-sqlite, e.g.
//    sudo apt-get install php5-sqlite

$QUERYDB = getQueriesDBFilename();
$db = SQLite3_connect($QUERYDB, SQLITE3_OPEN_READWRITE);

// Refers to native SQL at https://github.com/pi-hole/FTL/blob/master/test/pihole-FTL.db.sql
function init($db){
  # message table
  $stmt=$db->prepare("DROP TABLE IF EXISTS message");
  $results=$stmt->execute();
  $stmt=$db->prepare("CREATE TABLE message (id INTEGER PRIMARY KEY AUTOINCREMENT, timestamp INTEGER NOT NULL, type TEXT NOT NULL, message TEXT NOT NULL, blob1 BLOB, blob2 BLOB, blob3 BLOB, blob4 BLOB, blob5 BLOB);");
  $results=$stmt->execute();

  # ss_config table
  $stmt=$db->prepare("DROP TABLE IF EXISTS ss_config");
  $results=$stmt->execute();
  $stmt=$db->prepare("CREATE TABLE ss_config (id INTEGER PRIMARY KEY AUTOINCREMENT, date_added INTEGER NOT NULL, date_modified, protocol TEXT NOT NULL, name TEXT NOT NULL, link TEXT NOT NULL, json TEXT NOT NULL);");
  $results=$stmt->execute();


  echo "Database is initialized.";
}

if (isset($_POST['confirmed']) && $auth) {
  init($db);
}
?>
<?php
if ($auth) {
?>
<!DOCTYPE html>
<html>
<head>
</head>

<form action="" method="post" onsubmit="return window.confirm('are you sure that you want to clear database?');">
  <input type="hidden" name="confirmed" value="1"/>
  <input type="submit" value="Clear database" />
</form>

</html>
<?php
}else{
  echo "Unauthorized!";
}
?>
