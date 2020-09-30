<?php


namespace Tests\Integration;

use Tests\TestCase;
// use Illuminate\Foundation\Testing\DataBaseTransaction;
use App\Models\Post;
use App\Models\User;
// use Symfony\Component\Console\Helper\Helper;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikesTest extends TestCase{

    // use RefreshDataBase;

    protected $post;

    public function setUp():void
    {
        parent::setup();
        // $this->post = Post::factory()->create();

        $this->createPost();

        $this->signIn();

    }

    /** @test */

    public function a_user_can_like_a_post(){

        // given I have a post
        // $post=Post::factory()->create();

        // and a user

        // $user=User::factory()->create();

        // //and that user is logged in

        // $this->actingAs($user);

        //when they like a post

        $this->post->like();
         

        //then we should see evidence in the database, and the post should be liked


        // seeInDataBase
        ///assertSeeIn

        $this->assertDatabaseHas('likes',[
            
            'user_id'   =>  $this->user->id,
            'likeable_id'   =>  $this->post->id,
            'likeable_type' =>  get_class($this->post)
        ]);  

        $this->assertTrue($this->post->isLiked());
    }

    /** @test */
    public function a_user_can_unlike_a_post(){

        // given I have a post
        // $post=Post::factory()->create();

        // and a user

        // $user=User::factory()->create();

        // //and that user is logged in

        // $this->actingAs($user);

        //when they like a post

        $this->post->like();
        $this->post->unlike();
         

        //then we should see evidence in the database, and the post should be liked


        // seeInDataBase
        ///assertSeeIn

        $this->assertDatabaseMissing('likes',[
            
            'user_id'   =>  $this->user->id,
            'likeable_id'   =>  $this->post->id,
            'likeable_type' =>  get_class($this->post)
        ]);  

        $this->assertFalse($this->post->isLiked());
    }


    /** @test */

    public function a_user_may_toggle_a_posts_like_status()
    {

        // $user= User::factory()->create();

        // $this->actingAs ($user);

        $this->post->toggle();

        $this->assertTrue($this->post->isLiked());

        $this->post->toggle();

        $this->assertFalse($this->post->isLiked());

    }

    /** @test */

    public function a_post_knows_how_many_likes_it_has()
    {

        // $post = Post::factory()->create();

        // $user = User::factory()->create();


        // $this->actingAs($user);

        $this->post->toggle();

        $this->assertEquals(1, $this->post->likeCount);

    }
} 