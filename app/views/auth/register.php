<!-- app/views/auth/register.php -->

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Diary - Rejestracja</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
</head>

    <?php include_once '../app/views/common/header.php'; ?>

    <body>
        <section>
            <h1>Zarejestruj się</h1>

            <?php if (isset($data['error'])): ?>
                <p style="color:red;"><?php echo htmlspecialchars($data['error']); ?></p>
            <?php endif; ?>

            <form method="POST" action="<?php echo BASE_URL; ?>auth/register">
                <label for="name">Nazwa użytkownika:</label>
                <input type="text" name="name" id="name" required><br><br>

                <label for="password">Hasło:</label>
                <input type="password" name="password" id="password" required><br><br>

                <button type="submit">Zarejestruj się</button>
            </form>

            <a href="<?php echo BASE_URL; ?>auth/login">Masz już konto? Zaloguj się</a>
        </section>

        <?php include_once '../app/views/common/footer.php'; ?>
    </body>
</html>
