<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature for post view page without auth.
     */
    public function test_post_view_load_without_auth(): void
    {
        $this->assertGuest();
        $response = $this->get('post');
        $response->assertStatus(302);
    }
    /**
     * A basic feature for post view page with valid permission.
     */
    public function test_post_view_load_with_valid_permission(): void
    {
        $user = $this->userWithPermissions('editor', 'post.list');
        $response = $this->actingAs($user)->get('post');
        $response->assertStatus(200);
    }

    /**
     * A basic feature for post view page with invalid permission.
     */
    public function test_post_view_load_with_invalid_permission(): void
    {
        $user = $this->userWithoutPermissions('editor');
        $response = $this->actingAs($user)->get(route('post.create'));
        $response->assertStatus(302)
            ->assertSessionHas('status', 'error');
    }

    /**
     * A basic feature for post create view page with valid permission.
     */
    public function test_post_create_view_load_without_invalid_permission(): void
    {
        $user = $this->userWithoutPermissions('editor');
        $response = $this->actingAs($user)->get(route('post.create'));
        $response->assertStatus(302)
            ->assertSessionHas('status', 'error');
    }
    /**
     * A basic feature for post create view page with valid permission.
     */
    public function test_post_create_view_load_without_valid_permission(): void
    {
        $user = $this->userWithPermissions('editor', 'post.create');
        $response = $this->actingAs($user)->get(route('post.create'));
        $response->assertStatus(200);
    }

    /**
     * A basic feature for post view page without auth.
     */
    public function test_post_create_with_invalid_details(): void
    {
        $user = $this->userWithPermissions('editor', 'post.store');
        $response = $this->actingAs($user)->post(route('post.store'), [
            'name'  => 'Post Title'
        ]);
        $response->assertStatus(302)
            ->assertSessionHasErrors(['description']);
    }

    /**
     * A basic feature for post view page with valid details.
     */
    public function test_post_create_with_valid_details(): void
    {
        $user = $this->userWithPermissions('editor', 'post.store');
        $response   = $this->actingAs($user)->post(route('post.store'), [
            'name'         => 'Post Title',
            'description'  => 'this is test content',
        ]);
        $response->assertStatus(302)
            ->assertSessionHas('status', 'success')
            ->assertRedirect(route('post.list'));
    }

    /**
     * A basic feature for post edit view page with invalid permission.
     */
    public function test_post_edit_view_with_invalid_permissions()
    {
        $user = $this->userWithPermissions('editor', 'post.store');

        $this->actingAs($user)->post(route('post.store'), [
            'name'         => 'Post Title',
            'description'  => 'this is test content',
        ]);
        $post = Post::first();
        $response = $this->actingAs($user)->get(route('post.edit', ['post' => $post->id]));

        $response->assertStatus(302)
            ->assertSessionHas('status', 'error');
    }

    /**
     * A basic feature for post edit view page with valid permission.
     */
    public function test_post_edit_view_with_valid_permissions()
    {
        $user = $this->userWithPermissions('editor', ['post.store',  'post.edit']);

        $this->actingAs($user)->post(route('post.store'), [
            'name'         => 'Post Title',
            'description'  => 'this is test content',
        ]);
        $post = Post::first();
        $response = $this->actingAs($user)->get(route('post.edit', ['post' => $post->id]));

        $response->assertStatus(200);
    }
    /**
     * A basic feature for post update with invalid permission.
     */
    public function test_post_update_with_invalid_permissions()
    {
        $user = $this->userWithPermissions('editor', ['post.store']);

        $this->actingAs($user)->post(route('post.store'), [
            'name'         => 'Post Title',
            'description'  => 'this is test content',
        ]);

        $post = Post::first();

        $response = $this->actingAs($user)->patch(route('post.update', ['post' => $post->id]), [
            'name'         => 'new Post Title',
            'description'  => 'this is test content',
        ]);

        $response->assertStatus(302)
            ->assertSessionHas('status', 'error');
    }
    /**
     * A basic feature for post update with valid permission.
     */
    public function test_post_update_with_valid_permissions()
    {
        $user = $this->userWithPermissions('editor', ['post.store', 'post.update']);
        
        $this->actingAs($user)->post(route('post.store'), [
            'name'         => 'Post Title',
            'description'  => 'this is test content',
        ]);
        
        $post = Post::first();

        $response = $this->actingAs($user)->patch(route('post.update', ['post' => $post->id]), [
            'name'         => 'new Post Title',
            'description'  => 'this is updated content',
        ]);

        $response->assertStatus(200)
            ->assertSessionHas('status', 'success');
    }
}
