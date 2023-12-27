<?php

namespace App\Models;

use App\Models\ConferencesData;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Validation\Rule;
use App\Rules\UniqueConferenceEmailArticle;
use Egulias\EmailValidator\Parser\Comment;

class Conference extends Model
{
    use HasFactory;

    protected $table='conferences';

    protected $fillable = [
        'name',
        'email',
        'article',
        'country',
        'conference',
        'user_id',
        'user_created_at',
        'user_updated_at',
        'email_sent_status',
        'email_sent_date',
        'client_status',
    ];

    public static function rules($id = null)
    {
        return [
            'conference' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', new UniqueConferenceEmailArticle($id)],
            'article' => 'required|string|max:255',
            // Add other validation rules as needed
        ];
    }

    public function postedby()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class,'email','email','conference','conference','article','article')->count();
    }

   

    public function client_status()
    {
        $latestCommentId = $this->hasMany(Comments::class, 'email', 'email', 'conference', 'conference', 'article', 'article')
    ->latest('created_at')
    ->value('client_status_id');

     $client_status=ClientStatus::where('id',$latestCommentId)->latest('created_at')->value('name');

     return $client_status;


        // return $jsonString;


//         $decodedData = json_decode(stripslashes($jsonString), true);
// return $decodedData['id'];
//     //     // Access the client_status_id
//     //   return   $clientStatusId = $decodedData['client_status_id'];



        // if (isset($decodedData['client_status_id'])) {
        //     $clientStatusId = $decodedData['client_status_id'];
        // return  $clientStatusId;
        // } else {
        //     echo "client_status_id not found in the decoded data.";
        // }
        



    }


    public function positive_count($conference,$user_id,$start_date,$end_date)
    {

        $positive_count = Comments::where('conference', '=', $conference)
             ->where('user_id', $user_id)
             ->where('client_status_id', 1)
             ->whereBetween('comment_created_date', [$start_date, $end_date]) // Assuming your Comments model has a 'created_at' column
             ->count();
             return $positive_count;

    }


    public function negative_count($conference,$user_id,$start_date,$end_date)
    {

        $positive_count = Comments::where('conference', '=', $conference)
             ->where('user_id', $user_id)
             ->where('client_status_id', 2)
             ->whereBetween('comment_created_date', [$start_date, $end_date]) // Assuming your Comments model has a 'created_at' column
             ->count();
             return $positive_count;

    }



   


}
