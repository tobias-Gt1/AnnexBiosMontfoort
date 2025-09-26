<?php
include 'array.php';

// Pak de id uit de URL (standaard 1)
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

if (!isset($movies[$id])) {
    die("Movie not found!");
}

$movie = $movies[$id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($movie['title']) ?> - AnnexBiosMontfoort</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">

    <!-- Titel -->
    <div class="title"><?= htmlspecialchars($movie['title']) ?></div>

    <!-- Film sectie -->
    <div class="movie-section">
      <!-- Poster -->
      <div class="poster">
        <img src="<?= $movie['poster'] ?>" alt="Movie Poster">
      </div>

      <!-- Details -->
      <div class="details">
        <div class="stars"><?= $movie['stars'] ?></div>

        <!-- categorie iconen -->
        <div class="categories">
          <?php foreach ($movie['categories'] as $cat): ?>
            <img src="<?= $cat ?>" alt="Categorie">
          <?php endforeach; ?>
        </div>

        <div class="release"><strong>Release:</strong> <?= $movie['release'] ?></div>

        <div class="description"><?= $movie['description'] ?></div>

        <div class="extra-info">
          <p><strong>Genre:</strong> <?= $movie['genre'] ?></p>
          <p><strong>Film length:</strong> <?= $movie['length'] ?></p>
          <p><strong>Country:</strong> <?= $movie['country'] ?></p>
          <p><strong>IMDb score:</strong> <?= $movie['imdb'] ?></p>
          <p><strong>Director:</strong> <?= $movie['director'] ?></p>
        </div>

        <div class="cast">
          <strong>Actors:</strong>
          <div class="cast-list">
            <?php foreach ($movie['actors'] as $actor): ?>
              <div>
                <img src="<?= $actor['img'] ?>" alt="<?= htmlspecialchars($actor['name']) ?>">
                <p><?= htmlspecialchars($actor['name']) ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Tickets -->
    <div class="ticket-section">
      <a href="#" class="ticket-button">BUY YOUR TICKETS</a>
    </div>

    <!-- Trailer -->
    <div class="trailer">
      <iframe src="<?= $movie['trailer'] ?>" allowfullscreen></iframe>
    </div>

  </div>
</body>
</html>