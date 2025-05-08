<?php

namespace App\Models;

use App\Models\User;
use App\Models\Job;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tag');
    }
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_tag');
    }

}
