@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        @include('backpack::inc.sidebar_user_panel')

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          {{-- <li class="header">{{ trans('backpack::base.administration') }}</li> --}}
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

          <li><a href="{{ backpack_url('employee') }}"><i class="fa fa-users"></i> <span>{{ trans('backpack::base.employee') }}</span></a></li>

              <li><a href="{{ backpack_url('department') }}"><i class="fa  fa-cube"></i> <span>{{ trans('backpack::base.department') }}</span></a></li>
              <li><a href="{{ backpack_url('group') }}"><i class="fa   fa-object-group"></i> <span>{{ trans('backpack::base.group') }}</span></a></li>
              <li><a href="{{ backpack_url('categorie') }}"><i class="fa  fa-object-ungroup"></i> <span>{{ trans('backpack::base.categorie') }}</span></a></li>


              <li><a href="{{  backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::base.file_manager') }}</span></a></li>

              <li><a href="{{  backpack_url('language') }}"><i class="fa fa-flag-o"></i> <span>{{ trans('backpack::base.language') }}</span></a></li>
              <li><a href="{{ backpack_url( 'language/texts') }}"><i class="fa fa-language"></i> <span>Language Files</span></a></li>



              <!-- ======================================= -->
          {{-- <li class="header">Other menus</li> --}}
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
