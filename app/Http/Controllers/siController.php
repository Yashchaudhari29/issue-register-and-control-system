<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\rig;
use App\Models\contact;
use App\Models\issuePage;
use Illuminate\Support\Facades\DB;
class siController extends Controller
{
    public function si(Request $request) 
    {   
        $user = Auth::user();
        $userId = $user->id;
        $rig = rig::where('userid', $userId)->first();
        $contact = contact::where('rig', $rig['rig'])->first();
        return view('si',['contact' => $contact,'user'=>$user]);
    }

    public function si_list(Request $request){
        $user = Auth::user();
        $username = $user->username;
        $userId = $user->id;
        $rig = rig::where('userid', $userId)->first();
        $issues= issuePage::where('rig', $rig['rig'])->orderBy('issueId','desc')->paginate(4);
        return view('si_issues_list',compact('issues'));
    }
    public function closeIssue($IssueId) {
        $issue = issuePage::where('IssueId', $IssueId)->first();
    
        if ($issue) {
            $user = Auth::user()->username;
            $issue->status = 'Closed';
            $issue->closed_by=$user;
            $issue->save();
        }
        
        return redirect()->route('si.issue.list');
    }
}
