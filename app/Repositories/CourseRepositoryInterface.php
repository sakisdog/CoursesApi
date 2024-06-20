<?php

namespace App\Repositories;

interface CourseRepositoryInterface 
{
    public function getAllCourses();
    public function getCourseById($courseId);
    public function deleteCourse($courseId);
    public function createCourse(array $courseDetails);
    public function updateCourse($courseId, array $newDetails);
}