<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TypesParticipants Controller
 *
 * @property \App\Model\Table\TypesParticipantsTable $TypesParticipants
 *
 * @method \App\Model\Entity\TypesParticipant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypesParticipantsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Types', 'Participants']
        ];
        $typesParticipants = $this->paginate($this->TypesParticipants);

        $this->set(compact('typesParticipants'));
    }

    /**
     * View method
     *
     * @param string|null $id Types Participant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typesParticipant = $this->TypesParticipants->get($id, [
            'contain' => ['Types', 'Participants']
        ]);

        $this->set('typesParticipant', $typesParticipant);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typesParticipant = $this->TypesParticipants->newEntity();
        if ($this->request->is('post')) {
            $typesParticipant = $this->TypesParticipants->patchEntity($typesParticipant, $this->request->data);
            if ($this->TypesParticipants->save($typesParticipant)) {
                $this->Flash->success(__('The {0} has been saved.', 'Types Participant'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Types Participant'));
            }
        }
        $types = $this->TypesParticipants->Types->find('list', ['limit' => 200]);
        $participants = $this->TypesParticipants->Participants->find('list', ['limit' => 200]);
        $this->set(compact('typesParticipant', 'types', 'participants'));
        $this->set('_serialize', ['typesParticipant']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Types Participant id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typesParticipant = $this->TypesParticipants->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typesParticipant = $this->TypesParticipants->patchEntity($typesParticipant, $this->request->data);
            if ($this->TypesParticipants->save($typesParticipant)) {
                $this->Flash->success(__('The {0} has been saved.', 'Types Participant'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Types Participant'));
            }
        }
        $types = $this->TypesParticipants->Types->find('list', ['limit' => 200]);
        $participants = $this->TypesParticipants->Participants->find('list', ['limit' => 200]);
        $this->set(compact('typesParticipant', 'types', 'participants'));
        $this->set('_serialize', ['typesParticipant']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Types Participant id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typesParticipant = $this->TypesParticipants->get($id);
        if ($this->TypesParticipants->delete($typesParticipant)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Types Participant'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Types Participant'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
