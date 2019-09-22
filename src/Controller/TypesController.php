<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Types Controller
 *
 * @property \App\Model\Table\TypesTable $Types
 *
 * @method \App\Model\Entity\Type[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $enabled = ':[Todos];1:Activo;0:Inactivo';
        $this->set(compact('enabled'));
    }

    /**
     * Data method
     *
     * @return \Cake\Http\Response|json
     */
    public function data()
    {
        $name = $this->request->getQuery('name');
        $enabled = $this->request->getQuery('enabled');

        $limit = $this->request->getQuery('rows');
        $page = $this->request->getQuery('page');
        $sord = $this->request->getQuery('sord');
        $sidx = $this->request->getQuery('sidx');

        $conditions = [];

        if (!empty($name)) {
            $conditions['name LIKE'] = '%' . $name . '%';
        }
        
        $query = $this->Types->find('all')
            ->where($conditions);

        try {
            $rows = $this->paginate($query, [
                'limit' => $limit,
                'page' => $page,
                'order' => ['Types.' . $sidx => $sord]
            ]);
        } catch (\Exception $e) {
            $rows = [];
        }
        $total = $query->count();
        $pages = (int) ($total / $limit);
        $total = ($total % $limit) ? $pages + 1 : $pages;
        $records = $query->count();

        $this->set(compact('rows', 'total', 'records'));
        $this->set('_serialize', ['rows', 'total', 'records']);
    }

    /**
     * View method
     *
     * @param string|null $id Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $type = $this->Types->get($id, [
            'contain' => ['Participants']
        ]);

        $this->set('type', $type);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $type = $this->Types->newEntity();

        if ($this->request->is('post')) {
            $this->response->type('json');
            $res = (object) [
                'error' => false,
                'errors' => null,
                'data' => null,
                'message' => ''
            ];
            $data = $this->request->getData();
            $data['alias'] = strtoupper(str_replace(' ', '_', $data['name']));
            $data['created_by'] =  $this->Auth->user('id');
            $type = $this->Types->patchEntity($type, $data);
            $save = $this->Types->save($type);
            if ($save) {
                $res->error = false;
                $res->errors = $type->errors();
                $res->data = $save;
                $res->message = 'El tipo de participante se registro correctamente';
                $this->response->getBody()->write(json_encode($res));
                return $this->response->withStatus(200);
            } else {
                $res->error = true;
                $res->errors = $type->errors();
                $res->data = $save;
                $res->message = 'El tipo de participante no se pudo registrar.';
                $this->response->getBody()->write(json_encode($res));
                return $this->response->withStatus(200);
            }
        } else {
            $this->viewBuilder()->setLayout('ajax');
            $this->set(compact('type'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $type = $this->Types->get($id, [
            'contain' => ['Participants']
        ]);
            
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->response->type('json');
            $res = (object) [
                'error' => false,
                'errors' => null,
                'data' => null,
                'message' => ''
            ];
            $data = $this->request->getData();
            $data['alias'] = strtoupper(str_replace(' ', '_', $data['name']));
            $data['modified_by'] =  $this->Auth->user('id');
            $type = $this->Types->patchEntity($type, $data);
            $save = $this->Types->save($type);
            if ($save) {
                $res->error = false;
                $res->errors = $type->errors();
                $res->data = $save;
                $res->message = 'El tipo de participante se registro correctamente';
                $this->response->getBody()->write(json_encode($res));
                return $this->response->withStatus(200);
            } else {
                $res->error = true;
                $res->errors = $type->errors();
                $res->data = $save;
                $res->message = 'El tipo de participante no se pudo registrar.';
                $this->response->getBody()->write(json_encode($res));
                return $this->response->withStatus(200);
            }
        } else {
            $this->viewBuilder()->setLayout('ajax');
            $this->set(compact('type'));
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $type = $this->Types->get($id);
        if ($this->Types->delete($type)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Type'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Type'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
