<?php

    // redirect to login page if not logged in
    if ( !Authentication::whoCanAccess('user') ) {
        header( 'Location: /login' );
        exit;
    }

    $post = Post::getPostByID( $_GET['id'] );

    // step 1: set CSRF token
  CSRF::generateToken( 'edit_post_form' );

  // step 2: make sure post request
  if ( $_SERVER["REQUEST_METHOD"] === 'POST' ) {

    // step 3: do error check

      // skip error checking for both fields.
      $rules = [
        'title' => 'required',
        'content' => 'required',
        'lyrics' => 'required',
        'released' => 'required',
        'album' => 'required',
        'artist' => 'required',
        'genre' => 'required',
        'comment' => 'required',
        'status' => 'required',
        'csrf_token' => 'edit_post_form_csrf_token'
      ];

      // if eiter password & confirm_password fields are not empty, 
      // do error check for both fields
      $error = FormValidation::validate(
        $_POST,
        $rules
      );

      // make sure there is no error
      if ( !$error ) {
        // step 4: update post
        Post::update(
          $post['id'], // id
          $_POST['title'], // title
          $_POST['content'], // content
          $_POST['lyrics'], // lyrics
          $_POST['released'], // released
          $_POST['album'], // album
          $_POST['artist'], // artist
          $_POST['genre'], // genre
          $_POST['comment'], // comment
          $_POST['status'], // status
        );

        // step 5: remove the CSRF token
        CSRF::removeToken( 'edit_post_form' );

        // Step 6: redirect to manage users page
        header("Location: /manage-posts");
        exit;

      }
  }

    require dirname(__DIR__) . '/parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 700px;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h1 class="h1">Edit Post</h1>
        </div>
        <div class="card mb-2 p-4">
            <?php require dirname( __DIR__ ) . '/parts/error_box.php'; ?>
            <form
                method="POST"
                action="<?php echo $_SERVER["REQUEST_URI"]; ?>"
                >
                <div class="mb-3">
                    <label for="post-title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="post-title" name="title" value="<?php echo $post['title']; ?>">
                </div>
                <div class="mb-3">
                    <label for="post-content" class="form-label">Content</label>
                    <textarea class="form-control" id="post-content" rows="10" name="content"><?php echo $post['content']; ?></textarea>
                </div>
                <div class="mb-3">
                <label for="post-lyrics" class="form-label">Lyrics</label>
                    <textarea class="form-control" id="post-lyrics" rows="10" name="lyrics"><?php echo $post['lyrics']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="post-released" class="form-label">Released</label>
                    <textarea class="form-control" id="post-released" rows="10" name="released"><?php echo $post['released']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="post-album" class="form-label">Album</label>
                    <textarea class="form-control" id="post-album" rows="10" name="album"><?php echo $post['album']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="post-artist" class="form-label">Artist</label>
                    <textarea class="form-control" id="post-artist" rows="10" name="artist"><?php echo $post['artist']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="post-genre" class="form-label">Genre</label>
                    <textarea class="form-control" id="post-genre" rows="10" name="genre"><?php echo $post['genre']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="post-comment" class="form-label">Featured Comment</label>
                    <textarea class="form-control" id="post-comment" rows="10" name="comment"><?php echo $post['comment']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="post-content" class="form-label">Status</label>
                    <select class="form-control" id="post-status" name="status">
                        <option value="pending" <?php echo ( $post['status'] == 'pending' ? 'selected' : '' ); ?>>Pending for Review</option>
                        <option value="publish" <?php echo ( $post['status'] == 'publish' ? 'selected' : '' ); ?>>Publish</option>
                    </select>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?php echo CSRF::getToken( 'edit_post_form' ); ?>"
                    />
            </form>
        </div>
        <div class="text-center">
            <a href="/manage-posts" class="btn btn-link btn-sm"><i class="bi bi-arrow-left"></i> Back to Posts</a>
        </div>
    </div>
    <?php
    
    require dirname(__DIR__) . '/parts/footer.php';