<form action="{{url('/index/user/loginDo')}}" method="post">
    @csrf
    <h2>登录</h2>
    <table>
        <tr>
            <td>用户名：</td>
            <td><input type="text" name="user_name"></td>
            <td><b style="color:red">{{session('user_name')}}</b></td>
        </tr>
        <tr>
            <td>密码：</td>
            <td><input type="password" name="password"></td>
            <td><b style="color:red">{{session('password')}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="登录"></td>
        </tr>
    </table>
</form>