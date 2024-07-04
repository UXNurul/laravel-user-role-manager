<!DOCTYPE html>
<html>
<head>
    <title>Assign Role</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Assign Role to User</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('assign-role') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user">User</label>
                <select class="form-control" id="user" name="user_id" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Assign Role</button>
        </form>
    </div>
</body>
</html>
