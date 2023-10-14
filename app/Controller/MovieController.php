<?php

namespace App\Controller;

use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Exception\NotFoundException;
use App\Model\Title;
use function Hyperf\ViewEngine\view;
use Goutte\Client;
use Hyperf\HttpServer\Contract\RequestInterface;

class MovieController extends AbstractController
{
  public function index()
  {
    return view('movies/index');
  }

  public function getURlImg(Client $client, ResponseInterface $response, $tconst)
  {
    try {

      $title = Title::where('tconst', $tconst)->first();

      if(!$title) {
        return $response->withStatus(500)->json(['error' => 'Error to find title']);
      }

      if($title->img) {
        return $title->img;
      }

      // URL da página que você deseja acessar
      $url = "https://www.imdb.com/title/" . $tconst;

      $crawler = $client->request('GET', $url);

      // Encontre o elemento que você deseja
      $imageTag = $crawler->filter('meta[property="og:image"]');
      $image_url = $imageTag->attr('content');

      if ($imageTag->count() > 0) {
        $image_url = $imageTag->attr('content');

        $title->img = $image_url;
        $title->save();

        return $image_url;
      } else {
        return $response->withStatus(500)->json(['error' => 'Not found']);
      }
    } catch (NotFoundException $exception) {
      return $response->withStatus(500)->json($exception);
    }
  }

  public function get(RequestInterface $request)
  {
    return Title::select('id', 'tconst', 'type_id', 'primary',  'img')
    ->with('genres:id,name')
      ->whereHas('genres', function ($query) use ($request) {
        $query->where('id', $request->input('type_id'));
      })
      ->limit(12)
      ->get();
  }

  public function getElastic(RequestInterface $request)
  {
    return Title::search($request->input('search'))
      ->take(30)
    ->get();
  }
}
