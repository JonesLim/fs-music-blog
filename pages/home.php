<?php

    require dirname(__DIR__) . '/parts/header.php';
?>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Music Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="text-white"><i class="bi bi-three-dots-vertical"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
          <?php if ( Authentication::isLoggedIn() ) : ?>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" style="color: red" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dashboard
              </a>
              <ul class="dropdown-menu">

                <li>
                  <div class="row">
                    <div class="col">
                      <div class="card mb-2" style="border: none">
                        <div class="card-body">
                          <h5 class="card-title text-center">
                            
                            <h5 class="text-center">Manage Posts</h5>
                          </h5>
                        <div class="text-center mt-3">
                          <a href="/manage-posts" class="btn btn-primary btn-sm"
                            ><i class="bi bi-pencil-square"></i>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>


                <hr />

                <li>
                  <!-- manage users start -->
                  <?php if ( Authentication::whoCanAccess('admin') ) : ?>
                    <div class="col">
                      <div class="card mb-2" style="border: none">
                        <div class="card-body">
                          <h5 class="card-title text-center">
                            
                            <h5 class="text-center">Manage Users</h5>
                          </h5>
                          <div class="text-center mt-3">
                            <a href="/manage-users" class="btn btn-primary btn-sm"
                              ><i class="bi bi-person"></i></a
                            >
                          </div><!-- .text-center -->
                        </div><!-- .card-body -->
                      </div><!-- .card -->
                    </div><!-- .col -->
                  <?php endif; ?>
                  <!-- manage users end -->
                </li>
            </ul>

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

    <div class="container mx-auto my-5" style="max-width: 1000px;">
      <h1 class="h2 mb-4 text-center" style="color: aqua">POPULAR MUSIC</h1>
      <hr />

      <div class="container">
        <div class="row">
        <?php foreach( Post::getPublishPosts() as $post ) : ?>

          <div class="col-md-6">

            <div class="card mb-2">
            <div class="card-body rounded" style="border: 1px red solid">
              <h3 class="card-title"><?php echo $post['title']; ?></h3>
              <p class="card-text">
                By: <?php echo substr( $post['artist'], 0, 50 ); ?>
              </p>
              <p class="card-text">
                Released: <?php echo substr( $post['released'], 0, 50 ); ?>
              </p>
              <div class="text-end">
                <a href="/post?id=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm">Read More</a>
              </div>
              </div>
            </div>

          </div>
          <?php endforeach; ?>

        </div>
      </div>

    </div>

<?php

    require dirname(__DIR__) . '/parts/footer.php';