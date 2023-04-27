<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\StaffRole;
use App\Imports\StaffImport;
use App\Exports\ExportStaff;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function fetchData()
    {
        $data = Staff::latest()->get();
        $roles = StaffRole::where('status', 'active')->get();
        return view('staff/index', compact('data','roles'));
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
            $data = Excel::toArray(new StaffImport(), $path);

            $data = json_decode(json_encode($data));

            return view('staff/edit-import', compact('data'));
            
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
        $filepath = public_path('template/staff-template.xlsx');
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
            Excel::import(new StaffImport, $path);
            
           
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
                Staff::where('id',$idd)->delete();
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
                'email.*' => 'required|unique:staff,email',
                'phone_number' => 'required|array',
                'phone_number.*' => 'required|unique:staff,phone_number',
                'first_name' => 'required|array',
                'first_name.*' => 'required|string',
                'last_name' => 'required|array',
                'last_name.*' => 'required|string',
                'staff_no' => 'required|array',
                'staff_no.*' => 'required|unique:staff,staff_no',
            ]);
            if ($validator->fails()){
                $response = array(
                    "status" => "unsuccessful",
                    "message" => $validator->messages()->first(),
                );
                return Response::json($response);
            }  

           
            for($i=0; $i < count($request->first_name); $i++){
                
                $role = $request->staff_role[$i];
                $staff_role = StaffRole::where('name', 'LIKE', "%{$role}%")->first();
                if($staff_role){
                    $role_id = $staff_role->id;
                } else {
                    $staff_role = StaffRole::where('name', 'Teacher')->first();
                    $role_id = $staff_role->id;
                }
                
                $data = new Staff();
                $data->ref = 'RF-'.$this->unique_code(6);
                $data->staff_no = $request->staff_no[$i];
                $data->role_id = $role_id;
                $data->first_name = $request->first_name[$i];
                $data->last_name = $request->last_name[$i];
                $data->middle_name = isset($request->middle_name[$i])?$request->middle_name[$i]:'';
                $data->fullname = $request->first_name[$i].' '.$request->middle_name[$i].' '.$request->last_name[$i];
                $data->email = $request->email[$i];
                $data->phone_number = $request->phone_number[$i];
                $data->state = $request->state[$i];
                $data->lga = $request->lga[$i];
                $data->title = isset($request->title[$i])?$request->title[$i]:'';
                $data->address = $request->address[$i];
                $data->gender = $request->gender[$i];
                $data->position = $request->position[$i];
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
            'staff_no' => 'required|unique:staff,staff_no',
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
            $data = new Staff();
            $data->ref = 'RF-'.$this->unique_code(6);
            $data->staff_no = $request->staff_no;
            $data->role_id = $request->role_id;
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->middle_name = $request->middle_name;
            $data->fullname = $request->first_name.' '.$request->middle_name.' '.$request->last_name;
            $data->email = $request->email;
            $data->phone_number = $request->phone_number;
            $data->state = $request->state;
            $data->lga = $request->lga;
            $data->address = $request->address;
            $data->gender = $request->gender;
            $data->title = $request->title;
            $data->position = $request->position;
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
            $data = Staff::where('id', $request->id)->first();
            $data->role_id = $request->role_id;
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->middle_name = $request->middle_name;
            $data->fullname = $request->first_name.' '.$request->middle_name.' '.$request->last_name;
            $data->email = $request->email;
            $data->phone_number = $request->phone_number;
            $data->state = $request->state;
            $data->lga = $request->lga;
            $data->address = $request->address;
            $data->gender = $request->gender;
            $data->title = $request->title;
            $data->position = $request->position;
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
        return Excel::download(new ExportStaff($request), 'staff.xlsx');
    }

    public function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}