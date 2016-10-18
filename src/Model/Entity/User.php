<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $username
 * @property string $password
 * @property string $profile_picture_dir
 * @property $profile_picture
 * @property bool $is_superuser
 * @property string $token
 * @property \Cake\I18n\Time $token_expires
 * @property string $api_token
 * @property \Cake\I18n\Time $activation_date
 * @property bool $is_active
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
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
        'token'
    ];

    protected $_virtual = ['profile_picture_path'];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }

    protected function _getProfilePicturePath()
    {
        /**
         * No `profile_picture` eu uso ::getOriginal() pois se o form for submitado com um
         * foto carregado e falhar o `profile_picture` vai receber o array do file e daria erro aqui.
         */
        if ($this->_properties['profile_picture_dir'] && $this->getOriginal('profile_picture')) {
            return '../files/users/profile_picture/' . $this->_properties['profile_picture_dir'] . '/square_' . $this->getOriginal('profile_picture'); 
        }
        return 'default-profile_picture.png';
    }

}
