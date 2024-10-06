<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface as CategoryRepository;
use App\Services\Interfaces\CategoryServiceInterface as CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Declare service and repository properties to handle the Category logic.
    protected $categoryService;
    protected $categoryRepository;

    // Constructor to initialize the CategoryService and CategoryRepository when CategoryController is called.
    public function __construct(
        CategoryService     $categoryService,
        CategoryRepository  $categoryRepository
    ) {
        $this->categoryService      = $categoryService;    // Service to handle business logic related to categories.
        $this->categoryRepository   = $categoryRepository; // Repository to manage data-related tasks for categories.
    }

    // Method to display the list of categories.
    public function index(Request $request)
    {
        // Set up some configuration data.
        $config['model']    = 'Category';  // Define the model being handled.
        $config['seo']      = config('apps.messages.category');  // Load SEO-related configuration for categories.

        // Fetch paginated list of categories using the service layer.
        $categories_back    = $this->categoryService->paginate($request);

        // Return the view for displaying categories along with the config and data.
        return view('backend.category.index', compact('config', 'categories_back'));
    }

    // Method to show the form for creating a new category.
    public function create()
    {
        $config['model']    = 'Category';  // Define the model being handled.
        $config['seo']      = config('apps.messages.category');  // Load SEO-related configuration for categories.

        // Fetch the categories without a parent (top-level categories) and their children for hierarchical display.
        $categories         = Category::whereNull('parent_id')->with('children')->get();

        // Return the view for creating a new category along with config and category data.
        return view('backend.category.create', compact('config', 'categories'));
    }

    // Method to store the newly created category in the database.
    public function store(StoreCategoryRequest $request)
    {
        // Use the service layer to handle category creation and return success or error messages.
        if ($this->categoryService->create($request)) {
            return redirect()->route('admin.category.index')->with('success', 'Record added successfully');
        }
        return redirect()->route('admin.category.index')->with('error', 'Failed to add record. Please try again');
    }

    // Method to show the form for editing an existing category.
    public function edit($id)
    {
        $config['model']    = 'Category';  // Define the model being handled.
        $config['seo']      = config('apps.messages.category');  // Load SEO-related configuration for categories.

        // Find the category to be edited by its ID using the repository.
        $cate               = $this->categoryRepository->findById($id);

        // Fetch top-level categories and their children for hierarchical selection during edit.
        $categories         = Category::whereNull('parent_id')->with('children')->get();

        // Return the view for editing the category along with the category and config data.
        return view('backend.category.edit', compact('cate', 'config', 'categories'));
    }

    // Method to update an existing category in the database.
    public function update(UpdateCategoryRequest $request, $id)
    {
        // Use the service layer to handle category update and return success or error messages.
        if ($this->categoryService->update($id, $request)) {
            return redirect()->route('admin.category.index')->with('success', 'Record updated successfully');
        }
        return redirect()->route('admin.category.index')->with('error', 'Failed to update record. Please try again');
    }

    // Method to delete an existing category from the database.
    public function destroy($id)
    {
        // Use the service layer to handle category deletion and return success or error messages.
        if ($this->categoryService->destroy($id)) {
            return redirect()->route('admin.category.index')->with('success', 'Record deleted successfully');
        }
        return redirect()->route('admin.category.index')->with('error', 'Failed to delete record. Please try again');
    }
}
