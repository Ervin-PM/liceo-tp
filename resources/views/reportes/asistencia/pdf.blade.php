<html>
<head>
    <meta charset="utf-8" />
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background: #f3f4f6; }
    </style>
</head>
<body>
    <h2>Reporte de Asistencia</h2>
    <table>
        <thead>
            <tr>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Curso</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $r)
                <tr>
                    <td>{{ $r->alumno->apellidos }}</td>
                    <td>{{ $r->alumno->nombres }}</td>
                    <td>{{ optional($r->alumno->curso)->nombre }}</td>
                    <td>{{ $r->fecha }}</td>
                    <td>{{ $r->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
