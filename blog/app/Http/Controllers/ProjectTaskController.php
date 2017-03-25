<?php

namespace Blog\Http\Controllers;

use Blog\Repositories\ProjectTaskRepository;
use Blog\Services\ProjectTaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectTaskController extends Controller
{  /**
 * @var ProjectTaskRepository
 */
    private $repository;
    /**
     * @var ProjectTaskService
     */
    private $service;

    /**
     * ProjectNoteController constructor.
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskService $service
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
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
    public function show($id, $taskId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $taskId]);
        } catch (ModelNotFoundException $e) {
            return ['erro' => true, 'message' => 'Tarefa não encontrada'];
        } catch (\Exception $e) {
            return ['error'=> true, 'message' => 'Ocorreu algum erro ao buscar a Tarefa.'];
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $taskId)
    {
        try {
            return $this->service->update($request->all(), $taskId);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message' => 'Tarefa do Projeto não encontrada.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'message' => 'Ocorreu algum erro ao atualizar a Tarefa do Projeto.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $taskId)
    {
        try {
            $this->repository->delete($taskId);
            return ['success' => true, 'message' => 'Tarefa do Projeto excluida com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message' => 'Tarefa do Projeto não encontrada.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'message' => 'Ocorreu algum erro ao excluir a Tarefa do Projeto.'];
        }
    }
}