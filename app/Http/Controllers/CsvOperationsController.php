<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $forms = Employee::get();
        var_dump($forms);exit;
        return view('datatable');
    }

    public function upload(Request $request)
    {
        // $array = array_map('str_getcsv', str_replace(';', ',', file('Test - Parse Sheet.csv')));
        // $header = array_shift($array);
        // array_walk($array,array($this, '_combine_array'), $header);
        if ($request->hasFile('files'))
        {
            $file            = $request->file('files');
            $file_extension  = $file->getClientOriginalExtension();
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

                }
            }
            array_walk($array,array($this, '_combine_array'), $header);

            foreach ($array as $employee_data) {
                $created_by = Hr::firstOrCreate(array('name' => strip_tags($employee_data['CreatedBy'])));
                $created_by->save();
                $updated_by = Hr::firstOrCreate(array('name' => strip_tags($employee_data['UpdatedBy'])));
                $updated_by->save();

                $employee = new Employee;
                $employee->emp_id = strip_tags($employee_data['EmpID']);
                $employee->first_name = strip_tags($employee_data['Name']);
                $employee->last_name = strip_tags($employee_data['Last']);
                $employee->created_by = $created_by->id;
                $employee->updated_by = $updated_by->id;
                $employee->save();

                $stack = new Stack;
                $stack->stack_id = strip_tags($employee_data['StackID']);
                $stack->employee_id = $employee->id;
                $stack->name = strip_tags($employee_data['StackNickname']);
                $stack->save();

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

        $forms = Employee::get();

        return Datatables::of($forms);
    }

}
