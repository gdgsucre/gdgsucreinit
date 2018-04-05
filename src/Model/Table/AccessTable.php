<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

/**
 * Acceso Model
 *
 * @method \App\Model\Entity\SisUsuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\SisUsuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SisUsuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SisUsuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SisUsuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SisUsuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SisUsuario findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccesoTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->table('users');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->add('password_current', 'custom', [
                    'rule' => function($valor, $contexto) {
                        $this->Users = TableRegistry::get('Users');
                        $user = $this->Users->get($contexto['data']['id']);
                        if ($user) {
                            if ((new DefaultPasswordHasher)->check($valor, $user->password)) {
                                return true;
                            }
                        }
                        return false;
                    },
                    'message' => 'La contraseña actual es incorrecta',
                ])
                ->requirePresence('password_current', 'update')
                ->notEmpty('password_current', 'La Contraseña no debe ser vacia');

        $validator->add('password_new', 'no-misspelling', [
            'rule' => ['compareWith', 'password_confirm'],
            'message' => 'Las Contraseñas no coinciden',
        ])->notEmpty('password_new', 'Debe introducir un valor');

        $validator->add('password_confirm', 'no-misspelling', [
            'rule' => ['compareWith', 'password_new'],
            'message' => 'Las Contraseñas no coinciden',
        ])->notEmpty('password_confirm', 'Debe introducir un valor');

        $validator
                ->integer('created_by')
                ->requirePresence('created_by', 'create')
                ->notEmpty('created_by');

        $validator
                ->integer('modified_by')
                ->allowEmpty('modified_by');

        return $validator;
    }

}
