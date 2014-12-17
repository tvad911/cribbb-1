<?php

/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

use League\FactoryMuffin\Facade as FactoryMuffin;

class PostTest extends TestCase {

    public function testRelationshipWithUser()
    {
        // Instantiate new Post
        $post = FactoryMuffin::create('Post');

        // Check that the user_id has been set correctly
        $this->assertEquals($post->user_id, $post->user->id);
    }

    public function testPostSavesCorrectly()
    {
        // Create a new Post
        $post = FactoryMuffin::create('Post');

        // Save the Post
        $this->assertTrue($post->save());
    }

    public function testAddingNewComment()
    {
        // Create a new Post
        $post = FactoryMuffin::create('Post');

        // Create a new Comment
        $comment = new Comment(['body' => 'A new comment.']);

        // Save the Comment tot the Post
        $post->comments()->save($comment);

        // This Post should have one comment
        $this->assertCount(1, $post->comments);
    }

}