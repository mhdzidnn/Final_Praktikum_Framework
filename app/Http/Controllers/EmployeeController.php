<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Employee;
use App\Models\Position;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Employee List';

        confirmDelete();

         // ELOQUENT
        //  $employees = Employee::all();

         return view('employee.index', compact('pageTitle'));

        // RAW SQL QUERY
        // $employees = DB::select('
        //     select *, employees.id as employee_id, positions.name as position_name
        //     from employees
        //     left join positions on employees.position_id = positions.id
        // ');

        //QUERY BUILDER
        // $employees = DB::table('employees')
        // ->select('*', 'employees.id as employee_id')
        // ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
        // ->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Employee';

        // ELOQUENT
        $positions = Position::all();

        return view('employee.create', compact('pageTitle', 'positions'));

        // RAW SQL Query
        // $positions = DB::select('select * from positions');

        //QUERY BUILDER
        // $positions = DB::table('positions')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get File
        $file = $request->file('cv');

        if ($file != null) {
            $originalFilename = $file->getClientOriginalName();
            $encryptedFilename = $file->hashName();

            // Store File
            $file->store('public/files');
        }

         // ELOQUENT
         $employee = New Employee;
         $employee->firstName = $request->firstName;
         $employee->lastName = $request->lastName;
         $employee->email = $request->email;
         $employee->age = $request->age;
         $employee->position_id = $request->position;

         if ($file != null){
            $employee->original_filename = $originalFilename;
            $employee->encrypted_filename = $encryptedFilename;
         }
         $employee->save();

         Alert::success('Added Successfully', 'Employee Data Added Successfully.');

         return redirect()->route('employees.index');

        // INSERT QUERY
        // DB::table('employees')->insert([
        //     'firstname' => $request->firstName,
        //     'lastname' => $request->lastName,
        //     'email' => $request->email,
        //     'age' => $request->age,
        //     'position_id' => $request->position,
        // ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';

        // ELOQUENT
        $employee = Employee::find($id);

        return view('employee.show', compact('pageTitle', 'employee'));

        // RAW SQL QUERY
        // $employee = collect(DB::select('
        //     select *, employees.id as employee_id, positions.name as position_name
        // from employees
        // left join positions on employees.position_id = positions.id
        // where employees.id = ?
        // ', [$id]))->first();

        //QUERY BUILDER
        // $employee = DB::table('employees')
        // ->select('*', 'employees.id as employee_id', 'positions.name as position_name')
        // ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
        // ->where('employees.id', $id)
        // ->first();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Employee';

        // ELOQUENT
        $positions = Position::all();
        $employee = Employee::find($id);

        return view('employee.edit', compact('pageTitle', 'employee', 'positions'));

        // $employee = DB::table('employees')->find($id);
        // $positions = DB::select('select * from positions');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi',
            'email' => 'Isi : attribute dengan format yang benar',
            'numeric' => 'Isi : attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $employee = Employee::find($id);
        $employee->firstName = $request->firstName;
        $employee->lastName = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;

        if ($request->hasFile('cv'))
        {
            // Menghapus CV lama jika ada
            if ($employee->original_filename)
            {
                Storage::disk('public')->delete($employee->original_filename);
            }
            // Mengunggah dan menyimpan CV baru
            $originalFilename = $request->file('cv')->store('cv', 'public');
            $employee->original_filename = $request-> file('cv')->getClientOriginalName();
            $employee->encrypted_filename = $request-> file('cv')->hashName();
            $employee->save();
        }
        $employee->save();

        Alert::success('Changed Successfully', 'Employee Data Changed Successfully.');

        return redirect()->route('employees.index')->with('succes', 'Employee updated succesfully');

        // DB::table('employees')
        // ->where('id', $id)
        // ->update([
        //     'firstName'=> $request->firstName,
        //     'lastName'=> $request->lastName,
        //     'email'=> $request->email,
        //     'age'=> $request->age,
        //     'position_id'=> $request->position,
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ELOQUENT / dapatkan data karyawan
        $employee = Employee::find($id);
        $encryptedFilename = 'public/files/' .$employee->encrypted_filename;

        if (Storage::exists($encryptedFilename))
        {
            $deleted = Storage::delete($encryptedFilename);
        }
        // Hapus data karyawan dari database
        $employee->delete();

        Alert::success('Deleted Successfully', 'Employee Data Deleted Successfully.');

        return redirect()->route('employees.index');

        // QUERY BUILDER
        // DB::table('employees')
        //     ->where('id', $id)
        //     ->delete();
    }

    public function downloadFile($employeeId)
    {
        $employee = Employee::find($employeeId);
        $encryptedFilename = 'public/files/'.$employee->encrypted_filename;
        $downloadFilename = Str::lower($employee->firstname.'_'.$employee->lastname.'_cv.pdf');

        if(Storage::exists($encryptedFilename))
        {
            return Storage::download($encryptedFilename, $downloadFilename);
        }
    }

    public function getData(Request $request)
    {
        $employees = Employee::with('position');

        if ($request->ajax()) {
            return datatables()->of($employees)
                ->addIndexColumn()
                ->addColumn('actions', function($employee)
                {
                    return view('employee.actions', compact('employee'));
                })
                ->toJson();
        }
    }
    public function exportExcel()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    public function exportPdf()
    {
        $employees = Employee::all();
        $pdf = PDF::loadView('employee.export_pdf', compact('employees'));
        return $pdf->download('employees.pdf');
    }



}


