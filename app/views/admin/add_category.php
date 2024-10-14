<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Dodaj Kategorię</title>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/admin.css">
    </head>

    <?php include_once '../app/views/common/header.php'; ?>

    <body>
        <section>
            <h1>Dodaj nową kategorię</h1>

            <!-- Wyświetlenie błędu, jeśli coś poszło nie tak -->
            <?php if (isset($data['error'])): ?>
                <p style="color:red;"><?php echo htmlspecialchars($data['error']); ?></p>
            <?php endif; ?>

            <!-- Formularz dodawania nowej kategorii -->
            <form method="POST" action="<?php echo BASE_URL; ?>admin/addCategory">
                <label for="name">Nazwa kategorii:</label>
                <input type="text" name="name" id="name" required><br><br>

                <button type="submit">Dodaj kategorię</button>
            </form>

            <!-- Link powrotu do listy kategorii -->
            <a href="<?php echo BASE_URL; ?>admin/categories">Powrót do listy kategorii</a>
        </section>

        <?php include_once '../app/views/common/footer.php'; ?>
    </body>
</html>