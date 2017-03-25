<?php

namespace Blog\Http\Controllers;

use Blog\Repositories\ProjectRepository;
use Blog\Services\ProjectService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->findWhere(['owner_id' => \Authorizer::getResourceOwnerId()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $e) {
            return ['erro' => true, 'message' => 'Projeto não encontrado'];
        } catch (\Exception $e) {
            return ['error'=> true, 'message' => 'Ocorreu algum erro ao buscar o Projeto.'];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            return $this->service->update($request->all(), $id);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message' => 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'message' => 'Ocorreu algum erro ao atualizar o Projeto.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            return ['success' => true, 'message' => 'Projeto excluido com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message' => 'Projeto não encontrado.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'message' => 'Ocorreu algum erro ao excluir o Projeto.'];
        }
    }

    /**
     * Retorna lista com membros do projeto
     * @param $id
     * @return array
     */
    public function members($id){
        return $this->service->members($id);
    }

    /**
     * Adiciona membro ao projeto
     * @param Request $request
     * @param $id
     * @return array
     */
    public function addMember(Request $request, $id){
        return $this->service->addMember($request->all(), $id);
    }

    /**
     * Remove membro do projeto
     * @param $id
     * @param $userId
     * @return array
     */
    public function removeMember($id, $userId){
        return $this->service->removeMember($id, $userId);
    }

    /**
     * Verifica se um usuario é membro do projeto
     * @param $userId
     * @return mixed
     */
    public function isMember($id, $userId){
        return $this->service->isMember($id, $userId);
    }
}
