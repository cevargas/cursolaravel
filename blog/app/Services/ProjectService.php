<?php

namespace Blog\Services;

use Blog\Repositories\ProjectRepository;
use Blog\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    private $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;

    /**
     * ClienteServices constructor.
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
     * @param Filesystem $filesystem
     */
    public function __construct(ProjectRepository $repository, ProjectValidator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
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

    public function createFile(array $data)
    {
        $project = $this->repository->skipPresenter()->find($data['project_id']);
        $file = $data['file'];

        $data['nome'] = $file->getClientOriginalName();
        $data['extensao'] = $file->getClientOriginalExtension();

        $project->files()->create($data);

        $this->storage->put($file->getClientOriginalName(), $this->filesystem->get($file));
    }

    public function members($id){
        try {
            $projeto = $this->repository->skipPresenter()->find($id);
            if(sizeof($projeto->members)) {
                return $projeto->members;
            }
            else {
                return ['error' => false, 'message' => 'Nenhum membro vinculado a este projeto'];
            }
        } catch (\Exception $e) {
            return ['error'=> true, 'message' => 'Falha ao buscar os Membros do projeto.'];
        }
    }

    public function addMember(array $data, $id){
        //buscar o projeto e add membro
        try {
            $projeto = $this->repository->skipPresenter()->find($id);
            $projeto->members()->attach($data['user_id']);

            return ['success' => true];

        } catch (\Exception $e) {
            return ['error'=> true, 'message' => 'Falha ao adicionar membro ao Projeto.'];
        }
    }
    
    public function removeMember($id, $userId){
        //buscar o projeto e remover membro
        try {
            $projeto = $this->repository->skipPresenter()->find($id);
            $projeto->members()->detach($userId);

            return ['success' => true];

        } catch (\Exception $e) {
            return ['error'=> true, 'message' => 'Falha ao adicionar membro ao Projeto.'];
        }
    }

    public function isMember($id, $userId){
        try {
            $result = $this->repository->skipPresenter()->find($id)->members()->find($userId);
            return $result ? ['success' => true, 'message' => 'É membro'] : ['error' => true, 'message' => 'Não é membro'];

        } catch (\Exception $e) {
            return ['error'=> true, 'message' => 'Falha ao verificar se Usuario é membro do Projeto.'];
        }
    }
}