<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usertwo extends Model
{
    use HasFactory;
    protected $table = "usertwo";
    protected $fillable = ['name', 'email', 'filePath','password','course','state'];

    function userInfoSave($user_name, $name, $email,$password,$course,$state,$gender,$hobbies)
    
    {
        // dd($hobbies);

        //insert
        $user_id = DB::table('usertwo')->insertGetId([
            'name' => $user_name,
            'email' => $email,
            'password'=>$password,
            'filePath' => $name,
            'state'=>$state,
            'gender'=>$gender
        ]);
        foreach($course as $course){
            DB::table('courses')
            ->insert([
                'course_name'=> $course,
                'user_id'=>$user_id
            ]);

            if(is_array($hobbies)){
            foreach($hobbies as $hobby){
                // dd($hobbies);
                DB::table('hobbies')
                ->insert([
                    'hobbies'=>$hobby,
                    'user_id'=>$user_id
                ]);
            }
        }else{
            dd('hobbies is not an array', $hobbies);
        }
        }
        return $user_id;
    }
    //update
    function updateUser($id,$name,$email,$state,$gender){
           $response = DB::table('usertwo')
        ->where('id',$id)
        ->update([
            'name'=> $name,
            'email'=> $email,
            'state'=>$state,
            'gender'=>$gender
        ]);
        return $response;
        // $response=DB::update(DB::raw("Update usertwo 
        // set name = '".$name."',
        // email ='".$email."',
        // course='".$course."', 

        // where id = '".$id."',
        // "));

    }
    //get user details bases on id
    function getUserById($id){
      $response = DB::select("select U.* ,
      GROUP_CONCAT(distinct c.COURSE_NAME) as
       course,GROUP_CONCAT(distinct h.hobbies) AS hobbies
       from usertwo AS U 
       LEFT JOIN 
       COURSES AS C
       ON 
       U.ID=C.user_ID and c.status=1 left join
       hobbies as h on h.user_id = u.id and h.status=1
      where u.id = '".$id."' GROUP BY U.ID ");
        return $response;
    }
    //delete user
    function deleteUser($id){
        $response = DB::select("delete from usertwo where id = ".$id."");
        return $response;
    }

    //get allusers

    function getAllUsers(){
        // $rep=DB::select("SELECT * 
        // FROM usertwo
        // as u 
        // left join 
        // courses as
        // c 
        // on u.id = c.user_id
        // ");
        $rep=DB::select("SELECT 
    usertwo.*,
    c.course,
    h.hobbies,
     state.state as userstate
FROM usertwo
LEFT JOIN (
    SELECT user_id, GROUP_CONCAT(course_name) AS course
    FROM courses
    WHERE status = 1
    GROUP BY user_id
) c ON c.user_id = usertwo.id 
LEFT JOIN (
    SELECT user_id, GROUP_CONCAT(hobbies) AS hobbies
    FROM hobbies
    WHERE status = 1
    GROUP BY user_id
) h ON h.user_id = usertwo.id
left join state on state.id = usertwo.state
ORDER BY usertwo.id DESC;
");
        return $rep;
    }
    //set  zero status to courses
    function statusZeroToCourses($id){
        // dd($id);
      $resp=  DB::table('courses')
        ->where('user_id',$id)
        ->update(['status'=>0]);
        return $resp;
    }
    
    function updateUserCourse($course,$id){
        // dd($id."iddd"."course".$course);
       $resp = DB::table('courses')->updateOrInsert(
            ['user_id'=>$id,'course_name'=>$course],
            ['status'=>1]
        );
        return $resp;
    }

    function statusZeroToHobbies($id){
        $resp=DB::table('hobbies')
        ->where('user_id',$id)
        ->update(['status'=>0]);
        return $resp;
    }

    function updateUserHobbies($hobbies,$id){
        $resp=DB::table('hobbies')->updateOrInsert(
            ['user_id'=>$id,'hobbies'=>$hobbies],
            ['status'=>1]
        );
        return $resp;
    }

    function getCoursesData(){
        // $response=DB::select("select course_name,count(course_name)as course from courses where status = 1  group by course_name ; ");
        $response=DB::select("select course_name,
            count(course_name)as course,
            CASE WHEN  courses.status=1 THEN 'active'
            ELSE 'inactive' END as stats
            from courses  group by course_name, stats");
        return $response;

    }

    function getState(){
        $response = DB::select("select * from state");
        return $response;

    }
}