<h2>个人中心</h2>
欢迎【{{session("user")["user_name"]}}】回来
<button><a href="{{url('/index/user/index')}}">首页</a></button>
<hr>
<table border="1">
    <tr>
        <td align="center">用户ID</td>
        <td align="center">用户名</td>
        <td align="center">Email</td>
        <td align="center">注册时间</td>
        <td align="center">最后一次登录时间</td>
    </tr>
    <tr>
        <td align="center">{{$user->user_id}}</td>
        <td align="center">{{$user->user_name}}</td>
        <td align="center">{{$user->email}}</td>
        <td align="center">{{date("Y-m-d H:i:s",$user->reg_time)}}</td>
        <td align="center">{{date("Y-m-d H:i:s",$user->login_time)}}</td>
    </tr>
</table>