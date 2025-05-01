<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookmark extends Model
{
    use HasFactory;
    protected $table = 'job_user_bookmarks';

    protected $fillable = ['user_id', 'job_id'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
