<?php

    // redirect to login page if not logged in
    if ( !Authentication::whoCanAccess('user') ) {
        header( 'Location: /login' );
        exit;
    }


  // step 1: set CSRF token
  CSRF::generateToken( 'add_post_form' );

  // step 2: make sure post request
  if ( $_SERVER["REQUEST_METHOD"] === 'POST' ) {

    // step 3: do error check
     $rules = [
      'title' => 'required',
      'content' => 'required',
      'lyrics' => 'required',
      'released' => 'required',
      'album' => 'required',
      'artist' => 'required',
      'genre' => 'required',
      'comment' => 'required',
      'csrf_token' => 'add_post_form_csrf_token',
    ];

    $error = FormValidation::validate(
      $_POST,
      $rules
    );

    // make sure there is no error
    if ( !$error ) {

      // step 4 = add new post
      Post::add(
        $_POST['title'],
        $_POST['content'],
        $_POST['lyrics'],
        $_POST['released'],
        $_POST['album'],
        $_POST['artist'],
        $_POST['genre'],
        $_POST['comment'],
        $_SESSION['user']['id']
      );

      // step 5: remove the CSRF token
      CSRF::removeToken( 'add_post_form' );

      // step 6: redirect to manage posts page
      header("Location: /manage-posts");
      exit;

    } // end - $error


  } // end - $_SERVER["REQUEST_METHOD"]

    require dirname(__DIR__) . '/parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Add New Post</h1>
    </div>
    <div class="card mb-2 p-4">
        <form
            method="POST"
            action="<?php echo $_SERVER["REQUEST_URI"]; ?>">


            <div class="mb-3">
                <label for="post-title" class="form-label">Title</label>
                <input type="text" class="form-control" id="post-title" name="title">
            </div>
            <div class="mb-3">
                <label for="post-content" class="form-label">Content</label>
                <textarea class="form-control" id="post-content" rows="10" name="content"></textarea>
            </div>
            <div class="mb-3">
                <label for="post-lyrics" class="form-label">Lyrics</label>
                <textarea class="form-control" id="post-lyrics" rows="10" name="lyrics"></textarea>
            </div>
            <div class="mb-3">
                <label for="post-released" class="form-label">Released</label>
                <textarea class="form-control" id="post-released" rows="10" name="released"></textarea>
            </div>
            <div class="mb-3">
                <label for="post-album" class="form-label">Album</label>
                <textarea class="form-control" id="post-album" rows="10" name="album"></textarea>
            </div>
            <div class="mb-3">
                <label for="post-artist" class="form-label">Artist</label>
                <textarea class="form-control" id="post-artist" rows="10" name="artist"></textarea>
            </div>
            <div class="mb-3">
                <label for="post-genre" class="form-label">Genre</label>
                <textarea class="form-control" id="post-genre" rows="10" name="genre"></textarea>
            </div>
            <div class="mb-3">
                <label for="post-comment" class="form-label">Featured Comment</label>
                <textarea class="form-control" id="post-comment" rows="10" name="comment"></textarea>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo CSRF::getToken("add_post_form"); ?>" />
        </form>
    </div>
    <div class="text-center">
        <a href="/manage-posts" class="btn btn-link btn-sm"><i class="bi bi-arrow-left"></i> Back to Posts</a>
    </div>
</div>
<?php
    
    require dirname(__DIR__) . '/parts/footer.php';