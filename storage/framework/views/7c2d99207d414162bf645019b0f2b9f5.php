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
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($r->alumno->apellidos); ?></td>
                    <td><?php echo e($r->alumno->nombres); ?></td>
                    <td><?php echo e(optional($r->alumno->curso)->nombre); ?></td>
                    <td><?php echo e($r->fecha); ?></td>
                    <td><?php echo e($r->estado); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH C:\laragon\www\liceo-tp\resources\views/reportes/asistencia/pdf.blade.php ENDPATH**/ ?>