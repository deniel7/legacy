<!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <li class="header">Main Navigation</li>
          <!-- Optionally, you can add icons to the links -->
          <li {{ \Request::segment(1) == 'home' ? 'class=active' : '' }}><a href="{{ url('/banners') }}"><i class="fa fa-tachometer"></i> <span>Banner</span></a></li>



          <li class="treeview {{ in_array(\Request::segment(1), ['users','vendors', 'packages']) ? 'active' : '' }}">
            <a href="#"><i class="fa fa-table"></i> <span>Master Data</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              @if (in_array(100, session()->get('allowed_menus')))
                <li {{ \Request::segment(1) == 'users' ? 'class=active' : '' }}><a href="{{ url('/users') }}">Users</a></li>
              @endif
              @if (in_array(110, session()->get('allowed_menus')))
                <li {{ \Request::segment(1) == 'vendors' ? 'class=active' : '' }}><a href="{{ url('/vendors') }}">Vendor</a></li>
              @endif
              @if (in_array(120, session()->get('allowed_menus')))
                <li {{ \Request::segment(1) == 'packages' ? 'class=active' : '' }}><a href="{{ url('/packages') }}">Packages</a></li>
              @endif
            </ul>
          </li>

          <li class="treeview {{ in_array(\Request::segment(1), ['couple', 'event']) ? 'active' : '' }}">
            <a href="#"><i class="fa fa-table"></i> <span>Projects</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              @if (in_array(300, session()->get('allowed_menus')))
                <li {{ \Request::segment(1) == 'couple' ? 'class=active' : '' }}><a href="{{ url('/couple') }}">Projects</a></li>
              @endif

              @if (in_array(300, session()->get('allowed_menus')))
                <li {{ \Request::segment(1) == 'event' ? 'class=active' : '' }}><a href="{{ url('/events') }}">Event</a></li>
              @endif
              
            </ul>
          </li>

          <li class="treeview {{ in_array(\Request::segment(1), ['contacts']) ? 'active' : '' }}">
          <a href="#"><i class="fa fa-envelope-o"></i> <span>Contact</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            @if (in_array(900, session()->get('allowed_menus')))
              <li {{ \Request::segment(2) == 'contacts' ? 'class=active' : '' }}><a href="{{ url('/contacts') }}">List</a></li>
            @endif
          </ul>
        </li>

         <li class="treeview {{ in_array(\Request::segment(1), ['system']) ? 'active' : '' }}">
          <a href="#"><i class="fa fa-wrench"></i> <span>Administrasi Sistem</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            @if (in_array(900, session()->get('allowed_menus')))
              <li {{ \Request::segment(2) == 'role' ? 'class=active' : '' }}><a href="{{ url('/system/role') }}">Role</a></li>
              <li {{ \Request::segment(2) == 'user' ? 'class=active' : '' }}><a href="{{ url('/system/user') }}">User</a></li>
            @endif
          </ul>
        </li>

        </ul>
        <!-- /.sidebar-menu -->
