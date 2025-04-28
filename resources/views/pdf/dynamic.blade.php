<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst($table) }} Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header img {
            width: 150px;
        }
        h2 {
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        footer {
            position: fixed; 
            bottom: 0;
            left: 0;
            right: 0;
            height: 50px;
            font-size: 10px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <img style="position: fixed; top: 20px; left: 20px;" src="{{ public_path('assets/dashboard/images/team-room-light.svg') }}" alt="Logo">
        <h2>{{ ucfirst($table) }} Report</h2>
    </header>

    <!-- Table -->
    @if($data->isEmpty())
        <p>No records found.</p>
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
        Page <span class="page"></span> of <span class="topage"></span>
    </footer>

</body>
</html>
