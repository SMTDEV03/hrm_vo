<style>
 .btn-primary {
    background-color: #5867dd;
    border-color: #4857d0;
  }   
</style>
<h1>Forget Password Email</h1>   
You can reset password from below link:
<a href="{{ route('reset.password.get', $token) }}" style="background-color: #5867dd;border-color: #4857d0;padding: 7px;color: #fff; border-radius: 5px; text-decoration: none;" class="btn btn-info">Reset Password</a>