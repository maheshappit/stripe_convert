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


    public function index(Request $request)
    {



        $query = Conference::query();

        if (isset($request->search)) {
            $query->where('email', 'like', '%' . $request->search . '%');
        } else {


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' ) {
                $query->where('conference', 'like', '%' . $request->conference . '%');
            }

            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == ''  ) {
                $query->where('user_id', $request->user);

            }

            if ($request->country == 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' ) {
                $query->where('conference', $request->conference)->where('article', $request->article);

            }

            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' ) {
                $query->where('user_id', $request->user)->where('conference', $request->conference);

            }
            if ($request->country == 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user != 'All' && $request->email_status == 'All' && $request->user_created_at  == '' && $request->user_updated_at == '' ) {
                $query->where('user_id', $request->user)->where('conference', $request->conference)->where('article', $request->article);

            }

           

            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All' && $request->user_created_at  != '' && $request->user_updated_at == '' ) {
                $query->where('conference', $request->conference)->where('user_created_at', $request->user_created_at);
            }


           

            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->where('email_sent_status', $request->email_status);
            }

            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->where('conference', $request->conference)->where('user_created_at', $request->user_created_at);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->where('conference', $request->conference)->where('email_sent_status', $request->email_status);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('conference', $request->conference)->where('email_sent_status', $request->email_status)->where('user_created_at', $request->user_created_at);
            }



          

    
            if ($request->country == 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->where('conference', $request->conference)->where('article', $request->article)->where('email_sent_status', $request->email_status);
            }

            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('conference', $request->conference)->where('user_id', $request->user)->where('user_created_at', $request->user_created_at);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('conference', $request->conference)->where('user_id', $request->user)->where('user_created_at', $request->user_created_at)->where('email_sent_status', $request->email_status);
            }

            if ($request->country != 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('country', $request->country);
            }

            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('country', $request->country)->where('conference',$request->conference);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {


                $query->where('country', $request->country)->where('conference',$request->conference)->where('article',$request->article);
            }

            if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->where('country', $request->country)->where('conference',$request->conference)->where('article',$request->article)->where('user_created_at',$request->user_created_at);
            }

             if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->where('country', $request->country)->where('conference',$request->conference)->where('article',$request->article)->where('user_created_at',$request->user_created_at);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {


                $query->where('country', $request->country)->where('conference',$request->conference)->where('article',$request->article)->where('user_created_at',$request->user_created_at)->where('email_sent_status',$request->email_status);
            }



            if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user != 'All' && $request->email_status == 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('country', $request->country)->where('conference',$request->conference)->where('article',$request->article)->where('user_id',$request->user);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user != 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('country', $request->country)->where('conference',$request->conference)->where('article',$request->article)->where('user_id',$request->user)->where('user_created_at',$request->user_created_at);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user != 'All' && $request->email_status == 'All'  && $request->user_created_at  == '' && $request->user_updated_at != '') {

                $query->where('country', $request->country)->where('conference',$request->conference)->where('article',$request->article)->where('user_id',$request->user)->where('user_updated_at',$request->user_updated_at);
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('email_sent_status', $request->email_status)->where('user_created_at',$request->user_created_at);
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('user_created_at',$request->user_created_at);
            }

          

            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('user_id',$request->user);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('user_id',$request->user)->where('email_sent_status',$request->email_status);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('user_id',$request->user)->where('user_created_at',$request->user_created_at);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('user_id',$request->user)->where('user_created_at',$request->user_created_at)->where('email_sent_status',$request->email_status);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('conference',$request->conference)->where('user_id',$request->user)->where('email_sent_status',$request->email_status);
            }



            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  == '' && $request->user_updated_at != '') {

                $query->where('country',$request->user_updated_at);
            }

            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at != '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('user_id',$request->user)->where('user_updated_at',$request->user_updated_at)->where('email_sent_status',$request->email_status);
            }
            
           


            if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('article',$request->article)->where('email_sent_status',$request->email_status);
            }

            if ($request->country != 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('article',$request->article)->where('user_id',$request->user)->where('email_sent_status',$request->email_status);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('email_sent_status',$request->email_status)->where('user_created_at',$request->user_created_at);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('email_sent_status',$request->email_status)->where('user_created_at',$request->user_created_at)->where('user_id',$request->user);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at != '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('email_sent_status',$request->email_status)->where('user_updated_at',$request->user_updated_at)->where('user_id',$request->user);
            }


            if ($request->country != 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('user_id',$request->user);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('article',$request->article)->where('email_sent_status',$request->email_status)->where('user_created_at',$request->user_created_at)->where('user_id',$request->user);
            }


            if ($request->country != 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('user_created_at',$request->user_created_at);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at != '') {

                $query->where('conference',$request->conference)->where('user_created_at',$request->user_created_at)->where('user_updated_at',$request->user_updated_at);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at != '') {

                $query->where('conference',$request->conference)->where('user_created_at',$request->user_created_at)->where('user_updated_at',$request->user_updated_at)->where('user_id',$request->user);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at != '') {

                $query->where('conference',$request->conference)->where('user_created_at',$request->user_created_at)->where('user_updated_at',$request->user_updated_at);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at != '') {

                $query->where('conference',$request->conference)->where('user_created_at',$request->user_created_at)->where('user_updated_at',$request->user_updated_at)->where('email_sent_status',$request->email_status);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user == 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at != '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('user_created_at',$request->user_created_at)->where('user_updated_at',$request->user_updated_at)->where('email_sent_status',$request->email_status);
            }

            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  != '' && $request->user_updated_at != '') {

                $query->where('country',$request->country)->where('conference',$request->conference)->where('user_created_at',$request->user_created_at)->where('user_updated_at',$request->user_updated_at)->where('email_sent_status',$request->email_status)->where('user_id',$request->user);
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('user_created_at',$request->user_created_at)->where('user_id',$request->user);
            }


            if ($request->country == 'All' && $request->conference == 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at == '') {

                $query->where('user_id',$request->user)->where('email_sent_status',$request->email_status);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article == 'All' && $request->user != 'All' && $request->email_status != 'All'  && $request->user_created_at  == '' && $request->user_updated_at != '') {

                $query->where('user_id',$request->user)->where('email_sent_status',$request->email_status)->where('conference',$request->conference)->where('user_updated_at',$request->user_updated_at);
            }


            if ($request->country == 'All' && $request->conference != 'All' && $request->article != 'All' && $request->user == 'All' && $request->email_status == 'All'  && $request->user_created_at  != '' && $request->user_updated_at == '') {

                $query->where('conference',$request->conference)->where('article',$request->article)->where('user_created_at',$request->user_created_at);


             }

             

            }





        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })
            ->rawColumns(['posted_by'])
            ->make(true);
    }



    public function showReport()
    {
        ini_set('memory_limit', '256M');

        $all_users = User::all();
        $users_count = User::where('role', 'user')->get()->count();
        $inserted_count = Conference::whereNotNull('user_created_at')->count();
        $updated_count = Conference::whereNotNull('user_updated_at')->count();
        $download_count = Conference::whereNotNull('download_count')->count();
        $all_conferences = Conference::distinct()->pluck('conference')->toArray();
        return view('user.reports', compact('all_users', 'users_count', 'inserted_count', 'updated_count', 'download_count', 'all_conferences'));
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



        $query = Conference::query();

        $query->join('users', 'users.id', '=', 'conferences.user_id');
        $query->whereBetween('conferences.user_created_at', [$startDate, $endDate]);

        if ($request->user_id == 'All') {
            $query->select('users.id', 'users.name', 'users.created_at');
            $query->selectRaw(
                '
            COUNT(DISTINCT CASE WHEN conferences.user_created_at IS NOT NULL THEN conferences.id END) as inserted_count,
            COUNT(DISTINCT CASE WHEN conferences.user_updated_at IS NOT NULL THEN conferences.id END) as updated_count,
            SUM(conferences.download_count) as download_count'
            );
            $query->whereNotNull('conferences.user_created_at'); // Only count inserted records
            $query->groupBy('users.id', 'users.name', 'users.created_at',);
        } else {
            $query->where('conferences.user_id', $request->user_id);
            $query->select('users.id', 'users.name', 'users.created_at');

            $query->selectRaw(
                '
            users.id, users.name,
            SUM(CASE WHEN conferences.user_created_at IS NOT NULL THEN 1 ELSE 0 END) as inserted_count,
            SUM(CASE WHEN conferences.user_updated_at IS NOT NULL THEN 1 ELSE 0 END) as updated_count,
            SUM(conferences.download_count) as download_count'
            );
            $query->groupBy('users.id', 'users.name', 'users.created_at');
        }


        $result = $query->get();

        return DataTables::of($result)
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
