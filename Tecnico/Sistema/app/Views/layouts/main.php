<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= esc($title ?? 'Repostería Misves') ?></title>
<link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
<header class="topbar"><a class="brand" href="<?= site_url('/') ?>">Misves<span>.</span></a><nav><a href="<?= site_url('catalogo') ?>">Catálogo</a><?php if (session()->get('logueado')): ?><a href="<?= site_url('dashboard') ?>">Panel</a><a href="<?= site_url('perfil') ?>">Perfil</a><a class="button small" href="<?= site_url('logout') ?>">Salir</a><?php else: ?><a class="button small" href="<?= site_url('login') ?>">Ingresar</a><?php endif; ?></nav></header>
<?php if ($msg = session()->getFlashdata('success')): ?><div class="alert success"><?= esc($msg) ?></div><?php endif; ?>
<?php if ($msg = session()->getFlashdata('error')): ?><div class="alert error"><?= esc($msg) ?></div><?php endif; ?>
<?= $this->renderSection('content') ?>
<footer><p>Repostería Misves · Hecho con cariño</p></footer>
</body></html>
