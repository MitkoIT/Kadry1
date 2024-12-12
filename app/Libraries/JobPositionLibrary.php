<?php

namespace App\Libraries;

use App\Models\JobPositionModel;
use App\Models\JobPositionUserModel;
use App\Models\JobPositionNodeModel;

class JobPositionLibrary
{
    private JobPositionModel $jobPositionModel;
    private JobPositionUserModel $jobPositionUserModel;
    private JobPositionNodeModel $jobPositionNodeModel;

    public function __construct()
    {
        $this->jobPositionModel = new JobPositionModel();
        $this->jobPositionUserModel = new JobPositionUserModel();
        $this->jobPositionNodeModel = new JobPositionNodeModel();
    }

    public function getJobPositionDetails(int $jobPositionId): \stdClass
    {
        return $this->jobPositionModel
            ->getJobPositionDetails($jobPositionId)
        ;
    }

    public function getJobPositionSchema(
        string $type = null,
        \stdClass $company = null
    ): string
    {
        $nodes = $this->jobPositionNodeModel->assembleNodes(
            $this->jobPositionModel
                ->getJobPositions()
            ,
            $this->jobPositionUserModel
                ->getJobPositionUsers()
            ,
        );

        //echo '<pre>'.print_r($nodes, 1).'</pre>';die();

        /*foreach ($nodes as &$node) {
            $node['name'] = $jobPositions[$node['id']]->name;
        }*/

        //$nodes = [];
        //die();
        return json_encode($nodes);
    }
}
