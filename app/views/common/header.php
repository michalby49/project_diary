<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/styles.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/header.css">
    <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>favicon.png">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<header>
    <a href="<?php echo BASE_URL; ?>home/index" class="home-link">
        <h1>Diary</h1>
    </a>

    <span class="burger-menu" onclick="openNav()">
        <i class="fas fa-bars"></i>
    </span>
</header>

<div id="sidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

    <?php if (isset($_SESSION['user_id'])): ?>
        <a>Witaj <strong><?php echo htmlspecialchars($_SESSION['name']); ?></strong></a>
        <a href="<?php echo BASE_URL; ?>admin/index">Zarządzaj Wydarzeniami</a><br>
        <a href="<?php echo BASE_URL; ?>admin/categories">Zarządzaj Kategoriami</a><br>
        <a href="<?php echo BASE_URL; ?>auth/logout">Wyloguj się</a>
    <?php else: ?>
        <a href="<?php echo BASE_URL; ?>auth/login">Zaloguj się</a>
        <a href="<?php echo BASE_URL; ?>auth/register">Zarejestruj się</a>
    <?php endif; ?>
</div>

<script>
    function openNav() {
        document.getElementById("sidebar").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("sidebar").style.width = "0";
    }
</script>