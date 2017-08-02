<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BlogcategoryIntegrationTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->blogcategory = factory(App\Repositories\Blogcategory\Blogcategory::class)->make([
            // put fields here
        ]);
        $this->blogcategoryEdited = factory(App\Repositories\Blogcategory\Blogcategory::class)->make([
            // put fields here
        ]);
        $user = factory(App\Repositories\User\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', '/blogcategories');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('blogcategories');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', '/blogcategories/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'blogcategories', $this->blogcategory->toArray());

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'blogcategories', $this->blogcategory->toArray());

        $response = $this->actor->call('GET', '/blogcategories/'.$this->blogcategory->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('blogcategory');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'blogcategories', $this->blogcategory->toArray());
        $response = $this->actor->call('PATCH', '/blogcategories/1', $this->blogcategoryEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('blogcategories', $this->blogcategoryEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'blogcategories', $this->blogcategory->toArray());

        $response = $this->call('DELETE', '/blogcategories/'.$this->blogcategory->id.'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/blogcategories');
    }

}
