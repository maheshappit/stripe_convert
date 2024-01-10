<?php

namespace App\Http\Controllers;
use Validator;

use Illuminate\Http\Request;
use App\Models\Conference;
use App\Models\ConferencesData;
use App\Models\ConferencesToday;
use League\Csv\Reader;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;





class CsvController extends Controller
{

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

        $check_conference=Conference::where('conference', 'like', '%' . $request->conference . '%')->first();

        if($check_conference){
            $Particular_Conference_data = Conference::where('conference', 'like', '%' . $request->conference . '%')->get();

            if($Particular_Conference_data->count() >= 1){
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
                            'email_sent_status'=>$request->email_sent_status,

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
                            'email_sent_status'=>$request->email_sent_status,
                        ]);
                        $insertcount++;
                    }
                }
                
        
            }

        }else{

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
                    'email_sent_status'=>$request->email_sent_status,

                    // 'user_updated_at' => $currentDateTime,

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


    

   public function show(){

    $conferences=ConferencesData::all();

    return view('upload',compact('conferences'));
   }


    public function progress()
{
    $progress = session('upload_progress', 0);
    $finished = $progress == 100;

    return response()->json([
        'progress' => $progress,
        'finished' => $finished,
    ]);
}
    
}