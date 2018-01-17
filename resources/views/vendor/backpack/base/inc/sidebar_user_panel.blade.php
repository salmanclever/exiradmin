<div class="user-panel">
  <a class="pull-right image" href="{{ route('backpack.account.info') }}">
    <img src="{{ backpack_avatar_url(Auth::user()) }}" class="img-circle" alt="User Image">
  </a>
  <div class="pull-right info">
    <p><a href="{{ route('backpack.account.info') }}">{{ Auth::user()->name }}</a></p>
    <small><small><a href="{{ route('backpack.account.info') }}"><span><i class="fa fa-user-circle-o"></i> {{ trans('backpack::base.my_account') }}</span></a> &nbsp;  &nbsp; <a href="{{ backpack_url('logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></small></small>
  </div>
</div>