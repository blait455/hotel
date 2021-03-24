    <aside id="leftsidebar" class="sidebar">

        <!-- Menu -->
        <div class="menu">
            <ul class="list">

                <li class="header">MAIN NAVIGATION</li>

                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/sliders*') ? 'active' : '' }}">
                    <a href="{{ route('admin.sliders.index') }}">
                        <i class="material-icons">burst_mode</i>
                        <span>Sliders</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/services*') ? 'active' : '' }}">
                    <a href="{{ route('admin.services.index') }}">
                        <i class="material-icons">wb_sunny</i>
                        <span>Services</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonials.index') }}">
                        <i class="material-icons">view_carousel</i>
                        <span>Testimonials</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/galleries*') ? 'active' : '' }}">
                    <a href="{{ route('admin.album') }}">
                        <i class="material-icons">view_list</i>
                        <span>Gallery</span>
                    </a>
                </li>

                <li class="header">Administration</li>
                <li class="{{ Request::is('admin/DCR*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="material-icons">view_list</i>
                        <span>Daily Cash Records</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/MP*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="material-icons">view_list</i>
                        <span>Imprest</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/SR*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="material-icons">view_list</i>
                        <span>Store Records</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/DP*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="material-icons">view_list</i>
                        <span>Drinks Purchase</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/RQ*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="material-icons">view_list</i>
                        <span>Requisition</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/RL*') ? 'active' : '' }}">
                    <a href="#">
                        <i class="material-icons">view_list</i>
                        <span>Receptionist Ledger</span>
                    </a>
                </li>

                <li class="header">Acomodation</li>
                <li class="{{ Request::is('admin/rooms*') ? 'active' : '' }}">
                    <a href="{{ route('admin.rooms.index') }}">
                        <i class="material-icons">hotel</i>
                        <span>Rooms</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/features*') ? 'active' : '' }}">
                    <a href="{{ route('admin.features.index') }}">
                        <i class="material-icons">star</i>
                        <span>Features</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/types*') ? 'active' : '' }}">
                    <a href="{{ route('admin.types.index') }}">
                        <i class="material-icons">casino</i>
                        <span>Types</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/guests*') ? 'active' : '' }}">
                    <a href="{{ route('admin.guests.index') }}">
                        <i class="material-icons">elevator</i>
                        <span>Guests</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/bookings*') ? 'active' : '' }}">
                    <a href="{{ route('admin.bookings.index') }}">
                        <i class="material-icons">night_shelter</i>
                        <span>Bookings</span>
                    </a>
                </li>

                <li class="header">Restaurant & Bar</li>
                <li class="{{ Request::is('admin/food-types*') ? 'active' : '' }}">
                    <a href="{{ route('admin.food-types.index') }}">
                        <i class="material-icons">scatter_plot</i>
                        <span>Food types</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/food-items*') ? 'active' : '' }}">
                    <a href="{{ route('admin.food-items.index') }}">
                        <i class="material-icons">fastfood</i>
                        <span>Food Items</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/drink-categories*') ? 'active' : '' }}">
                    <a href="{{ route('admin.drink-categories.index') }}">
                        <i class="material-icons">category</i>
                        <span>Drink categories</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/drinks*') ? 'active' : '' }}">
                    <a href="{{ route('admin.drinks.index') }}">
                        <i class="material-icons">local_bar</i>
                        <span>Drinks</span>
                    </a>
                </li>

                <li class="header">Blog</li>
                <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="material-icons">category</i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/tags*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tags.index') }}">
                        <i class="material-icons">label</i>
                        <span>Tags</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="material-icons">library_books</i>
                        <span>Posts</span>
                    </a>
                </li>

                <li class="header">Permissions</li>
                <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="material-icons">perm_identity</i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/roles*') ? 'active' : '' }}">
                    <a href="{{ route('admin.roles.index') }}">
                        <i class="material-icons">supervisor_account</i>
                        <span>Roles</span>
                    </a>
                </li>

                <li class="header"> </li>
                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings') }}">
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/changepassword') ? 'active' : '' }}">
                            <a href="{{ route('admin.changepassword') }}">
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/profile') ? 'active' : '' }}">
                            <a href="{{ route('admin.profile') }}">
                                <span>Profile</span>
                            </a>
                        </li>
                        {{-- <li class="{{ Request::is('admin/message*') ? 'active' : '' }}">
                            <a href="{{ route('admin.message') }}">
                                <span>Message</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>


            </ul>
        </div>
        <!-- #Menu -->

    </aside>
