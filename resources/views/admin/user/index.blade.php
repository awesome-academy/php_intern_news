<table>
    <thead>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Email') }}</th>
        <th>{{ __('Username') }}</th>
        <th>{{ __('Created at') }}</th>
        <th>{{ __('Updated at') }}</th>
        <th>{{ __('Status') }}</th>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td>
                    <form action="{{ route('admin.users.change-status', $user->id) }}" method="post">
                        @csrf
                        <select name="status" id="">
                            @for ($i = 0; $i < count($status); $i++)
                                <option value="{{ $i + 1 }}" @if ($user->status == $i + 1) selected @endif>
                                    {{ $status[$i] }}
                                </option>
                            @endfor
                        </select>

                        <button type="submit"> {{ __('Save Change') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
