<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\issuePage;
class showController extends Controller
{
    public function showDetails($IssueId) 
   {
       $issue = issuePage::where('IssueId', $IssueId)->firstOrFail();
       $imageNames = json_decode($issue->images, true);
       return view('issues_details', compact('issue','imageNames'));
    }
}

