<?php 
namespace Tests\Integration\Models;
use Tests\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\DataBaseTransactions;


class ArticleTest extends TestCase
{
    use RefreshDatabase;
        // use DataBaseTransactions;

    /** @test */
    function it_fetches_trending_articles()
    {
        //Given
        Article::factory()->count(2)->create();
        Article::factory()->create(['reads'=>40]);
        $mostPopular=Article::factory()->create(['reads'=>50]);

        //When

         $articles=Article::all();
         $trending=Article::trending();
        //Then

        $this->assertEquals($mostPopular->id,4);
        $this->assertCount(4,$articles);
        $this->assertEquals($mostPopular->id,$trending->first()->id);
    }
}