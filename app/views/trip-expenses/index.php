<h1>Despesas de Viagem</h1>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Motorista</th>
            <th>Veículo</th>
            <th>Valor</th>
            <th>Descrição</th>
            <th>Data</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach ($expenses as $expense): ?>

        <tr>
            <td><?= $expense['id'] ?></td>
            <td><?= $expense['driver_name'] ?? '-' ?></td>
            <td><?= $expense['vehicle_plate'] ?? '-' ?></td>
            <td>R$ <?= number_format($expense['amount'],2,',','.') ?></td>
            <td><?= $expense['description'] ?></td>
            <td><?= $expense['date'] ?></td>
        </tr>

    <?php endforeach; ?>

    </tbody>
</table>