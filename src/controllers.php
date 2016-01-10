<?php
use Doctrine\ORM\Query\ResultSetMapping;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

$app->get('/', function (Application $app) {

    $data = [
        'app' => $app,
        'user_ip' => $_SERVER['REMOTE_ADDR'],
        'show_grid' => true,
    ];

    $review_repository = $app->em->getRepository('Models\Review');

    $data['reviews'] = $review_repository->findAll();

    return $app->twig->render('index.twig', $data);

});

$app->get('/add', function (Application $app) {

    $data = [
        'app' => $app,
        'user_ip' => $_SERVER['REMOTE_ADDR'],
        'show_grid' => false,
    ];

    return $app->twig->render('index.twig', $data);

});



$app->get('/{id}', function (Application $app, $id) {
    $review_repository = $app->em->getRepository('Models\Review');
    $data = [
        'app' => $app,
        'user_ip' => $_SERVER['REMOTE_ADDR'],
    ];

    if(!($data['curr_review'] = $app['db']->fetchAssoc('SELECT * FROM reviews WHERE id = ?', [$id])))
    {
        $app->abort(404, "Review does not exist.");
    }
    else
    {


        $data['last_review'] = $app['db']->fetchAssoc('SELECT * FROM reviews WHERE publish_date < ? ORDER BY publish_date desc LIMIT 1', [$data['curr_review']['publish_date']]);
        $data['next_review'] = $app['db']->fetchAssoc('SELECT * FROM reviews WHERE publish_date > ? ORDER BY publish_date asc LIMIT 1', [$data['curr_review']['publish_date']]);

        return $app->twig->render('review.twig', $data);


    }


});


// ajax

$app->post('/ajax/get_reviews', function (Application $app) {

    $data = [
        'app' => $app,
        'user_ip' => $_SERVER['REMOTE_ADDR'],
    ];


    $q = $app->em->getRepository('Models\Review')->findAll();
    $data['reviews'] = [];


    foreach ($q as $review) {

        $q_likes = $app['db']->fetchAll('SELECT * FROM reviews_likes WHERE review_id = ?', [$review->getId()]);
        $q_likes_for_ip = $app['db']->fetchAll('SELECT * FROM reviews_likes WHERE review_id = ? AND ip = ?', [$review->getId(), $data['user_ip']]);

        $data['reviews'][] = [

            'id' => $review->getId(),
            'name' => $review->getName(),
            'publish_date' => $review->getPublishDate()->format('Y-m-d'),
            'text' => $review->getText(),
            'likes_count' => count($q_likes),
            'likes' => $q_likes,
            'can_like' => !count($q_likes_for_ip) ? true : false,
        ];

    }

    return $app->json($data['reviews']);

});

$app->post('/ajax/add_review_star', function (Application $app, Request $request) {
    $req = json_decode($request->getContent());

    $data = [
        'app' => $app,
        'user_ip' => $_SERVER['REMOTE_ADDR'],
    ];

    if (!$app['db']->fetchAll('SELECT * FROM reviews_likes WHERE review_id = ? AND ip = ?', [$req->id, $data['user_ip']])) {
        //$app['db']->executeInsert('INSERT INTO `reviews_likes` (`review_id`, `date`, `ip`) VALUES (?, ?, ?)', [(int)$_POST['id'], date("Y-m-d H:i:s"), $data['user_ip']]);
        $app['db']->insert('reviews_likes', [
            'review_id' => $req->id,
            'date' => date("Y-m-d H:i:s"),
            'ip' => $data['user_ip'],
        ]);

    }


    return $app->json(true);


});

$app->post('/ajax/add_review', function (Application $app, Request $request) {
    $req = json_decode($request->getContent());

    $data = [
        'app' => $app,
        'user_ip' => $_SERVER['REMOTE_ADDR'],
    ];

    $app['db']->insert('reviews', [
        'name' => $req->name,
        'text' => $req->text,
        'publish_date' => date("Y-m-d H:i:s"),
        'likes' => 0,
        'ip' => $data['user_ip'],
    ]);


    return $app->json(true);


});