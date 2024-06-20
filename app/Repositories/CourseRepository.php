<?php

namespace App\Repositories;

use App\Repositories\CourseRepositoryInterface;
use App\Models\Course;

class CourseRepository implements CourseRepositoryInterface 
{
    public function getAllCourses() 
    {
        return Course::all();
    }

    public function getCourseById($courseId) 
    {
        return Course::findOrFail($courseId);
    }

    public function deleteCourse($courseId) 
    {
        $course = Course::findOrFail($courseId);
        $course->delete();
    }

    public function createCourse(array $courseDetails) 
    {
        return Course::create($courseDetails);
    }

    public function updateCourse($courseId, array $newDetails) 
    {
        $course = Course::findOrFail($courseId);
        return $course->update($newDetails);
    }

}