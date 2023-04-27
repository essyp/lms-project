<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentEnrollment;
use App\Imports\StudentImport;
use App\Exports\ExportStudents;
use App\Imports\EditImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function fetchData()
    {
        $data = Student::latest()->get();
        return view('student/index', compact('data'));
    }

    public function editData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_file' => 'required|file|mimes:xls,xlsx,csv,txt',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }

        try {
            $path = $request->file('import_file');
            $data = Excel::toArray(new StudentImport(), $path);

            $data = json_decode(json_encode($data));

            return view('student/edit-import', compact('data'));
            
        } catch (\Exception $e) {
            $response = array(
                "status" => "failed",
                "message" => "operation failed! - ".$e->getMessage(),
            );
            return Response::json($response);
        }       
        
    }

    public function downloadTemplate()
    {        
        $filepath = public_path('template/student-template.xlsx');
        return Response::download($filepath);
    }

    public function importData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'import_file' => 'required|file|mimes:xls,xlsx,csv,txt',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }

        try {
            $path = $request->file('import_file');
            Excel::import(new StudentImport, $path);
            
           
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
                Student::where('id',$idd)->delete();
                $response = array(
                    "status" => "success",
                    "message" => "Operation Successful",
                );
                
            }
        }
		return Response::json($response);
    }

    public function importEditedData(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|array',
                'email.*' => 'required|unique:students,email',
                'phone_number' => 'required|array',
                'phone_number.*' => 'required|unique:students,phone_number',
                'first_name' => 'required|array',
                'first_name.*' => 'required|string',
                'last_name' => 'required|array',
                'last_name.*' => 'required|string',
            ]);
            if ($validator->fails()){
                $response = array(
                    "status" => "unsuccessful",
                    "message" => $validator->messages()->first(),
                );
                return Response::json($response);
            }  

            $batch_id = $this->unique_code(10);
            
            for($i=0; $i < count($request->first_name); $i++){
                $data = new Student();
                $data->ref = 'RF-'.$this->unique_code(6);
                $data->student_no = $request->student_no[$i];
                $data->first_name = $request->first_name[$i];
                $data->last_name = $request->last_name[$i];
                $data->middle_name = $request->middle_name[$i];
                $data->fullname = $request->first_name[$i].' '.$request->middle_name[$i].' '.$request->last_name[$i];
                $data->email = $request->email[$i];
                $data->phone_number = $request->phone_number[$i];
                $data->parent_name = $request->parent_name[$i];
                $data->state = $request->state[$i];
                $data->lga = $request->lga[$i];
                $data->address = $request->address[$i];
                $data->gender = $request->gender[$i];
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

    public function createData(Request $request){
        $validator = Validator::make($request->all(), [
            'student_no' => 'required|unique:students,student_no',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'phone_number' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }
        try {
            $data = new Student();
            $data->ref = 'RF-'.$this->unique_code(6);
            $data->student_no = $request->student_no;
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->middle_name = $request->middle_name;
            $data->fullname = $request->first_name.' '.$request->middle_name.' '.$request->last_name;
            $data->email = $request->email;
            $data->phone_number = $request->phone_number;
            $data->parent_name = $request->parent_name;
            $data->state = $request->state;
            $data->lga = $request->lga;
            $data->address = $request->address;
            $data->gender = $request->gender;
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
            'parent_name' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }
        try {
            $data = Student::where('id', $request->id)->first();
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->middle_name = $request->middle_name;
            $data->fullname = $request->first_name.' '.$request->middle_name.' '.$request->last_name;
            $data->email = $request->email;
            $data->phone_number = $request->phone_number;
            $data->parent_name = $request->parent_name;
            $data->state = $request->state;
            $data->lga = $request->lga;
            $data->address = $request->address;
            $data->gender = $request->gender;
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

    public function exportData(Request $request)
    {
        return Excel::download(new ExportStudents($request), 'students.xlsx');
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}