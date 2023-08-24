<?php

namespace App\Http\Controllers;

use App\Mail\SampleEmail;
use App\Models\Categorie;
use App\Models\Estimate;
use App\Models\Request as ModelsRequest;
use App\Models\Request_sub_categorie;
use App\Models\SubCategorie;
use App\Models\User;
use App\Models\UserCategorie;
use App\Models\UserMembership;
use App\Models\User_categorie;
use App\Models\user_Rate;
use App\Models\user_Rating;
use App\Models\user_Review;
use Backpack\CRUD\app\Console\Commands\PublishBackpackMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class baseApp extends Controller
{
    public function index()
    {
        return view('home.home');
    }
    public function checkunseenMessage()
    {
        $unseenMessage = DB::table('ch_messages')
            ->where('to_id', '=', Auth::user()->id)
            ->where('seen', 0)
            ->count();
        return response()->json(['unseenMessage' => $unseenMessage]);
    }
    // dashboard actions
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/');
        }
        $user_historique = UserMembership::where('user_id', $user->id)
            ->get()
            ->first();
        if ($user_historique) {
            $consum_estimate = $user_historique->estimates_restNumber - $user_historique->estimates_restNumberestimates_number;
        } else {
            $consum_estimate = 0;
        }
        $estimate_send = Estimate::where('freelancer_id', $user->id)->count();
        $estimate_recus = Estimate::where('client_id', $user->id)->count();
        $allEstimates = Estimate::all()->count();
        $lastsEstimates = Estimate::with('client')
            ->where('client_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('base.dashboard.dashboard', compact('user_historique', 'consum_estimate', 'estimate_send', 'estimate_recus', 'allEstimates', 'lastsEstimates'));
    }
    public function sendEmail(Request $request)
    {
        $validatedData = $request->validate([
            'recipient' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $recipientEmail = $request->input('recipient');
        $subject = $request->input('subject');
        $message = $request->input('message');
        // Send the email using the Mailable class
        $mail = new SampleEmail($subject, $message);
        Mail::to($recipientEmail)->send($mail);
        return redirect()
            ->back()
            ->with('success', 'Email sent successfully!');
    }
}
