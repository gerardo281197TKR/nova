<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
    {{-- <div>
        <img src="assets/images/logo-icon-2.png" class="logo-icon" alt="logo icon">
    </div> --}}
    <div>
        <h4 class="logo-text">NOVA</h4>
    </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
    <li>
        <a href="/dashboard">
        <div class="parent-icon">
            <ion-icon name="home-outline"></ion-icon>
        </div>
        <div class="menu-title">Dashboard</div>
        </a>
    </li>
    @if(auth()->user()->roleId == \App\Models\Role::ADMIN)
        <li>
            <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="leaf-outline"></ion-icon>
            </div>
            <div class="menu-title">Icons</div>
            </a>
            <ul>
            <li> <a href="icons-line-icons.html">
                <ion-icon name="ellipse-outline"></ion-icon>Line Icons
                </a>
            </li>
            <li> <a href="icons-boxicons.html">
                <ion-icon name="ellipse-outline"></ion-icon>Boxicons
                </a>
            </li>
            <li> <a href="icons-feather-icons.html">
                <ion-icon name="ellipse-outline"></ion-icon>Feather Icons
                </a>
            </li>
            </ul>
        </li>
        <li class="menu-label">Forms & Tables</li>
        <li>
            <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="newspaper-outline"></ion-icon>
            </div>
            <div class="menu-title">Forms</div>
            </a>
            <ul>
            <li> <a href="form-elements.html">
                <ion-icon name="ellipse-outline"></ion-icon>Form Elements
                </a>
            </li>
            <li> <a href="form-input-group.html">
                <ion-icon name="ellipse-outline"></ion-icon>Input Groups
                </a>
            </li>
            <li> <a href="form-layouts.html">
                <ion-icon name="ellipse-outline"></ion-icon>Forms Layouts
                </a>
            </li>
            <li> <a href="form-validations.html">
                <ion-icon name="ellipse-outline"></ion-icon>Form Validation
                </a>
            </li>
            <li> <a href="form-wizard.html">
                <ion-icon name="ellipse-outline"></ion-icon>Form Wizard
            </a>
            </li>
            <li> <a href="form-radios-and-checkboxes.html">
                <ion-icon name="ellipse-outline"></ion-icon>Radio & Checkboxes
            </a>
            </li>
            <li> <a href="form-date-time-pickes.html">
                <ion-icon name="ellipse-outline"></ion-icon>Date Pickers
                </a>
            </li>
            <li> <a href="form-select2.html">
                <ion-icon name="ellipse-outline"></ion-icon>Select2
                </a>
            </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="server-outline"></ion-icon>
            </div>
            <div class="menu-title">Tables</div>
            </a>
            <ul>
            <li> <a href="table-basic-table.html">
                <ion-icon name="ellipse-outline"></ion-icon>Basic Table
                </a>
            </li>
            <li> <a href="table-advance-tables.html">
                <ion-icon name="ellipse-outline"></ion-icon>Advance Tables
                </a>
            </li>
            <li> <a href="table-datatable.html">
                <ion-icon name="ellipse-outline"></ion-icon>Data Table
                </a>
            </li>
            </ul>
        </li>
        <li class="menu-label">Pages</li>
        <li>
            <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="lock-closed-outline"></ion-icon>
            </div>
            <div class="menu-title">Authentication</div>
            </a>
            <ul>
            <li> <a href="authentication-sign-in-basic.html">
                <ion-icon name="ellipse-outline"></ion-icon>Sign In Basic
                </a>
            </li>
            <li> <a href="authentication-sign-in-cover.html">
                <ion-icon name="ellipse-outline"></ion-icon>Sign In Cover
                </a>
            </li>
            <li> <a href="authentication-sign-in-simple.html">
                <ion-icon name="ellipse-outline"></ion-icon>Sign In Simple
                </a>
            </li>
            <li> <a href="authentication-sign-up-basic.html">
                <ion-icon name="ellipse-outline"></ion-icon>Sign Up Basic
                </a>
            </li>
            <li> <a href="authentication-sign-up-cover.html">
                <ion-icon name="ellipse-outline"></ion-icon>Sign Up Cover
                </a>
            </li>
            <li> <a href="authentication-sign-up-simple.html">
                <ion-icon name="ellipse-outline"></ion-icon>Sign Up Simple
                </a>
            </li>
            <li> <a href="authentication-reset-password-basic.html">
                <ion-icon name="ellipse-outline"></ion-icon>Reset Password Basic
                </a>
            </li>
            <li> <a href="authentication-reset-password-cover.html">
                <ion-icon name="ellipse-outline"></ion-icon>Reset Password Cover
                </a>
            </li>
            <li> <a href="authentication-reset-password-simple.html">
                <ion-icon name="ellipse-outline"></ion-icon>Reset Password Simple
                </a>
            </li>
            </ul>
        </li>
        <li>
            <a href="pages-user-profile.html">
            <div class="parent-icon">
                <ion-icon name="person-circle-outline"></ion-icon>
            </div>
            <div class="menu-title">User Profile</div>
            </a>
        </li>
        <li>
            <a href="pages-edit-profile.html">
            <div class="parent-icon">
                <ion-icon name="create-outline"></ion-icon>
            </div>
            <div class="menu-title">Edit Profile</div>
            </a>
        </li>
        <li>
            <a href="pages-invoices.html">
            <div class="parent-icon">
                <ion-icon name="receipt-outline"></ion-icon>
            </div>
            <div class="menu-title">Invoice</div>
            </a>
        </li>
        <li>
            <a href="pages-to-do.html">
            <div class="parent-icon">
                <ion-icon name="shield-checkmark-outline"></ion-icon>
            </div>
            <div class="menu-title">Invoice</div>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="copy-outline"></ion-icon>
            </div>
            <div class="menu-title">Extra Pages</div>
            </a>
            <ul>
            <li><a href="pages-faq.html">
                <ion-icon name="ellipse-outline"></ion-icon>FAQ
                </a>
            </li>
            <li><a href="pages-pricing-tables.html">
                <ion-icon name="ellipse-outline"></ion-icon>Pricing
                </a>
            </li>
            <li><a href="pages-errors-404-error.html">
                <ion-icon name="ellipse-outline"></ion-icon>404 Error
                </a>
            </li>
            <li><a href="pages-errors-500-error.html">
                <ion-icon name="ellipse-outline"></ion-icon>500 Error
                </a></li>
            <li><a href="pages-errors-coming-soon.html">
                <ion-icon name="ellipse-outline"></ion-icon>Coming Soon
                </a></li>
            <li><a href="pages-starter-page.html">
                <ion-icon name="ellipse-outline"></ion-icon>Blank Page
                </a></li>
            </ul>
        </li>
        <li class="menu-label">Charts & Maps</li>
        <li>
            <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="bar-chart-outline"></ion-icon>
            </div>
            <div class="menu-title">Charts</div>
            </a>
            <ul>
            <li> <a href="charts-apex-chart.html">
                <ion-icon name="ellipse-outline"></ion-icon>Apex
                </a>
            </li>
            <li> <a href="charts-chartjs.html">
                <ion-icon name="ellipse-outline"></ion-icon>Chartjs
                </a>
            </li>
            <li> <a href="charts-peity.html">
                <ion-icon name="ellipse-outline"></ion-icon>Peity
            </a>
            </li>
            <li> <a href="charts-other.html">
            <ion-icon name="ellipse-outline"></ion-icon>Other Charts
            </a>
            </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="map-outline"></ion-icon>
            </div>
            <div class="menu-title">Maps</div>
            </a>
            <ul>
            <li> <a href="map-google-maps.html">
                <ion-icon name="ellipse-outline"></ion-icon>Google Maps
                </a>
            </li>
            <li> <a href="map-vector-maps.html">
                <ion-icon name="ellipse-outline"></ion-icon>Vector Maps
                </a>
            </li>
            </ul>
        </li>
        <li class="menu-label">Others</li>
        <li>
            <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="list-outline"></ion-icon>
            </div>
            <div class="menu-title">Menu Levels</div>
            </a>
            <ul>
            <li> <a class="has-arrow" href="javascript:;">
                <ion-icon name="ellipse-outline"></ion-icon>Level One
                </a>
                <ul>
                <li> <a class="has-arrow" href="javascript:;">
                    <ion-icon name="ellipse-outline"></ion-icon>Level Two
                    </a>
                    <ul>
                    <li> <a href="javascript:;">
                        <ion-icon name="ellipse-outline"></ion-icon>Level Three
                        </a>
                    </li>
                    </ul>
                </li>
                </ul>
            </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="menu-title">Documentation</div>
            </a>
        </li>
    @endif

    @if(auth()->user()->roleId == \App\Models\Role::MANAGER)
        <li>
            <a href="javascript:;" class="has-arrow">
            <div class="parent-icon">
                <ion-icon name="people-outline"></ion-icon>
            </div>
            <div class="menu-title">Usuarios</div>
            </a>
            <ul>
            <li><a href="/users/list">
                <ion-icon name="ellipse-outline"></ion-icon> Lista Usuarios
                </a>
            </li>
            <li><a href="/users/new">
                <ion-icon name="ellipse-outline"></ion-icon> Nuevo Usuario
                </a>
            </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
            <div class="parent-icon">
                <ion-icon name="document-outline"></ion-icon>
            </div>
            <div class="menu-title">Ciclos de evaluación</div>
            </a>
            <ul>
            <li><a href="/cicles/list">
                <ion-icon name="ellipse-outline"></ion-icon> Lista Ciclos
                </a>
            </li>
            <li><a href="/cicles/new">
                <ion-icon name="ellipse-outline"></ion-icon> Nuevo Ciclo
                </a>
            </li>
            </ul>
        </li>
        <li class="menu-label">Facturación</li>
            <li>
                <a href="/company/plan">
                <div class="parent-icon">
                    <ion-icon name="business-outline"></ion-icon>
                </div>
                <div class="menu-title">Mi Plan</div>
                </a>
            </li>
        <li>
                <a href="/company/payments">
                <div class="parent-icon">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
                <div class="menu-title">Mis Pagos</div>
                </a>
            </li>
        <li>
    @endif

    @if(auth()->user()->roleId == \App\Models\Role::USER)
        <li>
            <a href="/evaluations/list">
            <div class="parent-icon">
                <ion-icon name="help-outline"></ion-icon>
            </div>
            <div class="menu-title">Evaluaciones</div>
            </a>
        </li>
    @endif
    <li>
        <a href="https://api.whatsapp.com/send?phone=524495485609&text=Hola,%20necesito%20ayuda">
        <div class="parent-icon">
            <ion-icon name="link-outline"></ion-icon>
        </div>
        <div class="menu-title">Soporte</div>
        </a>
    </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
