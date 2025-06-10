<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usertwo;
use App\Http\Controllers\mailController;

class crudcontroller extends Controller
{
    //
    function home()
    {
        return view("home");
    }

    function about()
    {
        return view(view: "about");
    }

    function contact()
    {
        return view('contact');
    }

    // function insert(Request $request)
    // {
    //     $file = $request->file('file');
    //     print_r($file);
    //     $fileName = time() . "_" . $file->getClientOriginalName();
    //     print_r("filename" . $fileName);
    //     $filePath = $file->storeAs('images', $fileName, 'public');
    //     // print_r(''.$filePath);
    //     $usertwo = new Usertwo();
    //     $usertwo->name = $request->input('name');
    //     $usertwo->email = $request->input('email');
    //     $usertwo->filePath = $filePath;
    //     $usertwo->save();
    //     return response()->json(['res' => 'Admission created successfully']);
    // }

    function insert2(Request $request)
    {
        $data = $request->all();
        $user_name = $data['name'];
        $email = $data['email'];
        $password=$data['password'];
        $course =$data['course'];
        $state = $data['state'];
        $gender=$data['gender'];
        $hobbies=$data['hobbies'];
        // dd($hobbies);
  
        if ($request->hasFile('file')){
            $image = $request->file('file');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img');
            $image->move($destinationPath, $name);
            $model = new Usertwo;
            $response=$model->userInfoSave($user_name,$name, $email,$password,$course,$state,$gender,$hobbies);
            $stemail = $email;
            $mailer = new mailController();
            // dd($mailer);
           $resp= $mailer->mailFun($user_name,$stemail,$course,$password);

            return $resp;
        }
    }

    function insert(){
      $model= new Usertwo;
      $states = $model->getState();
         return view('insert',
         ["states"=>$states]);
    }
    


    function update_form(Request $request){
        // dd($request->input('hobbies'));
        // dd($request->input('gender'));
        $data = $request->input();
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $courses =$data['course'];
        $state = $data['state'];
        $hobbies =$data['hobbies'];
        $gender=$data['gender'];

    //     if(is_array($hobbies)){
    //         echo("yes this is array");
    //     }else{
    //         echo("this is not an array");
    // }

        $model = new Usertwo;
        $response = $model->updateUser($id,$name,$email,$state,$gender);
        //update course userid set all status to 0
        $statusZero =$model->statusZeroToCourses($id);
        $statusHobbiesZero = $model->statusZeroToHobbies($id);
        // $statusOne = $model->updateUserCourse($id);
        $statusOneToCourses;
        $statusOneToHobbies;
        foreach($courses as $course){
          $statusOneToCourses = $model->updateUserCourse($course,$id);
        }
        foreach($hobbies as $hobbies){
            $statusOneToHobbies=$model->updateUserHobbies($hobbies,$id);
        }
        
        return $statusOneToHobbies;
    }

    function get_user_by_id(Request $request){
        $data=$request->all();
        $id = $data['id'];
        $model =new Usertwo;
        $response = $model->getUserById($id);
        return json_encode($response);
    }

    function delete_user(Request $request){
        $data = $request->all();
        $id=$data['id'];
        $model = new Usertwo;
        $response =$model->deleteUser($id);
        return json_encode($response);
    }
    function users(){
        $model = new Usertwo;
        $response=$model->getAllUsers();

        $count=count($response);
        $json_data = array(
            "recordsTotal"    => intval($count),
            "recordsFiltered" => intval($count),
            "data"            => $response
        );
        echo json_encode($json_data);
    }

    ///get courses data

    function get_courses_data(){
        $model = new Usertwo;
        $response = $model->getCoursesData();
        return json_encode($response);
    }
}
