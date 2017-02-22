<?php
/**
 * Created by PhpStorm.
 * User: Carlos Eduardo
 * Date: 20/02/2017
 * Time: 10:13
 */

namespace Blog\Services;

use Blog\Repositories\ClienteRepository;
use Blog\Validators\ClienteValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClienteService
{
    /**
     * @var ClienteRepository
     */
    protected $repository;
    /**
     * @var ClienteValidator
     */
    private $validator;

    /**
     * ClienteServices constructor.
     * @param ClienteRepository $repository
     * @param ClienteValidator $validator
     */
    public function __construct(ClienteRepository $repository, ClienteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'messages' => $e->getMessageBag(),
            ];
        }
    }

    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'messages' => $e->getMessageBag(),
            ];
        }
    }
}