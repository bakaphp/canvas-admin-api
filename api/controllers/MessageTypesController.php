<?php

namespace Gewaer\Api\Controllers;

use Gewaer\Models\MessageTypes;
use Phalcon\Http\Response;

class MessageTypesController extends BaseController
{
    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $createFields = [
        'languages_id',
        'name',
        'verb',
        'template',
        'templates_plura'
    ];

    /**
     * fields we accept to update.
     *
     * @var array
     */
    protected $updateFields = [
        'languages_id',
        'name',
        'verb',
        'template',
        'templates_plura'
    ];

    public function onConstruct(): void
    {
        $this->model = new MessageTypes();
        $this->model->apps_id = $this->app->getId();

        $this->additionalSearchFields = [
            ['apps_id', ':', $this->app->getId()],
            ['is_deleted', ':', 0],
        ];
    }
}
