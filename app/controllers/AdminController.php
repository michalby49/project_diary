<?php
    class AdminController extends Controller {
        public function index() {
            $eventModel = $this->model('Event');
            $user_id = $_SESSION['user_id'];

            $events = $eventModel->getEventsByUserId($user_id);
            $this->view('admin/index', ['events' => $events]);
        }

        public function addEvent() {
            $categoryModel = $this->model('Category');
            $categories = $categoryModel->getAllCategories();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $eventData = [
                    'name' => $_POST['name'] ?? null,
                    'start_date' => $_POST['start_date'] ?? null,
                    'end_date' => $_POST['end_date'] ?? null,
                    'description' => $_POST['description'] ?? '',
                    'category_id' => $_POST['category_id'] ?? null,
                    'user_id' => $_SESSION['user_id']
                ];

                if(!$this->validateEvent($eventData)){
                    header('Location: ' . BASE_URL . 'admin/addEvent');
                    exit;
                }

                $eventModel = $this->model('Event');

                if ($eventModel->addEvent($eventData)) {
                    header('Location: ' . BASE_URL . 'admin/index');
                } else {
                    $this->view('admin/add_event', ['categories' => $categories, 'error' => 'Wystąpił problem podczas dodawania wydarzenia.']);
                }
            } else {
                $this->view('admin/add_event', ['categories' => $categories]);
            }
        }

        public function editEvent($id) {
            $eventModel = $this->model('Event');
            $categoryModel = $this->model('Category');
            $event = $eventModel->getEventById($id);
            $categories = $categoryModel->getAllCategories();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $eventData = [
                    'id' => $id,
                    'name' => $_POST['name'] ?? null,
                    'start_date' => $_POST['start_date'] ?? null,
                    'end_date' => $_POST['end_date'] ?? null,
                    'description' => $_POST['description'] ?? '',
                    'category_id' => $_POST['category_id'] ?? null,
                    'user_id' => $_SESSION['user_id']
                ];

                if(!$this->validateEvent($eventData)){
                    header('Location: ' . BASE_URL . 'admin/editEvent/' . $id);
                    exit;
                }

                $eventModel->updateEvent($eventData);
                header('Location: ' . BASE_URL . 'admin/index');
            }

            $this->view('admin/edit_event', ['event' => $event, 'categories' => $categories]);
        }

        public function deleteEvent($id) {
            $eventModel = $this->model('Event');
            $eventModel->deleteEvent($id);
            header('Location: ' . BASE_URL . 'admin/index');
        }

        public function categories() {
            $categoryModel = $this->model('Category');
            $categories = $categoryModel->getAllCategories();
            $this->view('admin/categories', ['categories' => $categories]);
        }

        public function addCategory() {
            $categoryModel = $this->model('Category');
            $categories = $categoryModel->getAllCategories();

            $this->view('admin/add_category', ['categories' => $categories]);
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $categoryModel = $this->model('Category');
                $categoryModel->addCategory($_POST);
                header('Location: ' . BASE_URL . 'admin/categories');
            } else {
                $this->view('admin/add_category');
            }
        }

        public function editCategory($id) {
            $categoryModel = $this->model('Category');
            $category = $categoryModel->getCategoryById($id);

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $categoryModel->updateCategory($id, $_POST);
                header('Location: ' . BASE_URL . 'admin/categories');
            } else {
                $this->view('admin/edit_category', ['category' => $category]);
            }
        }

        public function deleteCategory($id) {
            $categoryModel = $this->model('Category');
            $categoryModel->deleteCategory($id);
            header('Location: ' . BASE_URL . 'admin/categories');
        }

        private function validateEvent($eventData){
            if (empty($eventData['name']) || empty($eventData['start_date']) || empty($eventData['end_date'])) {
                $_SESSION['error'] = 'Wszystkie pola są wymagane.';

                return false;
                header('Location: ' . BASE_URL . 'admin/editEvent/' . $id);
                exit;
            }

            if (strtotime($eventData['end_date']) < strtotime($eventData['start_date'])) {
                $_SESSION['error'] = 'Data zakończenia nie może być wcześniejsza niż data rozpoczęcia.';

                return false;
            }

            return true;
        }
    }
?>
