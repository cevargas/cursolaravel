<?php

namespace Blog\Http\Middleware;

use Blog\Repositories\ProjectRepository;
use Closure;

class CheckProjectPerms
{

    /**
     * @var ProjectRepository
     */
    private $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = ($request->project) ? $request->project : $request->id;
        
        if($projectId) {
            if (!$this->repository->skipPresenter()->isOwner($projectId, $userId) and !$this->repository->skipPresenter()->hasMember($projectId, $userId)) {
                return ['error' => 'Acesso negado.'];
            }
        }

        return $next($request);
    }
}
