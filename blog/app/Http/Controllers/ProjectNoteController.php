<?php

namespace Blog\Http\Controllers;

use Blog\Repositories\ProjectNoteRepository;
use Blog\Services\ProjectNoteService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    /**
     * ProjectNoteController constructor.
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteService $service
     */
    public function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
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
    public function show($id, $noteId)
    {
        return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
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
    public function update(Request $request, $id, $noteId)
    {
        try {
            return $this->service->update($request->all(), $noteId);
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message' => 'Nota do Projeto não encontrada.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'message' => 'Ocorreu algum erro ao atualizar a Nota do Projeto.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        try {
            $this->repository->delete($noteId);
            return ['success' => true, 'message' => 'Nota do Projeto excluida com sucesso!'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'message' => 'Nota do Projeto não encontrada.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'message' => 'Ocorreu algum erro ao excluir a Nota do Projeto.'];
        }
    }
}
