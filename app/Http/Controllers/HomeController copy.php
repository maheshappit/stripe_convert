<?php



namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\ConferencesData;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use app\Models\User;
use DB;

use App\Models\ClientStatus;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;



use App\Exports\ExportUsers;
use App\Models\Comments;
use App\Models\FeebBack;
use Egulias\EmailValidator\Parser\Comment;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Models\ConferencesToday;
use Illuminate\Support\Facades\Response;

use DataTables;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function ShowtodayData()
    {


        $countries = Conference::distinct()->pluck('country',)->toArray();
        $users = User::all();

        return view('user.showtodaydata', compact('countries', 'users'));
    }


    public function todayData(Request $request)
    {


        $auth_user_id = Auth::user()->id;

        $query = ConferencesToday::query()->where('user_id',$auth_user_id);

        if($request->user_created_at != ''){
            $query->where('user_created_at',$request->user_created_at);
        }

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('posted_by', function ($row) {
                return $row->postedby->name ?? '';
            })
            ->rawColumns(['posted_by'])
            ->make(true);


        
    }


    public function updateData(Request $request)
    {

        try{
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
    
    
    
                    // Check if the record exists in the master table
                    $existingRecord = $masterData
                        ->where('email', $record['email'])
                        ->where('conference', $record['conference'])
                        ->where('article', $record['article'])->first();
    
                    if ($existingRecord) {
                        // Update the record
                        $existingRecord->update([
    
                            'name' => $record['name'],
                            'email' => $record['email'],
                            'article' => $record['article'],
                            // 'conference' => $row['Conference'],
                            'conference' => $record['conference'],
                            'country' => $record['country'],
                            'user_id' => $auth_user_id,
                            'user_created_at' => $currentDateTime,
                            'email_sent_date' => null,
                            'email_sent_status' => $record['email_sent_status'],
                            'moved_by' => $auth_user_id,
                            // Update fields as needed
                        ]);
    
    
                        $conference = htmlspecialchars_decode($record['conference']);
                        $delete_record = ConferencesToday::where('email', $record['email'])
                            ->where('conference', $conference)
                            ->where('article', $record['article'])->first();
    
                        if ($delete_record) {
                            $delete_record->delete();
                        }
                    } else {
                        // Insert the record
                        Conference::create([
                            'name' => $record['name'],
                            'email' => $record['email'],
                            'article' => $record['article'],
                            // 'conference' => $row['Conference'],
                            'conference' => $record['conference'],
                            'country' => $record['country'],
                            'user_id' => $auth_user_id,
                            'user_created_at' => $currentDateTime,
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
        }
        catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }

       
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





            Comments::create([
                'article' => $request->article,
                'conference' => $request->conference,
                'email' => $request->email,
                'client_status_id' => $request->client_status_id,
                'conference' => $request->conference,
                'comment' => $request->comment,
                'comment_created_date' => $currentDateTime
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


    public function getClients(Request $request)
    {

        $client_names = Conference::where('country', $request->country_name)->distinct()->pluck('client_name')->toArray();
        $dba_names = Conference::distinct()->pluck('database_creator_name',)->toArray();
        $countries = Conference::distinct()->pluck('country',)->toArray();
        return view('home', compact('client_names', 'countries', 'dba_names'));
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

    private function arrayToCsv($array)
    {
        $output = fopen('php://output', 'w');

        // Add headers
        fputcsv($output, array_keys($array[0]));

        // Add data
        foreach ($array as $row) {
            fputcsv($output, $row);
        }

        fclose($output);

        return ob_get_clean();
    }



    public function sentEmail(Request $request)
    {
        $now = Carbon::now();
        $currentDateTime = $now->toDateString();

        if (!empty($request->selectedData) && isset($request->conference) && isset($request->article)) {
            foreach ($request->selectedData as $email) {

                $original_email = $email['email'];
                $conference = Conference::where('email', $original_email)
                    ->where('conference', 'LIKE', '%' . $request->conference . '%')
                    ->first();

                if ($conference) {
                    $conference->email_sent_status = 'sent';
                    $conference->email_sent_date = $currentDateTime;
                    $conference->save();
                }
            }
        } else if (!empty($request->selectedData) && isset($request->conference) && !isset($request->article)) {
            foreach ($request->selectedData as $email) {

                $original_email = $email['email'];
                $conferences = Conference::where('email', $original_email)
                    ->where('conference', 'LIKE', '%' . $request->conference . '%')
                    ->get();

                foreach ($conferences as $conference) {
                    $conference->email_sent_status = 'sent';
                    $conference->email_sent_date = $currentDateTime;
                    $conference->save();
                }
            }
        }


        $data = $request->selectedData;

        $csvFileName = 'example.csv';
        // Set the headers for the response
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $csvFileName,
        ];

        // Create a StreamedResponse
        $response = new StreamedResponse(function () use ($data) {
            $handle = fopen('php://output', 'w');


            $headers = ['name', 'email', 'article', 'country', 'conference'];

            // Output headers using fputcsv
            fputcsv($handle, $headers);

            // Output the CSV data
            foreach ($data as $row) {
                // Exclude the "id" column if present
                unset($row['id']);
                unset($row['user_created_at']);
                unset($row['user_updated_at']);
                unset($row['user_id']);
                unset($row['download_count']);
                unset($row['created_at']);
                unset($row['updated_at']);
                unset($row['user_downloaded_at']);
                unset($row['email_sent_status']);
                unset($row['email_sent_date']);
                unset($row['posted_by']);
                unset($row['DT_RowIndex']);
                unset($row['client_status']);
                unset($row['comments_count']);


                // Filter the row to include only the columns with the specified headers
                $filteredRow = array_intersect_key(array_flip($headers), $row);

                // If all required headers are present in the row, output it
                if (count($filteredRow) === count($headers)) {
                    fputcsv($handle, $row);
                }
            }

            fclose($handle);
        }, 200, $headers);

        // Get the underlying Symfony response instance
        $symfonyResponse = $response->prepare(request());

        // Include a status message in the response headers
        $symfonyResponse->headers->set('X-Status-Message', 'Emails Status Changed Successfully');

        return $symfonyResponse;
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




    public function getStatusCount($status=null){

        $positivequery = Conference::query();

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
            ->sortByDesc('created_at')->where('client_status_id', $status);

        $positivequery = $PositiveuniqueConferences;

        $positive_count=$positivequery->count();

        return $positive_count;


    }

    public function index()
    {

        $conferences = ConferencesData::all();

        $all_conferences_count = Conference::all()->count();


        $countries = Conference::distinct()->pluck('country',)->toArray();
        $users = User::all();


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
        ->where('email_sent_date',$today)
        // Assuming 'name' is the column containing conference names
        ->count();

        $today_pending_mail_count = Conference::where('email_sent_status', 'pending')
        ->where('email_sent_date',$today)
        ->count();

        $positive_count=$this->getStatusCount(1);
        $negative_count=$this->getStatusCount(2);
        $followup_count=$this->getStatusCount(3);
        $waiting_for_payment_count=$this->getStatusCount(4);
        $converted_count=$this->getStatusCount(5);
        $rejected_count=$this->getStatusCount(5);
        $countries = Conference::distinct()->pluck('country')->toArray();

        // $all_conferences=ConferencesData::all();

        $all_conferences = Conference::getConferenceNameWithCount();

        return view('home', compact('countries', 'users', 'conferences','all_conferences_count','all_conferences','today_conferences_count','today_data_collected_count','today_sent_mail_count','today_pending_mail_count','positive_count','negative_count'));
    }

    public function edit(Request $request)
    {
        $user = Conference::find($request->id);

        $clientStatuses = ClientStatus::pluck('name', 'id')->all();

        $all_conferences=ConferencesData::all();



        return view('edit', compact('user', 'clientStatuses','all_conferences'));
    }


    public function update(Request $request)
    {


        $now = Carbon::now();
        $currentDateTime = $now->toDateString();
        $user = Conference::find($request->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {

            // dd($request->client_status);

            $user->update([
                'name' => $request->name,
                'country' => $request->country,
                'updated_at' => $currentDateTime,
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








            return response()->json([
                'status_code' => '200',
                'message' => 'Client Updated Successfully',
            ]);
        }
    }
}
