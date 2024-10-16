<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Panel Administratora</title>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
    </head>
    <?php include_once './app/views/common/header.php'; ?>

    <body>
        <section>
            <h1>Zarządzaj wydarzeniami</h1>
            <a href="<?php echo BASE_URL; ?>admin/addEvent">Dodaj nowe wydarzenie</a>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Data rozpoczęcia</th>
                            <th>Data zakończenia</th>
                            <th>Kategoria</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($data['events'] as $event): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($event['name']); ?></td>
                                <td><?php echo htmlspecialchars($event['start_date']); ?></td>
                                <td><?php echo htmlspecialchars($event['end_date']); ?></td>
                                <td><?php echo htmlspecialchars($event['category_name']); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>admin/editEvent/<?php echo $event['id']; ?>">Edytuj</a> | 
                                    <a href="<?php echo BASE_URL; ?>admin/deleteEvent/<?php echo $event['id']; ?>" onclick="return confirm('Czy na pewno usunąć to wydarzenie?');">Usuń</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <?php include_once './app/views/common/footer.php'; ?>
    </body>
</html>
