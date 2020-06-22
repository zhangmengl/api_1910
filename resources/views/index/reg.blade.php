<form action="{{url('/index/user/regDo')}}" method="post">
    @csrf
    <h2>注册</h2>
    <table>
        <tr>
            <td>用户名：</td>
            <td><input type="text" name="user_name"></td>
            <td><b style="color:red">{{$errors->first('user_name')}}</b></td>
        </tr>
        <tr>
            <td>Email：</td>
            <td><input type="text" name="email"></td>
            <td><b style="color:red">{{$errors->first('email')}}</b></td>
        </tr>
        <tr>
            <td>密码：</td>
            <td><input type="password" name="password"></td>
            <td><b style="color:red">{{$errors->first('password')}}</b></td>
        </tr>
        <tr>
            <td>确认密码：</td>
            <td><input type="password" name="pwd"></td>
            <td><b style="color:red">{{session('pwd')}}</b></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="注册"></td>
        </tr>
    </table>
</form>