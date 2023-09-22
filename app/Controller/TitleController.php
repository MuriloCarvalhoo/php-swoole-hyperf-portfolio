<?php

namespace App\Controller;

use App\Models\Title;
use Inertia\Inertia;
use Hyperf\HttpServer\Contract\RequestInterface;


class TitleController extends AbstractController
{
    public function index()
    {
        return Inertia::render('Title/Mariadb/Index');
    }

    public function get(RequestInterface $request)
    {
        ini_set('max_execution_time', 300);

        $records = Title::select('id', 'tconst', 'type_id', 'primary', 'original', 'is_adult', 'start_year', 'end_year', 'runtime_minutes')
            ->with('genres:id,name')
            ->when($request->tconst, function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('tconst', 'like', '%'. $request->tconst . '%');
                });
            })
            ->when($request->primary, function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('primary', 'like', '%'. $request->primary . '%');
                });
            })
            ->when($request->original, function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('original', 'like', '%'. $request->original . '%');
                });
            })
            ->when($request->start_year, function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('start_year', 'like', '%'. $request->start_year . '%');
                });
            })
            ->when($request->end_year, function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('end_year', 'like', '%'. $request->end_year . '%');
                });
            })
            ->when($request->runtime_minutes, function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('runtime_minutes', 'like', '%'. $request->runtime_minutes . '%');
                });
            })
            ->when($request->type_id, function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('type_id', $request->type_id);
                });
            })
            ->when($request->isAdult, function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('is_adult', $request->isAdult);
                });
            })
            ->when($request->genre, function ($query) use ($request) {
                $query->whereHas('genres', function ($query) use ($request) {
                    $query->where('genre_id', $request->genre);
                });
            })
            ->orderBy('id', 'desc')
        ->paginate(30);

        return response()->json($records);
    }
}
