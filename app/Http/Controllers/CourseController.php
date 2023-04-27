<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Course;
use App\Models\StudentEnrollment;
use App\Imports\EnrollmentImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function fetchData()
    {
        $data = Course::latest()->get();
        $staff = Staff::get();
        return view('course/index', compact('data','staff'));
    }

    public function createData(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'name' => 'required|string',
            'staff_id' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }
        try {
            
            $data = new Course();
            $data->code = $request->code;
            $data->name = $request->name;
            $data->staff_id = $request->staff_id;
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
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'name' => 'required|string',
            'staff_id' => 'required|string',
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
            
            $data = Course::where('id', $request->id)->first();
            $data->code = $request->code;
            $data->name = $request->name;
            $data->staff_id = $request->staff_id;
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

    public function bulkAction(Request $request) {
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
                ClassGroup::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }
    
}