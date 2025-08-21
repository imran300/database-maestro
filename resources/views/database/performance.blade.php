<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Database Performance</title>
</head>
<body>
    <h1>Database Performance</h1>
    <div>
        <h2>Query Performance</h2>
        <p>{{ number_format($queryTime * 1000, 2) }} ms</p>
    </div>
    <div>
        <h2>Connection Usage</h2>
        @if($connectionUsage !== null)
            <p>{{ $connectionUsage }} active connections</p>
        @else
            <p>Not available</p>
        @endif
        <p>Driver: {{ $connectionInfo['driver'] }}, Database: {{ $connectionInfo['database'] }}</p>
    </div>
</body>
</html>
