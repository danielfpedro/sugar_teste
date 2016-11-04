<?php
namespace App\Model\Table;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Proffer.Proffer', [
            'profile_picture' => [
                'root' => WWW_ROOT . 'files',
                'dir' => 'profile_picture_dir',
                'thumbnailSizes' => [
                    'square' => [
                        'w' => 160,
                        'h' => 160,
                        'fit' => true,
                        'jpeg_quality'  => 100
                    ],
                ]
            ]
        ]);
    }

    public function findAuth(Query $query, array $options)
    {
        $query
            ->select(['id', 'username', 'name', 'password', 'profile_picture_dir', 'profile_picture', 'role_id'])
            ->contain([
                'Roles' => function ($q) {
                    return $q
                        ->select(['id', 'name']);
                }
            ]);

        return $query;
    }


    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        echo 'oi';
        exit();
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');
            ->minLength('name', 100);

        $validator
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->allowEmpty('profile_picture_dir');

        $validator
            ->allowEmpty('profile_picture');

        $validator
            ->boolean('is_superuser')
            ->allowEmpty('is_superuser');

        $validator
            ->allowEmpty('token');

        $validator
            ->dateTime('token_expires')
            ->allowEmpty('token_expires');

        $validator
            ->allowEmpty('api_token');

        $validator
            ->dateTime('activation_date')
            ->allowEmpty('activation_date');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->email('email')
            ->allowEmpty('email');


        $validator
            ->allowEmpty('new_password')
            ->add('new_password', 'confirmaSenha', [
                'rule' => function ($value, $context) {
                    if ($value) {
                        return ($value == $context['data']['confirm_new_password']);
                    }
                    return true;
                },
                'message' => 'Você não confirmou a sua nova senha corretamente.'
            ]);

        return $validator;
    }

            public function validationCheckCurrentPassword(Validator $validator) {
        
            $validator
                ->notEmpty('current_password')
                ->add('current_password', 'confirmaSenhaAtual', [
                    'rule' => function ($value, $context) {
                        $user = $this->get($context['data']['id']);

                        if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                            return true;
                        }
                        return false;
                    },
                    'message' => 'Você não confirmou a sua nova atual corretamente.'
                ]);

            return $validator;
        }
        


    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
