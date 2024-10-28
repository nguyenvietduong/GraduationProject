<?php

namespace App\Services;

use App\Interfaces\Repositories\BlogRepositoryInterface;
use App\Interfaces\Services\BlogServiceInterface;
use App\Interfaces\Services\ImageServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class BlogService extends BaseService implements BlogServiceInterface
{
    protected $blogRepository;
    protected $imageService; // Service for handling image storage and management

    /**
     * Create a new instance of BlogService.
     *
     * @param BlogRepositoryInterface $blogRepository
     * @param ImageServiceInterface $imageService
     */
    public function __construct(
        BlogRepositoryInterface $blogRepository,
        ImageServiceInterface $imageService
    ) {
        $this->blogRepository = $blogRepository;
        $this->imageService = $imageService; // Initialize the image service
    }

    /**
     * Get a paginated list of blogs with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return mixed
     * @throws Exception
     */
    public function getAllBlogs(array $filters = [], int $perPage = 5)
    {
        try {
            // Retrieve blogs from the repository using filters and pagination
            return $this->blogRepository->getAllBlogs($filters, $perPage);
        } catch (Exception $e) {
            // Handle any exceptions that occur while retrieving blogs
            throw new Exception('Unable to retrieve blog list: ' . $e->getMessage());
        }
    }

    /**
     * Get the details of a blog by ID.
     *
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function getBlogDetail(int $id)
    {
        try {
            return $this->blogRepository->getBlogDetail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Blog does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to retrieve blog details: ' . $e->getMessage());
        }
    }

    /**
     * Create a new blog.
     *
     * @param array $data
     * @return mixed
     */
    public function createBlog(array $data)
    {
        DB::beginTransaction(); // Start transaction for atomicity
        $data['user_id'] = Auth::user()->id;
        
        try {
            $image = null;

            // Handle image upload from the request if present
            if (isset($data['image'])) {
                $data['image'] = $this->imageService->storeImage('blog_files', $data['image']);
            } elseif (session('image_blog_temp')) {
                // Handle temporary image if session data exists
                $tempImageName = session('image_blog_temp');
                $tempImagePath = $tempImageName;

                // Check if the temporary image exists in storage
                if (Storage::exists($tempImagePath)) {
                    $fullTempImagePath = Storage::path($tempImagePath);
                    $image = new UploadedFile(
                        $fullTempImagePath,
                        $tempImageName,
                        null,
                        null,
                        true
                    );

                    // Store the image in S3 and delete the temporary image
                    $data['image'] = $this->imageService->storeImage('blog_files', $image);
                    $this->imageService->deleteImage($tempImagePath); // Clean up temp image
                } else {
                    throw new Exception('Temporary image does not exist in local storage.');
                }
            }

            // Create the blog in the repository
            $blog = $this->blogRepository->createBlog($data);

            DB::commit(); // Commit the transaction after success
            return $blog;

        } catch (Exception $e) {
            DB::rollBack(); // Rollback in case of an error

            // Re-throw the exception for higher-level handling
            throw new Exception('Unable to create blog: ' . $e->getMessage());
        }
    }

    /**
     * Update a blog by ID.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function updateBlog(int $id, array $data)
    {
        // Store old data for recovery in case of an error
        $oldBlog = $this->blogRepository->getBlogDetail($id);
        $oldImagePath = $oldBlog->image; // Store the old image path
        // Start transaction to ensure all changes are atomic
        DB::beginTransaction();
    
        try {
            // Handle image upload if present
            if (isset($data['image'])) {
                // Update image in S3
                $data['image'] = $this->imageService->updateImage('blog_files', $data['image'], $oldImagePath);
            } elseif (session('image_blog_temp')) {
                // Handle temporary image if present in session
                $tempImageName = session('image_blog_temp');
                $tempImagePath = $tempImageName;
    
                // Check if the temporary image exists in storage
                if (Storage::exists($tempImagePath)) {
                    $fullTempImagePath = Storage::path($tempImagePath);
                    $image = new UploadedFile(
                        $fullTempImagePath,
                        $tempImageName,
                        null,
                        null,
                        true
                    );
    
                    // Update image in S3 and delete temporary image
                    $data['image'] = $this->imageService->updateImage('blog_files', $image, $oldImagePath);
                    $this->imageService->deleteImage($tempImagePath); // Clean up temporary image
                } else {
                    throw new Exception('Temporary image does not exist in local storage.');
                }
            }
    
            // Update the blog in the repository
            $this->blogRepository->updateBlog($id, $data);
            
            DB::commit(); // Commit the transaction after success
    
        } catch (ModelNotFoundException $e) {
            DB::rollBack(); // Rollback in case of a model not found error
            throw new ModelNotFoundException('Blog does not exist with ID: ' . $id);
        } catch (Exception $e) {
            DB::rollBack(); // Rollback for any other exceptions
            throw new Exception('Unable to update blog: ' . $e->getMessage());
        }
    }    

    /**
     * Delete a blog by ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function deleteBlog(int $id)
    {
        try {
            return $this->blogRepository->deleteBlog($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException('Blog does not exist with ID: ' . $id);
        } catch (Exception $e) {
            // Handle other errors if necessary
            throw new Exception('Unable to delete blog: ' . $e->getMessage());
        }
    }
}
