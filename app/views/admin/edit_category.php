<!-- app/views/admin/edit_category.php -->

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Edytuj Kategorię</title>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/admin.css">
    </head>

    <?php include_once '../app/views/common/header.php'; ?>

    <body>
        <section>
            <h1>Edytuj Kategorię</h1>

            <form method="POST" action="<?php echo BASE_URL; ?>admin/editCategory/<?php echo $data['category']['id']; ?>">
                <label for="name">Nazwa kategorii:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($data['category']['name']); ?>" required><br><br>
                <button type="submit">Zapisz zmiany</button>
            </form>
        </section>

        <?php include_once '../app/views/common/footer.php'; ?>
    </body>
</html>
