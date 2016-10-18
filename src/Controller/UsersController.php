<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        
        $q = '%' . str_replace(' ', '%', $this->request->query('q')) . '%';
        
        $this->paginate['conditions'] = [
            'Users.name LIKE ' => $q
        ];

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('O user foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O user não foi salvo. Por favor, tente novamente.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('O user foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('O user não foi salvo. Por favor, tente novamente.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('O user foi deletado.'));
        } else {
            $this->Flash->error(__('O user não foi salvo. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method
     *
     * @return \Cake\Network\Response|void
     */
    public function login()
    {
        $this->viewBuilder()->layout('login');
        
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('A combinação Email/Senha informada é inválida.'));
        }
    }

    /**
     * Logout method
     *
     * @return \Cake\Network\Response
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * ProfileSettings method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function accountSettings()
    {
        $id = $this->Auth->user('id');
        
        $user = $this->Users->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Users->patchEntity($user, $this->request->data, [
                'validate' => 'CheckCurrentPassword',
            ]);
            if ($this->Users->save($user)) {
                
                $this->Flash->success(__('As alterações foram salvas com sucesso.'));

                return $this->redirect(['action' => 'accountSettings']);
            } else {
                $this->Flash->error(__('As alterações não foram salvas. Por favor, tente novamente.'));
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * ProfileSettings method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function profileSettings()
    {
        $id = $this->Auth->user('id');
        
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                /**
                 * Atualizo os dados da sessão que eu uso para mostrar algo como nome e imagem de perfil
                 */
                $this->Auth->session->write($this->Auth->sessionKey . '.name', $user->name);
                
                $this->Flash->success(__('As alterações foram salvas com sucesso.'));

                return $this->redirect(['action' => 'profileSettings']);
            } else {
                $this->Flash->error(__('As alterações não foram salvas. Por favor, tente novamente.'));
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * ProfileSettings method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function passwordSettings()
    {
        $id = $this->Auth->user('id');
        
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Users->patchEntity($user, $this->request->data, [
                'validate' => 'CheckCurrentPassword',
            ]);

            if ($this->Users->save($user)) {
                
                $this->Flash->success(__('As alterações foram salvas com sucesso.'));

                return $this->redirect(['action' => 'passwordSettings']);
            } else {
                $this->Flash->error(__('As alterações não foram salvas. Por favor, tente novamente.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * ProfileSettings method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function profileImageSettings()
    {
        $id = $this->Auth->user('id');
        
        $user = $this->Users->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                /**
                 * Pego o user de novo para pegar os dados novos da imagem
                 */
                $user = $this->Users->get($user->id);
                $this->Auth->session->write($this->Auth->sessionKey . '.profile_picture_path', $user->profile_picture_path);
                
                $this->Flash->success(__('As alterações foram salvas com sucesso.'));

                return $this->redirect(['action' => 'profileImageSettings']);
            } else {
                $this->Flash->error(__('As alterações não foram salvas. Por favor, tente novamente.'));
            }
        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
}
