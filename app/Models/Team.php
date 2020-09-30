<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable  =   ['name','size'];

    public function add($users){

        //guard
        $this->guardAgainstTooManyMembers($this->extractNewUsersCount($users));

        $method =$users instanceof User ?'save' :'saveMany';


        // $this->members()->save($user);
        $this->members()->$method($users);

    }
    

    public function members(){
        return $this->hasMany(User::class);
    }
    public function count(){
        return $this->members()->count();
    }

    public function maximumSize(){
        return $this->size;
    }

    public function guardAgainstTooManyMembers($newUserCount)
    {

        $newTeamCount = $this->count() +  $newUserCount;

        if($newTeamCount > $this->maximumSize())
        {
            throw new \Exception;
        }
    }

    public function remove($users=null){

        if(! $users){
            return $this->members()->update(['team_id' => null]);
        }


        if($users instanceof User){
            return $users->leaveTeam();
        }

        $userIds=$users->pluck('id');

        return $this->members()->whereIn('id', $userIds)->update(['team_id'=>null]);


        
        // $user->update(['team_id'=>null]);
    }


    public function restart(){
        return $this->members()->update(['team_id'=>null]);
    }

    protected function extractNewUsersCount($users){

        return ($users instanceof User ) ? 1 : count($users);

    }

}
