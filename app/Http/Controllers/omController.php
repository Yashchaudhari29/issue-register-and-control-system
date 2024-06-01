<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Builder;
use App\Models\issuePage;
use App\Models\User;
use App\Models\rig;
use App\Models\contact;
class omController extends Controller


{

    public function __construct()
    {
        $this->middleware('auth');
    }


// public function om(Request $request)
// {
//     $rig='r1';
    
//     $contacts = Contact::all();
//     return view('datacard',compact('contacts'));

// }
public function om(Request $request)
{
    $user = Auth::user();
    if($user){
    $username = $user->username;
    $userIds = User::where('username', $username)->pluck('id');
    $rigs = Rig::whereIn('userid', $userIds)->get();
    $contacts = Contact::whereIn('rig', $rigs->pluck('rig'))->get();
    
    // Get the IM users and their mobile numbers mapped to their rigs
    $usersWithRoleIm = User::whereIn('rig', $rigs->pluck('rig'))->where('role', 'im')->get(['rig', 'mob_number']);
    $imUsersByRig = $usersWithRoleIm->keyBy('rig');

    return view('datacard', compact('contacts', 'imUsersByRig'));
    }
    else{
        return view('index');
    }
}

// public function om(Request $request)
// {
//     $user = Auth::user();
//     $username = $user->username;
//     $userIds = User::where('username', $username)->pluck('id');
//     $rigs = Rig::whereIn('userid', $userIds)->get();
//     $rigNames=$rigs->pluck('rig');
//     $usersWithRoleIm = User::whereIn('rig', $rigNames)->where('role', 'im')->get();
//     // dd($usersWithRoleIm->pluck('mob_number'));
//     return view('datacard', compact('contacts'));

// }
public function submitIssues(Request $request)
{

$user = auth()->user(); 

$userusername = $user->rig;
$con = new contact();

$con->rig = $userusername;
$con->fire = $request->input('IssueId');
$con->hospital = $request->input('issueTitle');
$con->police = $request->input('issueDescription');
$con->location = $request->input('issueDate');
$con->save(); 

return redirect('user_dashboard')->with('success', 'Issue submitted successfully.');
}

public function om_list(Request $request){
    $user = Auth::user();
    $username = $user->username;
    $userId = $user->id;
    $rig = rig::where('userid', $userId)->first();
    $issues= issuePage::where('rig', $rig['rig'])->orderBy('issueId','desc')->paginate(4);
    // $issues = DB::table('issue_pages')->where('rig', $rig['rig'])>orderBy('id')->paginate(4);
    
    return view('issues_list', compact('issues'));
}

public function om_issue_form(Request $request){
    $user = Auth::user();
    if($user){
        return view('issues_form');
    }
    else{
        return redirect('/');
    }
}
public function submit_issue(Request $request){
    $user = Auth::user(); 
    if ($user) {
        $data = new issuePage();
        $userId = $user->id;
        $rig = rig::where('userid', $userId)->first();
        $data->rig = $rig['rig'];
        $data->username = $user->username;
        $data->IssueId = $request->input('IssueId');
        $data->title = $request->input('issueTitle'); 
        $data->description = $request->input('issueDescription');
        $data->date = $request->input('issueDate');
        $images = $request->file('imageUpload');
        $imageNames = [];
        if ($images) {
            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('issue_img'), $imageName);
                $imageNames[] = $imageName;
            }
            $data->images = json_encode($imageNames); 
        }

        $data->save(); 
    }
    if ($user->role == 'om') {
        return redirect('/om_list')->with('status', 'Issue submitted successfully!');
    } elseif ($user->role == 'im') {
        return redirect('/im_list')->with('status', 'Issue submitted successfully!');
    } else {
        return redirect('/si_list')->with('status', 'Issue submitted successfully!');
    }
}
public function closeIssue($IssueId) {
    $issue = IssuePage::where('IssueId', $IssueId)->first();

    if ($issue) {
        $user = Auth::user()->username;
        $issue->status = 'Closed';
        $issue->closed_by=$user;
        $issue->save();
    }

    return redirect()->route('om.list');
}


}
