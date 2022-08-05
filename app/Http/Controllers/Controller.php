<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getSessions(){
        $years = range(date("Y"), 1993);
        return $years;
    }

    public function generateMatric($user)
    {
        $matric = 'ACU' . 'NO' . date("Y"). '/'.'0'.$user->id;
        return $matric;
    }

    public function getPrograms(){
        return [
            'PRE-DEGREE',
            'BSC',
            'MASTERS',
            'PHD'
        ];
    }

    public function getLevels()
    {
        return [
            '1',
            '2',
            '3',
            '4'
        ];
    }

    public function getSemesters()
    {
        return [
            '1',
            '2',
        ];
    }

    public function checkDuplicateResult($student){
        $check = Result::whereStudentId($student->id)
            ->whereAcademicSession(\App\Models\Setting::value('current_session'))
            ->whereSemester((int) $student->semester)
            ->whereLevel($student->level)
            ->first();

        return $check ? true : false;
    }

    public function getCourseForm($student)
    {
        $check = Result::whereStudentId($student->id)
            ->whereAcademicSession(\App\Models\Setting::value('current_session'))
            ->whereSemester((int) $student->semester)
            ->whereLevel($student->level)
            ->first();

        return $check;
    }
    public function calculateGpa($courses, $max){
        $total_units = array_sum(array_column($courses, 'units'));
        $wp = 0;
      
        foreach($courses as $course){
            $wp += $course['units'] * $this->getGradeAlphabet($course['score'])['gp'];
        }
    
        $gp = $wp/$total_units;
        
        $data = [
            'wp' => $wp,
            'gp' => $gp,
        ];

        return $data;
    }

    public function calculateCgpa($student_id, $result_id)
    {
        $prev_results = Result::whereStudentId($student_id)->where('id', '<=', $result_id)->get();

        $t_gp = 0;
        if (isset($prev_results) && !empty($prev_results)) {
            $t_gp = $prev_results->sum('gpa') / $prev_results->count();
        }

        return $t_gp;
    }
    
    public function getGradeAlphabet($score){
        switch ($score) {
            case ($score >= 1 && $score <= 39):
                $grade = 'F';
                $gp = 0.00;
                break;
                
            case ($score >= 40 && $score <= 44):
                $grade = 'E';
                $gp = 1.00;
                break;

            case ($score >= 45 && $score <= 49):
                $grade = 'D';
                $gp = 2.00;
                break;

            case ($score >= 50 && $score <= 59):
                $grade = 'C';
                $gp = 3.00;
                break;

            case ($score >= 60 && $score <= 69):
                $grade = 'B';
                $gp = 4.00;
                break;

            case ($score >= 70 && $score <= 100):
                $grade = 'A';
                $gp = 5.00;
                break;
            default:
                # code...
                break;
        }

        return $result = [
                'grade' => $grade,
                'gp' => $gp,
            ];
    }

   
    public function createTransaction($student, $payment){
        $setting = Setting::first();
        try {
            $transaction = Transaction::create([
                'student_id' => $student->id,
                'user_id' => auth()->user()->id,
                'amount' => $payment->amount,
                'reference' => date('Y') . '-' . date('m') . '-' . rand(1111111, 9999999),
                'payment_id' => $payment->id,
                'name' => $payment->name,
                'program' => $payment->program,
                'semester' => (int) $payment->semester,
                'level' => $payment->level,
                'faculty_id' => $payment->faculty_id,
                'department_id' => $payment->department_id,
                'session' => $setting->current_session,
            ]);

            return $transaction;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
        
    }

}
