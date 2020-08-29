<?php

namespace App\Controller\Api;

use App\Entity\Example;
use App\Formatter\ExampleFormatter;
use App\Response\ApiResponse\JsonSuccessResponse;
use App\Form\ExampleType;
use App\Service\ExampleService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;

class ExampleController extends ApiAbstractController
{
    /**
     * @SWG\Response(
     *     response=200,
     *     description="Creates an example",
     * )
     * @SWG\Parameter(
     *     name="Example body",
     *     in="body",
     *     type="string",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="username", type="string"),
     *         @SWG\Property(property="password", type="string"),
     *         @SWG\Property(property="email", type="string"),
     *         @SWG\Property(property="firstName", type="string"),
     *         @SWG\Property(property="lastName", type="string")
     *     )
     * )
     * @SWG\Tag(name="Example")
     *
     * @param Request $request
     * @param ExampleService $exampleService
     * @return JsonResponse
     */
    public function createExample(Request $request, ExampleService $exampleService)
    {
        $example = new Example();

        $this->validateForm(ExampleType::class, $example, $request);

        $example = $exampleService->create($example);

        return JsonSuccessResponse::build()
            ->setData(ExampleFormatter::format($example))
            ->getResponse();
    }

    /**
     * @SWG\Response(
     *     response=200,
     *     description="Deletes example by id",
     * )
     * @SWG\Parameter(
     *     name="exampleId",
     *     in="path",
     *     type="number",
     *     required=true,
     * )
     * @SWG\Tag(name="Example")
     *
     * @param $exampleId
     * @param Request $request
     * @param ExampleService $exampleService
     * @return JsonResponse
     */
    public function deleteExample(Request $request, ExampleService $exampleService, $exampleId)
    {
        $exampleService->delete($exampleId);

        return JsonSuccessResponse::build()
            ->getResponse();
    }

    /**
     * @SWG\Response(
     *     response=200,
     *     description="Returns example by id",
     * )
     * @SWG\Parameter(
     *     name="exampleId",
     *     in="path",
     *     type="number",
     *     required=true,
     * )
     * @SWG\Tag(name="Example")
     *
     * @param $exampleId
     * @param Request $request
     * @param ExampleService $exampleService
     * @return JsonResponse
     */
    public function getExample(Request $request, ExampleService $exampleService, $exampleId)
    {
        $example = $exampleService->get($exampleId);

        return JsonSuccessResponse::build()
            ->setData(ExampleFormatter::format($example))
            ->getResponse();
    }

    /**
     * @SWG\Response(
     *     response=200,
     *     description="Updates an example by id",
     * )
     * @SWG\Parameter(name="exampleId", in="path", type="number",required=true )
     * @SWG\Parameter(
     *     name="Example body",
     *     in="body",
     *     type="string",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="username", type="string"),
     *         @SWG\Property(property="password", type="string"),
     *         @SWG\Property(property="email", type="string"),
     *         @SWG\Property(property="firstName", type="string"),
     *         @SWG\Property(property="lastName", type="string")
     *     )
     * )
     * @SWG\Tag(name="Example")
     *
     * @param Request $request
     * @param int $exampleId
     * @param ExampleService $exampleService
     * @return JsonResponse
     */
    public function updateExample(Request $request, ExampleService $exampleService, int $exampleId)
    {
        $example = $exampleService->get($exampleId);

        $this->validateForm(ExampleType::class, $example, $request);

        $example = $exampleService->update($example);

        return JsonSuccessResponse::build()
            ->setData(ExampleFormatter::format($example))
            ->getResponse();
    }
}
