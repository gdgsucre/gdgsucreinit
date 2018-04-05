<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $document
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $address
 * @property string $mobile
 * @property string $phone
 * @property \Cake\I18n\FrozenTime $last_access
 * @property string $last_ip
 * @property \Cake\I18n\FrozenTime $last_change_password
 * @property string $remember_token
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 * @property int $role_id
 *
 * @property \App\Model\Entity\Role $role
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'document' => true,
        'firstname' => true,
        'lastname' => true,
        'username' => true,
        'password' => true,
        'email' => true,
        'address' => true,
        'mobile' => true,
        'phone' => true,
        'last_access' => true,
        'last_ip' => true,
        'last_change_password' => true,
        'remember_token' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true,
        'role_id' => true,
        'role' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
