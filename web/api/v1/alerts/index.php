<?php
namespace Inquisition\Web;

/**
 *  Alerts API - endpoint for alert-related functionality
 */

$BASE_URL = $_SERVER['DOCUMENT_ROOT'];
require $BASE_URL.'/lib/Autoloader.php';

$cfg = new \Config();
$dbConn = new \DB(
    $cfg->configVals['mysql_database']['db_host'],
    $cfg->configVals['mysql_database']['db_port'],
    $cfg->configVals['mysql_database']['db_name'],
    $cfg->configVals['mysql_database']['db_user'],
    $cfg->configVals['mysql_database']['db_pass']
);
try
{
    $cache = new \Cache();
//    echo $cache->generateCacheHash('abc', [ 'test' => 'string' ]);
}
catch(\Exception $e)
{
    error_log('[ ERROR ] could not start caching engine :: [ MSG: '.$e.' ]');
}

$alertsHandler = new \API\Alerts($dbConn, $cache);

// set http headers
// cache time is currently set to 120 seconds in order to balance caching w/ listing freshness
\Perspective\View::setHTTPHeaders('Content-Type: application/json', 120);

// process incoming get vars
$alertID = null;
$alertType = null;
$startTime = null;
$endTime = null;
$host = null;
$src = null;
$dst = null;
$orderBy = 'created';
$resultLimit = 5;

foreach($_GET as $key => $val)
{
    switch(strtolower($key))
    {
        case 'id':
        case 'i':
            $alertID = $val;
            break;

        case 'type':
        case 't':
            $alertType = $val;
            break;

        case 'after':
        case 'a':
            $startTime = $val;
            break;

        case 'before':
        case 'b':
            $endTime = $val;
            break;

        case 'host':
        case 'h':
            $host = $val;
            break;

        case 'src':
        case 's':
            $src = $val;
            break;

        case 'dst':
        case 'd':
            $dst = $val;
            break;

        case 'order':
        case 'o':
            $orderBy = $val;
            break;

        case 'limit':
        case 'l':
            $resultLimit = $val;
            break;
    }
}

try
{
    // try to fetch alerts, serialize them, and return to the user
    $fetchedAlerts = $alertsHandler->getAlerts($alertID, $alertType,
        [ 'startTime' => $startTime, 'endTime' => $endTime ], [ 'host' => $host, 'src_node' => $src, 'dst_node' => $dst ],
        [ 'orderBy' => $orderBy, 'limit' => $resultLimit ]
    );
    if(count($fetchedAlerts) === 0)
    {
        // no results found
        http_response_code(404);
    }
    else {
        echo json_encode($fetchedAlerts);
    }
} catch(\PDOException $e)
{
    error_log('could not fetch alerts from Inquisition database :: [ SEV: CRIT ] :: [ QUERY: { '
        .$alertsHandler->dbConn->dbQueryOptions['query'].' } :: MSG: [ '.$e->getMessage().' ]');

    http_response_code(500);
}