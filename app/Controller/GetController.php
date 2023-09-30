<?php

namespace App\Controller;

use App\Model\Genre;
use Hyperf\HttpServer\Contract\RequestInterface;

class GetController extends AbstractController
{
    public function genres(RequestInterface $request)
	{
		return Genre::select('id','name')->get();
	}
}
