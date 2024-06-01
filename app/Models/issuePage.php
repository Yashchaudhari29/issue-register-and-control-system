<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssuePage extends Model
{
    protected $primaryKey = 'IssueId';
    protected $fillable = ['IssueId','rig','username', 'title', 'description', 'date', 'images','status','closed_by'];
}
