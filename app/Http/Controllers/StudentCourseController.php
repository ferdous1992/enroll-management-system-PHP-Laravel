<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enroll;
use Illuminate\Http\Request;
use Session;

class StudentCourseController extends Controller
{
    private $course;
    private $enrollCourses;
    private $student;
    private $result;
    private $enroll;

    public function detail($id)
    {
        $this->enroll = Enroll::find($id);
        $this->course = Course::find($this->enroll->course_id);
        $this->result = [
          'title' => $this->course->title,
          'teacher_name' => $this->course->teacher->name,
          'start_date' => $this->course->start_date,
          'fee' => $this->course->fee,
          'enroll_status' => $this->enroll->enroll_status,
        ];
        return view('student.course.detail',['result' => $this->result]);
    }

    public function studentCourses()
    {
        $this->enrollCourses = Enroll::where('student_id', Session::get('student_id'))->orderBy('id', 'desc')->get();

        return view('student.studentCourses.courses', [
            'enrollCourses' => $this->enrollCourses,
        ]);
    }
}
