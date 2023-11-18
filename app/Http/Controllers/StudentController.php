<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $data['students'] = Student::all();

        return view('student.index', $data);
    }
}
