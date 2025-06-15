<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Semua Artikel</title>
    <link rel="stylesheet" href="css/article.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html" class="active">Home</a></li>
                <li><a href="about.html">Tentang kami</a></li>
                <li><a href="service.html">Servis</a></li>
                <li><a href="product.html">Produk</a></li>
                <li><a href="contact.html">Kontak Kami</a></li>
                <li><a href="all-articles.php">Artikel</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Semua Artikel</h1>
        <div class="button-container">
            <form action="request-code.php" method="POST">
                <input type="email" name="email" placeholder="Masukkan email admin" required>
                <button type="submit">Login Admin</button>
            </form>
        </div>

        <?php
        $filePath = __DIR__ . '/data/articles.json';
        $articles = [];

        if (file_exists($filePath)) {
            $json = file_get_contents($filePath);
            $articles = json_decode($json, true);
        } else {
            echo "<p>Tidak dapat menemukan file articles.json.</p>";
        }

        if (!empty($articles)) {
            foreach ($articles as $article) {
                $title = htmlspecialchars($article['title'] ?? '(Tanpa Judul)');
                $content = htmlspecialchars($article['content'] ?? '');
                $date = htmlspecialchars($article['date'] ?? '');

                echo "<div class='article-card'>";
                echo "<h3>$title</h3>";
                echo "<p>$content</p>";
                echo "<small class='date'>$date</small>";
                echo "</div>";
            }
        } else {
            echo "<p>Belum ada artikel yang tersedia.</p>";
        }
        ?>
    </div>
</body>
</html>