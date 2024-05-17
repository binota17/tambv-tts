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
    <a href="{{ route('list.user') }}">Test phân quyền: xem danh sách user</a> <br/>
    <a href="{{ route('edit.user') }}">Test phân quyền: Sửa user</a>

</body>
</html>
