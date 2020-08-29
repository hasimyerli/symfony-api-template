<?php
namespace App\Service;

use App\Entity\Example;
use App\Repository\ExampleRepository;
use App\Response\ApiResponse\JsonFailureResponse;
use App\Util\ExceptionUtil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class ExampleService extends AbstractService
{
    private TranslatorInterface $translator;

    public function __construct(EntityManagerInterface $em, TranslatorInterface $translator)
    {
        parent::__construct(Example::class, $em);
        $this->translator = $translator;
    }

    public function create(Example $example)
    {
       $this->save($example);
       return $example;
    }

    public function delete($exampleId)
    {
        $example = $this->get($exampleId);
        $this->delete($example);
    }

    public function get($exampleId): Example
    {
        $example = $this->find($exampleId);

        if(!$example)
        {
            ExceptionUtil::throwException(
                JsonFailureResponse::build()
                    ->setMessage($this->translator->trans('error.example.not_found'))
                    ->setStatusCode(Response::HTTP_NOT_FOUND)
            );
        }

        return $example;
    }

    public function update(Example $example)
    {
        $this->save($example);
        return $example;
    }

    protected function getRepository(): ExampleRepository
    {
        return parent::getRepository();
    }
}