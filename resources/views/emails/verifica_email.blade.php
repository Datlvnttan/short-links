<center>
    <h1>Xác thực Email đăng ký tài khoản</h1>
    <p>Xin chào, rất vui vì bạn đã đăng ký sử dụng dịch vụ của chúng tôi</p>
    <p>Vui lòng nhấn vào nút phía bên dưới để hoàn tất quá trình đăng ký</p>
    <a href="{{url("/verify/$id/$token")}}" style="border: 5px; border-radius:5px; background-color: black; color: white; padding: 20px; font-size:17px; text-decoration: none">Xác nhận</a>
    {{-- <a href="{{ route('revify-email', ['id'=>$id,'token'=>$token]) }}" style="border: 5px; border-radius:5px; background-color: black; color: white; padding: 20px; font-size:17px; text-decoration: none">Xác nhận</a> --}}
</center>