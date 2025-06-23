<!DOCTYPE html>
<html>
<head>
    <title>Data Posts</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        h2, .date-range {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Post</h2>

    @if ($start_date && $end_date)
        <div class="date-range">
            <strong>Periode:</strong>
            {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $i => $post)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name ?? '-' }}</td>
                    <td>{{ $post->user->name ?? '-' }}</td>
                    <td>{{ $post->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
