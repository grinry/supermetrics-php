<?php

use App\Http\CookieManager;
use App\Http\App;
use App\Http\JsonResponse;
use App\Lib\StatsRepository;
use App\Lib\Supermetrics\RestClient;
use App\Services\Authenticator;
use App\Services\DataRetriever;

$app = new App(new CookieManager, new JsonResponse);

$client = new RestClient();
$authenticator = new Authenticator($app, $client);

$retriever = new DataRetriever($authenticator, $client);

// Get posts from API.
$posts = $retriever->getData(1, 10);

// Feed repository with posts.
$repository = new StatsRepository($posts);

// Transform and get data.
$avg = $repository->getAvgPostCharactersForEachMonth();
$longest = $repository->getLongestPostForEachMonth();
$postsPerWeek = $repository->getTotalPostsSplitByWeek();
$avgPostsPerUser = $repository->getAvgNumberOfPostsPerUserPerMonth();

// Print results
$app->response->json([
    'Average character length of a post / month' => $avg,
    'Longest post by character length / month' => $longest,
    'Total posts split by week' => $postsPerWeek,
    'Average number of posts per user / month' => $avgPostsPerUser,
]);
