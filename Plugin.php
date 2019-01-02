<?php

namespace Kanboard\Plugin\ModifyTaskCreator;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
        $this->template->hook->attachCallable('template:task:form:second-column', 'ModifyTaskCreator:task_modification/form', function ($task, $errors) {
            if (!isset($task['id'])) {
                // do not allow on creation
                return [ 'allowed' => false ];
            } else {
                return [
                    'allowed' => $this->helper->projectRole->canChangeAssignee($task),
                    'users' => $this->projectUserRoleModel->getAssignableUsersList($task['project_id'], false),
                ];
            }
        });
    }

    public function getPluginName()
    {
        return 'ModifyTaskCreator';
    }

    public function getPluginDescription()
    {
        return t('Allow modifying task creator (user must have the right to modify task assignee)');
    }

    public function getPluginAuthor()
    {
        return 'Pascal Rigaux';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/UnivParis1/kanboard-plugin-modify-task-creator';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.6';
    }
}
