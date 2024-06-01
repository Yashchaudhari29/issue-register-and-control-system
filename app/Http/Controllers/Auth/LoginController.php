<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\issuePage;
use App\Models\User;
use App\Models\rig;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole('om')) {
                return redirect()->route('om.page');
            } elseif ($user->hasRole('im')) {
                return redirect()->route('im.page');
            } elseif ($user->hasRole('si')) {
                return redirect()->route('si.dashboard');
            }
        }

        return view('index');
    }

    public function issuesForm()
    {
        return view('issues_form');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            Log::info("User with username {$request->username} logged in successfully");

            if ($user->hasRole('om')) {
                return redirect()->route('om.page');
            } elseif ($user->hasRole('im')) {
                return redirect()->route('im.page');
            } elseif ($user->hasRole('si')) {
                return redirect()->route('si.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login.index')->withErrors(['username' => 'User does not have the necessary access rights.']);
            }
        }

        throw ValidationException::withMessages([
            'username' => __('auth.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function issues_list()
    {
        return view('issues_list');
    }

    public function userDashboard(Request $request)
    {
        $user = auth()->user();
        $userusername = $user->username;

        $issues = issuePage::where('username', $userusername)->get();

        return view('issues_list', compact('issues'));
    }

    public function showDetails($IssueId)
    {
        $issue = issuePage::where('IssueId', $IssueId)->firstOrFail();
        $imageNames = json_decode($issue->images, true);
        return view('issues_details', compact('issue', 'imageNames'));
    }

    public function om(Request $request)
    {
        return view('datacard');
    }

    public function im(Request $request)
    {
        return view('contact');
    }

    public function submitIssues(Request $request)
    {
        $images = $request->file('imageUpload');
        $imageNames = [];

        if ($images) {
            foreach ($images as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('issue_img'), $imageName);
                $imageNames[] = $imageName;
            }
        }

        $user = auth()->user();
        $userusername = $user->username;
        $issue = new issuePage();

        $issue->username = $userusername;
        $issue->IssueId = $request->input('IssueId');
        $issue->title = $request->input('issueTitle');
        $issue->description = $request->input('issueDescription');
        $issue->date = $request->input('issueDate');
        $issue->images = json_encode($imageNames);
        $issue->save();

        return redirect('user_dashboard')->with('success', 'Issue submitted successfully.');
    }

    public function AdminshowDetails($IssueId)
    {
        $issue = issuePage::where('IssueId', $IssueId)->firstOrFail();
        $imageNames = json_decode($issue->images, true);
        return view('Admin_issues_details', compact('issue', 'imageNames'));
    }
}
