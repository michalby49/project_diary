<?php
    class HomeController extends Controller {
        public function index() {
            $eventModel = $this->model('Event');
            $events = $eventModel->getAllEvents();

            $userModel = $this->model('User');
            $users = $userModel->getAllUsers();

            $categoryModel = $this->model('Category');
            $categories = $categoryModel->getAllCategories();

            $this->view('home/index', ['events' => $events, 'users' => $users, 'categories' => $categories ]);
        }
    }
?>