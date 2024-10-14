<?php
// public/index.php

// Inicjacja sesji
session_start();

// Ładowanie głównych komponentów aplikacji
require_once '../core/App.php';
require_once '../core/Controller.php';
require_once '../core/Model.php';
require_once '../config/config.php';

// Inicjalizacja aplikacji
$app = new App();
