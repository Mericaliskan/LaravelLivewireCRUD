<div>
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h3 style="float: left;"><strong>All Users</strong></h3>
                        <button class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New User</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{session('message')}}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Email</th>
                                        <th style="text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                @if ($users->count() > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->surname}}</td>
                                            <td>{{$user->email}}</td>
                                            <td style="text-align:center;">
                                                <div class="btn-group">
                                                    <button class="btn btn-primary" wire:click="viewUserDetails({{$user->id}})">View</button>
                                                    <button class="btn btn-secondary" wire:click="editUsers({{$user->id}})">Edit</button>
                                                    <button class="btn btn-danger" wire:click="deleteConfirmation({{ $user->id }})">Delete</button>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" style="text-align:center;"><small>No User Found</small></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form wire:submit.prevent="storeUserData" >
            <div class="form-group row mt-3">
                <label for="name" class="col-3">Name</label>
                <div class="col-9">
                    <input wire:model="name" type="text" class="form-control" id="name" required>
                    @error('name') <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="surname" class="col-3">Surname</label>
                <div class="col-9">
                    <input wire:model="surname" type="text" class="form-control" id="surname" required>
                    @error('surname') <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="email" class="col-3">Email</label>
                <div class="col-9">
                    <input wire:model="email" type="email" class="form-control" id="email" required>
                    @error('email') <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="password" class="col-3">Şifre</label>
                <div class="col-9">
                    <input wire:model="password" type="password" class="form-control" id="password">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="password_confirmation"  class="col-3">Şifre Tekrarı</label>
                <div class="col-9">
                    <input wire:model="password_confirmation" type="password" class="form-control"
                    id="password_confirmation">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4" style="float: right;">Add User</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div wire:ignore.self class="modal fade" id="editexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form wire:submit.prevent="editUserData">
            <div class="form-group row mt-3">
                <label for="name" class="col-3">Name</label>
                <div class="col-9">
                    <input wire:model="name" type="text" class="form-control" id="name" required>
                    @error('name') <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="surname" class="col-3">Surname</label>
                <div class="col-9">
                    <input wire:model="surname" type="text" class="form-control" id="surname" required>
                    @error('surname') <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="email" class="col-3">Email</label>
                <div class="col-9">
                    <input wire:model="email" type="email" class="form-control" id="email" required>
                    @error('email') <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="password" class="col-3">Şifre</label>
                <div class="col-9">
                    <input wire:model="password" type="password" class="form-control" id="password">
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-group row mt-3">
                <label for="password_confirmation"  class="col-3">Şifre Tekrarı</label>
                <div class="col-9">
                    <input wire:model="password_confirmation" type="password" class="form-control"
                    id="password_confirmation">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4" style="float: right;">Edit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div wire:ignore.self class="modal fade" id="deleteexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Confirmation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pt-4 pb-4">
            <h6>Are you sure? You want to delete this user data!</h6>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" wire:click="cancel()" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            <button class="btn btn-danger" wire:click="deleteUserData()">Delete</button>

        </div>
      </div>
    </div>
  </div>
  <div wire:ignore.self class="modal fade" id="viewexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">User Information</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeViewStudentModal"></button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <body>
                    <tr>
                        <td>{{ $view_id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $view_name }}</td>
                    </tr>
                    <tr>
                        <th>Surname</th>
                        <td>{{ $view_surname }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $view_email }}</td>
                    </tr>
                </body>
            </table>
        </div>
      </div>
    </div>
  </div>

</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#exampleModal').modal('hide');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').removeAttr('style');
            $('#editexampleModal').modal('hide');
            $('#deleteexampleModal').modal('hide');


        });
        window.addEventListener('show-edit-user-modal', event => {
            $('#editexampleModal').modal('show');
        });
        window.addEventListener('show-delete-confirmation-modal', event => {
            $('#deleteexampleModal').modal('show');
        });
        window.addEventListener('show-view-user-modal', event => {
            $('#viewexampleModal').modal('show');
        });
    </script>
@endpush
