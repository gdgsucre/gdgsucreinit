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
        $type = ':[Todos];P:First Global;T:Tutor;O:Organizador;L:Line Follower';
        $printed = ':[Todos];Y:Impreso;N:Sin imprimir';
        $gender = ':[Todos];F:Femenino;M:Masculino';
        $status = ':[Todos];A:Activo;I:Inactivo';
        $validate = ':[Todos];1:Si;0:No';
        $this->set(compact('type', 'printed', 'gender', 'status', 'validate'));
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
        $type2 = $this->request->getQuery('type2');
        $printed = $this->request->getQuery('printed');
        $status = $this->request->getQuery('status');
        $validate = $this->request->getQuery('validate');

        $limit = $this->request->getQuery('rows');
        $page = $this->request->getQuery('page');
        $sord = $this->request->getQuery('sord');
        $sidx = $this->request->getQuery('sidx');

        $conditions = [];
        if (!empty($name)) {
            $conditions['name LIKE'] = '%' . $name . '%';
        }
        if (!empty($ci)) {
            $conditions['ci'] = $ci;
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
        if (!empty($team)) {
            $conditions['team LIKE'] = '%' . $team . '%';
        }
        if (!empty($type2)) {
            $conditions['type2'] = $type2;
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
            'fields' => [
                'id',
                'name', 'email', 'mobile', 'qr',
                'ci', 'gender', 'team', 'validate',
                'type2', 'printed', 'status'
            ],
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
            $participant->name = mb_strtoupper($participant->name);
            $participant->printed = empty($this->request->getData('printed')) ? 'N' : $participant->printed;
            $participant->status = empty($this->request->getData('status')) ? 'I' : $participant->status;
            $participant->created_by = $this->Auth->user('id');
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
                    'order' => 'name ASC'
                ]
            );
            $this->viewBuilder()->layout('ajax');
            $this->set(compact('participant','types'));
            $this->set('_serialize', ['participant','types']);
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
            $participant = $this->Participants->patchEntity($participant, $this->request->getData(), [
                'associated' => [
                    'Types'
                ]
            ]);
            $participant->name = mb_strtoupper($participant->name);
            $participant->printed = empty($this->request->getData('printed')) ? 'N' : $participant->printed;
            $participant->status = empty($this->request->getData('status')) ? 'I' : $participant->status;
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
                    'order' => 'name ASC'
                ]
            );
            $this->viewBuilder()->layout('ajax');
            $this->set(compact('participant','types'));
            $this->set('_serialize', ['participant','types']);
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
        if ($this->request->is(['patch', 'post', 'put'])) {

            $participant = $this->Participants->find('all', [
                'conditions' => [
                    'ci' => $this->request->getData('ci')
                ]
            ])->first();
            if (!empty($participant)) {
                $participant = $this->Participants->patchEntity($participant, $this->request->getData());
                $participant->validate = true;
                $save = $this->Participants->save($participant);
                if ($save) {
                    $this->Flash->success(__('Ci, validado'));
                    return $this->redirect('/qr/'. $save->qr);
                }
            } else {
                $this->Flash->error(__('Error, el ci no es valido'));
            }
        }

        $this->set(compact('participant', 'qr_hash'));
    }

    public function credentials($ids = null)
    {
        if (empty($ids)) {
            $participants = $this->Participants->find('all', [
                'fields' => ['id', 'name', 'type', 'qr', 'team'],
                'conditions' => [
                    'status' => 'A',
                    'printed' => 'N'
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


    // public function qrFix()
    // {
    //     $participants = $this->Participants->find('all');

    //     foreach ($participants as $participant) {
    //         $this->Participants->updateAll(
    //             ['qr' => md5(Configure::Read('Security.salt') . $participant->id)],
    //             ['id' => $participant->id]
    //         );
    //     }
    //     exit;
    // }
}
