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
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Data Post</h2>
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
