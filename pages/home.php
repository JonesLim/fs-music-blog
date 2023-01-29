<?php

    require dirname(__DIR__) . '/parts/header.php';
?>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Music Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
          <?php if ( Authentication::isLoggedIn() ) : ?>
            <li class="nav-item">
              <a href="/dashboard" class="btn btn-link btn-sm">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="/logout" class="btn btn-link btn-sm">Logout</a>
            </li>
            <?php else : ?>
            <li class="nav-item">
              <a href="/login" class="btn btn-link btn-sm">Login</a>
            </li>
            <li class="nav-item">
              <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>
            </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h2 mb-4 text-center" style="color: aqua">POPULAR MUSIC</h1>
      <hr />
      <?php foreach( Post::getPublishPosts() as $post ) : ?>
        <div class="card mb-2">
          <div class="card-body">
            <h3 class="card-title"><?php echo $post['title']; ?></h3>
            <p class="card-text">
              By: <?php echo substr( $post['artist'], 0, 50 ); ?>
            </p>
            <p class="card-text">
              Released: <?php echo substr( $post['released'], 0, 50 ); ?>
            </p>
            <div class="text-end">
              <a href="/post?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

<?php

    require dirname(__DIR__) . '/parts/footer.php';