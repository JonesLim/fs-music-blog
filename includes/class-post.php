<?php

class Post
{
     /**
     * Retrieve all posts from database
     */
    public static function getAllPosts( $user_id )
    {
        // if is a normal user
        if ( Authentication::isUser() ) {
            return DB::connect()->select(
                'SELECT * FROM posts WHERE user_id = :id ORDER BY id DESC',
                [
                    'id' => $user_id
                ],
                true
            );
        }
        return DB::connect()->select(
            'SELECT * FROM posts ORDER BY id DESC',
            [],
            true
        );
    }

    /**
     * Retrieve post data by id
     */
    public static function getPostByID( $post_id )
    {
        return DB::connect()->select(
            'SELECT * FROM posts WHERE id = :id',
            [
                'id' => $post_id
            ]
        );
    }

    /**
     * Retrieve all the publish posts
     */
    public static function getPublishPosts()
    {
        return DB::connect()->select(
            'SELECT * FROM posts WHERE status = :status ORDER BY id DESC',
            [
                'status' => 'publish'
            ],
            true
        );
    }

    /**
     * Add new post
     */
    public static function add( $title, $content, $lyrics, $released, $album, $artist, $genre, $comment, $user_id )
    {
        return DB::connect()->insert(
            'INSERT INTO posts (title , content, lyrics, released, album, artist, genre, comment, user_id) 
            VALUES (:title, :content, :lyrics, :released, :album, :artist, :genre, :comment, :user_id)',
            [
                'title' => $title,
                'content' => $content,
                'lyrics' => $lyrics,
                'released' => $released,
                'album' => $album,
                'artist' => $artist,
                'genre' => $genre,
                'comment' => $comment,
                'user_id' => $user_id
            ]
        );
    }

    /**
     * Update Post details
     */
    public static function update( $id, $title, $content, $lyrics, $released, $album, $artist, $genre, $comment, $status )
    {

        // update user data into the database
        return DB::connect()->update(
            'UPDATE posts SET 
            title = :title, content = :content, lyrics = :lyrics, released = :released, album = :album, artist = :artist, genre = :genre, comment = :comment, status = :status 
            WHERE id = :id',
            [
                'id' => $id,
                'title' => $title,
                'content' => $content,
                'lyrics' => $lyrics,
                'released' => $released,
                'album' => $album,
                'artist' => $artist,
                'genre' => $genre,
                'comment' => $comment,
                'status' => $status
            ]
        );
    }

    /**
     * Delete post
     */
    public static function delete( $post_id )
    {
        return DB::connect()->delete(
            'DELETE FROM posts where id = :id',
            [
                'id' => $post_id
            ]
        );
    }
}