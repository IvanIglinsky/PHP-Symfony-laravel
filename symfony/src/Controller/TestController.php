<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Flex\Response;

final class TestController extends AbstractController
{
    #[Route('/test', name:'app_test')]
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('test/index.html.twig',[
            'controller_name' => 'TestController'
    ]);
    }
}