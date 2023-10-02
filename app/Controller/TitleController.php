<?php

namespace App\Controller;

use App\Model\Title;
use App\Request\TitleRequest;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Log\LoggerInterface;
use Hyperf\Logger\LoggerFactory;
use App\Exception\NotFoundException;
use function Hyperf\ViewEngine\view;

class TitleController extends AbstractController
{
    protected LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        // The first parameter corresponds to the name of the log, and the second parameter corresponds to the key in config/autoload/logger.php
        $this->logger = $loggerFactory->get('log', 'default');
    }

    public function index()
    {
        return view('titles.index');
    }

    public function get(RequestInterface $request)
    {     
        return Title::select('id', 'tconst', 'type_id', 'primary', 'original', 'is_adult', 'start_year', 'end_year', 'runtime_minutes', 'img')
            ->with('genres:id,name')
            ->when($request->input('tconst'), function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('tconst', $request->input('tconst'));
                });
            })
            ->when($request->input('primary'), function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('primary', 'like', '%'. $request->input('primary') . '%');
                });
            })
            ->when($request->input('original'), function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('original', 'like', '%'. $request->input('original') . '%');
                });
            })
            ->when($request->input('start_year'), function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('start_year', 'like', '%'. $request->input('start_year') . '%');
                });
            })
            ->when($request->input('end_year'), function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('end_year', 'like', '%'. $request->input('end_year') . '%');
                });
            })
            ->when($request->input('runtime_minutes'), function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('runtime_minutes', 'like', '%'. $request->input('runtime_minutes') . '%');
                });
            })
            ->when($request->input('type_id'), function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('type_id', $request->input('type_id'));
                });
            })
            ->when($request->input('isAdult'), function ($query) use ($request) {
                $query->where(function($query) use ($request) {
                    $query->where('is_adult', $request->input('isAdult'));
                });
            })
            ->when($request->input('genre'), function ($query) use ($request) {
                $query->whereHas('genres', function ($query) use ($request) {
                    $query->where('genre_id', $request->input('genre'));
                });
            })
            ->orderBy('id', 'desc')
        ->paginate(100);
    }

    public function store(TitleRequest $request, ResponseInterface $response)
    {
        try {
            $title      = Title::create($request->input('validated')());
            $this->logger->info("Title created: " . json_encode($title));
            return $response->json($title);
        } catch (NotFoundException $exception) {
            return $response->withStatus(500)->json($exception);
        }
    }

    public function update(TitleRequest $request, ResponseInterface $response, $titleId)
    {
        try{
            $title = Title::find($titleId);
            $title->update($request->validated());
            $this->logger->info("Title updated: " . json_encode($title));

            return $response->json($title);
        } catch (NotFoundException $exception) {
            return $response->withStatus(500)->json($exception);
        }
    }

    public function delete(ResponseInterface $response, $titleId)
    {
        try{
            $title = Title::find($titleId);
            $title->delete();
            $this->logger->info("Title deleted: " . json_encode($title));

            return $response->json($title);
        } catch (NotFoundException $exception) {
            return $response->withStatus(500)->json($exception);
        }
    }
}
