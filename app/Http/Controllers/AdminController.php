<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Conference;
use App\Http\Requests\UserFrontLoginVerifyOTPFormRequest;
use App\Http\Requests\UserFrontLoginWithOTPFormRequest;
use App\Models\admin_verification_codes;
use Carbon\Carbon;
use App\Mail\LoginOTP;
use App\Models\Admin;
use App\Models\ClientStatus;
use App\Models\ConferencesToday;
use Mail;
use DataTables;
use DB;
use App\Models\Comments;

use App\Models\ConferencesData;
use App\Models\followup;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;


// use Validator;
use League\Csv\Reader;
use App\Models\User;


// use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
// use App\Models\User;
// use Illuminate\Foundation\Auth\RegistersUsers;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    //todo: admin login form
    public function login_form()
    {
        return view('admin.login-form');
    }


    public function getAllUsers()
    {

        $query = User::query();

        return Datatables::of($query)
            ->make(true);
    }

    public function showNewConference()
    {
        return view('admin.newconference');
    }


    public function saveConference(Request $request)
    {

        $auth_user_id = Auth::user()->id;


        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255|unique:conferences_data',

            ],

        );


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            

            ConferencesData::create([
                'name' => $request->name,

                'created_by' =>  $auth_user_id
            ]);

            return response()->json([
                'message' => 'Comment added successfully',
                'status_code' => 200,
            ], 200);
        }
    }

    public function UserGetIDData(Request $request)
    {

        $user = User::find($request->id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    public function NormalUserDelete(Request $request)
    {


        $user = User::findOrFail($request->id);
        $user->delete();

        return response()->json([
            'status_code' => '200',
            'message' => 'Client Deleted Successfully',
        ]);
    }




    public function showUser()
    {

        $all_conferences = ConferencesData::all();


        return view('admin.adduser', compact('all_conferences'));
    }

    public function getComments(Request $request)
    {

        $conference = $request->input('conference');
        $article = $request->input('article');
        $email = $request->input('email');

        $comments = Comments::where('conference', 'LIKE', '%' . $conference . '%')
            ->where('email', 'LIKE', '%' . $email . '%')
            ->where('article', 'LIKE', '%' . $article . '%')
            ->join('client_statuses', 'comments.client_status_id', '=', 'client_statuses.id')
            ->orderBy('comments.created_at', 'desc') // Order by created_at column in descending order
            ->get();




        return response()->json([
            'comments' => $comments,
            'status_code' => 200,
        ], 200);
    }

    public function addNewComments(Request $request)
    {



        $now = Carbon::now();
        $currentDateTime = $now->toDateString();
        $validator = Validator::make(
            $request->all(),
            [
                'comment' => 'required|string|max:255',
                'client_status_id' => 'required|string|max:255',

            ],

        );


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {

            $auth_user_id = Auth::user()->id;




            Comments::create([
                'article' => $request->article,
                'conference' => $request->conference,
                'email' => $request->email,
                'client_status_id' => $request->client_status_id,
                'conference' => $request->conference,
                'comment' => $request->comment,
                'comment_created_date' => $currentDateTime,
                'user_id' =>  $auth_user_id
            ]);

            $comments = Comments::where('conference', 'LIKE', '%' . $request->conference . '%')
                ->where('email', 'LIKE', '%' . $request->email . '%')
                ->where('article', 'LIKE', '%' . $request->article . '%')
                ->join('client_statuses', 'comments.client_status_id', '=', 'client_statuses.id')
                ->orderBy('comments.created_at', 'desc') // Order by created_at column in descending order
                ->get();


            return response()->json([
                'message' => 'Comment added successfully',
                'status_code' => 200,
                'comments' => $comments,
            ], 200);
        }
    }



    public function followupEdit(Request $request)
    {
        $user = followup::find($request->id);

        return view('admin.followup.edit', compact('user'));
    }


    public function ShowFollowup()
    {
        $countries = Conference::distinct()->pluck('country',)->toArray();



        return view('admin.followup', compact('countries'));
    }



    public function getFollowupData()
    {


        $query = followup::query();


        // $latestConferences = $query->get();
        $latestConferences = $query
            ->orderBy('created_at', 'desc')
            ->get();

        $uniqueConferences = $latestConferences
            ->unique(function ($item) {
                return $item->email . $item->article . $item->conference;
            });



        return Datatables::of($uniqueConferences)
            ->make(true);
    }







    public function ShowNegative(Request $request)
    {

        $countries = Conference::distinct()->pluck('country',)->toArray();

        return view('admin.negative', compact('countries'));
    }

    public function getOnlineShow(Request $request)
    {

        $countries = Conference::distinct()->pluck('country',)->toArray();

        return view('admin.online', compact('countries'));
    }




    public function getPositiveShow(Request $request)
    {




        $all_conferences = Conference::distinct()->pluck('conference')->toArray();
        $countries = Conference::distinct()->pluck('country',)->toArray();


        return view('admin.positive', compact('all_conferences', 'countries'));
    }

    public function getNeutralShow(Request $request)
    {




        $all_conferences = Conference::distinct()->pluck('conference')->toArray();
        $countries = Conference::distinct()->pluck('country',)->toArray();


        return view('admin.neutral', compact('all_conferences', 'countries'));
    }

    public function ShowUnsubscribeData(Request $request)
    {




        $all_conferences = Conference::distinct()->pluck('conference')->toArray();
        $countries = Conference::distinct()->pluck('country',)->toArray();


        return view('admin.unsubscribe', compact('all_conferences', 'countries'));
    }








    public function getOnlineData(Request $request)
    {

        // dd($request);

        $query = Conference::query();
        $query->join('comments', function ($join) {
            $join->on('comments.email', '=', 'conferences.email')
                ->on('comments.article', '=', 'conferences.article')
                ->on('comments.conference', '=', 'conferences.conference')
                ->whereRaw('comments.created_at = (
                        SELECT MAX(created_at) 
                        FROM comments 
                        WHERE comments.email = conferences.email 
                        AND comments.article = conferences.article 
                        AND comments.conference = conferences.conference
                    )');
        });

        $query->where('client_status_id', 9);



        $this->PositiveapplyFilters($query, $request);



        $data = $query->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })
            ->addColumn('comments_count', function ($row) {
                return $row->comments();
            })
            ->addColumn('client_status', function ($row) {
                return $row->client_status();
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }


    public function getNeutralData(Request $request)
    {

        // dd($request);

        $query = Conference::query();
        $query->join('comments', function ($join) {
            $join->on('comments.email', '=', 'conferences.email')
                ->on('comments.article', '=', 'conferences.article')
                ->on('comments.conference', '=', 'conferences.conference')
                ->whereRaw('comments.created_at = (
                        SELECT MAX(created_at) 
                        FROM comments 
                        WHERE comments.email = conferences.email 
                        AND comments.article = conferences.article 
                        AND comments.conference = conferences.conference
                    )');
        });

        $query->where('client_status_id', 7);


        $this->PositiveapplyFilters($query, $request);




        $data = $query->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })
            ->addColumn('comments_count', function ($row) {
                return $row->comments();
            })
            ->addColumn('client_status', function ($row) {
                return $row->client_status();
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }

    public function getUnsubscribeData(Request $request)
    {

        // dd($request);

        $query = Conference::query();
        $query->join('comments', function ($join) {
            $join->on('comments.email', '=', 'conferences.email')
                ->on('comments.article', '=', 'conferences.article')
                ->on('comments.conference', '=', 'conferences.conference')
                ->whereRaw('comments.created_at = (
                        SELECT MAX(created_at) 
                        FROM comments 
                        WHERE comments.email = conferences.email 
                        AND comments.article = conferences.article 
                        AND comments.conference = conferences.conference
                    )');
        });

        $query->where('client_status_id', 8);

        $this->PositiveapplyFilters($query, $request);





        $data = $query->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })
            ->addColumn('comments_count', function ($row) {
                return $row->comments();
            })
            ->addColumn('client_status', function ($row) {
                return $row->client_status();
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }





    public function getNegativeData(Request $request)
    {

        $query = Conference::query();
        $query->join('comments', function ($join) {
            $join->on('comments.email', '=', 'conferences.email')
                ->on('comments.article', '=', 'conferences.article')
                ->on('comments.conference', '=', 'conferences.conference')
                ->whereRaw('comments.created_at = (
                        SELECT MAX(created_at) 
                        FROM comments 
                        WHERE comments.email = conferences.email 
                        AND comments.article = conferences.article 
                        AND comments.conference = conferences.conference
                    )');
        });

        $query->where('client_status_id', 2);

        $this->PositiveapplyFilters($query, $request);


        $data = $query->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })
            ->addColumn('comments_count', function ($row) {
                return $row->comments();
            })
            ->addColumn('client_status', function ($row) {
                return $row->client_status();
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }


    private function PositiveapplyFilters($query, $request)
    {



        $query->when($request->conference == 'All', function ($query) use ($request) {
            $query->whereNotNull('conferences.email');
        });

        $query->when($request->conference != 'All', function ($query) use ($request) {
            $query->where('conferences.conference', $request->conference);
        });



        $query->when($request->country != 'All', function ($query) use ($request) {

            $query->where('conferences.country', $request->country);
        });
        $query->when($request->start_date != '', function ($query) use ($request) {

            $query->whereBetween('comments.comment_created_date', [$request->start_date, $request->end_date]);
        });
    }

    public function ShowPositiveData(Request $request)
    {

        $query = Conference::query();
        $query->join('comments', function ($join) {
            $join->on('comments.email', '=', 'conferences.email')
                ->on('comments.article', '=', 'conferences.article')
                ->on('comments.conference', '=', 'conferences.conference')
                ->whereRaw('comments.created_at = (
                        SELECT MAX(created_at) 
                        FROM comments 
                        WHERE comments.email = conferences.email 
                        AND comments.article = conferences.article 
                        AND comments.conference = conferences.conference
                    )');
        });

        $query->where('client_status_id', 1);

        $this->PositiveapplyFilters($query, $request);


        $data = $query->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })
            ->addColumn('comments_count', function ($row) {
                return $row->comments();
            })
            ->addColumn('client_status', function ($row) {
                return $row->client_status();
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }

    public function addNewFollowups(Request $request)
    {



        $now = Carbon::now();
        $currentDateTime = $now->toDateString();
        $validator = Validator::make(
            $request->all(),
            [
                'followup_date' => 'required|string|max:255',
                'followup_type' => 'required|string|max:255',

            ],

        );


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {





            followup::create([
                'article' => $request->article,
                'conference' => $request->conference,
                'email' => $request->email,
                'followup_date' => $request->followup_date,
                'note' => $request->note,
                'name' => $request->name,
                'followup_type' => $request->followup_type,
                'followup_created_date' => $currentDateTime
            ]);

            $followups = Followup::where('conference', 'LIKE', '%' . $request->conference . '%')
                ->where('email', 'LIKE', '%' . $request->email . '%')
                ->where('article', 'LIKE', '%' . $request->article . '%')
                ->latest()
                ->get();


            return response()->json([
                'message' => 'Followup added successfully',
                'status_code' => 200,
                'followups' => $followups,
            ], 200);
        }
    }


    public function getfollowups(Request $request)
    {

        $conference = $request->input('conference');
        $article = $request->input('article');
        $email = $request->input('email');

        $followups = followup::where('conference', 'LIKE', '%' . $conference . '%')
            ->where('email', 'LIKE', '%' . $email . '%')
            ->where('article', 'LIKE', '%' . $article . '%')

            ->get();


        return response()->json([
            'followups' => $followups,
            'status_code' => 200,
        ], 200);
    }


    public function downloadEmails(Request $request)
    {

        $now = Carbon::now();
        $auth_user_id = Auth::user()->id;
        $currentDateTime = $now->toDateString();

        $emails = $request->emails;
        if (isset($emails)) {
            foreach ($emails as $email) {
                Conference::where('email', $email)->update(
                    [
                        'download_count' => 1,
                        'user_downloaded_at' => $currentDateTime
                    ]
                );
            }
        }
    }



    public function UserShow($id)
    {
        try {
            // Your logic to fetch data for a specific ID
            $data = user::findOrFail($id);

            return response()->json($data);
        } catch (\Exception $e) {
            // Handle errors, for example, return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function ClientUpdate(Request $request)
    {


        $now = Carbon::now();
        $currentDateTime = $now->toDateString();
        $user = Conference::find($request->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'client_status_id' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {

            // dd($request->client_status);

            $user->update([
                'name' => $request->name,
                'country' => $request->country,
                'user_updated_at' => $currentDateTime,
            ]);



            if (isset($request->comment)) {

                $feedback = Comments::create([
                    'comment' => $request->comment,
                    'email' => $request->email,
                    'conference' => $request->conference,
                    'article' => $request->article,
                    'client_status_id' => $request->client_status_id,
                    'comment_created_date' => $currentDateTime
                ]);
            }

            if (isset($request->followup_date)) {


                $validator = Validator::make(
                    $request->all(),
                    [
                        'followup_date' => 'required|string|max:255',
                        'followup_type' => 'required|string|max:255',

                    ],

                );

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                } else {

                    followup::create([
                        'article' => $request->article,
                        'conference' => $request->conference,
                        'email' => $request->email,
                        'followup_date' => $request->followup_date,
                        'note' => $request->note,
                        'name' => $request->name,
                        'followup_type' => $request->followup_type,
                        'followup_created_date' => $currentDateTime
                    ]);
                }
            }


            return response()->json([
                'status_code' => '200',
                'message' => 'Client Updated Successfully',
            ]);
        }
    }

    public function Useredit(Request $request)
    {

        $user = Conference::find($request->id);
        $all_conferences = ConferencesData::all();
        $clientStatuses = ClientStatus::pluck('name', 'id')->all();

        return view('admin.edit', compact('user', 'clientStatuses', 'all_conferences'));
    }

    public function NormalUserEdit(Request $request)
    {

        $user = User::find($request->id);

        return view('admin.normaluseredit', compact('user'));
    }




    public function AllUsers()
    {

        $all_users = User::paginate(10);
        return view('admin.all-users', compact('all_users'));
    }

    public function userUpdate(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {

            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            $user->save();
            return response()->json([
                'message' => 'User  Updated Successfully',
                'status_code' => '200'

            ], 200);
        }
    }


    public function userDelete(Request $request)
    {




        $user = User::findOrFail($request->id);

        $user->delete();
        return response()->json([
            'message' => 'User  Deleted Successfully',
            'status_code' => '200'

        ], 200);
    }

    //todo: admin login functionality
    public function login_functionality(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('superadmin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('superadmin.dashboard');
        }
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else {
            Session::flash('error-message', 'Invalid Email or Password');
            return back();
        }
    }


    public function showReport(Request $request)
    {

        $start_date = $request->from_date;
        $end_date = $request->to_date;

        $all_conferences = ConferencesData::all();

        $clientStatuses = ClientStatus::pluck('name', 'id')->all();


        if (isset($request->from_date) && ($request->to_date)) {

            $inserted_count = Conference::whereNotNull('user_created_at')
                ->whereBetween('user_created_at', [$start_date, $end_date])
                ->count();

            $all_users = User::all();
            $users_count = User::where('role', 'user')->get()->count();
            $inserted_count = Conference::whereNotNull('user_created_at')->count();
            $updated_count = Conference::whereNotNull('user_updated_at')->count();
            $download_count = Conference::whereNotNull('download_count')->count();
        } else {


            $all_users = User::all();
            $users_count = User::where('role', 'user')->get()->count();
            $inserted_count = Conference::whereNotNull('user_created_at')->count();
            $updated_count = Conference::whereNotNull('user_updated_at')->count();
            $download_count = Conference::whereNotNull('download_count')->count();
        }





        return view('admin.reports', compact('all_users', 'users_count', 'inserted_count', 'updated_count', 'download_count', 'all_conferences', 'clientStatuses', 'all_conferences'));
    }

    public function downloadReport(Request $request)
    {



        ini_set('memory_limit', '256M');

        $all_users = User::all();
        $startDate = $request->start_date;
        // dd($startDate);
        $endDate = $request->end_date;

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',

        ]);

        // get all users and all conferences
        if ($request->user_id == 'All' && $request->conference == 'All') {


            $inserted_count = Conference::whereNotNull('user_created_at')
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->count();


            $users_count = User::all()
                ->count();


            $updated_count = Conference::whereNotNull('user_updated_at')
                ->whereBetween('user_updated_at', [$startDate, $endDate])
                ->count();


            $downloaded_count = Conference::whereNotNull('download_count')
                ->whereBetween('user_downloaded_at', [$startDate, $endDate])
                ->count();


            $query = Conference::query();

            $result = $query
                ->select([
                    'users.id',
                    'users.name',
                    'users.created_at',
                    'conferences.conference',
                    DB::raw('COUNT(DISTINCT conferences.conference) AS conference_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN conferences.user_created_at >= ? AND conferences.user_created_at <= ? THEN conferences.id END) AS inserted_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN conferences.user_updated_at >= ? AND conferences.user_updated_at <= ? THEN conferences.id END) AS updated_count'),
                    DB::raw('SUM(CASE WHEN conferences.download_count = "1" AND conferences.user_created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) AS download_count'),
                    DB::raw('SUM(CASE WHEN conferences.email_sent_status = "sent" THEN 1 ELSE 0 END) AS email_sent_count'),
                    DB::raw('SUM(CASE WHEN conferences.email_sent_status = "pending" THEN 1 ELSE 0 END) AS email_pending_count'),
                    // DB::raw('COUNT(DISTINCT CASE WHEN comments.client_status_id = "1" THEN 1 ELSE 0 END) AS client_positive_count'),
                    // DB::raw('SUM(CASE WHEN comments.client_status_id = "2" THEN 1 ELSE 0 END) AS client_negative_count')

                ])
                ->leftJoin('users', 'users.id', '=', 'conferences.user_id')
                ->leftJoin('comments', 'conferences.conference', '=', 'comments.conference')
                ->whereBetween('conferences.user_created_at', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.download_count', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.email_sent_status', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.user_updated_at', [$request->start_date, $request->end_date])
                ->groupBy('users.id', 'users.name', 'users.created_at', 'conferences.conference', 'conferences.user_id')

                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->get();



            return DataTables::of($result)

                // ->addColumn('client_status', function ($row) {
                //     return $row->client_status($row->email);
                // })
                ->addColumn('client_positive_count', function ($row) use ($request) {
                    $conference = $row->conference;
                    $startDate = $request->start_date;
                    $endDate = $request->end_date;
                    $user_id = $row->id;
                    return $row->positive_count($conference, $user_id, $startDate, $endDate);
                })

                ->addColumn('client_negative_count', function ($row) use ($request) {
                    $conference = $row->conference;
                    $startDate = $request->start_date;
                    $endDate = $request->end_date;
                    $user_id = $row->id;
                    return $row->negative_count($conference, $user_id, $startDate, $endDate);
                })
                ->with('users_count', $users_count)
                ->with('inserted_count', $inserted_count)
                ->with('updated_count', $updated_count)
                ->with('downloaded_count', $downloaded_count)

                ->make(true);
        }


        //get all users and particular conference
        if ($request->user_id == 'All' && $request->conference != 'All') {

            // dd($request);

            $inserted_count = Conference::whereNotNull('user_created_at')
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->where('conference', $request->conference)

                ->count();


            $users_count = User::all()
                ->count();


            $updated_count = Conference::whereNotNull('user_updated_at')
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->where('conference', $request->conference)
                ->count();

            $downloaded_count = Conference::whereNotNull('download_count')
                ->whereBetween('user_downloaded_at', [$startDate, $endDate])
                ->where('conference', $request->conference)
                ->count();


            $query = Conference::query();

            $query = Conference::query();
            $result = $query
                ->select([
                    'users.id',
                    'users.name',
                    'users.created_at',
                    'conferences.conference',
                    DB::raw('COUNT(DISTINCT conferences.conference) AS conference_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN conferences.user_created_at >= ? AND conferences.user_created_at <= ? THEN conferences.id END) AS inserted_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN conferences.user_updated_at >= ? AND conferences.user_updated_at <= ? THEN conferences.id END) AS updated_count'),
                    DB::raw('SUM(CASE WHEN conferences.download_count = "1" AND conferences.user_created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) AS download_count'),
                    DB::raw('SUM(CASE WHEN conferences.email_sent_status = "sent" THEN 1 ELSE 0 END) AS email_sent_count'),
                    DB::raw('SUM(CASE WHEN conferences.email_sent_status = "pending" THEN 1 ELSE 0 END) AS email_pending_count'),
                ])
                ->leftJoin('users', 'users.id', '=', 'conferences.user_id')
                ->where('users.id', $request->user_id)

                // ->leftJoin('comments', 'conferences.conference', '=', 'comments.conference')
                // ->where('conferences.conference', $request->conference)
                ->where('conferences.conference', 'LIKE', '%' . $request->conference . '%')

                ->whereBetween('conferences.user_created_at', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.download_count', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.email_sent_status', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.user_updated_at', [$request->start_date, $request->end_date])

                ->groupBy('users.id', 'users.name', 'users.created_at', 'conferences.conference', 'conferences.user_id')
                ->where(function ($query) use ($request) {
                    // Include all users if $request->user_id is not provided

                    // $query->where('users.id', $request->user_id);
                    $query->where('conferences.conference', 'LIKE', '%' . $request->conference . '%');

                    // $query->where('conferences.conference',$request->conference);


                })
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->get();






            return DataTables::of($result)

                ->addColumn('client_positive_count', function ($row) use ($request) {
                    $conference = $row->conference;
                    $startDate = $request->start_date;
                    $endDate = $request->end_date;
                    $user_id = $row->id;
                    return $row->positive_count($conference, $user_id, $startDate, $endDate);
                })

                ->addColumn('client_negative_count', function ($row) use ($request) {
                    $conference = $row->conference;
                    $startDate = $request->start_date;
                    $endDate = $request->end_date;
                    $user_id = $row->id;
                    return $row->negative_count($conference, $user_id, $startDate, $endDate);
                })

                ->with('users_count', $users_count)
                ->with('inserted_count', $inserted_count)
                ->with('updated_count', $updated_count)
                ->with('downloaded_count', $downloaded_count)
                ->make(true);
        }

        //get particular user and particular conference
        if ($request->user_id != 'All' && $request->conference != 'All') {


            // dd($request);
            $inserted_count = Conference::whereNotNull('user_created_at')
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->where('user_id', $request->user_id)
                ->where('conferences.conference', 'LIKE', '%' . $request->conference . '%')

                ->count();


            $users_count = User::where('id', $request->user_id)
                ->count();


            $updated_count = Conference::whereNotNull('user_updated_at')
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->where('user_id', $request->user_id)
                ->where('conference', $request->conference)
                ->count();

            $downloaded_count = Conference::whereNotNull('download_count')
                ->whereBetween('user_downloaded_at', [$startDate, $endDate])
                ->where('user_id', $request->user_id)
                ->where('conference', $request->conference)
                ->count();


            $query = Conference::query();

            // dd($request->user_id);


            $query = Conference::query();
            $result = $query
                ->select([
                    'users.id',
                    'users.name',
                    'users.created_at',
                    'conferences.conference',
                    DB::raw('COUNT(DISTINCT conferences.conference) AS conference_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN conferences.user_created_at >= ? AND conferences.user_created_at <= ? THEN conferences.id END) AS inserted_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN conferences.user_updated_at >= ? AND conferences.user_updated_at <= ? THEN conferences.id END) AS updated_count'),
                    DB::raw('SUM(CASE WHEN conferences.download_count = "1" AND conferences.user_created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) AS download_count'),
                    DB::raw('SUM(CASE WHEN conferences.email_sent_status = "sent" THEN 1 ELSE 0 END) AS email_sent_count'),
                    DB::raw('SUM(CASE WHEN conferences.email_sent_status = "pending" THEN 1 ELSE 0 END) AS email_pending_count'),
                ])
                ->leftJoin('users', 'users.id', '=', 'conferences.user_id')
                ->where('users.id', $request->user_id)

                // ->leftJoin('comments', 'conferences.conference', '=', 'comments.conference')
                // ->where('conferences.conference', $request->conference)
                ->where('conferences.conference', 'LIKE', '%' . $request->conference . '%')

                ->whereBetween('conferences.user_created_at', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.download_count', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.email_sent_status', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.user_updated_at', [$request->start_date, $request->end_date])

                ->groupBy('users.id', 'users.name', 'users.created_at', 'conferences.conference', 'conferences.user_id')
                ->where(function ($query) use ($request) {
                    // Include all users if $request->user_id is not provided

                    $query->where('users.id', $request->user_id);
                    $query->where('conferences.conference', 'LIKE', '%' . $request->conference . '%');

                    // $query->where('conferences.conference',$request->conference);


                })
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->get();

            // Rest of your code...





            return DataTables::of($result)

                ->addColumn('client_positive_count', function ($row) use ($request) {
                    $conference = $row->conference;
                    $startDate = $request->start_date;
                    $endDate = $request->end_date;
                    $user_id = $row->id;
                    return $row->positive_count($conference, $user_id, $startDate, $endDate);
                })

                ->addColumn('client_negative_count', function ($row) use ($request) {
                    $conference = $row->conference;
                    $startDate = $request->start_date;
                    $endDate = $request->end_date;
                    $user_id = $row->id;
                    return $row->negative_count($conference, $user_id, $startDate, $endDate);
                })

                ->with('users_count', $users_count)
                ->with('inserted_count', $inserted_count)
                ->with('updated_count', $updated_count)
                ->with('downloaded_count', $downloaded_count)
                ->make(true);
        }


        //get particular user and
        if ($request->user_id != 'All' && $request->conference == 'All') {


            // dd($request);
            $inserted_count = Conference::whereNotNull('user_created_at')
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->where('user_id', $request->user_id)

                ->count();


            $users_count = User::where('id', $request->user_id)
                ->count();


            $updated_count = Conference::whereNotNull('user_updated_at')
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->where('user_id', $request->user_id)
                ->count();

            $downloaded_count = Conference::whereNotNull('download_count')
                ->whereBetween('user_downloaded_at', [$startDate, $endDate])
                ->where('user_id', $request->user_id)
                ->count();


            $query = Conference::query();

            // dd($request->user_id);


            $query = Conference::query();
            $result = $query
                ->select([
                    'users.id',
                    'users.name',
                    'users.created_at',
                    'conferences.conference',
                    DB::raw('COUNT(DISTINCT conferences.conference) AS conference_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN conferences.user_created_at >= ? AND conferences.user_created_at <= ? THEN conferences.id END) AS inserted_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN conferences.user_updated_at >= ? AND conferences.user_updated_at <= ? THEN conferences.id END) AS updated_count'),
                    DB::raw('SUM(CASE WHEN conferences.download_count = "1" AND conferences.user_created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) AS download_count'),
                    DB::raw('SUM(CASE WHEN conferences.email_sent_status = "sent" THEN 1 ELSE 0 END) AS email_sent_count'),
                    DB::raw('SUM(CASE WHEN conferences.email_sent_status = "pending" THEN 1 ELSE 0 END) AS email_pending_count'),
                ])
                ->leftJoin('users', 'users.id', '=', 'conferences.user_id')
                ->where('users.id', $request->user_id)

                // ->leftJoin('comments', 'conferences.conference', '=', 'comments.conference')
                // ->where('conferences.conference', $request->conference)

                ->whereBetween('conferences.user_created_at', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.download_count', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.email_sent_status', [$request->start_date, $request->end_date])
                ->orWhereBetween('conferences.user_updated_at', [$request->start_date, $request->end_date])

                ->groupBy('users.id', 'users.name', 'users.created_at', 'conferences.conference', 'conferences.user_id')
                ->where(function ($query) use ($request) {
                    // Include all users if $request->user_id is not provided

                    $query->where('users.id', $request->user_id);
                    $query->where('conferences.conference', 'LIKE', '%' . $request->conference . '%');

                    // $query->where('conferences.conference',$request->conference);


                })
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->addBinding($request->start_date, 'select')
                ->addBinding($request->end_date, 'select')
                ->get();

            // Rest of your code...





            return DataTables::of($result)

                ->addColumn('client_positive_count', function ($row) use ($request) {
                    $conference = $row->conference;
                    $startDate = $request->start_date;
                    $endDate = $request->end_date;
                    $user_id = $row->id;
                    return $row->positive_count($conference, $user_id, $startDate, $endDate);
                })

                ->addColumn('client_negative_count', function ($row) use ($request) {
                    $conference = $row->conference;
                    $startDate = $request->start_date;
                    $endDate = $request->end_date;
                    $user_id = $row->id;
                    return $row->negative_count($conference, $user_id, $startDate, $endDate);
                })

                ->with('users_count', $users_count)
                ->with('inserted_count', $inserted_count)
                ->with('updated_count', $updated_count)
                ->with('downloaded_count', $downloaded_count)
                ->make(true);
        }
    }



    public function loginWithOTP(UserFrontLoginWithOTPFormRequest $request)
    {
        $user = Admin::where('email', $request->email)->first();

        if ($user) {
            return $this->generateNewOTP($user);
        } else {
            return back()->withErrors(['email' => ['This Email is not exists.']]);
        }
    }



    public function allClients(Request $request, $id)
    {

        if ($request->id === 'All') {
            // If 'All' is selected, fetch all client names
            $conferenceNames = Conference::distinct()->pluck('conference')->toArray();
        } else {
            // Fetch client names based on the selected country ID
            $conferenceNames = Conference::where('country', $id)->distinct()->pluck('conference')->toArray();
        }


        // $encodedClientNames = array_map('utf8_encode', $conferenceNames);
        return response()->json(['conferenceNames' => $conferenceNames]);
    }

    public function resndOTP()
    {
        if (!request()->session()->get('login_user_id')) {
            return redirect()->route('login');
        }

        $user = User::where('id', request()->session()->get('login_user_id'))->first();

        if ($user) {
            $verification = $this->generateOTP($user);
            if ($verification) {
                return redirect()->route('admin.getVerifyOTP')->with('otp_sent_success', 'OTP has been sent to your email. Valid for 5 minutes');
            } else {
                abort(404);
            }
        } else {
            return back()->withErrors(['email' => ['This Email is not exists.']]);
        }
    }

    public function ShowtodayData()
    {


        $countries = Conference::distinct()->pluck('country',)->toArray();
        $users = User::all();

        return view('admin.showtodaydata', compact('countries', 'users'));
    }

    public function todayData(Request $request)
    {

        $query = ConferencesToday::query();




        if ($request->user == '' && $request->user_created_at == '') {
            // Scenario 1: Fetch conferences for a specific user
            $query->where('user_id', $request->user);
        } elseif ($request->user != 'All' && $request->user_created_at != '') {
            // Scenario 2: Fetch conferences for a specific user and specific creation date
            $query->where('user_id', $request->user)
                ->whereDate('user_created_at', $request->user_created_at);
        } elseif ($request->user == 'All' && $request->user_created_at != '') {
            // Scenario 3: Fetch conferences for all users on a specific creation date
            $query->whereDate('user_created_at', $request->user_created_at);
        } elseif ($request->user != 'All' && $request->user_created_at == '') {
            // Scenario 3: Fetch conferences for all users on a specific creation date
            $query->where('user_id', $request->user);
        }
        // Add more scenarios as needed...


        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name;
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }

    public function updateData(Request $request)
    {

        try {
            if (isset($request->selectedData)) {
                ini_set('memory_limit', '1024M');
                $today = Carbon::today();
                $formattedDate = $today->format('Y-m-d');
                $now = Carbon::now();
                $auth_user_id = Auth::user()->id;
                $currentDateTime = $now->toDateString();
                $todayData = $request->selectedData;
                $masterData = Conference::all();




                $progress = 0;
                $totalRecords = count($todayData);
                $recordsProcessed = 0;


                foreach ($todayData as $record) {

                    // dd($record);



                    // Check if the record exists in the master table
                    $existingRecord = $masterData
                        ->where('email', $record['email'])
                        ->where('conference', htmlspecialchars_decode($record['conference']))
                        ->where('article', $record['article'])->first();

                    if ($existingRecord) {
                        // Update the record
                        $existingRecord->update([

                            'name' => $record['name'],
                            'email' => $record['email'],
                            'article' => $record['article'],
                            // 'conference' => $row['Conference'],
                            'conference' => htmlspecialchars_decode($record['conference']),
                            'country' => $record['country'],
                            'user_id' => $auth_user_id,
                            'user_created_at' =>  $record['user_created_at'],
                            'user_updated_at' => $currentDateTime,
                            'email_sent_date' => null,
                            'email_sent_status' => $record['email_sent_status'],
                            'moved_by' => $auth_user_id,
                            // Update fields as needed
                        ]);



                        $conference = htmlspecialchars_decode($record['conference']);
                        // dd($conference);
                        $delete_record = ConferencesToday::where('email', $record['email'])
                            ->where('conference', $conference)
                            ->where('article', $record['article'])->first();

                        if ($delete_record) {
                            $delete_record->delete();
                        }
                    } else {
                        // Insert the record
                        $conference = htmlspecialchars_decode($record['conference']);

                        Conference::create([
                            'name' => $record['name'],
                            'email' => $record['email'],
                            'article' => $record['article'],
                            // 'conference' => $row['Conference'],
                            'conference' => $conference,
                            'country' => $record['country'],
                            'user_id' => $auth_user_id,

                            'user_created_at' =>  $record['user_created_at'],
                            'user_updated_at' => $currentDateTime,

                            'email_sent_date' => null,
                            'email_sent_status' => $record['email_sent_status'],
                            'moved_by' => $auth_user_id,
                        ]);





                        $conference = htmlspecialchars_decode($record['conference']);
                        $delete_record = ConferencesToday::where('email', $record['email'])
                            ->where('conference', $conference)
                            ->where('article', $record['article'])->first();

                        if ($delete_record) {
                            $delete_record->delete();
                        }
                    }




                    $recordsProcessed++;
                    $progress = round(($recordsProcessed / $totalRecords) * 100);

                    // Send progress to frontend
                    // echo "data: $progress\n\n";
                    // ob_flush();
                    // flush();
                    // usleep(100000);
                }
                // Ensure that the final progress is 100%
                // echo "data: 100\n\n";
                // ob_flush();
                // flush();

                return response()->json(['message' => 'Data updated successfully']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user) {
            return 'admin/dashboard';
        }
        return '/home';
    }

    public function show()
    {

        $all_conferences = ConferencesData::all();

        return view('admin.upload', compact('all_conferences'));
    }

    public function getVerifyOTP()
    {


        if (!request()->session()->get('login_user_id')) {
            return redirect()->route('admin.login');
        }


        return view('admin.verify_otp', []);
    }



    public function postVerifyOTP(UserFrontLoginVerifyOTPFormRequest $request)
    {

        // dd(request()->session()->get('login_user_id'));

        $verification = admin_verification_codes::where([
            'user_id'   => request()->session()->get('login_user_id'),
            'otp'       => $request->otp
        ])->where('expire_at', '>', Carbon::now())->first();

        if (!$verification) {
            return redirect()->route('admin.getVerifyOTP')->withErrors(['otp' => ['Invalid OTP']]);
        } else {

            $user = User::where('id', request()->session()->get('login_user_id'))->first();

            \Auth::login($user);

            $verification->delete();

            request()->session()->forget('login_user_id');



            return redirect($this->redirectTo());
        }
    }

    public function generateNewOTP($user)
    {
        $verification = $this->generateOTP($user);
        if ($verification) {
            return redirect()->route('admin.getVerifyOTP')->with('otp_sent_success', 'OTP has been sent to your email. Valid for 5 minutes');
        } else {
            abort(404);
        }
    }


    public function allTopics(Request $request, $id)
    {

        if ($request->id === 'All') {
            // If 'All' is selected, fetch all client names
            $topicNames = Conference::distinct()->pluck('article')->toArray();
        } else {
            // Fetch client names based on the selected country ID
            $topicNames = Conference::where('conference', $id)->distinct()->pluck('article')->toArray();
        }

        $encodedClientNames = array_map('utf8_encode', $topicNames);
        return response()->json(['topicNames' => $encodedClientNames]);
    }


    public function generateOTP($user)
    {
        $otp = rand(100000, 999999);

        $verification = admin_verification_codes::where([
            'user_id'   => $user->id
        ])->first();

        if (!$verification) {
            $verification = new admin_verification_codes();
            $verification->user_id = $user->id;
        }

        $verification->expire_at = Carbon::now()->addMinutes(5);
        $verification->otp = $otp;
        $verification->save();

        $data['from_name'] = config('mail.from.name');
        $data['from_email'] = config('mail.from.address');
        $data['subject'] = 'OTP Confirmation';
        $data['otp'] = $otp;
        $data['to_email'] = $user->email;
        $data['to_name'] = $user->name;


        Mail::send(new LoginOTP($data));

        request()->session()->put('login_user_id', $user->id);

        return $verification;
    }


    public function createUser(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',

            ],

        );


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {

            $user = User::where('email', $request->email)->first();
            if ($user) {

                return response()->json(['errors' => [['Email Already Exists']]], 422);
            } else {

                User::create([

                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => "user",
                    'password' => '',

                ]);
            }

            return response()->json([
                'status_code' => '200',
                'message' => 'User Created Successfully',
            ]);
        }
    }



    public function getStatusCount($status = null)
    {

        $positivequery = Conference::query();


        $today = Carbon::today();
        $formattedDate = $today->format('Y-m-d');

        $today_positve_count = $positivequery->join('comments', function ($join) {
            $join->on('comments.conference', '=', 'conferences.conference')
                ->on('comments.email', '=', 'conferences.email')
                ->on('comments.article', '=', 'conferences.article');
        });

        $positive_latestComments = $positivequery->get();
        $PositiveuniqueConferences = $positive_latestComments
            ->unique(function ($item) {
                return $item->email . $item->article . $item->conference;
            })
            ->sortByDesc('created_at')->where('client_status_id', $status)->where('comment_created_date', $formattedDate);

        $positivequery = $PositiveuniqueConferences;

        $positive_count = $positivequery->count();

        return $positive_count;
    }

    public function dashboard()
    {
        $users_data = Conference::latest()->paginate(10);

        $today = Carbon::today();

        $today_conferences_count = Conference::where('user_created_at', $today)
            ->distinct()
            ->pluck('conference') // Assuming 'name' is the column containing conference names
            ->count();


        $today_data_collected_count = Conference::whereDate('created_at', $today)
            // Assuming 'name' is the column containing conference names
            ->count();

        $today_sent_mail_count = Conference::where('email_sent_status', 'sent')
            ->where('email_sent_date', $today)
            // Assuming 'name' is the column containing conference names
            ->count();

        $today_pending_mail_count = Conference::where('email_sent_status', 'pending')
            ->where('email_sent_date', $today)
            ->count();

        $positive_count = $this->getStatusCount(1);
        $negative_count = $this->getStatusCount(2);
        $followup_count = $this->getStatusCount(3);
        $waiting_for_payment_count = $this->getStatusCount(4);
        $converted_count = $this->getStatusCount(5);
        $rejected_count = $this->getStatusCount(5);
        $countries = Conference::distinct()->pluck('country')->toArray();

        // $all_conferences=ConferencesData::all();

        $all_conferences = Conference::getConferenceNameWithCount();


        return view('admin.dashboard', compact('all_conferences', 'countries', 'today_conferences_count', 'today_data_collected_count', 'today_sent_mail_count', 'today_pending_mail_count', 'positive_count', 'negative_count', 'followup_count', 'waiting_for_payment_count', 'converted_count', 'rejected_count'));
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(Request $request)
    {
        // Validate the request data
        $request->validate(User::$rules);

        // Check if the user already exists
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return redirect()->back()->with('error', 'User already exists.');
        }

        // Create the user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success', 'User created successfully.');
    }



    public function update(Request $request)
    {


        $user = Conference::find($request->id);
        $user->update([
            'create_date' => $request->create_date,
            'email_sent_date' => $request->email_sent_date,
            'company_source' => $request->company_source,
            'contact_source' => $request->contact_source,
            'database_creator_name' => $request->database_creator_name,
            'technology' => $request->technology,
            'client_speciality' => $request->client_speciality,
            'client_name' => $request->client_name,
            'street' => $request->street,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'country' => $request->country,
            'website' => $request->website,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'designation' => $request->designation,
            'email' => $request->email,
            'email_response_1' => $request->email_response_1,
            'email_response_2' => $request->email_response_2,
            'rating' => $request->rating,
            'followup' => $request->followup,
            'linkedin_link' => $request->linkedin_link,
            'employee_count' => $request->employee_count,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User Updated Successfully.');
    }


    public function followupupdate(Request $request)
    {

        $user = followup::find($request->id);
        $user->update([
            'followup_date' => $request->followup_date,
            'followup_type' => $request->followup_type,
            'email' => $request->email,

        ]);

        return redirect()->route('admin.show.followup')->with('success', 'Followup Updated Successfully.');
    }

    public function delete(Request $request)
    {
        $user = Conference::find($request->id);
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User Deleted Successfully.');
    }
    public function uploadold(Request $request)
    {

        $now = Carbon::now();


        $currentDateTime = $now->toDateString();



        $userID = Auth::id();
        // dd($userID);
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt|max:10000000',
            'conference' => 'required',
        ]);



        $file = $request->file('csvFile');
        $path = $file->getRealPath();

        $csv = Reader::createFromPath($path, 'r');
        $headers = $csv->fetchOne();

        // dd($headers);

        $csv->setHeaderOffset(0);

        //if upload from file upload and move to public uploads

        // $file = $request->file('csvFile');

        // $filePath = $file->move(public_path('uploads'), $file->getClientOriginalName()); // Move the file to 'public/uploads' directory

        // $csv = Reader::createFromPath($filePath, 'r');
        // $csv->setHeaderOffset(0); // Set the CSV header row


        $update_count = 0;
        $errorCount = 0;
        $insertcount = 0;




        foreach ($csv as $row) {
            $email = $row['Email'];
            $conference = $row['Conference'];
            $article = $row['Article'];


            // Check if the record exists based on the email
            $model = ConferencesToday::where('email', $email)->where('conference', $request->conference)->where('article', $article)->first();

            if ($model) {
                // If the record exists, update it
                $model->update([
                    'name' => $row['Name'],
                    // 'email' => $row['Email'],
                    // 'article' => $row['Article'],
                    // 'conference' => $row['Conference'],
                    'country' => $row['Country'],

                    'user_id' => $request->user()->id,

                    'user_updated_at' => $currentDateTime,
                    // 'updated_at'=>'',
                ]);
                $update_count++;
            } else {
                // If the record doesn't exist, create a new one

                ConferencesToday::create([

                    'name' => $row['Name'],
                    'email' => $row['Email'],
                    'article' => $row['Article'],
                    // 'conference' => $row['Conference'],
                    'conference' => $request->conference,
                    'country' => $row['Country'],
                    'user_id' => $request->user()->id,

                    'user_created_at' => $currentDateTime,
                    'user_updated_at' => $currentDateTime,

                ]);
                $insertcount++;
            }
        }


        //if upload from uploads
        // if (file_exists($filePath)) {
        //     unlink($filePath);
        // } 


        return response()->json([
            'inserted_count' => 'Inserted Records Count: ' . $insertcount,
            'updated_count' => 'Updated Records Count: ' . $update_count,
            'message' => 'Data Uploaded Successfully',
        ]);
    }

    public function upload(Request $request)


    {



        $now = Carbon::now();


        $currentDateTime = $now->toDateString();



        $userID = Auth::id();
        // dd($userID);
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt|max:10000000',
            'conference' => 'required',
        ]);



        $file = $request->file('csvFile');
        $path = $file->getRealPath();

        $csv = Reader::createFromPath($path, 'r');
        $headers = $csv->fetchOne();

        // dd($headers);

        $csv->setHeaderOffset(0);

        //if upload from file upload and move to public uploads

        // $file = $request->file('csvFile');

        // $filePath = $file->move(public_path('uploads'), $file->getClientOriginalName()); // Move the file to 'public/uploads' directory

        // $csv = Reader::createFromPath($filePath, 'r');
        // $csv->setHeaderOffset(0); // Set the CSV header row


        $update_count = 0;
        $errorCount = 0;
        $insertcount = 0;

        $check_conference = Conference::where('conference', 'like', '%' . $request->conference . '%')->first();

        if ($check_conference) {
            $Particular_Conference_data = Conference::where('conference', 'like', '%' . $request->conference . '%')->get();

            if ($Particular_Conference_data->count() >= 1) {
                foreach ($csv as $row) {

                    $email = $row['Email'];
                    $conference = $row['Conference'];
                    $article = $row['Article'];



                    // Check if the record exists based on email, conference, and article in $Particular_Conference_data
                    $existingRecord = $Particular_Conference_data->first(function ($item) use ($email, $conference, $article) {
                        return $item->email == $email
                            && $item->conference == $conference
                            && $item->article == $article;
                    });

                    // dd($existingRecord);

                    if ($existingRecord) {
                        // If the record exists, update it
                        $existingRecord->update([
                            'name' => $row['Name'],
                            'country' => $row['Country'],
                            'user_id' => $request->user()->id,
                            'user_updated_at' => $currentDateTime,
                            'email_sent_status' => $request->email_sent_status,

                        ]);
                        $update_count++;
                    } else {
                        // If the record doesn't exist, create a new one
                        Conference::create([
                            'name' => $row['Name'],
                            'email' => $row['Email'],
                            'article' => $row['Article'],
                            'conference' => $request->conference,
                            'country' => $row['Country'],
                            'user_id' => $request->user()->id,
                            'user_created_at' => $currentDateTime,
                            'user_updated_at' => $currentDateTime,
                            'email_sent_status' => $request->email_sent_status,

                        ]);
                        $insertcount++;
                    }
                }
            }
        } else {

            foreach ($csv as $row) {
                Conference::create([

                    'name' => $row['Name'],
                    'email' => $row['Email'],
                    'article' => $row['Article'],
                    // 'conference' => $row['Conference'],
                    'conference' => $request->conference,
                    'country' => $row['Country'],
                    'user_id' => $request->user()->id,

                    'user_created_at' => $currentDateTime,
                    // 'user_updated_at' => $currentDateTime,
                    'email_sent_status' => $request->email_sent_status,


                ]);
                $insertcount++;
            }
        }












        //if upload from uploads
        // if (file_exists($filePath)) {
        //     unlink($filePath);
        // } 


        return response()->json([
            'inserted_count' => 'Inserted Records Count: ' . $insertcount,
            'updated_count' => 'Updated Records Count: ' . $update_count,
            'message' => 'Data Uploaded Successfully',
        ]);
    }

    public function usersold(Request $request)
    {



        $query = Conference::query();

        if ($request->search) {
            $query->where('email', 'like', '%' . $request->search . '%');
        } else {


            if ($request->country != 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' && $request->client_status == 'All') {
                $query->where('country', 'like', '%' . $request->country . '%');
            }

            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' && $request->client_status == 'All') {
                $query->where('country', 'like', '%' . $request->country . '%')->where('conference', 'like', '%' . $request->conference . '%');
            }

            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' && $request->client_status == 'All') {
                $query->where('conference', 'like', '%' . $request->conference . '%');
            }

            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' && $request->client_status == 'All') {
                $query->where('user_id', $request->user);
            }

            if ($request->country == 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' && $request->client_status == 'All') {
                $query->where('conference', $request->conference)->where('article', $request->article);
            }

            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' && $request->client_status == 'All') {
                $query->where('user_id', $request->user)->where('conference', $request->conference);
            }
            if ($request->country == 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' && $request->client_status == 'All') {
                $query->where('user_id', $request->user)->where('conference', $request->conference)->where('article', $request->article);
            }



            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '' && $request->client_status == 'All') {
                $query->where('conference', $request->conference)->where('user_created_at', $request->user_created_at);
            }




            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->where('email_sent_status', $request->email_status);
            }

            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->where('conference', $request->conference)->where('user_created_at', $request->user_created_at);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->where('conference', $request->conference)->where('email_sent_status', $request->email_status);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->where('conference', $request->conference)->where('email_sent_status', $request->email_status)->where('country', $request->country);
            }

            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->where('conference', $request->conference)->where('email_sent_status', $request->email_status)->where('country', $request->country)->where('user_id', $request->user);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('conference', $request->conference)->where('email_sent_status', $request->email_status)->where('user_created_at', $request->user_created_at);
            }



            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')->where('client_status_id', $request->client_status);

                $query = $uniqueConferences;
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status != 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();
                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')

                    ->where('client_status_id', $request->client_status)
                    ->where('email_sent_status', $request->email_status);

                $query = $uniqueConferences;
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status != 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();
                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')

                    ->where('client_status_id', $request->client_status)
                    ->where('email_sent_status', $request->email_status)
                    ->where('conference', $request->conference);


                $query = $uniqueConferences;
            }



            if ($request->country == 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->where('conference', $request->conference)->where('article', $request->article)->where('email_sent_status', $request->email_status);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->client_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('country', $request->country)->where('conference', $request->conference)->where('article', $request->article);
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->client_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('user_created_at', $request->user_created_at);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status != 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('conference', $request->conference)
                    ->where('email_sent_status', $request->email_status)
                    ->where('user_created_at', $request->user_created_at)
                    ->where('client_status', $request->client_status);

                $query = $uniqueConferences;
            }






            if ($request->country != 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('country', $request->country);




                $query = $uniqueConferences;
            }



            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();
                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')

                    ->where('client_status_id', $request->client_status)
                    ->where('conference', $request->conference);

                $query = $uniqueConferences;
            }

            if ($request->country == 'All' && $request->conference == 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status != 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();
                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')

                    ->where('client_status_id', $request->client_status)
                    ->where('conference', $request->conference)
                    ->where('article', $request->article)
                    ->where('email_sent_status', $request->email_status);

                $query = $uniqueConferences;
            }



            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('conference', $request->conference)
                    ->where('user_id', $request->user);


                $query = $uniqueConferences;
            }



            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('conference', $request->conference)
                    ->where('user_created_at', $request->user_created_at)

                    ->where('user_id', $request->user);


                $query = $uniqueConferences;
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status != 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('conference', $request->conference)
                    ->where('country', $request->country)

                    ->where('email_sent_status', $request->email_status)

                    ->where('user_id', $request->user);


                $query = $uniqueConferences;
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->client_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->where('user_created_at', $request->user_created_at)->where('user_id', $request->user);
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->where('user_created_at', $request->user_created_at)->where('email_sent_status', $request->email_status);
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->where('user_created_at', $request->user_created_at)->where('email_sent_status', $request->email_status)->where('user_id', $request->user);
            }



            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status != 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('email_sent_status', $request->email_status)
                    ->where('user_created_at', $request->user_created_at);



                $query = $uniqueConferences;
            }



            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('user_created_at', $request->user_created_at);



                $query = $uniqueConferences;
            }





            if ($request->country != 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {
                $query->where('country', $request->country)->where('user_created_at', $request->user_created_at)->where('email_sent_status', $request->email_status);
            }


            if ($request->country != 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->client_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('country', $request->country)->where('user_created_at', $request->user_created_at);
            }



            if ($request->country != 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All' && $request->client_status != 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();
                // dd($request->client_status);
                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('user_created_at', $request->user_created_at)
                    ->where('country', $request->country)
                    ->where('email_sent_status', $request->email_status);

                $query = $uniqueConferences;
            }



            if ($request->country != 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('country', $request->country)
                    ->where('user_created_at', $request->user_created_at);





                $query = $uniqueConferences;
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('conference', $request->conference)
                    ->where('user_created_at', $request->user_created_at)
                    ->where('client_status', $request->client_status);

                $query = $uniqueConferences;
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('client_status_id', $request->client_status)
                    ->where('conference', $request->conference)
                    ->where('user_created_at', $request->user_created_at)
                    ->where('user_id', $request->user)

                    ->where('client_status', $request->client_status);

                $query = $uniqueConferences;
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->client_status != 'All' && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->join('comments', function ($join) {
                    $join->on('comments.conference', '=', 'conferences.conference')
                        ->on('comments.email', '=', 'conferences.email')
                        ->on('comments.article', '=', 'conferences.article');
                });

                $latestComments = $query->get();

                // dd($request->client_status);


                $uniqueConferences = $latestComments
                    ->unique(function ($item) {
                        return $item->email . $item->article . $item->conference;
                    })
                    ->sortByDesc('created_at')
                    ->where('user_id', $request->user)
                    ->where('client_status', $request->client_status);


                $query = $uniqueConferences;
            }
        }








        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })

            ->addColumn('comments_count', function ($row) {
                return $row->comments();
            })

            ->addColumn('client_status', function ($row) {
                return $row->client_status();
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }

    public function users(Request $request)
    {
        $query = Conference::query();

        if ($request->search) {
            $query->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        } else {
            $this->applyFilters($query, $request);
        }

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })
            ->addColumn('comments_count', function ($row) {
                return $row->comments();
            })
            ->addColumn('client_status', function ($row) {
                return $row->client_status();
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }

    private function applyFilters($query, $request)
    {



        // $latestComments = $query->get();

        // $query->when($request->email_status != 'All', function ($query) use ($request) {
        //     // dd($request->email_status);
        //     $query->where('email_sent_status', 'like', '%' . $request->email_status . '%');
        // });

        $query->when($request->email_status != 'All', function ($query) use ($request) {

            if($request->email_status == 'pending'){
                $query->where(function ($query) use ($request) {
                    $query->whereNull('email_sent_status')
                          ->orWhere('email_sent_status', '=', 'pending');
                });
            }else{
                $query->where('email_sent_status', 'like', '%' . $request->email_status . '%');

            }
        });

        $query->when($request->country != 'All', function ($query) use ($request) {
            $query->where('country', 'like', '%' . $request->country . '%');
        });

        $query->when($request->conference != 'All', function ($query) use ($request) {
            $query->where('conference', 'like', '%' . $request->conference . '%');
        });

        $query->when($request->article != 'All', function ($query) use ($request) {
            $query->where('article', 'like', '%' . $request->article . '%');
        });



        $query->when($request->email_sent_from_date != '', function ($query) use ($request) {
            $query->whereBetween('email_sent_date', [$request->email_sent_from_date, $request->email_sent_to_date]);
        });

        $query->when($request->from_date != '', function ($query) use ($request) {

            // dd($request->user_created_at);
            $query->whereBetween('user_created_at', [$request->from_date, $request->to_date]);
        });



        $query->when($request->user != 'All', function ($query) use ($request) {
            $query->where('user_id', $request->user);
        });

        $query->when($request->client_status != 'All', function ($query) use ($request) {
            $query->join('comments', function ($join) {
                $join->on('comments.conference', '=', 'conferences.conference')
                    ->on('comments.email', '=', 'conferences.email')
                    ->on('comments.article', '=', 'conferences.article');
            });
            $query->where('client_status_id', $request->client_status);
        });
    }



    public function conferences(Request $request)
    {

        $conferences = ClientStatus::all();
        $countries = Conference::distinct()->pluck('country',)->toArray();
        $users = User::all();

        return view('admin.conferences', compact('conferences', 'countries', 'users'));
    }

    public function logout(Request $request)
    {

        $user = Auth::user();

        if ($user) {
            Auth::logout(); // Log the user out
            request()->session()->forget('login_user_id');
            return redirect(route('login'));
        }

        // Handle the case where no user is authenticated
        return redirect('/')->with('error', 'No user is currently authenticated.');
    }
    public function edit(Request $request)
    {
        $user = Conference::find($request->id);
        return view('admin.edit', compact('user'));
    }
}
