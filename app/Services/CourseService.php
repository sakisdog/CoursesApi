<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\CourseRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class CourseService
{
    protected $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }
    public function getAllCourses() 
    {
      return $this->courseRepository->getAllCourses();
    }

    public function getCourseById($courseId) 
    {
      return $this->courseRepository->getCourseById($courseId);
    }

    public function deleteCourse($courseId) 
    {
      return $this->courseRepository->deleteCourse($courseId);
    }

    public function createCourse(array $courseDetails) 
    {
      return $this->courseRepository->createCourse($courseDetails);
    }

    public function updateCourse($courseId, array $newDetails) 
    {
      return $this->courseRepository->updateCourse($courseId, $newDetails);
    }

}