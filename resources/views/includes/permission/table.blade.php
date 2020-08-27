<form id='permission-form' action="{{ route('permissions.save') }}" method='POST'>

<table class='table'>
  <thead class="thead-dark">
    <tr>
      <th scope='col'>User name</th>
      @foreach($roles as $role)
        <th scope='col'>{{ $role->name }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
      @csrf

      @foreach($users as $user)
        <tr>
          <td> {{$user->name}} </td>
          @foreach($roles as $role)
            <td>
              <input
                type='checkbox'
                onclick="permission({{$user->id}}, {{$role->id}}, this.checked)"
                {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'checked' : ''}}
              >
            </td>
          @endforeach
        </tr>
      @endforeach

  </tbody>
</table>
<div class='offset-md-10'>
    <button class="btn btn-primary" type="submit">Save Permissions</button>
</div>
</form>

<script>

function permission(userId, roleId, checked)
{
  let permissions = {
    'user_id': userId,
    'role_id': roleId,
    'checked': checked,
  };

  let input = document.createElement("input");
  input.setAttribute('type', 'hidden');
  input.setAttribute('name', 'permissions[]');
  input.setAttribute('value', JSON.stringify(permissions));
  document.getElementById('permission-form').appendChild(input);
}
</script>
