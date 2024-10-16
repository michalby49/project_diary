<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Edytuj Wydarzenie</title>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
    </head>

    <?php include_once './app/views/common/header.php'; ?>

    <body>
        <section>
        <h1>Edytuj Wydarzenie</h1>
            <form method="POST" action="<?php echo BASE_URL; ?>admin/editEvent/<?php echo $data['event']['id']; ?>" onsubmit="return validateForm()">
                <label for="name">Nazwa:</label>
                <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($data['event']['name']); ?>" required><br><br>

                <label for="start_date">Data rozpoczęcia:</label>
                <input type="date" name="start_date" id="start_date" value="<?php echo $data['event']['start_date']; ?>" required><br><br>

                <label for="end_date">Data zakończenia:</label>
                <input type="date" name="end_date" id="end_date" value="<?php echo $data['event']['end_date']; ?>" required><br><br>

                <label for="description">Opis:</label>
                <textarea name="description" id="description" required><?php echo htmlspecialchars($data['event']['description']); ?></textarea><br><br>

                <label for="category">Kategoria:</label>
                <select name="category_id" id="category" required>
                    <?php foreach ($data['categories'] as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
        
                <button type="submit">Zapisz zmiany</button>
            </form>
        </section>

        <?php include_once './app/views/common/footer.php'; ?>

        <script>
            function validateForm() {
                const startDate = new Date(document.getElementById('start_date').value);
                const endDate = new Date(document.getElementById('end_date').value);

                if (endDate < startDate) {
                    alert('Data zakończenia nie może być wcześniejsza niż data rozpoczęcia.');
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
