<?php

namespace App\Models;

use CodeIgniter\Model;

class JobPositionNodeModel extends Model
{
    protected $table = 'job_position_node';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = [
        'element_id',
        'child_id'
    ];

    protected function getFormattedUsersJobPositions(array $data): string
    {
        $response = '';

        foreach ($data ?? [] as $user) {
            if (!is_null($user->description)) {
                $response .= '<li><b>'.$user->name.'</b> - '.$user->description.'</li>';
            } else {
                $response .= '<li><b>'.$user->name.'</b></li>';
            }
        }

        return $response;
    }

    protected function getNodes(int $elementId): array
    {
        return $this
            ->select('
                job_position.is_root,
                job_position_node.element_id AS elementId,
                job_position_node.child_id AS childId
            ')
            ->join('job_position', 'job_position.id = job_position_node.child_id')
            ->where('job_position_node.element_id', $elementId)
            ->where('is_deleted', null)
            ->findAll()
        ;
    }

    protected function generateNode(
        bool $isRoot = false,
        \stdClass $rootNode,
        array $jobPositions,
        array $users,
        \stdClass $node
    ): array
    {
        if ($isRoot) {
            return [
                'id' => 1,
                'name' => $rootNode->name,
                'title' => 
                    '<input type="hidden" class="jobPositionId" value="'.$rootNode->id.'">'.
                    $this->getFormattedUsersJobPositions(
                        $users[$rootNode->id] ?? []
                    ),
                'children' => [],
            ];
        } else {
            return [
                'id' => $node->childId,
                'name' => $jobPositions[$node->childId]->name,
                'title' => 
                    '<input type="hidden" class="jobPositionId" value="'.$jobPositions[$node->childId]->id.'">'.
                    $this->getFormattedUsersJobPositions(
                        $users[$jobPositions[$node->childId]->id] ?? [],
                    ),
                'children' => $this->generateNodes(
                    $rootNode,
                    $jobPositions,
                    $users,
                    false,
                    $node->childId
                ),
            ];
        }
    }

    public function generateNodes(
        \stdClass $rootNode,
        array $jobPositions,
        array $users,
        bool $root = false,
        int $elementId = null,
    ): array
    {
        $response = [];
        
        if (!empty($jobPositions)) {
            if ($root == true) {
                $response = $this->generateNode(
                    true,
                    $rootNode,
                    $jobPositions,
                    $users,
                    new \stdClass()
                );

                foreach ($this->getNodes(1) as $node) {
                    if (!empty($jobPositions[$node->childId])) {
                        $response['children'][] = $this->generateNode(
                            false,
                            $rootNode,
                            $jobPositions,
                            $users,
                            $node
                        );
                    }
                }
            } else {
                foreach ($this->getNodes($elementId) as $node) {
                    if (!empty($jobPositions[$node->childId])) {
                        $response[] = $this->generateNode(
                            false,
                            $rootNode,
                            $jobPositions,
                            $users,
                            $node
                        );
                    }
                }
            }
        }

        return $response;
    }

    public function assembleNodes(
        ?\stdClass $rootNode,
        array $jobPositions,
        array $users
    ): array
    {
        if (!is_null($rootNode)) {
            return $this->generateNodes(
                $rootNode,
                $jobPositions,
                $users,
                true
            );
        } else {
            return [];
        }
    }

    public function addJobPosition(
        int $jobPositionId,
        int $newJobPositionId
    ): void
    {
        $this->insert([
            'element_id' => $jobPositionId,
            'child_id' => $newJobPositionId,
        ]);
    }
}
