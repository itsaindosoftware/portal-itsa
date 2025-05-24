<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Servicebe;
use DB;
class BerandaController extends Controller
{
    public function index(Request $request)
    {
        try {
            $service = Servicebe::all();

            $perPage = 6;
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

            if ($service->isEmpty()) {
                Log::warning('Service data is empty from portal-itsa database');
                $service = collect([]); // Empty collection untuk mencegah error
            }

            return view('layouts.front-end.beranda.beranda', compact('service','search','categories','category','featuredNews','news'));

        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Error fetching service data: ' . $e->getMessage());

            // Fallback dengan data kosong
            $service = collect([]);

            return view('layouts.front-end.beranda.beranda', compact('service'))
                ->with('error', 'Unable to load service data. Please try again later.');
        }
    }
}
