<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * Participants Controller
 *
 * @property \App\Model\Table\ParticipantsTable $Participants
 *
 * @method \App\Model\Entity\Participant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ParticipantsController extends AppController
{

    public function index()
    {
        $this->loadModel('Types');
        $type = ':[Todos];P:First Global;T:Tutor;O:Organizador;L:Line Follower';
        $printed = ':[Todos];Y:Impreso;N:Sin imprimir';
        $gender = ':[Todos];F:Femenino;M:Masculino';
        $status = ':[Todos];A:Activo;I:Inactivo';
        $validate = ':[Todos];1:Si;0:No';
        $types = $this->Types->find(
            'list',
            [
                'limit' => 200,
                'order' => 'name ASC',
                'keyField' => 'name',
                'valueField' => 'name'
            ]
        );
        // dd($types->toArray());
        $typesList = ':[Todos]';;
        foreach ($types as $id => $name) {
            $typesList .= ';' . $id . ':' . $name;
        }
        $this->set(compact('type', 'printed', 'gender', 'status', 'validate', 'typesList'));
    }

    public function indexRanking()
    {
        $this->loadModel('Types');
        $type = ':[Todos];P:First Global;T:Tutor;O:Organizador;L:Line Follower';
        $printed = ':[Todos];Y:Impreso;N:Sin imprimir';
        $gender = ':[Todos];F:Femenino;M:Masculino';
        $status = ':[Todos];A:Activo;I:Inactivo';
        $validate = ':[Todos];1:Si;0:No';
        $types = $this->Types->find(
            'list',
            [
                'limit' => 200,
                'order' => 'name ASC',
                'keyField' => 'name',
                'valueField' => 'name'
            ]
        );
        // dd($types->toArray());
        $typesList = ':[Todos]';;
        foreach ($types as $id => $name) {
            $typesList .= ';' . $id . ':' . $name;
        }
        $this->set(compact('type', 'printed', 'gender', 'status', 'validate', 'typesList'));
    }

    /**
     * Data method
     *
     * @return \Cake\Http\Response|json
     */
    public function data()
    {
        $name = $this->request->getQuery('name');
        $ci = $this->request->getQuery('ci');
        $mobile = $this->request->getQuery('mobile');
        $qr = $this->request->getQuery('qr');
        $gender = $this->request->getQuery('gender');
        $team = $this->request->getQuery('team');
        $type = $this->request->getQuery('type');
        $printed = $this->request->getQuery('printed');
        $status = $this->request->getQuery('status');
        $validate = $this->request->getQuery('validate');
        $id = $this->request->getQuery('id');

        $limit = $this->request->getQuery('rows');
        $page = $this->request->getQuery('page');
        $sord = $this->request->getQuery('sord');
        $sidx = $this->request->getQuery('sidx');

        $conditions = [];
        if (!empty($id)) {
            $conditions['id'] = $id;
        }
        if (!empty($name)) {
            $conditions['name LIKE'] = '%' . $name . '%';
        }
        if (!empty($mobile)) {
            $conditions['mobile'] = $mobile;
        }
        if (!empty($qr)) {
            $conditions['qr'] = $qr;
        }
        if (!empty($gender)) {
            $conditions['gender'] = $gender;
        }
        if (!empty($type)) {
            $conditions['type'] = $type;
        }

        if (!empty($printed)) {
            $conditions['printed'] = $printed;
        }
        if (!empty($status)) {
            $conditions['status'] = $status;
        }
        if (!empty($validate)) {
            $conditions['validate'] = (bool) $validate;
        }


        $query = $this->Participants->find('all', [
            'contain' => []
        ])->where($conditions);

        try {
            $rows = $this->paginate($query, [
                'limit' => $limit,
                'page' => $page,
                'order' => ['Participants.' . $sidx => $sord]
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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Types');
        $participant = $this->Participants->newEntity();
        if ($this->request->is('post')) {
            $data['error'] = 0;
            $participant = $this->Participants->patchEntity($participant, $this->request->getData());
            $participant->name = mb_strtoupper(trim($participant->name));
            $participant->printed = empty($this->request->getData('printed')) ? 'N' : $participant->printed;
            $participant->status = empty($this->request->getData('status')) ? 'I' : $participant->status;
            $participant->created_by = $this->Auth->user('id');
            $participant->qr = md5(Configure::Read('Security.salt') . time());
            $save = $this->Participants->save($participant);
            if (!$save) {
                $data['error'] = 1;
                $data['message'] = 'El Participante no se pudo registrar. Verifique los datos e inténtelo nuevamente';
                $data['errors'] = $participant->errors();
            }

            $this->response->type('json');
            $this->response->body(json_encode($data));
            return $this->response;
        } else {
            $types = $this->Types->find(
                'list',
                [
                    'limit' => 200,
                    'order' => 'name ASC',
                    'keyField' => 'name',
                    'valueField' => 'name'
                ]
            );
            $this->viewBuilder()->layout('ajax');
            $this->set(compact('participant', 'types'));
            $this->set('_serialize', ['participant', 'types']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Types');
        $participant = $this->Participants->get($id, [
            'contain' => ['Types']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data['error'] = 0;
            $participant = $this->Participants->patchEntity($participant, $this->request->getData(), []);
            $participant->name = mb_strtoupper(trim($participant->name));
            $participant->printed = empty($this->request->getData('printed')) ? 'N' : $participant->printed;
            $participant->status = empty($this->request->getData('status')) ? 'I' : $participant->status;
            if($this->request->getData('is_qr') == 'Y'){
                $participant->qr = md5(Configure::Read('Security.salt') . time());
            }
            
            $participant->modified_by = $this->Auth->user('id');
            if (!$this->Participants->save($participant)) {
                $data['error'] = 1;
                $data['message'] = 'El Participante no se pudo modificar. Verifique los datos e inténtelo nuevamente';
                $data['errors'] = $participant->errors();
            }

            $this->response->type('json');
            $this->response->body(json_encode($data));
            return $this->response;
        } else {
            $types = $this->Types->find(
                'list',
                [
                    'limit' => 200,
                    'order' => 'name ASC',
                    'keyField' => 'name',
                    'valueField' => 'name'
                ]
            );
            $this->viewBuilder()->layout('ajax');
            $this->set(compact('participant', 'types'));
            $this->set('_serialize', ['participant', 'types']);
        }
    }

        /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editPoints($id = null)
    {
        $this->loadModel('Types');
        $participant = $this->Participants->get($id, [
            'contain' => ['Types']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data['error'] = 0;
            $participant = $this->Participants->patchEntity($participant, $this->request->getData(), []);
            $participant->modified_by = $this->Auth->user('id');
            if (!$this->Participants->save($participant)) {
                $data['error'] = 1;
                $data['message'] = 'El Participante no se pudo modificar. Verifique los datos e inténtelo nuevamente';
                $data['errors'] = $participant->errors();
            }

            $this->response->type('json');
            $this->response->body(json_encode($data));
            return $this->response;
        } else {
            $this->viewBuilder()->layout('ajax');
            $this->set(compact('participant', 'types'));
            $this->set('_serialize', ['participant']);
        }
    }

    public function profile()
    {
        $qr_hash = $this->request->getParam('qr_hash');
        $participant = $this->Participants->find('all', [
            'contain' => ['Types'],
            'conditions' => [
                'qr' => $qr_hash,
            ],
        ])->first();
        $this->set(compact('participant', 'qr_hash'));
    }

    public function listParticipants()
    {
        $participants = $this->Participants->find('all', [
            'conditions' => [
                'type' => 'PARTICIPANT',
            ],
            'order' => ['points' => 'DESC'],
        ]);
        //dd($participants->toArray());
        $this->set(compact('participants'));
    }


    public function credentials($ids = null)
    {
        if (empty($ids)) {
            $participants = $this->Participants->find('all', [
                'fields' => ['id', 'name', 'type', 'qr', 'team'],
                'conditions' => [
                    'status' => 'A',
                    'printed' => 'N',
                ],
                'order' => ['id' => 'ASC'],
                'limit' => 9
            ]);
            $participantsList = $this->Participants->find('list', [
                'fields' => ['id'],
                'conditions' => [
                    'status' => 'A',
                    'printed' => 'N'
                ],
                'order' => ['id' => 'ASC'],
                'limit' => 9
            ]);
            $array_ids = $participantsList;
        } else {
            $ids = '0,' . $ids;
            $array_ids = explode(',', $ids);
            $participants = $this->Participants->find('all', [
                'fields' => ['id', 'name', 'type'],
                'conditions' => [
                    'Participants.id IN' => $array_ids,
                    'status' => 'A',
                    'printed' => 'N'
                ],
                'order' => ['id' => 'ASC']
            ]);
        }
        //dd($participants->toArray());
        $this->viewBuilder()->layout('ajax');
        $this->response->type('pdf');
        $this->set('participants', $participants);
        $this->render('/Participants/pdf/credentials');


        foreach ($participants as $participant) {
            $this->Participants->updateAll(
                ['printed' => 'Y'],
                ['id' => $participant->id]
            );
        }
    }

    public function certificate()
    {
        $qr = $this->request->getParam('qr');
        $type = $this->request->getQuery('type');

        $participant = $this->Participants->find('all', [
            'contain' => ['Types'],
            'fields' => [],
            'conditions' => [
                'qr' => $qr,
                'status' => 'A'
            ]
        ])->first();
        // dd($participant);
        $this->set(compact('participant', 'type'));
        $this->viewBuilder()->layout('ajax');
        $this->response->type('pdf');
        $this->render('/Participants/pdf/certificate');
    }
}
