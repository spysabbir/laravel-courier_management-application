<ul class="metismenu" id="menu">
    <li>
        <a href="{{ route('dashboard') }}">
            <div class="parent-icon"><i class="bi bi-house"></i></div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>

    @if (Auth::user()->role == "Super Admin")
    <li class="menu-label">Super Admin Panel</li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-gear"></i></div>
            <div class="menu-title">Setting</div>
        </a>
        <ul>
            <li>
                <a href="{{ route('default.setting') }}"><i class="bi bi-globe"></i>Default Setting</a>
            </li>
            <li>
                <a href="{{ route('mail.setting') }}"><i class="bi bi-envelope"></i>Mail Setting</a>
            </li>
            <li>
                <a href="{{ route('sms.setting') }}"><i class="bi bi-chat-dots-fill"></i>Sms Setting</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-file"></i></div>
            <div class="menu-title">Report</div>
        </a>
        <ul>
            <li>
                <a href="{{ route('report.courier') }}"><i class="bi bi-bag"></i>Courier</a>
            </li>
            <li>
                <a href="{{ route('report.income') }}"><i class="bi bi-calculator"></i>Income</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-file-earmark-break-fill"></i></div>
            <div class="menu-title">Page</div>
        </a>
        <ul>
            <li>
                <a href="{{ route('about.us.page') }}"><i class="bi bi-file-earmark-person"></i>About Us</a>
            </li>
            <li>
                <a href="{{ route('privacy.policy.page') }}"><i class="bi bi-shield-exclamation"></i>Privacy Policy</a>
            </li>
            <li>
                <a href="{{ route('terms.of.service.page') }}"><i class="bi bi-book"></i>Terms of Service</a>
            </li>
        </ul>
    </li>
    @endif

    @if (Auth::user()->role == "Super Admin" || Auth::user()->role == "Admin")
    <li class="menu-label">Admin Panel</li>
    <li>
        <a href="{{ route('branch.index') }}">
            <div class="parent-icon"><i class="bi bi-shop"></i></div>
            <div class="menu-title">Branch</div>
        </a>
    </li>
    <li>
        <a href="{{ route('all.manager') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">All Manager</div>
        </a>
    </li>
    <li>
        <a href="{{ route('unit.index') }}">
            <div class="parent-icon"><i class="bi bi-bag"></i></div>
            <div class="menu-title">Unit</div>
        </a>
    </li>
    <li>
        <a href="{{ route('cost.index') }}">
            <div class="parent-icon"><i class="bi bi-calculator"></i></div>
            <div class="menu-title">Cost</div>
        </a>
    </li>
    <li>
        <a href="{{ route('company.index') }}">
            <div class="parent-icon"><i class="bi bi-briefcase"></i></div>
            <div class="menu-title">Company</div>
        </a>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-globe2"></i></div>
            <div class="menu-title">Frontend</div>
        </a>
        <ul>
            <li>
                <a href="{{ route('service.index') }}"><i class="bi bi-hdd-rack"></i>Service</a>
            </li>
            <li>
                <a href="{{ route('testimonial.index') }}"><i class="bi bi-blockquote-left"></i>Testimonial</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ route('contact.message.index') }}">
            <div class="parent-icon"><i class="bi bi-briefcase"></i></div>
            <div class="menu-title">Contact Message</div>
        </a>
    </li>
    @endif

    @if (Auth::user()->role == "Manager")
    <li class="menu-label">Manager Panel</li>
    <li>
        <a href="{{ route('all.staff') }}">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">All Staff</div>
        </a>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-cursor-fill"></i>
            </div>
            <div class="menu-title">Send Courier List</div>
        </a>
        <ul>
            <li>
                <a href="{{ route('send.courier.list.processing') }}"><i class="bi bi-list-stars"></i>Processing</a>
            </li>
            <li>
                <a href="{{ route('send.courier.list.delivered') }}"><i class="bi bi-card-checklist"></i>Delivered</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-gift"></i>
            </div>
            <div class="menu-title">Delivery Courier List</div>
        </a>
        <ul>
            <li>
                <a href="{{ route('delivery.courier.list.processing') }}"><i class="bi bi-list-stars"></i>Processing</a>
            </li>
            <li>
                <a href="{{ route('delivery.courier.list.delivered') }}"><i class="bi bi-card-checklist"></i>Delivered</a>
            </li>
        </ul>
    </li>
    @endif

    @if (Auth::user()->role == "Staff")
    <li class="menu-label">Staff Panel</li>
    <li>
        <a href="{{ route('send.courier') }}">
            <div class="parent-icon"><i class="bi bi-arrow-right-square-fill"></i></div>
            <div class="menu-title">Send Courier</div>
        </a>
    </li>
    <li>
        <a href="{{ route('delivery.courier') }}">
            <div class="parent-icon"><i class="bi bi-sort-down-alt"></i></div>
            <div class="menu-title">Delivery Courier</div>
        </a>
    </li>
    @endif

</ul>
