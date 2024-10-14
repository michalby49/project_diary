<?php
// app/controllers/AuthController.php

class AuthController extends Controller {
    public function register() {
        // Jeśli formularz został przesłany
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Załaduj model użytkownika
            $userModel = $this->model('User');

            // Sprawdź, czy użytkownik o takiej nazwie już istnieje
            $existingUser = $userModel->getUserByName($_POST['name']);
            
            if ($existingUser) {
                // Jeśli użytkownik już istnieje, wyświetl błąd
                $this->view('auth/register', ['error' => 'Użytkownik o tej nazwie już istnieje']);
            } else {
                // Dodaj nowego użytkownika do bazy danych
                if ($userModel->addUser($_POST)) {
                    // Przekieruj użytkownika do strony logowania
                    header('Location: ' . BASE_URL . 'auth/login');
                } else {
                    // Jeśli wystąpił błąd podczas dodawania, wyświetl komunikat
                    $this->view('auth/register', ['error' => 'Wystąpił problem podczas rejestracji. Spróbuj ponownie.']);
                }
            }
        } else {
            // Wyświetl formularz rejestracji
            $this->view('auth/register');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $user = $userModel->getUserByName($_POST['name']);

            if ($user && password_verify($_POST['password'], $user['password_hash'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                header('Location: ' . BASE_URL . 'home/index');
            } else {
                $this->view('auth/login', ['error' => 'Nieprawidłowa nazwa użytkownika lub hasło.']);
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'auth/login');
    }
}
