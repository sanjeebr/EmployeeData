<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Employee;

use App\EmpSkill;

use App\Hr;

use App\Skill;

use App\Stack;

use Yajra\Datatables\Datatables;

class CsvOperationsController extends Controller
{


    public function home()
    {
        return view('home');
    }

    public function datatable()
    {
        return view('datatable');
    }

    public function graph()
    {
        return view('graphs');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
                'files' => 'required|mimes:csv,txt'
            ]);

        if ($request->hasFile('files'))
        {
            $file            = $request->file('files');
            $size            = $file->getSize();
            $mytime = Carbon::now();
            if (3145728 < $size)
            {
                return response('oversize');
            }

            $path = base_path() . '/public/uploads/';
            $file_name = $mytime->toDateTimeString() . '.csv';
            $request->file('files')->move($path, $file_name);

            $array = array_map('str_getcsv', str_replace(';', ',', file('uploads/' . $file_name)));
            $header = array_shift($array);
            $regex = "/^(Skill)\d+/";
            foreach ($header as $column_name) {
                if( 'EmpID' !== $column_name && 'Name' !== $column_name && 'Last' !== $column_name && 'StackID' !== $column_name && 'StackNickname' !== $column_name && 'CreatedBy' !== $column_name && 'UpdatedBy' !== $column_name && ! preg_match($regex, $column_name)) {
                    return view('home')->with('error', 'Undefined Column Name');
                }
            }
            array_walk($array,array($this, '_combine_array'), $header);

            foreach ($array as $employee_data) {

                    $created_by = Hr::firstOrCreate(array('name' => strip_tags($employee_data['CreatedBy'])));
                    $updated_by = Hr::firstOrCreate(array('name' => strip_tags($employee_data['UpdatedBy'])));

                try {
                    $employee = new Employee;
                    $employee->emp_id = strip_tags($employee_data['EmpID']);
                    $employee->first_name = strip_tags($employee_data['Name']);
                    $employee->last_name = strip_tags($employee_data['Last']);
                    $employee->created_by = $created_by->id;
                    $employee->updated_by = $updated_by->id;
                    $employee->save();
                } catch (\Exception $e) {
                    return view('home')->with('error', 'EmpID - ' . strip_tags($employee_data['EmpID']) . ' is repeated');
                }

                try {
                    $stack = new Stack;
                    $stack->stack_id = strip_tags($employee_data['StackID']);
                    $stack->employee_id = $employee->id;
                    $stack->name = strip_tags($employee_data['StackNickname']);
                    $stack->save();
                } catch (\Exception $e) {
                    return view('home')->with('error', 'StackID - ' . strip_tags($employee_data['StackID']) . ' is repeated');
                }

                $created_by->save();
                $updated_by->save();

                foreach ($employee_data as $key => $value) {
                    if(preg_match($regex, $key) && '' != $value) {
                        $skill = Skill::firstOrCreate(array('name' => $value));
                        $skill->save();
                        $employee_skill = new EmpSkill;
                        $employee_skill->employee_id = $employee->id;
                        $employee_skill->skill_id = $skill->id;
                        $employee_skill->save();
                    }
                }
            }
            return view('datatable');
        }

    }

    private function _combine_array(&$row, $key, $header)
    {
        $row = array_combine($header, $row);
    }

    /**
     * @method  datatableindex()
     * @access  public
     * @param   void
     * @return  JSON
     * Desc     This method send data for datatable in expense
     */
    public function datatableindex()
    {
        $emp_data = DB::table('employees')
            ->leftJoin('hr', 'employees.created_by', '=', 'hr.id')
            ->leftJoin('hr as hr_updated_by', 'employees.updated_by', '=', 'hr_updated_by.id')
            ->leftJoin('stacks', 'employees.id', '=', 'stacks.employee_id')
            ->join('emp_skills', 'employees.id', '=', 'emp_skills.employee_id')
            ->join('skills', 'skills.id', '=', 'emp_skills.skill_id')
            ->select('employees.id', 'employees.emp_id', 'employees.first_name', 'employees.last_name', 'hr.name as created_by_name', 'hr_updated_by.name as updated_by_name', 'stacks.name as stack_nickname', 'stacks.stack_id as stack_id', DB::raw('GROUP_CONCAT(DISTINCT skills.name) as skills_name'))
            ->groupBy('employees.id', 'employees.emp_id', 'employees.first_name', 'employees.last_name', 'hr.name', 'hr_updated_by.name', 'stacks.name', 'stacks.stack_id')
            ->get();

        return Datatables::of($emp_data)->make(true);
    }

}
