<table class="table table-striped table-sm">
  <caption>{{ trans_choice('users.count', $users->total()) }}</caption>
  <thead>
    <tr>
      <th>@lang('users.attributes.name')</th>
      <th>@lang('users.attributes.email')</th>
      <th>@lang('users.attributes.registered_at')</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
      <tr>
        <td>
          <a href="{{ route('admin.users.edit', $user->id) }}">
            {{ $user->name }}
          </a>
        </td>
        <td>{{ $user->email }}</td>
        <td>
          @if (!$user->email_verified_at)
            Not Verrified
          @else
            @customizeDate($user->email_verified_at, 'd/m/Y H:i:s')
          @endif
        </td>

        <td></td>
        <td>
          <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm">
            <x-icon name="edit" />
          </a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="d-flex justify-content-center">
  {{ $users->links() }}
</div>
