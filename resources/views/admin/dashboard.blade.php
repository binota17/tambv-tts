<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to Admin Dashboard</h1>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @if(auth()->user()->hasRole('full_access'))
    <a href="{{ route('admin.index') }}">Test phân quyền</a>
    @endif

    @if(auth()->user()->hasRole('limited_access'))
    <a href="{{ route('admin.index_limited') }}">Test phân quyền</a>
    @endif
</body>
</html>
