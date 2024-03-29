<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Conference;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;



class UserController extends Controller
{


    public function indexold(Request $request)
    {



        $query = Conference::query();

        if (isset($request->search)) {
            $query->where('email', 'like', '%' . $request->search . '%');
        } else {
            $query->when($request->country != 'All', function ($query) use ($request) {
                $query->where('country', $request->country);
            });

            $query->when($request->conference != 'All', function ($query) use ($request) {
                $query->where('conference', $request->conference);
            });

            $query->when($request->article != 'All', function ($query) use ($request) {
                $query->where('article', $request->article);
            });

            $query->when($request->email_status != 'All', function ($query) use ($request) {
                $query->where('email_sent_status', $request->email_status);
            });

            $query->when($request->user_created_at != '', function ($query) use ($request) {
                $query->where('user_created_at', $request->user_created_at);
            });

            $query->when($request->user_updated_at != '', function ($query) use ($request) {
                $query->where('user_updated_at', $request->user_updated_at);
            });

            $query->when($request->user != 'All', function ($query) use ($request) {
                $query->where('user_id', $request->user);
            });
        }





        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }

    public function index(Request $request)
    {







        $query = Conference::query();
        $startDate = $request->from_date;


        if (isset($request->search)) {
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


        // dd($request->all());
        $query->when($request->country != 'All', function ($query) use ($request) {
            $query->where('country', $request->country);
        });

        $query->when($request->conference != 'All', function ($query) use ($request) {
            $query->where('conference', $request->conference);
        });

        $query->when($request->article != 'All', function ($query) use ($request) {
            $query->where('article', $request->article);
        });

        $query->when($request->email_status != 'All', function ($query) use ($request) {

            if($request->email_status == 'pending'){
                $query->where(function ($query) use ($request) {
                    $query->whereNull('email_sent_status')
                          ->orWhere('email_sent_status', '=', 'pending');
                });
            }else{
                $query->where('email_sent_status', $request->email_status);

            }
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
    }



    public function showReport()
    {
        ini_set('memory_limit', '256M');

        $all_users = User::all();
        $users_count = User::where('role', 'user')->get()->count();
        $inserted_count = Conference::whereNotNull('user_created_at')->count();
        $updated_count = Conference::whereNotNull('user_updated_at')->count();
        $downloaded_count = Conference::whereNotNull('download_count')->count();
        $all_conferences = Conference::distinct()->pluck('conference')->toArray();
        return view('user.reports', compact('all_users', 'users_count', 'inserted_count', 'updated_count', 'downloaded_count', 'all_conferences'));
    }

    public function downloadReport(Request $request)
    {



        $all_users = User::all();
        $f_date = Carbon::parse($request->from_date);
        $startDate = $f_date->format('Y-m-d');
        // dd($startDate);
        $t_date = Carbon::parse($request->to_date);
        $endDate = $t_date->format('Y-m-d');
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',

        ]);


        $inserted_count = Conference::whereNotNull('user_created_at')
            ->whereBetween('user_created_at', [$startDate, $endDate])
            ->count();


        $users_count = User::where('role', 'user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();


        $updated_count = Conference::whereNotNull('user_updated_at')
            ->whereBetween('user_created_at', [$startDate, $endDate])
            ->count();


        $downloaded_count = Conference::whereNotNull('download_count')
            ->whereBetween('user_downloaded_at', [$startDate, $endDate])
            ->count();


        $query = Conference::query();

        $query->join('users', 'users.id', '=', 'conferences.user_id');
        $query->whereBetween('conferences.user_created_at', [$startDate, $endDate]);

        if ($request->user_id == 'All') {

            $inserted_count = Conference::whereNotNull('user_created_at')
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->count();


            $users_count = User::where('role', 'user')
                ->count();


            $updated_count = Conference::whereNotNull('user_updated_at')
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->count();


            $downloaded_count = Conference::whereNotNull('download_count')
                ->whereBetween('user_downloaded_at', [$startDate, $endDate])
                ->count();
            $query->select('users.id', 'users.name', 'users.created_at');
            $query->selectRaw(
                '
            COUNT(DISTINCT CASE WHEN conferences.user_created_at IS NOT NULL THEN conferences.id END) as inserted_count,
            COUNT(DISTINCT CASE WHEN conferences.user_updated_at IS NOT NULL THEN conferences.id END) as updated_count,
            SUM(conferences.download_count) as download_count'
            );
            $query->whereNotNull('conferences.user_created_at'); // Only count inserted records
            $query->groupBy('users.id', 'users.name', 'users.created_at',);
        } else if ($request->user_id != 'All') {

            $inserted_count = Conference::where('user_id', $request->user_id)
                ->whereBetween('user_created_at', [$startDate, $endDate])
                ->count();


            $users_count = User::where('id', $request->user_id)
                ->count();


            $updated_count = Conference::where('user_id', $request->user_id)
                ->whereBetween('user_updated_at', [$startDate, $endDate])
                ->count();


            $downloaded_count = Conference::whereNotNull('download_count')
                ->where('user_id', $request->user_id)
                ->whereBetween('user_downloaded_at', [$startDate, $endDate])
                ->count();
            $query->where('conferences.user_id', $request->user_id);
            $query->select('users.id', 'users.name', 'users.created_at');

            $query->selectRaw(
                '
            users.id, users.name,
            SUM(CASE WHEN conferences.user_created_at IS NOT NULL THEN 1 ELSE 0 END) as inserted_count,
            SUM(CASE WHEN conferences.user_updated_at IS NOT NULL THEN 1 ELSE 0 END) as updated_count,
            SUM(conferences.download_count) as download_count'
            );
            $query->groupBy('users.id', 'users.name');
        }


        $result = $query->get();

        return DataTables::of($result)
            ->with('users_count', $users_count)
            ->with('inserted_count', $inserted_count)
            ->with('updated_count', $updated_count)
            ->with('downloaded_count', $downloaded_count)
            ->make(true);
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
}
