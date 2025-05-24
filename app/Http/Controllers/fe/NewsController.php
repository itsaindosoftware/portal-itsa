<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class NewsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 6; // Number of news items per page
        $search = $request->get('search');
        $category = $request->get('category');

        $query = DB::connection('portal-itsa')->table('news')
            ->leftJoin('users', 'news.users_id', '=', 'users.id')
            ->leftJoin('roles', 'news.role_id', '=', 'roles.id')
            ->leftJoin('departments', 'news.dept_id', '=', 'departments.id')
            ->select(
                'news.id',
                'users.name as name_user',
                'roles.name as role_name',
                'departments.description as dept_name',
                'news.title',
                'news.description',
                'news.pic',
                'news.category',
                'news.created_by',
                'news.created_at',
                'news.status'
            )
            ->where('news.status', 'active')
            ->orderBy('news.created_at', 'desc');

        // Add search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('news.title', 'LIKE', "%{$search}%")
                  ->orWhere('news.description', 'LIKE', "%{$search}%");
            });
        }

        // Add category filter
        if ($category) {
            $query->where('news.category', $category);
        }

        $news = $query->paginate($perPage);

        // Get featured news (latest news)
        $featuredNews = DB::connection('portal-itsa')->table('news')
            ->leftJoin('users', 'news.users_id', '=', 'users.id')
            ->leftJoin('roles', 'news.role_id', '=', 'roles.id')
            ->leftJoin('departments', 'news.dept_id', '=', 'departments.id')
            ->select(
                'news.id',
                'users.name as name_user',
                'roles.name as role_name',
                'departments.description as dept_name',
                'news.title',
                'news.description',
                'news.pic',
                'news.category',
                'news.created_by',
                'news.created_at'
            )
            ->where('news.status', 'active')
            ->orderBy('news.created_at', 'desc')
            ->first();

        // Get categories for filter
        $categories = DB::connection('portal-itsa')->table('news')
            ->select('category')
            ->where('status', 'active')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('layouts.front-end.news.news', compact('news', 'featuredNews', 'categories', 'search', 'category'));
    }
    public function show($id)
    {
        $news = DB::connection('portal-itsa')->table('news')
            ->leftJoin('users', 'news.users_id', '=', 'users.id')
            ->leftJoin('roles', 'news.role_id', '=', 'roles.id')
            ->leftJoin('departments', 'news.dept_id', '=', 'departments.id')
            ->select(
                'news.id',
                'users.name as name_user',
                'roles.name as role_name',
                'departments.description as dept_name',
                'news.title',
                'news.description',
                'news.pic',
                'news.category',
                'news.created_by',
                'news.created_at'
            )
            ->where('news.id', $id)
            ->where('news.status', 'active')
            ->first();

        if (!$news) {
            abort(404, 'News not found');
        }

        // Get related news (same category, exclude current news)
        $relatedNews = DB::connection('portal-itsa')->table('news')
            ->leftJoin('users', 'news.users_id', '=', 'users.id')
            ->select(
                'news.id',
                'users.name as name_user',
                'news.title',
                'news.description',
                'news.pic',
                'news.category',
                'news.created_at'
            )
            ->where('news.category', $news->category)
            ->where('news.id', '!=', $id)
            ->where('news.status', 'active')
            ->orderBy('news.created_at', 'desc')
            ->limit(3)
            ->get();

        return view('layouts.front-end.news.news-detail', compact('news', 'relatedNews'));
    }
}
