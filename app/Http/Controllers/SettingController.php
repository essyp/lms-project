<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppSetting;
use App\Models\StaffRole;
use App\Models\Grade;
use App\Imports\StaffImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function fetchData()
    {
        $data = AppSetting::latest()->get();
        return view('setting/index', compact('data'));
    }

    public function fetchGrades()
    {
        $data = Grade::latest()->get();
        return view('setting/grade', compact('data'));
    }

    public function createData(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'module' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }
        try {
            $data = new AppSetting();
            $data->slug = Str::slug($request->title);
            $data->title = $request->title;
            $data->description = $request->description;
            $data->module = $request->module;
            $data->save();

            $response = array(
                "status" => "success",
                "message" => "operation successful!",
            );
            return Response::json($response);
        } catch (\Exception $e) {
            $response = array(
                "status" => "failed",
                "message" => "operation failed! - ".$e->getMessage(),
            );
            return Response::json($response);
        }
    }

    public function updateData(Request $request){
        try {
            for($i=0; $i < count($request->description); $i++){
                $data = AppSetting::where('id', $request->id[$i])->first();
                $data->description = isset($request->description[$i])?$request->description[$i]:'';
                $data->save();
            }

            $response = array(
                "status" => "success",
                "message" => "operation successful!",
            );
            return Response::json($response);
        } catch (\Exception $e) {
            $response = array(
                "status" => "failed",
                "message" => "operation failed! - ".$e->getMessage(),
            );
            return Response::json($response);
        }
    }

    public function createGrade(Request $request){
        $validator = Validator::make($request->all(), [
            'grade_code' => 'required|string',
            'min_score' => 'required|integer',
            'max_score' => 'required|integer',
            'letter_grade' => 'required|string',
            'comment_grade' => 'required|string',
            'gpa_grade' => 'required|integer',
            'registration_code' => 'required|string',
            'grade_scale_type' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }
        try {
            $data = new Grade();
            $data->grade_code = $request->grade_code;
            $data->min_score = $request->min_score;
            $data->max_score = $request->max_score;
            $data->letter_grade = $request->letter_grade;
            $data->comment_grade = $request->comment_grade;
            $data->gpa_grade = $request->gpa_grade;
            $data->registration_code = $request->registration_code;
            $data->grade_scale_type = $request->grade_scale_type;
            $data->save();

            $response = array(
                "status" => "success",
                "message" => "operation successful!",
            );
            return Response::json($response);
        } catch (\Exception $e) {
            $response = array(
                "status" => "failed",
                "message" => "operation failed! - ".$e->getMessage(),
            );
            return Response::json($response);
        }
    }

    public function updateGrade(Request $request){
        $validator = Validator::make($request->all(), [
            'grade_code' => 'required|string',
            'min_score' => 'required|integer',
            'max_score' => 'required|integer',
            'letter_grade' => 'required|string',
            'comment_grade' => 'required|string',
            'gpa_grade' => 'required|integer',
            'registration_code' => 'required|string',
            'grade_scale_type' => 'required|string',
            'id' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }
        try {
            $data = Grade::where('id', $request->id)->first();
            $data->grade_code = $request->grade_code;
            $data->min_score = $request->min_score;
            $data->max_score = $request->max_score;
            $data->letter_grade = $request->letter_grade;
            $data->comment_grade = $request->comment_grade;
            $data->gpa_grade = $request->gpa_grade;
            $data->registration_code = $request->registration_code;
            $data->grade_scale_type = $request->grade_scale_type;
            $data->save();

            $response = array(
                "status" => "success",
                "message" => "operation successful!",
            );
            return Response::json($response);
        } catch (\Exception $e) {
            $response = array(
                "status" => "failed",
                "message" => "operation failed! - ".$e->getMessage(),
            );
            return Response::json($response);
        }
    }

    public function gradeBulkAction(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|array',
            'id.*' => 'required',
        ]);
        if ($validator->fails()){
            $response = array(
                "status" => "unsuccessful",
                "message" => $validator->messages()->first(),
                );
                return Response::json($response);
        }
        $id = $request->id;
       
		if($request->submit == "delete"){
            foreach ($id as $idd) {
                Grade::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }
}