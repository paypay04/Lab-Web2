<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - <?= $title ?? 'Dashboard'; ?></title>

    <!-- CSS Utama -->
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>">

    <!-- CSS Admin -->
    <link rel="stylesheet" href="<?= base_url('admin-style.css'); ?>">
</head>

<body>

<header class="admin-header">
    <div class="container header-content">

        <div class="nav-left">
            <a href="<?= base_url('admin/artikel'); ?>">
                Dashboard
            </a>

            <a href="<?= base_url('admin/artikel/add'); ?>">
                Tambah Artikel
            </a>

            <a href="<?= base_url('artikel'); ?>">
                Lihat Website
            </a>
        </div>

        <div class="nav-right">

            <span class="user-info">
                Halo, <?= session()->get('user_name') ?? 'Admin'; ?>
            </span>

            <a
                href="<?= base_url('user/logout'); ?>"
                class="logout-btn"
                onclick="return confirm('Yakin ingin logout?')">
                Logout
            </a>

        </div>

    </div>
</header>

<div class="container">