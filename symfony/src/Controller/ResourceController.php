<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ResourceController extends AbstractController
{
#[IsGranted("ROLE_ADMIN")]
#[Route('/api/admin/resource', name: 'admin_resource', methods: ['GET'])]
public function adminResource(): JsonResponse
{
return new JsonResponse(['message' => 'Admin access granted']);
}

#[IsGranted("ROLE_MANAGER")]
#[Route('/api/manager/resource', name: 'manager_resource', methods: ['GET'])]
public function managerResource(): JsonResponse
{
return new JsonResponse(['message' => 'Manager access granted']);
}

#[IsGranted("ROLE_CLIENT")]
#[Route('/api/client/resource', name: 'client_resource', methods: ['GET'])]
public function clientResource(): JsonResponse
{
return new JsonResponse(['message' => 'Client access granted']);
}
}
