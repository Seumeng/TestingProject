<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Team;
use App\Models\User;


class TeamTest extends TestCase
{
    use RefreshDataBase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    /** @test */
    public function a_team_has_a_name(){
        $team =new Team(['name'=>'Acme']);

        $this->assertEquals('Acme', $team->name);
    }


    /** @test */
    public function a_team_can_add_members()
    {
        $team = Team::factory()->create();

        $user = User::factory()->create();

        $userTwo = User::factory()->create();
        // $userTh = User::factory()->create();

        $team->add($user);
        $team->add($userTwo);
        // $team->add($userTh);

        $this->assertEquals(2,$team->count());
    }

    /** @test */

    public function a_team_has_a_maximum_size()
    {
        $team = Team::factory()->create(['size'=>2]);

        $userOne = User::factory()->create();
        $userTwo = User::factory()->create();

        $team->add($userOne);
        $team->add($userTwo);

        $this->expectException('Exception');

        $this->assertEquals(2, $team->count());

        $userThree=User::factory()->create();
        $team->add($userThree);

    }

    /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team=Team::factory()->create();

        $users= User::factory()->count(2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());

    }

    /** @test */

    function a_team_can_remove_a_member(){
        $team = Team::factory()->create(['size'=>2]);

        $users = User::factory()->count(2)->create();

        $team->add($users);

        $team->remove($users[0]);

        $this->assertEquals(1,$team->count());


    }

    /** @test */

    function a_team_can_remove_all_member_at_once(){

        $team = Team::factory()->create(['size'=>2]);

        $users = User::factory()->count(2)->create();

        $team->add($users);

        $team->remove();

        $this->assertEquals(0,$team->count());
    }

    /** @test */

    public function a_team_can_remove_more_than_one_member_at_once()
    {
        $team = Team::factory()->create(['size'=>3]);

        $users = User::factory()->count(3)->create();

        $team->add($users);

        $team->remove($users->slice(0,2));

        $this->assertEquals(1,$team->count());

    }


    /** @test */

    public function a_team_can_restart_all_members_at_once()
    {
        $team = Team::factory()->create(['size'=>2]);

        $users = User::factory()->count(2)->create();

        $team->add($users);

        $team->restart();

        $this->assertEquals(0,$team->count());

    }


    /** @test */

    public function when_adding_many_members_at_once_you_still_may_not_exceed_the_team_maximum_size()
    {
        $team = Team::factory()->create(['size'=>2]);

        $users = User::factory()->count(3)->create();

        $this->expectException('Exception');

        $team->add($users);
    }


}
