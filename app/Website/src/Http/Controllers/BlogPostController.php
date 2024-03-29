<?php

namespace App\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Website\Enums\BlogPostStatus;
use App\Website\Http\Resources\Blogs\BlogPostsResource;
use App\Website\Http\Resources\Blogs\SingleBlogPostResource;
use App\Website\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\QueryParam;

class BlogPostController extends Controller
{
    #[Endpoint('Website/List Blogs', <<<'DESC'
  This endpoint list all blogpost from newest ones to the oldest.
  Additionally you may use ?title= query param to filter by title
 DESC)]
    #[QueryParam('title', 'string', required: false)]
    public function index(Request $request): AnonymousResourceCollection
    {
        $blogs = BlogPost::with('author', 'tags')
            ->where('status', BlogPostStatus::PUBLISHED)
            ->when($request->has('title'), function ($query) use ($request) {
                return $query->where('title', 'like', "%{$request->title}%");
            })
            ->orderBy('publish_date', 'desc')
            ->paginate(15);

        return BlogPostsResource::collection($blogs);
    }

    #[Endpoint('Website/Get Blog Post', <<<'DESC'
  This endpoint retrieve blogpost by a slug.
DESC)]
    public function show(string $slug): SingleBlogPostResource
    {
        $blog = BlogPost::with('author', 'tags')
            ->where('status', BlogPostStatus::PUBLISHED)
            ->where('slug', $slug)
            ->firstOrFail();

        return new SingleBlogPostResource($blog);
    }

    #[Endpoint('Website/Get Blog Post By Tag', <<<'DESC'
  This endpoint retrieve blogpost by a specific tag.
  DESC)]
    public function listByTag(string $tag): AnonymousResourceCollection
    {
        $blogs = BlogPost::with('author', 'tags')
            ->where('status', BlogPostStatus::PUBLISHED)
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag);
            })
            ->orderBy('publish_date', 'desc')
            ->paginate(15);

        return BlogPostsResource::collection($blogs);
    }
}
