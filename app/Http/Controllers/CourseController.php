<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Response;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Repositories\CourseRepositoryInterface;

class CourseController extends Controller
{
    protected $courseService;
    public function __construct(CourseService $courseService) 
    {
        $this->courseService = $courseService;
    }     
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success'   => true,
            'data' => $this->courseService->getAllCourses()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $courseDetails = $request->only([
            'title',
            'description',
            'status',
            'is_premium'
        ]);

        return response()->json(
            [
                'success'   => true,
                'data' => $this->courseService->createCourse($courseDetails)
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($courseId)
    {
        // Creating a validator for courseId route parameter since $courseId is a route parameter 
        // and not part of the request body or query parameters, so i cannot directly validate it using $request->validate().
        $validator = \Illuminate\Support\Facades\Validator::make(['id' => $courseId],
            [
                'id' => 'required|integer'
            ]
        );
        $validator->validate();
        try {
            return response()->json([
                'success'   => true,
                'data' => $this->courseService->getCourseById($courseId)
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success'   => false,
                'data' => '[]'
            ],404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request,$courseId)
    {
        try {
            $attributes = $request->only([
                'title',
                'description',
                'status',
                'is_premium'
            ]);
            $result = $this->courseService->updateCourse($courseId, $attributes);
            return response()->json([
                'success'   => $result ? true : false,
                'message' => $result ? "Course updated successfully" : "Course does not exist",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success'   => false,
                'data' => '[]'
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($courseId)
    {
        try {
            $this->courseService->deleteCourse($courseId);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $ex) {
            return response()->json([
                'success'   => false,
                'data' => '[]'
            ],404);
        }
       
    }
}
