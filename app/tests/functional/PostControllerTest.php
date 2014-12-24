<?php
/**
 * Short description for the file.
 *
 * @author      Jaap Faes <jaap@komma.pro>
 * @copyright   (c) 2012-2014, Komma Mediadesign
 */

class PostControllerTest extends TestCase{

    /**
     * Set up
     */
    public function setUp()
    {
        parent::setUp();
        $this->mock = $this->mock('Cribbb\Storage\Post\PostRepository');
    }
    /**
     * Tear down
     */
    public function tearDown()
    {
        Mockery::close();
    }
    /**
     * Mock
     */
    public function mock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);
        return $mock;
    }
    /**
     * Test Index
     */
    public function testIndex()
    {
        $this->mock->shouldReceive('all')->once();
        $this->call('GET', 'posts');
        $this->assertResponseOk();
    }
    /**
     * Test Create
     */
    public function testCreate()
    {
        $this->call('GET', 'posts/create');
        $this->assertResponseOk();
    }
    /**
     * Test Store fails
     */
    public function testStoreFails()
    {
        $this->mock->shouldReceive('create')
            ->once()
            ->andReturn(Mockery::mock(array('passes' => false, 'errors' => array())));
        $this->call('POST', 'posts');
        $this->assertRedirectedToRoute('posts.create');
        $this->assertSessionHasErrors();
    }
    /**
     * Test Store success
     */
    public function testStoreSuccess()
    {
        $this->mock->shouldReceive('create')
            ->once()
            ->andReturn(Mockery::mock(array('passes' => true)));
        $this->call('POST', 'posts');
        $this->assertRedirectedToRoute('posts.index');
        $this->assertSessionHas('flash');
    }
    /**
     * Test Show
     */
    public function testShow()
    {
        $this->mock->shouldReceive('find')
            ->once()
            ->with(1);
        $this->call('GET', 'posts/1');
        $this->assertResponseOk();
    }
    /**
     * Test Edit
     */
    public function testEdit()
    {
        $this->call('GET', 'posts/1/edit');
        $this->assertResponseOk();
    }
    /**
     * Test Update fails
     */
    public function testUpdateFails()
    {
        $this->mock->shouldReceive('update')
            ->once()
            ->with(1)
            ->andReturn(Mockery::mock(array('passes' => false, 'errors' => array())));
        $this->call('PUT', 'posts/1');
        $this->assertRedirectedToRoute('posts.edit', 1);
        $this->assertSessionHasErrors();
    }
    /**
     * Test Update success
     */
    public function testUpdateSuccess()
    {
        $this->mock->shouldReceive('update')
            ->once()
            ->with(1)
            ->andReturn(Mockery::mock(array('passes' => true)));
        $this->call('PUT', 'posts/1');
        $this->assertRedirectedToRoute('posts.show', 1);
        $this->assertSessionHas('flash');
    }

}