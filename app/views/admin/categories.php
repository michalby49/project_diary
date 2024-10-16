<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Zarządzaj Kategoriami</title>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
    </head>

    <?php include_once './app/views/common/header.php'; ?>

    <body>
    <section>
        <h1>Zarządzaj Kategoriami</h1>
        <a href="<?php echo BASE_URL; ?>admin/addCategory">Dodaj nową kategorię</a>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['categories'] as $category): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($category['name']); ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>admin/editCategory/<?php echo $category['id']; ?>">Edytuj</a> |
                                <a href="<?php echo BASE_URL; ?>admin/deleteCategory/<?php echo $category['id']; ?>" onclick="return confirm('Czy na pewno usunąć?');">Usuń</a>
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
