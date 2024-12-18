<?php

namespace App\Http\Controllers;

use App\Interfaces\Repositories\BlogRepositoryInterface;
use App\Traits\HandleExceptionTrait;


class BlogController extends Controller
{
    use HandleExceptionTrait;

    protected $blogRepository;

    const PATH_VIEW_BLOG = 'frontend.blog';
    const PATH_VIEW_BLOG_DETAIL = 'frontend.blog-detail';
    const PER_PAGE = 9;

    public function __construct(
        BlogRepositoryInterface $blogRepository,
    ) {
        $this->blogRepository = $blogRepository;
    }

    public function index()
    {
        return view(self::PATH_VIEW_BLOG, [
            'blogDatas' => $this->blogRepository->getAllBlogs([], self::PER_PAGE), // Paginated blog list for the view
        ]);
    }

    public function detail($slug)
    {
        
        return view(self::PATH_VIEW_BLOG_DETAIL, [
            'blogData' => $this->blogRepository->findByField('slug', $slug)->first(),
        ]);
    }
}
