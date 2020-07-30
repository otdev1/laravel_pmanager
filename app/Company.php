<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;


class Company extends Model
{   
    use SearchableTrait;
    
    protected $fillable = [
        'id',
        'name',
        'description',
        'user_id'
    ];

    protected $searchable = [
        'columns' => [
            'company.name' => 10,
            'company.user_id' => 10,
            'company.id' => 5,
        ],
    ];

    public function user(){
        return $this->belongsTo('App\User'); 
    }

    public function projects(){
        return $this->hasMany('App\Project'); 
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
