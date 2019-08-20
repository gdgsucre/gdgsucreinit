<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Participant Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $team
 * @property float $mobile
 * @property string $qr
 * @property string $gender
 * @property string $skills
 * @property string $technologies
 * @property string $type
 * @property string $printed
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $created_by
 * @property int $modified_by
 */
class Participant extends Entity
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
        'name' => true,
        'email' => true,
        'team' => true,
        'mobile' => true,
        'qr' => true,
        'gender' => true,
        'skills' => true,
        'technologies' => true,
        'type' => true,
        'printed' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'created_by' => true,
        'modified_by' => true
    ];
}
