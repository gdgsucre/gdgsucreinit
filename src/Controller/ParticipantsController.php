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

    public function index() {
        $type = ':[Todos];P:Participante;E:Expositor;O:Organizador';
        $printed = ':[Todos];Y:Impreso;N:Sin imprimir';
        $gender = ':[Todos];F:Femenino;M:Masculino';
        $status = ':[Todos];A:Activo;I:Inactivo';
        $this->set(compact('type', 'printed', 'gender', 'status'));
    }

    /**
     * Data method
     *
     * @return \Cake\Http\Response|json
     */
    public function data() {
        $name = $this->request->getQuery('name');
        $email = $this->request->getQuery('email');
        $mobile = $this->request->getQuery('mobile');
        $qr = $this->request->getQuery('qr');
        $gender = $this->request->getQuery('gender');
        $occupation = $this->request->getQuery('occupation');
        $skills = $this->request->getQuery('skills');
        $technologies = $this->request->getQuery('technologies');
        $type = $this->request->getQuery('type');
        $printed = $this->request->getQuery('printed');
        $status = $this->request->getQuery('status');

        $limit = $this->request->getQuery('rows');
        $page = $this->request->getQuery('page');
        $sord = $this->request->getQuery('sord');
        $sidx = $this->request->getQuery('sidx');

        $conditions = [];
        if (!empty($name)) {
            $conditions['name LIKE'] = '%' . $name . '%';
        }
        if (!empty($email)) {
            $conditions['email LIKE'] = '%' . $email . '%';
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
        if (!empty($occupation)) {
            $conditions['occupation LIKE'] = '%' . $occupation . '%';
        }
        // if (!empty($skills)) {
        //     $conditions['skills LIKE'] = '%' . $skills . '%';
        // }
        // if (!empty($technologies)) {
        //     $conditions['technologies LIKE'] = '%' . $technologies . '%';
        // }
        if (!empty($type)) {
            $conditions['type'] = $type;
        }
        if (!empty($printed)) {
            $conditions['printed'] = $printed;
        }
        if (!empty($status)) {
            $conditions['status'] = $status;
        }

        $query = $this->Participants->find('all', [
                    'fields' => [
                        'id',
                        'name', 'email', 'mobile', 'qr',
                        'gender', 'occupation', 'skills', 'technologies',
                        'type', 'printed', 'status'
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
    public function add() {
        $participant = $this->Participants->newEntity();
        if ($this->request->is('post')) {
            $data['error'] = 0;

            $participant = $this->Participants->patchEntity($participant, $this->request->getData());
            $participant->printed = empty($this->request->getData('printed')) ? 'N' : $participant->printed;
            $participant->status = empty($this->request->getData('status')) ? 'I' : $participant->status;
            $participant->created_by = $this->Auth->user('id');
            if (!$this->Participants->save($participant)) {
                $data['error'] = 1;
                $data['message'] = 'El Participante no se pudo registrar. Verifique los datos e inténtelo nuevamente';
            }

            $this->response->type('json');
            $this->response->body(json_encode($data));
            return $this->response;
        } else {
            $this->viewBuilder()->layout('ajax');
            $this->set(compact('participant'));
            $this->set('_serialize', ['participant']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $participant = $this->Participants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data['error'] = 0;

            $participant = $this->Participants->patchEntity($participant, $this->request->getData());
            $participant->name = mb_strtoupper($participant->name);
            $participant->printed = empty($this->request->getData('printed')) ? 'N' : $participant->printed;
            $participant->status = empty($this->request->getData('status')) ? 'I' : $participant->status;
            $participant->modified_by = $this->Auth->user('id');
            if (!$this->Participants->save($participant)) {
                $data['error'] = 1;
                $data['message'] = 'El Participante no se pudo modificar. Verifique los datos e inténtelo nuevamente';
            }

            $this->response->type('json');
            $this->response->body(json_encode($data));
            return $this->response;
        } else {
            $this->viewBuilder()->layout('ajax');
            $this->set(compact('participant'));
            $this->set('_serialize', ['participant']);
        }
    }


    public function profile(){
        $qr_hash = $this->request->getParam('qr_hash');

        $colors = ["primary","danger","success","info","warning"];

        $participant = $this->Participants->find('all', [
            'conditions' => ['qr' => $qr_hash]
        ])->first();

        $this->set('participant', $participant);
        $this->set('colors', $colors);
    }

    public function credentials ($ids = null) {
        if (empty($ids)) {
            $participants = $this->Participants->find('all', [
                'fields' => ['id', 'name', 'type','qr'],
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

    public function certificate () {
        $qr = $this->request->getParam('qr');
        $participant = $this->Participants->find('all', [
            'fields' => ['qr', 'name','type'],
            'conditions' => [
                'qr' => $qr,
                'status' => 'A'
            ]
        ])->first();
        $this->set('participant', $participant);
        // echo debug($participant); exit;

        $this->viewBuilder()->layout('ajax');
        $this->response->type('pdf');
        $this->render('/Participants/pdf/certificate');
    }


    public function qrFix () {
        $participants = $this->Participants->find('all');

        foreach ($participants as $participant) {
            $this->Participants->updateAll(
                ['qr' => md5(Configure::Read('Security.salt') . $participant->id)],
                ['id' => $participant->id]
            );
        }
exit;
    }
}
