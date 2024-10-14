<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Diary - Aplikacja do zarządzania wydarzeniami</title>

        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/home.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.css" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/pl.min.js"></script>
    </head>

    <?php include_once '../app/views/common/header.php'; ?>

    <body>
        
        <section>
            <div class="filterConteiner">
                <div>
                    <label for="userFilter">Wybierz użytkownika:</label>
                    <select id="userFilter" onchange="filterEventsByUser()">
                        <option value="all">Wszyscy użytkownicy</option>
                        <?php foreach ($data['users'] as $user): ?>
                            <option value="<?php echo htmlspecialchars($user['id']); ?>"><?php echo htmlspecialchars($user['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="categoryFilter">Wybierz kategorie:</label>
                    <select id="categoryFilter" onchange="filterEventsByCategory()">
                        <option value="all">Wszystkie kategorie</option>
                        <option value="none">Bez kategorii</option>
                        <?php foreach ($data['categories'] as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div> 

            <div id="visualization"></div>
        </section>

        <?php include_once '../app/views/common/footer.php'; ?>
    
        <script>
            moment.locale('pl');
            var items = new vis.DataSet([
                <?php foreach ($data['events'] as $event): ?>
                    {
                        id: <?php echo $event['id']; ?>,
                        content: '<?php echo addslashes($event['name']); ?>',
                        start: '<?php echo $event['start_date']; ?>',
                        end: '<?php echo $event['end_date']; ?>',
                        title: '<?php echo addslashes($event['description']); ?>',
                        group: <?php echo json_encode($event['user_id']); ?>,
                        category: <?php echo json_encode($event['category_id']); ?>

                    },
                <?php endforeach; ?>
            ]);

            // Tworzymy grupy użytkowników
            var groups = new vis.DataSet([
                <?php 
                // Używamy tablicy do śledzenia już dodanych użytkowników
                $seenUsers = [];
                foreach ($data['events'] as $event): 
                    if (!in_array($event['user_id'], $seenUsers)): 
                        $seenUsers[] = $event['user_id']; 
                ?>
                    {
                        id: '<?php echo addslashes($event['user_id']); ?>', // Nazwa użytkownika jako id grupy
                        content: '<?php echo addslashes($event['user_name']); ?>' // Wyświetlana nazwa użytkownika
                    },
                <?php 
                    endif;
                endforeach; 
                ?>
            ]);

            // Opcje dla osi czasu
            var options = {
                stack: false,  // Umożliwia wydarzeniom na nakładanie się pionowo
                start: new Date(Date.now() - 1000 * 60 * 60 * 24 * 30),
                end: new Date(Date.now() + 1000 * 60 * 60 * 24 * 30),
                editable: false,  // Oś czasu jest tylko do odczytu
                zoomMin: 1000 * 60 * 60 * 24 * 30, // Minimum przybliżenia: 1 miesiąc
                zoomMax: 1000 * 60 * 60 * 24 * 365 * 10, // Maksymalne oddalenie: 10 lat
                horizontalScroll: true, // Pozwala na przewijanie poziome (skrolowanie)
                zoomKey: 'ctrlKey',  // Przybliżanie/oddalanie możliwe za pomocą klawisza Ctrl i przewijania
                maxHeight: 400,  // Maksymalna wysokość osi czasu
                groupOrder: 'content', // Sortowanie grup według nazwy
                moveable: true,  // Pozwala na przeciąganie osi czasu
            };

            // Inicjalizacja osi czasu z grupami
            var container = document.getElementById('visualization');
            var timeline = new vis.Timeline(container, items, groups, options);

            function openNav() {
            document.getElementById("sidebar").style.width = "250px";
            }

            function closeNav() {
                document.getElementById("sidebar").style.width = "0";
            }

            function filterEventsByUser() {
                var selectedUser = document.getElementById("userFilter").value;

                // Jeśli wybrano "Wszyscy użytkownicy", pokaż wszystkie wydarzenia
                if (selectedUser === 'all') {
                    timeline.setItems(items); // Pokaż wszystkie wydarzenia
                } else {
                    // Filtrowanie wydarzeń dla wybranego użytkownika
                    var filteredItems = items.get({
                        filter: function (item) {
                            return String(item.group) === selectedUser; // Porównujemy user_id z wybraną wartością
                        }
                    });
                    timeline.setItems(filteredItems); // Ustaw filtrowane wydarzenia
                }
            }

            function filterEventsByCategory() {
                var selectedCategory = document.getElementById("categoryFilter").value;

                if (selectedCategory === 'all') {
                    timeline.setItems(items);
                } else if (selectedCategory === 'none'){
                    var filteredItems = items.get({
                        filter: function (item) {
                            return item.category == null;
                        }
                    });
                    timeline.setItems(filteredItems);
                } else {
                    var filteredItems = items.get({
                        filter: function (item) {
                            return String(item.category) === selectedCategory;
                        }
                    });
                    timeline.setItems(filteredItems);
                }
            }
        </script>
    </body>
</html>
