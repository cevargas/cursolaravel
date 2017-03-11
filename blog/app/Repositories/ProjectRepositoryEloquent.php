<?php

namespace Blog\Repositories;

use Blog\Presenters\ProjectPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Blog\Entities\Project;
use Blog\Validators\ProjectValidator;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace Blog\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProjectValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $projectId
     * @param $userId
     * @return bool
     */
    public function isOwner($projectId, $userId)
    {
        try {

            if (count($this->findWhere(['id' => $projectId, 'owner_id' => $userId]))) {
                return true;
            }

            return false;

        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * @param $projectId
     * @param $userId
     * @return bool
     */
    public function hasMember($projectId, $userId)
    {
        try {

            $project = $this->find($projectId);

            foreach ($project->members as $member) {
                if ($member->id == $userId) {
                    return true;
                }
            }

            return false;

        } catch(\Exception $e) {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function presenter()
    {
        return ProjectPresenter::class;
    }
}

