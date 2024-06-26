<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
            <a href="">Check room</a>
        </div>
    </div>
    <ul class="sidebar-nav">

        <li class="sidebar-item">
            <a href="{{ url('/checkroom') }}" class="sidebar-link">
                <i class="lni lni-home"></i>

                <span>หน้าหลัก</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                <i class="lni lni-agenda"></i>
                <span>จัดการการจองห้อง</span>
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('booking') }}" class="sidebar-link">การจองห้อง</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('book_status') }}" class="sidebar-link">ประวัติการจอง</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('checkroom')}}" class="sidebar-link">
                <i class="lni lni-protection"></i>
                <span>จัดการการตรวจห้อง</span>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#">
                    <li class="sidebar-item">
                        <a href="{{ route('booking') }}" class="sidebar-link">การจองห้อง</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('book_status') }}" class="sidebar-link">ประวัติการจอง</a>
                    </li>
                </ul>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('history_check')}}" class="sidebar-link">
                <i class="lni lni-protection"></i>
                <span>ประวัติการตรวจห้อง</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" id="logout">
            @csrf
            @method('DELETE')
            <a href="javascript:{}" onclick="document.getElementById('logout').submit(); return false;" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">ออกจากระบบ</span>
            </a>
        </form>
    </div>
</aside>