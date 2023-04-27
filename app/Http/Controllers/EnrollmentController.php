<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassGroup;
use App\Models\StudentEnrollment;
use App\Imports\EnrollmentImport;
use App\Exports\ExportStudentEnrollment;
use App\Exports\ExportStaffEnrollment;
use App\Models\Course;
use App\Models\Staff;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class EnrollmentController extends Controller
{
    public function fetchData()
    {
        $data = StudentEnrollment::latest()->get();
        $classes = ClassGroup::get();
        return view('enrollment/student', compact('data','classes'));
    }

    public function fetchStaffData()
    {
        $data = Course::latest()->get();
        $staff = Staff::latest()->get();
        return view('enrollment/staff', compact('data','staff'));
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
            $data = Excel::toArray(new EnrollmentImport(), $path);

            $data = json_decode(json_encode($data));

            return view('enrollment/edit-import', compact('data'));
            
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
        $filepath = public_path('template/student-enrollment-template.xlsx');
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
            Excel::import(new EnrollmentImport, $path);
            
           
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
                StudentEnrollment::where('id',$idd)->delete();
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
                'student_id' => 'required|array',
                'student_id.*' => 'required|exists:students,student_no',
                'previous_id' => 'required|array',
                'previous_id.*' => 'required|exists:class_groups,id',
                'previous_code' => 'required|array',
                'previous_code.*' => 'required|exists:class_groups,code',
                'previous_name' => 'required|array',
                'previous_name.*' => 'required|exists:class_groups,name',
                'next_id' => 'required|array',
                'next_id.*' => 'required|exists:class_groups,id',
                'next_code' => 'required|array',
                'next_code.*' => 'required|exists:class_groups,code',
                'next_name' => 'required|array',
                'next_name.*' => 'required|exists:class_groups,name',
            ]);
            if ($validator->fails()){
                $response = array(
                    "status" => "unsuccessful",
                    "message" => $validator->messages()->first(),
                );
                return Response::json($response);
            }  
            
            for($i=0; $i < count($request->student_id); $i++){
                $student = Student::where('student_no', $request->student_id[$i])->first();
                $data = new StudentEnrollment();
                $data->student_id = $student->id;
                $data->student_no = $request->student_id[$i];
                $data->previous_class_id = $request->previous_id[$i];
                $data->previous_class_code = $request->previous_code[$i];
                $data->previous_class_name = $request->previous_name[$i];
                $data->next_class_id = $request->next_id[$i];
                $data->next_class_code = $request->next_code[$i];
                $data->next_class_name = $request->next_name[$i];
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
        $check = StudentEnrollment::where('student_no', $request->student_no)->first();
        if($check){
            $response = array("status" => "failed", "message" => "Enrollment already exist for this student");
            return Response::json($response);
        }
        $validator = Validator::make($request->all(), [
            'student_no' => 'required|exists:students,student_no',
            'previous_id' => 'required|exists:class_groups,id',
            'next_id' => 'required|exists:class_groups,id',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }
        try {
            $student = Student::where('student_no', $request->student_no)->first();
            $previous = ClassGroup::where('id', $request->previous_id)->first();
            $next = ClassGroup::where('id', $request->next_id)->first();
            
            $data = new StudentEnrollment();
            $data->student_id = $student->id;
            $data->student_no = $request->student_no;
            $data->previous_class_id = $request->previous_id;
            $data->previous_class_code = $previous->code;
            $data->previous_class_name = $previous->name;
            $data->next_class_id = $request->next_id;
            $data->next_class_code = $next->code;
            $data->next_class_name = $next->name;
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
            'id' => 'required|exists:student_enrollments,id',
            'previous_id' => 'required|exists:class_groups,id',
            'next_id' => 'required|exists:class_groups,id',
        ]);
    
        if ($validator->fails()) {
            $response = array(
                "status" => "failed",
                "message" => $validator->messages()->first(),
            );
            return Response::json($response);
        }
        try {
            $previous = ClassGroup::where('id', $request->previous_id)->first();
            $next = ClassGroup::where('id', $request->next_id)->first();
            
            $data = StudentEnrollment::where('id', $request->id)->first();
            $data->previous_class_id = $request->previous_id;
            $data->previous_class_code = $previous->code;
            $data->previous_class_name = $previous->name;
            $data->next_class_id = $request->next_id;
            $data->next_class_code = $next->code;
            $data->next_class_name = $next->name;
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
        return Excel::download(new ExportStudentEnrollment($request), 'student_enrollment.xlsx');
    }

    public function exportStaffData(Request $request)
    {
        return Excel::download(new ExportStaffEnrollment($request), 'staff_enrollment.xlsx');
    }
}