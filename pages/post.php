<?php

    $post = Post::getPostByID( $_GET['id'] );

    require dirname(__DIR__) . '/parts/header.php';
?>
<div class="container mx-auto my-5" style="max-width: 500px;">
    <h1 class="h1 mb-4 text-center"><?php echo $post['title']; ?></h1>

    <div style="color: red"><h5>Content:</h5></div>
    <?php
        // Auto method
        echo nl2br( $post['content'] );
    ?>

    <hr />

    <div style="color: red"><h5>Lyrics:</h5></div>
    <?php
        // Auto method
        echo nl2br( $post['lyrics'] );
    ?>

    <hr />

    <div style="color: red"><h5>Released:</h5></div>
    <?php
        // Auto method
        echo nl2br( $post['released'] );
    ?>

    <hr />

    <div style="color: red"><h5>Album:</h5></div>
    <?php
        // Auto method
        echo nl2br( $post['album'] );
    ?>

    <hr />

    <div style="color: red"><h5>Artist:</h5></div>
    <?php
        // Auto method
        echo nl2br( $post['artist'] );
    ?>

    <hr />

    <div style="color: red"><h5>Genre:</h5></div>
    <?php
        // Auto method
        echo nl2br( $post['genre'] );
    ?>

    <hr />

    <div style="color: red"><h5>Featured Comment:</h5></div>
    <?php
        // Auto method
        echo nl2br( $post['comment'] );
    ?>

    <div class="text-center mt-3">
        <a href="/" class="btn btn-link btn-sm"><i class="bi bi-arrow-left"></i> Back</a>
    </div>
</div>
<?php
    
    require dirname(__DIR__) . '/parts/footer.php';