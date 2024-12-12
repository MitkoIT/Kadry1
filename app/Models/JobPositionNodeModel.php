<?php

namespace App\Models;

use CodeIgniter\Model;

class JobPositionNodeModel extends Model
{
    protected $table = 'job_position_node';
    protected $primaryKey = 'id';
    protected $returnType = 'object';

    protected function getFormattedUsersJobPositions(array $data): string
    {
        $response = '';

        foreach ($data ?? [] as $user) {
            $response .= '<li>'.$user->name.'</li>';
        }

        return $response;
    }

    protected function getNodes(
        bool $isRoot = false,
        int $elementId = null
    ): array
    {
        if ($isRoot === true) {
            return $this
                ->select('
                    is_root,
                    element_id AS elementId,
                    child_id AS childId
                ')
                ->where('is_root', $isRoot)
                ->findAll()
            ;
        } else {
            return $this
                ->select('
                    is_root,
                    element_id AS elementId,
                    child_id AS childId
                ')
                ->where('element_id', $elementId)
                ->findAll()
            ;
        }
    }

    protected function generateNode(
        bool $isRoot = false,
        array $jobPositions,
        array $users,
        \stdClass $node
    ): array
    {
        if ($isRoot) {
            return [
                'id' => 1,
                'name' => $jobPositions[1]->name,
                'title' => 
                    '<input type="hidden" class="jobPositionId" value="'.$jobPositions[1]->id.'">'.
                    $this->getFormattedUsersJobPositions(
                        $users[$jobPositions[1]->id] ?? []
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
                    $jobPositions,
                    $users,
                    false,
                    $node->childId
                ),
            ];
        }
    }

    public function generateNodes(
        array $jobPositions,
        array $users,
        bool $root = false,
        int $elementId = null,
    ): array
    {
        $response = [];
        
        if ($root == true) {
            $response = $this->generateNode(
                true,
                $jobPositions,
                $users,
                new \stdClass()
            );

            foreach ($this->getNodes(true) as $node) {
                $response['children'][] = $this->generateNode(
                    false,
                    $jobPositions,
                    $users,
                    $node
                );
            }
        } else {
            foreach ($this->getNodes(false, $elementId) as $node) {
                $response[] = $this->generateNode(
                    false,
                    $jobPositions,
                    $users,
                    $node
                );
            }
        }

        return $response;
    }

    public function assembleNodes(
        array $jobPositions,
        array $users
    ): array
    {
        return $this->generateNodes(
            $jobPositions,
            $users,
            true
        );
    }
}