<?php

namespace App\Controller;

use App\DTO\LowestPriceEnquiry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'products')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductsController.php',
        ]);
    }

    #[Route('/products/{id}/promotions', name: 'promotions', methods: 'GET')]
    public function promotions()
    {
    }

    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods: 'POST')]
    public function lowestPrice(Request $request, int $id, SerializerInterface $serializer): Response
    {
        if ($request->headers->has('force_fail')) {
            return new JsonResponse([
                'error' => 'Promotions Engine failure message'
            ], $request->headers->get('force_fail'));
        }

        // 1. Deserialize json data into a enquiryDTO
        /* @var LowestPriceEnquiry $lowestPriceEnquiry */
        $lowestPriceEnquiry =  $serializer->deserialize($request->getContent(), LowestPriceEnquiry::class, 'json');

        // 2. Pass enquiry into a promotions filter
        // the appropriate promotion will be applied
        // 3. Return the modified Enquiry
        $lowestPriceEnquiry->

        return new JsonResponse([
            'quantity' => 5,
            'request_location' => "PL",
            'voucher_code' => "OU812",
            'request_date' => "2023-04-05",
            'product_id' => $id,
            'price' => 100,
            'discounted_price' => 50,
            'promotion_id' => 3,
            'promotion_name' => 'Black Friday half price sale'
        ], 200);
    }

}
