<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Participants Controller
 *
 * @property \App\Model\Table\ParticipantsTable $Participants
 *
 * @method \App\Model\Entity\Participant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfileController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        // $participants = $this->paginate($this->Participants);

        // $this->set(compact('participants'));
    }

    /**
     * View method
     *
     * @param string|null $id Participant id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

    }

}
