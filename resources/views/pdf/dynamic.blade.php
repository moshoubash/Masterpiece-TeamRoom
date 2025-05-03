<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst($table) }} Report</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
            line-height: 1.4;
        }
        header {
            position: relative;
            height: 80px;
            margin-bottom: 30px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 10px;
        }
        .logo {
            position: absolute;
            top: 0;
            left: 0;
            width: 120px;
        }
        .report-title {
            text-align: center;
            margin-top: 10px;
            color: #000000;
            font-size: 24px;
            font-weight: bold;
        }
        .report-date {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .summary-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .summary-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #1f2937;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
            color: #374151;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        tr:hover {
            background-color: #f3f4f6;
        }
        .no-data {
            text-align: center;
            padding: 30px;
            color: #6b7280;
            font-style: italic;
        }
        footer {
            position: fixed; 
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            font-size: 10px;
            text-align: center;
            color: #6b7280;
            border-top: 1px solid #eaeaea;
            padding-top: 10px;
        }
        .page-number {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <img class="logo" src="{{ public_path('assets/dashboard/images/team-room-light.svg') }}" alt="Logo">
        <h1 class="report-title">{{ ucfirst($table) }} Report</h1>
        <p class="report-date">Generated on: {{ date('F d, Y') }}</p>
    </header>

    <!-- Table -->
    @if($data->isEmpty())
        <div class="no-data">
            <p>No records found.</p>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    @foreach(array_keys((array) $data->first()) as $column)
                        <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        @foreach((array) $row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Footer -->
    <footer>
        <p>Team Room &copy; {{ date('Y') }} - All Rights Reserved</p>
        <p>Page <span class="page-number"></span> of <span class="page-number"></span></p>
    </footer>
</body>
</html>
