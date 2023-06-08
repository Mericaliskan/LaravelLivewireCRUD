<?php

namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;

class UsersComponent extends Component
{
    public $name,$surname,$email,$password,$password_confirmation, $edit_id, $delete_id;

    public $view_id, $view_name, $view_surname, $view_email;


    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|min:6|confirmed',
        ]);
    }

    public function storeUserData()
    {
        $this->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);

        $user->save();

        session()->flash('message', 'New user has been added successfully');


        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');


    }
    public function resetInputs()
    {
        $this->name = '';
        $this->surname = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }
    public function close()
    {
        $this->resetInputs();
    }
    public function editUsers($id)
    {
        $user = User::findOrFail($id);
        $this->edit_id = $user->id;
        $this->name = $user->name;
        $this->surname = $user->surname;
        $this->email = $user->email;

        $this->dispatchBrowserEvent('show-edit-user-modal');

    }
    public function editUserData()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->edit_id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = User::findOrFail($this->edit_id);
        $user->name = $validatedData['name'];
        $user->surname = $validatedData['surname'];
        $user->email = $validatedData['email'];

        if (!empty($this->password)) {
            $user->password = bcrypt($this->password);
        }

        $user->save();

        session()->flash('message', 'User has been updated successfully');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function deleteConfirmation($id){
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }
    public function deleteUserData(){
        $user = User::findOrFail($this->delete_id);
        $user->delete();
        session()->flash('message', 'User has been deleted successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->delete_id='';
    }
    public function cancel()
    {
        $this->delete_id='';
    }
    public function viewUserDetails($id)
    {
        $user = User::findOrFail($id);
        $this->view_id = $user->id;
        $this->view_name = $user->name;
        $this->view_surname = $user->surname;
        $this->view_email = $user->email;

        $this->dispatchBrowserEvent('show-view-user-modal');

    }
    public function closeViewStudentModal()
    {
        $this->view_id = '';
        $this->view_name = '';
        $this->view_surname = '';
        $this->view_email = '';
    }

    public function render()
    {
        $users = User::all();
        return view('livewire.users-component' , compact('users') )->layout('livewire.layouts.base');
    }
}
