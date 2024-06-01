<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\rig; 
use App\Models\contact; 
use App\Models\issuePage;
class ImController extends Controller
{
    public function im(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $rig = rig::where('userid', $userId)->first();
        $contact = contact::where('rig', $rig['rig'])->first(); 
        return view('contact', ['contact' => $contact,'user'=>$user]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;
        $rig = rig::where('userid', $userId)->first();
        $contact = contact::where('rig', $rig->rig)->firstOrFail();
        
        $contact->fire = $request->input('firestation');
        $contact->hospital = $request->input('hospital');
        $contact->police = $request->input('police');
        $contact->location = $request->input('location');

        $contact->save();

        return redirect()->route('im.page')->with('success', 'Contact details updated successfully.');
    }
    public function im_form(Request $request){
        return view('issues_form');
    }
    public function im_list(Request $request){
        $user = Auth::user();
        $username = $user->username;
        $userId = $user->id;
        $rig = rig::where('userid', $userId)->first();
        $issues= issuePage::where('rig', $rig['rig'])->orderBy('issueId','desc')->paginate(4);
        return view('issues_list',compact('issues'));
    }
    public function closeIssue($IssueId) {
        $issue = issuePage::where('IssueId', $IssueId)->first();
    
        if ($issue) {
            $user = Auth::user()->username;
            $issue->status = 'Closed';
            $issue->closed_by=$user;
            $issue->save();
        }
    
        return redirect()->route('im.list');
    }
    
}
