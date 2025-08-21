<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DatabasePerformanceController extends Controller
{
    public function index()
    {
        $start = microtime(true);
        DB::select('select 1');
        $queryTime = microtime(true) - $start;

        $connection = DB::connection();
        $driver = $connection->getDriverName();
        $database = $connection->getDatabaseName();

        $connectionUsage = null;
        try {
            switch ($driver) {
                case 'mysql':
                    $result = $connection->select("SHOW STATUS WHERE variable_name = 'Threads_connected'");
                    $connectionUsage = $result[0]->Value ?? null;
                    break;
                case 'pgsql':
                    $result = $connection->select('SELECT COUNT(*) as connections FROM pg_stat_activity');
                    $connectionUsage = $result[0]->connections ?? null;
                    break;
                case 'sqlite':
                    $result = $connection->select('PRAGMA database_list');
                    $connectionUsage = count($result);
                    break;
                default:
                    $connectionUsage = null;
            }
        } catch (\Throwable $e) {
            $connectionUsage = null;
        }

        return view('database.performance', [
            'queryTime' => $queryTime,
            'connectionInfo' => [
                'driver' => $driver,
                'database' => $database,
            ],
            'connectionUsage' => $connectionUsage,
        ]);
    }
}
