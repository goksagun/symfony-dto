<?php

namespace App\Controller;

use App\Dto\Response\Transformer\CustomerStatisticTransformer;
use App\Entity\Customer;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class CustomerStatisticController extends AbstractApiController
{
    private CustomerStatisticTransformer $customerStatisticTransformer;

    public function __construct(CustomerStatisticTransformer $customerStatisticTransformer)
    {
        $this->customerStatisticTransformer = $customerStatisticTransformer;
    }

    /**
     * @Rest\Route("/api/v1/admin/customers/{id<\d+>}/statistics")
     */
    public function indexAction(int $id): Response
    {
        $customer = $this->getDoctrine()->getRepository(Customer::class)->find($id);

        if (true/*\in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)*/) {
            $this->addSerializationGroup(self::SERIALIZATION_GROUP_ADMIN);
        }

        $dto = $this->customerStatisticTransformer->transformFromObject($customer);

        return $this->respond($dto);
    }
}
