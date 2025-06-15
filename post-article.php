<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: all-articles.php');
    exit;
}

$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');

if ($title === '' || $content === '') {
    die("Judul dan konten tidak boleh kosong.");
}

$date = date("Y-m-d H:i:s");
$article = ['title' => $title, 'content' => $content, 'date' => $date];

$file = __DIR__ . '/data/articles.json';
$articles = [];

if (file_exists($file)) {
    $json = file_get_contents($file);
    $articles = json_decode($json, true) ?? [];
}

$articles[] = $article;
file_put_contents($file, json_encode($articles, JSON_PRETTY_PRINT));

header('Location: admin.html');
exit;